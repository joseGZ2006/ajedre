<?php
session_start();
include("../../modelo/conexion.php");
include("../../modelo/clase_usuario.php");

$usuarioObj = new Usuario();
$usuariosDisponibles = $usuarioObj->obtenerUsuariosDisponiblesParaEntrenador();
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
            <h1 class="page-title"><i class="fas fa-chalkboard-user me-2"></i> Registrar Nuevo Entrenador</h1>
            <a href="./entrenador.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Volver al catálogo</a>
        </div>

        <div class="form-card">
            <div class="alert alert-info mb-4">
                <i class="fas fa-info-circle me-2"></i>
                <strong>Proceso de registro:</strong>
                <ol class="mt-2 mb-0">
                    <li>Primero debe <a href="../usuario/insert_usuario.php" class="alert-link">crear un usuario</a> con rol "entrenador" en el módulo de usuarios</li>
                    <li>Luego seleccione ese usuario en el campo "Usuario" para asociarlo al entrenador</li>
                    <li>Solo se muestran usuarios con rol "entrenador" que NO estén asociados a ningún entrenador</li>
                </ol>
            </div>
            
            <form role="form" name="form" method="POST" onsubmit="return validarFormularioCompleto(event)" action="../../controlador/ctl_entrenador.php">
                <input type="hidden" name="registrar" value="registrar">
                
                <h3 class="section-title"><i class="fas fa-user-graduate me-2"></i>Datos del Entrenador</h3>
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label required-star">Usuario *</label>
                        <select class="form-select" name="id_usuario" id="id_usuario" required>
                            <option value="">Seleccione un usuario</option>
                            <?php if(!empty($usuariosDisponibles)): ?>
                                <?php foreach($usuariosDisponibles as $usuario): ?>
                                    <option value="<?php echo $usuario['idUsuario']; ?>">
                                        <?php echo htmlspecialchars($usuario['nombreUsuario']); ?> (<?php echo $usuario['rol']; ?> - <?php echo $usuario['estatus']; ?>)
                                    </option>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <option value="" disabled>No hay usuarios disponibles. Cree un usuario con rol "entrenador" primero.</option>
                            <?php endif; ?>
                        </select>
                        <div class="invalid-feedback-real" id="id_usuarioFeedback"></div>
                        <small class="text-muted">Solo se muestran usuarios con rol "entrenador" no asociados a ningún entrenador</small>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label required-star">Cédula *</label>
                        <input type="text" class="form-control" name="cedula" id="cedula" placeholder="Ingrese cédula (7-8 dígitos)" autocomplete="off" maxlength="8">
                        <div class="invalid-feedback-real" id="cedulaFeedback"></div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label required-star">Nombre *</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Ingrese nombre" autocomplete="off">
                        <div class="invalid-feedback-real" id="nombreFeedback"></div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label required-star">Apellido *</label>
                        <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Ingrese apellido" autocomplete="off">
                        <div class="invalid-feedback-real" id="apellidoFeedback"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label required-star">Teléfono *</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" placeholder="0412-1234567" autocomplete="off" maxlength="12">
                        <div class="invalid-feedback-real" id="telefonoFeedback"></div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label">Especialidad</label>
                        <select class="form-select" name="id_especialidad" id="id_especialidad">
                            <option value="">Seleccionar especialidad</option>
                            <?php
                            $sql = $conex->prepare("SELECT idEspecialidad, nombre FROM ESPECIALIDAD ORDER BY nombre");
                            $sql->execute();
                            while($row = $sql->fetch(PDO::FETCH_ASSOC)) {
                                echo '<option value="'.$row['idEspecialidad'].'">'.$row['nombre'].'</option>';
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback-real" id="id_especialidadFeedback"></div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="reset" class="btn btn-danger" id="resetBtn"><i class="fas fa-eraser me-2"></i>Limpiar</button>
                    <button type="submit" value="Registrar" class="btn btn-primary" <?php echo empty($usuariosDisponibles) ? 'disabled' : ''; ?>>
                        <i class="fas fa-save me-2"></i>Registrar Entrenador
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include '../assets/inc/flash.php'; ?>

<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/sweetalert2.all.min.js"></script>
<script src="../assets/js/sidebar.js"></script>
<script src="../assets/js/validaciones_entrenador.js"></script>

</body>
</html>