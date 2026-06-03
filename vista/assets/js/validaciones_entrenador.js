document.addEventListener('DOMContentLoaded', function () {

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
        cedula: /^\d{7,8}$/,
        letras: /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/,
        telefono: /^[0-9]{4}-[0-9]{7}$/
    };

    function formatTelefono(value) {
        const digits = value.replace(/\D/g, '');
        if (digits.length <= 4) return digits;
        return digits.slice(0, 4) + '-' + digits.slice(4, 11);
    }

    // =========================
    // INPUTS
    // =========================

    const cedula = document.getElementById('cedula');
    const nombre = document.getElementById('nombre');
    const apellido = document.getElementById('apellido');
    const telefono = document.getElementById('telefono');

    // =========================
    // VALIDACIÓN EN TIEMPO REAL
    // =========================

    cedula.addEventListener('input', function () {
        this.value = this.value.replace(/[^0-9]/g, '');

        if (this.value === '') return clearValidation(this);

        regex.cedula.test(this.value)
            ? showValid(this)
            : showError(this, 'Debe contener 7 u 8 números');
    });

    nombre.addEventListener('input', function () {
        this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '');

        if (this.value === '') return clearValidation(this);

        regex.letras.test(this.value)
            ? showValid(this)
            : showError(this, 'Solo letras y espacios');
    });

    apellido.addEventListener('input', function () {
        this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '');

        if (this.value === '') return clearValidation(this);

        regex.letras.test(this.value)
            ? showValid(this)
            : showError(this, 'Solo letras y espacios');
    });

    telefono.addEventListener('input', function () {
        this.value = formatTelefono(this.value);

        if (this.value === '') return clearValidation(this);

        regex.telefono.test(this.value)
            ? showValid(this)
            : showError(this, 'Formato: 0412-1234567');
    });

    // =========================
    // VALIDAR FORMULARIO (FIX DEFINITIVO)
    // =========================

    window.validarFormularioCompleto = function (event) {
        let valido = true;

        // 🔴 CÉDULA (OBLIGATORIA)
        if (cedula.value.trim() === '') {
            showError(cedula, 'La cédula es obligatoria');
            valido = false;
        } else if (!regex.cedula.test(cedula.value)) {
            showError(cedula, 'Cédula inválida');
            valido = false;
        }

        // 🔴 NOMBRE
        if (nombre.value.trim() === '') {
            showError(nombre, 'El nombre es obligatorio');
            valido = false;
        } else if (!regex.letras.test(nombre.value)) {
            showError(nombre, 'Nombre inválido');
            valido = false;
        }

        // 🔴 APELLIDO
        if (apellido.value.trim() === '') {
            showError(apellido, 'El apellido es obligatorio');
            valido = false;
        } else if (!regex.letras.test(apellido.value)) {
            showError(apellido, 'Apellido inválido');
            valido = false;
        }

        // 🔴 TELÉFONO
        if (telefono.value.trim() === '') {
            showError(telefono, 'El teléfono es obligatorio');
            valido = false;
        } else if (!regex.telefono.test(telefono.value)) {
            showError(telefono, 'Formato: 0412-1234567');
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
                text: 'Debe completar todos los campos obligatorios'
            });
            return false;
        }

        event.preventDefault();
        const form = event.target;
        Swal.fire({
            icon: 'success',
            title: '¡Registro exitoso!',
            text: 'El entrenador ha sido registrado correctamente.',
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

    if (resetBtn) {
        resetBtn.addEventListener('click', function () {

            document.querySelectorAll('.form-control').forEach(input => {
                input.classList.remove('is-valid', 'is-invalid');
            });

            document.querySelectorAll('.invalid-feedback-real').forEach(div => {
                div.textContent = '';
            });
        });
    }

});