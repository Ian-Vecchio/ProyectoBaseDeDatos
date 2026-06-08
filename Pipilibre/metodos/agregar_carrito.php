<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['usuario_logueado'])) {
    header("Location: ../inicio/inicio.php");
    exit();
}

$id_producto = $_POST['id_producto_carrito'];
$id_usuario_actual = $_SESSION['id_usuario'];
$cantidad = 1; 

$check_sql = "SELECT cantidad FROM carrito WHERE id_producto = '$id_producto' AND id_dueño_carrito = '$id_usuario_actual'";
$check_resultado = mysqli_query($conexion, $check_sql);

if (mysqli_num_rows($check_resultado) > 0) {
    $fila = mysqli_fetch_assoc($check_resultado);
    $nueva_cantidad = $fila['cantidad'] + 1;
    $sql = "UPDATE carrito SET cantidad = '$nueva_cantidad' WHERE id_producto = '$id_producto' AND id_dueño_carrito = '$id_usuario_actual'";
} else {
    $sql = "INSERT INTO carrito (id_producto, id_dueño_carrito, cantidad) VALUES ('$id_producto', '$id_usuario_actual', '$cantidad')";
}

if (mysqli_query($conexion, $sql)) {
    header("Location: ../Vistas/carrito/vista_carrito.php");
    exit();
} else {
    echo "Error: " . mysqli_error($conexion);
    exit();
}

mysqli_close($conexion);
?>