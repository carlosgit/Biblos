<?php

session_start();

function controlSesion() {

//include "altalibro_p.php";

    if (!$_SESSION['usuario'] || !isset($_SESSION['usuario'])) {
        header("location:1-indexG.php");
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

    $resultado = mysql_query($query);
    
    if ($resultado) {
        $i = 0;
        while ($autor = mysql_fetch_array($resultado)) {
            $autor_nombre = htmlentities($autor['nombre_autor']);
            $autor_apellido1 = htmlentities($autor['apellido1']);
            $autor_apellido2 = htmlentities($autor['apellido2']);

            $autores[$i] = $autor_apellido1." ".$autor_apellido2.", ". $autor_nombre;
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

    echo "-".$query;

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
            echo "<td><a href='mostrarFichaLibro.php?c1=$cat_dewey&c2=$id_apellido&c3=$id_titulo'>".
                 $cat_dewey."".strtoupper($id_apellido)."".strtoupper($id_titulo)."</a></td>";
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
        die("Fallo al listar".mysql_error());
}

function altalibro($id, $autor, $editorial, $nombre, $sinopsis, $isbn) {
     
    iniciaBD();
    
    $query = "insert into titulo
                     (dewey_id_categoria_dewey,id_apellido,editorial_id_editorial,nombre,sinopsis,isbn)
              values ($id,'$autor','$editorial','$nombre','$sinopsis',$isbn)";
    
    $resultado = mysql_query($query);
    
    if ($resultado)
        echo mysql_affected_rows()." Alta de libro correcta.";
    else
        die("Fallo al insertar".mysql_error());
}

function modificarlibro($id, $autor, $editorial, $nombre, $sinopsis, $isbn) {
    
    iniciaBD();
    
    $query = "UPDATE titulo 
                 SET id_apellido='$autor',editorial_id_editorial='$editorial',nombre='$nombre',sinopsis='$sinopsis', isbn=$isbn
               WHERE dewey_id_categoria_dewey=$id";
    
    $resultado = mysql_query($query);
    
    if (mysql_affected_rows() == 0) {
        echo ("El registro no existe.");
        // altalibro($id,$autor,$editorial,$nombre);
    } else
    if ($resultado)
        echo mysql_affected_rows() . " modifacion de libro correcta.";
    else
        die("Fallo al modificar". mysql_error());
}

function borrarlibro($id, $nombre) {
   
    iniciaBD();
    
    $query = "DELETE FROM titulo 
              WHERE dewey_id_categoria_dewey=$id AND nombre='$nombre'";
    
    $resultado = mysql_query($query);
    
    if (mysql_affected_rows() == 0)
        echo ("El registro que quiere borrar no existe.");
    else
    if ($resultado)
        echo "Se han borrado ".mysql_affected_rows()." libro correctamente";
    else
        die("Fallo al borrar el registro ".mysql_error());
}

function listartodo() {
    
    iniciaBD();
   
    $query = "select * from titulo";
    
    listarCatalogo();
}

function listarCatalogoXCampo($campoBusqueda, $valorBusqueda, $isExact) {

    iniciaBD();
    
    $query = "select * from titulo where $campoBusqueda ";
    
    if ($isExact == TRUE)
        $query = $query . "= '$valorBusqueda'";
    else
        $query = $query . "like '%$valorBusqueda%'";
  
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
                
                echo "<td><a href='mostrarfichalibro.php?c1=$cat_dewey&c2=$id_apellido&c3=$id_titulo'>"
                .$cat_dewey."".strtoupper($id_apellido)."".strtoupper($id_titulo)."</a></td>";
                
                echo "<td>".htmlentities($titulo['nombre'])."</td>";

                $autores = obtenerAutores($cat_dewey, $id_apellido, $id_titulo);
                
                echo "<td><ul>";
                foreach ($autores as $autor) {
                    echo "<li>" . $autor;
                }
                echo "</ul></td>";
                echo "<tr>\n";
            }
            echo "<legend>Numero de titulos: $numTitulos</legend>";
            echo"</table>";
        }
        else
            die("Fallo al listar") . mysql_error();
    }
}

function borrarusuario($dni, $nombre_usuario) {
   
    iniciaBD();
   
    $query = "DELETE FROM usuario 
              WHERE dni=$dni AND nombre_usuario='$nombre_usuario'";
    
    $resultado = mysql_query($query);
   
    if (mysql_affected_rows() == 0)
        echo ("El usuario que quiere borrar no existe.");
    else
    if ($resultado)
        echo "Se ha borrado".mysql_affected_rows()." usuario: $nombre_usuario correctamente";
    else
        die("Fallo al borrar el registro" . mysql_error());
}

function altausuario($dni, $email, $direccion, $telefono, $nombre_usuario, $clave, $es_administrador, $apellido1, $apellido2, $plantilla_id_plantilla) {
    
    iniciaBD();
    
    $query = "insert INTO usuario
                     (dni, email, direccion, telefono, nombre_usuario, clave, es_administrador, apellido1_usuario, apellido2_usuario, plantilla_id_plantilla)
              values ($dni, $email, $direccion, $telefono, $nombre_usuario, $clave, $es_administrador, $apellido1, $apellido2, $plantilla_id_plantilla)";
    
    $resultado = mysql_query($query);
    
    if ($resultado)
        echo mysql_affected_rows()." Alta de usuario correcta. Bienvenido $nombre_usuario";
    else
        die("Fallo al insertar") . mysql_error();
}



function cargardorLista($nombreTabla, $codCampo, $valorCampo, $visibles=1, $opcionSeleccione=null) {
            iniciaBD();
            $query = "SELECT * FROM $nombreTabla";
            $resultado = mysql_query($query);
            $opcion0="";
            
            
            $select = "<select name='$nombreTabla' size='$visibles' ";
            if($opcionSeleccione){
                $select .= "class='Obligado'";
                 $opcion0 = "<option value='' SELECTED>$opcionSeleccione";
            }
            
            $select .= ">";
            
           

            //echo "<select name='$nombreTabla' size='$visibles'value='$value'>";
            echo $select;
            echo $opcion0;
            while ($salida = mysql_fetch_array($resultado)) {
                echo "<option value='" . $salida[$codCampo] . "'>". htmlentities($salida[$valorCampo]).' ('.$salida[$codCampo].") </option>";
            }
            echo "</select>";
        }


function cargardorLista2($nombreTabla, $codCampo, $valorCampo1, $valorCampo2, $visibles=1,$opcionSeleccione=null) {
            iniciaBD();
            $query = "SELECT * FROM $nombreTabla";
            $resultado = mysql_query($query);
            $opcion0="";
            
            
            $select = "<select multiple='multiple' name='".$nombreTabla."[]' size='$visibles' ";
            if($opcionSeleccione){
                $select .= "class='Obligado'";
                 $opcion0 = "<option value='' SELECTED>$opcionSeleccione";
            }
            
            $select .= ">";
            // $select = $select .">";
            
            
            echo $select;
            echo $opcion0;
            
            while ($salida = mysql_fetch_array($resultado)) {
                echo "<option value='" . $salida[$codCampo] . "-" . strtoupper(substr($salida[$valorCampo1], 0, 3)) . "'>" . htmlentities($salida[$valorCampo1]) . "," . htmlentities($salida[$valorCampo2]) . "</option>";
            }
            echo "</select></br>";
        }

function consultaValorDesdeCogigo($nombreTabla, $campoId, $colConsultada, $valorCampoId) {
    
    iniciaBD();
    
    $query = "SELECT $colConsultada FROM $nombreTabla where $campoId = '$valorCampoId'";
    
    $resultado = mysql_query($query);
    
    $salida = mysql_fetch_array($resultado);
    
    return $salida['$colConsultada'];
    
}

function listarusuario($dni, $nombre_usuario, $apellido1, $apellido2, $direccion, $email, $telefono) {
    
    iniciaBD();

    $query = "select * from usuario\n";
    $resultado = mysql_query($query);
    echo "Numero de :" . mysql_num_rows($resultado) . "<p>\n";

    echo"<table border=1>\n";
    echo"<th>dni</th>\n
         <th>nombre</th>\n
         <th>apellido1</th>\n
         <th>apellido2</th>\n
         <th>direccion</th>\n";
    
    if ($resultado) {
        while ($usuario = mysql_fetch_array($resultado)) {
            // Saco en variables el codigo completo del libro
            $dni = $usuario['dni'];
            $nombre = $usuario['nombre_usuario'];
            $apellido1 = $usuario['apellido1_usuario'];

            $nombre_usuario = $usuario['es_administrador'];
            $apellido2 = $usuario['apellido2_usuario'];

            $direccion = $usuario['direccion'];
            $email = $usuario['email'];
            $telefono = $usuario['telefono'];

            echo "<tr>\n";
            echo"<td>$dni</td>\n";
            echo"<td>$nombre_usuario</td>\n";
            echo"<td>$apellido1</td>\n";
            echo"<td>$apellido2</td>\n";
            echo"<td>$direccion</td>\n";
            echo"<td>$email</td>\n";
            echo"<td>$telefono</td>\n";

            echo "<tr>\n\n";
        }
        echo"</table>\n";
    }
    else
        die("Fallo al listar" . mysql_error());
}

function rellenaUsuariosConOpciones() {
   
    iniciaBD();
    
    $query = "select * from usuario";
    
    $resultado = mysql_query($query);
    echo "Total de usuarios: ".mysql_num_rows($resultado)."<p>\n";

    // Relleno las filas de la tabla grafica con las filas que vienen del select a la BD

    if ($resultado) {
        while ($usuario = mysql_fetch_array($resultado)) {
            // Saco en variables el codigo completo del libro
            $dni = $usuario['dni'];
            $clave = $usuario['clave'];
            $nombre = htmlentities($usuario['nombre_usuario']);
            $apellido1 = htmlentities($usuario['apellido1_usuario']);
            $apellido2 = htmlentities($usuario['apellido2_usuario']);
            $direccion = htmlentities($usuario['direccion']);
            $telefono = $usuario['telefono'];
            $email = $usuario['email'];
            $es_adminitrador = $usuario['es_administrador'];
            $id_plantilla = $usuario['plantilla_id_plantilla'];

            echo "<tr>\n";
            echo"<td><a href='http://localhost/Biblos/gusuario/mUsuarioG.php?dni=$dni'><img src='../imagen/ico_modificar_datos.png'></a></td>\n";
            echo"<td><a href='http://localhost/Biblos/gusuario/bajaUsuario.php?dni=$dni'><img src='../imagen/aspa.png' width='20%'></a></td>\n";            
            //echo"<td><input type='button' name='bborrar' value='Borrar' OnClick='BorrarUsuario($dni)'</td>\n";
            echo"<td>$dni</td>\n";
            echo"<td>$clave</td>\n";
            echo"<td>$nombre</td>\n";
            echo"<td>$apellido1</td>\n";
            echo"<td>$apellido2</td>\n";
            echo"<td>$direccion</td>\n";
            echo"<td>$telefono</td>\n";
            echo"<td>$email</td>\n";
            echo"<td>$es_adminitrador</td>\n";
            echo"<td>$id_plantilla</td>\n";
            echo "<tr>\n\n";
        }
    }

    else
        die("Fallo al listar".mysql_error());
}

function modificarUsuario($dni, $email, $direccion, $telefono, $nombre_usuario, $clave, $es_administrador) {
    
    iniciaBD();
    
    $query = "UPDATE titulo
            SET  id_apellido='$autor',editorial_id_editorial='$editorial',nombre='$nombre',sinopsis='$sinopsis', isbn=$isbn WHERE dewey_id_categoria_dewey=$id\n";
    $resultado = mysql_query($query);
    if (mysql_affected_rows() == 0) {
        echo ("El registro no existe.");
        // altalibro($id,$autor,$editorial,$nombre);
    } else
    if ($resultado)
        echo mysql_affected_rows() . " modifacion de libro correcta.\n";
    else
        die("Fallo al modificar".mysql_error());
}

function formularioUsuario($dni, $editable, $valorBoton="Enviar", $accion="") {
    
    iniciaBD();
    
    $query = "select * from usuario where dni= '$dni' \n";

    $resultado = mysql_query($query);
    if ($resultado) {
        $fila = mysql_fetch_array($resultado);
        $nombreusuario = $fila['nombre_usuario'];
        $apellido1 = $fila['apellido1_usuario'];
        $apellido2 = $fila['apellido2_usuario'];
        $telefono = $fila['telefono'];
        $direccion = $fila['direccion'];
        $es_administrador= $fila['es_administrador'];
        $email = $fila['email'];
        $plantilla = $fila['plantilla_id_plantilla'];
        $clave = $fila['clave'];

        echo "<form name='$valorBoton' action='$accion' method='POST'>\n\n";

        echo "<label>DNI</label>\n";
        echo"<input type='text' name='dni' value='$dni' readonly='readonly' /> <p>\n";

        echo "<label>Nombre</label>\n";
        echo (componeInput("nombre_usuario", $nombreusuario, $editable)."<p>\n");


        echo "<label>Clave</label>\n";
        echo (componeInput("clave", $clave, $editable)."<p>\n");        

        echo "<label>Apellido1</label>\n";
        echo (componeInput("apellido1_usuario", $apellido1, $editable)."<p>\n");        

        echo "<label>Apellido2</label>\n";
        echo (componeInput("apellido2_usuario", $apellido2, $editable)."<p>\n");                
        
        echo "<label>Es Adm</label>\n";
        echo (componeInput("es_administrador", $es_administrador, $editable)."<p>\n");

        echo "<label>Telefono</label>\n";
        echo (componeInput("telefono", $telefono, $editable)."<p>\n");                        

        echo "<label>Direccion</label>\n";
        echo (componeInput("direccion", $direccion, $editable)."<p>\n");                        

        echo "<label>eMail</label>\n";
        echo (componeInput("email", $email, $editable)."<p>\n");                        

        echo "<label>Plantilla</label>\n";
        echo (componeInput("plantilla_id_plantilla", $plantilla, $editable)."<p>\n");
        if($editable)
            echo"<input type='submit' value='$valorBoton' name='$valorBoton' />\n";
        echo "</form>\n";
    }
}

function componeInput($nombreName, $valor, $editable){
      
       $campo = "<input type='text' name='$nombreName' value='".htmlentities($valor)."' ";
        if (!$editable)
            $campo = $campo . "readonly='readonly' ";
        $campo = $campo . "/>";
        
        return $campo;
}
?>

<script LANGUAGE="JavaScript">
    function BorrarUsuario(dni)
    {
        var respuesta = confirm("¿Borrar usuario: "+dni+"?");
        if(respuesta){
            open("http://localhost/Biblos/gusuario/bajaUsuario.php?dni="+dni);
        }
        return true;
    } 
    
    function ModificarUsuario(dni)
    {

        open("http://localhost/Biblos/gusuario/mUsuarioG.php?dni="+dni);

        return true;
    }     
    
</script>