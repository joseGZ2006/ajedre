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
                <h1 class="page-title"><i class="fas fa-users-cog me-2"></i> GESTIÓN DE USUARIOS</h1>
                <button class="btn btn-custom"><a href="./insert_usuario.php"><i class="fas fa-plus-circle me-2"></i>Nuevo Usuario</a></button>
            </div>

            <!-- TABLA DE USUARIOS -->
            <div class="table-responsive">
                <table class="table alumno-table" id="usuarioTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre de Usuario</th>
                            <th>Rol</th>
                            <th>Estatus</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Lagea111</td>
                            <td><span class="badge bg-primary">Admin</span></td>
                            <td><span class="badge bg-success">Activo</span></td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_usuario.php"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_usuario.php"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="1" data-nombre="Lagea111">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>marcos_perez</td>
                            <td><span class="badge bg-info">Entrenador</span></td>
                            <td><span class="badge bg-success">Activo</span></td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_usuario.php"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_usuario.php"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="2" data-nombre="marcos_perez">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>juan_perez</td>
                            <td><span class="badge bg-secondary">Alumno</span></td>
                            <td><span class="badge bg-danger">Inactivo</span></td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_usuario.php"><i class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_usuario.php"><i class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="3" data-nombre="juan_perez">
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
        function confirmarEliminacion(nombreUsuario, id) {
            Swal.fire({
                title: '¿Eliminar usuario?',
                text: `¿Estás seguro de que deseas eliminar al usuario "${nombreUsuario}" con ID ${id}?`,
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
                        text: `El usuario "${nombreUsuario}" ha sido eliminado.`,
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
                    const nombre = this.getAttribute('data-nombre');
                    const id = this.getAttribute('data-id');
                    confirmarEliminacion(nombre, id);
                });
            });
        });
    </script>
</body>
</html>
