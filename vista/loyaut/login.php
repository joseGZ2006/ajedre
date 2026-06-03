<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casa del Ajedrez - Iniciar Sesión</title>
    <link rel="icon" type="image/jpeg" href="../assets/images/logo1.png">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/fontawesome.min.css">
    <!-- CSS separado para el login -->
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
                <form id="loginForm" method="post" action="./dashboard.html">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Usuario o correo electrónico" autocomplete="off">
                        </div>
                        <small class="form-text" id="usernameError"></small>
                    </div>
                    
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                        </div>
                        <small class="form-text" id="passwordError"></small>
                    </div>
                    
                    <div class="remember-me">
                        <input type="checkbox" id="showPassword">
                        <label for="showPassword">Mostrar contraseña</label>
                    </div>
                    
                    <button type="submit" class="btn-login">
                        <i class="fas fa-arrow-right"></i> Iniciar Sesión
                    </button>
                </form>
            </div>
            
            <div class="login-footer">
                <a href="#"><i class="fas fa-question-circle"></i> ¿Olvidaste tu contraseña?</a>
            </div>
        </div>
    </div>

    <script src="../assets/jquery.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>
    <!-- JS separado para el login -->
    <script src="../assets/js/validación_login.js"></script>
</body>
</html>