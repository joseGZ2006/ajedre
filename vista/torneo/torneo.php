<?php
session_start();
include("../../modelo/conexion.php");
include("../../modelo/clase_torneo.php");
// Verificar sesión 
include_once("../../controlador/verificar_sesion.php");

$tor = new Torneo();
$torneos = $tor->ListarTorneo();

// Función para obtener badge de estatus
function getEstatusBadge($estatus) {
    $clases = [
        'proximo' => 'bg-info',
        'en_curso' => 'bg-success',
        'finalizado' => 'bg-secondary',
        'cancelado' => 'bg-danger'
    ];
    return isset($clases[$estatus]) ? $clases[$estatus] : 'bg-secondary';
}

// Función para obtener badge de tipo
function getTipoBadge($tipo) {
    $clases = [
        'individual' => 'bg-primary',
        'equipo' => 'bg-success',
        'mixto' => 'bg-warning'
    ];
    return isset($clases[$tipo]) ? $clases[$tipo] : 'bg-secondary';
}
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
                <i class="fas fa-trophy me-2"></i> TORNEOS
            </h1>

            <button class="btn btn-custom">
                <a href="./insert_torneo.php">
                    <i class="fas fa-plus-circle me-2"></i> Nuevo Torneo
                </a>
            </button>
        </div>

        <!-- TABLA -->
        <div class="table-responsive">
            <table class="table alumno-table" id="torneoTable">

                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Fecha</th>
                        <th>Lugar</th>
                        <th>Estatus</th>
                        <th>Cupo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if($torneos && count($torneos) > 0): ?>
                        <?php foreach($torneos as $row): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                            <td>
                                <span class="badge <?php echo getTipoBadge($row['tipo_torneo_nombre'] ?? ''); ?>">
                                    <?php echo htmlspecialchars($row['tipo_torneo_nombre'] ?? 'Sin tipo'); ?>
                                </span>
                            </td>
                            <td><?php echo date('d/m/Y', strtotime($row['fecha'])); ?></td>
                            <td><?php echo htmlspecialchars($row['lugar']); ?></td>
                            <td>
                                <span class="badge <?php echo getEstatusBadge($row['estatus']); ?>">
                                    <?php echo ucfirst(htmlspecialchars($row['estatus'])); ?>
                                </span>
                            </td>
                            <td><?php echo htmlspecialchars($row['cupo']); ?></td>
                            <td>
                                <!-- Ver detalle -->
                                <a class="btn btn-sm btn-info" 
                                   href="../../controlador/ctl_torneo.php?C=con&I=<?php echo $row['idTorneo']; ?>">
                                   <i class="fas fa-eye"></i>
                                </a>
                                <!-- Editar -->
                                <a class="btn btn-sm btn-primary" 
                                   href="../../controlador/ctl_torneo.php?M=mos&I=<?php echo $row['idTorneo']; ?>">
                                   <i class="fas fa-edit"></i>
                                </a>
                                <!-- Eliminar -->
                                <button class="btn btn-sm btn-danger btn-delete" 
                                        data-id="<?php echo base64_encode($row['idTorneo']); ?>"
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
                            <td colspan="7" class="text-center">No hay torneos registrados</td>
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
                title: '¿Eliminar torneo?',
                text: `¿Deseas eliminar: ${nombre}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                confirmButtonText: 'Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {

                if (result.isConfirmed) {
                    window.location.href = `../../controlador/ctl_torneo.php?E=eli&I=${id}`;
                }

            });

        });
    });

});
</script>

</body>
</html>