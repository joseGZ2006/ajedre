function validarTipotorneo(event) {
    event.preventDefault();
    
    // Limpiar errores previos
    document.querySelectorAll('.invalid-feedback-real').forEach(el => el.textContent = '');
    document.querySelectorAll('.form-control, .form-select').forEach(el => el.classList.remove('is-invalid'));
    
    let isValid = true;
    const nombre = document.getElementById('nombre').value.trim();
    const tipo = document.getElementById('tipo').value;
    
    // Validar nombre (solo letras y espacios)
    const nombreRegex = /^[a-zA-ZáéíóúñÁÉÍÓÚÑ\s]+$/;
    if (nombre === '') {
        document.getElementById('nombreFeedback').textContent = 'El nombre es requerido';
        document.getElementById('nombre').classList.add('is-invalid');
        isValid = false;
    } else if (!nombreRegex.test(nombre)) {
        document.getElementById('nombreFeedback').textContent = 'El nombre solo puede contener letras y espacios';
        document.getElementById('nombre').classList.add('is-invalid');
        isValid = false;
    }
    
    // Validar tipo
    if (tipo === '') {
        document.getElementById('tipoFeedback').textContent = 'El tipo es requerido';
        document.getElementById('tipo').classList.add('is-invalid');
        isValid = false;
    }
    
    if (!isValid) {
        Swal.fire({
            icon: 'error',
            title: 'Error de Validación',
            text: 'Por favor, corrija los campos marcados.'
        });
        return false;
    }
    
    // Enviar formulario
    document.getElementById('formRegistrar').submit();
    return true;
}