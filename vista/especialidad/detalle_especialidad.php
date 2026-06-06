<?php
session_start();
// Recibir y decodificar los parámetros
$id = isset($_GET['id']) ? base64_decode($_GET['id']) : '';
$nom = isset($_GET['nom']) ? base64_decode($_GET['nom']) : '';

// Validar que los datos existen
if(empty($id) || empty($nom)) {
    $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'Datos de especialidad no válidos.'];
    header("Location: ./especialidad.php");
    exit;
}
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
                    <i class="fas fa-chess-knight me-2"></i> Información de Especialidad
                </h1>
            </div>

            <a href="./especialidad.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i> Volver al catálogo
            </a>
        </div>

        <!-- AVATAR -->
        <div class="detail-avatar">
            <div class="avatar-large">
                <i class="fas fa-chess-knight"></i>
            </div>

            <h2 id="detalleNombre"><?php echo htmlspecialchars($nom); ?></h2>

            <p class="text-muted">
                ID: <?php echo htmlspecialchars($id); ?>
            </p>
        </div>

        <!-- INFO -->
        <div class="detail-info-grid">

            <div class="info-group">
                <label>
                    <i class="fas fa-chess-knight me-2"></i>
                    Información de la Especialidad
                </label>

                <div class="info-row">
                    <span class="info-label">Nombre:</span>
                    <span class="info-value" id="detalleEspecialidad">
                        <?php echo htmlspecialchars($nom); ?>
                    </span>
                </div>

            </div>

        </div>

    </div>
</div>

<?php include '../assets/inc/flash.php'; ?>
<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/sidebar.js"></script>

</body>
</html>