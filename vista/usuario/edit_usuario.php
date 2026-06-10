<?php
session_start();
include("../../modelo/conexion.php");
include("../../modelo/clase_usuario.php");

// Verificar si se recibieron los parámetros
if(!isset($_GET['id']) || !isset($_GET['nom']) || !isset($_GET['rol']) || !isset($_GET['est'])) {
    $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'Parámetros incompletos para editar el usuario.'];
    header("Location: ./usuario.php");
    exit;
}

// Decodificar parámetros
$idUsuario = base64_decode($_GET['id']);
$nombreUsuario = base64_decode($_GET['nom']);
$rol = base64_decode($_GET['rol']);
$estatus = base64_decode($_GET['est']);
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

    <!-- FLASH MESSAGES -->
    <?php if(isset($_SESSION['flash'])): ?>
        <script>
            Swal.fire({
                icon: '<?php echo $_SESSION['flash']['icon']; ?>',
                title: '<?php echo $_SESSION['flash']['title']; ?>',
                html: '<?php echo $_SESSION['flash']['text']; ?>',
                confirmButtonColor: '#3085d6'
            });
        </script>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>

    <!-- CONTENIDO -->
    <div class="main-content">
        <div class="catalog-header">
            <h1 class="page-title">
                <i class="fas fa-edit me-2"></i> Editar Usuario
            </h1>
            <a href="./usuario.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i> Volver
            </a>
        </div>

        <div class="form-card">
            <form action="../../controlador/ctl_usuario.php" method="POST" onsubmit="return validarUsuario(event, true)">
                <input type="hidden" name="actualizar" value="actualizar">
                <input type="hidden" name="id" value="<?php echo base64_encode($idUsuario); ?>">
                <input type="hidden" name="nombre_original" value="<?php echo base64_encode($nombreUsuario); ?>">
                <input type="hidden" name="rol_original" value="<?php echo base64_encode($rol); ?>">
                <input type="hidden" name="estatus_original" value="<?php echo base64_encode($estatus); ?>">
                
                <h3 class="section-title">Actualizar Datos de Usuario</h3>

                <!-- NOMBRE USUARIO -->
                <div class="mb-3">
                    <label class="form-label required-star">Nombre de Usuario</label>
                    <input type="text" class="form-control" name="nombreUsuario" id="nombreUsuario" value="<?php echo htmlspecialchars($nombreUsuario); ?>" placeholder="Ingrese nombre de usuario">
                    <div class="invalid-feedback-real" id="nombreUsuarioFeedback"></div>
                </div>

                <!-- CONTRASEÑA -->
                <div class="mb-3">
                    <label class="form-label">Contraseña (dejar en blanco para conservar la actual)</label>
                    <input type="password" class="form-control" name="contrasena" id="contrasena" placeholder="Ingrese nueva contraseña si desea cambiarla">
                    <div class="invalid-feedback-real" id="contrasenaFeedback"></div>
                    <small class="text-muted">La contraseña debe tener al menos 6 caracteres si desea cambiarla.</small>
                </div>

                <!-- ROL -->
                <div class="mb-3">
                    <label class="form-label required-star">Rol</label>
                    <select class="form-select" name="rol" id="rol">
                        <option value="">Seleccione un rol</option>
                        <option value="admin" <?php echo ($rol == 'admin') ? 'selected' : ''; ?>>Administrador</option>
                        <option value="entrenador" <?php echo ($rol == 'entrenador') ? 'selected' : ''; ?>>Entrenador</option>
                        <option value="alumno" <?php echo ($rol == 'alumno') ? 'selected' : ''; ?>>Alumno</option>
                    </select>
                    <div class="invalid-feedback-real" id="rolFeedback"></div>
                </div>

                <!-- ESTATUS -->
                <div class="mb-3">
                    <label class="form-label required-star">Estatus</label>
                    <select class="form-select" name="estatus" id="estatus">
                        <option value="">Seleccione un estatus</option>
                        <option value="activo" <?php echo ($estatus == 'activo') ? 'selected' : ''; ?>>Activo</option>
                        <option value="inactivo" <?php echo ($estatus == 'inactivo') ? 'selected' : ''; ?>>Inactivo</option>
                    </select>
                    <div class="invalid-feedback-real" id="estatusFeedback"></div>
                </div>

                <!-- BOTONES -->
                <div class="form-actions">
                    <button type="reset" class="btn btn-danger" id="resetBtn">
                        <i class="fas fa-eraser me-2"></i> Limpiar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i> Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/sweetalert2.all.min.js"></script>
<script src="../assets/js/validaciones_usuario.js"></script>
<script src="../assets/js/sidebar.js"></script>
</body>
</html>