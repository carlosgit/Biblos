<?php
include_once "../funciones.php";
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
        $dni = $_POST['dni'];
        $clave = $_POST['clave'];
        $nombre = $_POST['nombre_usuario'];
        $apellido1 = $_POST['apellido1_usuario'];
        $apellido2 = $_POST['apellido2_usuario'];
        $direccion = $_POST['direccion'];
        $telefono = $_POST['telefono'];
        $email = $_POST['email'];
        $es_administrador = $_POST['es_administrador'];
        $id_plantilla = $_POST['plantilla_id_plantilla'];


        $query = "UPDATE usuario
            SET clave='$clave', nombre_usuario='$nombre',apellido1_usuario='$apellido1',
            apellido2_usuario='$apellido2',direccion='$direccion',telefono='$telefono',email='$email',
            es_administrador='$es_administrador', plantilla_id_plantilla='$id_plantilla'
             WHERE dni='$dni'";

        // echo $query;

        $resultado = mysql_query($query);
        if ($resultado) {
            if (mysql_affected_rows() == 0) {
                echo ("No hubo moficiacion.");
            } else
                echo "(" . mysql_affected_rows() . ") Modifacion de usuario correcta.";
            echo"<br><a href='./index.php'>Gestión usuario</a>";
        }
        else
            die("Fallo al modificar" . mysql_error());

//        echo "Borrado: ".$dni;
        //      borrarusuario($dni);
        ?>
    </body>
</html>
