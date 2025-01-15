<?php
class ProxyCartelera {
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

    public function obtenerFunciones() {
        $query = "SELECT funcion.IDFuncion, pelicula.IDPelicula, pelicula.Nombre, pelicula.Sinopsis, pelicula.Duracin, pelicula.ImagenPelicula, pelicula.Genero, pelicula.Estado, sala.IDSala, sala.IDSucursal, sala.Asientos, sala.Tipo, horario.IDHorario, horario.FechaHora
                  FROM funcion
                  JOIN pelicula ON funcion.IDPelicula = pelicula.IDPelicula
                  JOIN sala ON funcion.IDSala = sala.IDSala
                  JOIN horario ON funcion.IDHorario = horario.IDHorario";
        $result = $this->conexion->query($query);

        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }
}
?>
