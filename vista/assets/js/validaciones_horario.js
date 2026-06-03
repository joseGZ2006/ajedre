// validaciones_horario.js - Validaciones específicas para el formulario de horario de clases
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
        aula: /^[a-zA-Z0-9\sáéíóúÁÉÍÓÚñÑ-]+$/,
        hora: /^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/
    };

    // ==================== VALIDACIONES INDIVIDUALES ====================
    function validarDiaSemana(value, input) {
        if (!value) {
            showError(input, 'Debe seleccionar un día de la semana.');
            return false;
        }
        showValid(input);
        return true;
    }

    function validarHoraInicio(value, input) {
        if (!value) {
            showError(input, 'La hora de inicio es obligatoria.');
            return false;
        }
        if (!regex.hora.test(value)) {
            showError(input, 'Formato de hora inválido.');
            return false;
        }
        showValid(input);
        return true;
    }

    function validarHoraFin(value, input) {
        if (!value) {
            showError(input, 'La hora de fin es obligatoria.');
            return false;
        }
        if (!regex.hora.test(value)) {
            showError(input, 'Formato de hora inválido.');
            return false;
        }
        showValid(input);
        return true;
    }

    function validarHorario(horaInicio, horaFin, horaInicioInput, horaFinInput) {
        if (!horaInicio || !horaFin) {
            return false;
        }
        
        if (horaInicio >= horaFin) {
            showError(horaFinInput, 'La hora de fin debe ser mayor a la hora de inicio.');
            return false;
        }
        
        showValid(horaFinInput);
        return true;
    }

    function validarNivel(value, input) {
        if (!value) {
            showError(input, 'Debe seleccionar un nivel.');
            return false;
        }
        showValid(input);
        return true;
    }

    function validarAula(value, input) {
        if (!value) {
            showError(input, 'El aula es obligatoria.');
            return false;
        }
        if (value.trim().length < 2) {
            showError(input, 'El aula debe tener al menos 2 caracteres.');
            return false;
        }
        if (!regex.aula.test(value)) {
            showError(input, 'El aula solo puede contener letras, números, espacios y guiones.');
            return false;
        }
        showValid(input);
        return true;
    }

    function validarEntrenador(value, input) {
        if (!value) {
            showError(input, 'Debe seleccionar un entrenador.');
            return false;
        }
        showValid(input);
        return true;
    }

    // ==================== VALIDACIONES EN TIEMPO REAL ====================
    
    // Validar día semana
    const diaSemanaSelect = document.getElementById('diaSemana');
    if (diaSemanaSelect) {
        diaSemanaSelect.addEventListener('change', function() {
            validarDiaSemana(this.value, this);
        });
    }

    // Validar hora inicio
    const horaInicioInput = document.getElementById('horaInicio');
    if (horaInicioInput) {
        horaInicioInput.addEventListener('change', function() {
            validarHoraInicio(this.value, this);
            // Re-validar hora fin si ya tiene valor
            const horaFin = document.getElementById('horaFin');
            if (horaFin && horaFin.value) {
                validarHorario(this.value, horaFin.value, this, horaFin);
            }
        });
    }

    // Validar hora fin
    const horaFinInput = document.getElementById('horaFin');
    if (horaFinInput) {
        horaFinInput.addEventListener('change', function() {
            validarHoraFin(this.value, this);
            const horaInicio = document.getElementById('horaInicio');
            if (horaInicio && horaInicio.value) {
                validarHorario(horaInicio.value, this.value, horaInicio, this);
            }
        });
    }

    // Validar nivel
    const nivelSelect = document.getElementById('nivel');
    if (nivelSelect) {
        nivelSelect.addEventListener('change', function() {
            validarNivel(this.value, this);
        });
    }

    // Filtrar y validar aula
    const aulaInput = document.getElementById('aula');
    if (aulaInput) {
        aulaInput.addEventListener('input', function(e) {
            // No filtrar, solo validar
            validarAula(this.value, this);
        });
        aulaInput.addEventListener('blur', function() {
            validarAula(this.value, this);
        });
    }

    // Validar entrenador
    const entrenadorSelect = document.getElementById('idEntrenador');
    if (entrenadorSelect) {
        entrenadorSelect.addEventListener('change', function() {
            validarEntrenador(this.value, this);
        });
    }

    // ==================== VALIDACIÓN COMPLETA DEL FORMULARIO ====================
    window.validarFormularioCompleto = function(event) {
        const diaSemana = document.getElementById('diaSemana');
        const horaInicio = document.getElementById('horaInicio');
        const horaFin = document.getElementById('horaFin');
        const nivel = document.getElementById('nivel');
        const aula = document.getElementById('aula');
        const entrenador = document.getElementById('idEntrenador');

        // Validar todos los campos obligatorios
        const isDiaValid = validarDiaSemana(diaSemana.value, diaSemana);
        const isHoraInicioValid = validarHoraInicio(horaInicio.value, horaInicio);
        const isHoraFinValid = validarHoraFin(horaFin.value, horaFin);
        const isNivelValid = validarNivel(nivel.value, nivel);
        const isAulaValid = validarAula(aula.value, aula);
        const isEntrenadorValid = validarEntrenador(entrenador.value, entrenador);

        // Validar que hora inicio < hora fin
        let isHorarioValid = true;
        if (isHoraInicioValid && isHoraFinValid) {
            isHorarioValid = validarHorario(horaInicio.value, horaFin.value, horaInicio, horaFin);
        }

        // Verificar si todos los obligatorios son válidos
        const todosValidos = isDiaValid && isHoraInicioValid && isHoraFinValid &&
                            isHorarioValid && isNivelValid && isAulaValid && isEntrenadorValid;

        if (!todosValidos) {
            event.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Campos obligatorios incompletos o inválidos',
                text: 'Por favor, revise los campos resaltados en rojo. Todos los campos con * son obligatorios.',
                confirmButtonColor: '#dc3545',
                timer: 3000
            });
            return false;
        }

        event.preventDefault();
        const form = event.target;
        Swal.fire({
            icon: 'success',
            title: '¡Registro exitoso!',
            text: 'El horario ha sido registrado correctamente.',
            confirmButtonText: 'Aceptar'
        }).then(() => {
            if (form) form.submit();
        });
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
            const inputs = ['diaSemana', 'horaInicio', 'horaFin', 'nivel', 'aula', 'idEntrenador'];
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