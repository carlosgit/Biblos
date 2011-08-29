<?php
include 'funciones.php';

//controlSesion();
?>
<html>
    <head>
        


        <title>Librería Online - Gestion de Catalogo </title>
        <script type='text/javascript' src='./recursos/funciones.js'></script>
        <style type='text/css'>@import url(recursos/calendar.css);</style>

        <script type='text/javascript' src='js/calendar.js'></script>
        <script type='text/javascript' src='js/calendar-es.js'></script>
        <script type='text/javascript' src='js/calendar-setup.js'></script>
        
     


    </head>
    <body>


        <h1>Gestion de Catalogo</h1>
        <p>Los campos con * son obligatorios </p>
        <form action='gestioncatalogop.php' method='post' onSubmit='return Valida(this);'>
            <table width='369' border='1'cellpadding='0' cellspacing='0'>
                <tr>
                    <td>*Codigo Dewey:</td>
                    <td><?php cargardorLista('dewey', 'id_categoria_dewey', 'categoria_dewey', '1'); ?><br></td>
                </tr>
                <tr>
                    <td>*Autor:</td>
                    <td><?php cargardorLista2('autor', 'id_autor', 'apellido1', 'nombre_autor', '1'); ?></td>
                </tr>                
                <tr>
                    <td>Titulo:</td>
                    <td> <input type='text' name='titulo' maxlength='30' size='30'>
                        *<br></td></tr>
                <tr>
                    <td>Fecha Publicacion:</td>
                    <td> <input type='text' name='f_publicacion' id='f_publicacion' maxlength='30' size='30'>
                        <input type='button' id='trigger' value='...' /><br>*<br></td></tr>
                <tr>
                    <td>Fecha Adquisicion:</td>
                    <td><input type='text' name='f_adquisicion' id='f_adquisicion' maxlength='30' size='30'>
                        <input type='button' id='trigger2' value='...' /><br>*<br></td></tr>
                <tr>
                    <td>Sinopsis:</td>
                    <td><textarea cols='50' name='sinopsis'></textarea>
                        *<br></td></tr>
                <tr>
                    <td>Editorial:</td>
                    <td><?php cargardorLista('editorial', 'id_editorial', 'nombre_editorial', '1'); ?>*</td>
                </tr>
                <tr>
                    <td>Edicion:</td>
                    <td><input type='text' name='edicion' maxlength='30' size='30'>
                        *<br></td></tr>
                <tr>
                    <td>Numero de Paginas:</td>
                    <td><input type='text' name='num_paginas' maxlength='30' size='30'>
                        *<br></td></tr>
                <tr>
                    <td>ISBN:</td>
                    <td><input type='text' name='isbn' maxlength='30' size='30'>
                        *<br></td></tr>



                <tr>
                    <td>Acci&oacute;n</td>
                    <td>
                        <input type='radio' name='accion' value='1' checked='checked' />Insertar
                        <input type='radio' name='accion' value='2' />Modificar
                        <input type='radio' name='accion' value='3' />Borrar
                        <input type='radio' name='accion' value='4' />listartodo
                        <br></td></tr>
                <tr>
                    <td><input name='submit' type='submit' value='Confirmar'></td>
                    <td><label>
                            <input name='limpiar' type='reset' id='limpiar' value='Limpiar campos'>
                        </label></td>
                </tr>
            </table>
        </form>
    </body>
    
       <script type='text/javascript'>
            
            Calendar.setup(
            {
                inputField : 'f_publicacion',
                ifFormat : '%d/%m/%Y',
                button : 'trigger'
            });
            Calendar.setup(
            {
                inputField : 'f_adquisicion',
                ifFormat : '%d/%m/%Y',
                button : 'trigger2'
            }); 


            function Valida( formulario ) {
                
                var valido=true;
                var i=0, strCamposVacios;
                var camposVacios=new Array();
            
                if (formulario.titulo.value == '') {
                    strCamposVacios=formulario.titulo.name;
                    i++;
                    valido=false;
                }
            
                if (formulario.f_publicacion.value == '') {
                    strCamposVacios=strCamposVacios+', '+formulario.f_publicacion.name;
                    i++;
                    valido=false;
                }

                if (formulario.f_adquisicion.value == '') {
                    strCamposVacios=strCamposVacios+', '+formulario.f_adquisicion.name;
                    i++;
                    valido=false;
                }
            
                if (formulario.num_paginas.value == '') {
                    strCamposVacios=strCamposVacios+', '+formulario.num_paginas.name;
                    i++;
                    valido=false;
                }
            
            
                if(i>0){
                    var mensaje='('+i+') - Faltan los siguientes campos obligatorios:\n'
                    window.alert(mensaje+strCamposVacios);
                }
                return valido;
            }
        </script>
    
</html>

