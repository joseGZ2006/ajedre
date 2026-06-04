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

    <!-- CONTENIDO -->
    <div class="main-content">

        <div class="catalog-header">
            <h1 class="page-title">
                <i class="fas fa-chess-knight me-2"></i> ESPECIALIDADES
            </h1>

            <button class="btn btn-custom">
                <a href="./insert_especialidad.html">
                    <i class="fas fa-plus-circle me-2"></i> Nueva Especialidad
                </a>
            </button>
        </div>

        <!-- TABLA -->
        <div class="table-responsive">
            <table class="table alumno-table" id="especialidadTable">

                <thead>
                    <tr>
                        <th>Especialidad</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>Aperturas de Ajedrez</td>
                        <td>
                            <a class="btn btn-sm btn-secondary" href="./detalle_especialidad.html"><i class="fas fa-eye"></i></a>
                            <a class="btn btn-sm btn-primary" href="./edit_especialidad.html"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-sm btn-danger btn-delete" data-nombre="Aperturas de Ajedrez">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>Estrategia Posicional</td>
                        <td>
                            <a class="btn btn-sm btn-secondary" href="./detalle_especialidad.html"><i class="fas fa-eye"></i></a>
                            <a class="btn btn-sm btn-primary" href="./edit_especialidad.html"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-sm btn-danger btn-delete" data-nombre="Estrategia Posicional">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>Táctica y Cálculo</td>
                        <td>
                            <a class="btn btn-sm btn-secondary" href="./detalle_especialidad.html"><i class="fas fa-eye"></i></a>
                            <a class="btn btn-sm btn-primary" href="./edit_especialidad.html"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-sm btn-danger btn-delete" data-nombre="Táctica y Cálculo">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>

                </tbody>

            </table>
        </div>

    </div>
</div>

<!-- JS -->
<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/sweetalert2.all.min.js"></script>
<script src="../assets/js/sidebar.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    const botonesEliminar = document.querySelectorAll('.btn-delete');

    botonesEliminar.forEach((btn) => {
        btn.addEventListener('click', function () {

            const nombre = this.getAttribute('data-nombre');

            Swal.fire({
                title: '¿Eliminar especialidad?',
                text: `¿Deseas eliminar: ${nombre}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {

                if (result.isConfirmed) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Eliminado',
                        text: 'Especialidad eliminada correctamente'
                    });
                }

            });

        });
    });

});
</script>

</body>
</html>