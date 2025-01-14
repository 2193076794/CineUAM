<?php
namespace Modelo\Pago;

class PagoCredito implements PagoTarjeta
{
    public function pagar(float $cantidad): string
    {
        //echo "<br>Estoy en pago credito";
        return "Pago de $cantidad usando tarjeta de credito.";
    }
}
?>
