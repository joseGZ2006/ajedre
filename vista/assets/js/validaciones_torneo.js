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
    // EXPRESIONES REGULARES
    // =========================

    const regex = {

        nombre: /^[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\s\-]+$/,

        lugar: /^[A-Za-zÁÉÍÓÚáéíóúÑñ0-9\s,.\-#]+$/
    };

    // =========================
    // INPUTS
    // =========================

    const nombre =
        document.getElementById('nombre');

    const estado =
        document.getElementById('estado');

    const clasificacion =
        document.getElementById('clasificacion');

    const fecha =
        document.getElementById('fecha');

    const lugar =
        document.getElementById('lugar');

    const categoria =
        document.getElementById('categoria');

    const cupos =
        document.getElementById('cupos');

    // =========================
    // LÍMITES DE FECHA
    // =========================

    fecha.min = "2020-01-01";
    fecha.max = "2035-12-31";

    // =========================
    // VALIDAR NOMBRE DEL TORNEO
    // =========================

    nombre.addEventListener('input', function() {

        this.value =
            this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ0-9\s\-]/g, '');

        if (this.value.length === 0) {
            clearValidation(this);
            return;
        }

        if (this.value.length < 4) {

            showError(this,
                'Debe tener mínimo 4 caracteres');

        } else if (!regex.nombre.test(this.value)) {

            showError(this,
                'Nombre inválido');

        } else {

            showValid(this);
        }

    });

    // =========================
    // VALIDAR LUGAR
    // =========================

    lugar.addEventListener('input', function() {

        this.value =
            this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ0-9\s,.\-#]/g, '');

        if (this.value.length === 0) {
            clearValidation(this);
            return;
        }

        if (this.value.length < 3) {

            showError(this,
                'Ingrese un lugar válido');

        } else if (!regex.lugar.test(this.value)) {

            showError(this,
                'Lugar inválido');

        } else {

            showValid(this);
        }

    });

    // =========================
    // VALIDAR FECHA
    // =========================

    fecha.addEventListener('change', function() {

        if (this.value === '') {

            clearValidation(this);
            return;
        }

        const fechaSeleccionada =
            new Date(this.value);

        const hoy =
            new Date();

        hoy.setHours(0, 0, 0, 0);

        if (fechaSeleccionada < hoy) {

            showError(this,
                'La fecha no puede ser anterior a hoy');

        } else {

            showValid(this);
        }

    });

    // =========================
    // VALIDAR ESTADO
    // =========================

    estado.addEventListener('change', function() {

        if (this.value === '') {

            clearValidation(this);

        } else {

            showValid(this);
        }

    });

    // =========================
    // VALIDAR CLASIFICACIÓN
    // =========================

    clasificacion.addEventListener('change', function() {

        if (this.value === '') {

            clearValidation(this);

        } else {

            showValid(this);
        }

    });

    // =========================
    // VALIDAR CATEGORÍA
    // =========================

    categoria.addEventListener('change', function() {

        if (this.value === '') {

            clearValidation(this);

        } else {

            showValid(this);
        }

    });

    // =========================
    // VALIDAR CUPOS
    // =========================

    cupos.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');

        if (this.value.length === 0) {
            clearValidation(this);
            return;
        }

        if (!/^[1-9][0-9]*$/.test(this.value)) {
            showError(this, 'Ingrese un número válido');
        } else {
            showValid(this);
        }
    });

    // =========================
    // VALIDAR FORMULARIO
    // =========================

    window.validarFormularioCompleto = function(event) {
        let valido = true;

        // =========================
        // NOMBRE
        // =========================
        if (nombre.value.trim() === '') {
            showError(nombre, 'Ingrese el nombre del torneo');
            valido = false;
        } else if (nombre.value.length < 4) {
            showError(nombre, 'Debe tener mínimo 4 caracteres');
            valido = false;
        }

        // =========================
        // ESTADO
        // =========================
        if (estado.value === '') {
            showError(estado, 'Seleccione un estatus');
            valido = false;
        }

        // =========================
        // CLASIFICACIÓN
        // =========================
        if (clasificacion.value === '') {
            showError(clasificacion, 'Seleccione una clasificación');
            valido = false;
        }

        // =========================
        // FECHA
        // =========================
        if (fecha.value === '') {
            showError(fecha, 'Seleccione una fecha');
            valido = false;
        } else {
            const fechaSeleccionada = new Date(fecha.value);
            const hoy = new Date();
            hoy.setHours(0, 0, 0, 0);
            if (fechaSeleccionada < hoy) {
                showError(fecha, 'La fecha no puede ser anterior a hoy');
                valido = false;
            }
        }

        // =========================
        // LUGAR
        // =========================
        if (lugar.value.trim() === '') {
            showError(lugar, 'Ingrese el lugar del torneo');
            valido = false;
        } else if (lugar.value.length < 3) {
            showError(lugar, 'Lugar inválido');
            valido = false;
        }

        // =========================
        // CATEGORÍA
        // =========================
        if (categoria.value === '') {
            showError(categoria, 'Seleccione una categoría');
            valido = false;
        }

        // =========================
        // CUPOS
        // =========================
        if (cupos.value.trim() === '') {
            showError(cupos, 'Ingrese la cantidad de cupos');
            valido = false;
        } else if (!/^[1-9][0-9]*$/.test(cupos.value.trim())) {
            showError(cupos, 'Cupos inválidos');
            valido = false;
        }

        // =========================
        // RESULTADO FINAL
        // =========================
        if (!valido) {
            event.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Campos incompletos',
                text: 'Verifique todos los campos obligatorios'
            });
            return false;
        }

        event.preventDefault();
        const form = event.target;
        Swal.fire({
            icon: 'success',
            title: '¡Registro exitoso!',
            text: 'El torneo ha sido registrado correctamente.',
            confirmButtonText: 'Aceptar'
        }).then(() => {
            if (form) form.submit();
        });
        return false;
    };

    // =========================
    // RESET
    // =========================

    const resetBtn =
        document.getElementById('resetBtn');

    resetBtn.addEventListener('click', function() {

        document.querySelectorAll(
            '.form-control, .form-select'
        ).forEach(input => {

            input.classList.remove('is-valid');

            input.classList.remove('is-invalid');
        });

        document.querySelectorAll(
            '.invalid-feedback-real'
        ).forEach(div => {

            div.textContent = '';
        });
    });

});