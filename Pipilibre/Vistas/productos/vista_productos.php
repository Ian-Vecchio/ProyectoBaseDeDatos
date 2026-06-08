
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
    <link rel="stylesheet" href="productos.css">
</head>
<body>

    <div class="contenedor-fondo">
        <!--  ahhhh comentario de barra de arriba -->
        <header class="barra_superior">
            <!-- logo de la izquierda-->
            <img class="logowich_arriba" src="../../imagenes/reallogo.png" alt="Logo">
            <!-- cosobich de la derechovich-->
            <div class="cosas_derecha">
               <div class="conteiner_usuario_arriba">
                 <!-- los madafakin select de dinero y el nombre del usuairo -->

                <img class="imagen_usuario_inside" src="../../imagenes/logousuario.png" alt="Logo">
                     <?php
                        echo "$_SESSION[usuario_logueado]";
                     ?>
                </div>     
                <!-- -->
                <div class="barra_derecha">
                    <a href="../principal/principal.php"><button>⬅️Volver a pagina principal⬅️</button></a>
                </div>
            </div>
        </header>
    
        <!-- aca deberian ir los poducto pero por el momento la re paja -->
        <div class="conteiner_de_productos">
            <div class="container">
                <form action="productos.php" method="POST" enctype="multipart/form-data">
                <!--  todo el form para ingresar datos -->
                <label>Ingrese nombre del producto:</label>
                 <p></p>
                <input type="text" name="Nombre_producto" placeholder="ej:juan123" required>
                 <!-- -->
                <label>Descripcion del producto:</label>
                <input type="text" name="descripcion" placeholder="Las caracteristicas del prdcto son:" required>
                <!-- -->
                <label>imagen del producto. se recomienda imagen cuadrada</label>
                <input type="file" name="imagen_producto" placeholder="" >
                <!-- -->
                <label>Precio</label>
                <input type="number" name="precio" placeholder="precio del producto" step="0.01" min="0.01" required>
                <!-- -->
                <label>stock</label>
                <input type="number" name="stock" placeholder="cantidad en stock" step="1" min="1" required>
                <!-- -->
                <button type="submit" style="width: 100%; padding: 10px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;">Registar Producto</button>
                <!-- -->
            </form>
            </div>
        
   </div> </div>

</body>
</html>