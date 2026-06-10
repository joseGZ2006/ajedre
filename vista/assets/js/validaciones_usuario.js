document.addEventListener('DOMContentLoaded', function() {
    // Funciones auxiliares
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
            feedback.textContent = '';
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

    // Regex para validaciones
    const regex = {
        nombreUsuario: /^[a-zA-Z0-9_.-]{3,50}$/,
        contrasena: /^.{6,}$/
    };

    // Obtener elementos
    const nombreUsuario = document.getElementById('nombreUsuario');
    const contrasena = document.getElementById('contrasena');
    const rol = document.getElementById('rol');
    const estatus = document.getElementById('estatus');
    const resetBtn = document.getElementById('resetBtn');

    // Validación en tiempo real
    if (nombreUsuario) {
        nombreUsuario.addEventListener('input', function() {
            if (this.value === '') {
                clearValidation(this);
            } else if (regex.nombreUsuario.test(this.value)) {
                showValid(this);
            } else {
                showError(this, 'El nombre de usuario debe tener entre 3 y 50 caracteres y solo puede contener letras, números, puntos, guiones o guión bajo');
            }
        });
    }

    if (contrasena) {
        contrasena.addEventListener('input', function() {
            if (this.value === '') {
                clearValidation(this);
            } else if (regex.contrasena.test(this.value)) {
                showValid(this);
            } else {
                showError(this, 'La contraseña debe tener al menos 6 caracteres');
            }
        });
    }

    if (rol) {
        rol.addEventListener('change', function() {
            if (this.value === '') {
                clearValidation(this);
            } else {
                showValid(this);
            }
        });
    }

    if (estatus) {
        estatus.addEventListener('change', function() {
            if (this.value === '') {
                clearValidation(this);
            } else {
                showValid(this);
            }
        });
    }

    // Función global para validar el formulario
    window.validarUsuario = function(event, esEdicion) {
        if (event) event.preventDefault();
        
        let valido = true;
        let primerError = null;

        // Validar nombre de usuario
        const nombreUsuarioInput = document.getElementById('nombreUsuario');
        if (!nombreUsuarioInput || nombreUsuarioInput.value.trim() === '') {
            if (nombreUsuarioInput) showError(nombreUsuarioInput, 'El nombre de usuario es requerido');
            valido = false;
            if (!primerError) primerError = nombreUsuarioInput;
        } else if (!regex.nombreUsuario.test(nombreUsuarioInput.value)) {
            showError(nombreUsuarioInput, 'El nombre de usuario debe tener entre 3 y 50 caracteres y solo puede contener letras, números, puntos, guiones o guión bajo');
            valido = false;
            if (!primerError) primerError = nombreUsuarioInput;
        } else {
            showValid(nombreUsuarioInput);
        }

        // Validar contraseña (solo obligatorio en registro)
        const contrasenaInput = document.getElementById('contrasena');
        if (!esEdicion) {
            if (!contrasenaInput || contrasenaInput.value.trim() === '') {
                if (contrasenaInput) showError(contrasenaInput, 'La contraseña es requerida');
                valido = false;
                if (!primerError) primerError = contrasenaInput;
            } else if (!regex.contrasena.test(contrasenaInput.value)) {
                showError(contrasenaInput, 'La contraseña debe tener al menos 6 caracteres');
                valido = false;
                if (!primerError) primerError = contrasenaInput;
            } else {
                showValid(contrasenaInput);
            }
        } else {
            // En edición, la contraseña es opcional
            if (contrasenaInput && contrasenaInput.value !== '' && !regex.contrasena.test(contrasenaInput.value)) {
                showError(contrasenaInput, 'La contraseña debe tener al menos 6 caracteres');
                valido = false;
                if (!primerError) primerError = contrasenaInput;
            } else if (contrasenaInput && contrasenaInput.value !== '') {
                showValid(contrasenaInput);
            } else if (contrasenaInput) {
                clearValidation(contrasenaInput);
            }
        }

        // Validar rol
        const rolInput = document.getElementById('rol');
        if (!rolInput || rolInput.value === '') {
            if (rolInput) showError(rolInput, 'Debe seleccionar un rol');
            valido = false;
            if (!primerError) primerError = rolInput;
        } else {
            showValid(rolInput);
        }

        // Validar estatus
        const estatusInput = document.getElementById('estatus');
        if (!estatusInput || estatusInput.value === '') {
            if (estatusInput) showError(estatusInput, 'Debe seleccionar un estatus');
            valido = false;
            if (!primerError) primerError = estatusInput;
        } else {
            showValid(estatusInput);
        }

        // Si hay errores
        if (!valido) {
            if (primerError) {
                primerError.focus();
                primerError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
            
            Swal.fire({
                icon: 'error',
                title: 'Campos inválidos',
                text: 'Por favor, corrija los errores marcados en el formulario',
                confirmButtonColor: '#3085d6'
            });
            return false;
        }

        // Enviar formulario
        const form = event.target;
        if (form && form.tagName === 'FORM') {
            form.submit();
        } else if (form && form.form) {
            form.form.submit();
        } else {
            console.error('Formulario no encontrado para enviar');
        }
        
        return false;
    };

    // Reset del formulario
    if (resetBtn) {
        resetBtn.addEventListener('click', function(e) {
            const inputs = document.querySelectorAll('.form-control, .form-select');
            inputs.forEach(input => {
                input.classList.remove('is-valid', 'is-invalid');
                if (input.id === 'contrasena' && input.type === 'password') {
                    input.value = '';
                }
            });

            const feedbacks = document.querySelectorAll('.invalid-feedback-real, .valid-feedback-real');
            feedbacks.forEach(div => {
                div.textContent = '';
                div.classList.remove('invalid-feedback-real', 'valid-feedback-real');
            });
        });
    }
});