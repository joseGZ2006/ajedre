<?php
session_start();
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
                    <i class="fas fa-info-circle me-2"></i> Detalle de Inscripción a Torneo
                </h1>
            </div>
            <a href="./inscripcion_torneo.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Volver al catálogo
            </a>
        </div>

        <!-- AVATAR / ICONO -->
        <div class="detail-avatar">
            <div class="avatar-large">
                <i class="fas fa-trophy"></i>
            </div>
            <h2 id="detalleAlumno">Juan Pérez</h2>
            <p class="text-muted">ID Inscripción: 1</p>
        </div>

        <!-- INFO -->
        <div class="detail-info-grid">
            <div class="info-group">
                <label>
                    <i class="fas fa-clipboard-list me-2"></i>
                    Información General
                </label>
                <div class="info-row">
                    <span class="info-label">Alumno:</span>
                    <span class="info-value">Juan Pérez</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Torneo:</span>
                    <span class="info-value">Torneo Escolar Primavera</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Fecha de Inscripción:</span>
                    <span class="info-value">03/06/2026</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Estatus:</span>
                    <span class="info-value"><span class="badge bg-warning">Pendiente</span></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Estado de Pago:</span>
                    <span class="info-value"><span class="badge bg-danger">No Pagado</span></span>
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
