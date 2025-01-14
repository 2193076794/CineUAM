<?php 
require_once '../Controlador/ControladorPago.php';
require_once '../Modelo/Pago/PagoTarjeta.php';
require_once '../Modelo/Pago/PagoCredito.php';
require_once '../Modelo/Pago/PagoDebito.php';
require_once '../Modelo/Pago/PagoPaypal.php';
require_once '../Modelo/Pago/PayPalAdapter.php';
require_once '../Modelo/Pago/GestorPago.php';

// Incluir configuración de PayPal
include_once '../ServiciosExternos/PayPal/config.php';
//require_once '../../Controlador/ControladorPago.php';
use CPago\ControladorPago;
$productName = "Producto demostración";
$currency = "MXN";
$productPrice = 10; // Valor inicial
$productId = 587965;
static $orderNumber = 567;
/*echo "<br>".$orderNumber;

var_dump(ControladorPago::$productos);
var_dump(ControladorPago::$precio);
echo "<br>".ControladorPago::getPrecio();
echo "<br>".ControladorPago::getProductos();
echo"<br>entre a Formulario producto";*/

// Verificar si se ha enviado una cantidad personalizada por el usuario
if (isset($_POST['cantidad'])) {
    $productPrice = $_POST['cantidad'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 50px;
        }
        .payment-container {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        input[type="number"],
        select,
        input[type="text"] {
            width: calc(100% - 22px); /* Calculamos el ancho restando el padding y bordes */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box; /* Hace que el padding y borde se incluyan en el ancho total */
            margin-bottom: 10px;   
        }
        input.pagar {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            text-align: center;
        }
        input.pagar:hover {
            background-color: #218838;
        }
        .paypal-button-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="payment-container">
        <form action="GUIPago/GUIPago.php?action=procesarPago" method="post" >
            <div class="form-group">
                <label id="cantidad">Cantidad de productos: <?php echo ControladorPago::getProductos(); ?></label>
            </div>
            <div class="form-group">
                <label for="Total">Total a pagar: $<?php echo ControladorPago::getPrecio(); ?></label>
                <input type="hidden" id="cantidad" name="cantidad" min="1" value="<?php echo ControladorPago::getPrecio(); ?>" required>
            </div>
            <div class="form-group">
                <label for="metodoPago">Selecciona un método de pago:</label>
            <select id="metodoPago" name="metodoPago" style="width: 100%;" required>
                <option value="" disabled selected>Selecciona</option>
                <option value="Credito">Tarjeta de crédito</option>
                <option value="Debito">Tarjeta de débito</option>
            </select>
            </div>
            <div class="form-group" id="datosTarjeta" style="display: none;">
                <label for="nombreTitular">Nombre del titular:</label>
                <input type="text" id="nombreTitular" name="nombreTitular" required>
                <label for="numeroTarjeta">Número de tarjeta:</label>
                <input type="text" id="numeroTarjeta" name="numeroTarjeta" pattern="\d{16}" title="Debe contener exactamente 16 dígitos" required>
                <label for="fechaVencimiento">Fecha de vencimiento:</label>
                <input type="text" id="fechaVencimiento" name="fechaVencimiento" placeholder="MM/AA" required>
                <label for="cvv">CVV:</label>
                <input type="text" id="cvv" name="cvv" required>
            </div>
            <input type="submit" class="pagar" value="Pagar">
        </form>
        <div class="paypal-button-container">
            <?php include '../ServiciosExternos/PayPal/paypalCheckout.php'; ?>
        </div>
    </div>
    <script>
        // Mostrar campos de datos de tarjeta cuando se seleccione tarjeta de crédito o débito
        document.addEventListener('DOMContentLoaded', function() {
            var metodoPago = document.getElementById('metodoPago');
            var datosTarjeta = document.getElementById('datosTarjeta');
            
            metodoPago.addEventListener('change', function() {
                if (metodoPago.value === 'Credito' || metodoPago.value === 'Debito') {
                    datosTarjeta.style.display = 'block';
                } else {
                    datosTarjeta.style.display = 'none';
                }
            });
        });
    </script>
</body>
</html>
