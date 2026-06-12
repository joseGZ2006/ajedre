<?php
session_start();
// Verificar sesión antes de mostrar el dashboard
include_once("../../controlador/verificar_sesion.php");
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

    <!-- MAIN -->
    <div class="main-content">

        <div class="catalog-header">
            <h1 class="page-title">
                <i class="fas fa-clipboard-list me-2"></i> REGISTRAR ASISTENCIA ENTRENADOR
            </h1>

            <a href="./asistencia.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i> Volver
            </a>
        </div>

        <div class="form-card">

            <form onsubmit="return validarAsistenciaEntrenador(event)">

                <h3 class="section-title">Datos de Asistencia</h3>


                <!-- FECHA -->
                <div class="mb-3">
                    <label class="form-label required-star">Fecha</label>
                    <input type="date" class="form-control" id="fecha">
                    <div class="invalid-feedback-real" id="fechaFeedback"></div>
                </div>

                <!-- HORA -->
                <div class="mb-3">
                    <label class="form-label required-star">Hora</label>
                    <input type="text" class="form-control" id="hora" placeholder="Ej: 09:00 AM">
                    <div class="invalid-feedback-real" id="horaFeedback"></div>
                </div>

                <!-- MODALIDAD -->
                <div class="mb-3">
                    <label class="form-label">Modalidad</label>
                    <select class="form-select" id="modalidad">
                        <option value="">Seleccionar modalidad</option>
                        <option value="Presencial">Presencial</option>
                        <option value="Virtual">Virtual</option>
                        <option value="Mixta">Mixta</option>
                    </select>
                    <div class="invalid-feedback-real" id="modalidadFeedback"></div>
                </div>

                <!-- ALUMNOS ENTRENADOS -->
                <div class="mb-3">
                    <label class="form-label required-star">Alumnos entrenados</label>
                    <input type="number" min="0" class="form-control" id="alumnosEntrenados" placeholder="Cantidad">
                    <div class="invalid-feedback-real" id="alumnosEntrenadosFeedback"></div>
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
<script src="../assets/js/sidebar.js"></script>
<script src="../assets/js/validar_asistenciaentrenador.js"></script>

</body>
</html>