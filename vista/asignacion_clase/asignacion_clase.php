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
                <h1 class="page-title"><i class="fas fa-user-plus me-2"></i> ASIGNACIONES DE CLASE</h1>
                <button class="btn btn-custom"><a href="./insert_asignacion_clase.php"><i
                            class="fas fa-plus-circle me-2"></i>Nueva Asignación</a></button>
            </div>

            <!-- TABLA DE ASIGNACIONES -->
            <div class="table-responsive">
                <table class="table alumno-table" id="asignacionClaseTable">
                    <thead>
                        <tr>
                            <th>ID AsignaciónClase</th>
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
                                <a class="btn btn-sm btn-secondary" href="./detalle_asignacion_clase.php?id=101"><i
                                        class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_asignacion_clase.php?id=101"><i
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
                                <a class="btn btn-sm btn-secondary" href="./detalle_asignacion_clase.php?id=102"><i
                                        class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_asignacion_clase.php?id=102"><i
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
                                <a class="btn btn-sm btn-secondary" href="./detalle_asignacion_clase.php?id=103"><i
                                        class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_asignacion_clase.php?id=103"><i
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
                                <a class="btn btn-sm btn-secondary" href="./detalle_asignacion_clase.php?id=104"><i
                                        class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_asignacion_clase.php?id=104"><i
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
                                <a class="btn btn-sm btn-secondary" href="./detalle_asignacion_clase.php?id=105"><i
                                        class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_asignacion_clase.php?id=105"><i
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