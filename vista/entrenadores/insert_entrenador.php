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
                <h1 class="page-title"><i class="fas fa-user-plus me-2"></i> </h1>
                <a href="./entrenador.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Volver al catálogo</a>
            </div>

            <div class="form-card">
                <form role="form" name="form" method="POST" onsubmit="return validarFormularioCompleto(event)" action="./entrenador.php">
                    <h3 class="section-title"><i class="fas fa-chalkboard-user me-2"></i>Datos del Entrenador</h3>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Cédula</label>
                            <input type="text" class="form-control" name="cedula" id="cedula" maxlength="8" placeholder="Ingrese la cédula (7-8 dígitos)" autocomplete="off">
                            <div class="invalid-feedback-real" id="cedulaFeedback"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Nombres</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese los nombres (solo letras y espacios)">
                            <div class="invalid-feedback-real" id="nombreFeedback"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Apellidos</label>
                            <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Ingrese los apellidos (solo letras y espacios)">
                            <div class="invalid-feedback-real" id="apellidoFeedback"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="tel" class="form-control" name="telefono" id="telefono" placeholder="0412-1234567" maxlength="12">
                            <div class="invalid-feedback-real" id="telefonoFeedback"></div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="reset" class="btn btn-danger" id="resetBtn"><i class="fas fa-eraser me-2"></i>Limpiar</button>
                        <button type="submit" value="Registrar" class="btn btn-primary"><i class="fas fa-save me-2"></i>Registrar Entrenador</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>
    <script src="../assets/js/sidebar.js"></script>
    <script src="../assets/js/validaciones_entrenador.js"></script>
</body>
</html>