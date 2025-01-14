<?php
// Clase FuncionCine
class FuncionCine {
    public pelicula $pelicula;
    public horario $horario;
    public sala $sala;

    public function __construct($pelicula, $horario, $sala) {
        $this->pelicula = $pelicula;
        $this->horario = $horario;
        $this->sala = $sala;
    }

    public function getPelicula() {
        return $this->pelicula;
    }

    public function setPelicula($pelicula) {
        $this->pelicula = $pelicula;
    }

    public function getHorario() {
        return $this->horario;
    }

    public function setHorario($horario) {
        $this->horario = $horario;
    }

    public function getSala() {
        return $this->sala;
    }

    public function setSala($sala) {
        $this->sala = $sala;
    }
}
?>
