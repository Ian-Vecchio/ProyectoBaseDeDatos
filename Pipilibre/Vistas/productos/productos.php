<?php
session_start();
// conexion
include("../../metodos/conexion.php");
// agarra variables del form
$nombre_producto = $_POST['Nombre_producto']; 
$descripcion_producto = $_POST['descripcion'];
$precio_producto = $_POST['precio'];
$stock_producto = $_POST['stock'];
$id_usuario_producto = $_SESSION['id_usuario'];

move_uploaded_file($_FILES['imagen_producto']['tmp_name'], $_FILES['imagen_producto']['name']);
$Nombre_imagenes = $_FILES['imagen_producto']['name'];
// la madafakin consulta para ingresar los datos
$_session['imagen_array'] = $Nombre_imagenes;
$sql = "CALL insertar_publicacion('$id_usuario_producto', '$nombre_producto', '$Nombre_imagenes', '$descripcion_producto', '$precio_producto', '$stock_producto')";
if (mysqli_query($conexion, $sql)) {
    header("Location: vista_productos.php");
    echo "sdasds";
    exit();
} else {
        echo "Error: " . mysqli_error($conexion);
    exit();
}   
// no se que cierra pero cierra algo
mysqli_close($conexion);
?>