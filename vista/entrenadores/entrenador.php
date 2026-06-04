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
                <h1 class="page-title"><i class="fas fa-chalkboard-user me-2"></i> ENTRENADORES</h1>
                <button class="btn btn-custom"><a href="./insert_entrenador.html"><i class="fas fa-plus-circle me-2"></i>Nuevo Entrenador</a></button>
            </div>

            <!-- TABLA DE ENTRENADORES -->
            <div class="table-responsive">
                <table class="table alumno-table" id="entrenadorTable">
                    <thead>
                        <tr>
                            <th>Cédula</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>12345678</td>
                            <td>Marcos</td>
                            <td>Pérez</td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_entrenador.html"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_entrenador.html"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="12345678" data-nombre="Marcos Pérez">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>87654321</td>
                            <td>Ana</td>
                            <td>Rodríguez</td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_entrenador.html"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_entrenador.html"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="87654321" data-nombre="Ana Rodríguez">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>11223344</td>
                            <td>Carlos</td>
                            <td>Martínez</td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_entrenador.html"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_entrenador.html"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="11223344" data-nombre="Carlos Martínez">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>99887766</td>
                            <td>Laura</td>
                            <td>Gómez</td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_entrenador.html"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_entrenador.html"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="99887766" data-nombre="Laura Gómez">
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
        function confirmarEliminacion(nombreEntrenador, cedula) {
            Swal.fire({
                title: '¿Eliminar entrenador?',
                text: `¿Estás seguro de que deseas eliminar a ${nombreEntrenador} con cédula ${cedula}?`,
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
                        text: `El entrenador ${nombreEntrenador} ha sido eliminado.`,
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
                    const fila = this.closest('tr');
                    const nombre = fila.cells[1]?.textContent + ' ' + fila.cells[2]?.textContent || 'desconocido';
                    const cedula = fila.cells[0]?.textContent || 'desconocida';
                    confirmarEliminacion(nombre, cedula);
                });
            });
        });
    </script>
</body>
</html>