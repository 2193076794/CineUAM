<?php
//0123456789123456
namespace CPago;

use Modelo\Pago\GestorPago;

class ControladorPago
{
    public static $productos=array();
    public static $precio=40;

    public function __construct($productos, $precio) {
        self::$productos=$productos;
        self::$precio=$precio;
    }
    public static function index($productos, $precio)
    {
        self::$productos=$productos;
        self::$precio=$precio;
        include_once ("GUIPago/FormularioPago.php");
    }

    public static function procesarPago()
    {
        $cantidad = $_POST['cantidad'] ?? 0; 
        $metodoPago = $_POST['metodoPago'] ?? '';

        if (!empty($cantidad) && !empty($metodoPago)) {
            try {
                $pago = GestorPago::obtenerPago($metodoPago);
                $resultado = $pago->pagar($cantidad);
                require_once 'C:\apache\htdocs\CineUam\Vista\GUIPago\PagoRealizado.php';
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        } else {
            echo "Metodo de pago y cantidad son necesarios";
        }
    }

    public static function getProductos(){
        return self::$productos;
    }
    public static function getPrecio(){
        return self::$precio;
    }
}
?>
