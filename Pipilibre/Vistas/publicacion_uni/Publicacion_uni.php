<?php
session_start();
if (!isset($_SESSION['usuario_logueado'])) {
    header("Location: ../inicio/inicio.php");
    exit();
}
include("../../metodos/conexion.php");

if (!isset($_GET['id'])) {
    header("Location: ../principal/principal.php");
    exit();
}

// agarro el id que viene por url
$idprod = $_GET['id'];

$query_busca = "CALL obtener_publicacion_por_id('$idprod')";
$resul1 = mysqli_query($conexion, $query_busca);

if (mysqli_num_rows($resul1) == 0) {
    header("Location: ../principal/principal.php");
    exit();
}

$info_prod = mysqli_fetch_assoc($resul1);

mysqli_next_result($conexion); 
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pipilibre - <?php echo $info_prod['Nombre_Producto']; ?></title>
    <link rel="stylesheet" href="Publicacion_uni.css">
</head>
<body>

    <div class="contenedor-fondo">
        <header class="barra_superior">
            <img class="logowich_arriba" src="../../imagenes/reallogo.png" alt="Logo">
            
            <div class="cosas_derecha">
                <div class="conteiner_usuario_arriba">
                    <img class="imagen_usuario_inside" src="../../imagenes/logousuario.png" alt="Usuario">
                    <?php echo $_SESSION['usuario_logueado']; ?>
                </div>     
                <div class="barra_derecha">
                    <a href="../principal/principal.php"><button>⬅️Volver a pagina principal⬅️</button></a>
                </div>
            </div>
        </header>

        <main class="bloque_detalle_producto">
            
            <div class="columna_izquierda">
                <div class="caja_imagen">
                    <img src="../productos/<?php echo $info_prod['imagen']; ?>" alt="Imagen del producto">
                </div>
                
                <div class="botones_accion">
                    <form action="../../metodos/procesar_compra.php" method="POST">
                        <input type="hidden" name="id_producto_comprado" value="<?php echo $info_prod['id_publicacion']; ?>">
                        
                        <?php
                        $user_actual = $_SESSION['id_usuario'];
                        
                        $sql_dir = "CALL obtener_direcciones_por_usuario('$user_actual')";
                        $resul_dir = mysqli_query($conexion, $sql_dir);
                        
                        ?>
                        
                        <select name="id_direccion_envio" required>
                            <option value="" disabled selected>Selecciona direccion de envio</option>
                            <?php while($dire = mysqli_fetch_assoc($resul_dir)): ?>
                                <option value="<?php echo $dire['id_direccion']; ?>">
                                    <?php echo $dire['calle'] . " " . $dire['altura'] . " (CP: " . $dire['codigo_postal'] . ")"; ?>
                                </option>
                            <?php endwhile; ?>
                        </select>

                        <?php 
                        mysqli_next_result($conexion); 
                        ?>

                        <button type="submit" class="btn-comprar">COMPRAR</button>
                    </form>

                    <form action="../../metodos/agregar_carrito.php" method="POST">
                        <input type="hidden" name="id_producto_carrito" value="<?php echo $info_prod['id_publicacion']; ?>">
                        <button type="submit" class="btn-carrito">CARRITO</button>
                    </form>
                </div>
            </div>

            <div class="columna_derecha">
                <h1 class="titulo_producto"><?php echo $info_prod['Nombre_Producto']; ?></h1>
                <hr class="separador">
                <p class="descripcion_producto"><?php echo $info_prod['descripcion']; ?></p>
                <hr class="separador">
                <h2 class="precio_producto">Precio: $<?php echo $info_prod['precio']; ?></h2>
                <p class="stock_producto">STOCK: <?php echo $info_prod['stock']; ?></p>
            </div>

        </main>

        <div class="seccion_reseñas">
            
            <div class="contenedor_formulario_reseña">
                <h3>Dejar una opinion del producto</h3>
                <form action="../../metodos/agregar_reseña.php" method="POST">
                    <input type="hidden" name="id_publicacion_reseña" value="<?php echo $idprod; ?>">
                    <textarea name="comentario_reseña" placeholder="Escribi aca que te parecio el producto..." required></textarea>
                    <button type="submit">Publicar Reseña</button>
                </form>
            </div>

            <div class="lista_reseñas_publicadas">
                <h3>Opiniones de otros compradores</h3>
                <?php
                $sql_rese = "CALL obtener_reseñas_publicacion('$idprod')";
                $res_rese = mysqli_query($conexion, $sql_rese);

                if ($res_rese && mysqli_num_rows($res_rese) > 0) {
                    while ($r = mysqli_fetch_assoc($res_rese)):
                ?>
                <div class="tarjeta_reseña">
                    <div class="cabecera_reseña">
                        <span class="usuario_reseña">Comentario</span>
                        <span class="fecha_reseña"><?php echo date('d-m-Y H:i', strtotime($r['fecha'])); ?></span>
                    </div>
                    <p class="comentario_texto"><?php echo $r['reseña']; ?></p>
                </div>
                <?php
                    endwhile;
                    mysqli_next_result($conexion);
                } else {
                ?>
                <div class="sin_reseñas">
                    <p>Este producto todavia no tiene reseñas. ¡Se el primero!</p>
                </div>
                <?php
                }
                ?>
            </div>

        </div>

    </div>

</body>
</html>
<?php mysqli_close($conexion); ?>
