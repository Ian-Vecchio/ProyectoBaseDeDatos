<?php
session_start();

if (!isset($_SESSION['usuario_logueado'])) {
    header("Location: ../inicio/inicio.php");
    exit();
}

include("conexion.php");
$id_borrar = $_POST['id_producto_a_eliminar'];
$sql = "CALL sup_publicacion_especifica('$id_borrar')";

if (mysqli_query($conexion,$sql)){
    header ("Location: ../Vistas/administracion/administracion.php");
} else {
    $_SESSION['error_borrado'] = 'no se pudo borrar el producto';
    header ("Location: ../Vistas/administracion/administracion.php");
}
