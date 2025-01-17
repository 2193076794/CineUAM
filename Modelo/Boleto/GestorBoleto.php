<?php
require_once '../Modelo/Boleto/Boleto.php';
require_once '../ServiciosExternos/proxyBoleto.php';
class GestorBoleto {
    private $proxy;
    private $boleto;

    function __construct() {
        $this->proxy = ProxyBoleto::obtenerProxy();
    }

    public function crearMostrarBoleto($IDPelicula, $Tipo, $Precio) {
        $this->boleto = new Boleto($this->proxy->crearBoleto($IDPelicula, $Tipo, $Precio), $IDPelicula, $Tipo, $Precio);
        $IDBoleto = $this->boleto->IDBoleto;
        return $IDBoleto;
    }
}
?>