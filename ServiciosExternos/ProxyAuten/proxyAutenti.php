<?php

require_once "/Modelo/gestorAute.php";

interface AutenticacionInterface {
    public function autenticarUsuario(string $correo, string $contrasenia): bool;
}

// Proxy para el gestor de autenticación
class ProxyAutenticacion implements AutenticacionInterface {
    private $gestorAutenticacion;

    public function __construct() {
        // Crea una instancia 
        $this->gestorAutenticacion = new GestorAutenticacion();
    }

    public function autenticarUsuario(string $correo, string $contrasenia): bool {
       
        // Validación de los datos de entrada antes de continuar
        if (empty($correo) || empty($contrasenia)) {
            throw new Exception("Correo y contraseña son obligatorios");
        }

        return $this->gestorAutenticacion->autenticarUsuario($correo, $contrasenia);
    }
}



