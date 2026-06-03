<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Casa del Ajedrez - Gestión de Torneos</title>
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
                    <li class="menu-item active" data-href="../torneos/torneo.html"><div class="icon"><i class="fas fa-trophy"></i></div><div class="label">Torneos</div></li>
                    <li class="menu-item" data-href="../asistencias/asistencia.html"><div class="icon"><i class="fas fa-check"></i></div><div class="label">Asistencias</div></li>
                </ul>
                <div class="section">BÚSQUEDA</div>
                <div style="padding-top:6px"><div style="display:flex;align-items:center;gap:8px;padding:8px 12px;background:rgba(255,255,255,0.03);border-radius:40px;"><i class="fas fa-search" style="color:#7fcfe6"></i><span style="font-size:0.85rem;color:rgba(255,255,255,0.6)">Buscar entrenador...</span></div></div>
            </nav>
        </aside>


        <!-- Overlay para móvil -->
        <div id="sidebarOverlay" class="sidebar-overlay"></div>

        <!-- HEADER -->
        <header class="header">
            <div class="header-inner">
                <div style="display:flex;align-items:center;gap:16px">
                    <button class="nav-btn" id="menuToggle"><i class="fas fa-bars"></i></button>
                    <div class="search-form">
                        <input type="text" id="searchInput" placeholder="Buscar por nombre, fecha, estatus o clasificación...">
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
                <h1 class="page-title"><i class="fas fa-trophy me-2"></i> TORNEOS</h1>
                <button class="btn btn-custom"><a href="./insert_torneo.html"><i class="fas fa-plus-circle me-2"></i>Nuevo Torneo</a></button>
            </div>

            <!-- TABLA DE TORNEOS -->
            <div class="table-responsive">
                <table class="table alumno-table" id="torneoTable">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Fecha</th>
                            <th>Estatus</th>
                            <th>Clasificación</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="tablaTorneos">
                        <tr>
                            <td>Torneo Nacional de Ajedrez</td>
                            <td>2024-12-15</td>
                            <td>Próximo</td>
                            <td>Abierta</td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_torneo.html"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_torneo.html"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="1" data-nombre="Torneo Nacional de Ajedrez">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>Torneo Blitz Navideño</td>
                            <td>2024-12-20</td>
                            <td>Próximo</td>
                            <td>Sub-12</td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_torneo.html"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_torneo.html"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="2" data-nombre="Torneo Blitz Navideño">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>Torneo Rápido de Primavera</td>
                            <td>2024-11-10</td>
                            <td>Finalizado</td>
                            <td>Sub-18</td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_torneo.html"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_torneo.html"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="3" data-nombre="Torneo Rápido de Primavera">
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
        // Función de búsqueda en tiempo real
        document.getElementById('searchInput')?.addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#tablaTorneos tr');
            
            rows.forEach(row => {
                const nombre = row.cells[0]?.textContent.toLowerCase() || '';
                const fecha = row.cells[1]?.textContent.toLowerCase() || '';
                const estatus = row.cells[2]?.textContent.toLowerCase() || '';
                const clasificacion = row.cells[3]?.textContent.toLowerCase() || '';
                
                if (nombre.includes(searchTerm) || fecha.includes(searchTerm) || estatus.includes(searchTerm) || clasificacion.includes(searchTerm)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        function confirmarEliminacion(nombreTorneo, idTorneo) {
            Swal.fire({
                title: '¿Eliminar torneo?',
                text: `¿Estás seguro de que deseas eliminar el torneo "${nombreTorneo}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: '¡Eliminado!',
                        text: `El torneo "${nombreTorneo}" ha sido eliminado.`,
                        icon: 'success',
                        confirmButtonColor: '#3085d6'
                    });
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

        document.addEventListener('DOMContentLoaded', function() {
            const botonesEliminar = document.querySelectorAll('.btn-delete');
            
            botonesEliminar.forEach((boton) => {
                boton.addEventListener('click', function(e) {
                    e.preventDefault();
                    const nombre = this.getAttribute('data-nombre') || 'desconocido';
                    const id = this.getAttribute('data-id') || 'desconocido';
                    confirmarEliminacion(nombre, id);
                });
            });
        });
    </script>
</body>
</html>