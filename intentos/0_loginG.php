<html>
    <head> <title>Biblioteca Online</title>
        <link href="0_Biblioteca_CSS.css" rel="stylesheet" type="text/css"/>
        
    </head>
    <body> 
        
        <h1>Bienvenido a tu Biblioteca Virtual</h1><hr>
        <form action="0_menuP.php" method="post">
            <table bgcolor="SkyBlue" width="220" border=2 cellpadding="4" cellspacing="5" >
                <th><u><h2>Logeate</h2></u></th>
                <tr>
                    <td>Nombre                      
                        <input type=text name=nombre maxlength=9 size=9 set="center" align="center">
                        *</td>
                <tr>
                    <td>Contrase&ntilde;a
                        <input type=password name=password maxlength=9 size=9 set="right">
                        *</td></tr>
                <tr>
                <td><u>Tipo de Usuario</u><br>
                        <input type="radio" name="usuario" value="0" checked="checked" /> Usuario*
                        <br><input type="radio" name="usuario" value="1" /> Administrador
                        *<br></td></tr>
                <td><input name="submit" type=submit value="Aceptar">
                    <input name="limpiar" type="reset" id="limpiar" value="Limpiar campos">
                </td>
            </table>
        </form><br><hr>
        <p align="center"><MARQUEE> El que busca encuentra y podras encontrar todo tipo de categorias como: Obras Generales, Filosofía, Religión, Ciencias Sociales, Lingüística, Ciencias Puras, 
            Ciencias Aplicadas, Artes, Recreación, literatura, Historia........</MARQUEE></p>
        <p align="center"> Busca, compara y si encuentras algo mejor, pasalo....</p>
    </body>
</html>    
<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
