<?php
namespace Modelo\Pago;

class PagoPaypal
{
    public function enviarPago(float $cantidad): string
    {
        return "Pago de $cantidad usando paypal.";
    }
}
?>
