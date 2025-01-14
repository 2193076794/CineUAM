<?php
namespace Modelo\Pago;

class PagoDebito implements PagoTarjeta
{
    public function pagar(float $cantidad): string
    {
        //echo "<br>Estoy en pago debito";
        return "Pago de $cantidad usando tarjeta de debito.";
    }
}
?>
