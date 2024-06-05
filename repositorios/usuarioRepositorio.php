<?php


class UsuarioRepositorio {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function obtenerUsuario() {
        $consulta = $this->pdo->query("SELECT * FROM usuarios");
        return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerUsuarioPorId($id) {
        $consulta = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
        $consulta->execute([$id]);
        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerUsuarioPorEmail($email) {
        $consulta = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = ?");
        $consulta->execute([$email]);
        return $consulta->fetch(PDO::FETCH_ASSOC);
    }

    public function crearUsuario($nombre, $email, $edad) {
        $consulta = $this->pdo->prepare("INSERT INTO usuarios (nombre, email, edad) VALUES (?, ?, ?)");
        $consulta->execute([$nombre, $email, $edad]);
    }

    public function actualizarUsuario($id, $nombre, $email, $edad) {
        $consulta = $this->pdo->prepare("UPDATE usuarios SET nombre = ?, email = ?, edad = ? WHERE id = ?");
        $consulta->execute([$nombre, $email, $edad, $id]);
    }

    public function borrarUsuario($id) {
        $consulta = $this->pdo->prepare("DELETE FROM usuarios WHERE id = ?");
        $consulta->execute([$id]);
    }
}
?>
