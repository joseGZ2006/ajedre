<?php
session_start();
// Verificar sesión antes de mostrar el dashboard
include_once("../../controlador/verificar_sesion.php");

// Obtener datos del representante desde la sesión
if(!isset($_SESSION['edit_representante'])){
    $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se encontraron datos del representante para editar.'];
    header("Location: ./representante.php");
    exit;
}

$datos = $_SESSION['edit_representante'];
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
                <h1 class="page-title"><i class="fas fa-user-edit me-2"></i> Editar Representante</h1>
                <a href="./representante.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Volver al catálogo</a>
            </div>

            <div class="form-card">
                <form id="form" method="POST" action="../../controlador/ctl_representante.php" onsubmit="return validarFormularioCompleto(event);">
                    <input type="hidden" name="actualizar" value="actualizar">
                    <input type="hidden" name="idRepresentante" value="<?php echo $datos['idRepresentante']; ?>">
                    <input type="hidden" name="cedula_original" value="<?php echo $datos['cedula']; ?>">
                    
                    <h3 class="section-title"><i class="fas fa-user me-2"></i>Datos del Representante</h3>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Cédula </label>
                            <input type="text" class="form-control" name="cedula" id="cedula" maxlength="10" placeholder="Ingrese la cédula (7-10 dígitos)" autocomplete="off" value="<?php echo htmlspecialchars($datos['cedula']); ?>" readonly>
                            <div class="invalid-feedback-real" id="cedulaFeedback"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Nombre </label>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese el nombre (solo letras y espacios)" value="<?php echo htmlspecialchars($datos['nombre']); ?>" readonly>
                            <div class="invalid-feedback-real" id="nombreFeedback"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Apellido </label>
                            <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Ingrese el apellido (solo letras)" value="<?php echo htmlspecialchars($datos['apellido']); ?>" readonly>
                            <div class="invalid-feedback-real" id="apellidoFeedback"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Teléfono</label>
                            <input type="tel" class="form-control " name="telefono" id="telefono"  placeholder="0412-1234567" value="<?php echo htmlspecialchars($datos['telefono']); ?>">
                            <div class="invalid-feedback-real" id="telefonoFeedback"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" name="correo" id="correo" placeholder="ejemplo@correo.com" value="<?php echo htmlspecialchars($datos['correo']); ?>">
                            <div class="invalid-feedback-real" id="correoFeedback"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Parentesco *</label>
                            <select  class="form-select" name="parentesco" id="parentesco">
                                <option value="">Seleccionar parentesco</option>
                                <option value="Padre" <?php echo ($datos['parentesco'] == 'Padre') ? 'selected' : ''; ?>>Padre</option>
                                <option value="Madre" <?php echo ($datos['parentesco'] == 'Madre') ? 'selected' : ''; ?>>Madre</option>
                                <option value="Tío" <?php echo ($datos['parentesco'] == 'Tío') ? 'selected' : ''; ?>>Tío</option>
                                <option value="Tía" <?php echo ($datos['parentesco'] == 'Tía') ? 'selected' : ''; ?>>Tía</option>
                                <option value="Abuelo" <?php echo ($datos['parentesco'] == 'Abuelo') ? 'selected' : ''; ?>>Abuelo</option>
                                <option value="Abuela" <?php echo ($datos['parentesco'] == 'Abuela') ? 'selected' : ''; ?>>Abuela</option>
                                <option value="Hermano" <?php echo ($datos['parentesco'] == 'Hermano') ? 'selected' : ''; ?>>Hermano</option>
                                <option value="Hermana" <?php echo ($datos['parentesco'] == 'Hermana') ? 'selected' : ''; ?>>Hermana</option>
                                <option value="Tutor Legal" <?php echo ($datos['parentesco'] == 'Tutor Legal') ? 'selected' : ''; ?>>Tutor Legal</option>
                            </select>
                            <div class="invalid-feedback-real" id="parentescoFeedback"></div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="reset" class="btn btn-danger" id="resetBtn"><i class="fas fa-eraser me-2"></i>Limpiar</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Actualizar Representante</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include '../assets/inc/flash.php'; ?>
    
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>
    <script src="../assets/js/sidebar.js"></script>
    <script src="../assets/js/validacion_representante.js"></script>
</body>
</html>