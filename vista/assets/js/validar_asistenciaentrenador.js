document.addEventListener('DOMContentLoaded', function () {

    // =========================
    // FUNCIONES AUXILIARES
    // =========================

    function showError(input, message) {

        input.classList.add('is-invalid');
        input.classList.remove('is-valid');

        const feedback =
            document.getElementById(input.id + 'Feedback');

        if (feedback) {
            feedback.textContent = message;
        }
    }

    function showValid(input) {

        input.classList.remove('is-invalid');
        input.classList.add('is-valid');

        const feedback =
            document.getElementById(input.id + 'Feedback');

        if (feedback) {
            feedback.textContent = '✓ Campo válido';
        }
    }

    function clearValidation(input) {

        input.classList.remove('is-valid');
        input.classList.remove('is-invalid');

        const feedback =
            document.getElementById(input.id + 'Feedback');

        if (feedback) {
            feedback.textContent = '';
        }
    }

    // =========================
    // EXPRESIONES REGULARES
    // =========================

    const regex = {

        hora: /^(0?[1-9]|1[0-2]):[0-5][0-9]\s?(AM|PM)$/i,

        soloNumeros: /^[0-9]+$/
    };

    // =========================
    // INPUTS
    // =========================

    const fecha = document.getElementById('fecha');
    const hora = document.getElementById('hora');
    const alumnosEntrenados = document.getElementById('alumnosEntrenados');

    // =========================
    // VALIDAR FECHA
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
    // VALIDAR HORA (FORMATO PRO)
    // =========================

    hora.addEventListener('input', function () {

        this.value = this.value.toUpperCase();

        if (this.value.length === 0) {
            clearValidation(this);
            return;
        }

        if (!regex.hora.test(this.value)) {
            showError(this, 'Formato: 08:00 AM o 9:30 PM');
        } else {
            showValid(this);
        }
    });

    // =========================
    // VALIDAR ALUMNOS ENTRENADOS
    // =========================

    alumnosEntrenados.addEventListener('input', function () {

        this.value = this.value.replace(/[^0-9]/g, '');

        if (this.value.length === 0) {
            clearValidation(this);
            return;
        }

        const num = parseInt(this.value);

        if (!regex.soloNumeros.test(this.value) || num <= 0) {
            showError(this, 'Debe ser un número mayor a 0');
        } else if (num > 200) {
            showError(this, 'Cantidad demasiado alta');
        } else {
            showValid(this);
        }
    });

    // =========================
    // VALIDAR FORMULARIO COMPLETO
    // =========================

    window.validarAsistenciaEntrenador = function (event) {
        let valido = true;

        // FECHA
        if (fecha.value === '') {
            showError(fecha, 'Seleccione una fecha');
            valido = false;
        }

        // HORA
        if (!regex.hora.test(hora.value)) {
            showError(hora, 'Hora inválida');
            valido = false;
        }

        // ALUMNOS
        const num = parseInt(alumnosEntrenados.value);

        if (!regex.soloNumeros.test(alumnosEntrenados.value) || num <= 0) {
            showError(alumnosEntrenados, 'Cantidad inválida');
            valido = false;
        }

        if (!valido) {
            event.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Campos incompletos',
                text: 'Verifique todos los campos'
            });
            return false;
        }

        event.preventDefault();
        const form = event.target;
        Swal.fire({
            icon: 'success',
            title: '¡Registro exitoso!',
            text: 'La asistencia del entrenador se registró correctamente.',
            confirmButtonText: 'Aceptar'
        }).then(() => {
            if (form) form.submit();
        });
        return false;
    };

    // =========================
    // RESET
    // =========================

    const resetBtn = document.getElementById('resetBtn');

    resetBtn.addEventListener('click', function () {

        document.querySelectorAll('.form-control')
            .forEach(input => {
                input.classList.remove('is-valid');
                input.classList.remove('is-invalid');
            });

        document.querySelectorAll('.invalid-feedback-real')
            .forEach(div => {
                div.textContent = '';
            });
    });

});