document.addEventListener('DOMContentLoaded', function() {

    function showError(input, message) {
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');

        const feedback = document.getElementById(input.id + 'Feedback');
        if (feedback) feedback.textContent = message;
    }

    function showValid(input) {
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');

        const feedback = document.getElementById(input.id + 'Feedback');
        if (feedback) feedback.textContent = '✓ Campo válido';
    }

    function clearValidation(input) {
        input.classList.remove('is-valid');
        input.classList.remove('is-invalid');

        const feedback = document.getElementById(input.id + 'Feedback');
        if (feedback) feedback.textContent = '';
    }

    const regex = {
        letras: /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/,
        hora: /^(0?[1-9]|1[0-2]):[0-5][0-9]\s?(AM|PM)$/i
    };

    const fecha = document.getElementById('fecha');
    const hora = document.getElementById('hora');
    const observacion = document.getElementById('observacion');

    // =========================
    // FECHA (🔴 FIX IMPORTANTE)
    // =========================

    fecha.addEventListener('change', function () {

        if (this.value === '') {
            clearValidation(this);
            return;
        }

        const hoy = new Date().toISOString().split("T")[0];

        if (this.value > hoy) {
            showError(this, 'La fecha no puede ser futura');
        } else {
            showValid(this);
        }
    });

    // =========================
    // HORA
    // =========================

    hora.addEventListener('input', function () {

        this.value = this.value.toUpperCase();

        if (this.value.trim() === '') {
            clearValidation(this);
            return;
        }

        if (!regex.hora.test(this.value)) {
            showError(this, 'Formato: 08:00 AM');
        } else {
            showValid(this);
        }
    });

    // =========================
    // OBSERVACIÓN
    // =========================

    observacion.addEventListener('input', function () {

        if (this.value.trim() === '') {
            clearValidation(this);
            return;
        }

        if (this.value.length < 3) {
            showError(this, 'Muy corto');
        } else {
            showValid(this);
        }
    });

    // =========================
    // VALIDAR FORMULARIO
    // =========================

    window.validarAsistenciaAlumnos = function(event) {
        let valido = true;

        const hoy = new Date().toISOString().split("T")[0];

        // FECHA
        if (fecha.value === '' || fecha.value > hoy) {
            showError(fecha, 'Fecha inválida');
            valido = false;
        }

        // HORA
        if (!regex.hora.test(hora.value)) {
            showError(hora, 'Hora inválida');
            valido = false;
        }

        // OBSERVACIÓN
        if (observacion.value.trim() === '') {
            showError(observacion, 'Ingrese observación');
            valido = false;
        }

        if (!valido) {
            event.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Campos incompletos',
                text: 'Verifique la información'
            });
            return false;
        }

        event.preventDefault();
        const form = event.target;
        Swal.fire({
            icon: 'success',
            title: '¡Registro exitoso!',
            text: 'La asistencia de alumnos se registró correctamente.',
            confirmButtonText: 'Aceptar'
        }).then(() => {
            if (form) form.submit();
        });
        return false;
    };

    // RESET
    document.getElementById('resetBtn').addEventListener('click', function () {

        document.querySelectorAll('.form-control, .form-select')
            .forEach(i => i.classList.remove('is-valid', 'is-invalid'));

        document.querySelectorAll('.invalid-feedback-real')
            .forEach(d => d.textContent = '');
    });

});