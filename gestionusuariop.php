<html>
    <head>
        <title>gestion biblioteca</title>
    </head>
    <body>
        <h1>gestion de libros </h1>
        <p>
            <?php
            include "funciones.php";
            controlSesion();
            iniciaBD();
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


            if ($accion == 3)
                borrarusuario($dni, $nombre_usuario);
            if ($accion == 4)
                listarusuario ($dni, $nombre, $direccion, $nombre);

//  else
            // if (!$dni || !$apellido1 || !$apellido2 || !$nombre || !$accion) {
            //   echo "No has introducido todos los detalles requeridos.<br>"
            //    . "Por favor vuelve e inténtalo de nuevo.";
            //   exit;
            // }
            //$dni = htmlentities($dni);
            //$email = htmlentities($email);
            //$direccion = htmlentities($direccion);
            //$telefono = htmlentities($telefono);
            // $nombre_usuario = htmlentities($nombre_usuario);

            @ $sgbd = mysql_pconnect("localhost", "root", "");
            if (!$sgbd) {
                echo "Error: No se puede conectar a la base de datos. Por favor inténtalo de nuevo.";
                exit;
            }
            $db = mysql_select_db("biblos-g1");
            if (!$db) {
                echo "Error: No se puede conectar a la base de datos. Por favor inténtalo de nuevo.";
                exit;
            }
            if ($accion == 1)
                altausuario($dni, $email, $direccion, $telefono, $nombre_usuario, $clave, $es_administrador, $apellido1, $apellido2, $plantilla_id_plantilla);
            if ($accion == 2)
                modificarusuario($dni, $email, $direccion, $telefono, $nombre_usuario, $clave, $es_administrador);
            ?>
        </p>
        <p>&nbsp;</p>
        <p><a href="menuG.php">Volver a menu</a></p>//boton de retorno
    </body>
</html>
?>
<?php
 function listarusuario() {
$query = "select * from usuario";
    //          (id,autor,editorial,nombre)
    // values ($id,'$autor','$editorial','$nombre')";
    $resultado = mysql_query($query);
    echo "Numero de usuario:" . mysql_num_rows($resultado) . "<p>";

    echo"<table border=1>";
    echo"<th>Codigo</th>
                        <th>Titulo</th>
                        <th>Autor</th>\n";
  }
?>