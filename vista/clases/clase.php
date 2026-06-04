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
                <h1 class="page-title"><i class="fas fa-chess-board me-2"></i> CLASES</h1>
                <button class="btn btn-custom"><a href="./insert_clase.html"><i class="fas fa-plus-circle me-2"></i>Nueva Clase</a></button>
            </div>

            <!-- TABLA DE CLASES -->
            <div class="table-responsive">
                <table class="table alumno-table" id="claseTable">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Hora Inicio</th>
                            <th>Hora Fin</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Ajedrez Básico</td>
                            <td>09:00 AM</td>
                            <td>11:00 AM</td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_clase.html"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_clase.html"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="1" data-nombre="Ajedrez Básico">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>Táctica Avanzada</td>
                            <td>11:30 AM</td>
                            <td>01:30 PM</td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_clase.html"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_clase.html"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="2" data-nombre="Táctica Avanzada">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>Finales de Partida</td>
                            <td>02:00 PM</td>
                            <td>04:00 PM</td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_clase.html"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_clase.html"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="3" data-nombre="Finales de Partida">
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
        function confirmarEliminacion(nombreClase, id) {
            Swal.fire({
                title: '¿Eliminar clase?',
                text: `¿Estás seguro de que deseas eliminar la clase "${nombreClase}" con ID ${id}?`,
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
                        text: `La clase "${nombreClase}" ha sido eliminada.`,
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
                    const nombre = fila.cells[1]?.textContent || 'desconocido';
                    const id = fila.cells[0]?.textContent || 'desconocido';
                    confirmarEliminacion(nombre, id);
                });
            });
        });
    </script>
</body>
</html>