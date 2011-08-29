<html>
    <head>
        <title>Gestión Catalogo</title>
    </head>
    <body>
        <h1>Gestión de Catalogo </h1>
        <p>
            <?php
            include "funciones.php";
            controlSesion();
            iniciaBD();

            $cod_dewey = $_POST['dewey'];
            $autor = $_POST['autor'];
            $titulo = $_POST['titulo'];
            $f_publicacion = $_POST['f_publicacion'];
            $f_adquisicion = $_POST['f_adquisicion'];
            $sinopsis = $_POST['sinopsis'];
            $editorial = $_POST['editorial'];
            $edicion = $_POST['edicion'];
            $num_paginas = $_POST['num_paginas'];
            $isbn = $_POST['isbn'];
            $accion = $_POST['accion'];


            // Tokenizar para separar el codigo de las 3 primeras letras del apellido1 del autor
            // Ejemplo: 000-FOL
            // Separo en $codAutor=0
            // y $Apellido3='FOL'
            $tok = strtok($autor, "-");
            $codAutor = $tok;
            $tok = strtok("-");
            $Apellido3 = $tok;


            switch ($accion) {
                case 1: // Alta
                    altacatalogo($cod_dewey, $Apellido3, $titulo, $f_publicacion, $f_adquisicion, $sinopsis, $editorial, $edicion, $num_paginas, $isbn);
                    break;
                case 2: // Mofificacion
                    modificarcatalogo($cod_dewey, $id_autor, $titulo, $f_publicacion, $f_adquisicion, $sinopsis, $editorial, $edicion, $num_paginas, $isbn);
                    break;
                case 3: // Baja
                    //borrarlibro($cod_dewey,$titulo);
                    break;
                case 4: // Listado completa                   
                    //listartodo($cod_dewey,$titulo, $f_publicacion, $f_adquisicion, $sinopsis, $editorial, $edicion, $num_paginas, $isbn);
                    break;
                default:
                    die("Accion en gestion de catalogo invalida");
            }
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
<?php

function altacatalogo($cod_dewey, $idAutor, $titulo, $f_publicacion, $f_adquisicion, $sinopsis, $editorial, $edicion, $num_paginas, $isbn) {

    $idTitulo = substr($titulo, 0, 3);

    $idApellido = substr(consultaValorDesdeCogigo("autor", "id_autor", "apellido1", "$idAutor"), 0, 3);

    $query = "insert into titulo
        (dewey_id_categoria_dewey,id_apellido,id_titulo, nombre, fecha_publicacion, fecha_adquisicion, sinopsis, numero_paginas, isbn, editorial_id_editorial, edicion)
       values ('$cod_dewey','$idAutor','$idTitulo', '$titulo', '$f_publicacion', '$f_adquisicion', '$sinopsis', '$num_paginas', '$isbn', '1', '$edicion')";
    $resultado = mysql_query($query);
    if ($resultado) {
        echo mysql_affected_rows() . " Alta de libro correcta.";
        header("location:mostrarFichaLibro.php?c1=$cod_dewey&c2=$idAutor&c3=$idTitulo");
    }
    else
        die("Fallo al insertar" . mysql_error());
}

function modificartalogo($cod_dewey, $idAutor, $idTitulo, $titulo, $f_publicacion, $f_adquisicion, $sinopsis, $num_paginas, $isbn, $edicion) {
    $query = "UPDATE titulo
            SET dewey_id_categoria_dewey='$cod_dewey', id_titulo='$idTitulo, 
                nombre='$titulo', fecha_publicacion='$f_publicacion', fecha_adquisicion='$f_adquisicion', 
                sinopsis='$sinopsis', numero_paginas='$num_paginas', isbn='$isbn', editorial_id_editorial='1', 
                edicion='$edicion' WHERE dewey_id_categoria_dewey='$cod_dewey'";

    $resultado = mysql_query($query);
    if (mysql_affected_rows() == 0) {
        echo ("El registro no existe.");
        // altalibro($id,$autor,$editorial,$nombre);
    } else
    if ($resultado)
        echo mysql_affected_rows() . " modifación de libro correcta.";
    else
        die("Fallo al modificar" . mysql_error());
}

function borrarcatalogo($id, $nombre) {
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

/*
  function listarcatalogo() {
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
 */
?>