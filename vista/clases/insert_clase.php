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
                <h1 class="page-title"><i class="fas fa-plus-circle me-2"></i> Registrar Nueva Clase</h1>
                <a href="./clase.html" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Volver al catálogo</a>
            </div>

            <div class="form-card">
                <form role="form" name="form" method="POST" onsubmit="return validarFormularioCompleto(event)" action="./clase.html">
                    <h3 class="section-title"><i class="fas fa-chess-board me-2"></i>Datos de la Clase</h3>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Día de la Semana</label>
                            <select class="form-select" name="diaSemana" id="diaSemana">
                                <option value="">Seleccionar día</option>
                                <option value="Lunes">Lunes</option>
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
                            <label class="form-label required-star">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese el nombre de la clase">
                            <div class="invalid-feedback-real" id="nombreFeedback"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Aula</label>
                            <input type="text" class="form-control" name="aula" id="aula" placeholder="Ingrese el aula o salón">
                            <div class="invalid-feedback-real" id="aulaFeedback"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Hora Inicio</label>
                            <input type="text" class="form-control" name="horaInicio" id="horaInicio" placeholder="HH:MM AM/PM (Ej: 09:00 AM)">
                            <div class="invalid-feedback-real" id="horaInicioFeedback"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Hora Fin</label>
                            <input type="text" class="form-control" name="horaFin" id="horaFin" placeholder="HH:MM AM/PM (Ej: 11:00 AM)">
                            <div class="invalid-feedback-real" id="horaFinFeedback"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Localidad</label>
                            <input type="text" class="form-control" name="localidad" id="localidad" placeholder="Ingrese la localidad">
                            <div class="invalid-feedback-real" id="localidadFeedback"></div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="reset" class="btn btn-danger" id="resetBtn"><i class="fas fa-eraser me-2"></i>Limpiar</button>
                        <button type="submit" value="Registrar" class="btn btn-primary"><i class="fas fa-save me-2"></i>Registrar Clase</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>
    <script src="../assets/js/sidebar.js"></script>
    <script src="../assets/js/validaciones_clase.js"></script>
</body>
</html>