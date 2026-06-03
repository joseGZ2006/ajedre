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
        letras: /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/
    };

    // =========================
    // INPUT
    // =========================

    const nombre =
        document.getElementById('nombre');

    // =========================
    // VALIDACIÓN EN TIEMPO REAL
    // =========================

    nombre.addEventListener('input', function () {

        this.value =
            this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '');

        if (this.value.trim() === '') {

            clearValidation(this);
            return;
        }

        if (!regex.letras.test(this.value)) {

            showError(this,
                'Solo letras y espacios');

        } else {

            showValid(this);
        }

    });

    // =========================
    // VALIDAR FORMULARIO
    // =========================

    window.validarTipotorneo = function (event) {
        let valido = true;

        // =========================
        // NOMBRE OBLIGATORIO
        // =========================
        if (nombre.value.trim() === '') {
            showError(nombre, 'El nombre es obligatorio');
            valido = false;
        } else if (!regex.letras.test(nombre.value)) {
            showError(nombre, 'Solo letras y espacios');
            valido = false;
        }

        // =========================
        // BLOQUEO FINAL
        // =========================
        if (!valido) {
            event.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Campo incompleto',
                text: 'Debe ingresar el tipo de torneo'
            });
            return false;
        }

        return true;
    };

    // =========================
    // RESET
    // =========================

    const resetBtn =
        document.getElementById('resetBtn');

    if (resetBtn) {

        resetBtn.addEventListener('click', function () {

            document.querySelectorAll('.form-control')
                .forEach(input => {

                    input.classList.remove(
                        'is-valid',
                        'is-invalid'
                    );
                });

            document.querySelectorAll('.invalid-feedback-real')
                .forEach(div => {

                    div.textContent = '';
                });

        });
    }

});