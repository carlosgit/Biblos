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
            $accion = $_POST['accion'];

            
            switch ($accion) {
                case 1:
                    altausuario($dni, $email, $direccion, $telefono, $nombre_usuario, $clave, $es_administrador, $apellido1, $apellido2, $plantilla_id_plantilla);
                    break;
                case 2:
                    modificarUsuario($dni, $email, $direccion, $telefono, $nombre_usuario, $clave, $es_administrador);
                    break;
                case 3:
                    borrarusuario($dni, $nombre_usuario);
                    break;
                case 4:
                    listarusuario2();
                    break;
                default:
                    echo "Opcion no valida.";
            }
            ?>

        </p>
        <p><a href="menuG.php">Volver a menu</a></p>//boton de retorno

    </body>
</html>