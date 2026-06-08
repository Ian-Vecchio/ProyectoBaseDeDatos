<?php
session_start();
if (!isset($_SESSION['usuario_logueado'])) {
    header("Location: ../inicio/inicio.php");
    exit();
}
include("../../../metodos/conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pipilibre - Principal</title>
    <link rel="stylesheet" href="usuario.css">
</head>
<body>

    <div class="contenedor-fondo">
        <!--  ahhhh comentario de barra de arriba -->
        <header class="barra_superior">
            <!-- logo de la izquierda-->
            <img class="logowich_arriba" src="../../../imagenes/reallogo.png" alt="Logo">
            <!-- cosobich de la derechovich-->
            <div class="cosas_derecha">
                  
                <!-- -->
                <div class="barra_derecha">
                    <a href="../../principal/principal.php"><button>⬅️Volver a pagina principal⬅️</button></a>
                </div>
            </div>
        </header>
        <?php 
            $id_persona = $_SESSION['id_usuario'];
            $sql = "call salida_info_usuario($id_persona)";
            $resultado = mysqli_query($conexion, $sql);
            $_fila = mysqli_fetch_assoc($resultado);   
            mysqli_free_result($resultado);
            while (mysqli_more_results($conexion) && mysqli_next_result($conexion)) {
            }
        ?>
        <div class="conteiner_de_productos">
    <div class="container-profile">
        
        <div class="profile-header">
            <span class="label">NOMBRE USUARIO</span>
            <h2 class="username"><?php echo !empty($_fila['Nombre_usuario']) ? $_fila['Nombre_usuario'] : '—'; ?></h2>
        </div>
        
        <hr class="divider">
        <div class="profile-grid">
            <div class="info-group">
                <span class="label">Nombre</span>
                <p class="data"><?php echo !empty($_fila['nombre']) ? $_fila['nombre'] : '—'; ?></p>
            </div>

            <div class="info-group">
                <span class="label">Apellido</span>
                <p class="data"><?php echo !empty($_fila['apelldio']) ? $_fila['apelldio'] : '—'; ?></p>
            </div>

            <div class="info-group">
                <span class="label">DNI</span>
                <p class="data"><?php echo !empty($_fila['dni']) ? $_fila['dni'] : '—'; ?></p>
            </div>

            <div class="info-group">
                <span class="label">Email</span>
                <p class="data"><?php echo !empty($_fila['correo_eletronico']) ? $_fila['correo_eletronico'] : '—'; ?></p>
            </div>
        </div>

        <hr class="divider">

        <div class="profile-addresses">
            <span class="label">DIRECCIONES VINCULADAS</span>
            <?php
                $contador_direcciones = 0;
                $id_usuario_producto = $_SESSION['id_usuario'];
                // Ahora esta consulta funcionará sin errores porque la conexión ya está limpia
                $consulta = mysqli_query($conexion, "CALL obtener_direccion_usuario_producto('$id_usuario_producto')");
                while ($fila = mysqli_fetch_assoc($consulta)) {
            ?>
            <div class="container">
                <?php
                    $contador_direcciones = $contador_direcciones + 1;

                ?>
                <h4 class="col-descripcion">N°dirrecion: <?php echo $contador_direcciones; ?></h4>
                <p> ㅤ</p>
                <p class="col-descripcion">Calle: <?php echo $fila['calle']; ?></p>
                <p class="col-descripcion">Altura: <?php echo $fila['altura']; ?></p>
                <p class="col-precio">Código Postal: <?php echo $fila['codigo_postal']; ?></p>
                <p> ㅤ</p>
                <div class="eliminar_direccion">
                    <form action="../../../metodos/eliminar_direccion.php" method="POST">
                        <input type="hidden" name="id_direccion_eliminar" value="<?php echo $fila['id_direccion']; ?>">
                        <button type="submit">Eliminar Direccion</button>
                    </form>  
                </div>
            </div>
            <hr class="divider">
            
            <?php
             }
             
             mysqli_free_result($consulta);
             mysqli_close($conexion);
            ?>
            <p> ㅤ</p>
            <div class="agregar_direccion">
                        <a href="direcciones/vista_direccion.php"><button type="submit">Agregar direccion</button></a>
            </div>
        </div>

    </div>
</div>
    </div>

</body>
</html>
