<?php
require_once "../includes/database.php";

class GestorAutenticacion {
    private $conexion;

    function __construct() {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->conect();
    }

    public function insertarUsuario(string $nombre, string $apellidos, string $correo, string $contrasenia) {
        $sql = $this->conexion->prepare("INSERT INTO usuarios (nombre, apellidos, correo, contrasenia) VALUES (?, ?, ?, ?)");
        $resultado = $sql->execute([$nombre, $apellidos, $correo, $contrasenia]);
        return $resultado;
    }

    public function autenticarUsuario(string $correo, string $contrasenia) {
        $sql = $this->conexion->prepare("SELECT correo FROM usuarios WHERE correo = ? AND contrasenia = ?");
        $sql->bind_param("ss", $correo, $contrasenia);
        $sql->execute();
        $sql->store_result();
        $resultado = $sql->num_rows > 0;
    
        // Si se encuentra un usuario con el correo y la contraseña proporcionados, devuelve true, de lo contrario, devuelve false
        return $resultado;
    }
    
    
}
?>
