<!DOCTYPE html>
<html lang="es">
<head>
    <?php include '../assets/inc/head.php'; ?>
</head>

<body>
<div class="page-container">

    <!-- SIDEBAR -->
    <?php include '../assets/inc/sidebar.php'; ?>

    <!-- HEADER -->
    <?php include '../assets/inc/header.php'; ?>

        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="catalog-header">
                <h1 class="page-title"><i class="fas fa-trophy me-2"></i> TORNEOS</h1>
                <button class="btn btn-custom"><a href="./insert_torneo.php"><i class="fas fa-plus-circle me-2"></i>Nuevo Torneo</a></button>
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
                                <a class="btn btn-sm btn-secondary" href="./detalle_torneo.php"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_torneo.php"><i class="fas fa-edit"></i></a>
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
                                <a class="btn btn-sm btn-secondary" href="./detalle_torneo.php"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_torneo.php"><i class="fas fa-edit"></i></a>
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
                                <a class="btn btn-sm btn-secondary" href="./detalle_torneo.php"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_torneo.php"><i class="fas fa-edit"></i></a>
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