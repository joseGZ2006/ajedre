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

        <div class="main-content">
            <div class="detail-header">
                <div class="catalog-header">
                    <h1 class="page-title"><i class="fas fa-user-plus me-2"></i> Información de la Asignación</h1>
                </div>
                <a href="./asignacion_clase.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Volver
                    al catálogo</a>
            </div>

            <div class="detail-avatar">
                <div class="avatar-large">
                    <i class="fas fa-user-graduate"></i>
                </div>
                <h2>Asignación #101</h2>
                <p class="text-muted">Carlos Pérez con Marcos Pérez</p>
            </div>

            <div class="detail-info-grid">
                <div class="info-group">
                    <label><i class="fas fa-info-circle me-2"></i>Detalles de la Asignación</label>

                    <div class="info-row">
                        <span class="info-label">ID Asignación:</span>
                        <span class="info-value" id="detalleIdAsignacion">101</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Alumno:</span>
                        <span class="info-value" id="detalleAlumno">Carlos Pérez</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Cédula Alumno:</span>
                        <span class="info-value" id="detalleCedulaAlumno">12345678</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Entrenador:</span>
                        <span class="info-value" id="detalleEntrenador">Marcos Pérez</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Especialidad Entrenador:</span>
                        <span class="info-value" id="detalleEspecialidad">Ajedrez Básico</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Horario:</span>
                        <span class="info-value" id="detalleHorario">Lunes - 09:00 AM a 11:00 AM</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Día de Semana:</span>
                        <span class="info-value" id="detalleDia">Lunes</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Hora Inicio:</span>
                        <span class="info-value" id="detalleHoraInicio">09:00 AM</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Hora Fin:</span>
                        <span class="info-value" id="detalleHoraFin">11:00 AM</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Fecha Inicio:</span>
                        <span class="info-value" id="detalleFechaInicio">2025-01-15</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Fecha Fin:</span>
                        <span class="info-value" id="detalleFechaFin">2025-06-30</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Estado:</span>
                        <span class="info-value"><span class="badge bg-success">Activo</span></span>
                    </div>
                </div>

                <div class="info-group mt-4">
                    <label><i class="fas fa-chart-line me-2"></i>Estadísticas de Asistencia</label>

                    <div class="info-row">
                        <span class="info-label">Total Clases:</span>
                        <span class="info-value">24</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Asistencias:</span>
                        <span class="info-value">20</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Ausencias:</span>
                        <span class="info-value">3</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Llegadas Tarde:</span>
                        <span class="info-value">1</span>
                    </div>

                    <div class="info-row">
                        <span class="info-label">Porcentaje Asistencia:</span>
                        <span class="info-value">83.33%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebar.js"></script>

    <script>
        // Simular obtención de parámetro ID desde URL
        function getQueryParam(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        document.addEventListener('DOMContentLoaded', function () {
            const id = getQueryParam('id');
            if (id) {
                console.log('Cargando detalles de asignación ID:', id);
                // Aquí iría una llamada AJAX para obtener los datos reales
                // Por ahora se muestran datos estáticos
                document.getElementById('detalleIdAsignacion').innerText = id;
            }
        });
    </script>
</body>

</html>