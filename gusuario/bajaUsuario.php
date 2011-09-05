<?php
include_once "../funciones.php";
include "fusuario.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $dni=$_GET['dni'];
        echo "Baja para el usuario: ".$dni;
        iniciaBD();
        formularioUsuario($dni,false);
        echo "Borrado: ".$dni;
        borrarusuario($dni);
        echo"<br><a href='./index.php'>Gestión usuario</a>";
        ?>
    </body>
</html>
