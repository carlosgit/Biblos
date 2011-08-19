<?php

function controlSesion() {
    session_start();
//include "altalibro_p.php";

    if (!$_SESSION['usuario'] || !isset($_SESSION['usuario'])) {
        header("location:indexG.php");
    }
}


function iniciaBD(){
    $sgbd = mysql_pconnect("localhost", "root", "");
     if (!$sgbd) echo "fallo al conectar a sgbd"; 
    $db = mysql_select_db("biblos-g1");
     if (!$db) echo "fallo al conectar a $sgbd"; 
}

function obtenerAutores($cat_dewey, $id_apellido, $id_titulo) {
    iniciaBD();

    $query = "select nombre_autor,apellido1, apellido2 from titulo_has_autor, autor where 
        titulo_dewey_id_categoria_dewey='$cat_dewey' and
    titulo_id_apellido='$id_apellido' and
    titulo_id_titulo='$id_titulo'
    and id_autor=autor_id_autor";

    //echo $query;
    //          (id,autor,editorial,nombre)
    // values ($id,'$autor','$editorial','$nombre')";
    $resultado = mysql_query($query);
    if ($resultado) {
        $i = 0;
        while ($autor = mysql_fetch_array($resultado)) {
            $autor_nombre = htmlentities($autor['nombre_autor']);
            $autor_apellido1 = htmlentities($autor['apellido1']);
            $autor_apellido2 = htmlentities($autor['apellido2']);


            $autores[$i] = $autor_apellido1 . " " . $autor_apellido2 . ", " . $autor_nombre;
            $i++;
        }
    }else
        $autores[0] = "Sin autor";

    return $autores;
}





function obtenerEditorial($id_editorial) {
    iniciaBD();

    $query = "select nombre_editorial from editorial where 
        id_editorial='$id_editorial'";
    
    echo "-".$query;

    $resultado = mysql_query($query);
    if ($resultado) {       
        $fila= mysql_fetch_array($resultado);
        $editorial = $fila['nombre_editorial'];
        
    }else
        $editorial = "Sin editorial";

    return $editorial;
}
function formmenuespecifico() {
echo  "
    <html>
    <head>
        <title>Busqueda libro</title>
    </head>
    <body>
        <h1>Busqueda libro</h1>
        <form action='cespecifica.php' method='post'>
            Elige titulo:<br>
            <select name='tipobusqueda'>
                <option value='1'>titulo
                <option value='2'>Nombreautor
                <option value='3'>codewey   
            </select>
            <br>
            Buscar:<br>
            <input name='busca' type=text>
            <br>
            <input type=submit value='Buscar'>
        </form>
    </body>
</html> ";
}

?>
