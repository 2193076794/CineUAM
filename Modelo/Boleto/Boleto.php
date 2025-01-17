<?php
class Boleto {
    public $IDBoleto, $IDPelicula, $Tipo, $Precio;

    public function __construct($IDBoleto, $IDPelicula, $Tipo, $Precio) {
        $this->IDBoleto = $IDBoleto;
        $this->IDPelicula = $IDPelicula;
        $this->Tipo = $Tipo;
        $this->Precio = $Precio;
    }
}
?>