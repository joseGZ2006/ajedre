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
                <h1 class="page-title"><i class="fas fa-user-plus me-2"></i> Registrar Nuevo Representante</h1>
                <a href="./representante.html" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Volver al catálogo</a>
            </div>

            <div class="form-card">
                <form role="form" name="form" method="POST" onsubmit="return validarFormularioCompleto(event)" action="./representante.html">
                    <h3 class="section-title"><i class="fas fa-user me-2"></i>Datos del Representante</h3>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Cédula *</label>
                            <input type="text" class="form-control" name="cedula" id="cedula" maxlength="10" placeholder="Ingrese la cédula (7-10 dígitos)" autocomplete="off">
                            <div class="invalid-feedback-real" id="cedulaFeedback"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Nombre *</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese el nombre (solo letras y espacios)">
                            <div class="invalid-feedback-real" id="nombreFeedback"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Apellido *</label>
                            <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Ingrese el apellido (solo letras)">
                            <div class="invalid-feedback-real" id="apellidoFeedback"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" name="telefono" id="telefono" placeholder="0412-1234567">
                            <div class="invalid-feedback-real" id="telefonoFeedback"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" name="correo" id="correo" placeholder="ejemplo@correo.com">
                            <div class="invalid-feedback-real" id="correoFeedback"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Parentesco *</label>
                            <select class="form-select" name="parentesco" id="parentesco">
                                <option value="">Seleccionar parentesco</option>
                                <option value="Padre">Padre</option>
                                <option value="Madre">Madre</option>
                                <option value="Tío">Tío</option>
                                <option value="Tía">Tía</option>
                                <option value="Abuelo">Abuelo</option>
                                <option value="Abuela">Abuela</option>
                                <option value="Hermano">Hermano</option>
                                <option value="Hermana">Hermana</option>
                                <option value="Tutor Legal">Tutor Legal</option>
                            </select>
                            <div class="invalid-feedback-real" id="parentescoFeedback"></div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="reset" class="btn btn-danger" id="resetBtn"><i class="fas fa-eraser me-2"></i>Limpiar</button>
                        <button type="submit" value="Registrar" class="btn btn-primary"><i class="fas fa-save me-2"></i>Registrar Representante</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>
    <script src="../assets/js/sidebar.js"></script>
    <script src="../assets/js/validaciones_representante.js"></script>
</body>
</html>