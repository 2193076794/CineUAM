<?php
require_once '../ServiciosExternos/proxypreventa.php';
require_once '../Modelo/Preventa/preventa.php';
require_once '../Modelo/Cartelera/FuncionCine.php';
require_once '../Modelo/Cartelera/pelicula.php';
require_once '../Modelo/Cartelera/horario.php';
require_once '../Modelo/Cartelera/sala.php';

class ControladorPreventa {
    private $proxy;

    public function __construct() {
        $this->proxy = ProxyPreventa::obtenerProxy();
    }

    public function obtenerPeliculas() {
        return $this->proxy->obtenerPeliculas();
    }

    public function obtenerHorarios($idPelicula) {
        return $this->proxy->obtenerHorarios($idPelicula);
    }

    public function obtenerSucursales($idHorario) {
        return $this->proxy->obtenerSucursales($idHorario);
    }

    public function obtenerDetallePelicula($idPelicula) {
        return ProxyPreventa::obtenerProxy()->obtenerDetallePelicula($idPelicula);
    }
    
    public function obtenerDetalleHorario($idHorario) {
        return ProxyPreventa::obtenerProxy()->obtenerDetalleHorario($idHorario);
    }
    
    public function obtenerDetalleSucursal($idSucursal) {
        return ProxyPreventa::obtenerProxy()->obtenerDetalleSucursal($idSucursal);
    }
    
}