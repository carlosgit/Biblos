<?php
include "../funciones.php";
//controlSesion();

?>

<html>
    <head>
        <title>Librería Online - Gestion de biblioteca </title>
    </head>
    <body>


        <h1>Gestion de usuarios</h1>
        <p>Los campos con * son obligatorios </p>
        <form action="gestionusuariop.php" method="post">
            <table width="369" border=1 cellpadding="0" cellspacing="0">
                <tr>
                    <td>dni</td>
                    <td><input type=text name=dni maxlength=9 size=9>
                        *<br></td></tr>
                <tr>
                    <td>clave</td>
                    <td><input type=password name=clave maxlength=30 size=30>
                        *<br></td></tr>
                <tr>
                    <td>direccion</td>
                    <td> <input type=text name="direccion" maxlength=30 size=30>
                        *<br></td></tr>
                <tr>
                    <td>nombre usuario</td>
                    <td><input type=text name=nombre_usuario maxlength=30 size=30>
                        *<br></td></tr>
                <tr>
                    <td>apellido1</td>
                    <td> <input type=text name=apellido1_usuario maxlength=30 size=30>
                        *<br></td></tr>
                <tr>
                    <td>apellido2</td>
                    <td> <input type=text name=apellido2_usuario maxlength=30 size=30>
                        *<br></td></tr>

                <tr>
                    <td>telefono</td>
                    <td><input type=text name=telefono maxlength=30 size=30>
                        *<br></td></tr> 
                <tr>
                    <td>email</td>
                    <td> <input type=text name=email maxlength=30 size=30>
                        *<br></td></tr>


                <tr>
                    <td>administrador ?</td>
                    <td><input type=text name=es_administrador maxlength=30 size=30 >
                        *<br></td></tr>
                <tr>
                    <td>plantilla</td>
                    <td><input type=text name=plantilla_id_plantilla maxlength=30 size=30 >
                        *<br></td></tr>
                
                <tr>
                    <td>Acci&oacute;n</td>
                    <td>
                        <input type="radio" name="accion" value="1" checked="checked" />Insertar
                        <input type="radio" name="accion" value="2" />Modificar
                        <input type="radio" name="accion" value="3" />Borrar
                        <input type="radio" name="accion" value="4" />muestra todos
                        <br></td></tr>
                <tr>
                    <td><input name="submit" type=submit value="Confirmar"></td>
                    <td><label>
                            <input name="limpiar" type="reset" id="limpiar" value="Limpiar campos">
                        </label></td>
                </tr>
            </table>
        </form>
    <p><a href="menuG.php">Volver a menu</a></p>
    <a href='mostrarusuario.php'> perfil usuario ?></a>
   
    </body>
</html>
