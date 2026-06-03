document.addEventListener('DOMContentLoaded', function() {

    // =========================
    // FUNCIONES AUXILIARES
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
        input.classList.remove('is-valid');
        input.classList.remove('is-invalid');
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

    const regex = {
        letras: /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/
    };

    // =========================
    // INPUTS
    // =========================

    const diaSemana = document.getElementById('diaSemana');
    const nombre = document.getElementById('nombre');
    const aula = document.getElementById('aula');
    const horaInicio = document.getElementById('horaInicio');
    const horaFin = document.getElementById('horaFin');
    const localidad = document.getElementById('localidad');

    // =========================
    // CONVERTIR HORA A 24H
    // =========================

    function convertirHora(valor) {

        valor = valor.trim().toUpperCase();

        let match12 = valor.match(/^(\d{1,2})(?::\d{2})?\s?(AM|PM)$/);

        if (match12) {

            let hora = parseInt(match12[1]);
            let periodo = match12[2];

            if (periodo === "PM" && hora !== 12) hora += 12;
            if (periodo === "AM" && hora === 12) hora = 0;

            return hora;
        }

        let match24 = valor.match(/^(\d{1,2})(?::\d{2})?$/);

        if (match24) {
            return parseInt(match24[1]);
        }

        return null;
    }

    // =========================
    // VALIDAR HORA INICIO
    // =========================

    function validarHoraInicio(valor) {

        let hora = convertirHora(valor);

        if (hora === null) return false;

        // 8-10 AM o 2-3 PM
        return (
            (hora >= 8 && hora <= 10) ||
            (hora >= 14 && hora <= 15)
        );
    }

    // =========================
    // VALIDAR HORA FIN
    // =========================

    function validarHoraFin(valor) {

        let hora = convertirHora(valor);

        if (hora === null) return false;

        // 11-12 AM o 4-5 PM
        return (
            (hora >= 11 && hora <= 12) ||
            (hora >= 16 && hora <= 17)
        );
    }

    // =========================
    // TIEMPO REAL
    // =========================

    diaSemana.addEventListener('change', function() {

        if (this.value === '') {
            clearValidation(this);
        } else {
            showValid(this);
        }
    });

    nombre.addEventListener('input', function() {

        this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '');

        if (this.value.trim() === '') {
            clearValidation(this);
            return;
        }

        if (!regex.letras.test(this.value)) {
            showError(this, 'Solo letras y espacios');
        } else {
            showValid(this);
        }
    });

    horaInicio.addEventListener('input', function() {

        if (this.value.trim() === '') {
            clearValidation(this);
            return;
        }

        if (!validarHoraInicio(this.value)) {
            showError(this, 'Hora inválida (8-10 AM o 2-3 PM)');
        } else {
            showValid(this);
        }
    });

    horaFin.addEventListener('input', function() {

        if (this.value.trim() === '') {
            clearValidation(this);
            return;
        }

        if (!validarHoraFin(this.value)) {
            showError(this, 'Hora inválida (11-12 AM o 4-5 PM)');
        } else {
            showValid(this);
        }
    });

    aula.addEventListener('input', function() {
        this.value = this.value.trimStart();

        if (this.value.trim() === '') {
            clearValidation(this);
            return;
        }

        if (!regex.letras.test(this.value) || this.value.trim().length < 2) {
            showError(this, 'Aula inválida');
        } else {
            showValid(this);
        }
    });

    localidad.addEventListener('input', function() {
        this.value = this.value.trimStart();

        if (this.value.trim() === '') {
            clearValidation(this);
            return;
        }

        if (!regex.letras.test(this.value) || this.value.trim().length < 2) {
            showError(this, 'Localidad inválida');
        } else {
            showValid(this);
        }
    });

    // =========================
    // VALIDAR FORMULARIO
    // =========================

    window.validarEditarClase = function(event) {

        let valido = true;

        // =========================
        // DIA SEMANA
        // =========================

        if (diaSemana.value === '') {
            showError(diaSemana, 'Seleccione un día de la semana');
            valido = false;
        }

        // =========================
        // NOMBRE
        // =========================

        if (!regex.letras.test(nombre.value)) {
            showError(nombre, 'Nombre inválido');
            valido = false;
        }

        // =========================
        // HORA INICIO
        // =========================

        if (!validarHoraInicio(horaInicio.value)) {
            showError(horaInicio, 'Hora inválida (8-10 AM o 2-3 PM)');
            valido = false;
        }

        // =========================
        // HORA FIN
        // =========================

        if (!validarHoraFin(horaFin.value)) {
            showError(horaFin, 'Hora inválida (11-12 AM o 4-5 PM)');
            valido = false;
        }

        if (aula.value.trim() === '') {
            showError(aula, 'Ingrese el aula');
            valido = false;
        } else if (!regex.letras.test(aula.value) || aula.value.trim().length < 2) {
            showError(aula, 'Aula inválida');
            valido = false;
        }

        if (localidad.value.trim() === '') {
            showError(localidad, 'Ingrese la localidad');
            valido = false;
        } else if (!regex.letras.test(localidad.value) || localidad.value.trim().length < 2) {
            showError(localidad, 'Localidad inválida');
            valido = false;
        }

        // =========================
        // BLOQUEO FINAL
        // =========================

        if (!valido) {
            event.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Campos incompletos',
                text: 'Verifique los datos de la clase'
            });
            return false;
        }

        event.preventDefault();
        const form = event.target;
        Swal.fire({
            icon: 'success',
            title: '¡Registro exitoso!',
            text: 'Los datos de la clase se han actualizado correctamente.',
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
        .addEventListener('click', function() {

            document.querySelectorAll('.form-control, .form-select')
                .forEach(input => {
                    input.classList.remove('is-valid', 'is-invalid');
                });

            document.querySelectorAll('.invalid-feedback-real')
                .forEach(div => {
                    div.textContent = '';
                });

        });

});