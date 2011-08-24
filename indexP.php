<?php

include "funciones.php";



$dni = $_POST['dni'];
$password = $_POST['password'];

if (!$dni || !$password) {
    echo "No has introducido todos los detalles requesnombredos.<br>"
    . "Por favor, sigue buscando.";
    exit;
}

iniciaBD();

$query = "select * from usuario where dni='$dni' AND clave='$password'";
$resultado = mysql_query($query);

if (mysql_affected_rows() == 1) {

    echo "Entrada correcta<br>";
    $usuario = mysql_fetch_array($resultado);
    $_SESSION['usuario'] = $usuario;
    echo "Hola: " . $usuario['nombre_usuario'] . " " . $usuario['apellido1_usuario'] . "<br>";
    echo "Vamos para <a href='menuG.php'>Dentro</a>";
} else {
    echo "Usuario / clave incorrecto";
}
?>
