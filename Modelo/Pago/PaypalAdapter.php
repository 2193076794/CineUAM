<?php
namespace Modelo\Pago;

class PayPalAdapter implements PagoTarjeta
{
    private $pagoPaypal;

    public function __construct(PagoPaypal $pagoPaypal)
    {
        $this->pagoPaypal = $pagoPaypal;
    }

    public function pagar(float $cantidad): string
    {
        return $this->pagoPaypal->enviarPago($cantidad);
    }
}
?>
