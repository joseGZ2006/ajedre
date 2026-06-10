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
                <h1 class="page-title"><i class="fas fa-chess-board me-2"></i> PUNTUACIONES DE TEST</h1>
                <button class="btn btn-custom"><a href="./insert_puntuacion_test.php"><i class="fas fa-plus-circle me-2"></i>Nueva Puntuación</a></button>
            </div>

            <!-- TABLA DE PUNTUACIONES -->
            <div class="table-responsive">
                <table class="table alumno-table" id="puntuacionTestTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Asignación de Clase</th>
                            <th>Fecha</th>
                            <th>Número Ronda</th>
                            <th>Puntuación Ronda</th>
                            <th>Puntuación Final</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Asignación #1 (Alumno: Juan Pérez - Clases: Lun/Mie)</td>
                            <td>03/06/2026</td>
                            <td>1</td>
                            <td>4.50</td>
                            <td>9.00</td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_puntuacion_test.php"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_puntuacion_test.php"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="1" data-asignacion="Asignación #1">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Asignación #2 (Alumno: Jose Pérez - Clases: Mar/Jue)</td>
                            <td>01/05/2026</td>
                            <td>2</td>
                            <td>3.75</td>
                            <td>7.50</td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_puntuacion_test.php"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_puntuacion_test.php"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="2" data-asignacion="Asignación #2">
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
        function confirmarEliminacion(asignacion, id) {
            Swal.fire({
                title: '¿Eliminar puntuación?',
                text: `¿Estás seguro de que deseas eliminar la puntuación ID ${id} para la ${asignacion}?`,
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
                        text: `La puntuación ha sido eliminada con éxito.`,
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
                    const asignacion = this.getAttribute('data-asignacion');
                    const id = this.getAttribute('data-id');
                    confirmarEliminacion(asignacion, id);
                });
            });
        });
    </script>
</body>
</html>
