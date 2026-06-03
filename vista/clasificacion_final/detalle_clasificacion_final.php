<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casa del Ajedrez - Detalle de Clasificación Final</title>
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
                        <div class="icon"><i class="fas fa-book"></i></div>
                        <div class="label">Especialidades</div>
                    </li>
                    <li class="menu-item" data-href="../tipotorneo/tipotorneo.html">
                        <div class="icon"><i class="fas fa-list"></i></div>
                        <div class="label">Tipos de Torneo</div>
                    </li>
                    <li class="menu-item" data-href="../clases/clase.html">
                        <div class="icon"><i class="fas fa-chess-board"></i></div>
                        <div class="label">Clases</div>
                    </li>
                    <li class="menu-item" data-href="../horarios/horario.html">
                        <div class="icon"><i class="fas fa-calendar-alt"></i></div>
                        <div class="label">Horario Clases</div>
                    </li>
                    <li class="menu-item" data-href="../torneos/torneo.html">
                        <div class="icon"><i class="fas fa-trophy"></i></div>
                        <div class="label">Torneos</div>
                    </li>
                    <li class="menu-item active" data-href="../clasificacion/clasificacion_final.html">
                        <div class="icon"><i class="fas fa-ranking-star"></i></div>
                        <div class="label">Clasificación Final</div>
                    </li>
                    <li class="menu-item" data-href="../asistencia/asistencia.html">
                        <div class="icon"><i class="fas fa-clipboard-list"></i></div>
                        <div class="label">Asistencia</div>
                    </li>
                </ul>
                <div class="section">BÚSQUEDA</div>
                <div style="padding-top:6px">
                    <div
                        style="display:flex;align-items:center;gap:8px;padding:8px 12px;background:rgba(255,255,255,0.03);border-radius:40px;">
                        <i class="fas fa-search" style="color:#7fcfe6"></i>
                        <span style="font-size:0.85rem;color:rgba(255,255,255,0.6)">Buscar clasificación...</span>
                    </div>
                </div>
            </nav>
        </aside>

        <div id="sidebarOverlay" class="sidebar-overlay"></div>

        <header class="header">
            <div class="header-inner">
                <div style="display:flex;align-items:center;gap:16px">
                    <button class="nav-btn" id="menuToggle"><i class="fas fa-bars"></i></button>
                    <div class="search-form">
                        <input type="text" id="searchInput" placeholder="Buscar...">
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

        <div class="main-content">
            <div class="detail-header">
                <div class="catalog-header">
                    <h1 class="page-title"><i class="fas fa-ranking-star me-2"></i> Información de Clasificación Final
                    </h1>
                </div>
                <a href="./clasificacion_final.html" class="btn btn-secondary"><i
                        class="fas fa-arrow-left me-2"></i>Volver al catálogo</a>
            </div>

            <div class="detail-avatar">
                <div class="avatar-large">
                    <i class="fas fa-trophy"></i>
                </div>
                <h2>🏆 Clasificación #1</h2>
                <p class="text-muted">Torneo Nacional de Ajedrez 2025</p>
            </div>

            <div class="detail-info-grid">
                <div class="info-group">
                    <label><i class="fas fa-info-circle me-2"></i>Información General</label>

                    <div class="info-row">
                        <span class="info-label">ID Clasificación:</span>
                        <span class="info-value" id="detalleIdClasificacion">1</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Torneo:</span>
                        <span class="info-value" id="detalleTorneo">Torneo Nacional de Ajedrez 2025</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Fecha del Torneo:</span>
                        <span class="info-value" id="detalleFechaTorneo">15-20 Marzo 2025</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Tipo de Torneo:</span>
                        <span class="info-value" id="detalleTipoTorneo">Individual</span>
                    </div>
                </div>

                <div class="info-group mt-4">
                    <label><i class="fas fa-user-graduate me-2"></i>Información del Alumno</label>

                    <div class="info-row">
                        <span class="info-label">ID Alumno:</span>
                        <span class="info-value" id="detalleIdAlumno">1</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Nombre Completo:</span>
                        <span class="info-value" id="detalleAlumno">Carlos Pérez</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Cédula:</span>
                        <span class="info-value" id="detalleCedula">12345678</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Categoría:</span>
                        <span class="info-value" id="detalleCategoria">Sub-16</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Club:</span>
                        <span class="info-value" id="detalleClub">Ajedrez Caracas</span>
                    </div>
                </div>

                <div class="info-group mt-4">
                    <label><i class="fas fa-ranking-star me-2"></i>Resultados</label>

                    <div class="info-row">
                        <span class="info-label">Posición Final:</span>
                        <span class="info-value"><span class="badge bg-warning" id="detallePosicion">🥇 1°
                                Lugar</span></span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Municipio:</span>
                        <span class="info-value" id="detalleMunicipio">Libertador</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Estatus Original:</span>
                        <span class="info-value"><span class="badge bg-success"
                                id="detalleEstatus">Clasificado</span></span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Premio:</span>
                        <span class="info-value" id="detallePremio">Trofeo + Medalla de Oro</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Puntuación:</span>
                        <span class="info-value" id="detallePuntuacion">6.5/7 puntos</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebar.js"></script>

    <script>
        function getQueryParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        document.addEventListener('DOMContentLoaded', function () {
            const id = getQueryParam('id');
            if (id) {
                console.log('Cargando detalles de clasificación ID:', id);
                document.getElementById('detalleIdClasificacion').innerText = id;

                // Simular carga de datos según el ID
                const clasificaciones = {
                    1: { torneo: 'Torneo Nacional de Ajedrez 2025', fecha: '15-20 Marzo 2025', tipo: 'Individual', alumno: 'Carlos Pérez', cedula: '12345678', categoria: 'Sub-16', club: 'Ajedrez Caracas', posicion: '🥇 1° Lugar', municipio: 'Libertador', estatus: 'Clasificado', premio: 'Trofeo + Medalla de Oro', puntuacion: '6.5/7 puntos' },
                    2: { torneo: 'Torneo Nacional de Ajedrez 2025', fecha: '15-20 Marzo 2025', tipo: 'Individual', alumno: 'Ana Rodríguez', cedula: '23456789', categoria: 'Sub-14', club: 'Peones de Baruta', posicion: '🥈 2° Lugar', municipio: 'Chacao', estatus: 'Clasificado', premio: 'Medalla de Plata', puntuacion: '5.5/7 puntos' },
                    3: { torneo: 'Torneo Nacional de Ajedrez 2025', fecha: '15-20 Marzo 2025', tipo: 'Individual', alumno: 'Luis Fernández', cedula: '34567890', categoria: 'Sub-16', club: 'Ajedrez Caracas', posicion: '🥉 3° Lugar', municipio: 'Baruta', estatus: 'Clasificado', premio: 'Medalla de Bronce', puntuacion: '5.0/7 puntos' }
                };

                const data = clasificaciones[id];
                if (data) {
                    document.getElementById('detalleTorneo').innerText = data.torneo;
                    document.getElementById('detalleFechaTorneo').innerText = data.fecha;
                    document.getElementById('detalleTipoTorneo').innerText = data.tipo;
                    document.getElementById('detalleAlumno').innerText = data.alumno;
                    document.getElementById('detalleCedula').innerText = data.cedula;
                    document.getElementById('detalleCategoria').innerText = data.categoria;
                    document.getElementById('detalleClub').innerText = data.club;
                    document.getElementById('detallePosicion').innerHTML = data.posicion;
                    document.getElementById('detalleMunicipio').innerText = data.municipio;
                    document.getElementById('detalleEstatus').innerHTML = `<span class="badge bg-success">${data.estatus}</span>`;
                    document.getElementById('detallePremio').innerText = data.premio;
                    document.getElementById('detallePuntuacion').innerText = data.puntuacion;
                }
            }
        });
    </script>
</body>

</html>