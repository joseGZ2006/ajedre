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

            <a href="./especialidad.html" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i> Volver
            </a>
        </div>

        <div class="form-card">

            <form onsubmit="return validarEditarEspecialidad(event)">

                <h3 class="section-title">Actualizar Especialidad</h3>

                <!-- NOMBRE -->
                <div class="mb-3">
                    <label class="form-label required-star">Nombre</label>

                    <input type="text"
                           class="form-control"
                           id="nombre"
                           value="Aperturas de Ajedrez"
                           placeholder="Ingrese la especialidad">

                    <div class="invalid-feedback-real" id="nombreFeedback"></div>
                </div>

                <!-- BOTONES -->
                <div class="form-actions">

                    <button type="reset" class="btn btn-danger" id="resetBtn">
                        <i class="fas fa-eraser me-2"></i> Limpiar
                    </button>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i> Actualizar
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/sweetalert2.all.min.js"></script>

<script src="../assets/js/validaciones_editespecialidad.js"></script>
<script src="../assets/js/sidebar.js"></script>

</body>
</html>