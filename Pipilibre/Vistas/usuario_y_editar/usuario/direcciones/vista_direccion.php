
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
    <link rel="stylesheet" href="direccion.css">
</head>
<body>

    <div class="contenedor-fondo">
        <div class="barra_superior">
            <img class="logowich_arriba" src="../../../../imagenes/reallogo.png" alt="Logo">
            <div class="cosas_derecha">
               <div class="conteiner_usuario_arriba">

                <img class="imagen_usuario_inside" src="../../../../imagenes/logousuario.png" alt="Logo">
                     <?php
                        echo "$_SESSION[usuario_logueado]";
                     ?>
                </div>     
                <div class="barra_derecha">
                    <a href="../usuario.php"><button>⬅️Volver Tu Usuario⬅️</button></a>
                </div>
            </div>
        </div>
    
        <div class="conteiner_de_productos">
            <div class="container">
                <form action="direccion.php" method="POST" enctype="multipart/form-data">
                <label>Crear una direccion</label>
                <label>Calle:</label>
                <input type="text" name="Calle" placeholder="Nombre de calle:" required>
                <!-- -->
                <label>altura:</label>
                <input type="number" name="Altura" placeholder="Altura de la calle:" min="1" required>
                <!-- -->
                <label>Codigo postal:</label>
                <input type="number" name="Postal" placeholder="Codigo Postal:" step="1" min="1" required>
                <!-- -->
                <button type="submit" style="width: 100%; padding: 10px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer; font-size: 16px;">Registrar Direccion</button>
                <!-- -->
            </form>
            </div>
        
   </div> </div>

</body>
</html>