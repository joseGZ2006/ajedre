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
                <h1 class="page-title"><i class="fas fa-calendar-alt me-2"></i> GESTIÓN DE HORARIO DE CLASES</h1>
                <button class="btn btn-custom"><a href="./insert_horario.html"><i class="fas fa-plus-circle me-2"></i>Nuevo Horario</a></button>
            </div>

            <!-- TABLA DE HORARIOS -->
            <div class="table-responsive">
                <table class="table alumno-table" id="horarioTable">
                    <thead>
                        <tr>
                            <th>Día</th>
                            <th>Hora Inicio</th>
                            <th>Hora Fin</th>
                            <th>Nivel</th>
                            <th>Aula</th>
                            <th>Entrenador</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Lunes</td>
                            <td>09:00 AM</td>
                            <td>11:00 AM</td>
                            <td>Principiantes</td>
                            <td>Aula 101</td>
                            <td>Marcos Pérez</td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_horario.html"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_horario.html"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="1" data-dia="Lunes" data-horario="09:00 AM - 11:00 AM">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>Miércoles</td>
                            <td>03:00 PM</td>
                            <td>05:00 PM</td>
                            <td>Intermedios</td>
                            <td>Aula 102</td>
                            <td>Ana López</td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_horario.html"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_horario.html"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="2" data-dia="Miércoles" data-horario="03:00 PM - 05:00 PM">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>Viernes</td>
                            <td>06:00 PM</td>
                            <td>08:00 PM</td>
                            <td>Avanzados</td>
                            <td>Aula 103</td>
                            <td>Carlos Ruiz</td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_horario.html"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_horario.html"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="3" data-dia="Viernes" data-horario="06:00 PM - 08:00 PM">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>Sábado</td>
                            <td>10:00 AM</td>
                            <td>12:00 PM</td>
                            <td>Principiantes</td>
                            <td>Aula 101</td>
                            <td>Marcos Pérez</td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_horario.html"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_horario.html"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="4" data-dia="Sábado" data-horario="10:00 AM - 12:00 PM">
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
        // Función de búsqueda
        document.getElementById('searchBtn')?.addEventListener('click', function() {
            const searchTerm = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('#horarioTable tbody tr');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(searchTerm) ? '' : 'none';
            });
        });

        document.getElementById('searchInput')?.addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                document.getElementById('searchBtn').click();
            }
        });

        function confirmarEliminacion(dia, horario) {
            Swal.fire({
                title: '¿Eliminar horario?',
                text: `¿Estás seguro de que deseas eliminar el horario de ${dia} (${horario})?`,
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
                        text: `El horario de ${dia} (${horario}) ha sido eliminado.`,
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
                    const dia = this.getAttribute('data-dia') || 'desconocido';
                    const horario = this.getAttribute('data-horario') || 'desconocido';
                    confirmarEliminacion(dia, horario);
                });
            });
        });
    </script>
</body>
</html>