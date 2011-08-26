<?php
include "funciones.php";
controlSesion();
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
        iniciaBD();
        $tipo_busqueda = $_POST['tipo_busqueda'];
        echo $tipo_busqueda;
        $busqueda = $_POST['busqueda'];
        switch ($tipo_busqueda) {
            case 1:// Buscar por codigo dewey
                $catDewey = substr($busqueda, 0, 3);
                $idApellido = strtoupper(substr($busqueda, 3, 3));
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
