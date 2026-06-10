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

        <!-- MAIN CONTENT - DETALLE -->
        <div class="main-content">
            <div class="detail-header">
                <div class="catalog-header">
                    <h1 class="page-title"><i class="fas fa-user-edit me-2"></i> Información del Representante</h1>
                </div>
                <a href="./representante.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Volver al catálogo</a>
            </div>

            <div class="detail-avatar">
                <div class="avatar-large">
                    <i class="fas fa-user-friends"></i>
                </div>
                <h2>María Pérez</h2>
                <p class="text-muted"><span>ID: 1 | Cédula: 12345678</span></p>
            </div>

            <div class="detail-info-grid">
                <!-- INFORMACIÓN PERSONAL -->
                <div class="info-group">
                    <label><i class="fas fa-user me-2"></i>Información Personal</label>
                    
                    <div class="info-row">
                        <span class="info-label">Nombre:</span>
                        <span class="info-value" id="detalleNombre">María</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Apellido:</span>
                        <span class="info-value" id="detalleApellido">Pérez</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Cédula:</span>
                        <span class="info-value" id="detalleCedula">12.345.678</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Teléfono:</span>
                        <span class="info-value" id="detalleTelefono">0412-1234567</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Correo Electrónico:</span>
                        <span class="info-value" id="detalleCorreo">maria.perez@example.com</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Parentesco:</span>
                        <span class="info-value" id="detalleParentesco">Madre</span>
                    </div>
                </div>

                <!-- ALUMNOS ASOCIADOS -->
                <div class="info-group">
                    <label><i class="fas fa-user-graduate me-2"></i>Alumnos Asociados</label>
                    
                    <div class="info-row">
                        <span class="info-label">Alumno 1:</span>
                        <span class="info-value">Juan Pérez (Cédula: 12345678)</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Alumno 2:</span>
                        <span class="info-value">Ana Pérez (Cédula: 87654321)</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Total alumnos:</span>
                        <span class="info-value"><strong>2 alumnos</strong></span>
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