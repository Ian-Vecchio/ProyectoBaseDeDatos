<?php
session_start();
if (!isset($_SESSION['usuario_logueado'])) {
    header("Location: ../inicio/inicio.php");
    exit();
}

include("conexion.php");
$id_direccion_eliminar = $_POST['id_direccion_eliminar'];
$sql = "CALL sup_direccion_especifica('$id_direccion_eliminar')";

if (mysqli_query($conexion,$sql)){
    header("Location: ../Vistas/usuario_y_editar\usuario\usuario.php");
}
else{
    $_errores['error_sup_pd_singular'] = 'error';   
        header("Location: ../Vistas/usuario_y_editar\usuario\usuario.php");

}
