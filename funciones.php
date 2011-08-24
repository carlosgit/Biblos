<?php

session_start();

function controlSesion() {

//include "altalibro_p.php";

    if (!$_SESSION['usuario'] || !isset($_SESSION['usuario'])) {
        header("location:indexG.php");
    }
}

function iniciaBD() {
    $sgbd = mysql_pconnect("localhost", "root", "");
    if (!$sgbd)
        die("fallo al conectar a sgbd");
    $db = mysql_select_db("biblos-g1");
    if (!$db)
        die("fallo al conectar a $sgbd");
}

function obtenerAutores($cat_dewey, $id_apellido, $id_titulo) {
    iniciaBD();

    $query = "select nombre_autor,apellido1, apellido2 from titulo_has_autor, autor where 
        titulo_dewey_id_categoria_dewey='$cat_dewey' and
    titulo_id_apellido='$id_apellido' and
    titulo_id_titulo='$id_titulo' AND 
    autor_id_autor=id_autor";

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
            echo "-$i:" . $autores[$i];
            $i++;
        }
        $numAutores = mysql_num_rows($resultado);
        if ($numAutores == 0)
            $autores[0] = "Sin autor";
//        echo "Numero de libros:".mysql_num_rows($resultado);

        return $autores;
    }else {
        $autores[0] = "Fallo en la consulta autores";
        return $autores;
    }
}

function obtenerEditorial($id_editorial) {
    iniciaBD();

    $query = "select nombre_editorial from editorial where 
        id_editorial='$id_editorial'";

    echo "-" . $query;

    $resultado = mysql_query($query);
    if ($resultado) {
        $fila = mysql_fetch_array($resultado);
        $editorial = $fila['nombre_editorial'];
    }else
        $editorial = "Sin editorial";

    return $editorial;
}

function formmenuespecifico() {
    echo "
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

function listarCatalogo() {
    iniciaBD();

    $query = "select * from titulo";
    //          (id,autor,editorial,nombre)
    // values ($id,'$autor','$editorial','$nombre')";
    $resultado = mysql_query($query);
    echo "Numero de títulos:" . mysql_num_rows($resultado) . "<p>";

    echo"<table border=1>";
    echo"<th>Codigo</th>
                        <th>Titulo</th>
                        <th>Autor</th>\n";
    if ($resultado) {
        while ($titulo = mysql_fetch_array($resultado)) {
            // Saco en variables el codigo completo del libro
            $cat_dewey = $titulo['dewey_id_categoria_dewey'];
            $id_apellido = $titulo['id_apellido'];
            $id_titulo = $titulo['id_titulo'];
            echo "<tr>";
            echo "<td><a href='mostrarFichaLibro.php?c1=$cat_dewey&c2=$id_apellido&c3=$id_titulo'>" .
            $cat_dewey .
            "" . strtoupper($id_apellido) .
            "" . strtoupper($id_titulo) . "</a></td>";
            echo "<td>" . htmlentities($titulo['nombre']) . "</td>";

            $autores = obtenerAutores($cat_dewey, $id_apellido, $id_titulo);
            echo "<td><ul>";
            foreach ($autores as $autor) {
                echo "<li>" . $autor;
            }
            echo "</ul></td>";
            echo "<tr>\n";
        }
        echo"</table>";
    }

    else
        die("Fallo al listar") . mysql_error();
}

function altalibro($id, $autor, $editorial, $nombre, $sinopsis, $isbn) {
    $query = "insert into titulo
                (dewey_id_categoria_dewey,id_apellido,editorial_id_editorial,nombre,sinopsis,isbn)
       values ($id,'$autor','$editorial','$nombre','$sinopsis',$isbn)";
    $resultado = mysql_query($query);
    if ($resultado)
        echo mysql_affected_rows() . " Alta de libro correcta.";
    else
        die("Fallo al insertar") . mysql_error();
}

function modificarlibro($id, $autor, $editorial, $nombre, $sinopsis, $isbn) {
    $query = "UPDATE titulo
            SET  id_apellido='$autor',editorial_id_editorial='$editorial',nombre='$nombre',sinopsis='$sinopsis', isbn=$isbn WHERE dewey_id_categoria_dewey=$id";
    $resultado = mysql_query($query);
    if (mysql_affected_rows() == 0) {
        echo ("El registro no existe.");
        // altalibro($id,$autor,$editorial,$nombre);
    } else
    if ($resultado)
        echo mysql_affected_rows() . " modifacion de libro correcta.";
    else
        die("Fallo al modificar" . mysql_error());
}

function borrarlibro($id, $nombre) {
    @ $sgbd = mysql_pconnect("localhost", "root", "");
    $db = mysql_select_db("biblos-g1");
    $query = "DELETE FROM titulo WHERE dewey_id_categoria_dewey=$id AND nombre='$nombre'";
    $resultado = mysql_query($query);
    if (mysql_affected_rows() == 0)
        echo ("El registro que quiere borrar no existe.");
    else
    if ($resultado)
        echo "Se han borrado" . mysql_affected_rows() . " libro correctamente";
    else
        die("Fallo al borrar el registro" . mysql_error());
}

function listartodo() {
    $sgbd = mysql_pconnect("localhost", "root", "");
    $db = mysql_select_db("biblos-g1");
    $query = "select * from titulo";
    listarCatalogo();
    //          (id,autor,editorial,nombre)
    // values ($id,'$autor','$editorial','$nombre')";
    //       $resultado = mysql_query($query);
    //      if ($resultado){
    //           while($titulo = mysql_fetch_array($resultado)){
    //          echo "Titulo:".$titulo['nombre'];
    //         }
    //         echo mysql_affected_rows() . " Alta de libro correcta.";
    //    }
    //     else
    //        die("Fallo al listar"). mysql_error();
}

function listarCatalogoXCampo($campoBusqueda, $valorBusqueda, $isExact) {


    $query = "select * from titulo where $campoBusqueda ";
    if ($isExact == TRUE)
        $query = $query . "= '$valorBusqueda'";
    else
        $query = $query . "like '%$valorBusqueda%'";
    // (id,autor,editorial,nombre)
    // values ($id,'$autor','$editorial','$nombre')";
    $resultado = mysql_query($query);
    $numTitulos = mysql_num_rows($resultado);

    if ($numTitulos == 0)
        echo "No hay titulos";
    else {

        echo"<table border=1>";
        echo"<th>Codigo</th>
            <th>Titulo</th>
            <th>Autor</th>\n";
        if ($resultado) {
            while ($titulo = mysql_fetch_array($resultado)) {
                // Saco en variables el codigo completo del libro
                $cat_dewey = $titulo['dewey_id_categoria_dewey'];
                $id_apellido = $titulo['id_apellido'];
                $id_titulo = $titulo['id_titulo'];
                echo "<tr>";
                echo "<td><a href='mostrarfichalibro.php?c1=$cat_dewey&c2=$id_apellido&c3=$id_titulo'>" .
                $cat_dewey .
                "" . strtoupper($id_apellido) .
                "" . strtoupper($id_titulo) . "</a></td>";
                echo "<td>" . htmlentities($titulo['nombre']) . "</td>";

                $autores = obtenerAutores($cat_dewey, $id_apellido, $id_titulo);
                echo "<td><ul>";
                foreach ($autores as $autor) {
                    echo "<li>" . $autor;
                }
                echo "</ul></td>";
                echo "<tr>\n";
            }
            // echo "<tr><td>Numero de titulos: $numTitulos</td></tr>";
            echo "<legend>Numero de titulos: $numTitulos</legend>";
            echo"</table>";
        }

        else
            die("Fallo al listar") . mysql_error();
    }
}
function borrarusuario($dni, $nombre_usuario) {
    //controlSesion();
    //iniciaBD();
    //@ $sgbd = mysql_pconnect("localhost", "root", "");
    //$db = mysql_select_db("biblos-g1");
    $query = "DELETE FROM usuario WHERE dni=$dni AND nombre_usuario='$nombre_usuario'";
    $resultado = mysql_query($query);
    if (mysql_affected_rows() == 0)
        echo ("El usuario que quiere borrar no existe.");
    else
    if ($resultado)
        echo "Se ha borrado" . mysql_affected_rows() . " usuario: .$nombre_usuario correctamente";
    else
        die("Fallo al borrar el registro" . mysql_error());
}

function altausuario($dni, $email, $direccion, $telefono, $nombre_usuario, $clave, $es_administrador, $apellido1, $apellido2, $plantilla_id_plantilla) {
    //include "funciones.php";
    //iniciaBD();
    //controlSesion();
    $query = "insert INTO usuario
                (dni, email, direccion, telefono, nombre_usuario, clave, es_administrador, apellido1_usuario, apellido2_usuario, plantilla_id_plantilla)
       values ($dni, $email, $direccion, $telefono, $nombre_usuario, $clave, $es_administrador, $apellido1, $apellido2, $plantilla_id_plantilla)";
    $resultado = mysql_query($query);
    if ($resultado)
        echo mysql_affected_rows() . " Alta de usuario correcta. Bienvenido .$nombre_usuario";
    else
        die("Fallo al insertar") . mysql_error();
}
?>