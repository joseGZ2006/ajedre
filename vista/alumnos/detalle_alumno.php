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

        <!-- MAIN CONTENT - DETALLE -->
        <div class="main-content">
            <div class="detail-header">
                <div class="catalog-header">
                </div>
                <a href="./alumno.html" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Volver al catálogo</a>
            </div>

                <div class="detail-avatar">
                    <div class="avatar-large">
                        <i class="fas fa-chess-queen"></i>
                    </div>
                    <h2 >Juan Pérez</h2>
                    <p class="text-muted"><span >ID: 1 | Cédula: 12345678</span></p>
                </div>

                <div class="detail-info-grid">
                    <!-- INFORMACIÓN PERSONAL -->
                    <div class="info-group">
                        <label><i class="fas fa-user me-2"></i>Información Personal</label>
                        
                        <div class="info-row">
                            <span class="info-label">Nombre:</span>
                            <span class="info-value" id="detalleNombre">Juan</span>
                        </div>
                        
                        <div class="info-row">
                            <span class="info-label">Apellido:</span>
                            <span class="info-value" id="detalleApellido">Pérez</span>
                        </div>
                        
                        <div class="info-row">
                            <span class="info-label">Fecha de Nacimiento:</span>
                            <span class="info-value" id="detalleFechaNac">15/03/2005</span>
                        </div>
                        
                        <div class="info-row">
                            <span class="info-label">Sexo:</span>
                            <span class="info-value" id="detalleSexo">Masculino</span>
                        </div>
                        
                        <div class="info-row">
                            <span class="info-label">Teléfono:</span>
                            <span class="info-value" id="detalleTelefono">0412-1234567</span>
                        </div>
                        
                        <div class="info-row">
                            <span class="info-label">Correo Electrónico:</span>
                            <span class="info-value" id="detalleCorreo">juan.perez@example.com</span>
                        </div>
                        
                        <div class="info-row">
                            <span class="info-label">Dirección:</span>
                            <span class="info-value" id="detalleDireccion">Calle Principal #123</span>
                        </div>
                        
                        <div class="info-row">
                            <span class="info-label">Localidad:</span>
                            <span class="info-value" id="detalleLocalidad">San Felipe</span>
                        </div>
                    </div>

                    <!-- INFORMACIÓN ACADÉMICA -->
                    <div class="info-group">
                        <label><i class="fas fa-graduation-cap me-2"></i>Información Académica</label>
                        
                        <div class="info-row">
                            <span class="info-label">¿Dónde Estudia?:</span>
                            <span class="info-value" id="detalleDondeEstudia">U.E. Colegio San José</span>
                        </div>
                        
                        <div class="info-row">
                            <span class="info-label">Grado:</span>
                            <span class="info-value" id="detalleGrado">5to Año</span>
                        </div>
                        
                        <div class="info-row">
                            <span class="info-label">Sección:</span>
                            <span class="info-value" id="detalleSeccion">"A"</span>
                        </div>
                    </div>

                    <!-- INFORMACIÓN DEPORTIVA -->
                    <div class="info-group">
                        <label><i class="fas fa-chess-board me-2"></i>Información Deportiva</label>
                        
                        <div class="info-row">
                            <span class="info-label">Deporte:</span>
                            <span class="info-value" id="detalleDeporte">Ajedrez</span>
                        </div>
                        
                        <div class="info-row">
                            <span class="info-label">Categoría:</span>
                            <span class="info-value" id="detalleCategoria">Sub-18</span>
                        </div>
                        
                        <div class="info-row">
                            <span class="info-label">Club:</span>
                            <span class="info-value" id="detalleClub">Club de Ajedrez San Felipe</span>
                        </div>
                        
                        <div class="info-row">
                            <span class="info-label">Control Inicio Deportivo:</span>
                            <span class="info-value" id="detalleControlInicio">Federación Venezolana</span>
                        </div>
                    </div>
                </div>

                <!-- SECCIÓN DE REPRESENTANTE (visible solo para menores de edad) -->
                <div class="info-group">
                    <label><i class="fas fa-user-friends me-2"></i>Información del Representante</label>
                    <div class="detail-info-grid">
                        <div class="info-group">
                            <div class="info-row">
                                <span class="info-label">Nombre del Representante:</span>
                                <span class="info-value" id="repNombre">María Pérez</span>
                            </div>
                            
                            <div class="info-row">
                                <span class="info-label">Teléfono del Representante:</span>
                                <span class="info-value" id="repTelefono">0412-7654321</span>
                            </div>
                            
                            <div class="info-row">
                                <span class="info-label">Parentesco:</span>
                                <span class="info-value" id="repParentesco">Madre</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebar.js"></script>
  
</body>
</html>