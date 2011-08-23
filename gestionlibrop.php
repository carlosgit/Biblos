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
            $id = $_POST['id'];
            $autor = $_POST['autor'];
            $editorial = $_POST['editorial'];
            $nombre = $_POST['nombre'];
            $sinopsis = $_POST['sinopsis'];
            $isbn = $_POST['isbn'];
            $accion = $_POST['accion'];


            if ($accion == 3)
                borrarlibro($id, $nombre);
            if ($accion == 4)
                listartodo($id, $autor, $editorial, $nombre);

//  else
            // if (!$id || !$apellido1 || !$apellido2 || !$nombre || !$accion) {
            //   echo "No has introducido todos los detalles requeridos.<br>"
            //    . "Por favor vuelve e inténtalo de nuevo.";
            //   exit;
            // }
            $id = htmlentities($id);
            $autor = htmlentities($autor);
            $editorial = htmlentities($editorial);
            $nombre = htmlentities($nombre);
            $sinopsis = htmlentities($sinopsis);
            $isbn = htmlentities($isbn);
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
                altalibro($id, $autor, $editorial, $nombre, $sinopsis, $isbn);
            if ($accion == 2)
                modificarlibro($id, $autor, $editorial, $nombre, $sinopsis, $isbn);
            
          
            
            ?>
        </p>
        <p>&nbsp;</p>
        <p><a href="menuG.php">Volver a menu</a></p>//boton de retorno
    </body>
</html>
?>
<?php
controlSesion();
iniciaBD();
?>