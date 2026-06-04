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
            <div class="catalog-header">
                <h1 class="page-title"><i class="fas fa-plus-circle me-2"></i> Registrar Nueva Clasificación Final</h1>
                <a href="./clasificacion_final.html" class="btn btn-secondary"><i
                        class="fas fa-arrow-left me-2"></i>Volver al catálogo</a>
            </div>

            <div class="form-card">
                <form role="form" name="form" method="POST" onsubmit="return validarFormularioCompleto(event)"
                    action="./clasificacion_final.html">
                    <h3 class="section-title"><i class="fas fa-ranking-star me-2"></i>Datos de la Clasificación</h3>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label required-star">Torneo</label>
                            <select class="form-select" name="idTorneo" id="idTorneo">
                                <option value="">Seleccionar torneo</option>
                                <option value="1">Torneo Nacional de Ajedrez 2025</option>
                                <option value="2">Campeonato Regional Centro</option>
                                <option value="3">Copa Ciudad de Caracas</option>
                                <option value="4">Torneo Internacional Rápido</option>
                            </select>
                            <div class="invalid-feedback-real" id="idTorneoFeedback"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label required-star">Alumno</label>
                            <select class="form-select" name="idAlumno" id="idAlumno">
                                <option value="">Seleccionar alumno</option>
                                <option value="1">Carlos Pérez (C.I: 12345678)</option>
                                <option value="2">Ana Rodríguez (C.I: 23456789)</option>
                                <option value="3">Luis Fernández (C.I: 34567890)</option>
                                <option value="4">María González (C.I: 45678901)</option>
                                <option value="5">José Martínez (C.I: 56789012)</option>
                                <option value="6">Valentina Rojas (C.I: 67890123)</option>
                            </select>
                            <div class="invalid-feedback-real" id="idAlumnoFeedback"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Posición</label>
                            <input type="number" class="form-control" name="posicion" id="posicion"
                                placeholder="Ej: 1, 2, 3...">
                            <div class="invalid-feedback-real" id="posicionFeedback"></div>
                            <small class="text-muted">Ingrese el número de posición (1, 2, 3, etc.)</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Municipio</label>
                            <input type="text" class="form-control" name="municipio" id="municipio"
                                placeholder="Ej: Libertador, Chacao, Baruta...">
                            <div class="invalid-feedback-real" id="municipioFeedback"></div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label required-star">Estatus Original</label>
                            <select class="form-select" name="estatusOriginal" id="estatusOriginal">
                                <option value="">Seleccionar estatus</option>
                                <option value="Clasificado">Clasificado</option>
                                <option value="Suplente">Suplente</option>
                                <option value="Eliminado">Eliminado</option>
                                <option value="Descalificado">Descalificado</option>
                            </select>
                            <div class="invalid-feedback-real" id="estatusOriginalFeedback"></div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="reset" class="btn btn-danger" id="resetBtn"><i
                                class="fas fa-eraser me-2"></i>Limpiar</button>
                        <button type="submit" value="Registrar" class="btn btn-primary"><i
                                class="fas fa-save me-2"></i>Registrar Clasificación</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery-3.6.0.min.js"></script>
    <script src="../assets/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/sweetalert2.all.min.js"></script>
    <script src="../assets/js/sidebar.js"></script>
    <script>
        function validarFormularioCompleto(event) {
            event.preventDefault();

            let esValido = true;

            // Validar Torneo
            const idTorneo = document.getElementById('idTorneo');
            if (!idTorneo.value) {
                document.getElementById('idTorneoFeedback').innerText = 'Debe seleccionar un torneo';
                idTorneo.classList.add('is-invalid');
                esValido = false;
            } else {
                document.getElementById('idTorneoFeedback').innerText = '';
                idTorneo.classList.remove('is-invalid');
            }

            // Validar Alumno
            const idAlumno = document.getElementById('idAlumno');
            if (!idAlumno.value) {
                document.getElementById('idAlumnoFeedback').innerText = 'Debe seleccionar un alumno';
                idAlumno.classList.add('is-invalid');
                esValido = false;
            } else {
                document.getElementById('idAlumnoFeedback').innerText = '';
                idAlumno.classList.remove('is-invalid');
            }

            // Validar Posición
            const posicion = document.getElementById('posicion');
            if (!posicion.value) {
                document.getElementById('posicionFeedback').innerText = 'La posición es obligatoria';
                posicion.classList.add('is-invalid');
                esValido = false;
            } else if (posicion.value < 1) {
                document.getElementById('posicionFeedback').innerText = 'La posición debe ser mayor a 0';
                posicion.classList.add('is-invalid');
                esValido = false;
            } else {
                document.getElementById('posicionFeedback').innerText = '';
                posicion.classList.remove('is-invalid');
            }

            // Validar Estatus Original
            const estatusOriginal = document.getElementById('estatusOriginal');
            if (!estatusOriginal.value) {
                document.getElementById('estatusOriginalFeedback').innerText = 'Debe seleccionar un estatus';
                estatusOriginal.classList.add('is-invalid');
                esValido = false;
            } else {
                document.getElementById('estatusOriginalFeedback').innerText = '';
                estatusOriginal.classList.remove('is-invalid');
            }

            if (esValido) {
                const torneoText = idTorneo.options[idTorneo.selectedIndex]?.text || '';
                const alumnoText = idAlumno.options[idAlumno.selectedIndex]?.text || '';
                const posicionNum = posicion.value;

                let medalla = '';
                if (posicionNum == 1) medalla = '🥇 ';
                else if (posicionNum == 2) medalla = '🥈 ';
                else if (posicionNum == 3) medalla = '🥉 ';

                Swal.fire({
                    title: '¡Registrado!',
                    text: `${medalla}Clasificación: ${alumnoText} ha quedado en ${posicionNum}° lugar en ${torneoText}`,
                    icon: 'success',
                    confirmButtonColor: '#3085d6'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = './clasificacion_final.html';
                    }
                });
            }

            return false;
        }

        // Limpiar validaciones al reset
        document.getElementById('resetBtn')?.addEventListener('click', function () {
            setTimeout(() => {
                const inputs = document.querySelectorAll('.is-invalid');
                inputs.forEach(input => input.classList.remove('is-invalid'));
                const feedbacks = document.querySelectorAll('.invalid-feedback-real');
                feedbacks.forEach(fb => fb.innerText = '');
            }, 10);
        });
    </script>
</body>

</html>