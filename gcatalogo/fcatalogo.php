<?php

function altacatalogo($cod_dewey, $idAutor, $titulo, $f_publicacion, $f_adquisicion, $sinopsis, $editorial, $edicion, $num_paginas, $isbn, $autores) {

    $idTitulo = strtoupper(substr($titulo, 0, 3));

    $idApellido = strtoupper(substr(consultaValorDesdeCogigo("autor", "id_autor", "apellido1", "$idAutor"), 0, 3));
    

    $query = "insert into titulo
                     (dewey_id_categoria_dewey,id_apellido,id_titulo, nombre, fecha_publicacion, fecha_adquisicion, sinopsis, numero_paginas, isbn, editorial_id_editorial, edicion)
              values ('$cod_dewey','$idAutor','$idTitulo', '$titulo', '$f_publicacion', '$f_adquisicion', '$sinopsis', '$num_paginas', '$isbn', '1', '$edicion')";

    $resultado = mysql_query($query);

    if ($resultado) {
        // Ahora vamos a insertar todos los autores del libro en cuestion
        // Sacamos el codigo del autor y el codigo del apellido tokenizando el value del formulario

        if ($autores) {
            foreach ($autores as $autor) {
                // Inserto los autores
                $codAutor = strtok($autor, "-");
                $apellido3 = strtoupper(strtok("-"));

                echo"<br>";

                $query = " INSERT INTO titulo_has_autor
                    (titulo_dewey_id_categoria_dewey, titulo_id_apellido, titulo_id_titulo, autor_id_autor)
                     VALUES('$cod_dewey', '$idAutor', '$idTitulo', '$codAutor')";


                $resultado = mysql_query($query);
                if ($resultado)
                    echo " Alta de autor correcta ($codAutor)<br>";
                else
                    die("Fallo al insertar autor" . mysql_error());
            }

            echo mysql_affected_rows() . " Alta de libro correcta.";
            header("location:../3-mostrarFichaLibro.php?c1=$cod_dewey&c2=$idAutor&c3=$idTitulo");
        }
        else
            die("Fallo al insertar el titulo" . mysql_error());
    }
}
?>
