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
    const regexTexto = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;

    // =========================
    // INPUTS
    // =========================

    const fecha = document.getElementById('fecha');
    const hora = document.getElementById('hora');
    const observacion = document.getElementById('observacion');

    // =========================
    // VALIDAR FECHA (NO FUTUROS)
    // =========================

    fecha.addEventListener('change', function () {

        if (!this.value) {
            clearValidation(this);
            return;
        }

        const hoy = new Date();
        hoy.setHours(0, 0, 0, 0);

        const fechaInput = new Date(this.value);
        fechaInput.setHours(0, 0, 0, 0);

        if (fechaInput > hoy) {
            showError(this, 'La fecha no puede ser futura');
        } else {
            showValid(this);
        }
    });

    // =========================
    // VALIDAR HORA
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
    // VALIDAR OBSERVACIÓN
    // =========================

    observacion.addEventListener('input', function () {

        if (!this.value.trim()) {
            clearValidation(this);
            return;
        }

        if (!regexTexto.test(this.value)) {
            showError(this, 'Solo letras y espacios');
        } else {
            showValid(this);
        }
    });

    // =========================
    // VALIDAR FORMULARIO
    // =========================

    window.validarEditarAsistenciaAlumnos = function (event) {
        let valido = true;

        // FECHA
        if (!fecha.value) {
            showError(fecha, 'Seleccione una fecha');
            valido = false;
        } else {
            const hoy = new Date();
            hoy.setHours(0, 0, 0, 0);

            const fechaInput = new Date(fecha.value);
            fechaInput.setHours(0, 0, 0, 0);

            if (fechaInput > hoy) {
                showError(fecha, 'No puede ser fecha futura');
                valido = false;
            }
        }

        // HORA
        if (!regexHora.test(hora.value)) {
            showError(hora, 'Hora inválida (08:00 AM)');
            valido = false;
        }

        // OBSERVACIÓN
        if (!observacion.value.trim()) {
            showError(observacion, 'Ingrese una observación');
            valido = false;
        } else if (!regexTexto.test(observacion.value)) {
            showError(observacion, 'Solo letras y espacios');
            valido = false;
        }

        // ERROR GENERAL
        if (!valido) {
            event.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Campos incompletos',
                text: 'Revisa los datos del formulario'
            });
            return false;
        }

        event.preventDefault();
        const form = event.target;
        Swal.fire({
            icon: 'success',
            title: '¡Registro exitoso!',
            text: 'La asistencia del alumno se ha actualizado correctamente.',
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