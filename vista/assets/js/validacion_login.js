document.addEventListener('DOMContentLoaded', function() {
    console.log("✅ DOM cargado correctamente");
    
    // Obtener elementos
    const form = document.getElementById('loginForm');
    const usernameInput = document.getElementById('username');
    const passwordInput = document.getElementById('password');
    const showPasswordCheckbox = document.getElementById('showPassword');
    const usernameError = document.getElementById('usernameError');
    const passwordError = document.getElementById('passwordError');
    
    // FUNCIÓN: Mostrar campo válido
    function showFieldValid(input, errorElement) {
        if (errorElement) {
            errorElement.textContent = '';
        }
        input.style.backgroundColor = '';
        input.style.borderColor = '';
    }
    
    // FUNCIÓN: Marcar campo como inválido
    function showFieldError(input, errorElement, message) {
        if (errorElement) {
            errorElement.textContent = message;
            errorElement.style.color = '#dc2626';
            errorElement.style.fontSize = '12px';
            errorElement.style.marginTop = '5px';
        }
        input.style.backgroundColor = '#fef2f2';
        input.style.borderColor = '#dc2626';
    }
    
    // FUNCIÓN: Validar usuario (solo campo vacío)
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
    
    // FUNCIÓN: Validar contraseña (solo campo vacío)
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
    
    // FUNCIÓN: Mostrar mensaje de credenciales incorrectas (desde el servidor)
    function showCredentialError(message) {
        Swal.fire({
            icon: 'error',
            title: 'Error de autenticación',
            text: message,
            confirmButtonColor: '#dc2626',
            confirmButtonText: 'Intentar de nuevo'
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
    
    // Mostrar/ocultar contraseña
    if (showPasswordCheckbox) {
        showPasswordCheckbox.addEventListener('change', function() {
            const type = this.checked ? 'text' : 'password';
            if (passwordInput) {
                passwordInput.type = type;
            }
            console.log("Mostrar contraseña:", this.checked);
        });
    }
    
    // EVENTO: Envío del formulario - SOLO VALIDA CAMPOS VACIOS
    if (form) {
        form.addEventListener('submit', function(e) {
            console.log("🔍 Validando formulario...");
            
            // Validar que ambos campos NO estén vacíos
            const isUsernameValid = validateUsername();
            const isPasswordValid = validatePassword();
            
            // Si hay campos vacíos, prevenir envío
            if (!isUsernameValid || !isPasswordValid) {
                console.log("❌ Validación fallida - Campos vacíos");
                e.preventDefault();
                showError('Por favor complete todos los campos');
                return false;
            }
            
            // Si los campos están llenos, permitir envío
            console.log("✅ Validación exitosa - Enviando al servidor...");
            return true;
        });
    }
    
    // Soporte para tecla Enter
    if (passwordInput) {
        passwordInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                if (form) {
                    // Trigger submit event
                    const event = new Event('submit', { bubbles: true, cancelable: true });
                    form.dispatchEvent(event);
                }
            }
        });
    }
    
    // Verificar si hay parámetro de error en la URL (por si el servidor redirige con error)
    const urlParams = new URLSearchParams(window.location.search);
    const errorParam = urlParams.get('error');
    if (errorParam === 'credenciales') {
        showCredentialError('Usuario o contraseña incorrectos');
    } else if (errorParam === 'inactivo') {
        Swal.fire({
            icon: 'warning',
            title: 'Usuario Inactivo',
            text: 'Su usuario está inactivo. Consulte al administrador.',
            confirmButtonColor: '#f59e0b'
        });
    }
    
    console.log("✅ Sistema de login listo - Validación de campos vacíos");
    console.log("✅ SweetAlert2 disponible:", typeof Swal !== 'undefined');
});