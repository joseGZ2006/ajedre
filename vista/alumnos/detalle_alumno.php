<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casa del Ajedrez - Detalle del Alumno</title>
    <link rel="icon" type="image/jpeg" href="../assets/images/logo1.png">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="../assets/css/estyles.css">
    <link rel="stylesheet" href="../assets/css/general.css">
</head>
<body>
    <div class="page-container">
        <!-- SIDEBAR -->
        <aside class="sidebar" role="navigation">
            <div class="logo" style="position: relative;">
                <img src="../assets/images/logodeajedrez.png" alt="logo">
                <div class="brand">
                    <div class="brand">Casa del Ajedrez</div>
                    <div class="muted">MN Marcos Pérez</div>
                </div>
                <button id="closeSidebarBtn" class="sidebar-close-btn" aria-label="Cerrar menú">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <nav class="menu">
                <div class="section">PRINCIPAL</div>
                <ul class="menu-list">
                    <li class="menu-item" data-href="../loyaut/dashboard.html"><div class="icon"><i class="fas fa-tachometer-alt"></i></div><div class="label">Inicio</div></li>
                    <li class="menu-item" data-href="../representantes/representante.html"><div class="icon"><i class="fas fa-users"></i></div><div class="label">Representantes</div></li>
                    <li class="menu-item active" data-href="../alumnos/alumno.html"><div class="icon"><i class="fas fa-user-graduate"></i></div><div class="label">Alumnos</div></li>
                    <li class="menu-item" data-href="../entrenadores/entrenador.html"><div class="icon"><i class="fas fa-chalkboard-user"></i></div><div class="label">Entrenadores</div></li>
                    <li class="menu-item" data-href="../especialidad/especialidad.html"><div class="icon"><i class="fas fa-chess-king"></i></div><div class="label">Especialidades</div></li>
                    <li class="menu-item" data-href="../tipotorneo/tipotorneo.html"><div class="icon"><i class="fas fa-chess-queen"></i></div><div class="label">Tipos de Torneo</div></li>
                    <li class="menu-item" data-href="../clases/clase.html"><div class="icon"><i class="fas fa-chess-board"></i></div><div class="label">Clases</div></li>
                    <li class="menu-item" data-href="../horarios/horario.html"><div class="icon"><i class="fas fa-calendar-alt"></i></div><div class="label">Horario Clases</div></li>
                    <li class="menu-item" data-href="../torneos/torneo.html"><div class="icon"><i class="fas fa-trophy"></i></div><div class="label">Torneos</div></li>
                    <li class="menu-item" data-href="../asistencias/asistencia.html"><div class="icon"><i class="fas fa-check"></i></div><div class="label">Asistencias</div></li>
                </ul>
                <div class="section">BÚSQUEDA</div>
                <div style="padding-top:6px"><div style="display:flex;align-items:center;gap:8px;padding:8px 12px;background:rgba(255,255,255,0.03);border-radius:40px;"><i class="fas fa-search" style="color:#7fcfe6"></i><span style="font-size:0.85rem;color:rgba(255,255,255,0.6)">Buscar entrenador...</span></div></div>
            </nav>
        </aside>

        <div id="sidebarOverlay" class="sidebar-overlay"></div>

        <!-- HEADER -->
        <header class="header">
            <div class="header-inner">
                <div style="display:flex;align-items:center;gap:16px">
                    <button class="nav-btn" id="menuToggle"><i class="fas fa-bars"></i></button>
                    <div class="search-form">
                        <input type="text" id="searchInput" placeholder="Buscar por nombre, cédula o ELO...">
                        <button class="search-btn" id="searchBtn"><i class="fas fa-search"></i></button>
                        <button class="mobile-menu-btn" id="mobileMenuBtn"><i class="fas fa-bars"></i></button>
                    </div>
                </div>
                <div class="header-right" style="position:relative">
                    <div class="profile-pill" id="profilePill">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="avatar">
                        <span>Lagea111</span>
                    </div>
                    <div class="profile-menu" id="profileMenu">
                        <a href="#">Configuración</a>
                        <a href="#">Cerrar sesión</a>
                    </div>
                </div>
            </div>
        </header>

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