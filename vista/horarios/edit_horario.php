<?php
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

        <div class="main-content">
            <div class="catalog-header">
                <h1 class="page-title"><i class="fas fa-edit me-2"></i> Editar Horario de Clase</h1>
                <a href="./horario.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Volver al catálogo</a>
            </div>

            <div class="form-card">
                <form role="form" name="form" method="POST" onsubmit="return validarFormularioCompleto(event)" action="./horario.php">
                    <h3 class="section-title"><i class="fas fa-calendar-alt me-2"></i>Datos del Horario</h3>
                    
                    <!-- ID oculto para identificar el registro -->
                    <input type="hidden" name="idHorario" id="idHorario" value="1">
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Día de la Semana *</label>
                            <select class="form-select" name="diaSemana" id="diaSemana">
                                <option value="">Seleccionar día</option>
                                <option value="Lunes" selected>Lunes</option>
                                <option value="Martes">Martes</option>
                                <option value="Miércoles">Miércoles</option>
                                <option value="Jueves">Jueves</option>
                                <option value="Viernes">Viernes</option>
                                <option value="Sábado">Sábado</option>
                                <option value="Domingo">Domingo</option>
                            </select>
                            <div class="invalid-feedback-real" id="diaSemanaFeedback"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Hora Inicio *</label>
                            <input type="time" class="form-control" name="horaInicio" id="horaInicio" value="09:00" step="60">
                            <div class="invalid-feedback-real" id="horaInicioFeedback"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Hora Fin *</label>
                            <input type="time" class="form-control" name="horaFin" id="horaFin" value="11:00" step="60">
                            <div class="invalid-feedback-real" id="horaFinFeedback"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Nivel *</label>
                            <select class="form-select" name="nivel" id="nivel">
                                <option value="">Seleccionar nivel</option>
                                <option value="Principiantes" selected>Principiantes</option>
                                <option value="Intermedios">Intermedios</option>
                                <option value="Avanzados">Avanzados</option>
                                <option value="Competitivo">Competitivo</option>
                            </select>
                            <div class="invalid-feedback-real" id="nivelFeedback"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Aula *</label>
                            <input type="text" class="form-control" name="aula" id="aula" placeholder="Ej: Aula 101, Sala de Torneos" value="Aula 101">
                            <div class="invalid-feedback-real" id="aulaFeedback"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Entrenador *</label>
                            <select class="form-select" name="idEntrenador" id="idEntrenador">
                                <option value="">Seleccionar entrenador</option>
                                <option value="1" selected>Marcos Pérez</option>
                                <option value="2">Ana López</option>
                                <option value="3">Carlos Ruiz</option>
                                <option value="4">María González</option>
                            </select>
                            <div class="invalid-feedback-real" id="idEntrenadorFeedback"></div>
                        </div>
                    </div>


                    <div class="form-actions">
                        <button type="reset" class="btn btn-danger" id="resetBtn"><i class="fas fa-eraser me-2"></i>Limpiar</button>
                        <button type="submit" value="Actualizar" class="btn btn-primary"><i class="fas fa-save me-2"></i>Actualizar Horario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>
    <script src="../assets/js/sidebar.js"></script>
    <script src="../assets/js/validaciones_horario.js"></script>
    

</body>
</html>