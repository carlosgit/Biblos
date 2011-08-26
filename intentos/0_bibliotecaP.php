<html>
    <head>
        <title>Alta alumnos</title>
    </head>
    <body>
        <h1>Alta de alumno </h1>
        <?php
            $alta = $_POST['alta'];
            $curso = $_POST['curso'];
            $examen = $_POST['examen'];
            $matricula = $_POST['matricula'];
            $accion = $_POST['accion'];
            if (!$alta || !$curso || !$examen || !$matricula || !$accion) {
                echo "No has introducaltao todos los detalles requeraltaos.<br>"
                . "Por favor, sigue buscando.";
                exit;
            }
            $alta = htmlentities($alta);
            $curso = htmlentities($curso);
            $examen = htmlentities($examen);
            $matricula = htmlentities($matricula);
            @ $sgdb = mysql_connect("localhost", "root", "");
            if (!$sgdb) {
                echo "Error: No se puede conectar al sevaltaor de base de datos. Por favor inténtalo de nuevo.";
                exit;
            }
            $db = mysql_select_db("cestudios");
            if (!$db) {
                echo "Error: No se puede conectar a la base de datos. Por favor inténtalo de nuevo.";
                exit;
            }
            if ($accion == 1)
                insertaralumno($alta, $curso, $examen, $matricula);
            if ($accion == 2)
                modificaralumno($alta, $curso, $examen, $matricula);
            if ($accion == 3)
                borraralumno($alta);
            ?>
        <p>&nbsp;</p>
        <p><a href="1_altaalumnoG.php">Volver</a></p>//boton de retorno
        <p><a href="2_altacursoG.php">Siguiente</a></p>//boton siguiente tabla 
    </body>
</html>
<?php
function insertaralumno($alta, $curso, $examen, $matricula) {
    echo "insertando....";
    $query = "insert into alumno (alta_alumno, curso, examen, matricula)
                values ($alta,'$curso','$examen','$matricula')";
    $resultado = mysql_query($query);
    if ($resultado)echo mysql_affected_rows() . " Alta de alumno correcta.";
    else die("fallo en la inserción") . mysql_error();
}
function modificaralumno($alta, $curso, $examen, $matricula) {
    echo "Modificando....";
    $query = "update alumno set curso='$curso', examen='$examen', 
    matricula='$matricula'where alta_alumno=$alta";
    $resultado = mysql_query($query);
    if ($resultado)
        echo mysql_affected_rows() . " Modificado de alumno correcta.";
    else die("fallo al modificar:") . mysql_error();
}
 function borraralumno($alta) {
    echo "Borrando....";
    $query = "delete from alumno where alta_alumno=$alta";
    $resultado = mysql_query($query);
    if ($resultado)
        echo mysql_affected_rows() . "El borrado del alumno correcta.";
    else die("fallo al borrar:") . mysql_error();
}
?>
