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
                    <h1 class="page-title"><i class="fas fa-trophy me-2"></i> Información del Torneo</h1>
                </div>
                <a href="./torneo.html" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Volver al catálogo</a>
            </div>

            <div class="detail-avatar">
                <div class="avatar-large">
                    <i class="fas fa-trophy"></i>
                </div>
                <h2 id="detalleNombre">Torneo Nacional de Ajedrez</h2>
                <p class="text-muted"><span>ID: 1</span></p>
            </div>

            <div class="detail-info-grid">
                <!-- INFORMACIÓN DEL TORNEO -->
                <div class="info-group">
                    <label><i class="fas fa-info-circle me-2"></i>Información General</label>
                    
                    <div class="info-row">
                        <span class="info-label">Nombre:</span>
                        <span class="info-value" id="detalleNombreCompleto">Torneo Nacional de Ajedrez</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Estado:</span>
                        <span class="info-value" id="detalleEstado">
                            <span class="badge bg-warning">Próximo</span>
                        </span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Fecha:</span>
                        <span class="info-value" id="detalleFecha">31/05/2026</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Clasificación:</span>
                        <span class="info-value" id="detalleClasificacion">Abierta</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Lugar:</span>
                        <span class="info-value" id="detalleLugar">Caracas</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Categoría:</span>
                        <span class="info-value" id="detalleCategoria">Abierta</span>
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