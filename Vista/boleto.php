<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cine UAM</title>
    <!--Bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
    crossorigin="anonymous">
    <link href="../Estilos/Estilo_GUI_principal.css" rel="stylesheet"> 
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
     integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
     <script src="../Controlador/Fachada_GUI.js"></script>
</head>
<body>
    <!--NavBar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand me-auto" href="#" onclick="GUIFachada.CargarPaginaPrincipal()">🍿CineUAM</a>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">🍿CineUAM</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                <li class="nav-item">
                    <a class="nav-link mx-lg-2" aria-current="page" href="#" onclick="GUIFachada.CargarPaginaPrincipal()">INICIO</a>
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
                <li class="nav-item">
                    <a class="nav-link mx-lg-2" href="#" onclick="GUIFachada.CargarPaginaPreventa()">Preventas</a>
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

    <style>
    .boleto-container {
        margin-top: 80px; /* Deja espacio para el navbar */
        display: flex;
        justify-content: center;
        align-items: center;
        height: calc(100vh - 80px); /* Ajusta la altura para el espacio del navbar */
    }
    .boleto {
        border: 2px dashed #333;
        padding: 20px;
        width: 300px;
        background-color: #f9f9f9;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }
    .boleto h2 {
        margin-bottom: 20px;
    }
    .boleto p {
        margin: 5px 0;
    }
</style>

<div class="boleto-container">
    <?php
    include_once "../Controlador/ControladorBoleto.php";
    $seleccion = unserialize($_POST['seleccion']);
    $controladorBoleto = new ControladorBoleto($seleccion['pelicula']);
    $IDBoleto = $controladorBoleto->mostrarIDBoleto();
    $IDPelicula = $seleccion['pelicula'];
    $horario = $seleccion['horario'];
    $sucursal = $seleccion['sucursal'];
    ?>
    <div class="boleto">
        <h2>Boleto</h2>
        <h3>CineUAM</h3>
        <p><strong>ID Boleto:</strong> <?php echo htmlspecialchars($IDBoleto); ?></p>
        <p><strong>ID Película:</strong> <?php echo htmlspecialchars($IDPelicula); ?></p>
        <p><strong>Horario:</strong> <?php echo htmlspecialchars($horario); ?></p>
        <p><strong>Sucursal:</strong> <?php echo htmlspecialchars($sucursal); ?></p>
        <p><strong>¡Gracias por tu compra!</strong></p>

    </div>
</div>

  <!-- end about section -->
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
            © 2025 Copyright:
            <a href="index.php" class="footer-link">CineUAM</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
</body>
</html>
