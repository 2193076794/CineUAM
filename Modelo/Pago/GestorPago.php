<?php
namespace Modelo\Pago;

class GestorPago
{
    public static function obtenerPago(string $metodoPago)
    {
        switch ($metodoPago) {
            case 'Credito':
                return new PagoCredito();
            case 'Debito':
                return new PagoDebito();
            case 'Paypal':
                $pagoPaypal = new PagoPaypal();
                return new PayPalAdapter($pagoPaypal);
            default:
                throw new \Exception("Metodo de pago invalido.");
        }
    }
}
?>
