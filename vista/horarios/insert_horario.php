<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casa del Ajedrez - Registrar Horario de Clase</title>
    <link rel="icon" type="image/jpeg" href="../assets/images/logo1.png">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="../assets/css/estyles.css">
    <link rel="stylesheet" href="../assets/css/general.css">
</head>

<body>
    <div class="page-container">
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
                    <li class="menu-item" data-href="../loyaut/dashboard.html">
                        <div class="icon"><i class="fas fa-tachometer-alt"></i></div>
                        <div class="label">Inicio</div>
                    </li>
                    <li class="menu-item" data-href="../representantes/representante.html">
                        <div class="icon"><i class="fas fa-users"></i></div>
                        <div class="label">Representantes</div>
                    </li>
                    <li class="menu-item" data-href="../alumnos/alumno.html">
                        <div class="icon"><i class="fas fa-user-graduate"></i></div>
                        <div class="label">Alumnos</div>
                    </li>
                    <li class="menu-item" data-href="../entrenadores/entrenador.html">
                        <div class="icon"><i class="fas fa-chalkboard-user"></i></div>
                        <div class="label">Entrenadores</div>
                    </li>
                    <li class="menu-item" data-href="../especialidad/especialidad.html">
                        <div class="icon"><i class="fas fa-chess-king"></i></div>
                        <div class="label">Especialidades</div>
                    </li>
                    <li class="menu-item" data-href="../tipotorneo/tipotorneo.html">
                        <div class="icon"><i class="fas fa-chess-queen"></i></div>
                        <div class="label">Tipos de Torneo</div>
                    </li>
                    <li class="menu-item" data-href="../clases/clase.html">
                        <div class="icon"><i class="fas fa-chess-board"></i></div>
                        <div class="label">Clases</div>
                    </li>
                    <li class="menu-item active" data-href="../horarios/horario.html">
                        <div class="icon"><i class="fas fa-calendar-alt"></i></div>
                        <div class="label">Horario Clases</div>
                    </li>
                    <li class="menu-item" data-href="../torneos/torneo.html">
                        <div class="icon"><i class="fas fa-trophy"></i></div>
                        <div class="label">Torneos</div>
                    </li>
                    <li class="menu-item" data-href="../asistencias/asistencia.html">
                        <div class="icon"><i class="fas fa-check"></i></div>
                        <div class="label">Asistencias</div>
                    </li>
                </ul>
                <div class="section">BÚSQUEDA</div>
                <div style="padding-top:6px">
                    <div
                        style="display:flex;align-items:center;gap:8px;padding:8px 12px;background:rgba(255,255,255,0.03);border-radius:40px;">
                        <i class="fas fa-search" style="color:#7fcfe6"></i><span
                            style="font-size:0.85rem;color:rgba(255,255,255,0.6)">Buscar entrenador...</span></div>
                </div>
            </nav>
        </aside>
        <div id="sidebarOverlay" class="sidebar-overlay"></div>

        <header class="header">
            <div class="header-inner">
                <div style="display:flex;align-items:center;gap:16px">
                    <button class="nav-btn" id="menuToggle"><i class="fas fa-bars"></i></button>
                    <div class="search-form">
                        <input type="text" id="searchInput" placeholder="Buscar por día, nivel, aula o entrenador...">
                        <button class="search-btn" id="searchBtn"><i class="fas fa-search"></i></button>
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

        <div class="main-content">
            <div class="catalog-header">
                <h1 class="page-title"><i class="fas fa-plus-circle me-2"></i> Horario de Clase</h1>
                <a href="./horario.html" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Volver al
                    catálogo</a>
            </div>

            <div class="form-card">
                <form role="form" name="form" method="POST" onsubmit="return validarFormularioCompleto(event)"
                    action="./horario.html">
                    <h3 class="section-title"><i class="fas fa-calendar-alt me-2"></i>Datos del Horario</h3>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Día de la Semana *</label>
                            <select class="form-select" name="diaSemana" id="diaSemana">
                                <option value="">Seleccionar día</option>
                                <option value="Lunes">Lunes</option>
                                <option value="Martes">Martes</option>
                                <option value="Miércoles">Miércoles</option>
                                <option value="Jueves">Jueves</option>
                                <option value="Viernes">Viernes</option>
                                <option value="Sábado">Sábado</option>
                                <option value="Domingo">Domingo</option>
                            </select>
                            <div class="invalid-feedback-real" id="diaSemanaFeedback"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Hora Inicio *</label>
                            <input type="time" class="form-control" name="horaInicio" id="horaInicio" step="60">
                            <div class="invalid-feedback-real" id="horaInicioFeedback"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Hora Fin *</label>
                            <input type="time" class="form-control" name="horaFin" id="horaFin" step="60">
                            <div class="invalid-feedback-real" id="horaFinFeedback"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Nivel *</label>
                            <select class="form-select" name="nivel" id="nivel">
                                <option value="">Seleccionar nivel</option>
                                <option value="Principiantes">Principiantes</option>
                                <option value="Intermedios">Intermedios</option>
                                <option value="Avanzados">Avanzados</option>
                                <option value="Competitivo">Competitivo</option>
                            </select>
                            <div class="invalid-feedback-real" id="nivelFeedback"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Aula *</label>
                            <input type="text" class="form-control" name="aula" id="aula"
                                placeholder="Ej: Aula 101, Sala de Torneos">
                            <div class="invalid-feedback-real" id="aulaFeedback"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Entrenador *</label>
                            <select class="form-select" name="idEntrenador" id="idEntrenador">
                                <option value="">Seleccionar entrenador</option>
                                <option value="1">Marcos Pérez</option>
                                <option value="2">Ana López</option>
                                <option value="3">Carlos Ruiz</option>
                                <option value="4">María González</option>
                            </select>
                            <div class="invalid-feedback-real" id="idEntrenadorFeedback"></div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="reset" class="btn btn-danger" id="resetBtn"><i
                                class="fas fa-eraser me-2"></i>Limpiar</button>
                        <button type="submit" value="Registrar" class="btn btn-primary"><i
                                class="fas fa-save me-2"></i>Registrar Horario</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>
    <script src="../assets/js/sidebar.js"></script>
    <script src="../assets/js/validaciones_horario.js"></script>
</body>

</html>