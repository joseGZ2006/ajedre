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
            <a href="./alumno.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Volver al catálogo</a>
        </div>

        <div class="form-card">
            <form id="formAlumno" method="POST" action="./alumno.php" onsubmit="return validarFormularioCompleto(event)">
                <!-- DATOS PERSONALES -->
                <h3 class="section-title">
                    <i class="fas fa-user me-2"></i>
                    Datos Personales
                </h3>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label required-star">Cédula</label>
                        <input type="text" class="form-control" id="cedula" maxlength="8"
                            value="12345678">
                        <div class="invalid-feedback-real" id="cedulaFeedback"></div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label required-star">Nombre</label>
                        <input type="text" class="form-control" id="nombre" maxlength="25"
                            value="Juan">
                        <div class="invalid-feedback-real" id="nombreFeedback"></div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label required-star">Apellido</label>
                        <input type="text" class="form-control" id="apellido" maxlength="25"
                            value="Pérez">
                        <div class="invalid-feedback-real" id="apellidoFeedback"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label required-star">Fecha Nacimiento</label>
                        <input type="date" class="form-control" id="fechaNacimiento"
                            value="2010-05-10">
                        <div class="invalid-feedback-real" id="fechaNacimientoFeedback"></div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label required-star">Sexo</label>
                        <select class="form-select" id="sexo">
                            <option value="">Seleccionar</option>
                            <option value="M" selected>Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                        <div class="invalid-feedback-real" id="sexoFeedback"></div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="telefono" maxlength="11"
                            value="04121234567">
                        <div class="invalid-feedback-real" id="telefonoFeedback"></div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label">Correo</label>
                        <input type="email" class="form-control" id="correo" maxlength="30"
                            value="juan.perez@example.com">
                        <div class="invalid-feedback-real" id="correoFeedback"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label required-star">Categoría</label>
                        <select class="form-select" id="categoria">
                            <option value="">Seleccionar</option>
                            <option>Sub-6</option><option>Sub-7</option><option>Sub-8</option><option>Sub-9</option>
                            <option>Sub-10</option><option>Sub-11</option><option>Sub-12</option><option>Sub-13</option>
                            <option selected>Sub-14</option><option>Sub-15</option><option>Sub-16</option>
                            <option>Sub-17</option><option>Sub-18</option><option>Sub-19</option><option>Sub-20</option>
                            <option>Abierta</option>
                        </select>
                        <div class="invalid-feedback-real" id="categoriaFeedback"></div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Club</label>
                        <input type="text" class="form-control" id="club" maxlength="30" value="Casa del Ajedrez">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label required-star">Localidad (Municipio)</label>
                        <select class="form-select" id="localidad">
                            <option value="">Seleccionar</option>
                            <option selected>San Felipe</option>
                            <option>Independencia</option><option>Chivacoa</option>
                            <option>Nirgua</option><option>Urachiche</option>
                            <option>Veroes</option><option>Sucre</option>
                            <option>Arístides Bastidas</option>
                        </select>
                        <div class="invalid-feedback-real" id="localidadFeedback"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Dirección</label>
                        <input type="text" class="form-control" id="direccion" maxlength="30"
                            value="Av. Principal">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Deporte</label>
                        <select id="deporte" class="form-select">
                            <option value="">Seleccionar</option>
                            <option selected>Ajedrez</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label class="form-label">Control Inicio Deportivo</label>
                        <input type="text" class="form-control" id="controlInicioDeportivo" maxlength="30"
                            value="Club Nacional">
                    </div>
                </div>

                <!-- INFORMACIÓN ACADÉMICA -->
                <h3 class="section-title mt-3">
                    <i class="fas fa-book me-2"></i>
                    Información Académica
                </h3>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Institución</label>
                        <input type="text" class="form-control" id="dondeEstudia" maxlength="30"
                            value="Escuela Nacional">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Grado</label>
                        <input type="text" class="form-control" id="grado" maxlength="20"
                            value="5to grado">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Sección</label>
                        <input type="text" class="form-control" id="seccion" maxlength="10"
                            value="A">
                    </div>
                </div>

                <!-- BOTONES -->
                <div class="form-actions">
                    <button type="reset" class="btn btn-danger">
                        <i class="fas fa-eraser me-2"></i> Limpiar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i> Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>
    <script src="../assets/js/validaciones_editalumno.js"></script>

</body>
</html>