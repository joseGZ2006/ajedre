<?php

require_once __DIR__ . '/../modelo/conexion.php';
require_once __DIR__ . '/../modelo/clase_usuario.php';

// Verificar si el usuario está logueado
if(!isset($_SESSION['id_ses'])) {
    $_SESSION['flash'] = ['icon' => 'warning', 'title' => 'Acceso Denegado', 'text' => 'Debe iniciar sesión para acceder a esta página.'];
    header("Location: ../loyaut/login.php");
    exit;
}

// Verificar si el usuario está activo
if(isset($_SESSION['est_ses']) && $_SESSION['est_ses'] !== 'activo') {
    session_destroy();
    $_SESSION['flash'] = ['icon' => 'warning', 'title' => 'Usuario Inactivo', 'text' => 'Su usuario está inactivo. Consulte al administrador.'];
    header("Location: ../loyaut/login.php");
    exit;
}

?>