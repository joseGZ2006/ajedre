// represents_alumno.js - Manejo de representantes desde el modal

// Esperar a que jQuery esté listo
jQuery(document).ready(function($) {
    console.log("represents_alumno.js cargado correctamente");
    
    // Variable para almacenar los representantes cargados
    let representantesCache = [];
    
    // Cargar representantes al iniciar
    cargarRepresentantes();
    
    // Evento para abrir el modal y limpiar campos
    $('#btnAgregarRepresentante').off('click').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        console.log("Botón Agregar Representante clickeado");
        limpiarModalRepresentante();
    });
    
    // Evento para guardar representante
    $('#btnGuardarRepresentante').off('click').on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        console.log("Botón Guardar Representante clickeado");
        guardarRepresentante();
        return false;
    });
    
    // Función para cargar representantes desde el servidor
    function cargarRepresentantes() {
        console.log("Cargando representantes...");
        $.ajax({
            url: '../../controlador/ctl_representante_ajax.php',
            type: 'GET',
            data: { action: 'listar' },
            dataType: 'json',
            timeout: 10000,
            success: function(response) {
                console.log("Representantes cargados:", response);
                if (response.success && response.representantes) {
                    representantesCache = response.representantes;
                    actualizarSelectRepresentantes(response.representantes);
                }
            },
            error: function(xhr, status, error) {
                console.error('Error al cargar representantes:', error);
                // Si no hay representantes, dejar el select vacío
                actualizarSelectRepresentantes([]);
            }
        });
    }
    
    // Función para actualizar el select de representantes
    function actualizarSelectRepresentantes(representantes) {
        const select = $('#idRepresentante');
        if (!select.length) {
            console.log("Select idRepresentante no encontrado");
            return;
        }
        
        select.empty();
        select.append('<option value="">Seleccionar representante</option>');
        
        if (representantes && representantes.length > 0) {
            representantes.forEach(function(rep) {
                const optionText = rep.nombre + ' ' + rep.apellido + ' (C.I: ' + rep.cedula + ')' + (rep.parentesco ? ' - ' + rep.parentesco : '');
                select.append('<option value="' + rep.idRepresentante + '">' + optionText + '</option>');
            });
            console.log("Select actualizado con " + representantes.length + " representantes");
        } else {
            select.append('<option value="">No hay representantes disponibles</option>');
            console.log("No hay representantes disponibles");
        }
    }
    
    // Función para limpiar el modal
    function limpiarModalRepresentante() {
        $('#modalRepCedula').val('');
        $('#modalRepNombre').val('');
        $('#modalRepApellido').val('');
        $('#modalRepCorreo').val('');
        $('#modalRepTelefono').val('');
        $('#modalRepParentesco').val('');
        
        // Remover clases de error
        $('.modal-body .is-invalid').removeClass('is-invalid');
        $('.modal-body .invalid-feedback').remove();
    }
    
    // Función para validar campos del modal
    function validarModalRepresentante() {
        let isValid = true;
        
        const cedula = $('#modalRepCedula').val().trim();
        const nombre = $('#modalRepNombre').val().trim();
        const apellido = $('#modalRepApellido').val().trim();
        const correo = $('#modalRepCorreo').val().trim();
        
        // Validar cédula
        if (!cedula) {
            mostrarErrorModal('modalRepCedula', 'La cédula es requerida');
            isValid = false;
        } else if (!/^\d{7,10}$/.test(cedula)) {
            mostrarErrorModal('modalRepCedula', 'La cédula debe tener entre 7 y 10 dígitos');
            isValid = false;
        } else {
            limpiarErrorModal('modalRepCedula');
        }
        
        // Validar nombre
        if (!nombre) {
            mostrarErrorModal('modalRepNombre', 'El nombre es requerido');
            isValid = false;
        } else if (nombre.length < 2) {
            mostrarErrorModal('modalRepNombre', 'El nombre debe tener al menos 2 caracteres');
            isValid = false;
        } else {
            limpiarErrorModal('modalRepNombre');
        }
        
        // Validar apellido
        if (!apellido) {
            mostrarErrorModal('modalRepApellido', 'El apellido es requerido');
            isValid = false;
        } else if (apellido.length < 2) {
            mostrarErrorModal('modalRepApellido', 'El apellido debe tener al menos 2 caracteres');
            isValid = false;
        } else {
            limpiarErrorModal('modalRepApellido');
        }
        
        // Validar correo
        if (!correo) {
            mostrarErrorModal('modalRepCorreo', 'El correo es requerido');
            isValid = false;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correo)) {
            mostrarErrorModal('modalRepCorreo', 'Ingrese un correo válido');
            isValid = false;
        } else {
            limpiarErrorModal('modalRepCorreo');
        }
        
        return isValid;
    }
    
    function mostrarErrorModal(campoId, mensaje) {
        const campo = $('#' + campoId);
        campo.addClass('is-invalid');
        campo.siblings('.invalid-feedback').remove();
        campo.after('<div class="invalid-feedback">' + mensaje + '</div>');
    }
    
    function limpiarErrorModal(campoId) {
        const campo = $('#' + campoId);
        campo.removeClass('is-invalid');
        campo.siblings('.invalid-feedback').remove();
    }
    
    function guardarRepresentante() {
        console.log("Ejecutando guardarRepresentante()");
        
        if (!validarModalRepresentante()) {
            console.log("Validación falló");
            return;
        }
        
        const btn = $('#btnGuardarRepresentante');
        const originalText = btn.html();
        btn.html('<i class="fas fa-spinner fa-spin me-2"></i>Guardando...');
        btn.prop('disabled', true);
        
        const datos = {
            registrar_ajax: 'registrar_ajax',
            cedula: $('#modalRepCedula').val().trim(),
            nombre: $('#modalRepNombre').val().trim(),
            apellido: $('#modalRepApellido').val().trim(),
            correo: $('#modalRepCorreo').val().trim(),
            telefono: $('#modalRepTelefono').val().trim(),
            parentesco: $('#modalRepParentesco').val() || 'Tutor'
        };
        
        console.log("Datos a enviar:", datos);
        
        $.ajax({
            url: '../../controlador/ctl_representante_ajax.php',
            type: 'POST',
            data: datos,
            dataType: 'json',
            timeout: 15000,
            success: function(response) {
                console.log("Respuesta del servidor:", response);
                
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: '¡Registrado!',
                        text: response.message,
                        timer: 1500,
                        showConfirmButton: false
                    });
                    
                    const nuevoRepresentante = {
                        idRepresentante: response.id,
                        cedula: datos.cedula,
                        nombre: datos.nombre,
                        apellido: datos.apellido,
                        parentesco: datos.parentesco
                    };
                    
                    representantesCache.push(nuevoRepresentante);
                    actualizarSelectRepresentantes(representantesCache);
                    
                    setTimeout(function() {
                        $('#idRepresentante option[value="' + response.id + '"]').prop('selected', true);
                        $('#idRepresentante').trigger('change');
                    }, 100);
                    
                    // Cerrar modal
                    $('#representanteModal').modal('hide');
                    limpiarModalRepresentante();
                    
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: response.message || 'Error al registrar representante'
                    });
                }
            },
            error: function(xhr, status, error) {
                console.error("Error AJAX:", status, error);
                console.error("Respuesta:", xhr.responseText);
                Swal.fire({
                    icon: 'error',
                    title: 'Error de conexión',
                    text: 'Error al conectar con el servidor. Verifica que el archivo ctl_representante_ajax.php exista.'
                });
            },
            complete: function() {
                btn.html(originalText);
                btn.prop('disabled', false);
            }
        });
    }
});