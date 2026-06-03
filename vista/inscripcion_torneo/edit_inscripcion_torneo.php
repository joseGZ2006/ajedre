<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casa del Ajedrez - Editar Inscripción de Torneo</title>
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
            <div class="catalog-header">
                <h1 class="page-title">
                    <i class="fas fa-edit me-2"></i> Editar Inscripción de Torneo
                </h1>
                <a href="./inscripcion_torneo.html" class="btn btn-secondary">
                    <i class="fas fa-arrow-left me-2"></i> Volver
                </a>
            </div>

            <div class="form-card">
                <form onsubmit="return validarInscripcionTorneo(event)">
                    <h3 class="section-title">Actualizar Inscripción de Torneo</h3>

                    <!-- ALUMNO -->
                    <div class="mb-3">
                        <label class="form-label required-star">Alumno</label>
                        <select class="form-select" id="idAlumno">
                            <option value="">Seleccione un alumno</option>
                            <option value="1" selected>Juan Pérez</option>
                            <option value="2">Jose Pérez</option>
                        </select>
                        <div class="invalid-feedback-real" id="idAlumnoFeedback"></div>
                    </div>

                    <!-- TORNEO -->
                    <div class="mb-3">
                        <label class="form-label required-star">Torneo</label>
                        <select class="form-select" id="idTorneo">
                            <option value="">Seleccione un torneo</option>
                            <option value="1" selected>Torneo Escolar Primavera</option>
                            <option value="2">Clásico de Otoño 2026</option>
                        </select>
                        <div class="invalid-feedback-real" id="idTorneoFeedback"></div>
                    </div>

                    <!-- FECHA -->
                    <div class="mb-3">
                        <label class="form-label required-star">Fecha de Inscripción</label>
                        <input type="date" class="form-control" id="fecha" value="2026-06-03">
                        <div class="invalid-feedback-real" id="fechaFeedback"></div>
                    </div>

                    <!-- ESTATUS -->
                    <div class="mb-3">
                        <label class="form-label required-star">Estatus</label>
                        <select class="form-select" id="estatus">
                            <option value="">Seleccione un estatus</option>
                            <option value="pendiente" selected>Pendiente</option>
                            <option value="confirmado">Confirmado</option>
                            <option value="rechazado">Rechazado</option>
                            <option value="cancelado">Cancelado</option>
                        </select>
                        <div class="invalid-feedback-real" id="estatusFeedback"></div>
                    </div>

                    <!-- PAGO -->
                    <div class="mb-3">
                        <label class="form-label required-star">Estado de Pago</label>
                        <select class="form-select" id="pago">
                            <option value="0" selected>No Pagado</option>
                            <option value="1">Pagado</option>
                        </select>
                        <div class="invalid-feedback-real" id="pagoFeedback"></div>
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
    <script src="../assets/js/validaciones_inscripcion_torneo.js"></script>
    <script src="../assets/js/sidebar.js"></script>
</body>
</html>
