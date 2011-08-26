<?php
include "funciones.php";

//controlSesion();
?>
<html>
    <head>
        <title>Librería Online - Gestion de Catalogo </title>
    </head>
    <body>


        <h1>Gestion de Catalogo</h1>
        <p>Los campos con * son obligatorios </p>
        <form action="gestioncatalogop.php" method="post">
            <table width="369" border=1 cellpadding="0" cellspacing="0">
                <tr>
                    <td>*Codigo Dewey:</td>
                    <td><?php cargardorLista("dewey", "id_categoria_dewey", "categoria_dewey", "1");?><br></td>
                </tr>
                <tr>
                    <td>*Autor:</td>
                    <td><?php cargardorLista2("autor", "id_autor", "apellido1", "nombre_autor", "1");?></td>
                </tr>                
                <tr>
                    <td>Titulo:</td>
                    <td> <input type=text name=titulo maxlength=30 size=30>
                        *<br></td></tr>
                <tr>
                    <td>Fecha Publicacion:</td>
                    <td> <input type=text name=f_publicacion maxlength=30 size=30>
                        *<br></td></tr>
                <tr>
                    <td>Fecha Adquisicion:</td>
                    <td><input type=text name=f_adquisicion maxlength=30 size=30>
                        *<br></td></tr>
                <tr>
                    <td>Sinopsis:</td>
                    <td><textarea cols="50" name=sinopsis></textarea>
                        *<br></td></tr>
                <tr>
                    <td>Editorial:</td>
                    <td><?php cargardorLista("editorial", "id_editorial", "nombre_editorial", "1");?>*</td>
                    </tr>
                <tr>
                    <td>Edicion:</td>
                    <td><input type=text name=edicion maxlength=30 size=30>
                        *<br></td></tr>
                <tr>
                    <td>Numero de Paginas:</td>
                    <td><input type=text name=num_paginas maxlength=30 size=30>
                        *<br></td></tr>
                <tr>
                    <td>ISBN:</td>
                    <td><input type=text name=isbn maxlength=30 size=30>
                        *<br></td></tr>
                <tr>
                    <td>Fecha de Prestamo:</td>
                    <td><input type=text name=f_prestamo maxlength=10 size=10>
                        *<br></td></tr>
                <tr>
                    <td>Fecha de Devolucion Propuesta:</td>
                    <td><input type=text name=f_propuesta maxlength=10 size=10>
                        *<br></td></tr>
                <tr>
                    <td>Fecha Devolucion Efectiva:</td>
                    <td><input type=text name=f_entrega maxlength=10 size=10>
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

