// validaciones_representante.js - Validaciones específicas para el formulario de registro de representantes
document.addEventListener('DOMContentLoaded', function() {
    
    // ==================== FUNCIONES AUXILIARES ====================
    function showError(input, message) {
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');
        const feedbackId = input.id + 'Feedback';
        const feedback = document.getElementById(feedbackId);
        if (feedback) {
            feedback.textContent = message;
            feedback.classList.remove('valid-feedback-real');
            feedback.classList.add('invalid-feedback-real');
        }
    }

    function showValid(input) {
        input.classList.add('is-valid');
        input.classList.remove('is-invalid');
        const feedbackId = input.id + 'Feedback';
        const feedback = document.getElementById(feedbackId);
        if (feedback) {
            feedback.textContent = '✓ Campo válido';
            feedback.classList.remove('invalid-feedback-real');
            feedback.classList.add('valid-feedback-real');
        }
    }

    function clearFeedback(input) {
        input.classList.remove('is-valid', 'is-invalid');
        const feedbackId = input.id + 'Feedback';
        const feedback = document.getElementById(feedbackId);
        if (feedback) {
            feedback.textContent = '';
            feedback.classList.remove('valid-feedback-real');
            feedback.classList.remove('invalid-feedback-real');
        }
    }

    // ==================== EXPRESIONES REGULARES ====================
    const regex = {
        cedula: /^\d{7,8}$/, 
        soloLetras: /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/,
        correo: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
        telefono: /^(0412|0414|0416|0424|0410|0426)-?\d{7}$/  // Acepta con o sin guión
    };

    function formatTelefono(value) {
        // Limpiar cualquier caracter que no sea número
        const digits = value.replace(/\D/g, '');
        
        // Si tiene exactamente 11 dígitos (formato Venezuela: 0412xxxxxxx)
        if (digits.length === 11) {
            // Formatear como 0412-1234567 (4 dígitos + guión + 7 dígitos)
            const prefix = digits.slice(0, 4);
            const number = digits.slice(4);
            return prefix + '-' + number;
        }
        
        return value;
    }

    // ==================== VALIDACIONES INDIVIDUALES ====================
    function validarCedula(value, input) {
        if (!value) {
            showError(input, 'La cédula es obligatoria.');
            return false;
        }
        if (!regex.cedula.test(value)) {
            showError(input, 'Cédula inválida: debe tener entre 7 y 8 dígitos numéricos.');
            return false;
        }
        showValid(input);
        return true;
    }

    function validarNombre(value, input) {
        if (!value) {
            showError(input, 'El nombre es obligatorio.');
            return false;
        }
        if (value.trim().length < 2) {
            showError(input, 'El nombre debe tener al menos 2 letras.');
            return false;
        }
        if (!regex.soloLetras.test(value)) {
            showError(input, 'El nombre solo puede contener letras y espacios.');
            return false;
        }
        showValid(input);
        return true;
    }

    function validarApellido(value, input) {
        if (!value) {
            showError(input, 'El apellido es obligatorio.');
            return false;
        }
        if (value.trim().length < 2) {
            showError(input, 'El apellido debe tener al menos 2 letras.');
            return false;
        }
        if (!regex.soloLetras.test(value)) {
            showError(input, 'El apellido solo puede contener letras y espacios.');
            return false;
        }
        showValid(input);
        return true;
    }

    function validarTelefono(value, input) {
        if (value === '') {
            clearFeedback(input);
            return true; // Campo opcional
        }
        
        // Limpiar el valor de guiones para validar
        const cleanValue = value.replace(/-/g, '');
        
        if (cleanValue.length !== 11) {
            showError(input, 'El teléfono debe tener exactamente 11 dígitos (ejemplo: 0412-1234567)');
            return false;
        }
        
        if (!regex.telefono.test(cleanValue)) {
            showError(input, 'Formato inválido. Use un número válido de Venezuela: 0412-1234567');
            return false;
        }
        
        showValid(input);
        return true;
    }

    function validarCorreo(value, input) {
        if (value === '') {
            clearFeedback(input);
            return true; // Campo opcional
        }
        if (!regex.correo.test(value)) {
            showError(input, 'Correo electrónico inválido (ejemplo: usuario@dominio.com)');
            return false;
        }
        showValid(input);
        return true;
    }

    function validarParentesco(value, input) {
        if (!value) {
            showError(input, 'Debe seleccionar el parentesco.');
            return false;
        }
        showValid(input);
        return true;
    }

    // ==================== FILTROS EN TIEMPO REAL ====================
    
    // Filtrar cédula: solo números y máximo 8 dígitos
    const cedulaInput = document.getElementById('cedula');
    if (cedulaInput) {
        cedulaInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '').slice(0, 8);
            validarCedula(this.value, this);
        });
        cedulaInput.addEventListener('blur', function() {
            validarCedula(this.value, this);
        });
    }

    // Filtrar nombre: solo letras y espacios
    const nombreInput = document.getElementById('nombre');
    if (nombreInput) {
        nombreInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
            validarNombre(this.value, this);
        });
        nombreInput.addEventListener('blur', function() {
            validarNombre(this.value, this);
        });
    }

    // Filtrar apellido: solo letras y espacios
    const apellidoInput = document.getElementById('apellido');
    if (apellidoInput) {
        apellidoInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^a-zA-ZáéíóúÁÉÍÓÚñÑ\s]/g, '');
            validarApellido(this.value, this);
        });
        apellidoInput.addEventListener('blur', function() {
            validarApellido(this.value, this);
        });
    }

    // Filtrar y validar teléfono - máximo 12 caracteres (formato: 0412-1234567)
    const telefonoInput = document.getElementById('telefono');
    if (telefonoInput) {
        telefonoInput.addEventListener('input', function(e) {
            // Permitir solo números y guiones
            let value = this.value.replace(/[^0-9-]/g, '');
            
            // Limitar a 12 caracteres máximo
            if (value.length > 12) {
                value = value.slice(0, 12);
            }
            
            // Formatear automáticamente
            const digits = value.replace(/-/g, '');
            if (digits.length === 11) {
                value = formatTelefono(value);
            }
            
            this.value = value;
            validarTelefono(this.value, this);
        });
        
        telefonoInput.addEventListener('blur', function() {
            // Formatear al perder el foco si tiene 11 dígitos
            const digits = this.value.replace(/-/g, '');
            if (digits.length === 11) {
                this.value = formatTelefono(this.value);
            }
            validarTelefono(this.value, this);
        });
    }

    // Validar correo
    const correoInput = document.getElementById('correo');
    if (correoInput) {
        correoInput.addEventListener('input', function() {
            validarCorreo(this.value, this);
        });
        correoInput.addEventListener('blur', function() {
            validarCorreo(this.value, this);
        });
    }

    // Validar parentesco
    const parentescoSelect = document.getElementById('parentesco');
    if (parentescoSelect) {
        parentescoSelect.addEventListener('change', function() {
            validarParentesco(this.value, this);
        });
    }

    // ==================== VALIDACIÓN COMPLETA DEL FORMULARIO ====================
    window.validarFormularioCompleto = function(event) {
        // Obtener todos los campos
        const cedula = document.getElementById('cedula');
        const nombre = document.getElementById('nombre');
        const apellido = document.getElementById('apellido');
        const telefono = document.getElementById('telefono');
        const correo = document.getElementById('correo');
        const parentesco = document.getElementById('parentesco');

        // Validar todos los campos obligatorios
        const isCedulaValid = validarCedula(cedula.value, cedula);
        const isNombreValid = validarNombre(nombre.value, nombre);
        const isApellidoValid = validarApellido(apellido.value, apellido);
        const isParentescoValid = validarParentesco(parentesco.value, parentesco);

        // Validar campos opcionales
        const isTelefonoValid = validarTelefono(telefono.value, telefono);
        const isCorreoValid = validarCorreo(correo.value, correo);

        // Verificar si todos los obligatorios son válidos
        const obligatoriosValidos = isCedulaValid && isNombreValid && isApellidoValid && isParentescoValid;
        const opcionalesValidos = isTelefonoValid && isCorreoValid;

        if (!obligatoriosValidos) {
            if (event) event.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Campos obligatorios incompletos',
                text: 'Por favor, revise los campos resaltados en rojo. Todos los campos con * son obligatorios.',
                confirmButtonColor: '#dc3545',
                timer: 3000
            });
            return false;
        }

        if (!opcionalesValidos) {
            if (event) event.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Campos con formato inválido',
                text: 'Por favor, revise el teléfono o correo electrónico ingresado.',
                confirmButtonColor: '#dc3545'
            });
            return false;
        }

        
            const form = document.getElementById('form');
            if (form) {
                form.submit();
            }
       
        
        return false;
    };
    
    // ==================== RESET DEL FORMULARIO ====================
    const resetBtn = document.getElementById('resetBtn');
    if (resetBtn) {
        resetBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Resetear el formulario
            const form = document.querySelector('form');
            if (form) form.reset();
            
            // Limpiar todas las clases de validación
            const inputs = ['cedula', 'nombre', 'apellido', 'telefono', 'correo', 'parentesco'];
            inputs.forEach(id => {
                const input = document.getElementById(id);
                if (input) {
                    input.classList.remove('is-valid', 'is-invalid');
                    const feedback = document.getElementById(id + 'Feedback');
                    if (feedback) {
                        feedback.textContent = '';
                        feedback.classList.remove('valid-feedback-real', 'invalid-feedback-real');
                    }
                }
            });
            
            Swal.fire({
                icon: 'info',
                title: 'Formulario limpiado',
                text: 'Todos los campos han sido restablecidos.',
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000
            });
        });
    }
});