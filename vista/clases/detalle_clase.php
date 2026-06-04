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
                    <h1 class="page-title"><i class="fas fa-chess-board me-2"></i> Información de la Clase</h1>
                </div>
                <a href="./clase.html" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Volver al catálogo</a>
            </div>

            <div class="detail-avatar">
                <div class="avatar-large">
                    <i class="fas fa-chalkboard-user"></i>
                </div>
                <h2>Ajedrez Básico</h2>
            </div>

            <div class="detail-info-grid">
                <!-- INFORMACIÓN DE LA CLASE -->
                <div class="info-group">
                    <label><i class="fas fa-info-circle me-2"></i>Detalles de la Clase</label>
                    
                    <div class="info-row">
                        <span class="info-label">ID Clase:</span>
                        <span class="info-value" id="detalleIdClase">1</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Nombre:</span>
                        <span class="info-value" id="detalleNombre">Ajedrez Básico</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Hora Inicio:</span>
                        <span class="info-value" id="detalleHoraInicio">09:00 AM</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Hora Fin:</span>
                        <span class="info-value" id="detalleHoraFin">11:00 AM</span>
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