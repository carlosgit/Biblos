<?php
//controlSesion();
include_once "../1-funciones.php";
include_once "fcatalogo.php";
iniciaBD();

$cod_dewey = $_POST['dewey'];
$autores = $_POST['autor'];
$titulo = $_POST['titulo'];
$f_publicacion = $_POST['f_publicacion'];
$f_adquisicion = $_POST['f_adquisicion'];
$sinopsis = $_POST['sinopsis'];
$editorial = $_POST['editorial'];
$edicion = $_POST['edicion'];
$num_paginas = $_POST['num_paginas'];
$isbn = $_POST['isbn'];

$autor=$autores[0];

// Tokenizar para separar el codigo de las 3 primeras letras del apellido1 del autor
// Ejemplo: 000-FOL
// Separo en $codAutor=0
// y $Apellido3='FOL'
$tok = strtok($autor, "-");
$codAutor = $tok;
$tok = strtok("-");
$Apellido3 = $tok;

altacatalogo($cod_dewey, $Apellido3, $titulo, $f_publicacion, $f_adquisicion, $sinopsis, $editorial, $edicion, $num_paginas, $isbn, $autores);

?>

