<?php
session_start();
// Verificar sesión antes de mostrar el dashboard
include_once("../../controlador/verificar_sesion.php");

include("../../modelo/conexion.php");
include("../../modelo/clase_torneo.php");

$tor = new Torneo();
$tipos = $tor->ObtenerTiposTorneo();

// Obtener datos de la URL
$id = isset($_GET['id']) ? $_GET['id'] : '';
$nombre = isset($_GET['nom']) ? base64_decode($_GET['nom']) : '';
$fecha = isset($_GET['fecha']) ? base64_decode($_GET['fecha']) : '';
$lugar = isset($_GET['lugar']) ? base64_decode($_GET['lugar']) : '';
$categoria = isset($_GET['categoria']) ? base64_decode($_GET['categoria']) : '';
$clasificacion = isset($_GET['clasificacion']) ? base64_decode($_GET['clasificacion']) : '';
$estatus = isset($_GET['estatus']) ? base64_decode($_GET['estatus']) : '';
$cupo = isset($_GET['cupo']) ? base64_decode($_GET['cupo']) : '';
$tipo = isset($_GET['tipo']) ? base64_decode($_GET['tipo']) : '';

// Si no hay datos, redirigir
if(empty($id) || empty($nombre)) {
    $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'Datos incompletos para editar.'];
    header("Location: ./torneo.php");
    exit;
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

    <!-- CONTENIDO -->
    <div class="main-content">

        <div class="catalog-header">
            <h1 class="page-title">
                <i class="fas fa-edit me-2"></i> Editar Torneo
            </h1>

            <a href="./torneo.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i> Volver
            </a>
        </div>

        <div class="form-card">

            <form id="formEditar" method="POST" action="../../controlador/ctl_torneo.php">

                <h3 class="section-title">Actualizar Torneo</h3>

                <!-- Campos ocultos -->
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
                <input type="hidden" name="nombre_original" value="<?php echo htmlspecialchars(base64_encode($nombre)); ?>">
                <input type="hidden" name="fecha_original" value="<?php echo htmlspecialchars(base64_encode($fecha)); ?>">
                <input type="hidden" name="lugar_original" value="<?php echo htmlspecialchars(base64_encode($lugar)); ?>">
                <input type="hidden" name="categoria_original" value="<?php echo htmlspecialchars(base64_encode($categoria)); ?>">
                <input type="hidden" name="clasificacion_original" value="<?php echo htmlspecialchars(base64_encode($clasificacion)); ?>">
                <input type="hidden" name="estatus_original" value="<?php echo htmlspecialchars(base64_encode($estatus)); ?>">
                <input type="hidden" name="cupo_original" value="<?php echo htmlspecialchars(base64_encode($cupo)); ?>">
                <input type="hidden" name="tipo_original" value="<?php echo htmlspecialchars(base64_encode($tipo)); ?>">

                <!-- TIPO DE TORNEO -->
                <div class="mb-3">
                    <label class="form-label">Tipo de Torneo</label>
                    <select class="form-select" id="idTipoTorneo" name="idTipoTorneo">
                        <option value="">Seleccione un tipo</option>
                        <?php if($tipos && count($tipos) > 0): ?>
                            <?php foreach($tipos as $tipoItem): ?>
                                <option value="<?php echo $tipoItem['idTipoTorneo']; ?>" 
                                    <?php echo $tipo == $tipoItem['idTipoTorneo'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($tipoItem['nombre']); ?>
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
                           value="<?php echo htmlspecialchars($nombre); ?>"
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
                           value="<?php echo htmlspecialchars($fecha); ?>"
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
                           value="<?php echo htmlspecialchars($lugar); ?>"
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
                           value="<?php echo htmlspecialchars($categoria); ?>"
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
                           value="<?php echo htmlspecialchars($clasificacion); ?>"
                           placeholder="Ej: Nacional, Internacional"
                           >
                    <div class="invalid-feedback-real" id="clasificacionFeedback"></div>
                </div>

                <!-- ESTATUS -->
                <div class="mb-3">
                    <label class="form-label required-star">Estatus</label>
                    <select class="form-select" id="estatus" name="estatus">
                        <option value="">Seleccione un estatus</option>
                        <option value="proximo" <?php echo $estatus == 'proximo' ? 'selected' : ''; ?>>Próximo</option>
                        <option value="en_curso" <?php echo $estatus == 'en_curso' ? 'selected' : ''; ?>>En curso</option>
                        <option value="finalizado" <?php echo $estatus == 'finalizado' ? 'selected' : ''; ?>>Finalizado</option>
                        <option value="cancelado" <?php echo $estatus == 'cancelado' ? 'selected' : ''; ?>>Cancelado</option>
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
                           value="<?php echo htmlspecialchars($cupo); ?>"
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

                    <button type="submit" class="btn btn-primary" name="actualizar" value="actualizar">
                        <i class="fas fa-save me-2"></i> Actualizar
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
<?php include '../assets/inc/flash.php'; ?>
<!-- JS -->
<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/sweetalert2.all.min.js"></script>
<script src="../assets/js/sidebar.js"></script>
<script src="../assets/js/validaciones_edittorneo.js"></script>

</body>
</html>