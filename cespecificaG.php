<?php
include "funciones.php";
controlSesion();
$usuario=$_SESSION['usuario'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Consulta espec&iacute;fica (<?php echo $usuario['nombre_usuario']?>)</title>
    </head>
    <body>
       <form action='cespecificaP.php' method='post'>

            <fieldset>
                <legend>Consulta espec&iacute;fica</legend>
                <h3>Tipo de busqueda</h3>
                <input type='radio' name='tipo_busqueda' value='1'>Dewey
                <input type='radio' name='tipo_busqueda' value='2' checked>Titulo
                
                
                </select>
                <h3>Datos de la busqueda</h3>
                <label>Introduzca los datos:<p>
                </label><input type='text' name='busqueda' size='25' maxlength='25'><br>
                <br><input type='submit' name='Envio' value='Envio'>
                <input type='reset' value='Limpiar campos'>
            </fieldset>
           
        </form>
    </body>
</html>
