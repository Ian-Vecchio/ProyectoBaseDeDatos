<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['usuario_logueado'])) {
    header("Location: ../vistas/inicio/inicio.php");
    exit();
}

$id_publicacion = mysqli_real_escape_string($conexion, $_POST['id_publicacion_reseña']);
$comentario = mysqli_real_escape_string($conexion, $_POST['comentario_reseña']);

if (empty($comentario) || empty($id_publicacion)) {
    header("Location: ../Vistas/Publicacion_uni/Publicacion_uni.php?id=" . $id_publicacion);
    exit();
}

$sql_procedimiento = "CALL p_agregar_reseña('$id_publicacion', '$comentario')";

if (mysqli_query($conexion, $sql_procedimiento)) {
    header("Location: ../Vistas/Publicacion_uni/Publicacion_uni.php?id=" . $id_publicacion);
    exit();
} else {
    echo "Error al guardar la reseña: " . mysqli_error($conexion);
    exit();
}

mysqli_close($conexion);
?>