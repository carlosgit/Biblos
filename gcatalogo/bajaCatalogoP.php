<?php
/**
 * En este fichero podedos dar de baja un titulo de la base de datos
 * @author Carlos
 * @version 1.0
 */
include "../1-funciones.php";
?>
<!--
To change this template, choose Tools | Templates
and open the template in the editor.
-->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $nombre_titulo = $_POST['nombre_titulo'];
        $cod_dewey = $_POST['dewey'];
        $dewey_titulo = strtoupper($_POST['dewey_titulo']);
        $dewey_autor = strtoupper($_POST['dewey_autor']);
        $tipo_baja = $_POST['tipo_baja'];

        $consultaAutores = "delete from titulo_has_autor where titulo_dewey_id_categoria_dewey='$cod_dewey' AND titulo_id_apellido='$dewey_autor' AND titulo_id_titulo='$dewey_titulo'";

        switch ($tipo_baja) {
            case 1:
                $consultaT = "delete from titulo where nombre='$nombre_titulo'";
                break;
            case 2:
                $consultaT = "delete from titulo where dewey_id_categoria_dewey='$cod_dewey' AND id_apellido='$dewey_autor' AND id_titulo='$dewey_titulo'";
                break;
            default:
                echo "Opcion de baja no correcta.<a href='../3-menuG.php'> Menu</a>";
        }


        iniciaBD();

        echo $consultaT;

        //Primero lanzo la query para borrar los autores de la tabala "autor_has_autor"
        $resultado = mysql_query($consultaAutores);
        if ($resultado) { // Si el borrado de autores fue correcto
            // Lanzo la query para borrar el titulo en cuestion
            $resultado = mysql_query($consultaT);
            if ($resultado) {
                $afectados = mysql_affected_rows();
                if ($afectados > 0)
                    echo "Borrado correcto ($afectados)";
                else
                    echo "No existe el libro en cuesti&oacute;n ($afectados)";
            }
            else {
                echo "Fallo en borrado de titulo:" . mysql_error();
            }
        }
        else
            echo "Fallo en borrado de autores:" . mysql_error();
        echo "<a href='menuG.php'> Menu</a>";
        ?>
    </body>
</html>