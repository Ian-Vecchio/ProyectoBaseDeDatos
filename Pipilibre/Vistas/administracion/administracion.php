<?php
session_start();
if (!isset($_SESSION['usuario_logueado'])) {
    header("Location: ../inicio/inicio.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pipilibre - Principal</title>
    <link rel="stylesheet" href="administracion.css">
</head>
<body>

    <div class="contenedor-fondo">
        <header class="barra_superior">
            <img class="logowich_arriba" src="../../imagenes/reallogo.png" alt="Logo">
            <div class="cosas_derecha">
                <div class="crear_producto">
                    <a href="../productos/vista_productos.php"><button>📦Crear Producto📦</button></a>
                </div>
               <div class="conteiner_usuario_arriba">
                <img class="imagen_usuario_inside" src="../../imagenes/logousuario.png" alt="Logo">
                     <?php
                        echo "$_SESSION[usuario_logueado]";
                     ?>
                </div>     
                <div class="barra_derecha">
                    <a href="../principal/principal.php"><button>⬅️Volver a pagina principal⬅️</button></a>
                </div>
            </div>
        </header>

        <div class="conteiner_de_productos">
            <?php
              include("../../metodos/conexion.php");
                $id_usuario_producto = $_SESSION['id_usuario'];
                $resultado = mysqli_query($conexion, "CALL obtener_publicaciones_autor('$id_usuario_producto')");
              while ($fila = mysqli_fetch_assoc($resultado)) {
            ?>
            <div class="container">
                <h2 class="col-nombre"><?php echo $fila['Nombre_Producto']; ?></h2>
                <p class="col-descripcion"><?php echo $fila['descripcion']; ?></p>
                <p class="col-precio">Precio: $<?php echo $fila['precio']; ?></p>
                <p class="col-stock">Stock: <?php echo $fila['stock']; ?></p>
                <div class="boton_eliminar_producto">
                    <form action="../../metodos/sup_pd_especifico.php" method="POST">
                        <input type="hidden" name="id_producto_a_eliminar" value="<?php echo $fila['id_publicacion']; ?>">
                        <button type="submit">Eliminar Producto</button>
                    </form> 
                </div>
            </div>
            <?php
             }
             mysqli_close($conexion);
            ?>
        </div>

        <h5> <a href="..\..\metodos\borrar_todos_tus_productos.php">Borrar Todos Tus Productos </a></h5>
    </div>
    <!-- codigo de javascript(sirve para que cuando clickes en el continer de un producto se expanda)-->
    <script>
    document.querySelectorAll('.container').forEach(tarjeta => {
        tarjeta.addEventListener('click', function(evento) {
            if (evento.target.tagName === 'BUTTON') {
                return;
            }
            this.classList.toggle('expanded');
        });
    });
    </script>
     <!-- termina el codigo de javascript -->

</body>
</html>
