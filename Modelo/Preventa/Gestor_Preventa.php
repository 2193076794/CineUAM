<?php
require_once '../ServiciosExternos/proxypreventa.php';
require_once 'preventa.php';
require_once '../Modelo/Cartelera/pelicula.php';
require_once '../Modelo/Cartelera/horario.php';
require_once '../Modelo/Cartelera/sala.php';

class GestorPreventa {
    private $proxy;

    public function __construct() {
        $this->proxy = ProxyPreventa::obtenerProxy();
    }

    public function obtenerPreventas() {
        $datos = $this->proxy->obtenerPreventas();
        $preventas = [];

        foreach ($datos as $dato) {
            $pelicula = new Pelicula($dato['IDPelicula'], $dato['Nombre'], $dato['Sinopsis'], $dato['Duracion'], $dato['ImagenPelicula'], $dato['Genero'], $dato['Estado']);
            $horario = new Horario($dato['IDHorario'], $dato['FechaHora']);
            $sala = new Sala($dato['IDSala'], $dato['IDSucursal'], $dato['Asientos'], $dato['Tipo']);
            $preventas[] = new Preventa($pelicula, $horario, $sala);
        }

        return $preventas;
    }
}