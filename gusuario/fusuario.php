<?php
include_once "../1-funciones.php";

function altausuario($dni, $email, $direccion, $telefono, $nombre_usuario, $clave, $es_administrador, $apellido1, $apellido2, $plantilla_id_plantilla) {
    iniciaBD();

    $query = "insert INTO usuario
                (dni, email, direccion, telefono, nombre_usuario, clave, es_administrador, apellido1_usuario, apellido2_usuario, plantilla_id_plantilla)
       values ('$dni', '$email', '$direccion', '$telefono', 
    '$nombre_usuario', '$clave', '$es_administrador', '$apellido1', '$apellido2', '$plantilla_id_plantilla')";

    echo $query;

    $resultado = mysql_query($query);
    if ($resultado)
        echo mysql_affected_rows() . " Alta de usuario correcta. Bienvenido .$nombre_usuario\n";
    else
        die("Fallo al insertar" . mysql_error());
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
        die("Fallo al listar" . mysql_error());
}

function modificarUsuario($dni, $email, $direccion, $telefono, $nombre_usuario, $clave, $es_administrador) {
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
        die("Fallo al modificar" . mysql_error());
}

function borrarusuario($dni) {
    //controlSesion();
    iniciaBD();

    $query = "DELETE FROM usuario WHERE dni='$dni'\n";
    $resultado = mysql_query($query);
    if (mysql_affected_rows() == 0)
        echo ("El usuario que quiere borrar no existe.");
    else
    if ($resultado)
        echo "(" . mysql_affected_rows() . ") Se ha borrado $dni correctamente\n";
    else
        die("Fallo al borrar el registro" . mysql_error());
}

function formularioUsuario($dni, $editable, $valorBoton="Enviar", $accion="") {
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

