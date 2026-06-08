<?php
session_start();
include("conexion.php");
$id_persona = $_SESSION['id_usuario'];

$sql = "CALL eliminar_todos_tus_productos('$id_persona')";

if (mysqli_query($conexion, $sql)) {
    echo "Error: " . mysqli_error($conexion);
    $_SESSION['eliminaron_productos_correctamente_exitoso'] = 'saa';
        header("Location: ../Vistas/administracion/administracion.php");

    exit();
} else {
    $_SESSION['eliminaron_productos_correctamente_fallido'] = '67';
    echo "Error: " . mysqli_error($conexion);

}
mysqli_close($conexion);
?>