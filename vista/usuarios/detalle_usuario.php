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
                    <i class="fas fa-info-circle me-2"></i> Detalle de Usuario
                </h1>
            </div>
            <a href="./usuario.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Volver al catálogo
            </a>
        </div>

        <!-- AVATAR / ICONO -->
        <div class="detail-avatar">
            <div class="avatar-large">
                <i class="fas fa-user-cog"></i>
            </div>
            <h2 id="detalleNombreUsuario">marcos_perez</h2>
            <p class="text-muted">ID Usuario: 2</p>
        </div>

        <!-- INFO -->
        <div class="detail-info-grid">
            <div class="info-group">
                <label>
                    <i class="fas fa-id-card me-2"></i>
                    Información de Usuario
                </label>
                <div class="info-row">
                    <span class="info-label">Nombre de Usuario:</span>
                    <span class="info-value">marcos_perez</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Rol:</span>
                    <span class="info-value"><span class="badge bg-info">Entrenador</span></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Estatus:</span>
                    <span class="info-value"><span class="badge bg-success">Activo</span></span>
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
