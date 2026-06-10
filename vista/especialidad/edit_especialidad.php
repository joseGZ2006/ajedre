<?php
session_start();


// Verificar sesión antes de mostrar el dashboard
include_once("../../controlador/verificar_sesion.php");


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

        <div class="catalog-header">
            <h1 class="page-title">
                <i class="fas fa-edit me-2"></i> Editar Especialidad
            </h1>

            <a href="./especialidad.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i> Volver
            </a>
        </div>

        <div class="form-card">

            <form method="POST" action="../../controlador/ctl_especialidad.php" id="especialidadForm" onsubmit="return validarEspecialidad(event)">
                
                <input type="hidden" name="id" value="<?php echo base64_encode($id); ?>">
                <input type="hidden" name="nombre_original" value="<?php echo base64_encode($nom); ?>">

                <h3 class="section-title">Actualizar Especialidad</h3>

                <!-- NOMBRE -->
                <div class="mb-3">
                    <label class="form-label required-star">Nombre</label>

                    <input type="text"
                           class="form-control"
                           id="nombre"
                           name="nombre"
                           value="<?php echo htmlspecialchars($nom); ?>"
                           placeholder="Ingrese la especialidad"
                           required>

                    <div class="invalid-feedback-real" id="nombreFeedback"></div>
                </div>

                <!-- BOTONES -->
                <div class="form-actions">

                    <button type="button" class="btn btn-danger" id="resetBtn">
                        <i class="fas fa-eraser me-2"></i> Limpiar
                    </button>

                    <button type="submit" name="actualizar" value="actualizar" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i> Actualizar
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<?php include '../assets/inc/flash.php'; ?>
<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/sweetalert2.all.min.js"></script>
<script src="../assets/js/sidebar.js"></script>
<script src="../assets/js/validaciones_especialidad.js"></script>

</body>
</html>