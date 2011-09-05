<?php
/** Realiza la conexion con el archivo Funciones.php que contendran todas las funciones*/
include "./1-funciones.php";
/** La funcion es el control de entrada dentro de este fichero, para que no se puede entrar desde el navegador*/
//controlSesion();
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <h1>MENU</h1>
        <?php
// Comprobación el usuario esta iniciado en la session
        //si no viene de logearse o no a introducido el ususario en la session
        if (!$_SESSION['usuario'] || !isset($_SESSION['usuario'])) {
            echo "logeate primero";
        // sino, el susuario esta dentro de la session*/
        } else {
            $usuario = $_SESSION['usuario'];
            echo "Usuario:" . $usuario['nombre_usuario'];
        }
        ?>
        
        <h1>Opciones</h1>
        <ul><li>Consultas
                <ul>
                    <li><a href='3-cgeneral.php'>Consulta general</a>
                    <li><a href='4-cespecificaG.php'>Consulta concreta</a>
                </ul>
                <?php
                // Comprobacion del tipo de usuario
                if ($usuario['es_administrador'] == 1)
                    mostrarOpcionesAdministracion();
                ?>
            <li><a href='salir.php'>Salir</a>
        </ul>
    </ul>
</body>
</html>
<?php
// Funcion que muestra los campos para el usuario es Administrador 
function mostrarOpcionesAdministracion() {
//echo "Es administrador";
    echo("
        <li>Administracion
        <ul>
        <li><a href='5-gestioncatalogoG.php'>Gestion Catalogo</a>      
        <li><a href='./gusuario/olds/gestionusuariog.php'>Gestion Usuario</a>        
        </ul>");
}
?>