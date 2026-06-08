<?php
session_start();
include("conexion.php");
mysqli_report(MYSQLI_REPORT_OFF);

if (!isset($_SESSION['usuario_logueado'])) {
    header("Location: ../vistas/inicio/inicio.php");
    exit();
}

$id_comprador = $_SESSION['id_usuario'];
$id_direccion_envio = $_POST['id_direccion_envio'];

if (empty($id_direccion_envio)) {
    header("Location: ../vistas/carrito/vista_carrito.php");
    exit();
}

$sql_procedimiento = "CALL sp_procesar_compra_carrito('$id_comprador', '$id_direccion_envio')";

if (mysqli_query($conexion, $sql_procedimiento)) {
    header("Location: ../Vistas/envios/envios.php");
    exit();
} else {
        header("Location: ../Vistas/carrito/vista_carrito.php");
    exit();
}

mysqli_close($conexion);
?>
