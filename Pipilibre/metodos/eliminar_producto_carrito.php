<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['usuario_logueado'])) {
    header("Location: ../vistas/inicio/inicio.php");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];
$id_producto_eliminar = $_POST['id_producto_eliminar'];

$sql = "CALL eliminar_producto_carrito('$id_producto_eliminar', '$id_usuario')";mysqli_query($conexion, $sql);

header("Location: ../Vistas\carrito/vista_carrito.php");
exit();
?>