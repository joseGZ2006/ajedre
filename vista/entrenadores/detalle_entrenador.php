<?php
session_start();
include("../../modelo/conexion.php");
include("../../modelo/clase_entrenador.php");


// Verificar sesión antes de mostrar el dashboard
include_once("../../controlador/verificar_sesion.php");


$ced = isset($_GET['ced']) ? base64_decode($_GET['ced']) : null;

$ent = new Entrenador();
$datos = $ent->ConsultarEntrenador($ced);

if(!$datos) {
    $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'Entrenador no encontrado'];
    header("Location: ./entrenador.php");
    exit;
}

$id_entrenador = $datos[0];
$cedula = $datos[1];
$nombre = $datos[2];
$apellido = $datos[3];
$telefono = $datos[4];
$id_usuario = $datos[5];
$id__especialidad = $datos[6];
$nombre_usuario = $datos[7];
$rol = $datos[8];
$especialidad_nombre = $datos[9];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php include '../assets/inc/head.php'; ?>
</head>

<body>
<div class="page-container">
    <?php include '../assets/inc/sidebar.php'; ?>
    <?php include '../assets/inc/header.php'; ?>

    <div class="main-content">
        <div class="detail-header">
            <div class="catalog-header">
                <h1 class="page-title"><i class="fas fa-chalkboard-user me-2"></i> Información del Entrenador</h1>
            </div>
            <a href="./entrenador.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Volver al catálogo</a>
        </div>

        <div class="detail-avatar">
            <div class="avatar-large">
                <i class="fas fa-chalkboard-user"></i>
            </div>
            <h2><?php echo htmlspecialchars($nombre . ' ' . $apellido); ?></h2>
            <p class="text-muted"><span>Cédula: <?php echo htmlspecialchars($cedula); ?></span></p>
        </div>

        <div class="detail-info-grid">
            <div class="info-group">
                <label><i class="fas fa-user me-2"></i>Información Personal</label>

                <div class="info-row">
                    <span class="info-label">Cédula:</span>
                    <span class="info-value"><?php echo htmlspecialchars($cedula); ?></span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Nombres:</span>
                    <span class="info-value"><?php echo htmlspecialchars($nombre); ?></span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Apellidos:</span>
                    <span class="info-value"><?php echo htmlspecialchars($apellido); ?></span>
                </div>
                
                
                <div class="info-row">
                    <span class="info-label">Teléfono:</span>
                    <span class="info-value"><?php echo htmlspecialchars($telefono ?: 'No tiene teléfono'); ?></span>
                </div>

                <div class="info-row">
                    <span class="info-label">Especialidad:</span>
                    <span class="info-value"><?php echo htmlspecialchars($especialidad_nombre ?: 'No tiene especialidad asignada'); ?></span>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/sidebar.js"></script>
</body>
</html>