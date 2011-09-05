<?php
include "1-funciones.php";
//controlSesion();
$usuario = $_SESSION['usuario'];
?>  
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        // Funcion.php inicializacion y conexion 
        iniciaBD();
        // Inicializa una variable obtenida del formulario del HTML cespecificaG.php
        $tipo_busqueda = $_POST['tipo_busqueda'];
        // Muestra la variable
        echo $tipo_busqueda;
        // Inicializa una variable obtenida del formulario del HTML cespecificaG.php
        $busqueda = $_POST['busqueda'];
        // Realizacion de un selector de busqueda mediante un switch
        switch ($tipo_busqueda) {
            case 1:// Buscar por codigo dewey
                $catDewey = substr($busqueda, 0, 3); // Esta Variable extrae de la Variable busqueda los 3 caracteres del 0 hasta el 3 del contenido de la tabla Dewey la base de datos
                 $idLibro = strtoupper(substr($busqueda, 6, 3));
                header("location:mostrarFichaLibro.php?c1=$catDewey&c2=$idApellido&c3=$idLibro");
                break;
            case 2:// Buscar por nombre del libro
                listarCatalogoXCampo("nombre", $busqueda, FALSE);
                break;
            case 3:
                break;
            case 4:
                break;
            default:
        }
 
        ?>
    </body>
</html>
