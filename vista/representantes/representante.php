<?php
session_start();
// Verificar sesión antes de mostrar el dashboard
include_once("../../controlador/verificar_sesion.php");
include("../../modelo/conexion.php");
include("../../modelo/clase_representante.php");

$rep = new Representante();
$repres = $rep->ListarRepresentante();
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
                <h1 class="page-title"><i class="fas fa-users me-2"></i> GESTIÓN DE REPRESENTANTES</h1>
                <button class="btn btn-custom"><a href="./insert_representante.php"><i class="fas fa-plus-circle me-2"></i>Nuevo Representante</a></button>
            </div>

            <!-- TABLA DE REPRESENTANTES -->
            <div class="table-responsive">
                <table class="table alumno-table" id="representanteTable">
                    <thead>
                        <tr>
                            <th>Cédula</th>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Parentesco</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($repres && count($repres) > 0):?>
                            <?php foreach($repres as $row):?>    
                                <tr>
                                    <td><?php echo htmlspecialchars($row['cedula'])?></td>
                                    <td><?php echo htmlspecialchars($row['nombre'])?></td>
                                    <td><?php echo htmlspecialchars($row['apellido'])?></td>
                                    <td><?php echo htmlspecialchars($row['parentesco'])?></td>
                                     <td>
                                    <a class="btn btn-sm btn-secondary" href="../../controlador/ctl_representante.php?C=con&I=<?php echo base64_encode($row['cedula']); ?>">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a class="btn btn-sm btn-primary" href="../../controlador/ctl_representante.php?M=mos&I=<?php echo base64_encode($row['cedula']); ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger btn-delete" 
                                            data-id="<?php echo $row['idRepresentante']; ?>" 
                                            data-cedula="<?php echo htmlspecialchars($row['cedula']); ?>" 
                                            data-nombre="<?php echo htmlspecialchars($row['nombre'] . ' ' . $row['apellido']); ?>">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                 </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="text-center">No hay representantes registrados</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include '../assets/inc/flash.php'; ?>

    <!-- Formulario oculto para eliminar -->
    <form id="deleteForm" method="POST" action="../../controlador/ctl_representante.php" style="display: none;">
        <input type="hidden" name="eliminar" value="eliminar">
        <input type="hidden" name="idRepresentante" id="deleteId">
    </form>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebar.js"></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const botonesEliminar = document.querySelectorAll('.btn-delete');

            botonesEliminar.forEach((boton) => {
                boton.addEventListener('click', function(e) {
                    e.preventDefault();
                    const id = this.getAttribute('data-id');
                    const nombre = this.getAttribute('data-nombre');
                    const cedula = this.getAttribute('data-cedula');
                    
                    Swal.fire({
                        title: '¿Eliminar representante?',
                        html: `¿Estás seguro de que deseas eliminar a <strong>${nombre}</strong> con cédula <strong>${cedula}</strong>?<br><br><span class="text-danger">Esta acción no se puede deshacer.</span>`,
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar',
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Enviar el formulario para eliminar
                            document.getElementById('deleteId').value = id;
                            document.getElementById('deleteForm').submit();
                        }
                    });
                });
            });
        });
    </script>
</body>
</html>