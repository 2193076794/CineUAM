<?php
require_once '../ServiciosExternos/proxyBoleto.php';
class GestorBoleto {
    private $proxy;

    function __construct() {
        $this->proxy = ProxyBoleto::obtenerProxy();
    }

    public function crearBoleto(int $IDPelicula, string $tipo, int $precio){
        
    }
}
?>