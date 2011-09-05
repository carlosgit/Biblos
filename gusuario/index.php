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
        <h1>Aministracion de usuarios</h1>
        <table border=1>
            <th>M</th><th>B</th>
            <th>dni</th><th>clave</th>
            <th>Nombre</th><th>Apellido1 </th><th>apellido2 </th>
            <th>direccion</th>
            <th>telefono</th> <th>email</th> <th>Adm?</th> <th>Plantilla</th>
            <?php
            rellenaUsuariosConOpciones();
            ?>
        </table>
        <br><a href='altaUsuarioG.php'><<img src='../imagen/cruzverde.jpg' width="2%">Alta de usuario</a>
        
        <br><a href='../menuG.php'> Menu</a>
    </body>
</html>
