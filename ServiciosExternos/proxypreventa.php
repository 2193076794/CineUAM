<?php
class ProxyPreventa {
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

    public function obtenerPeliculas() {
        $query = "SELECT IDPelicula, Nombre FROM pelicula WHERE Estado = 'Disponible'";
        $result = $this->conexion->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerHorarios($idPelicula) {
        // Suponiendo que la relación es entre la tabla 'horario' y 'peliculas'
        $query = "
            SELECT h.IDHorario, h.FechaHora 
            FROM horario h
            JOIN pelicula p ON h.IDPelicula = p.IDPelicula
            WHERE p.IDPelicula = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $idPelicula);  // 'i' para enteros
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }        

    public function obtenerSucursales($idHorario) {
        $query = "
            SELECT s.IDSucursal, s.NombreZona 
            FROM sucursal s
            JOIN horario h ON s.IDSucursal = h.IDSucursal
            WHERE h.IDHorario = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $idHorario);  // 'i' para enteros
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function obtenerDetallePelicula($idPelicula) {
        $query = "SELECT IDPelicula, Nombre FROM pelicula WHERE IDPelicula = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $idPelicula); // 'i' para enteros
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    public function obtenerDetalleHorario($idHorario) {
        $query = "SELECT IDHorario, FechaHora FROM horario WHERE IDHorario = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $idHorario); // 'i' para enteros
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
    public function obtenerDetalleSucursal($idSucursal) {
        $query = "SELECT IDSucursal, NombreZona FROM sucursal WHERE IDSucursal = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $idSucursal); // 'i' para enteros
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    
}
