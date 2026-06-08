<?php
session_start();
if (!isset($_SESSION['usuario_logueado'])) {
    header("Location: ../inicio/inicio.php");
}
include("../../metodos/conexion.php");

$id_usuario_actual = $_SESSION['id_usuario'];

$sql = "CALL obtener_envios_usuario('$id_usuario_actual')";

$resultado = mysqli_query($conexion, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pipilibre - mis Envíos</title>
    <link rel="stylesheet" href="envios.css">
</head>
<body>

    <div class="contenedor-fondo">
        <header class="barra_superior">
            <img class="logowich_arriba" src="../../imagenes/reallogo.png" alt="Logo">
            
            <div class="cosas_derecha">
                <div class="conteiner_usuario_arriba">
                    <img class="imagen_usuario_inside" src="../../imagenes/logousuario.png" alt="Logo">
                    <?php echo $_SESSION['usuario_logueado']; ?>
                </div>     
                <div class="barra_derecha">
                    <a href="../principal/principal.php"><button>⬅️Volver a pagina principal⬅️</button></a>
                </div>
            </div>
        </header>

        <div class="conteiner_de_envios">
            <h1 class="titulo_vista">Mis Envios en Curso 🚚</h1>
            
            <?php
            if (mysqli_num_rows($resultado) > 0) {
                while ($fila = mysqli_fetch_assoc($resultado)) {
            ?>
            <div class="container_envio">
                <div class="info_grupo">
                    <span class="etiqueta">N° Envío:</span>
                    <span class="valor">#<?php echo $fila['id_envio']; ?></span>
                </div>
                <div class="info_grupo">
                    <span class="etiqueta">Dirección de Destino:</span>
                    <span class="valor"><?php echo $fila['calle'] . " " . $fila['altura'] . " (CP: " . $fila['codigo_postal'] . ")"; ?></span>
                </div>
                <div class="info_grupo">
                    <span class="etiqueta">Fecha de Salida:</span>
                    <span class="valor_fecha_salida"><?php echo date('d-m-Y H:i', strtotime($fila['fecha_envio'])); ?></span>
                </div>
                <div class="info_grupo">
                    <span class="etiqueta">Fecha Estimada de Llegada:</span>
                    <span class="valor_fecha_llegada"><?php echo date('d-m-Y H:i', strtotime($fila['fecha_llegada'])); ?></span>
                </div>
            </div>
            <?php
                }
            } else {
            ?>
            <div class="sin_envios">
                <h2>No tenés ningún envío registrado actualmente. 📦</h2>
            </div>
            <?php
            }
            mysqli_close($conexion);
            ?>
        </div>
    </div>

</body>
</html>