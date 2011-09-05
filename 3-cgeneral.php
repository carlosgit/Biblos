<?php
include "./1-funciones.php";
controlSesion();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <h1>Listado general del catalogo.</h1>
        <?php
        // funcion contenida en el archivo funciones.php
        listarCatalogo();
        ?>
    </body>
</html>

<?php




?>