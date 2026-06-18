<?php
session_start();
// Verificar sesión antes de mostrar el dashboard
include_once("../../controlador/verificar_sesion.php");

// Obtener datos de la URL
$id = isset($_GET['id']) ? base64_decode($_GET['id']) : '';
$nombre = isset($_GET['nom']) ? base64_decode($_GET['nom']) : '';
$tipo = isset($_GET['tipo']) ? base64_decode($_GET['tipo']) : '';

// Si no hay datos, redirigir
if(empty($id) || empty($nombre)) {
    $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'Datos incompletos para mostrar.'];
    header("Location: ./tipotorneo.php");
    exit;
}

// Obtener badge de tipo
function getTipoBadge($tipo) {
    $clases = [
        'individual' => 'bg-primary',
        'equipo' => 'bg-success',
        'mixto' => 'bg-warning'
    ];
    return isset($clases[$tipo]) ? $clases[$tipo] : 'bg-secondary';
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
                    <i class="fas fa-chess-knight me-2"></i> Información de Tipo de Torneo
                </h1>
            </div>

            <a href="./tipotorneo.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Volver al catálogo
            </a>
        </div>

        <!-- AVATAR -->
        <div class="detail-avatar">
            <div class="avatar-large">
                <i class="fas fa-chess-knight"></i>
            </div>

            <h2 id="detalleNombre"><?php echo htmlspecialchars($nombre); ?></h2>

            <p class="text-muted">
                ID: <?php echo htmlspecialchars($id); ?>
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
                        <?php echo htmlspecialchars($nombre); ?>
                    </span>
                </div>

                <div class="info-row">
                    <span class="info-label">Tipo:</span>
                    <span class="info-value">
                        <span class="badge <?php echo getTipoBadge($tipo); ?>">
                            <?php echo ucfirst(htmlspecialchars($tipo)); ?>
                        </span>
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