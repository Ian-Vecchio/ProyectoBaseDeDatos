<?php
session_start();
include("../../metodos/conexion.php");

$monto = $_POST['Saldo_a_ingresar'];
$metodo = $_POST['metodo_pago']; 
$id_user = $_SESSION['id_usuario'];

$sql = "call recarga($id_user,'$metodo','$monto')";
if (mysqli_query($conexion, $sql)) {
    header("Location: vista_depostiar.php");
} else {
    echo "error en el deposito";
}   