<?php
// Verificar sesión antes de mostrar el dashboard
include_once("../../controlador/verificar_sesion.php");
?>
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
                <h1 class="page-title"><i class="fas fa-user-plus me-2"></i> INSCRIPCIONES DE ALUMNOS</h1>
                <button class="btn btn-custom"><a href="./insert_inscripcion_alumno.php"><i class="fas fa-plus-circle me-2"></i>Nueva Inscripción</a></button>
            </div>

            <!-- TABLA DE INSCRIPCIONES -->
            <div class="table-responsive">
                <table class="table alumno-table" id="inscripcionAlumnoTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Alumno</th>
                            <th>Fecha</th>
                            <th>Estatus</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Juan Pérez</td>
                            <td>03/06/2026</td>
                            <td><span class="badge bg-success">Activo</span></td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_inscripcion_alumno.php"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_inscripcion_alumno.php"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="1" data-nombre="Juan Pérez">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Jose Pérez</td>
                            <td>01/05/2026</td>
                            <td><span class="badge bg-danger">Inactivo</span></td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_inscripcion_alumno.html"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_inscripcion_alumno.html"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="2" data-nombre="Jose Pérez">
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
        function confirmarEliminacion(nombreAlumno, id) {
            Swal.fire({
                title: '¿Eliminar inscripción?',
                text: `¿Estás seguro de que deseas eliminar la inscripción ID ${id} del alumno ${nombreAlumno}?`,
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
                        title: '¡Eliminada!',
                        text: `La inscripción del alumno ${nombreAlumno} ha sido eliminada.`,
                        icon: 'success',
                        confirmButtonColor: '#3085d6'
                    });
                } else {
                    Swal.fire({
                        title: 'Cancelada',
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
                    const nombre = this.getAttribute('data-nombre');
                    const id = this.getAttribute('data-id');
                    confirmarEliminacion(nombre, id);
                });
            });
        });
    </script>
</body>
</html>
