<?php
session_start();
// Verificar sesión antes de mostrar el dashboard
include_once("../../controlador/verificar_sesion.php");

// Obtener datos de la URL
$id = isset($_GET['id']) ? base64_decode($_GET['id']) : '';
$nombre = isset($_GET['nom']) ? base64_decode($_GET['nom']) : '';
$fecha = isset($_GET['fecha']) ? base64_decode($_GET['fecha']) : '';
$lugar = isset($_GET['lugar']) ? base64_decode($_GET['lugar']) : '';
$categoria = isset($_GET['categoria']) ? base64_decode($_GET['categoria']) : '';
$clasificacion = isset($_GET['clasificacion']) ? base64_decode($_GET['clasificacion']) : '';
$estatus = isset($_GET['estatus']) ? base64_decode($_GET['estatus']) : '';
$cupo = isset($_GET['cupo']) ? base64_decode($_GET['cupo']) : '';
$tipoNombre = isset($_GET['tipoNombre']) ? base64_decode($_GET['tipoNombre']) : 'Sin tipo';

// Si no hay datos, redirigir
if(empty($id) || empty($nombre)) {
    $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'Datos incompletos para mostrar.'];
    header("Location: ./torneo.php");
    exit;
}

// Obtener badge de estatus
function getEstatusBadge($estatus) {
    $clases = [
        'proximo' => 'bg-info',
        'en_curso' => 'bg-success',
        'finalizado' => 'bg-secondary',
        'cancelado' => 'bg-danger'
    ];
    return isset($clases[$estatus]) ? $clases[$estatus] : 'bg-secondary';
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
                    <i class="fas fa-trophy me-2"></i> Información del Torneo
                </h1>
            </div>

            <a href="./torneo.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Volver al catálogo
            </a>
        </div>

        <!-- AVATAR -->
        <div class="detail-avatar">
            <div class="avatar-large">
                <i class="fas fa-trophy"></i>
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
                    <i class="fas fa-trophy me-2"></i>
                    Información del Torneo
                </label>

                <div class="info-row">
                    <span class="info-label">Nombre:</span>
                    <span class="info-value"><?php echo htmlspecialchars($nombre); ?></span>
                </div>

                <div class="info-row">
                    <span class="info-label">Tipo de Torneo:</span>
                    <span class="info-value">
                        <span class="badge <?php echo getTipoBadge($tipoNombre); ?>">
                            <?php echo htmlspecialchars($tipoNombre); ?>
                        </span>
                    </span>
                </div>

                <div class="info-row">
                    <span class="info-label">Fecha:</span>
                    <span class="info-value"><?php echo date('d/m/Y', strtotime($fecha)); ?></span>
                </div>

                <div class="info-row">
                    <span class="info-label">Lugar:</span>
                    <span class="info-value"><?php echo htmlspecialchars($lugar); ?></span>
                </div>

                <?php if(!empty($categoria)): ?>
                <div class="info-row">
                    <span class="info-label">Categoría:</span>
                    <span class="info-value"><?php echo htmlspecialchars($categoria); ?></span>
                </div>
                <?php endif; ?>

                <?php if(!empty($clasificacion)): ?>
                <div class="info-row">
                    <span class="info-label">Clasificación:</span>
                    <span class="info-value"><?php echo htmlspecialchars($clasificacion); ?></span>
                </div>
                <?php endif; ?>

                <div class="info-row">
                    <span class="info-label">Estatus:</span>
                    <span class="info-value">
                        <span class="badge <?php echo getEstatusBadge($estatus); ?>">
                            <?php echo ucfirst(htmlspecialchars($estatus)); ?>
                        </span>
                    </span>
                </div>

                <div class="info-row">
                    <span class="info-label">Cupo:</span>
                    <span class="info-value"><?php echo htmlspecialchars($cupo); ?> participantes</span>
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