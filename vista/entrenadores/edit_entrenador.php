<?php
session_start();
include("../../modelo/conexion.php");
include("../../modelo/clase_entrenador.php");
include("../../modelo/clase_usuario.php");


// Verificar sesión antes de mostrar el dashboard
include_once("../../controlador/verificar_sesion.php");


$ent = new Entrenador();
$usuarioObj = new Usuario();
$cedula_decodificada = base64_decode($_GET['ced']);
$datos_entrenador = $ent->MostrarEntrenador($cedula_decodificada);

if($datos_entrenador && is_array($datos_entrenador)) {
    $id_entrenador = $datos_entrenador[0];
    $cedula = $datos_entrenador[1];
    $nombre = $datos_entrenador[2];
    $apellido = $datos_entrenador[3];
    $telefono = $datos_entrenador[4];
    $id_usuario_actual = $datos_entrenador[5];
    $id_especialidad = $datos_entrenador[6];
    
    // Obtener usuarios disponibles (incluyendo el actual)
    $usuariosDisponibles = $usuarioObj->obtenerUsuariosDisponiblesParaEntrenador();
    
    // Si el usuario actual no está en la lista de disponibles, lo agregamos manualmente
    $usuarioEncontrado = false;
    foreach($usuariosDisponibles as $u) {
        if($u['idUsuario'] == $id_usuario_actual) {
            $usuarioEncontrado = true;
            break;
        }
    }
    if(!$usuarioEncontrado) {
        $usuarioActual = $usuarioObj->ConsultarUsuario($id_usuario_actual);
        if($usuarioActual) {
            $usuariosDisponibles[] = $usuarioActual;
        }
    }
} else {
    echo "<script>Swal.fire('Error', 'No se encontró el entrenador', 'error').then(()=>{window.location='./entrenador.php';});</script>";
    exit;
}
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
            <h1 class="page-title"><i class="fas fa-edit me-2"></i> Editar Entrenador</h1>
            <a href="./entrenador.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Volver al catálogo</a>
        </div>

        <div class="form-card">
            <form role="form" name="form" method="POST" onsubmit="return validarFormularioCompleto(event)" action="../../controlador/ctl_entrenador.php">
                <input type="hidden" name="modificar" value="modificar">
                <input type="hidden" name="cedula" id="cedula_original" value="<?php echo $cedula; ?>">
                <input type="hidden" name="id_entrenador" value="<?php echo $id_entrenador; ?>">
                
                <h3 class="section-title"><i class="fas fa-user-graduate me-2"></i>Datos del Entrenador</h3>
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label required-star">Usuario *</label>
                        <select class="form-select" name="id_usuario" id="id_usuario" required>
                            <option value="">Seleccione un usuario</option>
                            <?php foreach($usuariosDisponibles as $usuario): ?>
                                <option value="<?php echo $usuario['idUsuario']; ?>" 
                                    <?php echo ($usuario['idUsuario'] == $id_usuario_actual) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($usuario['nombreUsuario']); ?> (<?php echo $usuario['rol']; ?> - <?php echo $usuario['estatus']; ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <div class="invalid-feedback-real" id="id_usuarioFeedback"></div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label required-star">Cédula *</label>
                        <input type="text" class="form-control" name="cedula_visible" id="cedula" value="<?php echo $cedula; ?>" readonly disabled>
                        <div class="invalid-feedback-real" id="cedulaFeedback"></div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label required-star">Nombre *</label>
                        <input type="text" class="form-control" name="nombre" id="nombre" value="<?php echo htmlspecialchars($nombre); ?>" autocomplete="off">
                        <div class="invalid-feedback-real" id="nombreFeedback"></div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label required-star">Apellido *</label>
                        <input type="text" class="form-control" name="apellido" id="apellido" value="<?php echo htmlspecialchars($apellido); ?>" autocomplete="off">
                        <div class="invalid-feedback-real" id="apellidoFeedback"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label class="form-label required-star">Teléfono *</label>
                        <input type="text" class="form-control" name="telefono" id="telefono" value="<?php echo $telefono; ?>" autocomplete="off" maxlength="12">
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
                                $selected = ($row['idEspecialidad'] == $id_especialidad) ? 'selected' : '';
                                echo '<option value="'.$row['idEspecialidad'].'" '.$selected.'>'.$row['nombre'].'</option>';
                            }
                            ?>
                        </select>
                        <div class="invalid-feedback-real" id="id_especialidadFeedback"></div>
                    </div>
                </div>

                <div class="form-actions">
                    <button type="reset" class="btn btn-danger" id="resetBtn"><i class="fas fa-eraser me-2"></i>Limpiar</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Actualizar Entrenador
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