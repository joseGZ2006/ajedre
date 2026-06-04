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
                <h1 class="page-title"><i class="fas fa-trophy me-2"></i> Editar Torneo</h1>
                <a href="./torneo.html" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Volver al catálogo</a>
            </div>

            <div class="form-card">
                <form role="form" name="form" method="POST" onsubmit="return validarFormularioCompleto(event)" action="./torneo.html">
                    <input type="hidden" name="idTorneo" id="idTorneo" value="1">
                    <h3 class="section-title"><i class="fas fa-chess-queen me-2"></i>Datos del Torneo</h3>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Nombre del Torneo *</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese el nombre del torneo" autocomplete="off" value="Torneo Nacional de Ajedrez">
                            <div class="invalid-feedback-real" id="nombreFeedback"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Estatus *</label>
                            <select class="form-select" name="estado" id="estado">
                                <option value="">Seleccionar estatus</option>
                                <option value="Próximo" selected>Próximo</option>
                                <option value="En curso">En curso</option>
                                <option value="Finalizado">Finalizado</option>
                                <option value="Cancelado">Cancelado</option>
                            </select>
                            <div class="invalid-feedback-real" id="estadoFeedback"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Clasificación *</label>
                            <select class="form-select" name="clasificacion" id="clasificacion">
                                <option value="">Seleccionar clasificación</option>
                                <option value="Abierta" selected>Abierta</option>
                                <option value="Sub-8">Sub-8</option>
                                <option value="Sub-12">Sub-12</option>
                                <option value="Sub-18">Sub-18</option>
                                <option value="Senior">Senior</option>
                            </select>
                            <div class="invalid-feedback-real" id="clasificacionFeedback"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label required-star">Fecha del Torneo *</label>
                            <input type="date" class="form-control" name="fecha" id="fecha" placeholder="AAAA-MM-DD" value="2024-12-15">
                            <div class="invalid-feedback-real" id="fechaFeedback"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label required-star">Lugar *</label>
                            <input type="text" class="form-control" name="lugar" id="lugar" placeholder="Ciudad / Centro de torneo" value="Caracas">
                            <div class="invalid-feedback-real" id="lugarFeedback"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label required-star">Categoría *</label>
                            <select class="form-select" name="categoria" id="categoria">
                                <option value="">Seleccionar categoría</option>
                                <option value="Sub-8">Sub-8</option>
                                <option value="Sub-10">Sub-10</option>
                                <option value="Sub-12">Sub-12</option>
                                <option value="Sub-14">Sub-14</option>
                                <option value="Sub-16">Sub-16</option>
                                <option value="Sub-18">Sub-18</option>
                                <option value="Abierta" selected>Abierta</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Senior">Senior (+50)</option>
                            </select>
                            <div class="invalid-feedback-real" id="categoriaFeedback"></div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="reset" class="btn btn-danger" id="resetBtn"><i class="fas fa-eraser me-2"></i>Limpiar</button>
                        <button type="submit" value="Registrar" class="btn btn-primary"><i class="fas fa-save me-2"></i>Actualizar Torneo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>
    <script src="../assets/js/sidebar.js"></script>
    <script src="../assets/js/validaciones_torneo.js"></script>
   
</body>
</html>