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

        <!-- MAIN CONTENT - DASHBOARD -->
        <div class="main-content">
            <!-- Cabecera con título y fecha -->
            <div class="dashboard-header">
                <div>
                    <h1 class="page-title"><i class="fas fa-chart-line me-2"></i> Panel de Control</h1>
                    <p class="text-muted mt-1">Bienvenido de nuevo, aquí tienes un resumen general de la academia.</p>
                </div>
                <div class="date-badge">
                    <i class="fas fa-calendar-alt"></i>
                    <span id="currentDate"></span>
                </div>
            </div>

            <!-- Tarjetas de estadísticas (KPI Cards) -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-user-graduate"></i></div>
                    <div class="stat-info">
                        <h3>156</h3>
                        <p>Total Alumnos</p>
                        <span class="stat-trend positive"><i class="fas fa-arrow-up"></i> +12%</span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-chalkboard-user"></i></div>
                    <div class="stat-info">
                        <h3>8</h3>
                        <p>Entrenadores</p>
                        <span class="stat-trend positive"><i class="fas fa-arrow-up"></i> +2 nuevo</span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-chess-board"></i></div>
                    <div class="stat-info">
                        <h3>24</h3>
                        <p>Clases Activas</p>
                        <span class="stat-trend neutral"><i class="fas fa-minus"></i> Esta semana</span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-trophy"></i></div>
                    <div class="stat-info">
                        <h3>5</h3>
                        <p>Torneos 2025</p>
                        <span class="stat-trend positive"><i class="fas fa-calendar"></i> Próximo: Mar 15</span>
                    </div>
                </div>
            </div>

            <!-- Sección de gráficos -->
            <div class="charts-row">
                <div class="chart-box">
                    <div class="chart-header">
                        <h3><i class="fas fa-chart-pie"></i> Alumnos por Categoría</h3>
                        <span class="badge-actual">Actualizado hoy</span>
                    </div>
                    <canvas id="categoryChart" width="400" height="300" style="max-height: 300px; width: 100%;"></canvas>
                </div>
                <div class="chart-box">
                    <div class="chart-header">
                        <h3><i class="fas fa-chart-line"></i> Progreso de Clases (Enero - Marzo)</h3>
                        <span class="badge-actual">Asistencia promedio</span>
                    </div>
                    <canvas id="progressChart" width="400" height="300" style="max-height: 300px; width: 100%;"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sidebar.js"></script>
    <script src="../assets/js/dashboard.js"></script>
</body>
</html>