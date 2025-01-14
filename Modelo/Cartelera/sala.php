<?php
class sala {
    public $IDSala;
    public $IDSucursal;
    public $Asientos;
    public $Tipo;

    public function __construct($IDSala, $IDSucursal, $Asientos, $Tipo) {
        $this->IDSala = $IDSala;
        $this->IDSucursal = $IDSucursal;
        $this->Asientos = $Asientos;
        $this->Tipo = $Tipo;
    }

    public function getIDSala() {
        return $this->IDSala;
    }

    public function setIDSala($IDSala) {
        $this->IDSala = $IDSala;
    }

    public function getIDSucursal() {
        return $this->IDSucursal;
    }

    public function setIDSucursal($IDSucursal) {
        $this->IDSucursal = $IDSucursal;
    }

    public function getAsientos() {
        return $this->Asientos;
    }

    public function setAsientos($Asientos) {
        $this->Asientos = $Asientos;
    }

    public function getTipo() {
        return $this->Tipo;
    }

    public function setTipo($Tipo) {
        $this->Tipo = $Tipo;
    }
}
?>
