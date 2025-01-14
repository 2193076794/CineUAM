<?php
namespace Modelo\Pago;

interface PagoTarjeta
{
    public function pagar(float $cantidad): string;
}
?>
