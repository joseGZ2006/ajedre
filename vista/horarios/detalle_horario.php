<?php
// Verificar sesión antes de mostrar el dashboard
include_once("../../controlador/verificar_sesion.php");
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
                    <h1 class="page-title"><i class="fas fa-calendar-alt me-2"></i> Información del Horario de Clase</h1>
                </div>
                <a href="./horario.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Volver al catálogo</a>
            </div>

            <div class="detail-avatar">
                <div class="avatar-large">
                    <i class="fas fa-calendar-week"></i>
                </div>
                <h2>Clase de Ajedrez - Nivel Principiantes</h2>
                <p class="text-muted"><span>ID Horario: 1 | Día: Lunes</span></p>
            </div>

            <div class="detail-info-grid">
                <!-- INFORMACIÓN DEL HORARIO -->
                <div class="info-group">
                    <label><i class="fas fa-clock me-2"></i>Información del Horario</label>
                    
                    <div class="info-row">
                        <span class="info-label">Día de la Semana:</span>
                        <span class="info-value" id="detalleDia">Lunes</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Hora de Inicio:</span>
                        <span class="info-value" id="detalleHoraInicio">09:00 AM</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Hora de Fin:</span>
                        <span class="info-value" id="detalleHoraFin">11:00 AM</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Duración:</span>
                        <span class="info-value">2 horas</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Nivel:</span>
                        <span class="info-value" id="detalleNivel">Principiantes</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Aula:</span>
                        <span class="info-value" id="detalleAula">Aula 101</span>
                    </div>
                </div>

                <!-- INFORMACIÓN DEL ENTRENADOR -->
                <div class="info-group">
                    <label><i class="fas fa-chalkboard-user me-2"></i>Información del Entrenador</label>
                    
                    <div class="info-row">
                        <span class="info-label">Nombre:</span>
                        <span class="info-value">Marcos Pérez</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Especialidad:</span>
                        <span class="info-value">Aperturas y Finales</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Título:</span>
                        <span class="info-value">Maestro Nacional (MN)</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Teléfono:</span>
                        <span class="info-value">0412-1234567</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Correo:</span>
                        <span class="info-value">marcos.perez@casaajedrez.com</span>
                    </div>
                </div>

                <!-- ESTADÍSTICAS Y ALUMNOS -->
                <div class="info-group">
                    <label><i class="fas fa-chart-line me-2"></i>Estadísticas de la Clase</label>
                    
                    <div class="info-row">
                        <span class="info-label">Alumnos Inscritos:</span>
                        <span class="info-value"><strong>12 alumnos</strong></span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Cupo Máximo:</span>
                        <span class="info-value">15 alumnos</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Cupos Disponibles:</span>
                        <span class="info-value" style="color: #28a745;">3 cupos</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Asistencia Promedio:</span>
                        <span class="info-value">85%</span>
                    </div>
                </div>

                <!-- ALUMNOS ASOCIADOS A ESTE HORARIO -->
                <div class="info-group">
                    <label><i class="fas fa-user-graduate me-2"></i>Alumnos en este Horario</label>
                    
                    <div class="info-row">
                        <span class="info-label">Alumno 1:</span>
                        <span class="info-value">Juan Pérez (Cédula: 12345678)</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Alumno 2:</span>
                        <span class="info-value">Ana Pérez (Cédula: 87654321)</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Alumno 3:</span>
                        <span class="info-value">Carlos Rodríguez (Cédula: 11223344)</span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Total alumnos:</span>
                        <span class="info-value"><strong>12 alumnos inscritos</strong></span>
                    </div>
                    
                    <div class="info-row">
                        <span class="info-label">Próxima clase:</span>
                        <span class="info-value" style="color: #007bff;">Lunes 15/05/2024 - 09:00 AM</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebar.js"></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>
    
 
</body>
</html>