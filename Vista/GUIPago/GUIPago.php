<?php

require_once '../../Controlador/ControladorPago.php';
require_once '../../Modelo/Pago/PagoTarjeta.php';
require_once '../../Modelo/Pago/PagoCredito.php';
require_once '../../Modelo/Pago/PagoDebito.php';
require_once '../../Modelo/Pago/PagoPaypal.php';
require_once '../../Modelo/Pago/PayPalAdapter.php';
require_once '../../Modelo/Pago/GestorPago.php';

// Incluir configuración de PayPal
require_once '../../ServiciosExternos/PayPal/config.php';

use CPago\ControladorPago;

$action = $_GET['action'] ?? 'index';
//var_dump($action);

switch ($action) {
    case 'procesarPago':
        ControladorPago::procesarPago();
        break;
    default:
        ControladorPago::index($productos, $precio);
        break;
}
?>
