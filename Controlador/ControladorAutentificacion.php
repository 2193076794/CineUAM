<?php
require_once "../Modelo/Autenticacion/gestorAute.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_REQUEST['op']) && $_REQUEST['op'] == "registra") {
        // Manejo de inserción de usuarios
        if (empty($_POST['txtNombre']) || empty($_POST['txtApellidos']) || empty($_POST['txtCorreo']) || empty($_POST['txtContrasenia'])) {
            $arrResponse = array('status' => false, 'msg' => 'Error de datos');
        } else {
            $strNombre = ucwords(trim($_POST['txtNombre']));
            $strApellidos = ucwords(trim($_POST['txtApellidos']));
            $strCorreo = strtolower(trim($_POST['txtCorreo']));
            $strContrasenia = trim($_POST['txtContrasenia']);
            
            // Crea una instancia del gestor de autenticación
            $gestorAutenticacion = new GestorAutenticacion();

            // Insertar usuario en la base de datos
            $resultadoInsercion = $gestorAutenticacion->insertarUsuario($strNombre, $strApellidos, $strCorreo, $strContrasenia);
            
            if ($resultadoInsercion) {
                //$arrResponse = array('status' => true, 'msg' => 'Usuario registrado correctamente', 'redirect' => '/vista/index.php');
                header("Location: ../Vista/index.php");

            } else {
                $arrResponse = array('status' => false, 'msg' => 'Error al registrar usuario');
            }
        }
        echo json_encode($arrResponse);
    } 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_REQUEST['op']) && $_REQUEST['op'] == "autentica") {
        $strCorreo = $_POST["txtCorreo"];
        $strContrasenia = $_POST["txtContrasenia"];

        // Incluir el modelo
        require_once "../Modelo/Autenticacion/gestorAute.php";

        // Crear una instancia del modelo
        $modeloAutenticacion = new GestorAutenticacion();

        // Llamar al método para autenticar al usuario
        $resultadoAutenticacion = $modeloAutenticacion->autenticarUsuario($strCorreo, $strContrasenia);

        // Devolver una respuesta JSON
        if ($resultadoAutenticacion) {
            header("Location: ../Vista/index.php");
        } else {
            echo json_encode(array("success" => false, "message" => "Credenciales inválidas"));
        }
    }
}
?>
