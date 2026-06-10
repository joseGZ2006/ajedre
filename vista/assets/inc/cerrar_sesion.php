<?php
// cerrar_sesion.php
session_start();

// Incluir clase usuario
include("../../../modelo/conexion.php");
include("../../../modelo/clase_usuario.php");

$usuario = new Usuario();


// Destruir sesión
$_SESSION = array();
session_destroy();

// Redirigir
header("Location: ../../loyaut/login.php");
exit();
?>