<?php
class ProxyBoleto {
    private static $instancia;
    private $conexion;

    private function __construct() {
        $this->conexion = new mysqli("localhost", "root", "123456", "cineuam");

        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }

    public static function obtenerProxy() {
        if (!self::$instancia) {
            self::$instancia = new self();
        }
        return self::$instancia;
    }

    public function crearBoleto($IDPelicula, $Tipo, $Precio) {
        do {
            $IDBoleto = rand(1, 999999999); // Generar un ID aleatorio único
            $query = "SELECT IDBoleto FROM boleto WHERE IDBoleto = $IDBoleto";
            $result = $this->conexion->query($query);
        } while ($result->num_rows > 0);

        $query = "INSERT INTO boleto (IDBoleto, IDPelicula, Tipo, Precio) VALUES ($IDBoleto, $IDPelicula, '$Tipo', $Precio)";
        $result = $this->conexion->query($query);

        if ($result) {
            return $IDBoleto;
        } else {
            return "Error al crear el boleto: " . $this->conexion->error;
        }
    }

    public function obtenerBoleto($IDBoleto) {
        $query = "SELECT * FROM boleto WHERE IDBoleto = $IDBoleto";
        $result = $this->conexion->query($query);

        if ($result->num_rows > 0) {
            $boleto = $result->fetch_assoc();
            return $boleto;
        } else {
            return "No se encontró el boleto.";
        }
    }
}
?>