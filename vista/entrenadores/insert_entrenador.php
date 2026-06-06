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
            <form role="form" name="form" method="POST" onsubmit="return validarFormularioCompleto(event)" action="../../controlador/ctl_entrenador.php">
                <input type="hidden" name="registrar" value="registrar">
                
                <h3 class="section-title"><i class="fas fa-user-graduate me-2"></i>Datos del Entrenador</h3>
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
                            include("../../modelo/conexion.php");
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
                    <button type="submit" value="Registrar" class="btn btn-primary"><i class="fas fa-save me-2"></i>Registrar Entrenador</button>
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