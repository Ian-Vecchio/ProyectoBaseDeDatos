<?php
session_start();
session_destroy(); // Borra todas las sesiones
header("Location: inicio.html"); // Lo manda al inicio
?>