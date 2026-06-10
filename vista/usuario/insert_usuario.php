<?php
session_start();

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
                <i class="fas fa-plus-circle me-2"></i> Registrar Usuario
            </h1>
            <a href="./usuario.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i> Volver
            </a>
        </div>

        <div class="form-card">
            <div class="alert alert-info mb-4">
                <i class="fas fa-info-circle me-2"></i>
                <strong>Información:</strong>
                <ul class="mt-2 mb-0">
                    <li>El nombre de usuario debe tener entre 3 y 50 caracteres</li>
                    <li>Puede contener letras, números, puntos, guiones o guión bajo</li>
                    <li>La contraseña debe tener al menos 6 caracteres</li>
                    <li>Para crear un entrenador, seleccione el rol "entrenador" y luego asígnelo desde el módulo de entrenadores</li>
                </ul>
            </div>

            <form action="../../controlador/ctl_usuario.php" method="POST" onsubmit="return validarUsuario(event, false)">
                <input type="hidden" name="registrar" value="registrar">
                
                <h3 class="section-title">Datos de Usuario</h3>

                <!-- NOMBRE USUARIO -->
                <div class="mb-3">
                    <label class="form-label required-star">Nombre de Usuario</label>
                    <input type="text" class="form-control" name="nombreUsuario" id="nombreUsuario" placeholder="Ingrese nombre de usuario" value="<?php echo isset($_POST['nombreUsuario']) ? htmlspecialchars($_POST['nombreUsuario']) : ''; ?>">
                    <div class="invalid-feedback-real" id="nombreUsuarioFeedback"></div>
                </div>

                <!-- CONTRASEÑA -->
                <div class="mb-3">
                    <label class="form-label required-star">Contraseña</label>
                    <input type="password" class="form-control" name="contrasena" id="contrasena" placeholder="Ingrese contraseña">
                    <div class="invalid-feedback-real" id="contrasenaFeedback"></div>
                </div>

                <!-- ROL -->
                <div class="mb-3">
                    <label class="form-label required-star">Rol</label>
                    <select class="form-select" name="rol" id="rol">
                        <option value="">Seleccione un rol</option>
                        <option value="admin" <?php echo (isset($_POST['rol']) && $_POST['rol'] == 'admin') ? 'selected' : ''; ?>>Administrador</option>
                        <option value="entrenador" <?php echo (isset($_POST['rol']) && $_POST['rol'] == 'entrenador') ? 'selected' : ''; ?>>Entrenador</option>
                        <option value="alumno" <?php echo (isset($_POST['rol']) && $_POST['rol'] == 'alumno') ? 'selected' : ''; ?>>Alumno</option>
                    </select>
                    <div class="invalid-feedback-real" id="rolFeedback"></div>
                </div>

                <!-- ESTATUS -->
                <div class="mb-3">
                    <label class="form-label required-star">Estatus</label>
                    <select class="form-select" name="estatus" id="estatus">
                        <option value="">Seleccione un estatus</option>
                        <option value="activo" <?php echo (isset($_POST['estatus']) && $_POST['estatus'] == 'activo') ? 'selected' : ''; ?>>Activo</option>
                        <option value="inactivo" <?php echo (isset($_POST['estatus']) && $_POST['estatus'] == 'inactivo') ? 'selected' : ''; ?>>Inactivo</option>
                    </select>
                    <div class="invalid-feedback-real" id="estatusFeedback"></div>
                </div>

                <!-- BOTONES -->
                <div class="form-actions">
                    <button type="reset" class="btn btn-danger" id="resetBtn">
                        <i class="fas fa-eraser me-2"></i> Limpiar
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i> Registrar
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