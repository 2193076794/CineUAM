<?php
class Preventa {
    private $pelicula;
    private $horario;
    private $sala;

    public function __construct($pelicula, $horario, $sala) {
        $this->pelicula = $pelicula;
        $this->horario = $horario;
        $this->sala = $sala;
    }

    public function getPelicula() {
        return $this->pelicula;
    }

    public function getHorario() {
        return $this->horario;
    }

    public function getSala() {
        return $this->sala;
    }
}