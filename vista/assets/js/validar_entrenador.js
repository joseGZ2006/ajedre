//validar entrenador.js
function validarFormularioCompleto(ojb) {
    const cedula = document.getElementById('cedula');
    const nombre = document.getElementById('nombre');
    const apellido = document.getElementById('apellido');
    const telefono = document.getElementById('telefono');
    
    // declaramos una variable para la idEspecialidad
    const idEspecialidad = document.getElementById('id_especialidad');

    let isValid = true;

    // Validar cédula
    if (!/^\d{8}$/.test(cedula.value)) {
        cedula.classList.add('is-invalid');
        document.getElementById('cedulaFeedback').textContent = 'La cédula debe tener exactamente 8 dígitos.';
        isValid = false;
    } else {
        cedula.classList.remove('is-invalid');
        document.getElementById('cedulaFeedback').textContent = '';
    }

    // Validar nombre
    if (nombre.value.trim() === '') {
        nombre.classList.add('is-invalid');
        document.getElementById('nombreFeedback').textContent = 'El nombre es obligatorio.';
        isValid = false;
    } else {
        nombre.classList.remove('is-invalid');
        document.getElementById('nombreFeedback').textContent = '';
    }

    // Validar apellido
    if (apellido.value.trim() === '') {
        apellido.classList.add('is-invalid');
        document.getElementById('apellidoFeedback').textContent = 'El apellido es obligatorio.';
        isValid = false;
    } else {
        apellido.classList.remove('is-invalid');
        document.getElementById('apellidoFeedback').textContent = '';
    }

    // Validar teléfono permite este formato: 0414-1234567 o 0424-1234567 o 0416-1234567 o 0426-1234567 
    if (!/^[0-9]{4}-[0-9]{7}$/.test(telefono.value)) {
        telefono.classList.add('is-invalid');
        document.getElementById('telefonoFeedback').textContent = 'El teléfono debe tener el formato 0422-1234567.';
        isValid = false;
    } else {
        telefono.classList.remove('is-invalid');
        document.getElementById('telefonoFeedback').textContent = '';
    }
    


    

    // Validar especialidad
    if (idEspecialidad.value === '') {
        idEspecialidad.classList.add('is-invalid');
        document.getElementById('especialidadFeedback').textContent = 'La especialidad es obligatoria.';
        isValid = false;
    } else {
        idEspecialidad.classList.remove('is-invalid');
        document.getElementById('especialidadFeedback').textContent = '';
    }

    return isValid;
}