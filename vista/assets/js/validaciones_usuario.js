document.addEventListener('DOMContentLoaded', function () {

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
            feedback.classList.remove('invalid-feedback-real', 'valid-feedback-real');
        }
    }

    const nombreUsuario = document.getElementById('nombreUsuario');
    const contrasena = document.getElementById('contrasena');
    const rol = document.getElementById('rol');
    const estatus = document.getElementById('estatus');

    // Regex para validar nombre de usuario: letras, números y guiones bajos (3 a 20 caracteres)
    const usernameRegex = /^[a-zA-Z0-9_]{3,20}$/;

    // Validaciones en tiempo real
    if (nombreUsuario) {
        nombreUsuario.addEventListener('input', function () {
            if (this.value.trim() === '') {
                showError(this, 'El nombre de usuario es obligatorio');
            } else if (!usernameRegex.test(this.value)) {
                showError(this, 'Debe tener entre 3 y 20 caracteres y solo contener letras, números o guiones bajos (_)');
            } else {
                showValid(this);
            }
        });
    }

    if (contrasena) {
        contrasena.addEventListener('input', function () {
            // Si está vacío y existe un atributo data-edit o parámetro que indique edición, es válido dejarlo en blanco
            const isEdit = document.querySelector('form').getAttribute('onsubmit').includes('true');
            if (this.value === '') {
                if (isEdit) {
                    clearValidation(this);
                } else {
                    showError(this, 'La contraseña es obligatoria');
                }
            } else if (this.value.length < 6) {
                showError(this, 'La contraseña debe tener al menos 6 caracteres');
            } else {
                showValid(this);
            }
        });
    }

    if (rol) {
        rol.addEventListener('change', function () {
            if (this.value === '') {
                showError(this, 'Debe seleccionar un rol');
            } else {
                showValid(this);
            }
        });
    }

    if (estatus) {
        estatus.addEventListener('change', function () {
            if (this.value === '') {
                showError(this, 'Debe seleccionar un estatus');
            } else {
                showValid(this);
            }
        });
    }

    window.validarUsuario = function (event, isEdit = false) {
        let valido = true;

        if (nombreUsuario) {
            if (nombreUsuario.value.trim() === '') {
                showError(nombreUsuario, 'El nombre de usuario es obligatorio');
                valido = false;
            } else if (!usernameRegex.test(nombreUsuario.value)) {
                showError(nombreUsuario, 'Usuario inválido (3-20 caracteres, letras, números y _)');
                valido = false;
            }
        }

        if (contrasena) {
            if (contrasena.value === '') {
                if (!isEdit) {
                    showError(contrasena, 'La contraseña es obligatoria');
                    valido = false;
                }
            } else if (contrasena.value.length < 6) {
                showError(contrasena, 'La contraseña debe tener al menos 6 caracteres');
                valido = false;
            }
        }

        if (rol && rol.value === '') {
            showError(rol, 'El rol es obligatorio');
            valido = false;
        }

        if (estatus && estatus.value === '') {
            showError(estatus, 'El estatus es obligatorio');
            valido = false;
        }

        if (!valido) {
            event.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Campos incorrectos o incompletos',
                text: 'Por favor complete correctamente todos los campos obligatorios.'
            });
            return false;
        }

        return true;
    };

    const resetBtn = document.getElementById('resetBtn');
    if (resetBtn) {
        resetBtn.addEventListener('click', function () {
            document.querySelectorAll('.form-control, .form-select').forEach(input => {
                clearValidation(input);
            });
        });
    }
});
