  // Función para calcular edad a partir de fecha de nacimiento
        function calcularEdad(fechaNacimiento) {
            const hoy = new Date();
            const fechaNac = new Date(fechaNacimiento);
            let edad = hoy.getFullYear() - fechaNac.getFullYear();
            const mesDiff = hoy.getMonth() - fechaNac.getMonth();
            if (mesDiff < 0 || (mesDiff === 0 && hoy.getDate() < fechaNac.getDate())) {
                edad--;
            }
            return edad;
        }

        // Función para calcular categoría según edad
        function calcularCategoriaPorEdad() {
            const fechaNac = document.getElementById('fechaNacimiento').value;
            if (!fechaNac) return;
            
            const edad = calcularEdad(fechaNac);
            document.getElementById('edad').value = edad + ' años';
            
            let categoria = '';
            if (edad <= 6) categoria = 'Sub-6';
            else if (edad <= 7) categoria = 'Sub-7';
            else if (edad <= 8) categoria = 'Sub-8';
            else if (edad <= 9) categoria = 'Sub-9';
            else if (edad <= 10) categoria = 'Sub-10';
            else if (edad <= 11) categoria = 'Sub-11';
            else if (edad <= 12) categoria = 'Sub-12';
            else if (edad <= 13) categoria = 'Sub-13';
            else if (edad <= 14) categoria = 'Sub-14';
            else if (edad <= 15) categoria = 'Sub-15';
            else if (edad <= 16) categoria = 'Sub-16';
            else if (edad <= 17) categoria = 'Sub-17';
            else if (edad <= 18) categoria = 'Sub-18';
            else if (edad <= 19) categoria = 'Sub-19';
            else if (edad <= 20) categoria = 'Sub-20';
            else categoria = 'Abierta';
            
            const categoriaSelect = document.getElementById('categoria');
            for (let i = 0; i < categoriaSelect.options.length; i++) {
                if (categoriaSelect.options[i].value === categoria) {
                    categoriaSelect.selectedIndex = i;
                    break;
                }
            }
            
            // Verificar si es menor de edad (menor a 18 años)
            const esMenor = edad < 18;
            const representanteContainer = document.getElementById('representanteContainer');
            if (representanteContainer) {
                representanteContainer.style.display = esMenor ? 'block' : 'none';
            }
        }

        // Función para construir dirección completa
        function construirDireccionCompleta() {
            const urbanizacion = document.getElementById('urbanizacion').value;
            const calle = document.getElementById('calle').value;
            const casa = document.getElementById('casa').value;
            
            let direccionCompleta = '';
            if (urbanizacion) direccionCompleta += urbanizacion;
            if (calle) direccionCompleta += (direccionCompleta ? ', ' : '') + calle;
            if (casa) direccionCompleta += (direccionCompleta ? ', ' : '') + casa;
            
            document.getElementById('direccion').value = direccionCompleta;
        }

        // Función para mostrar/ocultar campos de estudio
        function toggleCamposEstudio() {
            const estudiaSi = document.getElementById('estudiaSi').checked;
            const camposEstudio = document.getElementById('camposEstudio');
            camposEstudio.style.display = estudiaSi ? 'block' : 'none';
        }

        // Función para mostrar/ocultar campos de deporte
        function toggleCamposDeporte() {
            const deporteSi = document.getElementById('deporteSi').checked;
            const camposDeporte = document.getElementById('camposDeporte');
            camposDeporte.style.display = deporteSi ? 'block' : 'none';
        }

        // Función de validación completa
        function validarFormularioCompleto(event) {
            event.preventDefault();
            
            let esValido = true;
            
            // Validar campos requeridos
            const camposRequeridos = ['cedula', 'nombre', 'apellido', 'fechaNacimiento', 'lugarNacimiento', 'ciudad', 'localidad'];
            const sexoSeleccionado = document.querySelector('input[name="sexo"]:checked');
            
            camposRequeridos.forEach(campo => {
                const elemento = document.getElementById(campo);
                if (elemento && !elemento.value.trim()) {
                    mostrarError(campo, 'Este campo es requerido');
                    esValido = false;
                } else if (elemento) {
                    limpiarError(campo);
                }
            });
            
            if (!sexoSeleccionado) {
                mostrarError('sexo', 'Debe seleccionar un sexo');
                esValido = false;
            } else {
                limpiarError('sexo');
            }
            
            // Validar cédula (10 dígitos)
            const cedula = document.getElementById('cedula').value;
            if (cedula && !/^\d{7,10}$/.test(cedula)) {
                mostrarError('cedula', 'La cédula debe tener entre 7 y 10 dígitos numéricos');
                esValido = false;
            }
            
            // Validar categoría
            const categoria = document.getElementById('categoria').value;
            if (!categoria) {
                mostrarError('categoria', 'Debe seleccionar una categoría');
                esValido = false;
            }
            
            // Validar dirección completa
            const direccion = document.getElementById('direccion').value;
            if (!direccion) {
                mostrarError('direccion', 'Debe completar la dirección');
                esValido = false;
            }
            
            // Validar representante si es menor de edad
            const fechaNac = document.getElementById('fechaNacimiento').value;
            if (fechaNac) {
                const edad = calcularEdad(fechaNac);
                if (edad < 18) {
                    const representante = document.getElementById('representante').value;
                    if (!representante) {
                        mostrarError('representante', 'Por ser menor de edad, debe seleccionar un representante');
                        esValido = false;
                    }
                }
            }
            
            if (esValido) {
                Swal.fire({
                    title: '¡Registro exitoso!',
                    text: 'El alumno ha sido registrado correctamente.',
                    icon: 'success',
                    confirmButtonText: 'Aceptar'
                }).then(() => {
                    document.getElementById('formAlumno').reset();
                    document.getElementById('camposEstudio').style.display = 'none';
                    document.getElementById('camposDeporte').style.display = 'none';
                    document.getElementById('representanteContainer').style.display = 'none';
                });
            }
            
            return esValido;
        }
        
        function mostrarError(campoId, mensaje) {
            const feedbackDiv = document.getElementById(campoId + 'Feedback');
            if (feedbackDiv) {
                feedbackDiv.textContent = mensaje;
                feedbackDiv.style.display = 'block';
            }
            const inputElement = document.getElementById(campoId);
            if (inputElement) {
                inputElement.classList.add('is-invalid');
            }
        }
        
        function limpiarError(campoId) {
            const feedbackDiv = document.getElementById(campoId + 'Feedback');
            if (feedbackDiv) {
                feedbackDiv.textContent = '';
                feedbackDiv.style.display = 'none';
            }
            const inputElement = document.getElementById(campoId);
            if (inputElement) {
                inputElement.classList.remove('is-invalid');
            }
        }
        
        // Event listeners
        document.getElementById('urbanizacion')?.addEventListener('input', construirDireccionCompleta);
        document.getElementById('calle')?.addEventListener('input', construirDireccionCompleta);
        document.getElementById('casa')?.addEventListener('input', construirDireccionCompleta);
        document.getElementById('fechaNacimiento')?.addEventListener('change', calcularCategoriaPorEdad);
        
        // Inicializar
        window.toggleCamposEstudio = toggleCamposEstudio;
        window.toggleCamposDeporte = toggleCamposDeporte;
        window.calcularCategoriaPorEdad = calcularCategoriaPorEdad;
        window.validarFormularioCompleto = validarFormularioCompleto;