<script>
    // Función global para guardar representante (USANDO FETCH, NO JQUERY)
    window.guardarRepresentanteDirecto = function() {
        console.log("guardarRepresentanteDirecto ejecutándose");
        
        // Validar campos
        const cedula = document.getElementById('modalRepCedula').value.trim();
        const nombre = document.getElementById('modalRepNombre').value.trim();
        const apellido = document.getElementById('modalRepApellido').value.trim();
        const correo = document.getElementById('modalRepCorreo').value.trim();
        const telefono = document.getElementById('modalRepTelefono').value.trim();
        const parentesco = document.getElementById('modalRepParentesco').value || 'Tutor';
        
        // Validaciones básicas con SweetAlert2
        if (!cedula) {
            Swal.fire({
                icon: 'error',
                title: 'Campo requerido',
                text: 'La cédula es requerida',
                confirmButtonColor: '#3085d6'
            });
            return;
        }
        if (!/^\d{7,10}$/.test(cedula)) {
            Swal.fire({
                icon: 'error',
                title: 'Formato inválido',
                text: 'La cédula debe tener entre 7 y 10 dígitos',
                confirmButtonColor: '#3085d6'
            });
            return;
        }
        if (!nombre) {
            Swal.fire({
                icon: 'error',
                title: 'Campo requerido',
                text: 'El nombre es requerido',
                confirmButtonColor: '#3085d6'
            });
            return;
        }
        if (!apellido) {
            Swal.fire({
                icon: 'error',
                title: 'Campo requerido',
                text: 'El apellido es requerido',
                confirmButtonColor: '#3085d6'
            });
            return;
        }
        if (!correo) {
            Swal.fire({
                icon: 'error',
                title: 'Campo requerido',
                text: 'El correo electrónico es requerido',
                confirmButtonColor: '#3085d6'
            });
            return;
        }
        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(correo)) {
            Swal.fire({
                icon: 'error',
                title: 'Correo inválido',
                text: 'Ingrese un correo electrónico válido (ejemplo: usuario@correo.com)',
                confirmButtonColor: '#3085d6'
            });
            return;
        }
        
        // Mostrar loading
        Swal.fire({
            title: 'Guardando...',
            text: 'Por favor espere',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        // Deshabilitar botón
        const btn = document.getElementById('btnGuardarRepresentante');
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Guardando...';
        btn.disabled = true;
        
        // Crear datos para enviar
        const formData = new URLSearchParams();
        formData.append('registrar_ajax', 'registrar_ajax');
        formData.append('cedula', cedula);
        formData.append('nombre', nombre);
        formData.append('apellido', apellido);
        formData.append('correo', correo);
        formData.append('telefono', telefono);
        formData.append('parentesco', parentesco);
        
        // Enviar usando fetch
        fetch('../../controlador/ctl_representante_ajax.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: formData.toString()
        })
        .then(response => response.json())
        .then(response => {
            console.log('Respuesta:', response);
            
            if (response.success) {
                // Cerrar loading
                Swal.close();
                
                // Mostrar éxito
                Swal.fire({
                    icon: 'success',
                    title: '¡Registrado!',
                    text: response.message,
                    timer: 2000,
                    showConfirmButton: false,
                    didClose: () => {
                        // Agregar al select
                        const select = document.getElementById('idRepresentante');
                        const option = document.createElement('option');
                        option.value = response.id;
                        option.text = response.nombre + ' ' + response.apellido + ' (C.I: ' + response.cedula + ') - ' + (response.parentesco || parentesco);
                        select.appendChild(option);
                        option.selected = true;
                        
                        // Cerrar modal
                        const modal = bootstrap.Modal.getInstance(document.getElementById('representanteModal'));
                        modal.hide();
                        
                        // Limpiar campos
                        document.getElementById('modalRepCedula').value = '';
                        document.getElementById('modalRepNombre').value = '';
                        document.getElementById('modalRepApellido').value = '';
                        document.getElementById('modalRepCorreo').value = '';
                        document.getElementById('modalRepTelefono').value = '';
                        document.getElementById('modalRepParentesco').value = '';
                        
                        // Mostrar notificación flotante
                        Swal.fire({
                            icon: 'success',
                            title: 'Representante agregado',
                            text: 'Ya puedes seleccionarlo en el formulario',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });
                    }
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error al registrar',
                    text: response.message || 'Error al registrar representante',
                    confirmButtonColor: '#3085d6'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error de conexión',
                text: 'No se pudo conectar con el servidor. Verifique su conexión.',
                confirmButtonColor: '#3085d6'
            });
        })
        .finally(() => {
            // Restaurar botón
            btn.innerHTML = originalText;
            btn.disabled = false;
        });
    };
    
    // Cargar representantes al iniciar (usando fetch)
    function cargarRepresentantesDirecto() {
        console.log("Cargando representantes...");
        
        // Mostrar loading en el select
        const select = document.getElementById('idRepresentante');
        if (select) {
            select.innerHTML = '<option value="">Cargando representantes...</option>';
        }
        
        fetch('../../controlador/ctl_representante_ajax.php?action=listar')
            .then(response => response.json())
            .then(response => {
                if (response.success && response.representantes) {
                    const select = document.getElementById('idRepresentante');
                    if (!select) return;
                    
                    select.innerHTML = '<option value="">Seleccionar representante</option>';
                    
                    if (response.representantes.length === 0) {
                        select.innerHTML = '<option value="">No hay representantes disponibles</option>';
                    } else {
                        response.representantes.forEach(function(rep) {
                            const option = document.createElement('option');
                            option.value = rep.idRepresentante;
                            option.text = rep.nombre + ' ' + rep.apellido + ' (C.I: ' + rep.cedula + ')' + (rep.parentesco ? ' - ' + rep.parentesco : '');
                            select.appendChild(option);
                        });
                    }
                    console.log("Representantes cargados:", response.representantes.length);
                } else {
                    console.error('Error en respuesta:', response);
                    const select = document.getElementById('idRepresentante');
                    if (select) {
                        select.innerHTML = '<option value="">Error al cargar representantes</option>';
                    }
                }
            })
            .catch(error => {
                console.error('Error al cargar representantes:', error);
                const select = document.getElementById('idRepresentante');
                if (select) {
                    select.innerHTML = '<option value="">Error al cargar representantes</option>';
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Error de carga',
                    text: 'No se pudieron cargar los representantes',
                    confirmButtonColor: '#3085d6'
                });
            });
    }
    
    // Función para mostrar confirmación antes de guardar (opcional)
    function confirmarGuardado() {
        Swal.fire({
            title: '¿Guardar representante?',
            text: "Verifique que los datos sean correctos",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, guardar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.guardarRepresentanteDirecto();
            }
        });
    }
    
    // Eventos cuando el DOM está listo
    document.addEventListener('DOMContentLoaded', function() {
        console.log("DOM cargado - Configurando eventos");
        
        // Cargar representantes
        cargarRepresentantesDirecto();
        
        // Evento para botón agregar representante
        const btnAgregar = document.getElementById('btnAgregarRepresentante');
        if (btnAgregar) {
            btnAgregar.addEventListener('click', function(e) {
                e.preventDefault();
                // Limpiar modal
                document.getElementById('modalRepCedula').value = '';
                document.getElementById('modalRepNombre').value = '';
                document.getElementById('modalRepApellido').value = '';
                document.getElementById('modalRepCorreo').value = '';
                document.getElementById('modalRepTelefono').value = '';
                document.getElementById('modalRepParentesco').value = '';
                
                // Limpiar clases de error si existen
                document.querySelectorAll('.modal-body .is-invalid').forEach(el => {
                    el.classList.remove('is-invalid');
                });
            });
        }
        
        // Evento para botón guardar representante
        const btnGuardar = document.getElementById('btnGuardarRepresentante');
        if (btnGuardar) {
            // Remover eventos anteriores
            const newBtn = btnGuardar.cloneNode(true);
            btnGuardar.parentNode.replaceChild(newBtn, btnGuardar);
            
            newBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                console.log("Botón guardar clickeado");
                
                // Opcional: mostrar confirmación antes de guardar
                // confirmarGuardado();  // Descomentar para activar confirmación
                
                // Guardar directamente (sin confirmación)
                window.guardarRepresentanteDirecto();
                return false;
            });
            console.log("Evento del botón guardar configurado");
        } else {
            console.error("Botón btnGuardarRepresentante no encontrado");
        }
    });
</script>