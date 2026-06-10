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
            <h1 class="page-title">
                <i class="fas fa-user-plus me-2"></i>Registrar Nuevo Alumno
            </h1>
            <a href="./alumno.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Volver al catálogo</a>
        </div>

        <div class="form-card">
            <form id="formAlumno" method="POST" onsubmit="return validarFormularioCompleto(event)" action="./alumno.php">
                <input type="hidden" name="registrar" value="registrar">
                <input type="hidden" name="estatus" value="activo">
                <input type="hidden" name="idUsuario" value="2">

                <!-- DATOS PERSONALES -->
                <h3 class="section-title">
                    <i class="fas fa-user me-2"></i>
                    Datos Personales
                </h3>

               

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label required-star">Cédula</label>
                        <input type="text" class="form-control" id="cedula" maxlength="8" placeholder="Ej: 12345678">
                        <div class="invalid-feedback-real" id="cedulaFeedback"></div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label required-star">Nombre</label>
                        <input type="text" class="form-control" id="nombre" maxlength="25" placeholder="Ingrese el nombre">
                        <div class="invalid-feedback-real" id="nombreFeedback"></div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label required-star">Apellido</label>
                        <input type="text" class="form-control" id="apellido" maxlength="25" placeholder="Ingrese el apellido">
                        <div class="invalid-feedback-real" id="apellidoFeedback"></div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label required-star">Sexo</label>
                        <div class="d-flex gap-4 mt-2">
                            <div>
                                <input type="radio" name="sexo" id="sexoM" value="M">
                                <label for="sexoM">Masculino</label>
                            </div>
                            <div>
                                <input type="radio" name="sexo" id="sexoF" value="F">
                                <label for="sexoF">Femenino</label>
                            </div>
                        </div>
                        <div class="invalid-feedback-real" id="sexoFeedback"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label required-star">Fecha Nacimiento</label>
                        <input type="date" class="form-control" id="fechaNacimiento" 
                            min="1900-01-01" max="2024-12-31"
                            onchange="calcularCategoriaPorEdad()">
                        <div class="invalid-feedback-real" id="fechaNacimientoFeedback"></div>
                    </div>

                    <div class="col-md-2 mb-3">
                        <label class="form-label">Edad</label>
                        <input type="text" class="form-control" id="edad" readonly placeholder="Se calcula automáticamente">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label required-star">Categoría</label>
                        <select class="form-select" id="categoria">
                            <option value="">Seleccionar categoría</option>
                            <option>Sub-6</option><option>Sub-7</option><option>Sub-8</option><option>Sub-9</option>
                            <option>Sub-10</option><option>Sub-11</option><option>Sub-12</option><option>Sub-13</option>
                            <option>Sub-14</option><option>Sub-15</option><option>Sub-16</option><option>Sub-17</option>
                            <option>Sub-18</option><option>Sub-19</option><option>Sub-20</option><option>Abierta</option>
                        </select>
                        <div class="invalid-feedback-real" id="categoriaFeedback"></div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="telefono" maxlength="11" placeholder="04121234567">
                        <div class="invalid-feedback-real" id="telefonoFeedback"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label required-star">Localidad (Municipio)</label>
                        <select class="form-select" id="localidad">
                            <option value="">Seleccionar localidad</option>
                            <option>San Felipe</option><option>Independencia</option><option>Chivacoa</option>
                            <option>Nirgua</option><option>Urachiche</option><option>Veroes</option>
                            <option>Sucre</option><option>Arístides Bastidas</option>
                        </select>
                        <div class="invalid-feedback-real" id="localidadFeedback"></div>
                    </div>
               
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="correo" maxlength="30" placeholder="ejemplo@correo.com">
                        <div class="invalid-feedback-real" id="correoFeedback"></div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Club</label>
                        <input type="text" class="form-control" id="club" maxlength="30" placeholder="Club de ajedrez">
                    </div>
                </div>

                <!-- DIRECCIÓN -->
                <h3 class="section-title mt-3">
                    <i class="fas fa-map-marker-alt me-2"></i>
                    Dirección
                </h3>

                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label class="form-label required-star">Dirección</label>
                        <input type="text" class="form-control" id="direccion" maxlength="30" placeholder="Ingrese la dirección completa">
                        <div class="invalid-feedback-real" id="direccionFeedback"></div>
                    </div>
                </div>

                <!-- INFORMACIÓN ACADÉMICA -->
                <h3 class="section-title mt-3">
                    <i class="fas fa-book me-2"></i>
                    Información Académica
                </h3>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label required-star">¿Estudia?</label>
                        <div class="d-flex gap-4 mt-2">
                            <div>
                                <input type="radio" name="estudia" id="estudiaSi" value="Si" onchange="toggleCamposEstudio()">
                                <label for="estudiaSi">Sí</label>
                            </div>
                            <div>
                                <input type="radio" name="estudia" id="estudiaNo" value="No" onchange="toggleCamposEstudio()">
                                <label for="estudiaNo">No</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="camposEstudio" style="display:none;">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Institución</label>
                            <input type="text" class="form-control" id="dondeEstudia" maxlength="30" placeholder="Nombre de la institución">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Grado</label>
                            <input type="text" class="form-control" id="grado" maxlength="20" placeholder="Ej: 5to grado">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Sección</label>
                            <input type="text" class="form-control" id="seccion" maxlength="10" placeholder="Ej: A">
                        </div>
                    </div>
                </div>

                <!-- DEPORTE -->
                <h3 class="section-title mt-3">
                    <i class="fas fa-futbol me-2"></i>
                    Actividad Deportiva
                </h3>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label required-star">¿Practica algún deporte?</label>
                        <div class="d-flex gap-4 mt-2">
                            <div>
                                <input type="radio" name="practicaDeporte" id="deporteSi" value="Si" onchange="toggleCamposDeporte()">
                                <label for="deporteSi">Sí</label>
                            </div>
                            <div>
                                <input type="radio" name="practicaDeporte" id="deporteNo" value="No" onchange="toggleCamposDeporte()">
                                <label for="deporteNo">No</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="camposDeporte" style="display:none;">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Deporte</label>
                            <input type="text" class="form-control" id="deporte" maxlength="25" placeholder="Nombre del deporte">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Control Inicio Deportivo</label>
                            <input type="text" class="form-control" id="controlInicioDeportivo" maxlength="30" placeholder="Institución donde inició">
                        </div>
                    </div>
                </div>

                <!-- REPRESENTANTE (solo menores) -->
                <div id="representanteContainer" style="display:none;">
                    <h3 class="section-title mt-3">
                        <i class="fas fa-users me-2"></i>
                        Datos del Representante (Obligatorio por ser menor de edad)
                    </h3>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> El alumno es menor de edad (menor a 18 años). Es obligatorio asignar un representante.
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label required-star">Representante</label>
                            <div class="d-flex gap-2">
                                <select class="form-select" id="representante" style="flex:1">
                                    <option value="">Seleccionar representante</option>
                                    <option value="1">Juana Perez (C.I: 12345678)</option>
                                    <option value="2">Carlos Rodriguez (C.I: 87654321)</option>
                                    <option value="3">Maria Gonzalez (C.I: 23456789)</option>
                                </select>
                                <button type="button" class="btn btn-outline-primary" id="btnAgregarRepresentante" data-bs-toggle="modal" data-bs-target="#representanteModal">
                                    <i class="fas fa-plus"></i> Nuevo
                                </button>
                            </div>
                            <div class="invalid-feedback-real" id="representanteFeedback"></div>
                            <small class="text-muted">Seleccione el representante legal del alumno menor de edad</small>
                        </div>
                    </div>
                </div>

                <!-- BOTONES -->
                <div class="form-actions">
                    <button type="reset" class="btn btn-danger" id="resetBtn">
                        <i class="fas fa-eraser me-2"></i> Limpiar
                    </button>
                    <button type="submit" name="registrar" value="registrar" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i> Registrar Alumno
                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- MODAL PARA AGREGAR REPRESENTANTE -->
    <div class="modal fade" id="representanteModal" tabindex="-1" aria-labelledby="representanteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="representanteModalLabel">
                        <i class="fas fa-user-plus me-2"></i>Agregar Nuevo Representante
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label required-star">Cédula Representante</label>
                        <input type="text" class="form-control" id="modalRepCedula" maxlength="10" placeholder="Cédula (10 dígitos)">
                    </div>
                    <div class="mb-3">
                        <label class="form-label required-star">Nombre</label>
                        <input type="text" class="form-control" id="modalRepNombre" maxlength="25" placeholder="Nombre">
                    </div>
                    <div class="mb-3">
                        <label class="form-label required-star">Apellido</label>
                        <input type="text" class="form-control" id="modalRepApellido" maxlength="25" placeholder="Apellido">
                    </div>
                    <div class="mb-3">
                        <label class="form-label required-star">Correo Electrónico</label>
                        <input type="email" class="form-control" id="modalRepCorreo" maxlength="30" placeholder="Correo electrónico">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="modalRepTelefono" maxlength="11" placeholder="04121234567">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Parentesco</label>
                        <select class="form-select" id="modalRepParentesco">
                            <option value="">Seleccionar parentesco</option>
                            <option>Padre</option><option>Madre</option><option>Tutor</option>
                            <option>Abuelo</option><option>Hermano</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="btnGuardarRepresentante">Guardar Representante</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>
    <script src="../assets/js/represent_alumno.js"></script>
    <script src="../assets/js/validaciones_alumno.js"></script>

</body>
</html>