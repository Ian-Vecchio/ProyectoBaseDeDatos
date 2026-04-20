<?php
include("conexion.php");

$nombre = $_POST['Nombre']; 
$correo = $_POST['correo_electronico'];
$pass = $_POST['contraseña'];


$sql = "INSERT INTO usuario (Nombre, correo_eletronico, contraseña) VALUES ('$nombre', '$correo', '$pass')";

if (mysqli_query($conexion, $sql)) {
    header("Location: inicio.html");
} else {
    header("Location: registro.html");
}

mysqli_close($conexion);
?>