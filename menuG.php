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
        <ul>
            <ul><li>Consultas
                    <ul>
                        <li><a href='cgeneral.php'>Consulta general</a>
                        <li><a href='cespecificaG.php'>Consulta especifica</a>
                    </ul> </ul>                   
            <ul><li>Administración
                    <ul>
                        <li><a href='gestionlibrog.php'>Gestión Catalogo</a>
                        <li><a href='gestionusuario.php'>Gestion Usuario</a>
                    </ul>            

            </ul>
            <li><a href='salir.php'>Log out</a>
        </ul>
    </body>
</html>
