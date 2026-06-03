<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casa del Ajedrez - Editar Clasificación Final</title>
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
                <button id="closeSidebarBtn" class="sidebar-close-btn" aria-label="Cerrar menú"><i
                        class="fas fa-times"></i></button>
            </div>
            <nav class="menu">
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
                <h1 class="page-title"><i class="fas fa-edit me-2"></i> Editar Clasificación Final</h1>
                <a href="./clasificacion_final.html" class="btn btn-secondary"><i
                        class="fas fa-arrow-left me-2"></i>Volver al catálogo</a>
            </div>

            <div class="form-card">
                <form role="form" name="form" method="POST" onsubmit="return validarEditarClasificacion(event)"
                    action="./clasificacion_final.html">
                    <input type="hidden" name="idClasificacionFinal" id="idClasificacionFinal" value="1">

                    <h3 class="section-title"><i class="fas fa-ranking-star me-2"></i>Datos de la Clasificación</h3>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label required-star">Torneo</label>
                            <select class="form-select" name="idTorneo" id="idTorneo">
                                <option value="">Seleccionar torneo</option>
                                <option value="1" selected>Torneo Nacional de Ajedrez 2025</option>
                                <option value="2">Campeonato Regional Centro</option>
                                <option value="3">Copa Ciudad de Caracas</option>
                                <option value="4">Torneo Internacional Rápido</option>
                            </select>
                            <div class="invalid-feedback-real" id="idTorneoFeedback"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label required-star">Alumno</label>
                            <select class="form-select" name="idAlumno" id="idAlumno">
                                <option value="">Seleccionar alumno</option>
                                <option value="1" selected>Carlos Pérez (C.I: 12345678)</option>
                                <option value="2">Ana Rodríguez (C.I: 23456789)</option>
                                <option value="3">Luis Fernández (C.I: 34567890)</option>
                                <option value="4">María González (C.I: 45678901)</option>
                                <option value="5">José Martínez (C.I: 56789012)</option>
                                <option value="6">Valentina Rojas (C.I: 67890123)</option>
                            </select>
                            <div class="invalid-feedback-real" id="idAlumnoFeedback"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Posición</label>
                            <input type="number" class="form-control" name="posicion" id="posicion" value="1">
                            <div class="invalid-feedback-real" id="posicionFeedback"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Municipio</label>
                            <input type="text" class="form-control" name="municipio" id="municipio" value="Libertador">
                            <div class="invalid-feedback-real" id="municipioFeedback"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Estatus Original</label>
                            <select class="form-select" name="estatusOriginal" id="estatusOriginal">
                                <option value="">Seleccionar estatus</option>
                                <option value="Clasificado" selected>Clasificado</option>
                                <option value="Suplente">Suplente</option>
                                <option value="Eliminado">Eliminado</option>
                                <option value="Descalificado">Descalificado</option>
                            </select>
                            <div class="invalid-feedback-real" id="estatusOriginalFeedback"></div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="reset" class="btn btn-danger" id="resetBtn"><i
                                class="fas fa-eraser me-2"></i>Limpiar</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save me-2"></i>Actualizar
                            Clasificación</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>
    <script src="../assets/js/sidebar.js"></script>
    <script>
        function validarEditarClasificacion(event) {
            event.preventDefault();

            let esValido = true;

            const idTorneo = document.getElementById('idTorneo');
            if (!idTorneo.value) {
                document.getElementById('idTorneoFeedback').innerText = 'Debe seleccionar un torneo';
                idTorneo.classList.add('is-invalid');
                esValido = false;
            } else {
                document.getElementById('idTorneoFeedback').innerText = '';
                idTorneo.classList.remove('is-invalid');
            }

            const idAlumno = document.getElementById('idAlumno');
            if (!idAlumno.value) {
                document.getElementById('idAlumnoFeedback').innerText = 'Debe seleccionar un alumno';
                idAlumno.classList.add('is-invalid');
                esValido = false;
            } else {
                document.getElementById('idAlumnoFeedback').innerText = '';
                idAlumno.classList.remove('is-invalid');
            }

            const posicion = document.getElementById('posicion');
            if (!posicion.value) {
                document.getElementById('posicionFeedback').innerText = 'La posición es obligatoria';
                posicion.classList.add('is-invalid');
                esValido = false;
            } else if (posicion.value < 1) {
                document.getElementById('posicionFeedback').innerText = 'La posición debe ser mayor a 0';
                posicion.classList.add('is-invalid');
                esValido = false;
            } else {
                document.getElementById('posicionFeedback').innerText = '';
                posicion.classList.remove('is-invalid');
            }

            const estatusOriginal = document.getElementById('estatusOriginal');
            if (!estatusOriginal.value) {
                document.getElementById('estatusOriginalFeedback').innerText = 'Debe seleccionar un estatus';
                estatusOriginal.classList.add('is-invalid');
                esValido = false;
            } else {
                document.getElementById('estatusOriginalFeedback').innerText = '';
                estatusOriginal.classList.remove('is-invalid');
            }

            if (esValido) {
                const id = document.getElementById('idClasificacionFinal').value;
                const torneoText = idTorneo.options[idTorneo.selectedIndex]?.text || '';
                const alumnoText = idAlumno.options[idAlumno.selectedIndex]?.text || '';
                const posicionNum = posicion.value;

                let medalla = '';
                if (posicionNum == 1) medalla = '🥇 ';
                else if (posicionNum == 2) medalla = '🥈 ';
                else if (posicionNum == 3) medalla = '🥉 ';

                Swal.fire({
                    title: '¡Actualizado!',
                    text: `${medalla}Clasificación #${id}: ${alumnoText} ha sido actualizado a ${posicionNum}° lugar en ${torneoText}`,
                    icon: 'success',
                    confirmButtonColor: '#3085d6'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = './clasificacion_final.html';
                    }
                });
            }

            return false;
        }
    </script>
</body>

</html>