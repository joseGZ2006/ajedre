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

        <!-- CONTENIDO -->
        <div class="main-content">
            <div class="catalog-header">
                <h1 class="page-title">
                    <i class="fas fa-edit me-2"></i> Editar Inscripción de Torneo
                </h1>
                <a href="./inscripcion_torneo.php" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Volver
                </a>
            </div>

            <div class="form-card">
                <form onsubmit="return validarInscripcionTorneo(event)">
                    <h3 class="section-title">Actualizar Inscripción de Torneo</h3>

                    <!-- ALUMNO -->
                    <div class="mb-3">
                        <label class="form-label required-star">Alumno</label>
                        <select class="form-select" id="idAlumno">
                            <option value="">Seleccione un alumno</option>
                            <option value="1" selected>Juan Pérez</option>
                            <option value="2">Jose Pérez</option>
                        </select>
                        <div class="invalid-feedback-real" id="idAlumnoFeedback"></div>
                    </div>

                    <!-- TORNEO -->
                    <div class="mb-3">
                        <label class="form-label required-star">Torneo</label>
                        <select class="form-select" id="idTorneo">
                            <option value="">Seleccione un torneo</option>
                            <option value="1" selected>Torneo Escolar Primavera</option>
                            <option value="2">Clásico de Otoño 2026</option>
                        </select>
                        <div class="invalid-feedback-real" id="idTorneoFeedback"></div>
                    </div>

                    <!-- FECHA -->
                    <div class="mb-3">
                        <label class="form-label required-star">Fecha de Inscripción</label>
                        <input type="date" class="form-control" id="fecha" value="2026-06-03">
                        <div class="invalid-feedback-real" id="fechaFeedback"></div>
                    </div>

                    <!-- ESTATUS -->
                    <div class="mb-3">
                        <label class="form-label required-star">Estatus</label>
                        <select class="form-select" id="estatus">
                            <option value="">Seleccione un estatus</option>
                            <option value="pendiente" selected>Pendiente</option>
                            <option value="confirmado">Confirmado</option>
                            <option value="rechazado">Rechazado</option>
                            <option value="cancelado">Cancelado</option>
                        </select>
                        <div class="invalid-feedback-real" id="estatusFeedback"></div>
                    </div>

                    <!-- PAGO -->
                    <div class="mb-3">
                        <label class="form-label required-star">Estado de Pago</label>
                        <select class="form-select" id="pago">
                            <option value="0" selected>No Pagado</option>
                            <option value="1">Pagado</option>
                        </select>
                        <div class="invalid-feedback-real" id="pagoFeedback"></div>
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
    <script src="../assets/js/validaciones_inscripcion_torneo.js"></script>
    <script src="../assets/js/sidebar.js"></script>
</body>
</html>
