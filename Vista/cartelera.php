<?php
function mostrarCartelera($funciones) {
    foreach ($funciones as $funcion) {
        echo "Nombre: " . $funcion->getPelicula()->getNombre() . "<br>";
        echo "Sinopsis: " . $funcion->getPelicula()->getSinopsis() . "<br>";
        echo "Duración: " . $funcion->getPelicula()->getDuracion() . "<br>";
        echo "Genero: " . $funcion->getPelicula()->getGenero() . "<br>";
        echo "Imagen: <img src='" . $funcion->getPelicula()->getImagenPelicula() . "'><br>";
        echo "Fecha: " . $funcion->getHorario()->getFecha() . "<br>";
        echo "Hora de Inicio: " . $funcion->getHorario()->getHoraInicio() . "<br>";
        echo "Tipo de Sala: " . $funcion->getSala()->getTipo() . "<br>";
        echo "<br><br>";
    }
}
?>
