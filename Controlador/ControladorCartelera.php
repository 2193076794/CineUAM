<?php
include_once("../ServiciosExternos/proxyCartelera.php");
include_once("../Modelo/Cartelera/FuncionCine.php");
include_once("../Modelo/Cartelera/pelicula.php");
include_once("../Modelo/Cartelera/horario.php");
include_once("../Modelo/Cartelera/sala.php");

class ControladorCartelera {
    private $proxy;

    public function __construct() {
        $this->proxy = ProxyCartelera::obtenerProxy();
    }

    public function getFunciones() {
        $datos = $this->proxy->obtenerFunciones();
        $funciones = [];

        foreach ($datos as $dato) {
            $pelicula = new Pelicula($dato['IDPelicula'], $dato['Nombre'], $dato['Sinopsis'], $dato['Duración'], $dato['ImagenPelicula'], $dato['Genero'],$dato['Estado']);
            $horario = new Horario($dato['IDHorario'], $dato['FechaHora']);
            $sala = new Sala($dato['IDSala'], $dato['IDSucursal'], $dato['Asientos'], $dato['Tipo']);

            $funcion = new FuncionCine($pelicula, $horario, $sala);
            $funciones[] = $funcion;
        }

        return $funciones;
    }
}
?>
