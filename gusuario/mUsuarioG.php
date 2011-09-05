<?php
include "../funciones.php";
include "fusuario.php";
//controlSesion();

?>

<html>
    <head>
        <title>Librería Online - Gestion de biblioteca </title>
    </head>
    <body>


        <h1>Modificación de usuario</h1>
        <?php
        $dni=$_GET['dni'];
        echo "Mod para el usuario: ".$dni;
        iniciaBD();
        formularioUsuario($dni, TRUE, "Modificar", "musuarioP.php");
        
        
       
        ?>

    </body>
</html>

