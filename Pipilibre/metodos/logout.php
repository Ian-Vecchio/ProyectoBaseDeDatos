<?php

session_start(); 
session_destroy(); 

session_start(); 
$_SESSION ['trigger_logout'] = 'pesnequelahabia olvidado turun tun';
header("Location: ../Vistas/inicio/inicio.php");
?>