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

    const nombre = document.getElementById('nombre');
    
    // Verificar que el elemento existe antes de agregar el evento
    if (nombre) {
        // =========================
        // VALIDACIÓN EN TIEMPO REAL
        // =========================
        nombre.addEventListener('input', function () {
            // Permitir solo letras y espacios
            this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '');

            if (this.value.trim() === '') {
                clearValidation(this);
                return;
            }

            if (!regex.letras.test(this.value)) {
                showError(this, 'Solo letras y espacios');
            } else {
                // SOLO LIMPIAR LA VALIDACIÓN, SIN MOSTRAR VERDE
                this.classList.remove('is-invalid');
                this.classList.remove('is-valid');
                const feedback = document.getElementById(this.id + 'Feedback');
                if (feedback) {
                    feedback.textContent = '';
                    feedback.classList.remove('invalid-feedback-real');
                    feedback.classList.remove('valid-feedback-real');
                }
            }
        });
    }

    // =========================
    // VALIDAR FORMULARIO
    // =========================

    window.validarEspecialidad = function (event) {
        let valido = true;
        const nombreInput = document.getElementById('nombre');

        // 🔴 NOMBRE (OBLIGATORIO)
        if (nombreInput.value.trim() === '') {
            showError(nombreInput, 'El nombre es obligatorio');
            valido = false;
        } else if (!regex.letras.test(nombreInput.value)) {
            showError(nombreInput, 'Solo letras y espacios');
            valido = false;
        } else {
            // CAMPO VÁLIDO PERO SIN MOSTRAR VERDE
            nombreInput.classList.remove('is-invalid');
            const feedback = document.getElementById(nombreInput.id + 'Feedback');
            if (feedback) {
                feedback.textContent = '';
                feedback.classList.remove('invalid-feedback-real');
            }
        }

        // =========================
        // BLOQUEO FINAL
        // =========================
        if (!valido) {
            event.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Campo incompleto',
                text: 'Debe ingresar la especialidad correctamente'
            });
            return false;
        }

        return true;
    };

    // =========================
    // RESET
    // =========================

    const resetBtn = document.getElementById('resetBtn');

    if (resetBtn) {
        resetBtn.addEventListener('click', function () {
            const nombreInput = document.getElementById('nombre');
            if (nombreInput) {
                nombreInput.value = '';
                clearValidation(nombreInput);
                nombreInput.focus();
            }
        });
    }

});