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

    <?php
    session_start();
    
 
    
    include '../../modelo/conexion.php';
    
    // Obtener todos los alumnos
    try {
        $sql = $conex->query("SELECT * FROM ALUMNO ORDER BY apellido, nombre");
        $alumnos = $sql->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
        $alumnos = [];
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Error al cargar los alumnos: " . addslashes($e->getMessage()) . "'
            });
        </script>";
    }
    ?>

    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="catalog-header">
            <h1 class="page-title"><i class="fas fa-chess-queen me-2"></i> ALUMNOS</h1>
            <button class="btn btn-custom"><a href="./insert_alumno.php"><i class="fas fa-plus-circle me-2"></i>Nuevo Alumno</a></button>
        </div>

        <!-- FILTROS -->
        <div class="filtros mb-3">
            <div class="row">
                <div class="col-md-3">
                    <select id="filtroEstatus" class="form-select">
                        <option value="">Todos los estatus</option>
                        <option value="activo">Activos</option>
                        <option value="inactivo">Inactivos</option>
                        <option value="suspendido">Suspendidos</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <select id="filtroCategoria" class="form-select">
                        <option value="">Todas las categorías</option>
                        <option value="Sub-6">Sub-6</option>
                        <option value="Sub-8">Sub-8</option>
                        <option value="Sub-10">Sub-10</option>
                        <option value="Sub-12">Sub-12</option>
                        <option value="Sub-14">Sub-14</option>
                        <option value="Sub-16">Sub-16</option>
                        <option value="Sub-18">Sub-18</option>
                        <option value="Adultos">Adultos</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button id="btnFiltrar" class="btn btn-primary">Filtrar</button>
                    <button id="btnLimpiar" class="btn btn-secondary">Limpiar</button>
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
                            <tr data-estatus="<?php echo htmlspecialchars($alumno['estatus']); ?>" data-categoria="<?php echo htmlspecialchars($alumno['categoria']); ?>">
                                <td><?php echo htmlspecialchars($alumno['cedula']); ?></td>
                                <td><?php echo htmlspecialchars($alumno['nombre'] . ' ' . $alumno['apellido']); ?></td>
                                <td><?php echo date('d/m/Y', strtotime($alumno['fechaNacimiento'])); ?></td>
                                <td><?php echo $alumno['edad']; ?> años</td>
                                <td><?php echo htmlspecialchars($alumno['categoria']); ?></td>
                                <td><?php echo $alumno['sexo'] == 'M' ? 'Masculino' : 'Femenino'; ?></td>
                                <td>
                                    <span class="badge bg-<?php 
                                        echo $alumno['estatus'] == 'activo' ? 'success' : ($alumno['estatus'] == 'inactivo' ? 'secondary' : 'warning'); 
                                    ?>">
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

<script>
$(document).ready(function() {
    // Función para filtrar la tabla
    function filtrarTabla() {
        var estatus = $('#filtroEstatus').val();
        var categoria = $('#filtroCategoria').val();
        
        $('#alumnoTable tbody tr').each(function() {
            var mostrar = true;
            
            if (estatus && $(this).data('estatus') !== estatus) {
                mostrar = false;
            }
            
            if (categoria && $(this).data('categoria') !== categoria) {
                mostrar = false;
            }
            
            if (mostrar) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }
    
    // Botón filtrar
    $('#btnFiltrar').click(function() {
        filtrarTabla();
    });
    
    // Botón limpiar filtros
    $('#btnLimpiar').click(function() {
        $('#filtroEstatus').val('');
        $('#filtroCategoria').val('');
        $('#alumnoTable tbody tr').show();
    });
    
    // Función para confirmar eliminación
    function confirmarEliminacion(nombreAlumno, cedula) {
        Swal.fire({
            title: '¿Eliminar alumno?',
            text: `¿Estás seguro de que deseas eliminar a ${nombreAlumno} con cédula ${cedula}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `../controlador/ctl_alumno.php?E=eli&I=${btoa(cedula)}`;
            }
        });
    }
    
    // Evento para los botones de eliminar
    $('.btn-delete').click(function() {
        var cedula = $(this).data('cedula');
        var nombre = $(this).data('nombre');
        confirmarEliminacion(nombre, cedula);
    });
});
</script>

</body>
</html>