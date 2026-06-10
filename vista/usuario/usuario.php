<?php
session_start();
include("../../modelo/conexion.php");
include("../../modelo/clase_usuario.php");

$usuario = new Usuario();
$Usuarios = $usuario->ListarUsuarios();


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
            <h1 class="page-title"><i class="fas fa-users-cog me-2"></i> GESTIÓN DE USUARIOS</h1>
            <a href="./insert_usuario.php" class="btn btn-custom">
                <i class="fas fa-plus-circle me-2"></i>Nuevo Usuario
            </a>
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
                    <?php if($Usuarios && count($Usuarios) > 0): ?>
                        <?php foreach($Usuarios as $user): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user['idUsuario']); ?></td>
                                <td><?php echo htmlspecialchars($user['nombreUsuario']); ?></td>
                                <td>
                                
                                        <?php echo ucfirst(htmlspecialchars($user['rol'])); ?>
                                   
                                </td>
                                <td>
                                    <span class="badge <?php echo $user['estatus'] == 'activo' ? 'bg-success' : 'bg-danger'; ?>">
                                        <?php echo ucfirst(htmlspecialchars($user['estatus'])); ?>
                                    </span>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-secondary" href="../../controlador/ctl_usuario.php?C=con&I=<?php echo $user['idUsuario']; ?>">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a class="btn btn-sm btn-primary" href="../../controlador/ctl_usuario.php?M=mos&I=<?php echo $user['idUsuario']; ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger btn-delete" data-id="<?php echo base64_encode($user['idUsuario']); ?>" data-nombre="<?php echo htmlspecialchars($user['nombreUsuario']); ?>">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No hay usuarios registrados. Haga clic en "Listar Usuarios" para cargar los datos.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php include '../assets/inc/flash.php'; ?>
<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/sidebar.js"></script>
<script src="../assets/js/sweetalert2.all.min.js"></script>
<script>
    function confirmarEliminacion(nombreUsuario, idEncoded) {
        Swal.fire({
            title: '¿Eliminar usuario?',
            text: `¿Estás seguro de que deseas eliminar al usuario "${nombreUsuario}"?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `../../controlador/ctl_usuario.php?E=eli&I=${idEncoded}`;
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