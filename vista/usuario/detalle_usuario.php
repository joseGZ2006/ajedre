<?php
session_start();
include("../../modelo/conexion.php");
include("../../modelo/clase_usuario.php");

// Verificar si se recibieron los parámetros
if(!isset($_GET['id']) || !isset($_GET['nom']) || !isset($_GET['rol']) || !isset($_GET['est'])) {
    $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'Parámetros incompletos para mostrar el detalle del usuario.'];
    header("Location: ./usuario.php");
    exit;
}

// Decodificar parámetros
$idUsuario = base64_decode($_GET['id']);
$nombreUsuario = base64_decode($_GET['nom']);
$rol = base64_decode($_GET['rol']);
$estatus = base64_decode($_GET['est']);

// Obtener información completa del usuario
$usuarioObj = new Usuario();
$usuarioCompleto = $usuarioObj->obtenerUsuarioCompleto($idUsuario);

// Obtener el badge del rol
function getRolBadge($rol) {
    switch($rol) {
        case 'admin':
            return '<span class="badge bg-danger">Administrador</span>';
        case 'entrenador':
            return '<span class="badge bg-info">Entrenador</span>';
        case 'alumno':
            return '<span class="badge bg-success">Alumno</span>';
        default:
            return '<span class="badge bg-secondary">' . htmlspecialchars($rol) . '</span>';
    }
}

// Obtener el badge del estatus
function getEstatusBadge($estatus) {
    switch($estatus) {
        case 'activo':
            return '<span class="badge bg-success">Activo</span>';
        case 'inactivo':
            return '<span class="badge bg-danger">Inactivo</span>';
        default:
            return '<span class="badge bg-secondary">' . htmlspecialchars($estatus) . '</span>';
    }
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
        <div class="detail-header">
            <div class="catalog-header">
                <h1 class="page-title">
                    <i class="fas fa-info-circle me-2"></i> Detalle de Usuario
                </h1>
            </div>
            <a href="./usuario.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Volver al catálogo
            </a>
        </div>

        <!-- AVATAR / ICONO -->
        <div class="detail-avatar">
            <div class="avatar-large">
                <i class="fas fa-user-cog"></i>
            </div>
            <h2 id="detalleNombreUsuario"><?php echo htmlspecialchars($nombreUsuario); ?></h2>
            <p class="text-muted">ID Usuario: <?php echo htmlspecialchars($idUsuario); ?></p>
        </div>

        <!-- INFO DEL USUARIO -->
        <div class="detail-info-grid">
            <div class="info-group">
                <label>
                    <i class="fas fa-id-card me-2"></i>
                    Información de Usuario
                </label>
                <div class="info-row">
                    <span class="info-label">Nombre de Usuario:</span>
                    <span class="info-value"><?php echo htmlspecialchars($nombreUsuario); ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Rol:</span>
                    <span class="info-value"><?php echo getRolBadge($rol); ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Estatus:</span>
                    <span class="info-value"><?php echo getEstatusBadge($estatus); ?></span>
                </div>
            </div>
        </div>

        <!-- INFORMACIÓN DE A QUIÉN PERTENECE -->
        <div class="detail-info-grid">
            <div class="info-group">
                <label>
                    <i class="fas fa-users me-2"></i>
                    Asociación
                </label>
            
            <?php if($usuarioCompleto && $usuarioCompleto['tipo_asociacion']): ?>
                <?php if($usuarioCompleto['tipo_asociacion'] == 'entrenador'): ?>
                   
                   
                    <div class="info-row">
                        <span class="info-label">Cédula:</span>
                        <span class="info-value"><?php echo htmlspecialchars($usuarioCompleto['pertenece_a']['cedula']); ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Nombre Completo:</span>
                        <span class="info-value"><?php echo htmlspecialchars($usuarioCompleto['pertenece_a']['nombre'] . ' ' . $usuarioCompleto['pertenece_a']['apellido']); ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Teléfono:</span>
                        <span class="info-value"><?php echo htmlspecialchars($usuarioCompleto['pertenece_a']['telefono'] ?: 'No registrado'); ?></span>
                    </div>
                    <?php if($usuarioCompleto['pertenece_a']['especialidad']): ?>
                    <div class="info-row">
                        <span class="info-label">Especialidad:</span>
                        <span class="info-value"><?php echo htmlspecialchars($usuarioCompleto['pertenece_a']['especialidad']); ?></span>
                    </div>
                    <?php endif; ?>
                    
                <?php elseif($usuarioCompleto['tipo_asociacion'] == 'alumno'): ?>
                    <div class="assigned-badge student">
                        <i class="fas fa-user-graduate me-1"></i> Alumno
                    </div>
                    <div class="info-row">
                        <span class="info-label">ID Alumno:</span>
                        <span class="info-value"><?php echo htmlspecialchars($usuarioCompleto['pertenece_a']['id']); ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Cédula:</span>
                        <span class="info-value"><?php echo htmlspecialchars($usuarioCompleto['pertenece_a']['cedula']); ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Nombre Completo:</span>
                        <span class="info-value"><?php echo htmlspecialchars($usuarioCompleto['pertenece_a']['nombre'] . ' ' . $usuarioCompleto['pertenece_a']['apellido']); ?></span>
                    </div>
                    <div class="info-row">
                        <span class="info-label">Teléfono:</span>
                        <span class="info-value"><?php echo htmlspecialchars($usuarioCompleto['pertenece_a']['telefono'] ?: 'No registrado'); ?></span>
                    </div>
                    
                    <div class="info-subgroup">
                        <label><i class="fas fa-graduation-cap me-1"></i> Datos Académicos</label>
                        <?php if($usuarioCompleto['pertenece_a']['categoria']): ?>
                        <div class="info-row">
                            <span class="info-label">Categoría:</span>
                            <span class="info-value"><?php echo htmlspecialchars($usuarioCompleto['pertenece_a']['categoria']); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if($usuarioCompleto['pertenece_a']['fechaNacimiento']): ?>
                        <div class="info-row">
                            <span class="info-label">Fecha Nacimiento:</span>
                            <span class="info-value"><?php echo htmlspecialchars($usuarioCompleto['pertenece_a']['fechaNacimiento']); ?></span>
                        </div>
                        <?php endif; ?>
                        <?php if($usuarioCompleto['pertenece_a']['edad']): ?>
                        <div class="info-row">
                            <span class="info-label">Edad:</span>
                            <span class="info-value"><?php echo htmlspecialchars($usuarioCompleto['pertenece_a']['edad']); ?> años</span>
                        </div>
                        <?php endif; ?>
                        <?php if($usuarioCompleto['pertenece_a']['correo']): ?>
                        <div class="info-row">
                            <span class="info-label">Correo:</span>
                            <span class="info-value"><?php echo htmlspecialchars($usuarioCompleto['pertenece_a']['correo']); ?></span>
                        </div>
                        <?php endif; ?>
                        <div class="info-row">
                            <span class="info-label">Estatus Alumno:</span>
                            <span class="info-value">
                                <span class="badge <?php echo $usuarioCompleto['pertenece_a']['estatus_alumno'] == 'activo' ? 'bg-success' : 'bg-warning'; ?>">
                                    <?php echo ucfirst(htmlspecialchars($usuarioCompleto['pertenece_a']['estatus_alumno'])); ?>
                                </span>
                            </span>
                        </div>
                    </div>
                    
                    <?php if($usuarioCompleto['pertenece_a']['representante']): ?>
                    <div class="info-subgroup">
                        <label><i class="fas fa-user-friends me-1"></i> Datos del Representante</label>
                        <div class="info-row">
                            <span class="info-label">Nombre:</span>
                            <span class="info-value"><?php echo htmlspecialchars($usuarioCompleto['pertenece_a']['representante']); ?></span>
                        </div>
                        <?php if($usuarioCompleto['pertenece_a']['telefono_representante']): ?>
                        <div class="info-row">
                            <span class="info-label">Teléfono:</span>
                            <span class="info-value"><?php echo htmlspecialchars($usuarioCompleto['pertenece_a']['telefono_representante']); ?></span>
                        </div>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                <?php endif; ?>
            <?php else: ?>
                <div class="assigned-badge unassigned">
                    <i class="fas fa-user-slash me-1"></i> No asociado
                </div>
                <p class="text-muted mt-2 mb-0">
                    <i class="fas fa-info-circle me-1"></i>
                    Este usuario no está asociado a ningún entrenador o alumno.
                    <?php if($rol == 'entrenador'): ?>
                        <br>Para asociarlo, vaya al módulo de <a href="../entrenadores/entrenador.php">Entrenadores</a> y asígnelo al momento de registrar o editar un entrenador.
                    <?php elseif($rol == 'alumno'): ?>
                        <br>Para asociarlo, vaya al módulo de <a href="../alumnos/alumno.php">Alumnos</a> y asígnelo al momento de registrar o editar un alumno.
                    <?php endif; ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/sidebar.js"></script>
</body>
</html>