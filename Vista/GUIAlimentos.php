<?php
require_once("..\Controlador\CAlimentos.php");
require_once '../Controlador/ControladorPago.php';
use CPago\ControladorPago;
$controlador = new CAlimentos();
static $orderNumber = 567;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cine UAM</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
    crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons'>
<link href="../Estilos/Estilo_GUI_principal.css" rel="stylesheet">
<link rel="stylesheet" href="../Estilos/Estilo_GUI_Alimentos.css">
<link rel="stylesheet" href="../Estilos/EstilosCajas.css">
</head>
<body>
    <!--NavBar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand me-auto" href="#">🍿CineUAM</a>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">🍿CineUAM</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                <li class="nav-item">
                <a class="nav-link mx-lg-2" href="#" onclick="GUIFachada.CargarPaginaPrincipal()">INICIO</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mx-lg-2" href="#" onclick="GUIFachada.CargarPaginaPrincipal()">Peliculas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mx-lg-2" href="#" onclick="GUIFachada.CargarPaginaAlimentos()">Alimentos</a>
            </li>
                <li class="nav-item">
                    <a class="nav-link mx-lg-2" href="#" onclick="GUIFachada.CargarPaginaSucursal()">Ubicacion</a>
                </li>
                </ul>
            </div>
            </div>
            <!--<a href="peliculas.php" class="login-button">Login</a>-->
            <a class="login-button" href="#" onclick="GUIFachada.cargarPaginaLogin()">Login</a>
            <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <!--End Navbar-->
<body>
    <div class="container_alimentos">
            
        <section>
        <!-- Galeria de combos -->
            <div class="ElegirAlimentos">
                <!-- Botones -->
                <form method="post">
                    <input type="submit" name="btnAlimentos" value="Alimentos" class="color-button">
                </form>
                <form method="post">
                    <input type="submit" name="btnCombos" value="Combos" class="color-button">
                </form>
                <form method="post">
                    <?php
                    echo '<input type="submit" name="btnCarrito" value="Carrito" class="color-button">';
                    ?>
                </form>
            </div>
                
            <?php
            
            if(isset($_POST['btnAlimentos'])){
                $controlador->botonAlimentos();
            }
            if(isset($_POST['btnCombos'])){
                $controlador->botonCombos();
            }
            
            if(isset($_POST['btnCarrito'])){
                echo '<div class="tabla">';
                    echo '<table style="width: 100%">';
                        $controlador = $controlador->botonCarrito();
                        //var_dump($controlador->gestor);
                        echo '<tfoot>';
                            echo '<tr>';
                                echo '<td><strong>Total</strong></td>';
                                echo '<td><strong></strong></td>';
                                echo '<td>$';
                                    echo number_format($controlador->gestor->carrito->getPrecioTotal(), 2);
                                echo '</td>';
                                echo '<td>';
                                    echo '<form method="post">';
                                        echo '<input type="hidden" name="productos" value="' . $controlador->gestor->carrito->getNumProductos() . '" >';
                                        echo '<input type="hidden" name="precio" value="' . $controlador->gestor->carrito->getPrecioTotal() . '" >';
                                        echo '<input type="submit" name="pagar" value="Pagar" class="button-pagar">';
                                    echo '</form>';
                                echo '</td>';
                            echo '</tr>';
                        echo '</tfoot>';
                        //echo '<td>'.$this->numProductos.'</td>';
                    echo '</table>';
                echo '</div>'; 
            }
            if(isset($_POST['EliminarCarrito'])){
                echo '<div class="tabla">';
                    echo '<table style="width: 100%">';
                $IDProducto = trim($_POST['id']);
                $controlador->botonEliminar($IDProducto);
                        echo '<tfoot>';
                            echo '<tr>';
                                echo '<td><strong>Total</strong></td>';
                                echo '<td><strong></strong></td>';
                                echo '<td>$';
                                    echo number_format($controlador->gestor->carrito->getPrecioTotal(), 2);
                                echo '</td>';
                                echo '<td>';
                                    echo '<form method="post">';
                                        echo '<input type="hidden" name="productos" value="' . $controlador->gestor->carrito->getNumProductos() . '" >';
                                        echo '<input type="hidden" name="precio" value="' . $controlador->gestor->carrito->getPrecioTotal() . '" >';
                                        echo '<input type="submit" name="pagar" value="Pagar" class="button-pagar">';
                                    echo '</form>';
                                echo '</td>';
                            echo '</tr>';
                        echo '</tfoot>';
                        //echo '<td>'.$this->numProductos.'</td>';
                    echo '</table>';
                echo '</div>'; 
            }
            if(isset($_POST['OrdenAlimento'])){
                echo '<div class="tabla">';
                    echo '<table style="width: 100%">';
                if(trim($_POST['tipo']) == "combo"){
                    $IDProducto = trim($_POST['id']);
                    $controlador = $controlador->botonAnadir("combo", $IDProducto);
                }
                if(trim($_POST['tipo']) == "alimento"){
                    $IDProducto = trim($_POST['id']);
                    $controlador = $controlador->botonAnadir("alimento", $IDProducto);
                    var_dump($controlador->gestor->carrito->getNumProductos());
                }
                        echo '<tfoot>';
                            echo '<tr>';
                                echo '<td><strong>Total</strong></td>';
                                echo '<td><strong></strong></td>';
                                echo '<td>$';
                                    echo number_format($controlador->gestor->carrito->getPrecioTotal(), 2);
                                echo '</td>';
                                echo '<td>';
                                    echo '<form method="post">';
                                        echo '<input type="hidden" name="productos" value="' . $controlador->gestor->carrito->getNumProductos() . '" >';
                                        echo '<input type="hidden" name="precio" value="' . $controlador->gestor->carrito->getPrecioTotal() . '" >';
                                        echo '<input type="submit" name="pagar" value="Pagar" class="button-pagar">';
                                    echo '</form>';
                                echo '</td>';
                            echo '</tr>';
                        echo '</tfoot>';
                        //echo '<td>'.$this->numProductos.'</td>';
                    echo '</table>';
                echo '</div>'; 
            }
            if(isset($_POST['pagar'])){
                $productos = array();
                $productos = trim($_POST['productos']);
                $precio = trim($_POST['precio']);
                //$controlador->botonEliminar($productos, $precio);
                $controlador = new ControladorPago($productos, $precio);
                ControladorPago::index($productos, $precio);
            }
            ?>
            
            <?php
     
    ?>
        <section>
        
    </div>
    
    <!-- Footer -->

<footer class="footer">
        <!-- Section: Social media -->
        <section class="social-media">
            <div class="social-media-content">
                <span>Mantente conectado a nosotros en nuestras redes sociales</span>
            </div>
            <div class="footer_social">
              <a href="">
                <i class="fa fa-facebook" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-twitter" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-linkedin" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-instagram" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-pinterest" aria-hidden="true"></i>
              </a>
            </div>
        </section>
        <!-- Section: Social media -->

        <!-- Section: Links  -->
        <section class="footer-links">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-3">
                        <h6>🍿CineUAM</h6>
                        <hr class="footer-hr">
                        <p>"Sumérgete en la magia del cine: donde los sueños cobran vida."</p>
                    </div>
                    <div class="col-md-2 ">
                        <h6>Mejora tu experiencia</h6>
                        <hr class="footer-hr">
                        <p><a href="#!" class="footer-link">Sugerencias</a></p>
                        <p><a href="#!" class="footer-link">Comentarios</a></p>
                        <p><a href="#!" class="footer-link">Ayuda</a></p>
                    </div>
                    <div class="col-md-4 ">
                        <h6>Contactanos!</h6>
                        <hr class="footer-hr">
                        <p><i class="fas fa-home mr-3"></i> CDMX, UAMcita #1230, México</p>
                        <p><i class="fas fa-envelope mr-3"></i> info@CineUAM.com</p>
                        <p><i class="fas fa-phone mr-3"></i> 55 232 567 88</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Copyright -->
        <div class="copyright">
            © 2024 Copyright:
            <a href="index.php" class="footer-link">CineUAM</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
     <!--Bootstrap Js -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
     integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
     <script src="../Controlador/Fachada_GUI.js"></script>
     </div>
</body>
</html>
