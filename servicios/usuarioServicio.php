<?php

class UsuarioServicio {
    private $usuarioRepositorio;

    public function __construct($usuarioRepositorio) {
        $this->usuarioRepositorio = $usuarioRepositorio;
    }

    public function obtenerUsuario() {
        return $this->usuarioRepositorio->obtenerUsuario();
    }

    public function obtenerUsuarioPorId($id) {
        return $this->usuarioRepositorio->obtenerUsuarioPorId($id);
    }

    public function crearUsuario($nombre, $email, $edad) {
        
        $usuarioexistente = $this->usuarioRepositorio->obtenerUsuarioPorEmail($email);
        if ($usuarioexistente) {
            throw new Exception("El email ya está registrado");
        }

        $this->usuarioRepositorio->crearUsuario($nombre, $email, $edad);
    }

    public function actualizarUsuario($id, $nombre, $email, $edad) {
     
        $usuarioexistente = $this->usuarioRepositorio->obtenerUsuarioPorId($id);
        if (!$usuarioexistente) {
            throw new Exception("El usuario no existe");
        }

        $this->usuarioRepositorio->actualizarUsuario($id, $nombre, $email, $edad);
    }

    public function borrarUsuario($id) {
     
        $usuarioexistente = $this->usuarioRepositorio->obtenerUsuarioPorId($id);
        if (!$usuarioexistente) {
            throw new Exception("El usuario no existe"); 
        } 

        $this->usuarioRepositorio->borrarUsuario($id);
    }
}
?>
