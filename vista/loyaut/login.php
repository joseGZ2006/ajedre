<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php include '../assets/inc/head.php'; ?>
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="login-logo">
                    <img src="../assets/images/logodeajedrez.png" alt="Logo Casa del Ajedrez">
                </div>
                <h3>Bienvenido</h3>
                <p>Ingresa tus credenciales para continuar</p>
            </div>
            
            <div class="login-body">
                <form id="loginForm" role="form" name="formulario" method="POST" action="../../controlador/ctl_usuario.php">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" id="username" name="nombreUsuario" placeholder="Usuario" autocomplete="off">
                        </div>
                        <small class="form-text" id="usernameError"></small>
                    </div>
                    
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="contrasena" placeholder="Contraseña">
                        </div>
                        <small class="form-text" id="passwordError"></small>
                    </div>
                    
                    <div class="remember-me">
                        <input type="checkbox" id="showPassword">
                        <label for="showPassword">Mostrar contraseña</label>
                    </div>
                    
                    <button type="submit" class="btn-login" name="aceptar" value="aceptar">
                        <i class="fas fa-arrow-right"></i> Iniciar Sesión
                    </button>
                </form>
            </div>
            
            <div class="login-footer">
                <a href="#"><i class="fas fa-question-circle"></i> ¿Olvidaste tu contraseña?</a>
            </div>
        </div>
    </div>
    <?php include '../assets/inc/flash.php'; ?>
    <script src="../assets/jquery.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>
    <script src="../assets/js/validacion_login.js"></script>
    
 
</body>
</html>