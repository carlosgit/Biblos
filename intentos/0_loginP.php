<html>
    <head>
        <title>nombre alumnos</title>
    </head>
    <body>
        <h1>login </h1>
        <?php
              
            $nombre = $_POST['nombre'];
            $password = $_POST['password'];
            $usuario = $_POST['usuario'];
            
            
            if (!$nombre || !$password || !$usuario) {
                echo "No has introducido todos los detalles requesnombredos.<br>"
                . "Por favor, sigue buscando.";
                exit;
            }
            $nombre = htmlentities($nombre);
            $password = htmlentities($password);
            $usuario = htmlentities($usuario);
                        
            @ $sgdb = mysql_connect("localhost", "root", "");
            
            if (!$sgdb) {
                echo "Error: No se puede conectar al sevnombreor de base de datos. Por favor inténtalo de nuevo.";
                exit;
            }
            $db = mysql_select_db("biblos_g1");
            if (!$db) {
                echo "Error: No se puede conectar a la base de datos. Por favor inténtalo de nuevo.";
                exit;
            }
            if ($accion == 1)
                insertaralumno($nombre, $password, $usuario, $administrador);
            if ($accion == 2)
                modificaralumno($nombre, $password, $usuario, $administrador);
            if ($accion == 3)
                borraralumno($nombre);
            ?>
        <p>&nbsp;</p>
        <p><a href="1_nombrealumnoG.php">Volver</a></p>//boton de retorno
        <p><a href="2_nombrepasswordG.php">Siguiente</a></p>//boton siguiente tabla 
    </body>
</html>
<?php
function insertaralumno($nombre, $password, $usuario, $administrador) {
    echo "insertando....";
    $query = "insert into alumno (nombre_alumno, password, usuario, administrador)
                values ($nombre,'$password','$usuario','$administrador')";
    $resultado = mysql_query($query);
    if ($resultado)echo mysql_affected_rows() . " nombre de alumno correcta.";
    else die("fallo en la inserción") . mysql_error();
}
function modificaralumno($nombre, $password, $usuario, $administrador) {
    echo "Modificando....";
    $query = "update alumno set password='$password', usuario='$usuario', 
    administrador='$administrador'where nombre_alumno=$nombre";
    $resultado = mysql_query($query);
    if ($resultado)
        echo mysql_affected_rows() . " Modificado de alumno correcta.";
    else die("fallo al modificar:") . mysql_error();
}
 function borraralumno($nombre) {
    echo "Borrando....";
    $query = "delete from alumno where nombre_alumno=$nombre";
    $resultado = mysql_query($query);
    if ($resultado)
        echo mysql_affected_rows() . "El borrado del alumno correcta.";
    else die("fallo al borrar:") . mysql_error();
}
?>
