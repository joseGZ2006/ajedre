<?php
session_start();
include("../../modelo/conexion.php");
include("../../modelo/clase_tipotorneo.php");
// Verificar sesión 
include_once("../../controlador/verificar_sesion.php");

$tip = new TipoTorneo();
$tipos = $tip->ListarTipoTorneo();
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
            <h1 class="page-title">
                <i class="fas fa-chess-knight me-2"></i> TIPOS DE TORNEO
            </h1>

            <button class="btn btn-custom">
                <a href="./insert_tipotorneo.php">
                    <i class="fas fa-plus-circle me-2"></i> Nuevo Tipo de Torneo
                </a>
            </button>
        </div>

        <!-- TABLA -->
        <div class="table-responsive">
            <table class="table alumno-table" id="tipotorneoTable">

                <thead>
                    <tr>
                        <th>Tipo de Torneo</th>
                        <th>Tipo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if($tipos && count($tipos) > 0): ?>
                        <?php foreach($tipos as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                            <td>
                                <span class="badge bg-<?php 
                                    echo $row['tipo'] == 'individual' ? 'primary' : 
                                         ($row['tipo'] == 'equipo' ? 'success' : 'warning'); 
                                ?>">
                                    <?php echo ucfirst(htmlspecialchars($row['tipo'])); ?>
                                </span>
                            </td>
                            <td>
                               
                                <!-- Editar -->
                                <a class="btn btn-sm btn-primary" 
                                   href="../../controlador/ctl_tipotorneo.php?M=mos&I=<?php echo $row['idTipoTorneo']; ?>">
                                   <i class="fas fa-edit"></i>
                                </a>
                                <!-- Eliminar -->
                                <button class="btn btn-sm btn-danger btn-delete" 
                                        data-id="<?php echo base64_encode($row['idTipoTorneo']); ?>"
                                        data-nombre="<?php echo htmlspecialchars($row['nombre']); ?>">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    <?php 
                        endforeach;
                    else:
                    ?>
                        <tr>
                            <td colspan="3" class="text-center">No hay tipos de torneo registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>

            </table>
        </div>

    </div>
</div>
<?php include '../assets/inc/flash.php'; ?>
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
            const id = this.getAttribute('data-id');

            Swal.fire({
                title: '¿Eliminar tipo de torneo?',
                text: `¿Deseas eliminar: ${nombre}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {

                if (result.isConfirmed) {
                    // Redirigir al controlador para eliminar
                    window.location.href = `../../controlador/ctl_tipotorneo.php?E=eli&I=${id}`;
                }

            });

        });
    });

});
</script>

</body>
</html>