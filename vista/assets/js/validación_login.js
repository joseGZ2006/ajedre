
document.addEventListener('DOMContentLoaded', function() {
    console.log("✅ DOM cargado correctamente");
    
    // Obtener elementos
    const form = document.getElementById('loginForm');
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const showPasswordCheckbox = document.getElementById('showPassword');
    const usernameError = document.getElementById('usernameError');
    const passwordError = document.getElementById('passwordError');
    
    // FUNCIÓN: Mostrar/ocultar contraseña
    if (showPasswordCheckbox) {
        showPasswordCheckbox.addEventListener('change', function() {
            const type = this.checked ? 'text' : 'password';
            passwordInput.type = type;
            console.log("Mostrar contraseña:", this.checked);
        });
    }

    // FUNCIÓN: Marcar campo como inválido
    function showFieldError(input, errorElement, message) {
        errorElement.textContent = message;
        errorElement.style.color = '#dc2626';
        errorElement.style.fontSize = '12px';
        errorElement.style.marginTop = '5px';
        input.style.backgroundColor = '#fef2f2';
        input.style.borderColor = '#dc2626';
    }

    // FUNCIÓN: Marcar campo como válido
    function showFieldValid(input, errorElement) {
        errorElement.textContent = '✓ Campo válido';
        errorElement.style.color = '#0f766e';
        errorElement.style.fontSize = '12px';
        errorElement.style.marginTop = '5px';
        input.style.backgroundColor = '#ecfdf5';
        input.style.borderColor = '#22c55e';
    }

    // FUNCIÓN: Limpiar validación del campo
    function clearFieldValidation(input, errorElement) {
        errorElement.textContent = '';
        input.style.backgroundColor = '';
        input.style.borderColor = '';
    }

    // FUNCIÓN: Validar usuario en tiempo real
    function validateUsername() {
        const username = usernameInput.value.trim();
        
        if (username === '') {
            showFieldError(usernameInput, usernameError, '⚠️ El usuario es obligatorio');
            return false;
        } else {
            showFieldValid(usernameInput, usernameError);
            return true;
        }
    }
    
    // FUNCIÓN: Validar contraseña en tiempo real
    function validatePassword() {
        const password = passwordInput.value;
        
        if (password === '') {
            showFieldError(passwordInput, passwordError, '⚠️ La contraseña es obligatoria');
            return false;
        } else {
            showFieldValid(passwordInput, passwordError);
            return true;
        }
    }
    
    // FUNCIÓN: Mostrar error con SweetAlert2
    function showError(message) {
        Swal.fire({
            icon: 'error',
            title: 'Campos incompletos',
            text: message,
            confirmButtonColor: '#dc2626',
            confirmButtonText: 'Entendido',
            timer: 3000,
            showConfirmButton: true
        });
    }
    
    // EVENTOS: Validación en tiempo real
    if (usernameInput) {
        usernameInput.addEventListener('input', function() {
            validateUsername();
        });
    }
    
    if (passwordInput) {
        passwordInput.addEventListener('input', function() {
            validatePassword();
        });
    }
    
    // EVENTO: Envío del formulario
    if (form) {
        form.addEventListener('submit', function(e) {
            console.log("🔍 Validando formulario...");
            
            // Validar que ambos campos estén llenos
            const isUsernameValid = validateUsername();
            const isPasswordValid = validatePassword();
            
            // Si ambas validaciones son correctas (campos no vacíos)
            if (isUsernameValid && isPasswordValid) {
                console.log("✅ Validaciones exitosas - Permitiendo envío...");
                return;
            }

            console.log("❌ Validaciones fallidas");
            e.preventDefault(); // Prevenir envío del formulario
            showError('Usuario o contraseña incorrectos');
        });
    }
    
    // Soporte para tecla Enter
    if (passwordInput) {
        passwordInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                if (form) {
                    const event = new Event('submit', { bubbles: true, cancelable: true });
                    form.dispatchEvent(event);
                }
            }
        });
    }
    
    console.log("✅ Sistema de login listo - Solo validación de campos vacíos");
    console.log("✅ SweetAlert2 disponible:", typeof Swal !== 'undefined');
});