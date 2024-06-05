<?php
require_once __DIR__ . '/db.php';
require_once __DIR__ . '/controladores/usuarioControlador.php';
require_once __DIR__ . '/repositorios/usuarioRepositorio.php';
require_once __DIR__ . '/servicios/usuarioServicio.php';

// Configurar encabezados CORS
function setCorsHeaders() {
    header("Access-Control-Allow-Origin: http://localhost:4200");
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization");
    header("Access-Control-Allow-Credentials: true");
}

// Manejar solicitudes OPTIONS para CORS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    setCorsHeaders();
    exit(0); // Termina la ejecución para solicitudes OPTIONS
}

setCorsHeaders(); // Configurar encabezados CORS para todas las solicitudes

$pdo = include __DIR__ . '/db.php';

$usuarioRepositorio = new UsuarioRepositorio($pdo);
$usuarioServicio = new UsuarioServicio($usuarioRepositorio);
$usuarioControlador = new UsuarioControlador($usuarioServicio);

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$path = str_replace('/api', '', $path);

switch ($path) {
    case '/usuarios':
        if ($method === 'GET') {
            $usuarioControlador->obtenerUsuario();
        } elseif ($method === 'POST') {
            $usuarioControlador->crearUsuario();
        } else {
            header("HTTP/1.1 405 Method Not Allowed");
            echo json_encode(['Error' => 'Método no permitido']);
        }
        break;

    case preg_match('/\/usuarios\/\d+/', $path) ? $path : !$path:
        if ($method === 'GET') {
            $userId = explode('/', $path)[2]; 
            $usuarioControlador->obtenerUsuarioPorId($userId);
        } elseif ($method === 'PUT') {
            $userId = explode('/', $path)[2]; 
            $usuarioControlador->actualizarUsuario($userId);
        } elseif ($method === 'DELETE') {
            $userId = explode('/', $path)[2]; 
            $usuarioControlador->borrarUsuario($userId);
        } else {
            header("HTTP/1.1 405 Method Not Allowed");
            echo json_encode(['Error' => 'Método no permitido']);
        }
        break;

    default:
        header("HTTP/1.1 404 Not Found");
        echo json_encode(['Error' => 'Ruta no encontrada']);
        break;
}
?>
