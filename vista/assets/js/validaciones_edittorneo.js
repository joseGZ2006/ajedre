$(document).ready(function() {
    
    $('#formEditar').on('submit', function(e) {
        e.preventDefault();
        
        let isValid = true;
        
        // Limpiar errores previos
        $('.invalid-feedback-real').text('');
        $('.form-control, .form-select').removeClass('is-invalid');
        
        // Validar Tipo de Torneo (opcional)
        const idTipoTorneo = $('#idTipoTorneo').val();
        
        // Validar Nombre
        const nombre = $('#nombre').val().trim();
        if (!nombre) {
            mostrarError('nombre', 'El nombre es requerido');
            isValid = false;
        } else if (!/^[a-zA-ZáéíóúñÁÉÍÓÚÑ0-9\s\-\.]+$/.test(nombre)) {
            mostrarError('nombre', 'El nombre solo puede contener letras, números, espacios, guiones y puntos');
            isValid = false;
        }
        
        // Validar Fecha
        const fecha = $('#fecha').val();
        if (!fecha) {
            mostrarError('fecha', 'La fecha es requerida');
            isValid = false;
        } else {
            const fechaObj = new Date(fecha);
            if (isNaN(fechaObj.getTime())) {
                mostrarError('fecha', 'La fecha no es válida');
                isValid = false;
            }
        }
        
        // Validar Lugar
        const lugar = $('#lugar').val().trim();
        if (!lugar) {
            mostrarError('lugar', 'El lugar es requerido');
            isValid = false;
        } else if (!/^[a-zA-ZáéíóúñÁÉÍÓÚÑ0-9\s\-\.]+$/.test(lugar)) {
            mostrarError('lugar', 'El lugar solo puede contener letras, números, espacios, guiones y puntos');
            isValid = false;
        }
        
        // Validar Categoria (opcional)
        const categoria = $('#categoria').val().trim();
        if (categoria && !/^[a-zA-ZáéíóúñÁÉÍÓÚÑ0-9\s\-\.]+$/.test(categoria)) {
            mostrarError('categoria', 'La categoría solo puede contener letras, números, espacios, guiones y puntos');
            isValid = false;
        }
        
        // Validar Clasificacion (opcional)
        const clasificacion = $('#clasificacion').val().trim();
        if (clasificacion && !/^[a-zA-ZáéíóúñÁÉÍÓÚÑ0-9\s\-\.]+$/.test(clasificacion)) {
            mostrarError('clasificacion', 'La clasificación solo puede contener letras, números, espacios, guiones y puntos');
            isValid = false;
        }
        
        // Validar Estatus
        const estatus = $('#estatus').val();
        if (!estatus) {
            mostrarError('estatus', 'El estatus es requerido');
            isValid = false;
        }
        
        // Validar Cupo
        const cupo = $('#cupo').val().trim();
        if (!cupo) {
            mostrarError('cupo', 'El cupo es requerido');
            isValid = false;
        } else {
            const cupoNum = parseInt(cupo);
            if (isNaN(cupoNum) || cupoNum <= 0 || cupoNum > 1000) {
                mostrarError('cupo', 'El cupo debe ser un número entre 1 y 1000');
                isValid = false;
            }
        }
        
        if (isValid) {
            this.submit();
        }
    });
    
    function mostrarError(campo, mensaje) {
        $(`#${campo}`).addClass('is-invalid');
        $(`#${campo}Feedback`).text(mensaje);
    }
    
    // Resetear errores al hacer foco
    $('.form-control, .form-select').on('focus', function() {
        $(this).removeClass('is-invalid');
        $(this).siblings('.invalid-feedback-real').text('');
    });
    
});