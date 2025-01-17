<?php
require_once '../Controlador/ControladorPreventa.php';

$controladorPreventa = new ControladorPreventa();
$peliculas = $controladorPreventa->obtenerPeliculas();
$horarios = [];
$sucursales = [];
$seleccion = NULL;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['pelicula'])) {
        $horarios = $controladorPreventa->obtenerHorarios($_POST['pelicula']);
    } elseif (isset($_POST['horario'])) {
        $sucursales = $controladorPreventa->obtenerSucursales($_POST['horario']);
    } elseif (isset($_POST['sucursal'])) {
        $seleccion = [
            'pelicula' => $_POST['pelicula'],
            'horario' => $_POST['horario'],
            'sucursal' => $_POST['sucursal']
        ];
    }
}

// Si ya se hizo una selección, obtener los nombres completos de la película, el horario y la sucursal
if ($seleccion) {
    // Usar los métodos de ProxyPreventa para obtener detalles específicos
    $peliculaSeleccionada = $controladorPreventa->obtenerDetallePelicula($seleccion['pelicula']);
    $horarioSeleccionado = $controladorPreventa->obtenerDetalleHorario($seleccion['horario']);
    $sucursalSeleccionada = $controladorPreventa->obtenerDetalleSucursal($seleccion['sucursal']);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Preventa - Cine UAM</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
    crossorigin="anonymous">
    <link href="../Estilos/Estilo_GUI_principal.css" rel="stylesheet">
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
                    <a class="nav-link mx-lg-2" href="index.php" onclick="GUIFachada.CargarPaginaPrincipal()">INICIO</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-lg-2" href="index.php" onclick="GUIFachada.CargarPaginaPeliculas()">Películas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-lg-2" href="GUIAlimentos.php" onclick="GUIFachada.CargarPaginaAlimentos()">Alimentos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-lg-2" href="GUIzona.php" onclick="GUIFachada.CargarPaginaSucursal()">Ubicación</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-lg-2 active" aria-current="page" href="GUIPreventa.php">Preventas</a>
                </li>
                </ul>
            </div>
            </div>
            <!--<a href="peliculas.php" class="login-button">Login</a>-->
            <a class="login-button" href="login.php" onclick="GUIFachada.cargarPaginaLogin()">Login</a>
            <button class="navbar-toggler pe-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
            <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>
    <!--End Navbar-->

    <!-- Cartelera -->
    <section class="cartelera_section layout_padding">
        <div class="container">
            <h2 class="section_heading text-center mb-5">Cartelera</h2>
            <div class="row g-4">
                <?php
                include_once("../Controlador/ControladorCartelera.php");

                // Instanciar el controlador de la cartelera
                $controladorCartelera = new ControladorCartelera();

                // Obtener las funciones de la cartelera
                $funciones = $controladorCartelera->getFunciones();

                // Mostrar cada función en la cartelera
                foreach ($funciones as $funcion) {
                    echo "<div class='col-md-6 col-lg-4'>";
                    echo "<div class='card h-100'>";
                    echo "<img src='.." . $funcion->getPelicula()->getImagenPelicula() . "' class='card-img-top' alt=''>";
                    echo "<div class='card-body'>";
                    echo "<h5 class='card-title'>" . $funcion->getPelicula()->getNombre() . "</h5>";
                    echo "<p class='card-text'><strong>Género:</strong> " . $funcion->getPelicula()->getGenero() . "</p>";
                    echo "<p class='card-text'><strong>Duración:</strong> " . $funcion->getPelicula()->getDuracion() . " min</p>";
                    echo "</div>";
                    echo "<div class='card-footer text-center'>";
                    echo "<a href='#' class='btn btn-primary'>Comprar Boleto</a>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </section>
    <!-- End Cartelera -->

    <!-- Preventa -->
    <div class="container mt-5">
        <h2 class="text-center mb-4">Preventa de Funciones</h2>
        
        <?php if (!$seleccion): ?>
            <form method="POST" class="shadow p-4 bg-light rounded">
                <?php if (empty($horarios) && empty($sucursales)): ?>
                    <div class="mb-3">
                        <label for="pelicula" class="form-label">Selecciona una película:</label>
                        <select name="pelicula" id="pelicula" class="form-select">
                            <?php foreach ($peliculas as $pelicula): ?>
                                <option value="<?= $pelicula['IDPelicula'] ?>">
                                    <?= $pelicula['Nombre'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Seleccionar</button>
                <?php elseif (!empty($horarios) && empty($sucursales)): ?>
                    <div class="mb-3">
                        <label for="horario" class="form-label">Selecciona un horario:</label>
                        <select name="horario" id="horario" class="form-select">
                            <?php foreach ($horarios as $horario): ?>
                                <option value="<?= $horario['IDHorario'] ?>">
                                    <?= $horario['FechaHora'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Seleccionar</button>
                <?php elseif (!empty($sucursales)): ?>
                    <div class="mb-3">
                        <label for="sucursal" class="form-label">Selecciona una sucursal:</label>
                        <select name="sucursal" id="sucursal" class="form-select">
                            <?php foreach ($sucursales as $sucursal): ?>
                                <option value="<?= $sucursal['IDSucursal'] ?>">
                                    <?= $sucursal['NombreZona'] ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Confirmar Selección</button>
                <?php endif; ?>
            </form>
            <?php else: ?>
        <div class="alert alert-success shadow p-4 rounded" role="alert">
            <h4 class="alert-heading">Selección confirmada</h4>
            <p><strong>Película:</strong> <?= htmlspecialchars($peliculaSeleccionada['Nombre']) ?></p>
            <p><strong>Horario:</strong> <?= htmlspecialchars($horarioSeleccionado['FechaHora']) ?></p>
            <p><strong>Sucursal:</strong> <?= htmlspecialchars($sucursalSeleccionada['NombreZona']) ?></p>
            <hr>
            <form action="../Vista/Boleto.php" method="POST">
                <input type="hidden" name="seleccion" value="<?= htmlspecialchars(serialize($seleccion)) ?>">
                <button type="submit" class="btn btn-success">Proceder al Pago</button>
            </form>
        </div>
    <?php endif; ?>        
</div>
    <!--Fin Preventa -->

    <!-- about section -->
    <section class="about_section layout_padding">
        <div class="container  ">

        <div class="row">
            <div class="col-md-6 ">
            <div class="img-box">
                <img src="../Imagenes/Imagenes_Gui_principal/Palomitas.png" alt="">
            </div>
            </div>
            <div class="col-md-6">
            <div class="detail-box">
                <div class="heading_container">
                <h2>
                    Menu tradicional
                </h2>
                </div>
                <p>
                    Disfruta de todos los alimentos y bebidas que tanto te encantan
                    para vivir al maximo tu experiencia en nuestras salas.
                </p>
                <a href="">
                Comprar
                </a>
            </div>
            </div>
        </div>
        </div>
    </section>
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
                        <h6>Quick Links</h6>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Movies</a></li>
                            <li><a href="#">Showtimes</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- Section: Links -->
    </footer>
    <!-- End Footer -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
