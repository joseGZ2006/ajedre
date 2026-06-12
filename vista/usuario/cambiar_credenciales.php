<?php
session_start();
// cambiar_credenciales.php
include_once("../../controlador/verificar_sesion.php");

// Guardar la página de origen SOLO si no hay una guardada
if(isset($_SERVER['HTTP_REFERER']) && !isset($_SESSION['pagina_anterior'])) {
    $referer = $_SERVER['HTTP_REFERER'];
    // Evitar guardar la misma página de cambio de credenciales
    if(strpos($referer, 'cambiar_credenciales.php') === false) {
        $_SESSION['pagina_anterior'] = $referer;
    }
}

// Si se pasa por URL la página de retorno
if(isset($_GET['return_to'])) {
    $_SESSION['pagina_anterior'] = base64_decode($_GET['return_to']);
}

// Determinar la URL de retorno - usar dashboard como fallback
$return_url = isset($_SESSION['pagina_anterior']) ? $_SESSION['pagina_anterior'] : '../dashboard.php';

// Limpiar la variable de sesión después de usarla (opcional, para que no se reutilice)
// Comentado para que funcione múltiples veces
// unset($_SESSION['pagina_anterior']);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php include '../assets/inc/head.php'; ?>
    
</head>
<body>
<div class="page-container">
    <?php include '../assets/inc/sidebar.php'; ?>
    <?php include '../assets/inc/header.php'; ?>

    <!-- CONTENIDO -->
    <div class="main-content">
        <div class="catalog-header">
            <h1 class="page-title">
                <i class="fas fa-key me-2"></i> Cambiar Credenciales
            </h1>
            <!-- Cambiar el botón por un enlace normal -->
            <a href="<?php echo $return_url; ?>" class="btn btn-secondary" id="btnVolver">
                <i class="fas fa-arrow-left me-2"></i> Volver
            </a>
        </div>

        <div class="form-card">
            <form method="POST" action="../../controlador/ctl_usuario.php" id="cambiarForm">
                <input type="hidden" name="cambiar" value="cambiar">
                <input type="hidden" name="return_url" value="<?php echo htmlspecialchars($return_url); ?>">
                <div class="row">

                    <!-- Nombre de usuario -->
                    <div class="col-md-6 mb-3">
                        <label for="nombre_usuario" class="form-label">
                            <i class="fas fa-user"></i> Nuevo nombre de usuario
                        </label>
                        <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" 
                            value="<?php echo htmlspecialchars($_SESSION['usu_ses']); ?>"
                            required>
                        <small class="text-muted">Entre 3 y 50 caracteres. Solo letras, números, puntos, guiones o guión bajo.</small>
                    </div>

                    <!-- Contraseña actual -->
                    <div class="col-md-6 mb-3">
                        <label for="contrasena_actual" class="form-label">
                            <i class="fas fa-lock"></i> Contraseña actual
                        </label>
                        <input type="password" class="form-control" id="contrasena_actual" name="contrasena_actual" required>
                    </div>

                    <!-- Nueva contraseña -->
                    <div class="col-md-6 mb-3">
                        <label for="contrasena_nueva" class="form-label">
                            <i class="fas fa-key"></i> Nueva contraseña
                        </label>
                        <input type="password" class="form-control" id="contrasena_nueva" name="contrasena_nueva">
                        <div class="password-requirements">
                            <i class="fas fa-info-circle"></i> La contraseña debe tener al menos 6 caracteres
                        </div>
                    </div>

                    <!-- Confirmar nueva contraseña -->
                    <div class="col-md-6 mb-3">
                        <label for="confirmar_contrasena" class="form-label">
                            <i class="fas fa-check-circle"></i> Confirmar nueva contraseña
                        </label>
                        <input type="password" class="form-control" id="confirmar_contrasena" name="confirmar_contrasena">
                    </div>

                    <!-- Mostrar contraseña -->
                    <div class="col-md-6 mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="showPassword">
                            <label class="form-check-label" for="showPassword">
                                <i class="fas fa-eye"></i> Mostrar contraseñas
                            </label>
                        </div>
                    </div>
                </div>

                <div align="right">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Actualizar Credenciales
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="../../assets/js/jquery-3.6.0.min.js"></script>
<script src="../../assets/js/bootstrap.bundle.min.js"></script>
<script src="../../assets/js/sweetalert2.all.min.js"></script>
<script src="../../assets/js/sidebar.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mostrar/ocultar contraseñas
    const showPasswordCheckbox = document.getElementById('showPassword');
    const contrasenaActual = document.getElementById('contrasena_actual');
    const contrasenaNueva = document.getElementById('contrasena_nueva');
    const confirmarContrasena = document.getElementById('confirmar_contrasena');

    if (showPasswordCheckbox) {
        showPasswordCheckbox.addEventListener('change', function() {
            const type = this.checked ? 'text' : 'password';
            contrasenaActual.type = type;
            contrasenaNueva.type = type;
            confirmarContrasena.type = type;
        });
    }

    // Validar formulario antes de enviar
    const form = document.getElementById('cambiarForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            const nuevaPass = contrasenaNueva.value;
            const confirmarPass = confirmarContrasena.value;
            
            if (nuevaPass !== confirmarPass) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Las contraseñas nuevas no coinciden'
                });
                return false;
            }
            
            if (nuevaPass.length > 0 && nuevaPass.length < 6) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'La nueva contraseña debe tener al menos 6 caracteres'
                });
                return false;
            }
            
            // Mostrar loading al enviar
            Swal.fire({
                title: 'Actualizando...',
                text: 'Por favor espere',
                allowOutsideClick: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });
        });
    }
});
</script>

<?php include '../../assets/inc/flash.php'; ?>
</body>
</html>