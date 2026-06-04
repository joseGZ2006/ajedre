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
                <h1 class="page-title"><i class="fas fa-chess-queen me-2"></i> ALUMNOS</h1>
                <button class="btn btn-custom" ><a href="./insert_alumno.html"><i class="fas fa-plus-circle me-2"></i>Nuevo Alumno</a></button>
            </div>

            <!-- TABLA DE ALUMNOS -->
            <div class="table-responsive">
                <table class="table alumno-table" id="alumnoTable">
                    <thead>
                        <tr>
                            <th>Cédula</th>
                            <th>Nombre Completo</th>
                            <th>Fecha Nac.</th>
                            <th>Sexo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>12345678</td>
                            <td>Juan Pérez</td>
                            <td>15/03/2005</td>
                            <td>Masculino</td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_alumno.html"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_alumno.html"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="12345678" data-nombre="Juan Pérez">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                         <tr>
                            <td>12344678</td>
                            <td>jose Pérez</td>
                            <td>15/03/2005</td>
                            <td>Masculino</td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_alumno.html"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_alumno.html"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="12345678" data-nombre="Juan Pérez">
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
    // Función para mostrar alerta de confirmación de eliminación
    function confirmarEliminacion(nombreAlumno, cedula) {
        Swal.fire({
            title: '¿Eliminar alumno?',
            text: `¿Estás seguro de que deseas eliminar a ${nombreAlumno} con cédula ${cedula}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Aquí puedes agregar la lógica de eliminación cuando la tengas
                Swal.fire({
                    title: '¡Eliminado!',
                    text: `El alumno ${nombreAlumno} ha sido eliminado.`,
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

    // Asignar evento a todos los botones de eliminar
    document.addEventListener('DOMContentLoaded', function() {
        const botonesEliminar = document.querySelectorAll('.btn-danger');
        
        botonesEliminar.forEach((boton, index) => {
            boton.addEventListener('click', function(e) {
                e.preventDefault();
                // Aquí puedes obtener los datos de la fila correspondiente
                const fila = this.closest('tr');
                const nombre = fila.cells[1]?.textContent || 'desconocido';
                const cedula = fila.cells[0]?.textContent || 'desconocida';
                confirmarEliminacion(nombre, cedula);
            });
        });
    });
</script>
</body>
</html>