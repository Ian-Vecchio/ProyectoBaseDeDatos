<?php
session_start();
if (!isset($_SESSION['usuario_logueado'])) {
    header("Location: ../inicio/inicio.php");
    exit();
}
include("../../metodos/conexion.php");

$id_usuario_actual = $_SESSION['id_usuario'];

$sql = "CALL obtener_carrito_usuario('$id_usuario_actual')";
$resultado = mysqli_query($conexion, $sql);

$total_carrito = 0;
$productos_en_carrito = [];
if ($resultado && mysqli_num_rows($resultado) > 0) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $total_carrito += ($fila['precio'] * $fila['cantidad']);
        $productos_en_carrito[] = $fila;
    }
}

mysqli_next_result($conexion); 

// 2. LLAMADA A LAS DIRECCIONES
$sql_direcciones = "CALL obtener_direcciones_usuario('$id_usuario_actual')";
$resultado_direcciones = mysqli_query($conexion, $sql_direcciones);
?>
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pipilibre - Mi Carrito</title>
    <link rel="stylesheet" href="carrito.css">
</head>
<body>

    <div class="contenedor-fondo">
        <header class="barra_superior">
            <img class="logowich_arriba" src="../../imagenes/reallogo.png" alt="Logo">
            
            <div class="cosas_derecha">
                <?php if ($total_carrito > 0): ?>
                <div class="bloque_comprar_todo">
                    <form action="../../metodos/procesar_compra_total_carrito.php" method="POST" style="display: flex; align-items: center; gap: 10px;">
                        
                        <select name="id_direccion_envio" required style="padding: 8px; border-radius: 5px; border: 2px solid #000; font-weight: bold; cursor: pointer;">
                            <option value="" disabled selected>Selecciona una dirección de envío</option>
                            <?php while($dir = mysqli_fetch_assoc($resultado_direcciones)): ?>
                                <option value="<?php echo $dir['id_direccion']; ?>">
                                    <?php echo $dir['calle'] . " " . $dir['altura'] . " (CP: " . $dir['codigo_postal'] . ")"; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>

                        <button type="submit" style="padding: 8px 15px; background-color: #66ff00; border: 2px solid #ffffff; border-radius: 5px; font-weight: bold; cursor: pointer;">🛒 Comprar Todo ($<?php echo $total_carrito; ?>)</button>
                    </form>
                </div>
                <?php endif; ?>

                <div class="conteiner_usuario_arriba">
                    <img class="imagen_usuario_inside" src="../../imagenes/logousuario.png" alt="Logo">
                    <?php echo $_SESSION['usuario_logueado']; ?>
                </div>     
                <div class="barra_derecha">
                    <a href="../principal/principal.php"><button>⬅️Volver a pagina principal⬅️</button></a>
                </div>
            </div>
        </header>

        <div class="conteiner_de_productos">
            <?php
            if (count($productos_en_carrito) > 0) {
                foreach ($productos_en_carrito as $item) {
            ?>
            <div class="container">
                <img class="imagen_pruducto_en_conteneiner" src="../productos/<?php echo $item['imagen']; ?>" alt="[imagen]">
                <h2 class="col-nombre"><?php echo $item['Nombre_Producto']; ?></h2>
                <p class="col-precio">Precio: $<?php echo $item['precio']; ?></p>
                <p class="col-cantidad">Cant: <?php echo $item['cantidad']; ?></p>
                <p class="col-subtotal">Subtotal: $<?php echo ($item['precio'] * $item['cantidad']); ?></p>
                
                <div class="boton_eliminar_producto">
                    <form action="../../metodos/eliminar_producto_carrito.php" method="POST">
                        <input type="hidden" name="id_producto_eliminar" value="<?php echo $item['id_publicacion']; ?>">
                        <button type="submit">Quitar</button>
                    </form>  
                </div>
            </div>
            <?php
                }
            } else {
            ?>
            <div class="carrito_vacio">
                <h2>Tu carrito está vacío 🛒</h2>
            </div>
            <?php
            }
            mysqli_close($conexion);
            ?>
        </div>
    </div>

</body>
</html>