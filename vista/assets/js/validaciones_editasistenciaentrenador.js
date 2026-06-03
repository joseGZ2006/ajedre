document.addEventListener('DOMContentLoaded', function () {

    // =========================
    // HELPERS
    // =========================

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
            feedback.classList.remove('invalid-feedback-real');
            feedback.classList.remove('valid-feedback-real');
        }
    }

    // =========================
    // REGEX
    // =========================

    const regexHora = /^(0?[1-9]|1[0-2]):[0-5][0-9]\s?(AM|PM)$/i;

    // =========================
    // INPUTS
    // =========================

    const fecha = document.getElementById('fecha');
    const hora = document.getElementById('hora');
    const alumnos = document.getElementById('alumnosEntrenados');

    // =========================
    // FECHA
    // =========================

    fecha.addEventListener('change', function () {

        if (!this.value) {
            clearValidation(this);
            return;
        }

        const hoy = new Date().toISOString().split("T")[0];

        if (this.value > hoy) {
            showError(this, 'No puede ser fecha futura');
        } else {
            showValid(this);
        }
    });

    // =========================
    // HORA
    // =========================

    hora.addEventListener('input', function () {

        this.value = this.value.toUpperCase();

        if (!this.value) {
            clearValidation(this);
            return;
        }

        if (!regexHora.test(this.value)) {
            showError(this, 'Formato inválido (08:00 AM)');
        } else {
            showValid(this);
        }
    });

    // =========================
    // ALUMNOS (0+ PRO)
    // =========================

    alumnos.addEventListener('input', function () {

        this.value = this.value.replace(/[^0-9]/g, '');

        if (this.value === '') {
            clearValidation(this);
            return;
        }

        let valor = parseInt(this.value);

        if (valor < 0) {
            this.value = 0;
            showError(this, 'No negativos');
            return;
        }

        if (valor > 200) {
            showError(this, 'Máximo 200 alumnos');
        } else {
            showValid(this);
        }
    });

    // =========================
    // VALIDAR FORMULARIO
    // =========================

    window.validarEditarAsistenciaEntrenador = function (event) {
        let valido = true;

        if (!fecha.value) {
            showError(fecha, 'Seleccione fecha');
            valido = false;
        }

        if (!regexHora.test(hora.value)) {
            showError(hora, 'Hora inválida');
            valido = false;
        }

        let valor = parseInt(alumnos.value);

        if (!alumnos.value || isNaN(valor) || valor < 0) {
            showError(alumnos, 'Cantidad inválida');
            valido = false;
        }

        if (!valido) {
            event.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Campos incompletos',
                text: 'Revisa los datos'
            });
            return false;
        }

        event.preventDefault();
        const form = event.target;
        Swal.fire({
            icon: 'success',
            title: '¡Registro exitoso!',
            text: 'La asistencia del entrenador se ha actualizado correctamente.',
            confirmButtonText: 'Aceptar'
        }).then(() => {
            if (form) form.submit();
        });
        return false;
    };

    // =========================
    // RESET
    // =========================

    document.getElementById('resetBtn')
        .addEventListener('click', function () {

            document.querySelectorAll('.form-control')
                .forEach(i => i.classList.remove('is-valid', 'is-invalid'));

            document.querySelectorAll('.invalid-feedback-real')
                .forEach(i => i.textContent = '');
        });

});