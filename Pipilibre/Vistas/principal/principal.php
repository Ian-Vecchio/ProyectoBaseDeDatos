<?php
session_start();
if (!isset($_SESSION['usuario_logueado'])) {
    header("Location: ../inicio/inicio.php");
    exit();
}
include("../../metodos/conexion.php");

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pipilibre - Principal</title>
    <link rel="stylesheet" href="principal.css">
</head>
<body>

    <div class="contenedor-fondo">
        <header class="barra_superior">
            <img class="logowich_arriba" src="../../imagenes/reallogo.png" alt="Logo">
            
    <div class="bloque_busqueda">
        <form action="principal.php" method="GET">
            <input type="text" name="busqueda" placeholder="Buscar producto...">
            <button type="submit">🔍</button>
         </form>
    </div>

            <div class="cosas_derecha">
                
                <div class="conteiner_usuario_arriba">
                    <a href="../usuario_y_editar/usuario/usuario.php "><img class="imagen_usuario_inside" src="../../imagenes/logousuario.png" alt="Logo"></a>
                    <?php echo $_SESSION['usuario_logueado']; ?>
                </div>     
                    
                <div class="dinero">
                    <div class="dinero">
                        <?php
                            $id_usuario_actual = $_SESSION['id_usuario'];
                             $sql = "CALL check_saldo($id_usuario_actual)";
    
                            if ($resultado = mysqli_query($conexion, $sql)) {
                                 $datos_usuario = mysqli_fetch_assoc($resultado);
                                 $saldo_actual = $datos_usuario['saldo'];
                                 echo "$ " . $saldo_actual;
                            }
                            while(mysqli_next_result($conexion)){};
                        ?>
                    </div>
                </div>

                <div class="barra_derecha">
                    <div class="dropdown">
                        <button class="btn-menu">Mi Cuenta ▼</button>
                        <div class="dropdown-content">
                            <a href="../productos/vista_productos.php">📦 Crear Producto</a>
                            <a href="../administracion/administracion.php">⚙️ Administracion</a>
                            <a href="../carrito\vista_carrito.php">🛒 Tu Carrito</a> 
                            <a href="../depositar/vista_depostiar.php" >💵 Depositar</a>
                            <a href="../envios\envios.php" >🚚 envios</a>
                            <a href="../../metodos/logout.php" class="opcion-logout">❌ Cerrar sesion</a> 
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <div class="conteiner_de_productos">
            <?php
            include("../../metodos/conexion.php");
            
            $mi_busqueda = isset($_GET["busqueda"]) ? trim($_GET["busqueda"]) : "";
            
            if($mi_busqueda != ""){
                $resultado = mysqli_query($conexion, "CALL buscar_productos('$mi_busqueda')");
            } else{
                $resultado = mysqli_query($conexion, "CALL obtener_todas_publicaciones()");
            }
            while ($fila = mysqli_fetch_assoc($resultado)) {
            ?>
            <div class="container">
                <h2 class="col-nombre"><?php echo $fila['Nombre_Producto']; ?></h2>
                <img class="imagen_pruducto_en_conteneiner" src="../productos/<?php echo $fila['imagen'] ?>" alt="[imagen del producto]" >
                <p class="col-descripcion"><?php echo $fila['descripcion']; ?></p>
                <p class="col-precio">Precio: $<?php echo $fila['precio']; ?></p>
                <p class="col-stock">Stock: <?php echo $fila['stock']; ?></p>
                
                <div class="boton_ver_mas" style="margin-bottom: 10px;">
                    <a href="../publicacion_uni\Publicacion_uni.php?id=<?php echo $fila['id_publicacion']; ?>">
                        <button type="button" style="padding: 10px 20px; background-color: #fffb04; border: 2px solid #000000; border-radius: 5px; font-weight: bold; cursor: pointer;">MAS</button>
                    </a>
                </div>

            </div>
            <?php
             }
             mysqli_close($conexion);
            ?>
        </div>
    </div>

</body>
</html>
