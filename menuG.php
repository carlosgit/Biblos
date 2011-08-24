<?php
include "./funciones.php";
controlSesion();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <h1>MENU</h1>
        <?php
        if (!$_SESSION['usuario'] || !isset($_SESSION['usuario'])) {
            echo "logeate primero";
        } else {
            $usuario = $_SESSION['usuario'];
            echo "Usuario:" . $usuario['nombre_usuario'];
        }
        ?>
        <h1>Opciones</h1>
        <ul><li>Consultas
                <ul>
                    <li><a href='cgeneral.php'>Consulta general</a>
                    <li><a href='cespecificaG.php'>Consulta concreta</a>

                </ul>


                <?php
                // Comprobacion del tipo de usuario
                if ($usuario['es_administrador'] == 1)
                    mostrarOpcionesAdministracion();
                ?>

            <li><a href='salir.php'>Salir</a>
        </ul>
    </ul>
</body>
</html>


<?php

function mostrarOpcionesAdministracion() {
//echo "Es administrador";

    echo("
        <li>Administracion
        <ul>
        <li><a href='gestionlibrog.php'>Gestion Catalogo</a>      
        <li><a href='gestionusuariog.php'>Gestion Usuario</a>        
        </ul>");
}

?>