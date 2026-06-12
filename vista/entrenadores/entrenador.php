<?php
session_start();
include("../../controlador/verificar_sesion.php");
include("../../modelo/conexion.php");
include("../../modelo/clase_entrenador.php");

$ent = new Entrenador();
$entrenadores = $ent->ListarEntrenadores();


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php include '../assets/inc/head.php'; ?>
</head>

<body>
<div class="page-container">
    <?php include '../assets/inc/sidebar.php'; ?>
    <?php include '../assets/inc/header.php'; ?>

    <div class="main-content">
        <div class="catalog-header">
            <h1 class="page-title"><i class="fas fa-chalkboard-user me-2"></i> ENTRENADORES</h1>
            <a href="./insert_entrenador.php" class="btn btn-custom"><i class="fas fa-plus-circle me-2"></i>Nuevo Entrenador</a>
        </div>

     
        <div class="table-responsive">
            <table class="table alumno-table" id="entrenadorTable">
                <thead>
                    <tr>
                        <th>Cédula</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Teléfono</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tablaEntrenadores">
                    <?php if($entrenadores && count($entrenadores) > 0): ?>
                        <?php foreach($entrenadores as $row): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['cedula']); ?></td>
                                <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                                <td><?php echo htmlspecialchars($row['apellido']); ?></td>
                                <td><?php echo htmlspecialchars($row['telefono'] ?: 'No registrado'); ?></td>
                                <td>
                                    <a class="btn btn-sm btn-secondary" href="../../controlador/ctl_entrenador.php?C=con&I=<?php echo base64_encode($row['cedula']); ?>">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a class="btn btn-sm btn-primary" href="../../controlador/ctl_entrenador.php?M=mos&I=<?php echo base64_encode($row['cedula']); ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger btn-delete" data-cedula="<?php echo $row['cedula']; ?>" data-nombre="<?php echo htmlspecialchars($row['nombre'] . ' ' . $row['apellido']); ?>">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                 </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">No hay entrenadores registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/sidebar.js"></script>
<script src="../assets/js/sweetalert2.all.min.js"></script>
<?php include '../assets/inc/eliminar_entrenador.php'; ?>

</body>
</html>