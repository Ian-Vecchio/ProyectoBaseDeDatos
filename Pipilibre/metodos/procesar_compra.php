<?php
session_start();
//
if (!isset($_SESSION['usuario_logueado'])) {
    header("Location: ../inicio/inicio.php");
    exit();
}
mysqli_report(MYSQLI_REPORT_OFF);


include("conexion.php");
//
$id_producto = mysqli_real_escape_string($conexion, $_POST['id_producto_comprado']);
$id_direccion_envio = mysqli_real_escape_string($conexion, $_POST['id_direccion_envio']);

if (empty($id_direccion_envio)) {
    header("Location: ../Vistas/principal/principal.php");
    exit();
}
//
$sql_publicacion = "CALL obtener_publicacion('$id_producto')";
$c_info_pd = mysqli_query($conexion, $sql_publicacion);
//
if ($c_info_pd && mysqli_num_rows($c_info_pd) > 0) {
    $fila_publicacion = mysqli_fetch_assoc($c_info_pd);

    $com_pd_saldo = $fila_publicacion['precio'];
    $com_id_vendedor = $fila_publicacion['id_autor'];
    $com_id_comprador = $_SESSION['id_usuario'];

    mysqli_next_result($conexion); 

    $sql_procedimiento = "CALL sp_procesar_compra_individual('$com_id_comprador', '$com_id_vendedor', '$com_pd_saldo', '$id_producto', '$id_direccion_envio')";    
    
    if (mysqli_query($conexion, $sql_procedimiento)) {
        header("Location: ../Vistas/envios/envios.php");
        exit();
    } else {
        header("Location: ../Vistas/principal/principal.php");
    }
} else {
    echo 'error_producto';
}
?>