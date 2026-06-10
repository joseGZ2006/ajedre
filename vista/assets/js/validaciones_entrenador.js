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

    // =========================
    // REGEX
    // =========================

    const regex = {
        cedula: /^\d{7,8}$/,
        letras: /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/,
        telefono: /^\d{4}-\d{7}$/  // Formato: 0412-1234567
    };

    function formatTelefono(value) {
        const digits = value.replace(/\D/g, '');
        if (digits.length === 0) return '';
        if (digits.length <= 4) return digits;
        return digits.slice(0, 4) + '-' + digits.slice(4, 11);
    }

    // =========================
    // INPUTS
    // =========================

    const id_usuario = document.getElementById('id_usuario');
    const cedula = document.getElementById('cedula');
    const nombre = document.getElementById('nombre');
    const apellido = document.getElementById('apellido');
    const telefono = document.getElementById('telefono');

    // =========================
    // VALIDACIÓN EN TIEMPO REAL
    // =========================

    if (id_usuario) {
        id_usuario.addEventListener('change', function () {
            if (this.value === '') {
                clearValidation(this);
            } else {
                showValid(this);
            }
        });
    }

    if (cedula) {
        cedula.addEventListener('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
            if (this.value === '') return clearValidation(this);
            regex.cedula.test(this.value)
                ? showValid(this)
                : showError(this, 'Debe contener 7 u 8 números');
        });
    }

    if (nombre) {
        nombre.addEventListener('input', function () {
            this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '');
            if (this.value === '') return clearValidation(this);
            regex.letras.test(this.value)
                ? showValid(this)
                : showError(this, 'Solo letras y espacios');
        });
    }

    if (apellido) {
        apellido.addEventListener('input', function () {
            this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '');
            if (this.value === '') return clearValidation(this);
            regex.letras.test(this.value)
                ? showValid(this)
                : showError(this, 'Solo letras y espacios');
        });
    }

    if (telefono) {
        telefono.addEventListener('input', function () {
            const cursorPos = this.selectionStart;
            const oldLength = this.value.length;
            const formatted = formatTelefono(this.value);
            this.value = formatted;
            
            if (this.value === '') return clearValidation(this);
            
            const newLength = this.value.length;
            const newCursorPos = cursorPos + (newLength - oldLength);
            if (newCursorPos >= 0 && newCursorPos <= this.value.length) {
                this.setSelectionRange(newCursorPos, newCursorPos);
            }

            if (regex.telefono.test(this.value)) {
                showValid(this);
            } else if (this.value.length > 0) {
                showError(this, 'Formato: 0412-1234567');
            } else {
                clearValidation(this);
            }
        });
    }

    // =========================
    // VERIFICAR CÉDULA DUPLICADA (AJAX)
    // =========================
    window.verificarCedulaDuplicada = async function(cedulaValue, cedulaOriginal = null) {
        try {
            let url = `../controlador/ctl_entrenador.php?verificar_cedula=true&cedula=${cedulaValue}`;
            if (cedulaOriginal) {
                url += `&excluir=${cedulaOriginal}`;
            }
            const response = await fetch(url);
            const data = await response.json();
            return data.existe;
        } catch (error) {
            console.error('Error al verificar cédula:', error);
            return false;
        }
    };

    // =========================
    // VALIDAR FORMULARIO COMPLETO
    // =========================
    window.validarFormularioCompleto = async function (event) {
        if (event) event.preventDefault();
        
        let valido = true;
        let primerError = null;

        // Obtener referencias actualizadas
        const id_usuarioInput = document.getElementById('id_usuario');
        const cedulaInput = document.getElementById('cedula');
        const nombreInput = document.getElementById('nombre');
        const apellidoInput = document.getElementById('apellido');
        const telefonoInput = document.getElementById('telefono');

        // Validar USUARIO
        if (!id_usuarioInput || id_usuarioInput.value === '') {
            if (id_usuarioInput) showError(id_usuarioInput, 'Debe seleccionar un usuario');
            valido = false;
            if (!primerError) primerError = id_usuarioInput;
        } else {
            showValid(id_usuarioInput);
        }

        // Validar CÉDULA
        if (!cedulaInput || cedulaInput.value.trim() === '') {
            if (cedulaInput) showError(cedulaInput, 'La cédula es obligatoria');
            valido = false;
            if (!primerError) primerError = cedulaInput;
        } else if (!regex.cedula.test(cedulaInput.value)) {
            showError(cedulaInput, 'Cédula inválida (7-8 dígitos)');
            valido = false;
            if (!primerError) primerError = cedulaInput;
        } else {
            const cedulaOriginal = document.getElementById('cedula_original')?.value || null;
            if (window.verificarCedulaDuplicada) {
                const existe = await window.verificarCedulaDuplicada(cedulaInput.value, cedulaOriginal);
                if (existe) {
                    showError(cedulaInput, 'Esta cédula ya está registrada');
                    valido = false;
                    if (!primerError) primerError = cedulaInput;
                } else {
                    showValid(cedulaInput);
                }
            }
        }

        // Validar NOMBRE
        if (!nombreInput || nombreInput.value.trim() === '') {
            if (nombreInput) showError(nombreInput, 'El nombre es obligatorio');
            valido = false;
            if (!primerError) primerError = nombreInput;
        } else if (!regex.letras.test(nombreInput.value)) {
            showError(nombreInput, 'Solo letras y espacios');
            valido = false;
            if (!primerError) primerError = nombreInput;
        } else {
            showValid(nombreInput);
        }

        // Validar APELLIDO
        if (!apellidoInput || apellidoInput.value.trim() === '') {
            if (apellidoInput) showError(apellidoInput, 'El apellido es obligatorio');
            valido = false;
            if (!primerError) primerError = apellidoInput;
        } else if (!regex.letras.test(apellidoInput.value)) {
            showError(apellidoInput, 'Solo letras y espacios');
            valido = false;
            if (!primerError) primerError = apellidoInput;
        } else {
            showValid(apellidoInput);
        }

        // Validar TELÉFONO
        if (!telefonoInput || telefonoInput.value.trim() === '') {
            if (telefonoInput) showError(telefonoInput, 'El teléfono es obligatorio');
            valido = false;
            if (!primerError) primerError = telefonoInput;
        } else if (!regex.telefono.test(telefonoInput.value)) {
            showError(telefonoInput, 'Formato: 0412-1234567');
            valido = false;
            if (!primerError) primerError = telefonoInput;
        } else {
            showValid(telefonoInput);
        }

        // SI HAY ERRORES
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

        // TODO VÁLIDO → ENVIAR FORMULARIO
        const form = event.target;
        
        if (form) {
            form.submit(); 
        } else {
            console.error('Formulario no encontrado para enviar');
        }       

        return false;
    };    

    // =========================
    // RESET DEL FORMULARIO
    // =========================
    const resetBtn = document.getElementById('resetBtn');
    if (resetBtn) {
        resetBtn.addEventListener('click', function (e) {
            const inputs = document.querySelectorAll('.form-control, .form-select');
            inputs.forEach(input => {
                input.classList.remove('is-valid', 'is-invalid');
                if (input.id === 'telefono') {
                    input.value = '';
                }
            });

            const feedbacks = document.querySelectorAll('.invalid-feedback-real, .valid-feedback-real');
            feedbacks.forEach(div => {
                div.textContent = '';
                div.classList.remove('invalid-feedback-real', 'valid-feedback-real');
            });
            
            // Resetear select de usuario
            const usuarioSelect = document.getElementById('id_usuario');
            if (usuarioSelect) {
                usuarioSelect.value = '';
                clearValidation(usuarioSelect);
            }
        });
    }
});