<?php
// db.php

$dbServidor = "localhost";
$dbNombre = "academia";
$dbuser = "root";
$dbpass = "";

try {
    $pdo = new PDO("mysql:host=$dbServidor;dbname=$dbNombre", $dbuser, $dbpass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
} catch (PDOException $e) {
    echo "Error en la conexión: " . $e->getMessage();
    exit;
}
?>
