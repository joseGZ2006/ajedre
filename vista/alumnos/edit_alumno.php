<?php
session_start();
// Verificar sesión antes de mostrar el dashboard
include_once("../../controlador/verificar_sesion.php");
include_once("../../modelo/conexion.php");

// Obtener datos del alumno desde los parámetros GET
$idAlumno = isset($_GET['id']) ? base64_decode($_GET['id']) : null;
$cedula = isset($_GET['ced']) ? base64_decode($_GET['ced']) : '';
$nombre = isset($_GET['nom']) ? base64_decode($_GET['nom']) : '';
$apellido = isset($_GET['ape']) ? base64_decode($_GET['ape']) : '';
$sexo = isset($_GET['sex']) ? base64_decode($_GET['sex']) : '';
$fechaNacimiento = isset($_GET['fna']) ? base64_decode($_GET['fna']) : '';
$telefono = isset($_GET['tel']) ? base64_decode($_GET['tel']) : '';
$localidadMunicipio = isset($_GET['loc']) ? base64_decode($_GET['loc']) : '';
$correo = isset($_GET['ema']) ? base64_decode($_GET['ema']) : '';
$club = isset($_GET['club']) ? base64_decode($_GET['club']) : '';
$direccion = isset($_GET['dir']) ? base64_decode($_GET['dir']) : '';
$dondeEstudia = isset($_GET['est']) ? base64_decode($_GET['est']) : '';
$grado = isset($_GET['gra']) ? base64_decode($_GET['gra']) : '';
$seccion = isset($_GET['sec']) ? base64_decode($_GET['sec']) : '';
$deporte = isset($_GET['dep']) ? base64_decode($_GET['dep']) : '';
$centroIniciacionDeportivo = isset($_GET['cen']) ? base64_decode($_GET['cen']) : '';
$idRepresentante = isset($_GET['rep']) ? base64_decode($_GET['rep']) : '';
$estatus = isset($_GET['status']) ? base64_decode($_GET['status']) : '';
$estudia = isset($_GET['estudia']) ? base64_decode($_GET['estudia']) : '';
$practicaDeporte = isset($_GET['practicaDeporte']) ? base64_decode($_GET['practicaDeporte']) : '';

// Calcular edad
$edad = '';
if($fechaNacimiento) {
    $fecha_nac = new DateTime($fechaNacimiento);
    $hoy = new DateTime();
    $edad = $hoy->diff($fecha_nac)->y;
}
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
                <i class="fas fa-edit me-2"></i>Editar Alumno
            </h1>
            <a href="./alumno.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Volver al catálogo</a>
        </div>

        <div class="form-card">
            <form id="formAlumno" method="POST" action="../../controlador/ctl_alumno.php" onsubmit="return validarFormularioCompleto(event)">
                <input type="hidden" name="modificar" value="modificar">
                <input type="hidden" name="idAlumno" id="idAlumno" value="<?php echo $idAlumno; ?>">

                <!-- DATOS PERSONALES -->
                <h3 class="section-title">
                    <i class="fas fa-user me-2"></i>
                    Datos Personales
                </h3>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label required-star">Cédula</label>
                        <input type="text" class="form-control" id="cedula" name="cedula" maxlength="10" value="<?php echo htmlspecialchars($cedula); ?>">
                        <div class="invalid-feedback-real" id="cedulaFeedback"></div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label required-star">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" maxlength="50" value="<?php echo htmlspecialchars($nombre); ?>">
                        <div class="invalid-feedback-real" id="nombreFeedback"></div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label required-star">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" maxlength="50" value="<?php echo htmlspecialchars($apellido); ?>">
                        <div class="invalid-feedback-real" id="apellidoFeedback"></div>
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label required-star">Sexo</label>
                        <div class="d-flex gap-4 mt-2">
                            <div>
                                <input type="radio" name="sexo" id="sexoM" value="M" <?php echo ($sexo == 'M') ? 'checked' : ''; ?>>
                                <label for="sexoM">Masculino</label>
                            </div>
                            <div>
                                <input type="radio" name="sexo" id="sexoF" value="F" <?php echo ($sexo == 'F') ? 'checked' : ''; ?>>
                                <label for="sexoF">Femenino</label>
                            </div>
                        </div>
                        <div class="invalid-feedback-real" id="sexoFeedback"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label required-star">Fecha Nacimiento</label>
                        <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" 
                            min="1900-01-01" max="<?php echo date('Y-m-d'); ?>"
                            value="<?php echo $fechaNacimiento; ?>"
                            onchange="calcularCategoriaPorEdad()">
                        <div class="invalid-feedback-real" id="fechaNacimientoFeedback"></div>
                    </div>

                    <div class="col-md-2 mb-3">
                        <label class="form-label">Edad</label>
                        <input type="text" class="form-control" id="edad" name="edad" readonly value="<?php echo $edad; ?>">
                    </div>

                    <div class="col-md-3 mb-3">
                        <label class="form-label required-star">Categoría</label>
                        <select class="form-select" id="categoria" name="categoria">
                            <option value="">Seleccionar categoría</option>
                            <option <?php echo ($categoria == 'Sub-6') ? 'selected' : ''; ?>>Sub-6</option>
                            <option <?php echo ($categoria == 'Sub-7') ? 'selected' : ''; ?>>Sub-7</option>
                            <option <?php echo ($categoria == 'Sub-8') ? 'selected' : ''; ?>>Sub-8</option>
                            <option <?php echo ($categoria == 'Sub-9') ? 'selected' : ''; ?>>Sub-9</option>
                            <option <?php echo ($categoria == 'Sub-10') ? 'selected' : ''; ?>>Sub-10</option>
                            <option <?php echo ($categoria == 'Sub-11') ? 'selected' : ''; ?>>Sub-11</option>
                            <option <?php echo ($categoria == 'Sub-12') ? 'selected' : ''; ?>>Sub-12</option>
                            <option <?php echo ($categoria == 'Sub-13') ? 'selected' : ''; ?>>Sub-13</option>
                            <option <?php echo ($categoria == 'Sub-14') ? 'selected' : ''; ?>>Sub-14</option>
                            <option <?php echo ($categoria == 'Sub-15') ? 'selected' : ''; ?>>Sub-15</option>
                            <option <?php echo ($categoria == 'Sub-16') ? 'selected' : ''; ?>>Sub-16</option>
                            <option <?php echo ($categoria == 'Sub-17') ? 'selected' : ''; ?>>Sub-17</option>
                            <option <?php echo ($categoria == 'Sub-18') ? 'selected' : ''; ?>>Sub-18</option>
                            <option <?php echo ($categoria == 'Sub-19') ? 'selected' : ''; ?>>Sub-19</option>
                            <option <?php echo ($categoria == 'Sub-20') ? 'selected' : ''; ?>>Sub-20</option>
                            <option <?php echo ($categoria == 'Abierta') ? 'selected' : ''; ?>>Abierta</option>
                        </select>
                        <div class="invalid-feedback-real" id="categoriaFeedback"></div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Teléfono</label>
                        <input type="tel" class="form-control" id="telefono" name="telefono" maxlength="12" value="<?php echo htmlspecialchars($telefono); ?>" placeholder="0412-1234567">
                        <div class="invalid-feedback-real" id="telefonoFeedback"></div>
                        <small class="text-muted">Formato: 0412-1234567</small>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label required-star">Localidad (Municipio)</label>
                        <select class="form-select" id="localidadMunicipio" name="localidadMunicipio">
                            <option value="">Seleccionar localidad</option>
                            <option <?php echo ($localidadMunicipio == 'San Felipe') ? 'selected' : ''; ?>>San Felipe</option>
                            <option <?php echo ($localidadMunicipio == 'Independencia') ? 'selected' : ''; ?>>Independencia</option>
                            <option <?php echo ($localidadMunicipio == 'Chivacoa') ? 'selected' : ''; ?>>Chivacoa</option>
                            <option <?php echo ($localidadMunicipio == 'Nirgua') ? 'selected' : ''; ?>>Nirgua</option>
                            <option <?php echo ($localidadMunicipio == 'Urachiche') ? 'selected' : ''; ?>>Urachiche</option>
                            <option <?php echo ($localidadMunicipio == 'Veroes') ? 'selected' : ''; ?>>Veroes</option>
                            <option <?php echo ($localidadMunicipio == 'Sucre') ? 'selected' : ''; ?>>Sucre</option>
                            <option <?php echo ($localidadMunicipio == 'Arístides Bastidas') ? 'selected' : ''; ?>>Arístides Bastidas</option>
                        </select>
                        <div class="invalid-feedback-real" id="localidadMunicipioFeedback"></div>
                    </div>
               
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" class="form-control" id="correo" name="correo" maxlength="100" value="<?php echo htmlspecialchars($correo); ?>">
                        <div class="invalid-feedback-real" id="correoFeedback"></div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label">Club</label>
                        <input type="text" class="form-control" id="club" name="club" maxlength="100" value="<?php echo htmlspecialchars($club); ?>">
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
                        <input type="text" class="form-control" id="direccion" name="direccion" maxlength="255" value="<?php echo htmlspecialchars($direccion); ?>">
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
                                <input type="radio" name="estudia" id="estudiaSi" value="Si" <?php echo ($estudia == 'Si') ? 'checked' : ''; ?> onchange="toggleCamposEstudio()">
                                <label for="estudiaSi">Sí</label>
                            </div>
                            <div>
                                <input type="radio" name="estudia" id="estudiaNo" value="No" <?php echo ($estudia == 'No') ? 'checked' : ''; ?> onchange="toggleCamposEstudio()">
                                <label for="estudiaNo">No</label>
                            </div>
                        </div>
                        <div class="invalid-feedback-real" id="estudiaFeedback"></div>
                    </div>
                </div>

                <div id="camposEstudio" style="display: <?php echo ($estudia == 'Si') ? 'block' : 'none'; ?>;">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Institución</label>
                            <input type="text" class="form-control" id="dondeEstudia" name="dondeEstudia" maxlength="100" value="<?php echo htmlspecialchars($dondeEstudia); ?>">
                            <div class="invalid-feedback-real" id="dondeEstudiaFeedback"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Grado</label>
                            <input type="text" class="form-control" id="grado" name="grado" maxlength="50" value="<?php echo htmlspecialchars($grado); ?>">
                            <div class="invalid-feedback-real" id="gradoFeedback"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Sección</label>
                            <input type="text" class="form-control" id="seccion" name="seccion" maxlength="20" value="<?php echo htmlspecialchars($seccion); ?>">
                            <div class="invalid-feedback-real" id="seccionFeedback"></div>
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
                                <input type="radio" name="practicaDeporte" id="deporteSi" value="Si" <?php echo ($practicaDeporte == 'Si') ? 'checked' : ''; ?> onchange="toggleCamposDeporte()">
                                <label for="deporteSi">Sí</label>
                            </div>
                            <div>
                                <input type="radio" name="practicaDeporte" id="deporteNo" value="No" <?php echo ($practicaDeporte == 'No') ? 'checked' : ''; ?> onchange="toggleCamposDeporte()">
                                <label for="deporteNo">No</label>
                            </div>
                        </div>
                        <div class="invalid-feedback-real" id="practicaDeporteFeedback"></div>
                    </div>
                </div>

                <div id="camposDeporte" style="display: <?php echo ($practicaDeporte == 'Si') ? 'block' : 'none'; ?>;">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Deporte</label>
                            <input type="text" class="form-control" id="deporte" name="deporte" maxlength="100" value="<?php echo htmlspecialchars($deporte); ?>">
                            <div class="invalid-feedback-real" id="deporteFeedback"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Centro Iniciación Deportiva</label>
                            <input type="text" class="form-control" id="centroIniciacionDeportivo" name="centroIniciacionDeportivo" maxlength="100" value="<?php echo htmlspecialchars($centroIniciacionDeportivo); ?>">
                            <div class="invalid-feedback-real" id="centroIniciacionDeportivoFeedback"></div>
                        </div>
                    </div>
                </div>

                <!-- REPRESENTANTE (solo menores) -->
                <div id="representanteContainer" style="display: <?php echo ($edad < 18) ? 'block' : 'none'; ?>;">
                    <h3 class="section-title mt-3">
                        <i class="fas fa-users me-2"></i>
                        Datos del Representante
                    </h3>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label class="form-label">Representante</label>
                            <select class="form-select" id="idRepresentante" name="idRepresentante">
                                <option value="">Seleccionar representante</option>
                                <?php
                                $sql = $conex->prepare("SELECT idRepresentante, cedula, nombre, apellido FROM REPRESENTANTE ORDER BY nombre, apellido");
                                $sql->execute();
                                while($rep = $sql->fetch(PDO::FETCH_ASSOC)) {
                                    $selected = ($rep['idRepresentante'] == $idRepresentante) ? 'selected' : '';
                                    echo '<option value="'.$rep['idRepresentante'].'" '.$selected.'>'.$rep['nombre'].' '.$rep['apellido'].' (C.I: '.$rep['cedula'].')</option>';
                                }
                                ?>
                            </select>
                            <div class="invalid-feedback-real" id="idRepresentanteFeedback"></div>
                        </div>
                    </div>
                </div>

                <!-- ESTATUS -->
                <h3 class="section-title mt-3">
                    <i class="fas fa-toggle-on me-2"></i>
                    Estatus
                </h3>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label required-star">Estatus</label>
                        <select class="form-select" id="estatus" name="estatus">
                            <option value="activo" <?php echo ($estatus == 'activo') ? 'selected' : ''; ?>>Activo</option>
                            <option value="inactivo" <?php echo ($estatus == 'inactivo') ? 'selected' : ''; ?>>Inactivo</option>
                            <option value="suspendido" <?php echo ($estatus == 'suspendido') ? 'selected' : ''; ?>>Suspendido</option>
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
                        <i class="fas fa-save me-2"></i> Guardar Cambios
                    </button>
                </div>

            </form>
        </div>
    </div>

    <?php include '../assets/inc/flash.php'; ?>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>
    <script src="../assets/js/sidebar.js"></script>
    <script src="../assets/js/validacion_alumno.js"></script>

</body>
</html>