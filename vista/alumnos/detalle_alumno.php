<?php
session_start();
// Verificar sesión antes de mostrar el dashboard
include_once("../../controlador/verificar_sesion.php");

// Obtener datos desde los parámetros GET
$idAlumno = isset($_GET['id']) ? base64_decode($_GET['id']) : '';
$cedula = isset($_GET['ced']) ? base64_decode($_GET['ced']) : '';
$nombre = isset($_GET['nom']) ? base64_decode($_GET['nom']) : '';
$apellido = isset($_GET['ape']) ? base64_decode($_GET['ape']) : '';
$sexo = isset($_GET['sex']) ? base64_decode($_GET['sex']) : '';
$fechaNacimiento = isset($_GET['fna']) ? base64_decode($_GET['fna']) : '';
$edad = isset($_GET['edad']) ? base64_decode($_GET['edad']) : '';
$categoria = isset($_GET['cat']) ? base64_decode($_GET['cat']) : '';
$telefono = isset($_GET['tel']) ? base64_decode($_GET['tel']) : '';
$localidad = isset($_GET['loc']) ? base64_decode($_GET['loc']) : '';
$correo = isset($_GET['ema']) ? base64_decode($_GET['ema']) : '';
$club = isset($_GET['club']) ? base64_decode($_GET['club']) : '';
$direccion = isset($_GET['dir']) ? base64_decode($_GET['dir']) : '';
$dondeEstudia = isset($_GET['est']) ? base64_decode($_GET['est']) : '';
$grado = isset($_GET['gra']) ? base64_decode($_GET['gra']) : '';
$seccion = isset($_GET['sec']) ? base64_decode($_GET['sec']) : '';
$deporte = isset($_GET['dep']) ? base64_decode($_GET['dep']) : '';
$centroIniciacion = isset($_GET['cen']) ? base64_decode($_GET['cen']) : '';
$idRepresentante = isset($_GET['rep']) ? base64_decode($_GET['rep']) : '';
$repNombre = isset($_GET['repNom']) ? base64_decode($_GET['repNom']) : '';
$repApellido = isset($_GET['repApe']) ? base64_decode($_GET['repApe']) : '';
$repTelefono = isset($_GET['repTel']) ? base64_decode($_GET['repTel']) : '';
$repParentesco = isset($_GET['repPar']) ? base64_decode($_GET['repPar']) : '';
$estatus = isset($_GET['status']) ? base64_decode($_GET['status']) : '';
$estudia = isset($_GET['estudia']) ? base64_decode($_GET['estudia']) : '';
$practicaDeporte = isset($_GET['practicaDeporte']) ? base64_decode($_GET['practicaDeporte']) : '';

// Determinar si es menor de edad
$esMenor = ($edad < 18);
$sexoTexto = ($sexo == 'M') ? 'Masculino' : 'Femenino';
$estatusBadge = '';
if($estatus == 'activo') $estatusBadge = '<span class="badge bg-success">Activo</span>';
elseif($estatus == 'inactivo') $estatusBadge = '<span class="badge bg-secondary">Inactivo</span>';
else $estatusBadge = '<span class="badge bg-warning">Suspendido</span>';
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

    <!-- MAIN CONTENT - DETALLE -->
    <div class="main-content">
        <div class="detail-header">
            <h1 class="page-title"><i class="fas fa-chess-queen me-2"></i> Detalle del Alumno</h1>
            <a href="./alumno.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Volver al catálogo</a>
        </div>

        <div class="detail-avatar">
            <div class="avatar-large">
                <i class="fas fa-chess-queen"></i>
            </div>
            <h2><?php echo htmlspecialchars($nombre . ' ' . $apellido); ?></h2>
            <p class="text-muted">
                <span>Cédula: <?php echo htmlspecialchars($cedula); ?></span> | 
                <span>ID: <?php echo $idAlumno; ?></span> |
                <?php echo $estatusBadge; ?>
            </p>
        </div>

        <div class="detail-info-grid">
            <!-- INFORMACIÓN PERSONAL -->
            <div class="info-group">
                <label><i class="fas fa-user me-2"></i>Información Personal</label>
                
                <div class="info-row">
                    <span class="info-label">Nombre:</span>
                    <span class="info-value"><?php echo htmlspecialchars($nombre); ?></span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Apellido:</span>
                    <span class="info-value"><?php echo htmlspecialchars($apellido); ?></span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Cédula:</span>
                    <span class="info-value"><?php echo htmlspecialchars($cedula); ?></span>
                </div>

                <div class="info-row">
                    <span class="info-label">Fecha de Nacimiento:</span>
                    <span class="info-value"><?php echo date('d/m/Y', strtotime($fechaNacimiento)); ?></span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Edad:</span>
                    <span class="info-value"><?php echo $edad; ?> años</span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Sexo:</span>
                    <span class="info-value"><?php echo $sexoTexto; ?></span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Teléfono:</span>
                    <span class="info-value"><?php echo !empty($telefono) ? htmlspecialchars($telefono) : 'No registrado'; ?></span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Correo Electrónico:</span>
                    <span class="info-value"><?php echo !empty($correo) ? htmlspecialchars($correo) : 'No registrado'; ?></span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Dirección:</span>
                    <span class="info-value"><?php echo htmlspecialchars($direccion); ?></span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Localidad (Municipio):</span>
                    <span class="info-value"><?php echo htmlspecialchars($localidad); ?></span>
                </div>
            </div>

            <!-- INFORMACIÓN ACADÉMICA -->
            <div class="info-group">
                <label><i class="fas fa-graduation-cap me-2"></i>Información Académica</label>
                
                <div class="info-row">
                    <span class="info-label">¿Estudia?:</span>
                    <span class="info-value"><?php echo $estudia; ?></span>
                </div>
                
                <?php if($estudia == 'Si'): ?>
                <div class="info-row">
                    <span class="info-label">Institución:</span>
                    <span class="info-value"><?php echo !empty($dondeEstudia) ? htmlspecialchars($dondeEstudia) : 'No registrado'; ?></span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Grado:</span>
                    <span class="info-value"><?php echo !empty($grado) ? htmlspecialchars($grado) : 'No registrado'; ?></span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Sección:</span>
                    <span class="info-value"><?php echo !empty($seccion) ? htmlspecialchars($seccion) : 'No registrado'; ?></span>
                </div>
                <?php else: ?>
                <div class="info-row">
                    <span class="info-label">No estudia actualmente</span>
                    <span class="info-value">-</span>
                </div>
                <?php endif; ?>
            </div>

            <!-- INFORMACIÓN DEPORTIVA -->
            <div class="info-group">
                <label><i class="fas fa-chess-board me-2"></i>Información Deportiva</label>
                
                <div class="info-row">
                    <span class="info-label">¿Practica deporte?:</span>
                    <span class="info-value"><?php echo $practicaDeporte; ?></span>
                </div>
                
                <?php if($practicaDeporte == 'Si'): ?>
                <div class="info-row">
                    <span class="info-label">Deporte:</span>
                    <span class="info-value"><?php echo !empty($deporte) ? htmlspecialchars($deporte) : 'No registrado'; ?></span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Centro Iniciación Deportiva:</span>
                    <span class="info-value"><?php echo !empty($centroIniciacion) ? htmlspecialchars($centroIniciacion) : 'No registrado'; ?></span>
                </div>
                <?php else: ?>
                <div class="info-row">
                    <span class="info-label">No practica deportes</span>
                    <span class="info-value">-</span>
                </div>
                <?php endif; ?>
                
                <div class="info-row">
                    <span class="info-label">Categoría:</span>
                    <span class="info-value"><?php echo htmlspecialchars($categoria); ?></span>
                </div>
                
                <div class="info-row">
                    <span class="info-label">Club:</span>
                    <span class="info-value"><?php echo !empty($club) ? htmlspecialchars($club) : 'No registrado'; ?></span>
                </div>
            </div>
        </div>

        <!-- SECCIÓN DE REPRESENTANTE (solo para menores de edad) -->
        <?php if($esMenor && !empty($repNombre)): ?>
        <div class="info-group" style="margin-top: 20px;">
            <label><i class="fas fa-user-friends me-2"></i>Información del Representante</label>
            <div class="detail-info-grid">
                <div class="info-group" style="background: #e8f4f8;">
                    <div class="info-row">
                        <span class="info-label">Nombre Completo:</span>
                        <span class="info-value"><?php echo htmlspecialchars($repNombre . ' ' . $repApellido); ?></span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Teléfono:</span>
                        <span class="info-value"><?php echo !empty($repTelefono) ? htmlspecialchars($repTelefono) : 'No registrado'; ?></span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Parentesco:</span>
                        <span class="info-value"><?php echo !empty($repParentesco) ? htmlspecialchars($repParentesco) : 'No especificado'; ?></span>
                    </div>
                </div>
            </div>
        </div>
        <?php elseif($esMenor && empty($repNombre)): ?>
        <div class="alert alert-warning mt-3">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Advertencia:</strong> Este alumno es menor de edad pero no tiene un representante asignado.
        </div>
        <?php endif; ?>
    </div>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebar.js"></script>
  
</body>
</html>