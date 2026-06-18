<?php
session_start();
// Verificar sesión antes de mostrar el dashboard
include_once("../../controlador/verificar_sesion.php");

include("../../modelo/conexion.php");
include("../../modelo/clase_torneo.php");

$tor = new Torneo();
$tipos = $tor->ObtenerTiposTorneo();
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
                <i class="fas fa-plus-circle me-2"></i> Registrar Torneo
            </h1>

            <a href="./torneo.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i> Volver
            </a>
        </div>

        <div class="form-card">

            <form id="formRegistrar" method="POST" action="../../controlador/ctl_torneo.php">

                <h3 class="section-title">Datos del Torneo</h3>

                <!-- TIPO DE TORNEO -->
                <div class="mb-3">
                    <label class="form-label">Tipo de Torneo</label>
                    <select class="form-select" id="idTipoTorneo" name="idTipoTorneo">
                        <option value="">Seleccione un tipo</option>
                        <?php if($tipos && count($tipos) > 0): ?>
                            <?php foreach($tipos as $tipo): ?>
                                <option value="<?php echo $tipo['idTipoTorneo']; ?>">
                                    <?php echo htmlspecialchars($tipo['nombre']); ?>
                                </option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                    <div class="invalid-feedback-real" id="idTipoTorneoFeedback"></div>
                </div>

                <!-- NOMBRE -->
                <div class="mb-3">
                    <label class="form-label required-star">Nombre</label>
                    <input type="text"
                           class="form-control"
                           id="nombre"
                           name="nombre"
                           placeholder="Ingrese el nombre del torneo"
                           >
                    <div class="invalid-feedback-real" id="nombreFeedback"></div>
                </div>

                <!-- FECHA -->
                <div class="mb-3">
                    <label class="form-label required-star">Fecha</label>
                    <input type="date"
                           class="form-control"
                           id="fecha"
                           name="fecha"
                           >
                    <div class="invalid-feedback-real" id="fechaFeedback"></div>
                </div>

                <!-- LUGAR -->
                <div class="mb-3">
                    <label class="form-label required-star">Lugar</label>
                    <input type="text"
                           class="form-control"
                           id="lugar"
                           name="lugar"
                           placeholder="Ingrese el lugar del torneo"
                           >
                    <div class="invalid-feedback-real" id="lugarFeedback"></div>
                </div>

                <!-- CATEGORIA -->
                <div class="mb-3">
                    <label class="form-label">Categoría</label>
                    <input type="text"
                           class="form-control"
                           id="categoria"
                           name="categoria"
                           placeholder="Ej: Sub-12, Sub-16, Abierto"
                           >
                    <div class="invalid-feedback-real" id="categoriaFeedback"></div>
                </div>

                <!-- CLASIFICACION -->
                <div class="mb-3">
                    <label class="form-label">Clasificación</label>
                    <input type="text"
                           class="form-control"
                           id="clasificacion"
                           name="clasificacion"
                           placeholder="Ej: Nacional, Internacional"
                           >
                    <div class="invalid-feedback-real" id="clasificacionFeedback"></div>
                </div>

                <!-- ESTATUS -->
                <div class="mb-3">
                    <label class="form-label required-star">Estatus</label>
                    <select class="form-select" id="estatus" name="estatus">
                        <option value="">Seleccione un estatus</option>
                        <option value="proximo">Próximo</option>
                        <option value="en_curso">En curso</option>
                        <option value="finalizado">Finalizado</option>
                        <option value="cancelado">Cancelado</option>
                    </select>
                    <div class="invalid-feedback-real" id="estatusFeedback"></div>
                </div>

                <!-- CUPO -->
                <div class="mb-3">
                    <label class="form-label required-star">Cupo</label>
                    <input type="number"
                           class="form-control"
                           id="cupo"
                           name="cupo"
                           placeholder="Ingrese el cupo máximo"
                           min="1"
                           max="1000"
                           >
                    <div class="invalid-feedback-real" id="cupoFeedback"></div>
                </div>

                <!-- BOTONES -->
                <div class="form-actions">

                    <button type="reset" class="btn btn-danger" id="resetBtn">
                        <i class="fas fa-eraser me-2"></i> Limpiar
                    </button>

                    <button type="submit" class="btn btn-primary" name="registrar" value="registrar">
                        <i class="fas fa-save me-2"></i> Registrar
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
<?php include '../assets/inc/flash.php'; ?>
<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/sweetalert2.all.min.js"></script>
<script src="../assets/js/validaciones_torneo.js"></script>
<script src="../assets/js/sidebar.js"></script>

</body>
</html>