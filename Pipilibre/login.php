<?php

include("conexion.php");


$nombre = $_POST['Nombre'];
$pass = $_POST['pass'];

$consulta = "SELECT * FROM usuario WHERE Nombre='$nombre' AND contraseña='$pass'";
$resultado = mysqli_query($conexion, $consulta);

if (mysqli_num_rows($resultado) > 0) {
    $_SESSION['usuario_logueado'] = $nombre;
    header("Location: principal.php");
} else {
    echo "Usuario o contraseña incorrectos. <a href='inicio.html'>Volver</a>";
}
?>