<?php
session_start();
include("../../controlador/verificar_sesion.php");
include("../../modelo/clase_representante.php");

$ced = isset($_GET['ced']) ? base64_decode($_GET['ced']) : null;

if(!$ced){
    $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se especificó el representante a consultar'];
    header("Location: ./representante.php");
    exit;
}

$rep = new Representante();
$datos = $rep->ConsultarRepresentante($ced);

if(!$datos) {
    $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'Representante no encontrado'];
    header("Location: ./representante.php");
    exit;
}

$id_representante = $datos[0];
$cedula = $datos[1];
$nombre = $datos[2];
$apellido = $datos[3];
$correo = $datos[4];
$telefono = $datos[5];
$parentesco = $datos[6];

// Formatear cédula para mostrar
$cedula_formateada = number_format($cedula, 0, '', '.');
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
                <div class="catalog-header">
                    <h1 class="page-title"><i class="fas fa-user-friends me-2"></i> Información del Representante</h1>
                </div>
                <a href="./representante.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Volver al catálogo</a>
            </div>

            <div class="detail-avatar">
                <div class="avatar-large">
                    <i class="fas fa-user-friends"></i>
                </div>
                <h2><?php echo htmlspecialchars($nombre . ' ' . $apellido); ?></h2>
                <p class="text-muted"><span>ID: <?php echo $id_representante; ?> | Cédula: <?php echo $cedula_formateada; ?></span></p>
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
                        <span class="info-value"><?php echo $cedula_formateada; ?></span>
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
                        <span class="info-label">Parentesco:</span>
                        <span class="info-value"><?php echo htmlspecialchars($parentesco); ?></span>
                    </div>
                </div>

                <!-- ALUMNOS ASOCIADOS -->
                <div class="info-group">
                    <label><i class="fas fa-user-graduate me-2"></i>Alumnos Asociados</label>
                    
                    <?php
                    // Consultar alumnos asociados a este representante
                    include("../../modelo/conexion.php");
                    $sql_alumnos = $conex->prepare("SELECT nombre, apellido, cedula FROM ALUMNO WHERE representante_id = ?");
                    $sql_alumnos->execute([$id_representante]);
                    $alumnos = $sql_alumnos->fetchAll(PDO::FETCH_ASSOC);
                    
                    if(count($alumnos) > 0){
                        foreach($alumnos as $index => $alumno){
                            echo '<div class="info-row">';
                            echo '<span class="info-label">Alumno ' . ($index + 1) . ':</span>';
                            echo '<span class="info-value">' . htmlspecialchars($alumno['nombre'] . ' ' . $alumno['apellido']) . ' (Cédula: ' . number_format($alumno['cedula'], 0, '', '.') . ')</span>';
                            echo '</div>';
                        }
                        echo '<div class="info-row">';
                        echo '<span class="info-label">Total alumnos:</span>';
                        echo '<span class="info-value"><strong>' . count($alumnos) . ' alumno(s)</strong></span>';
                        echo '</div>';
                    } else {
                        echo '<div class="info-row">';
                        echo '<span class="info-value text-muted">No hay alumnos asociados a este representante</span>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php include '../assets/inc/flash.php'; ?>
    
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebar.js"></script>
</body>
</html>