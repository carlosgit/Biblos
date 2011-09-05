<?php
// Realiza la conexion con el archivo Funciones.php que contendran todas las funciones
include "1-funciones.php";
// Se realiza la transferencia de los datos de los campos name de HTML a PHP
$dni = $_POST['dni'];
$password = $_POST['password'];
// Realiza la comparativa, referente a Si los campos estan rellenos
if (!$dni || !$password) {
    echo "No has introducido todos los campos.<br>"
    . "Por favor, introduce los datos.";
    exit;
}
// Conexion a la Base de datos mediante el archivo de Funciones.php
iniciaBD();
// Realiza una consulta en la tabla usuario para que busque el dni y el password introducidos
$query = "select * from usuario where dni='$dni' AND clave='$password'";
// El resultado se le aplica a una variable*/
$resultado = mysql_query($query);
// Si afecta a una fila especificara que la entrada de los datos existe en la tabla usuario
if (mysql_affected_rows() == 1) {
    echo "Entrada correcta<br>";
// Realizacion de la Declaracion igualando a usuario el resultado de la query  
    $usuario = mysql_fetch_array($resultado);
// Declara que el usuario logeado es apto para la entrada en las siguiente paginas
    $_SESSION['usuario'] = $usuario;
// Muestra "Hola: nombre del usuario de ese DNI, espacio,el apellido del usuario con ese DNI
    echo "Hola: " . $usuario['nombre_usuario'] . " " . $usuario['apellido1_usuario'] . "<br>";
 // Muestra el acceso directo al menuG.php o menu principal
    echo "Vamos para <a href='2-menuG.php'>Dentro</a>";
} else {
 // Muestra el error de que no existe el usuario con ese DNI y Password
    echo "Usuario / clave incorrecto";
}
?>
