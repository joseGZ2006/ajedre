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
                <h1 class="page-title"><i class="fas fa-plus-circle me-2"></i> Registrar Nueva Asignación de Clase</h1>
                <a href="./asignacion_clase.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-2"></i>Volver
                    al catálogo</a>
            </div>

            <div class="form-card">
                <form role="form" name="form" method="POST" onsubmit="return validarFormularioCompleto(event)"
                    action="./asignacion_clase.php">
                    <h3 class="section-title"><i class="fas fa-user-plus me-2"></i>Datos de la Asignación</h3>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label required-star">Alumno</label>
                            <select class="form-select" name="idAlumno" id="idAlumno">
                                <option value="">Seleccionar alumno</option>
                                <option value="1">Carlos Pérez (C.I: 12345678)</option>
                                <option value="2">Ana Rodríguez (C.I: 23456789)</option>
                                <option value="3">Luis Fernández (C.I: 34567890)</option>
                                <option value="4">María González (C.I: 45678901)</option>
                                <option value="5">José Martínez (C.I: 56789012)</option>
                            </select>
                            <div class="invalid-feedback-real" id="idAlumnoFeedback"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label required-star">Entrenador</label>
                            <select class="form-select" name="idEntrenador" id="idEntrenador">
                                <option value="">Seleccionar entrenador</option>
                                <option value="1">Marcos Pérez (Especialidad: Ajedrez Básico)</option>
                                <option value="2">Laura Gómez (Especialidad: Táctica)</option>
                                <option value="3">Carlos Rojas (Especialidad: Finales)</option>
                            </select>
                            <div class="invalid-feedback-real" id="idEntrenadorFeedback"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label required-star">Horario de Clase</label>
                            <select class="form-select" name="idHorarioClase" id="idHorarioClase">
                                <option value="">Seleccionar horario</option>
                                <option value="1">Lunes - 09:00 AM a 11:00 AM</option>
                                <option value="2">Martes - 02:00 PM a 04:00 PM</option>
                                <option value="3">Miércoles - 10:00 AM a 12:00 PM</option>
                                <option value="4">Jueves - 03:00 PM a 05:00 PM</option>
                                <option value="5">Viernes - 08:00 AM a 10:00 AM</option>
                            </select>
                            <div class="invalid-feedback-real" id="idHorarioClaseFeedback"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label required-star">Fecha Inicio</label>
                            <input type="date" class="form-control" name="fechaInicio" id="fechaInicio">
                            <div class="invalid-feedback-real" id="fechaInicioFeedback"></div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Fecha Fin (opcional)</label>
                            <input type="date" class="form-control" name="fechaFin" id="fechaFin">
                            <div class="invalid-feedback-real" id="fechaFinFeedback"></div>
                            <small class="text-muted">Dejar vacío si es indefinido</small>
                        </div>
                    </div>

                    <div class="form-actions">
                        <button type="reset" class="btn btn-danger" id="resetBtn"><i
                                class="fas fa-eraser me-2"></i>Limpiar</button>
                        <button type="submit" value="Registrar" class="btn btn-primary"><i
                                class="fas fa-save me-2"></i>Registrar Asignación</button>
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

            // Validar Entrenador
            const idEntrenador = document.getElementById('idEntrenador');
            if (!idEntrenador.value) {
                document.getElementById('idEntrenadorFeedback').innerText = 'Debe seleccionar un entrenador';
                idEntrenador.classList.add('is-invalid');
                esValido = false;
            } else {
                document.getElementById('idEntrenadorFeedback').innerText = '';
                idEntrenador.classList.remove('is-invalid');
            }

            // Validar Horario
            const idHorarioClase = document.getElementById('idHorarioClase');
            if (!idHorarioClase.value) {
                document.getElementById('idHorarioClaseFeedback').innerText = 'Debe seleccionar un horario';
                idHorarioClase.classList.add('is-invalid');
                esValido = false;
            } else {
                document.getElementById('idHorarioClaseFeedback').innerText = '';
                idHorarioClase.classList.remove('is-invalid');
            }

            // Validar Fecha Inicio
            const fechaInicio = document.getElementById('fechaInicio');
            if (!fechaInicio.value) {
                document.getElementById('fechaInicioFeedback').innerText = 'La fecha de inicio es obligatoria';
                fechaInicio.classList.add('is-invalid');
                esValido = false;
            } else {
                document.getElementById('fechaInicioFeedback').innerText = '';
                fechaInicio.classList.remove('is-invalid');
            }

            if (esValido) {
                const alumnoText = idAlumno.options[idAlumno.selectedIndex]?.text || '';
                const entrenadorText = idEntrenador.options[idEntrenador.selectedIndex]?.text || '';

                Swal.fire({
                    title: '¡Registrado!',
                    text: `Asignación: ${alumnoText} con ${entrenadorText} ha sido registrada correctamente.`,
                    icon: 'success',
                    confirmButtonColor: '#3085d6'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = './asignacion_clase.php';
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