<html>
    <head>
        <title>Librería Online - Nueva Entrada de Libros</title>
    </head>
    <body>
        <h1>Alta de libros</h1>
        <p>Los campos con * son obligatorios </p>
        <form action="altalibro_p.php" method="post">
            <table width="369" border=1 cellpadding="0" cellspacing="0">
                <tr>
                    <td>id</td>
                    <td><input type=text name=id maxlength=9 size=9>
                        *<br></td></tr>
                <tr>
                    <td>autor</td>
                    <td> <input type=text name=autor maxlength=30 size=30>
                        *<br></td></tr>
                <tr>
                    <td>editorial</td>
                    <td> <input type=text name=editorial maxlength=30 size=30>
                        *<br></td></tr>
                <tr>
                    <td>nombre</td>
                    <td><input type=text name=nombre maxlength=30 size=30>
                        *<br></td></tr>
                <tr>
                    <td>tema</td>
                    <td><input type=text name=tema maxlength=30 size=30>
                        *<br></td></tr>
                
                <tr>
                    <td>genero</td>
                    <td><input type=text name=genero maxlength=30 size=30>
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

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
