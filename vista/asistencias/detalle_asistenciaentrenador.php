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

    <!-- MAIN -->
    <div class="main-content">

        <div class="detail-header">
            <h1 class="page-title">
                <i class="fas fa-clipboard-list me-2"></i>
                Detalle Asistencia Entrenador
            </h1>

            <a href="./asistencia.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i> Volver
            </a>
        </div>

        <!-- AVATAR -->
        <div class="detail-avatar">
            <div class="avatar-large">
                <i class="fas fa-user-tie"></i>
            </div>
            <h2 id="detalleNombreEntrenador">Carlos Pérez</h2>
        </div>

        <!-- INFO -->
        <div class="detail-info-grid">

            <div class="info-group">
                <label><i class="fas fa-info-circle me-2"></i>Información de Asistencia</label>

                <div class="info-row">
                    <span class="info-label">Fecha:</span>
                    <span class="info-value" id="detalleFecha">2026-05-15</span>
                </div>

                <div class="info-row">
                    <span class="info-label">Hora:</span>
                    <span class="info-value" id="detalleHora">09:00 AM</span>
                </div>

                <div class="info-row">
                    <span class="info-label">Alumnos entrenados:</span>
                    <span class="info-value" id="detalleAlumnos">12</span>
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