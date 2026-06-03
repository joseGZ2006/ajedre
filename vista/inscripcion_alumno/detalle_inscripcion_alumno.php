<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casa del Ajedrez - Detalle de Inscripción</title>
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
                <li class="menu-item" data-href="../horarios/horario.html"><div class="icon"><i class="fas fa-calendar-alt"></i></div><div class="label">Horario Clases</div></li>
                <li class="menu-item" data-href="../torneos/torneo.html"><div class="icon"><i class="fas fa-trophy"></i></div><div class="label">Torneos</div></li>
                <li class="menu-item" data-href="../asistencias/asistencia.html"><div class="icon"><i class="fas fa-check"></i></div><div class="label">Asistencias</div></li>
            </ul>
            <div class="section">BÚSQUEDA</div>
            <div style="padding-top:6px"><div style="display:flex;align-items:center;gap:8px;padding:8px 12px;background:rgba(255,255,255,0.03);border-radius:40px;"><i class="fas fa-search" style="color:#7fcfe6"></i><span style="font-size:0.85rem;color:rgba(255,255,255,0.6)">Buscar inscripción...</span></div></div>
        </nav>
    </aside>

    <div id="sidebarOverlay" class="sidebar-overlay"></div>

    <!-- HEADER -->
    <header class="header">
        <div class="header-inner">
            <div style="display:flex;align-items:center;gap:16px">
                <button class="nav-btn" id="menuToggle"><i class="fas fa-bars"></i></button>
                <div class="search-form">
                    <input type="text" id="searchInput" placeholder="Buscar por alumno...">
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

    <!-- CONTENIDO -->
    <div class="main-content">
        <div class="detail-header">
            <div class="catalog-header">
                <h1 class="page-title">
                    <i class="fas fa-info-circle me-2"></i> Detalle de Inscripción
                </h1>
            </div>
            <a href="./inscripcion_alumno.html" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Volver al catálogo
            </a>
        </div>

        <!-- AVATAR / ICONO -->
        <div class="detail-avatar">
            <div class="avatar-large">
                <i class="fas fa-user-plus"></i>
            </div>
            <h2 id="detalleAlumno">Juan Pérez</h2>
            <p class="text-muted">ID Inscripción: 1</p>
        </div>

        <!-- INFO -->
        <div class="detail-info-grid">
            <div class="info-group">
                <label>
                    <i class="fas fa-user-check me-2"></i>
                    Información de Inscripción
                </label>
                <div class="info-row">
                    <span class="info-label">Alumno:</span>
                    <span class="info-value">Juan Pérez</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Fecha:</span>
                    <span class="info-value">03/06/2026</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Estatus:</span>
                    <span class="info-value"><span class="badge bg-success">Activo</span></span>
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
