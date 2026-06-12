<?php
session_start();
// Verificar sesión antes de mostrar el dashboard
include_once("../../controlador/verificar_sesion.php");
include_once("../../modelo/conexion.php");
include_once("../../modelo/clase_entrenador.php");

$entrenadorObj = new Entrenador();
$especialidades = $entrenadorObj->obtenerEspecialidades();
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
                <i class="fas fa-chalkboard-user me-2"></i>Registrar Nuevo Entrenador
            </h1>
            <a href="./entrenador.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Volver al catálogo</a>
        </div>

        <div class="form-card">
          
         
            <form id="formEntrenador" method="POST" action="../../controlador/ctl_entrenador.php" onsubmit="validarFormularioCompleto(event); return false;">
                <input type="hidden" name="registrar" value="registrar">


                <!-- DATOS PERSONALES -->
                <h3 class="section-title">
                    <i class="fas fa-user me-2"></i>
                    Datos Personales
                </h3>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label required-star">Cédula</label>
                        <input type="text" class="form-control" id="cedula" name="cedula" maxlength="8" placeholder="Ej: 12345678">
                        <div class="invalid-feedback-real" id="cedulaFeedback"></div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label required-star">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" maxlength="50" placeholder="Ingrese el nombre">
                        <div class="invalid-feedback-real" id="nombreFeedback"></div>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label class="form-label required-star">Apellido</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" maxlength="50" placeholder="Ingrese el apellido">
                        <div class="invalid-feedback-real" id="apellidoFeedback"></div>
                    </div>

                    
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label required-star">Teléfono</label>
                        <input type="tel" class="form-control" id="telefono" name="telefono" maxlength="12" placeholder="04121234567">
                        <div class="invalid-feedback-real" id="telefonoFeedback"></div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Especialidad</label>
                        <select class="form-select" id="id_especialidad" name="idEspecialidad">
                            <option value="">Seleccionar especialidad (opcional)</option>
                            <?php if(!empty($especialidades)): ?>
                                <?php foreach($especialidades as $esp): ?>
                                    <option value="<?php echo $esp['idEspecialidad']; ?>">
                                        <?php echo htmlspecialchars($esp['nombre']); ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                        <div class="invalid-feedback-real" id="idEspecialidadFeedback"></div>
                    </div>
                </div>

                <!-- BOTONES -->
                <div class="form-actions">
                    <button type="reset" class="btn btn-danger" id="resetBtn">
                        <i class="fas fa-eraser me-2"></i> Limpiar
                    </button>
                    <button type="submit" name="registrar" value="registrar" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i> Registrar Entrenador
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
    <script src="../assets/js/validaciones_entrenador.js"></script>

</body>
</html>