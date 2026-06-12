<?php
session_start();
// Verificar sesión antes de mostrar el dashboard
include_once("../../controlador/verificar_sesion.php");
include_once("../../modelo/conexion.php");
?>
<?php
    // Obtener todos los alumnos
    try {
        $sql = $conex->prepare("SELECT a.*, r.nombre as nombre_representante, r.apellido as apellido_representante
                                FROM ALUMNO a 
                                LEFT JOIN REPRESENTANTE r ON a.idRepresentante = r.idRepresentante 
                                ORDER BY a.apellido, a.nombre");
        $sql->execute();
        $alumnos = $sql->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        $alumnos = [];
        error_log("Error al cargar alumnos: " . $e->getMessage());
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

    

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="catalog-header">
            <h1 class="page-title"><i class="fas fa-chess-queen me-2"></i> ALUMNOS</h1>
            <a href="./insert_alumno.php" class="btn btn-custom"><i class="fas fa-plus-circle me-2"></i>Nuevo Alumno</a>
        </div>

        <!-- FILTROS -->
        <div class="filtros">
            <div class="row align-items-end">
                <div class="col-md-3">
                    <label class="form-label">Filtrar por Estatus</label>
                    <select id="filtroEstatus" class="form-select">
                        <option value="">Todos los estatus</option>
                        <option value="activo">Activos</option>
                        <option value="inactivo">Inactivos</option>
                        <option value="suspendido">Suspendidos</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Filtrar por Categoría</label>
                    <select id="filtroCategoria" class="form-select">
                        <option value="">Todas las categorías</option>
                        <option value="Sub-6">Sub-6</option>
                        <option value="Sub-7">Sub-7</option>
                        <option value="Sub-8">Sub-8</option>
                        <option value="Sub-9">Sub-9</option>
                        <option value="Sub-10">Sub-10</option>
                        <option value="Sub-11">Sub-11</option>
                        <option value="Sub-12">Sub-12</option>
                        <option value="Sub-13">Sub-13</option>
                        <option value="Sub-14">Sub-14</option>
                        <option value="Sub-15">Sub-15</option>
                        <option value="Sub-16">Sub-16</option>
                        <option value="Sub-17">Sub-17</option>
                        <option value="Sub-18">Sub-18</option>
                        <option value="Sub-19">Sub-19</option>
                        <option value="Sub-20">Sub-20</option>
                        <option value="Abierta">Abierta</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Buscar</label>
                    <input type="text" id="buscarInput" class="form-control" placeholder="Nombre o cédula...">
                </div>
                <div class="col-md-3">
                    <button id="btnFiltrar" class="btn btn-primary"><i class="fas fa-search me-1"></i>Filtrar</button>
                    <button id="btnLimpiar" class="btn btn-secondary"><i class="fas fa-eraser me-1"></i>Limpiar</button>
                </div>
            </div>
        </div>

        <!-- TABLA DE ALUMNOS -->
        <div class="table-responsive">
            <table class="table alumno-table" id="alumnoTable">
                <thead>
                    <tr>
                        <th>Cédula</th>
                        <th>Nombre Completo</th>
                        <th>Fecha Nac.</th>
                        <th>Edad</th>
                        <th>Categoría</th>
                        <th>Sexo</th>
                        <th>Estatus</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($alumnos)): ?>
                        <tr>
                            <td colspan="8" class="text-center">No hay alumnos registrados</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($alumnos as $alumno): ?>
                            <tr data-estatus="<?php echo htmlspecialchars($alumno['estatus']); ?>" 
                                data-categoria="<?php echo htmlspecialchars($alumno['categoria']); ?>"
                                data-nombre="<?php echo strtolower(htmlspecialchars($alumno['nombre'] . ' ' . $alumno['apellido'])); ?>"
                                data-cedula="<?php echo htmlspecialchars($alumno['cedula']); ?>">
                                <td><?php echo htmlspecialchars($alumno['cedula']); ?></td>
                                <td><?php echo htmlspecialchars($alumno['nombre'] . ' ' . $alumno['apellido']); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($alumno['fechaNacimiento'])); ?></td>
                                <td><?php echo $alumno['edad']; ?> años</td>
                                <td><?php echo htmlspecialchars($alumno['categoria']); ?></td>
                                <td><?php echo $alumno['sexo'] == 'M' ? 'Masculino' : 'Femenino'; ?></td>
                                <td>
                                    <span class="badge bg-<?php echo $alumno['estatus'] == 'activo' ? 'success' : ($alumno['estatus'] == 'inactivo' ? 'secondary' : 'warning'); ?>">
                                        <?php echo ucfirst($alumno['estatus']); ?>
                                    </span>
                                </td>
                                <td>
                                    <a class="btn btn-sm btn-secondary" href="../../controlador/ctl_alumno.php?C=con&I=<?php echo base64_encode($alumno['cedula']); ?>">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a class="btn btn-sm btn-primary" href="../../controlador/ctl_alumno.php?M=mos&I=<?php echo base64_encode($alumno['cedula']); ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button class="btn btn-sm btn-danger btn-delete" data-cedula="<?php echo $alumno['cedula']; ?>" data-nombre="<?php echo htmlspecialchars($alumno['nombre'] . ' ' . $alumno['apellido']); ?>">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
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
<?php include '../assets/inc/eliminar_alumno.php'; ?>


</body>
</html>