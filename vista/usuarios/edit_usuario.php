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
                    <i class="fas fa-edit me-2"></i> Editar Usuario
                </h1>
                <a href="./usuario.html" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Volver
                </a>
            </div>

            <div class="form-card">
                <form onsubmit="return validarUsuario(event, true)">
                    <h3 class="section-title">Actualizar Datos de Usuario</h3>

                    <!-- NOMBRE USUARIO -->
                    <div class="mb-3">
                        <label class="form-label required-star">Nombre de Usuario</label>
                        <input type="text" class="form-control" id="nombreUsuario" value="marcos_perez" placeholder="Ingrese nombre de usuario">
                        <div class="invalid-feedback-real" id="nombreUsuarioFeedback"></div>
                    </div>

                    <!-- CONTRASEÑA -->
                    <div class="mb-3">
                        <label class="form-label">Contraseña (dejar en blanco para conservar la actual)</label>
                        <input type="password" class="form-control" id="contrasena" placeholder="Ingrese nueva contraseña si desea cambiarla">
                        <div class="invalid-feedback-real" id="contrasenaFeedback"></div>
                    </div>

                    <!-- ROL -->
                    <div class="mb-3">
                        <label class="form-label required-star">Rol</label>
                        <select class="form-select" id="rol">
                            <option value="">Seleccione un rol</option>
                            <option value="admin">Administrador</option>
                            <option value="entrenador" selected>Entrenador</option>
                            <option value="alumno">Alumno</option>
                        </select>
                        <div class="invalid-feedback-real" id="rolFeedback"></div>
                    </div>

                    <!-- ESTATUS -->
                    <div class="mb-3">
                        <label class="form-label required-star">Estatus</label>
                        <select class="form-select" id="estatus">
                            <option value="">Seleccione un estatus</option>
                            <option value="activo" selected>Activo</option>
                            <option value="inactivo">Inactivo</option>
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
