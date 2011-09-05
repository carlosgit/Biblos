<?php
//session_start();
include "../funciones.php";
//controlSesion();
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
        $usuarios = $_SESSION['usuario'];

        echo "Usuario:" . $usuarios['nombre_usuario'];
        $dni = $usuarios['dni'];
        //$dni = $_SESSION['dni'];
        //echo $dni = $_SESSION['dni'];
// $dni = $_POST['dni'];
        //echo $dni;
        //$dni =  $usuarios = $fila['dni'];

        $query = "select * from usuario where dni= '$dni' ";

        //  echo "-" . $query;

        $resultado = mysql_query($query);
        if ($resultado) {
            $fila = mysql_fetch_array($resultado);
            $nombreusuario = $fila['nombre_usuario'];
            $apellido1 = $fila['apellido1_usuario'];
            $apellido2 = $fila['apellido2_usuario'];
            $telefono = $fila['telefono'];
            $direccion = $fila['direccion'];
            $email = $fila['email'];
            $plantilla = $fila['plantilla_id_plantilla'];
            $clave = $fila['clave'];
            $dni = $fila['dni'];
            if ($usuarios = $fila['es_administrador'] == 1) {
                echo "usted usuario administrador";
            }else
                echo "usted usuario lector";

            echo "<h1> perfil de usuario:</h1><p><p>";
            echo "nombre de usuario .$nombreusuario <p>";
            echo "clave: .$clave <p>";
            echo "primer apellido: .$apellido1 <p>";
            echo "segundo apellido: .$apellido2 <p>";
            echo "telefono de contacto: .$telefono<p>";
            echo "direccion: .$direccion<p>";
            echo "email: .$email<p>";
            echo "plantilla css numero: .$plantilla<p>";
        }else
            $usuarios = "Sin usuarios";

        return $usuarios;
        echo "<p><a href='menuG.php'>Volver a menu</a></p>";
        ?>
        <p><a href="menuG.php">Volver a menu</a></p>
    </body>
</html>
