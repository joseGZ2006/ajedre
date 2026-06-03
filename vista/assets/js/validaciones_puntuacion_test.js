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

    const idAsignacionClase = document.getElementById('idAsignacionClase');
    const fecha = document.getElementById('fecha');
    const numeroRonda = document.getElementById('numeroRonda');
    const puntuacionRonda = document.getElementById('puntuacionRonda');
    const puntuacionFinal = document.getElementById('puntuacionFinal');

    // Validaciones en tiempo real
    if (idAsignacionClase) {
        idAsignacionClase.addEventListener('change', function () {
            if (this.value === '') {
                showError(this, 'Debe seleccionar una asignación de clase');
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

    if (numeroRonda) {
        numeroRonda.addEventListener('input', function () {
            if (this.value.trim() === '') {
                showError(this, 'El número de ronda es obligatorio');
            } else if (parseInt(this.value) <= 0) {
                showError(this, 'Debe ser mayor que 0');
            } else {
                showValid(this);
            }
        });
    }

    if (puntuacionRonda) {
        puntuacionRonda.addEventListener('input', function () {
            if (this.value.trim() === '') {
                showError(this, 'La puntuación de ronda es obligatoria');
            } else if (parseFloat(this.value) < 0) {
                showError(this, 'No puede ser negativa');
            } else {
                showValid(this);
            }
        });
    }

    if (puntuacionFinal) {
        puntuacionFinal.addEventListener('input', function () {
            if (this.value.trim() === '') {
                clearValidation(this);
            } else if (parseFloat(this.value) < 0) {
                showError(this, 'No puede ser negativa');
            } else {
                showValid(this);
            }
        });
    }

    window.validarPuntuacionTest = function (event) {
        let valido = true;

        if (idAsignacionClase && idAsignacionClase.value === '') {
            showError(idAsignacionClase, 'La asignación de clase es obligatoria');
            valido = false;
        }

        if (fecha && fecha.value === '') {
            showError(fecha, 'La fecha es obligatoria');
            valido = false;
        }

        if (numeroRonda && (numeroRonda.value.trim() === '' || parseInt(numeroRonda.value) <= 0)) {
            showError(numeroRonda, 'El número de ronda debe ser un entero positivo');
            valido = false;
        }

        if (puntuacionRonda && (puntuacionRonda.value.trim() === '' || parseFloat(puntuacionRonda.value) < 0)) {
            showError(puntuacionRonda, 'La puntuación de ronda debe ser mayor o igual a 0');
            valido = false;
        }

        if (puntuacionFinal && puntuacionFinal.value.trim() !== '' && parseFloat(puntuacionFinal.value) < 0) {
            showError(puntuacionFinal, 'La puntuación final no puede ser negativa');
            valido = false;
        }

        if (!valido) {
            event.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Campos incompletos o incorrectos',
                text: 'Por favor verifique los datos ingresados.'
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
