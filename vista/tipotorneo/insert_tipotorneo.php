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

    <!-- CONTENIDO -->
    <div class="main-content">

        <div class="catalog-header">
            <h1 class="page-title">
                <i class="fas fa-plus-circle me-2"></i> Registrar Tipo de Torneo
            </h1>

            <a href="./tipotorneo.php" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i> Volver
            </a>
        </div>

        <div class="form-card">

            <form onsubmit="return validarTipotorneo(event)">

                <h3 class="section-title">Datos del Tipo de Torneo</h3>

                <!-- NOMBRE -->
                <div class="mb-3">
                    <label class="form-label required-star">Nombre</label>
                    <input type="text"
                           class="form-control"
                           id="nombre"
                           placeholder="Ingrese el tipo de torneo">

                    <div class="invalid-feedback-real" id="nombreFeedback"></div>
                </div>

                <!-- BOTONES -->
                <div class="form-actions">

                    <button type="reset" class="btn btn-danger" id="resetBtn">
                        <i class="fas fa-eraser me-2"></i> Limpiar
                    </button>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i> Registrar
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/sweetalert2.all.min.js"></script>
<script src="../assets/js/validaciones_tipotorneo.js"></script>
<script src="../assets/js/sidebar.js"></script>

</body>
</html>