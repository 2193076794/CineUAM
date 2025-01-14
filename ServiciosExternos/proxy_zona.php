<?php
//echo "<br>Entre a prozy zona";
class ProxySucursalZona {
    private static $instancia;
    private $conexion;

    private function __construct() {
        // Aquí estableces la conexión a la base de datos utilizando mysqli
        $this->conexion = new mysqli("localhost", "root", "123456", "cineuam");

        // Verificar la conexión
        if ($this->conexion->connect_error) {
            die("Conexión fallida: " . $this->conexion->connect_error);
        }
    }

    public static function obtenerProxy() {
        if (!self::$instancia) {
            self::$instancia = new self();
        }
        return self::$instancia;
    }

    public function obtenerDatosDeZonas(){
        // Obtener datos de la tabla de zonas
        $query = "SELECT * FROM zona";
        $result = $this->conexion->query($query);

        // Verificar si la consulta fue exitosa
        if ($result === false) {
            return [];
        }

        // Fetch all results into an associative array
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

    public function obtenerDatosDeSucursales(){
        // Obtener datos de la tabla de sucursales
        $query = "SELECT * FROM sucursal";
        $result = $this->conexion->query($query);

        // Verificar si la consulta fue exitosa
        if ($result === false) {
            return [];
        }

        // Fetch all results into an associative array
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
}
?>
