<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuarios</title>
    <link rel="stylesheet" href="inicio.css">
</head>
<body>

    <div class="contenedor-fondo">
        
        <div class="barra_superior">
            <img class="logowich_arriba" src="../../imagenes/reallogo.png" alt="">    
        </div>
        <div class="container">
            <h2>Iniciar Sesion</h2>
            <form action="../../metodos\login.php" method="POST">
                <?php if (isset($_SESSION['trigger_regirtro_exitoso'])): ?>
                        <div class="alerta_verde_afuera">
                            <div class="alerta_verde_dentro">
                                !has registrado correctamente!
                           </div>
                        </div>
                <?php 
                   unset($_SESSION['trigger_regirtro_exitoso']); 
                   endif; 
                ?>
                <!-- de que se cerro sesion -->
                <?php if (isset($_SESSION['trigger_logout'])): ?>
                        <div class="alerta_naranja_afuera">
                           <div class="alerta_verde_dentro">
                                !Cuenta cerrada efectivamente!
                           </div>
                        </div>
                <?php 
                   unset($_SESSION['trigger_logout']); 
                   endif; 
                 
                ?>
                <?php if (isset($_SESSION['trigger_inicio_error'])): ?>
                     <div class="alerta_roja_afuera">
                             <div class="alerta_verde_dentro">
                                !Cuenta o contraseña incorrecta¡ o carcater invalido
                             </div>
                     </div>
                <?php 
                    unset($_SESSION['trigger_inicio_error']); 
                    endif;
                ?>
                 <p></p>
                <label>Nombre usuario:</label>
                <input type="text" name="Nombre" placeholder="su usuario" required>
                
                <label>contraseña:</label>
                <input type="password" name="pass" placeholder="su contrasñea" required>
                
                <button type="submit">iniciar sesion</button>
            
            </form>
            <!-- por si no tienen una cuntardopolis -->
            ¿todavia no tienes una cuenta?<a href="../registro/vista_registro.php">Crear cuenta</a>
        </div>

    </div>

</body>
</html>