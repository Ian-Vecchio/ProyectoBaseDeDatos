<?php
session_start();
include("../../../../metodos/conexion.php");
// agarra variables del form
$calle = $_POST['Calle']; 
$altura = $_POST['Altura'];
$postal = $_POST['Postal'];
$id_persona = $_SESSION['id_usuario'];

$sql = "call p_agregar_direccion($id_persona,'$calle',$altura,$postal)";
if (mysqli_query($conexion, $sql)) {
    header("Location: ../usuario.php");
    echo "sdasds";
    exit();
} else {
        echo "Error: " . mysqli_error($conexion);
    exit();
}   
mysqli_close($conexion);
?>