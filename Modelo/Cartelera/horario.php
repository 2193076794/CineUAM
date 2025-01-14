<?php
class horario {
    public $IDHorario;
    public $FechaHora;

    public function __construct($IDHorario, $FechaHora) {
        $this->IDHorario = $IDHorario;
        $this->FechaHora = $FechaHora;
    }

    public function getIDHorario() {
        return $this->IDHorario;
    }

    public function setIDHorario($IDHorario) {
        $this->IDHorario = $IDHorario;
    }

    public function getFechaHora() {
        return $this->FechaHora;
    }

    public function setFechaHora($FechaHora) {
        $this->FechaHora = $FechaHora;
    }
}
?>
