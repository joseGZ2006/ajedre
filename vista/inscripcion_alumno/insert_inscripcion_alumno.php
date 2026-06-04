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
                    <i class="fas fa-plus-circle me-2"></i> Registrar Inscripción de Alumno
                </h1>
                <a href="./inscripcion_alumno.html" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Volver
                </a>
            </div>

            <div class="form-card">
                <form onsubmit="return validarInscripcionAlumno(event)">
                    <h3 class="section-title">Datos de Inscripción</h3>
                    <div class="row">
                        <!-- ALUMNO -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label required-star">Alumno</label>
                            <select class="form-select" id="idAlumno">
                                <option value="">Seleccione un alumno</option>
                                <option value="1">Juan Pérez</option>
                                <option value="2">Jose Pérez</option>
                            </select>
                            <div class="invalid-feedback-real" id="idAlumnoFeedback"></div>
                        </div>

                        <!-- FECHA -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label required-star">Fecha de Inscripción</label>
                            <input type="date" class="form-control" id="fecha">
                            <div class="invalid-feedback-real" id="fechaFeedback"></div>
                        </div>

                        <!-- ESTATUS -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label required-star">Estatus</label>
                            <select class="form-select" id="estatus">
                                <option value="">Seleccione un estatus</option>
                                <option value="activo">Activo</option>
                                <option value="inactivo">Inactivo</option>
                                <option value="suspendido">Suspendido</option>
                            </select>
                            <div class="invalid-feedback-real" id="estatusFeedback"></div>
                        </div>
                    </div>

                    <!-- BOTONES -->
                    <div class="form-actions">
                        <button type="reset" class="btn btn-danger" id="resetBtn">
                            <i class="fas fa-eraser me-2"></i> Limpiar
                        </button>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i> Registrar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>
    <script src="../assets/js/validaciones_inscripcion_alumno.js"></script>
    <script src="../assets/js/sidebar.js"></script>
</body>

</html>