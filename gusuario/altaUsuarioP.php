<?php
include_once "../funciones.php";
include "fusuario.php";

//controlSesion();
?>

<html>
    <head>
        <title>Biblos</title>
    </head>
    <body>
        <h1>Gesti&oacute;n Usuarios</h1>
        <p>
            <?php

            $dni = $_POST['dni'];
            $email = $_POST['email'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $nombre_usuario = $_POST['nombre_usuario'];
            $clave = $_POST['clave'];
            $es_administrador = $_POST['es_administrador'];
            $apellido1 = $_POST['apellido1_usuario'];
            $apellido2 = $_POST['apellido2_usuario'];
            $plantilla_id_plantilla = $_POST['plantilla_id_plantilla'];
            
            altausuario($dni, $email, $direccion, $telefono, $nombre_usuario, $clave, $es_administrador, $apellido1, $apellido2, $plantilla_id_plantilla);
            ?>

            <br><a href='./index.php'>Gestión usuario</a>

    </body>
</html>