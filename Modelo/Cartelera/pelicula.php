<?php
class pelicula {
    public $IDPelicula;
    public $Nombre;
    public $Sinopsis;
    public $Duracion;
    public $ImagenPelicula;
    public $Genero;
    public $Estado;

    public function __construct($IDPelicula, $Nombre, $Sinopsis, $Duracion, $ImagenPelicula, $Genero, $Estado) {
        $this->IDPelicula = $IDPelicula;
        $this->Nombre = $Nombre;
        $this->Sinopsis = $Sinopsis;
        $this->Duracion = $Duracion;
        $this->ImagenPelicula = $ImagenPelicula;
        $this->Genero = $Genero;
        $this->Estado = $Estado;
    }

    public function getIDPelicula() {
        return $this->IDPelicula;
    }

    public function setIDPelicula($IDPelicula) {
        $this->IDPelicula = $IDPelicula;
    }

    public function getNombre() {
        return $this->Nombre;
    }

    public function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }

    public function getSinopsis() {
        return $this->Sinopsis;
    }

    public function setSinopsis($Sinopsis) {
        $this->Sinopsis = $Sinopsis;
    }

    public function getDuracion() {
        return $this->Duracion;
    }

    public function setDuracion($Duracion) {
        $this->Duracion = $Duracion;
    }

    public function getImagenPelicula() {
        return $this->ImagenPelicula;
    }

    public function setImagenPelicula($ImagenPelicula) {
        $this->ImagenPelicula = $ImagenPelicula;
    }

    public function getGenero() {
        return $this->Genero;
    }

    public function setGenero($Genero) {
        $this->Genero = $Genero;
    }

    public function getEstado() {
        return $this->Estado;
    }

    public function setEstado($Estado) {
        $this->Estado = $Estado;
    }
}
?>
