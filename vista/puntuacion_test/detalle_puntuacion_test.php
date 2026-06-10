<?php
// Verificar sesión antes de mostrar el dashboard
include_once("../../controlador/verificar_sesion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php include '../assets/inc/head.php'; ?>
</head>

<body>
<div class="page-container">

    <!-- SIDEBAR -->
    <?php include '../assets/inc/sidebar.php'; ?>

    <!-- HEADER -->
    <?php include '../assets/inc/header.php'; ?>

    <!-- CONTENIDO -->
    <div class="main-content">
        <div class="detail-header">
            <div class="catalog-header">
                <h1 class="page-title">
                    <i class="fas fa-info-circle me-2"></i> Detalle de Puntuación de Test
                </h1>
            </div>
            <a href="./puntuacion_test.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Volver al catálogo
            </a>
        </div>

        <!-- AVATAR / ICONO -->
        <div class="detail-avatar">
            <div class="avatar-large">
                <i class="fas fa-chess-board"></i>
            </div>
            <h2 id="detalleAsignacion">Asignación #1</h2>
            <p class="text-muted">ID Puntuación: 1</p>
        </div>

        <!-- INFO -->
        <div class="detail-info-grid">
            <div class="info-group">
                <label>
                    <i class="fas fa-chart-bar me-2"></i>
                    Detalles del Test
                </label>
                <div class="info-row">
                    <span class="info-label">Asignación de Clase:</span>
                    <span class="info-value">Asignación #1 (Alumno: Juan Pérez - Clases: Lun/Mie)</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Fecha:</span>
                    <span class="info-value">03/06/2026</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Número de Ronda:</span>
                    <span class="info-value">1</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Puntuación Ronda:</span>
                    <span class="info-value">4.50</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Puntuación Final:</span>
                    <span class="info-value">9.00</span>
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
