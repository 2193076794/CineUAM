<?php
require_once '../Modelo/Boleto/GestorBoleto.php';
require_once '../Modelo/Boleto/Boleto.php';

class ControladorBoleto {
    private $boleto;
    private $gestorBoleto;

    function __construct($IDPelicula) {
        $this->gestorBoleto = new GestorBoleto();
        $this->boleto = new Boleto($this->gestorBoleto->crearMostrarBoleto($IDPelicula, "VIP", 300), $IDPelicula, "VIP", 300);
    }

    public function mostrarIDPelícula() {
        return $this->boleto->IDPelicula;
    }

    public function mostrarIDBoleto() {
        return $this->boleto->IDBoleto;
    }

    public function mostrarTipo() {
        return $this->boleto->Tipo;
    }

    public function mostrarPrecio() {
        return $this->boleto->Precio;
    }
}
?>