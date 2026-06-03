<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casa del Ajedrez - Detalle del Horario de Clase</title>
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
                    <li class="menu-item" data-href="../alumnos/alumno.html"><div class="icon"><i class="fas fa-user-graduate"></i></div><div class="label">Alumnos</div></li>
                    <li class="menu-item" data-href="../entrenadores/entrenador.html"><div class="icon"><i class="fas fa-chalkboard-user"></i></div><div class="label">Entrenadores</div></li>
                    <li class="menu-item" data-href="../especialidad/especialidad.html"><div class="icon"><i class="fas fa-chess-king"></i></div><div class="label">Especialidades</div></li>
                    <li class="menu-item" data-href="../tipotorneo/tipotorneo.html"><div class="icon"><i class="fas fa-chess-queen"></i></div><div class="label">Tipos de Torneo</div></li>
                    <li class="menu-item" data-href="../clases/clase.html"><div class="icon"><i class="fas fa-chess-board"></i></div><div class="label">Clases</div></li>
                    <li class="menu-item active" data-href="../horarios/horario.html"><div class="icon"><i class="fas fa-calendar-alt"></i></div><div class="label">Horario Clases</div></li>
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
                        <input type="text" id="searchInput" placeholder="Buscar por día, nivel, aula o entrenador...">
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
                        <a href="../loyaut/login.html">Cerrar sesión</a>
                    </div>
                </div>
            </div>
        </header>

        <!-- MAIN CONTENT - DETALLE -->
        <div class="main-content">
            <div class="detail-header">
                <div class="catalog-header">
                    <h1 class="page-title"><i class="fas fa-calendar-alt me-2"></i> Información del Horario de Clase</h1>
                </div>
                <a href="./horario.html" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Volver al catálogo</a>
            </div>

            <div class="detail-avatar">
                <div class="avatar-large">
                    <i class="fas fa-calendar-week"></i>
                </div>
                <h2>Clase de Ajedrez - Nivel Principiantes</h2>
                <p class="text-muted"><span>ID Horario: 1 | Día: Lunes</span></p>
            </div>

            <div class="detail-info-grid">
                <!-- INFORMACIÓN DEL HORARIO -->
                <div class="info-group">
                    <label><i class="fas fa-clock me-2"></i>Información del Horario</label>
                    
                    <div class="info-row">
                        <span class="info-label">Día de la Semana:</span>
                        <span class="info-value" id="detalleDia">Lunes</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Hora de Inicio:</span>
                        <span class="info-value" id="detalleHoraInicio">09:00 AM</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Hora de Fin:</span>
                        <span class="info-value" id="detalleHoraFin">11:00 AM</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Duración:</span>
                        <span class="info-value">2 horas</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Nivel:</span>
                        <span class="info-value" id="detalleNivel">Principiantes</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Aula:</span>
                        <span class="info-value" id="detalleAula">Aula 101</span>
                    </div>
                </div>

                <!-- INFORMACIÓN DEL ENTRENADOR -->
                <div class="info-group">
                    <label><i class="fas fa-chalkboard-user me-2"></i>Información del Entrenador</label>
                    
                    <div class="info-row">
                        <span class="info-label">Nombre:</span>
                        <span class="info-value">Marcos Pérez</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Especialidad:</span>
                        <span class="info-value">Aperturas y Finales</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Título:</span>
                        <span class="info-value">Maestro Nacional (MN)</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Teléfono:</span>
                        <span class="info-value">0412-1234567</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Correo:</span>
                        <span class="info-value">marcos.perez@casaajedrez.com</span>
                    </div>
                </div>

                <!-- ESTADÍSTICAS Y ALUMNOS -->
                <div class="info-group">
                    <label><i class="fas fa-chart-line me-2"></i>Estadísticas de la Clase</label>
                    
                    <div class="info-row">
                        <span class="info-label">Alumnos Inscritos:</span>
                        <span class="info-value"><strong>12 alumnos</strong></span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Cupo Máximo:</span>
                        <span class="info-value">15 alumnos</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Cupos Disponibles:</span>
                        <span class="info-value" style="color: #28a745;">3 cupos</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Asistencia Promedio:</span>
                        <span class="info-value">85%</span>
                    </div>
                </div>

                <!-- ALUMNOS ASOCIADOS A ESTE HORARIO -->
                <div class="info-group">
                    <label><i class="fas fa-user-graduate me-2"></i>Alumnos en este Horario</label>
                    
                    <div class="info-row">
                        <span class="info-label">Alumno 1:</span>
                        <span class="info-value">Juan Pérez (Cédula: 12345678)</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Alumno 2:</span>
                        <span class="info-value">Ana Pérez (Cédula: 87654321)</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Alumno 3:</span>
                        <span class="info-value">Carlos Rodríguez (Cédula: 11223344)</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Total alumnos:</span>
                        <span class="info-value"><strong>12 alumnos inscritos</strong></span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Próxima clase:</span>
                        <span class="info-value" style="color: #007bff;">Lunes 15/05/2024 - 09:00 AM</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebar.js"></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>
    
 
</body>
</html>