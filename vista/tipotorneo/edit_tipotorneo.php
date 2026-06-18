<?php
session_start();
// Verificar sesión antes de mostrar el dashboard
include_once("../../controlador/verificar_sesion.php");

// Obtener datos de la URL
$id = isset($_GET['id']) ? $_GET['id'] : '';
$nombre = isset($_GET['nom']) ? base64_decode($_GET['nom']) : '';
$tipo = isset($_GET['tipo']) ? base64_decode($_GET['tipo']) : '';

// Si no hay datos, redirigir
if(empty($id) || empty($nombre)) {
    $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'Datos incompletos para editar.'];
    header("Location: ./tipotorneo.php");
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

        <div class="catalog-header">
            <h1 class="page-title">
                <i class="fas fa-edit me-2"></i> Editar Tipo de Torneo
            </h1>

            <a href="./tipotorneo.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i> Volver
            </a>
        </div>

        <div class="form-card">

            <form id="formEditar" method="POST" action="../../controlador/ctl_tipotorneo.php">

                <h3 class="section-title">Actualizar Tipo de Torneo</h3>

                <!-- Campos ocultos -->
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                <input type="hidden" name="nombre_original" value="<?php echo htmlspecialchars(base64_encode($nombre)); ?>">
                <input type="hidden" name="tipo_original" value="<?php echo htmlspecialchars(base64_encode($tipo)); ?>">

                <!-- NOMBRE -->
                <div class="mb-3">
                    <label class="form-label required-star">Nombre</label>
                    <input type="text"
                           class="form-control"
                           id="nombre"
                           name="nombre"
                           value="<?php echo htmlspecialchars($nombre); ?>"
                           placeholder="Ingrese el tipo de torneo"
                           >

                    <div class="invalid-feedback-real" id="nombreFeedback"></div>
                </div>

                <!-- TIPO -->
                <div class="mb-3">
                    <label class="form-label required-star">Tipo</label>
                    <select class="form-select" id="tipo" name="tipo" >
                        <option value="">Seleccione un tipo</option>
                        <option value="individual" <?php echo $tipo == 'individual' ? 'selected' : ''; ?>>Individual</option>
                        <option value="equipo" <?php echo $tipo == 'equipo' ? 'selected' : ''; ?>>Equipo</option>
                        <option value="mixto" <?php echo $tipo == 'mixto' ? 'selected' : ''; ?>>Mixto</option>
                    </select>
                    <div class="invalid-feedback-real" id="tipoFeedback"></div>
                </div>

                <!-- BOTONES -->
                <div class="form-actions">

                    <button type="reset" class="btn btn-danger" id="resetBtn">
                        <i class="fas fa-eraser me-2"></i> Limpiar
                    </button>

                    <button type="submit" class="btn btn-primary" name="actualizar" value="actualizar">
                        <i class="fas fa-save me-2"></i> Actualizar
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
<?php include '../assets/inc/flash.php'; ?>
<!-- JS -->
<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/sweetalert2.all.min.js"></script>
<script src="../assets/js/sidebar.js"></script>
<script src="../assets/js/validaciones_edittipotorneo.js"></script>

</body>
</html>