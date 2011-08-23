
<?php

include "./funciones.php";
controlSesion();
?>

<?php

formmenuespecifico();
echo "<h1>Listado especifico del catalogo.</h1>";

iniciaBD();

$busca = $_POST['busca'];
$tipobusqueda = $_POST['tipobusqueda'];
//$titulo = $_POST['titulo'];
//$autor = $_POST['autor'];
//$dewey = $_POST['dewey'];
echo "<h4>Has buscado '<u>$busca</u>' con criterio '<u>$tipobusqueda</u>'</h4>";
trim($busca);
$busca = addslashes($busca);
$tipobusqueda = addslashes($tipobusqueda);

if (!$tipobusqueda || !$busca) {
    echo "No has introducido los detalles de la busqueda. Por favor vuelve e intentalo de nuevo.";
    exit;
}




//if ($accion == titulo) {
    
 /*   $db = mysql_select_db($iddb);
    $consulta = "select * from titulo where " . $tipobusqueda . " like '%" . $busca . "%'";
    $resultado = mysql_query($consulta);
    $num_resultados = mysql_num_rows($resultado);
    echo "<p>N&uacute;mero de titulos encontrados: $num_resultados </p>";
    for ($i = 0; $i < $num_resultados; $i++) {
        $row = mysql_fetch_array($resultado);
        echo "<br>Apellido1: ";
        echo htmlentities($row[0]);
        echo htmlentities("<br>id_apellido: ");
        echo htmlentities($row[1]);
        echo htmlentities("<br>nombre: ");
        echo htmlentities($row[2]);
        echo "</p>";
  //  }
};
?>

<?php
/* $query = "select * from titulo";
    //          (id,autor,editorial,nombre)
    // values ($id,'$autor','$editorial','$nombre')";
    $resultado = mysql_query($query);
    echo "Numero de títulos:" . mysql_num_rows($resultado) . "<p>";

    echo"<table border=1>";
    echo"<th>Codigo</th>
                        <th>Titulo</th>
                        <th>Autor</th>\n";
    if ($resultado) {
        while ($titulo = mysql_fetch_array($resultado)) {
            // Saco en variables el codigo completo del libro
            $cat_dewey = $titulo['dewey_id_categoria_dewey'];
            $id_apellido = $titulo['id_apellido'];
            $id_titulo = $titulo['id_titulo'];
            echo "<tr>";
            echo "<td><a href='mostrarFichaLibro.php?c1=$cat_dewey&c2=$id_apellido&c3=$id_titulo'>".
            $cat_dewey.
            "" . strtoupper($id_apellido) .
            "" . strtoupper($id_titulo) . "</a></td>";
            echo "<td>" . htmlentities($titulo['nombre']) . "</td>";

            $autores = obtenerAutores($cat_dewey, $id_apellido, $id_titulo);
            echo "<td><ul>";
            foreach ($autores as $autor) {
                echo "<li>" . $autor;
            }
            echo "</ul></td>";
            echo "<tr>\n";
        }
        echo"</table>";
    }

    else {
        die("Fallo al listar") . mysql_error();
}




?>
*/