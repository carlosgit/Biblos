<?php
include "funciones.php";
controlSesion();
$usuario=$_SESSION['usuario'];
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
        $tipo_busqueda = $_POST['tipo_busqueda'];
        echo $tipo_busqueda;
        $busqueda = $_POST['busqueda'];
        
        $query = "select * from titulo where ";

        switch ($tipo_busqueda){
        case 1:$query=$query."titulo_dewey_id_categoria_dewey='";
        break;
        case 2:$query=$query."nombre='";
        break;
        case 3:
        break;
        case 4:
        break;
        default:
        }
        $query=$query."$busqueda'";
        
        echo $query;


        
        $resultado = mysql_query($query);
        if ($resultado) {
            $autor = mysql_fetch_array($resultado);
            echo $autor;
        }
        else
            $autor = "Sin Autor";
        ?>
    </body>
</html>
