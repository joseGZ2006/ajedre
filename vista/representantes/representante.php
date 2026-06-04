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
                <h1 class="page-title"><i class="fas fa-users me-2"></i> GESTIÓN DE REPRESENTANTES</h1>
                <button class="btn btn-custom"><a href="./insert_representante.html"><i class="fas fa-plus-circle me-2"></i>Nuevo Representante</a></button>
            </div>

            <!-- TABLA DE REPRESENTANTES -->
            <div class="table-responsive">
                <table class="table alumno-table" id="representanteTable">
                    <thead>
                        <tr>
                            <th>Cédula</th>
                            <th>Nombre Completo</th>
                            <th>Teléfono</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>12345678</td>
                            <td>María Pérez</td>
                            <td>0412-1234567</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-info btn-view-modal" data-bs-toggle="modal" data-bs-target="#representanteDetailModal" data-cedula="12345678" data-nombre="María Pérez" data-telefono="0412-1234567">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <a class="btn btn-sm btn-primary" href="./edit_representante.html"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="12345678" data-nombre="María Pérez">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>87654321</td>
                            <td>Carlos Rodríguez</td>
                            <td>0416-9876543</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-info btn-view-modal" data-bs-toggle="modal" data-bs-target="#representanteDetailModal" data-cedula="87654321" data-nombre="Carlos Rodríguez" data-telefono="0416-9876543">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <a class="btn btn-sm btn-primary" href="./edit_representante.html"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="87654321" data-nombre="Carlos Rodríguez">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>11223344</td>
                            <td>Ana Martínez</td>
                            <td>0424-5566778</td>
                            <td>
                                <button type="button" class="btn btn-sm btn-info btn-view-modal" data-bs-toggle="modal" data-bs-target="#representanteDetailModal" data-cedula="11223344" data-nombre="Ana Martínez" data-telefono="0424-5566778">
                                    <i class="fas fa-eye"></i>
                                </button>
                                <a class="btn btn-sm btn-primary" href="./edit_representante.html"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="11223344" data-nombre="Ana Martínez">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal de detalle de representante -->
    <div class="modal fade" id="representanteDetailModal" tabindex="-1" aria-labelledby="representanteDetailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="representanteDetailModalLabel">Detalle del Representante</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <strong>Cédula:</strong>
                        <p id="modalRepCedula" class="mb-2">-</p>
                    </div>
                    <div class="mb-3">
                        <strong>Nombre:</strong>
                        <p id="modalRepNombre" class="mb-2">-</p>
                    </div>
                    <div class="mb-3">
                        <strong>Teléfono:</strong>
                        <p id="modalRepTelefono" class="mb-2">-</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebar.js"></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>
    <script>
        function confirmarEliminacion(nombreRepresentante, cedula) {
            Swal.fire({
                title: '¿Eliminar representante?',
                text: `¿Estás seguro de que deseas eliminar a ${nombreRepresentante} con cédula ${cedula}?`,
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
                        text: `El representante ${nombreRepresentante} ha sido eliminado.`,
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
            const botonesVerModal = document.querySelectorAll('.btn-view-modal');

            botonesEliminar.forEach((boton) => {
                boton.addEventListener('click', function(e) {
                    e.preventDefault();
                    const fila = this.closest('tr');
                    const nombre = fila.cells[1]?.textContent || 'desconocido';
                    const cedula = fila.cells[0]?.textContent || 'desconocida';
                    confirmarEliminacion(nombre, cedula);
                });
            });

            botonesVerModal.forEach((boton) => {
                boton.addEventListener('click', function() {
                    const cedula = this.getAttribute('data-cedula') || '-';
                    const nombre = this.getAttribute('data-nombre') || '-';
                    const telefono = this.getAttribute('data-telefono') || '-';

                    document.getElementById('modalRepCedula').textContent = cedula;
                    document.getElementById('modalRepNombre').textContent = nombre;
                    document.getElementById('modalRepTelefono').textContent = telefono;
                });
            });
        });
    </script>
</body>
</html>