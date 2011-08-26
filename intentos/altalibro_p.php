<html>
    <head>
        <title>Alta alumnos</title>
    </head>
    <body>
        <h1>Alta de alumno </h1>
        <p>
            <?php
            $id = $_POST['id'];
            $autor = $_POST['autor'];
            $editorial = $_POST['editorial'];
            $nombre = $_POST['nombre'];
            $tema = $_POST['tema'];
             $genero = $_POST['genero'];
            $accion = $_POST['accion'];
            
            
            
            if($accion==3)
                borrarlibro($id);
            if($accion==4)
                listartodo($id);
          
//  else
           // if (!$id || !$apellido1 || !$apellido2 || !$nombre || !$accion) {
             //   echo "No has introducido todos los detalles requeridos.<br>"
            //    . "Por favor vuelve e inténtalo de nuevo.";
             //   exit;
           // }
            $id = htmlentities($id);
            $autor = htmlentities($autor);
            $editorial = htmlentities($editorial);
            $nombre = htmlentities($nombre);
            $tema = htmlentities($tema);
            $genero = htmlentities($genero);
            @ $sgbd = mysql_pconnect("localhost", "root", "");
            if (!$sgbd) {
                echo "Error: No se puede conectar a la base de datos. Por favor inténtalo de nuevo.";
                exit;
            }
            $db = mysql_select_db("biblos_g1");
            if (!$db) {
                echo "Error: No se puede conectar a la base de datos. Por favor inténtalo de nuevo.";
                exit;
            }
            if($accion==1) altalibro($id,$autor,$editorial,$nombre);
            if($accion==2) modificarlibro ($id,$autor,$editorial,$nombre);
                      ?>
        </p>
        <p>&nbsp;</p>
        <p><a href="alta_libro_g.php">Volver</a></p>//boton de retorno
    </body>
</html>

<?php
function altalibro($id,$autor,$editorial,$nombre){
    $query = "insert into libros
                (id,autor,editorial,nombre)
       values ($id,'$autor','$editorial','$nombre')";
            $resultado = mysql_query($query);
            if ($resultado)
                echo mysql_affected_rows() . " Alta de libro correcta.";
            else
                die("Fallo al insertar"). mysql_error();
    
}

function modificarlibro($id,$autor,$editorial,$nombre){
     $query = "UPDATE libros
            SET autor='$autor',editorial='$editorial',nombre='$nombre' WHERE id=$id";
            $resultado = mysql_query($query);
            if(mysql_affected_rows()==0){
                echo ("El registro no existe.");
               altalibro($id,$autor,$editorial,$nombre);
            }
            else
            if ($resultado)
                echo mysql_affected_rows() . " modifacion de libro correcta.";
            else
                die("Fallo al modificar". mysql_error());
}

function borrarlibro($id,$nombre){
   @ $sgbd = mysql_pconnect("localhost", "root", "");
   $db = mysql_select_db("biblos_g1");
    $query = "DELETE FROM libros WHERE id_alumno=$id";
    $resultado = mysql_query($query);
    if(mysql_affected_rows()==0)
                echo ("El registro que quiere borrar no existe.");
    else
      if($resultado)
        echo "Se han borrado".mysql_affected_rows().  " libro correctamente";
      else
        die ("Fallo al borrar el registro".mysql_error ());
         
function listartodo(){
    $sgbd = mysql_pconnect("localhost", "root", "");
   $db = mysql_select_db("biblos_g1");
    $query = "select * from titulo";
      //          (id,autor,editorial,nombre)
      // values ($id,'$autor','$editorial','$nombre')";
            $resultado = mysql_query($query);
            if ($resultado){
                while($titulo = mysql_fetch_array($resultado)){
                echo "Titulo:".$titulo['nombre'];
                }
                
                echo mysql_affected_rows() . " Alta de libro correcta.";
                
            }
            
            else
                die("Fallo al listar"). mysql_error();
     
}}
 ?>