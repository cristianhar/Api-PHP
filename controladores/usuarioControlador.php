<?php


class UsuarioControlador {
    private $usuarioServicio;

    public function __construct($usuarioServicio) {
        $this->usuarioServicio = $usuarioServicio;
    }

    public function obtenerUsuario() {
        $usuario = $this->usuarioServicio->obtenerUsuario();
        if ($usuario) {
            echo json_encode($usuario);
        } else {
            header("HTTP/1.1 404 Not Found");
            echo json_encode(['Error' => 'No se encontraron usuarios']);
        }
    }

    public function obtenerUsuarioPorId($id) {
        $usuario = $this->usuarioServicio->obtenerUsuarioPorId($id);
        if ($usuario) {
            echo json_encode($usuario);
        } else {
            header("HTTP/1.1 404 Not Found");
            echo json_encode(['Error' => 'Usuario no encontrado']);
        }
    }
    public function crearUsuario() {
        $infoUsuario = json_decode(file_get_contents('php://input'), true);
        $nombre = $infoUsuario['nombre'] ?? null;
        $email = $infoUsuario['email'] ?? null;
        $edad = $infoUsuario['edad'] ?? null;
    
        if ($nombre && $email && $edad) {
            try {
                $this->usuarioServicio->crearUsuario($nombre, $email, $edad);
                header("HTTP/1.1 201 Created");
                echo json_encode(['success' => 'Usuario creado']);
            } catch (Exception $e) {
                header("HTTP/1.1 400 Bad Request");
                echo json_encode(['Error' => $e->getMessage()]);
            }
        } else {
            header("HTTP/1.1 400 Bad Request");
            echo json_encode(['Error' => 'Datos incompletos']);
        }
    }

    public function actualizarUsuario($id) {
        $infoUsuario = json_decode(file_get_contents('php://input'), true);
        $nombre = $infoUsuario['nombre'] ?? null;
        $email = $infoUsuario['email'] ?? null;
        $edad = $infoUsuario['edad'] ?? null;
    
        if ($nombre && $email && $edad) {
            try {
                $this->usuarioServicio->actualizarUsuario($id, $nombre, $email, $edad);
                echo json_encode(['Exitoso' => 'Usuario actualizado']);
            } catch (Exception $e) {
                header("HTTP/1.1 400 Bad Request");
                echo json_encode(['Error' => $e->getMessage()]);
            }
        } else {
            header("HTTP/1.1 400 Bad Request");
            echo json_encode(['Error' => 'Datos incompletos']);
        }
    }

    public function borrarUsuario($id) {
        try {
            $this->usuarioServicio->borrarUsuario($id);
            echo json_encode(['success' => 'Usuario eliminado']);
        } catch (Exception $e) {
            header("HTTP/1.1 400 Bad Request");
            echo json_encode(['Error' => $e->getMessage()]);
        }
    }
}
?>
