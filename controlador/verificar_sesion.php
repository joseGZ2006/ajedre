<?php
// verificar_sesion.php
session_start();

// Verificar si el usuario está logueado
if(!isset($_SESSION['id_ses'])) {
    $_SESSION['flash'] = ['icon' => 'warning', 'title' => 'Acceso Denegado', 'text' => 'Debe iniciar sesión para acceder a esta página.'];
    header("Location: ../loyaut/login.php");
    exit;
}

// Verificar si el usuario está activo
if(isset($_SESSION['est_ses']) && $_SESSION['est_ses'] !== 'activo') {
    // Registrar cierre por inactividad
    if(isset($_SESSION['id_ses']) && isset($_SESSION['usu_ses'])) {
        $usuario = new Usuario();
        $usuario->registrarBitacoraSesion(
            $_SESSION['id_ses'],
            'CIERRE_SESION_INACTIVO',
            "Usuario {$_SESSION['usu_ses']} cerró sesión por inactividad"
        );
    }
    
    session_destroy();
    $_SESSION['flash'] = ['icon' => 'warning', 'title' => 'Usuario Inactivo', 'text' => 'Su usuario está inactivo. Consulte al administrador.'];
    header("Location: ../loyaut/login.php");
    exit;
}

// Verificar tiempo de inactividad (30 minutos)
$tiempo_maximo = 1800; // 30 minutos en segundos
if(isset($_SESSION['ultimo_acceso']) && (time() - $_SESSION['ultimo_acceso'] > $tiempo_maximo)) {
    // Cerrar sesión por inactividad
    if(isset($_SESSION['id_ses']) && isset($_SESSION['usu_ses'])) {
        $usuario = new Usuario();
        $usuario->registrarBitacoraSesion(
            $_SESSION['id_ses'],
            'CIERRE_SESION_INACTIVIDAD',
            "Usuario {$_SESSION['usu_ses']} cerró sesión por inactividad ({$tiempo_maximo} segundos)"
        );
    }
    
    session_unset();
    session_destroy();
    $_SESSION['flash'] = ['icon' => 'warning', 'title' => 'Sesión Expirada', 'text' => 'Su sesión ha expirado por inactividad.'];
    header("Location: ../loyaut/login.php");
    exit;
}

// Actualizar último acceso
$_SESSION['ultimo_acceso'] = time();
?>