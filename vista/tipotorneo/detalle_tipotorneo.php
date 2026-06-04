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
                    <i class="fas fa-chess-knight me-2"></i> Información de Tipo de Torneo
                </h1>
            </div>

            <a href="./tipotorneo.html" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Volver al catálogo
            </a>
        </div>

        <!-- AVATAR -->
        <div class="detail-avatar">
            <div class="avatar-large">
                <i class="fas fa-chess-knight"></i>
            </div>

            <h2 id="detalleNombre">Blitz</h2>

            <p class="text-muted">
                ID: 1
            </p>
        </div>

        <!-- INFO -->
        <div class="detail-info-grid">

            <div class="info-group">
                <label>
                    <i class="fas fa-chess-knight me-2"></i>
                    Información del Tipo de Torneo
                </label>

                <div class="info-row">
                    <span class="info-label">Nombre:</span>
                    <span class="info-value" id="detalleTipoTorneo">
                        Blitz
                    </span>
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