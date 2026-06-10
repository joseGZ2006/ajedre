<?php
session_start();
include("../../modelo/conexion.php");
include("../../modelo/clase_especialidad.php");


// Verificar sesión antes de mostrar el dashboard
include_once("../../controlador/verificar_sesion.php");


$espe = new Especialidad();
$especialidad = $espe->ListarEspecialidad();


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

    <!-- CONTENIDO -->
    <div class="main-content">

       <div class="catalog-header">
            <h1 class="page-title"><i class="fas fa-chalkboard-user me-2"></i> ESPECIALIDADES</h1>
            <a href="./insert_especialidad.php" class="btn btn-custom"><i class="fas fa-plus-circle me-2"></i>Nueva Especialidad</a>
        </div>

       
            <div class="table-responsive">
                <table class="table alumno-table">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($especialidad && count($especialidad) > 0): ?>
                        <?php foreach($especialidad as $row): ?>
                            <tr>
                                <?php $idEspecialidad = $row['idEspecialidad'];?>
                                <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                                <td>
                                   
                                    <a class="btn btn-sm btn-primary" href="../../controlador/ctl_especialidad.php?M=mos&I=<?php echo $idEspecialidad; ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger btn-delete" data-idEspecialidad="<?php echo $idEspecialidad; ?>" data-nombre="<?php echo htmlspecialchars($row['nombre']); ?>">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4" class="text-center">No hay especialidades registradas</td>
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
<script src="../assets/js/sweetalert2.all.min.js"></script>
<script src="../assets/js/sidebar.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const botonesEliminar = document.querySelectorAll('.btn-delete');
    
    botonesEliminar.forEach((boton) => {
        boton.addEventListener('click', function(e) {
            e.preventDefault();
            const nombre = this.getAttribute('data-nombre');
            const idEspecialidad = this.getAttribute('data-idEspecialidad');
            
            Swal.fire({
                title: '¿Eliminar especialidad?',
                text: `¿Estás seguro de que deseas eliminar la especialidad "${nombre}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `../../controlador/ctl_especialidad.php?E=eli&I=${btoa(idEspecialidad)}`;
                }
            });
        });
    });
});
</script>

</body>

</html>