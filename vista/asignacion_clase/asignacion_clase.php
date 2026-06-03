<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casa del Ajedrez - Gestión de Asignaciones de Clase</title>
    <link rel="icon" type="image/jpeg" href="../assets/images/logo1.png">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="../assets/css/estyles.css">
    <link rel="stylesheet" href="../assets/css/general.css">
</head>

<body>
    <div class="page-container">
        <!-- SIDEBAR (misma estructura que en clase.html) -->
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
                    <li class="menu-item active" data-href="../clases/asignacion_clase.html">
                        <div class="icon"><i class="fas fa-user-plus"></i></div>
                        <div class="label">Asignación Clases</div>
                    </li>
                    <li class="menu-item" data-href="../horarios/horario.html">
                        <div class="icon"><i class="fas fa-calendar-alt"></i></div>
                        <div class="label">Horario Clases</div>
                    </li>
                    <li class="menu-item" data-href="../torneos/torneo.html">
                        <div class="icon"><i class="fas fa-trophy"></i></div>
                        <div class="label">Torneos</div>
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
                        <i class="fas fa-search" style="color:#7fcfe6"></i><span
                            style="font-size:0.85rem;color:rgba(255,255,255,0.6)">Buscar asignación...</span>
                    </div>
                </div>
            </nav>
        </aside>

        <!-- Overlay para móvil -->
        <div id="sidebarOverlay" class="sidebar-overlay"></div>

        <!-- HEADER (idéntico al original) -->
        <header class="header">
            <div class="header-inner">
                <div style="display:flex;align-items:center;gap:16px">
                    <button class="nav-btn" id="menuToggle"><i class="fas fa-bars"></i></button>
                    <div class="search-form">
                        <input type="text" id="searchInput" placeholder="Buscar por alumno, entrenador o fecha...">
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

        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="catalog-header">
                <h1 class="page-title"><i class="fas fa-user-plus me-2"></i> ASIGNACIONES DE CLASE</h1>
                <button class="btn btn-custom"><a href="./insert_asignacion_clase.html"><i
                            class="fas fa-plus-circle me-2"></i>Nueva Asignación</a></button>
            </div>

            <!-- TABLA DE ASIGNACIONES -->
            <div class="table-responsive">
                <table class="table alumno-table" id="asignacionClaseTable">
                    <thead>
                        <tr>
                            <th>ID Asignación</th>
                            <th>Alumno</th>
                            <th>Entrenador</th>
                            <th>Horario</th>
                            <th>Fecha Inicio</th>
                            <th>Fecha Fin</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Fila 1 -->
                        <tr>
                            <td>101</td>
                            <td>Carlos Pérez</td>
                            <td>Marcos Pérez</td>
                            <td>Lunes 09:00-11:00</td>
                            <td>2025-01-15</td>
                            <td>2025-06-30</td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_asignacion_clase.html?id=101"><i
                                        class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_asignacion_clase.html?id=101"><i
                                        class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="101"
                                    data-nombre="Carlos Pérez - Marcos Pérez">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Fila 2 -->
                        <tr>
                            <td>102</td>
                            <td>Ana Rodríguez</td>
                            <td>Laura Gómez</td>
                            <td>Martes 14:00-16:00</td>
                            <td>2025-02-01</td>
                            <td>2025-07-15</td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_asignacion_clase.html?id=102"><i
                                        class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_asignacion_clase.html?id=102"><i
                                        class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="102"
                                    data-nombre="Ana Rodríguez - Laura Gómez">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Fila 3 -->
                        <tr>
                            <td>103</td>
                            <td>Luis Fernández</td>
                            <td>Marcos Pérez</td>
                            <td>Miércoles 10:00-12:00</td>
                            <td>2025-01-20</td>
                            <td>2025-05-20</td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_asignacion_clase.html?id=103"><i
                                        class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_asignacion_clase.html?id=103"><i
                                        class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="103"
                                    data-nombre="Luis Fernández - Marcos Pérez">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Fila 4 -->
                        <tr>
                            <td>104</td>
                            <td>María González</td>
                            <td>Carlos Rojas</td>
                            <td>Jueves 15:00-17:00</td>
                            <td>2025-03-01</td>
                            <td>2025-08-31</td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_asignacion_clase.html?id=104"><i
                                        class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_asignacion_clase.html?id=104"><i
                                        class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="104"
                                    data-nombre="María González - Carlos Rojas">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Fila 5 -->
                        <tr>
                            <td>105</td>
                            <td>José Martínez</td>
                            <td>Laura Gómez</td>
                            <td>Viernes 08:00-10:00</td>
                            <td>2025-02-10</td>
                            <td>(Activo)</td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_asignacion_clase.html?id=105"><i
                                        class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_asignacion_clase.html?id=105"><i
                                        class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="105"
                                    data-nombre="José Martínez - Laura Gómez">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebar.js"></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>
    <script>
        // Función para confirmar eliminación (mismo estilo que en clase.html)
        function confirmarEliminacion(nombreAsignacion, id) {
            Swal.fire({
                title: '¿Eliminar asignación?',
                text: `¿Estás seguro de que deseas eliminar la asignación "${nombreAsignacion}" con ID ${id}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    // Aquí iría la lógica real de eliminación (AJAX, fetch, etc.)
                    Swal.fire({
                        title: '¡Eliminado!',
                        text: `La asignación "${nombreAsignacion}" ha sido eliminada.`,
                        icon: 'success',
                        confirmButtonColor: '#3085d6'
                    });
                    // Eliminar fila de la tabla (simulado)
                    // $(`button[data-id="${id}"]`).closest('tr').remove();
                } else {
                    Swal.fire({
                        title: 'Cancelado',
                        text: 'La eliminación fue cancelada',
                        icon: 'info',
                        confirmButtonColor: '#3085d6',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        }

        // Búsqueda en tiempo real (simulada)
        document.getElementById('searchInput')?.addEventListener('keyup', function (e) {
            const filter = e.target.value.toLowerCase();
            const rows = document.querySelectorAll('#asignacionClaseTable tbody tr');
            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });

        document.getElementById('searchBtn')?.addEventListener('click', function () {
            const filter = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('#asignacionClaseTable tbody tr');
            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        });

        // Eliminación con SweetAlert
        document.addEventListener('DOMContentLoaded', function () {
            const botonesEliminar = document.querySelectorAll('.btn-delete');

            botonesEliminar.forEach((boton) => {
                boton.addEventListener('click', function (e) {
                    e.preventDefault();
                    const id = this.getAttribute('data-id');
                    const nombre = this.getAttribute('data-nombre');
                    confirmarEliminacion(nombre, id);
                });
            });
        });
    </script>
</body>

</html>