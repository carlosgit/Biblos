
<html>
    <head>
        <title>Librería Online - Gestion de biblioteca </title>
    </head>
    <body>
        
        
        <h1>Gestion de libros</h1>
        <p>Los campos con * son obligatorios </p>
        <form action="gestionlibrop.php" method="post">
            <table width="369" border=1 cellpadding="0" cellspacing="0">
                <tr>
                    <td>cod dewey</td>
                    <td><input type=text name=id maxlength=9 size=9>
                        *<br></td></tr>
                <tr>
                    <td>id apellido autor</td>
                    <td> <input type=text name=autor maxlength=30 size=30>
                        *<br></td></tr>
                <tr>
                    <td>editorial</td>
                    <td> <input type=text name=editorial maxlength=30 size=30>
                        *<br></td></tr>
                <tr>
                    <td>titulo del libro </td>
                    <td><input type=text name=nombre maxlength=30 size=30>
                        *<br></td></tr>
                <tr>
                    <td>sinopsis</td>
                    <td><input type=text name=sinopsis maxlength=30 size=30>
                        *<br></td></tr>
                
                <tr>
                    <td>isbn</td>
                    <td><input type=text name=isbn maxlength=30 size=30>
                        *<br></td></tr>
                <tr>
                    <td>Acci&oacute;n</td>
                    <td>
                        <input type="radio" name="accion" value="1" checked="checked" />Insertar
                        <input type="radio" name="accion" value="2" />Modificar
                        <input type="radio" name="accion" value="3" />Borrar
                        <input type="radio" name="accion" value="4" />listartodo
                        <br></td></tr>
                <tr>
                    <td><input name="submit" type=submit value="Confirmar"></td>
                    <td><label>
                            <input name="limpiar" type="reset" id="limpiar" value="Limpiar campos">
                        </label></td>
                </tr>
            </table>
        </form>
    </body>
</html>
<?php
include "funciones.php";
            controlSesion();

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
