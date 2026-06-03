<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casa del Ajedrez - Editar Torneo</title>
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
                    <li class="menu-item" data-href="../loyaut/dashboard.html"><div class="icon"><i class="fas fa-tachometer-alt"></i></div><div class="label">Inicio</div></li>
                    <li class="menu-item" data-href="../representantes/representante.html"><div class="icon"><i class="fas fa-users"></i></div><div class="label">Representantes</div></li>
                    <li class="menu-item" data-href="../alumnos/alumno.html"><div class="icon"><i class="fas fa-user-graduate"></i></div><div class="label">Alumnos</div></li>
                    <li class="menu-item" data-href="../entrenadores/entrenador.html"><div class="icon"><i class="fas fa-chalkboard-user"></i></div><div class="label">Entrenadores</div></li>
                    <li class="menu-item" data-href="../especialidad/especialidad.html"><div class="icon"><i class="fas fa-chess-king"></i></div><div class="label">Especialidades</div></li>
                    <li class="menu-item" data-href="../tipotorneo/tipotorneo.html"><div class="icon"><i class="fas fa-chess-queen"></i></div><div class="label">Tipos de Torneo</div></li>
                    <li class="menu-item" data-href="../clases/clase.html"><div class="icon"><i class="fas fa-chess-board"></i></div><div class="label">Clases</div></li>
                    <li class="menu-item" data-href="../horarios/horario.html"><div class="icon"><i class="fas fa-calendar-alt"></i></div><div class="label">Horario Clases</div></li>
                    <li class="menu-item active" data-href="../torneos/torneo.html"><div class="icon"><i class="fas fa-trophy"></i></div><div class="label">Torneos</div></li>
                    <li class="menu-item" data-href="../asistencias/asistencia.html"><div class="icon"><i class="fas fa-check"></i></div><div class="label">Asistencias</div></li>
                </ul>
                <div class="section">BÚSQUEDA</div>
                <div style="padding-top:6px"><div style="display:flex;align-items:center;gap:8px;padding:8px 12px;background:rgba(255,255,255,0.03);border-radius:40px;"><i class="fas fa-search" style="color:#7fcfe6"></i><span style="font-size:0.85rem;color:rgba(255,255,255,0.6)">Buscar entrenador...</span></div></div>
            </nav>
        </aside>
        <div id="sidebarOverlay" class="sidebar-overlay"></div>
        
        <header class="header">
            <div class="header-inner">
                <div style="display:flex;align-items:center;gap:16px">
                    <button class="nav-btn" id="menuToggle"><i class="fas fa-bars"></i></button>
                    <div class="search-form">
                        <input type="text" id="searchInput" placeholder="Buscar por nombre, tipo o lugar...">
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
                <h1 class="page-title"><i class="fas fa-trophy me-2"></i> Editar Torneo</h1>
                <a href="./torneo.html" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Volver al catálogo</a>
            </div>

            <div class="form-card">
                <form role="form" name="form" method="POST" onsubmit="return validarFormularioCompleto(event)" action="./torneo.html">
                    <input type="hidden" name="idTorneo" id="idTorneo" value="1">
                    <h3 class="section-title"><i class="fas fa-chess-queen me-2"></i>Datos del Torneo</h3>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Nombre del Torneo *</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese el nombre del torneo" autocomplete="off" value="Torneo Nacional de Ajedrez">
                            <div class="invalid-feedback-real" id="nombreFeedback"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Estatus *</label>
                            <select class="form-select" name="estado" id="estado">
                                <option value="">Seleccionar estatus</option>
                                <option value="Próximo" selected>Próximo</option>
                                <option value="En curso">En curso</option>
                                <option value="Finalizado">Finalizado</option>
                                <option value="Cancelado">Cancelado</option>
                            </select>
                            <div class="invalid-feedback-real" id="estadoFeedback"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Clasificación *</label>
                            <select class="form-select" name="clasificacion" id="clasificacion">
                                <option value="">Seleccionar clasificación</option>
                                <option value="Abierta" selected>Abierta</option>
                                <option value="Sub-8">Sub-8</option>
                                <option value="Sub-12">Sub-12</option>
                                <option value="Sub-18">Sub-18</option>
                                <option value="Senior">Senior</option>
                            </select>
                            <div class="invalid-feedback-real" id="clasificacionFeedback"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label required-star">Fecha del Torneo *</label>
                            <input type="date" class="form-control" name="fecha" id="fecha" placeholder="AAAA-MM-DD" value="2024-12-15">
                            <div class="invalid-feedback-real" id="fechaFeedback"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label required-star">Lugar *</label>
                            <input type="text" class="form-control" name="lugar" id="lugar" placeholder="Ciudad / Centro de torneo" value="Caracas">
                            <div class="invalid-feedback-real" id="lugarFeedback"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label required-star">Categoría *</label>
                            <select class="form-select" name="categoria" id="categoria">
                                <option value="">Seleccionar categoría</option>
                                <option value="Sub-8">Sub-8</option>
                                <option value="Sub-10">Sub-10</option>
                                <option value="Sub-12">Sub-12</option>
                                <option value="Sub-14">Sub-14</option>
                                <option value="Sub-16">Sub-16</option>
                                <option value="Sub-18">Sub-18</option>
                                <option value="Abierta" selected>Abierta</option>
                                <option value="Femenino">Femenino</option>
                                <option value="Senior">Senior (+50)</option>
                            </select>
                            <div class="invalid-feedback-real" id="categoriaFeedback"></div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="reset" class="btn btn-danger" id="resetBtn"><i class="fas fa-eraser me-2"></i>Limpiar</button>
                        <button type="submit" value="Registrar" class="btn btn-primary"><i class="fas fa-save me-2"></i>Actualizar Torneo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>
    <script src="../assets/js/sidebar.js"></script>
    <script src="../assets/js/validaciones_torneo.js"></script>
   
</body>
</html>