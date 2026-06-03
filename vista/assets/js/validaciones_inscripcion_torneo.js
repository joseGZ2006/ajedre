document.addEventListener('DOMContentLoaded', function () {

    function showError(input, message) {
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');
        const feedback = document.getElementById(input.id + 'Feedback');
        if (feedback) {
            feedback.textContent = message;
            feedback.classList.remove('valid-feedback-real');
            feedback.classList.add('invalid-feedback-real');
        }
    }

    function showValid(input) {
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
        const feedback = document.getElementById(input.id + 'Feedback');
        if (feedback) {
            feedback.textContent = '✓ Campo válido';
            feedback.classList.remove('invalid-feedback-real');
            feedback.classList.add('valid-feedback-real');
        }
    }

    function clearValidation(input) {
        input.classList.remove('is-valid', 'is-invalid');
        const feedback = document.getElementById(input.id + 'Feedback');
        if (feedback) {
            feedback.textContent = '';
            feedback.classList.remove('invalid-feedback-real', 'valid-feedback-real');
        }
    }

    const idAlumno = document.getElementById('idAlumno');
    const idTorneo = document.getElementById('idTorneo');
    const fecha = document.getElementById('fecha');
    const estatus = document.getElementById('estatus');
    const pago = document.getElementById('pago');

    // Validaciones en tiempo real
    if (idAlumno) {
        idAlumno.addEventListener('change', function () {
            if (this.value === '') {
                showError(this, 'Debe seleccionar un alumno');
            } else {
                showValid(this);
            }
        });
    }

    if (idTorneo) {
        idTorneo.addEventListener('change', function () {
            if (this.value === '') {
                showError(this, 'Debe seleccionar un torneo');
            } else {
                showValid(this);
            }
        });
    }

    if (fecha) {
        fecha.addEventListener('change', function () {
            if (this.value === '') {
                showError(this, 'Debe seleccionar una fecha');
            } else {
                showValid(this);
            }
        });
    }

    if (estatus) {
        estatus.addEventListener('change', function () {
            if (this.value === '') {
                showError(this, 'Debe seleccionar un estatus');
            } else {
                showValid(this);
            }
        });
    }

    if (pago) {
        pago.addEventListener('change', function () {
            if (this.value === '') {
                showError(this, 'Debe seleccionar el estado de pago');
            } else {
                showValid(this);
            }
        });
    }

    window.validarInscripcionTorneo = function (event) {
        let valido = true;

        if (idAlumno && idAlumno.value === '') {
            showError(idAlumno, 'El alumno es obligatorio');
            valido = false;
        }

        if (idTorneo && idTorneo.value === '') {
            showError(idTorneo, 'El torneo es obligatorio');
            valido = false;
        }

        if (fecha && fecha.value === '') {
            showError(fecha, 'La fecha es obligatoria');
            valido = false;
        }

        if (estatus && estatus.value === '') {
            showError(estatus, 'El estatus es obligatorio');
            valido = false;
        }

        if (pago && pago.value === '') {
            showError(pago, 'El estado de pago es obligatorio');
            valido = false;
        }

        if (!valido) {
            event.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Campos incompletos',
                text: 'Por favor complete todos los campos obligatorios.'
            });
            return false;
        }

        return true;
    };

    const resetBtn = document.getElementById('resetBtn');
    if (resetBtn) {
        resetBtn.addEventListener('click', function () {
            document.querySelectorAll('.form-control, .form-select').forEach(input => {
                clearValidation(input);
            });
        });
    }
});
