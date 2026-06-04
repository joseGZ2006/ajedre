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
                    <i class="fas fa-edit me-2"></i> Editar Puntuación de Test
                </h1>
                <a href="./puntuacion_test.html" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Volver
                </a>
            </div>

            <div class="form-card">
                <form onsubmit="return validarPuntuacionTest(event)">
                    <h3 class="section-title">Actualizar Puntuación de Test</h3>

                    <!-- ASIGNACION CLASE -->
                    <div class="mb-3">
                        <label class="form-label required-star">Asignación de Clase</label>
                        <select class="form-select" id="idAsignacionClase">
                            <option value="">Seleccione una asignación de clase</option>
                            <option value="1" selected>Asignación #1 (Alumno: Juan Pérez - Clases: Lun/Mie)</option>
                            <option value="2">Asignación #2 (Alumno: Jose Pérez - Clases: Mar/Jue)</option>
                        </select>
                        <div class="invalid-feedback-real" id="idAsignacionClaseFeedback"></div>
                    </div>

                    <!-- FECHA -->
                    <div class="mb-3">
                        <label class="form-label required-star">Fecha</label>
                        <input type="date" class="form-control" id="fecha" value="2026-06-03">
                        <div class="invalid-feedback-real" id="fechaFeedback"></div>
                    </div>

                    <!-- NUMERO RONDA -->
                    <div class="mb-3">
                        <label class="form-label required-star">Número de Ronda</label>
                        <input type="number" class="form-control" id="numeroRonda" min="1" value="1" placeholder="Ej: 1">
                        <div class="invalid-feedback-real" id="numeroRondaFeedback"></div>
                    </div>

                    <!-- PUNTUACION RONDA -->
                    <div class="mb-3">
                        <label class="form-label required-star">Puntuación Ronda</label>
                        <input type="number" class="form-control" id="puntuacionRonda" min="0" max="999" step="0.01" value="4.50" placeholder="Ej: 4.50">
                        <div class="invalid-feedback-real" id="puntuacionRondaFeedback"></div>
                    </div>

                    <!-- PUNTUACION FINAL -->
                    <div class="mb-3">
                        <label class="form-label">Puntuación Final</label>
                        <input type="number" class="form-control" id="puntuacionFinal" min="0" max="9999" step="0.01" value="9.00" placeholder="Ej: 9.00">
                        <div class="invalid-feedback-real" id="puntuacionFinalFeedback"></div>
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
    <script src="../assets/js/validaciones_puntuacion_test.js"></script>
    <script src="../assets/js/sidebar.js"></script>
</body>
</html>
