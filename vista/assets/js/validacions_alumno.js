// Variables globales
let cedulaTimeout = null;

document.addEventListener('DOMContentLoaded', function() {

    // =========================
    // FUNCIONES AUXILIARES
    // =========================

    function showError(input, message) {
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');
        const feedback = document.getElementById(input.id + 'Feedback');
        if (feedback) {
            feedback.textContent = message;
            feedback.classList.remove('valid-feedback-real');
            feedback.classList.add('invalid-feedback-real');
        }
    }

    function showValid(input) {
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
        const feedback = document.getElementById(input.id + 'Feedback');
        if (feedback) {
            feedback.textContent = '✓ Campo válido';
            feedback.classList.remove('invalid-feedback-real');
            feedback.classList.add('valid-feedback-real');
        }
    }

    function clearValidation(input) {
        input.classList.remove('is-invalid');
        input.classList.remove('is-valid');
        const feedback = document.getElementById(input.id + 'Feedback');
        if (feedback) {
            feedback.textContent = '';
            feedback.classList.remove('invalid-feedback-real');
            feedback.classList.remove('valid-feedback-real');
        }
    }

    // =========================
    // EXPRESIONES REGULARES
    // =========================

    const regex = {
        cedula: /^\d{7,10}$/,
        letras: /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/,
        telefono: /^\d{4}-\d{7}$/,
        correo: /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    };

    function formatTelefono(value) {
        const digits = value.replace(/\D/g, '');
        if (digits.length <= 4) return digits;
        return digits.slice(0, 4) + '-' + digits.slice(4, 11);
    }

    // =========================
    // INPUTS
    // =========================

    const cedula = document.getElementById('cedula');
    const nombre = document.getElementById('nombre');
    const apellido = document.getElementById('apellido');
    const fechaNacimiento = document.getElementById('fechaNacimiento');
    const telefono = document.getElementById('telefono');
    const correo = document.getElementById('correo');
    const categoria = document.getElementById('categoria');
    const localidadMunicipio = document.getElementById('localidadMunicipio');
    const direccion = document.getElementById('direccion');
    const idRepresentante = document.getElementById('idRepresentante');
    const dondeEstudia = document.getElementById('dondeEstudia');
    const grado = document.getElementById('grado');
    const seccion = document.getElementById('seccion');
    const deporteInput = document.getElementById('deporte');
    const centroIniciacionDeportivo = document.getElementById('centroIniciacionDeportivo');

    // =========================
    // SEXO CON RADIO BUTTONS
    // =========================
    const sexoM = document.getElementById('sexoM');
    const sexoF = document.getElementById('sexoF');

    function getSexoValue() {
        if (sexoM && sexoM.checked) return 'M';
        if (sexoF && sexoF.checked) return 'F';
        return '';
    }

    // =========================
    // MOSTRAR REPRESENTANTE SI ES MENOR DE EDAD
    // =========================

    const representanteContainer = document.getElementById('representanteContainer');

    function verificarEdad() {
        if (!fechaNacimiento || !fechaNacimiento.value) {
            if (representanteContainer) representanteContainer.style.display = 'none';
            return;
        }

        const fechaNac = new Date(fechaNacimiento.value);
        const hoy = new Date();
        let edad = hoy.getFullYear() - fechaNac.getFullYear();
        const mesDiff = hoy.getMonth() - fechaNac.getMonth();
        
        if (mesDiff < 0 || (mesDiff === 0 && hoy.getDate() < fechaNac.getDate())) {
            edad--;
        }

        // Actualizar campo edad si existe
        const edadField = document.getElementById('edad');
        if (edadField) edadField.value = edad;

        // Calcular categoría
        calcularCategoria(edad);

        // Mostrar/ocultar representante (menor de 18 años)
        if (representanteContainer) {
            if (edad < 18) {
                representanteContainer.style.display = 'block';
            } else {
                representanteContainer.style.display = 'none';
                if (idRepresentante) clearValidation(idRepresentante);
            }
        }
    }

    function calcularCategoria(edad) {
        if (!categoria) return;
        
        let cat = '';
        if (edad < 6) cat = 'Sub-6';
        else if (edad <= 7) cat = 'Sub-7';
        else if (edad <= 8) cat = 'Sub-8';
        else if (edad <= 9) cat = 'Sub-9';
        else if (edad <= 10) cat = 'Sub-10';
        else if (edad <= 11) cat = 'Sub-11';
        else if (edad <= 12) cat = 'Sub-12';
        else if (edad <= 13) cat = 'Sub-13';
        else if (edad <= 14) cat = 'Sub-14';
        else if (edad <= 15) cat = 'Sub-15';
        else if (edad <= 16) cat = 'Sub-16';
        else if (edad <= 17) cat = 'Sub-17';
        else if (edad <= 18) cat = 'Sub-18';
        else if (edad <= 19) cat = 'Sub-19';
        else if (edad <= 20) cat = 'Sub-20';
        else cat = 'Abierta';
        
        categoria.value = cat;
    }

   window.calcularCategoriaPorEdad = function() {
    const fechaNacimiento = document.getElementById('fechaNacimiento');
    const categoria = document.getElementById('categoria');
    const edadField = document.getElementById('edad');
    const representanteContainer = document.getElementById('representanteContainer');
    const idRepresentante = document.getElementById('idRepresentante');
    
    if (!fechaNacimiento || !fechaNacimiento.value) {
        if (edadField) edadField.value = '';
        if (representanteContainer) representanteContainer.style.display = 'none';
        return;
    }

    const fechaNac = new Date(fechaNacimiento.value);
    const hoy = new Date();
    let edad = hoy.getFullYear() - fechaNac.getFullYear();
    const mesDiff = hoy.getMonth() - fechaNac.getMonth();
    
    if (mesDiff < 0 || (mesDiff === 0 && hoy.getDate() < fechaNac.getDate())) {
        edad--;
    }

    if (edadField) edadField.value = edad;

    let cat = '';
    if (edad < 6) cat = 'Sub-6';
    else if (edad <= 7) cat = 'Sub-7';
    else if (edad <= 8) cat = 'Sub-8';
    else if (edad <= 9) cat = 'Sub-9';
    else if (edad <= 10) cat = 'Sub-10';
    else if (edad <= 11) cat = 'Sub-11';
    else if (edad <= 12) cat = 'Sub-12';
    else if (edad <= 13) cat = 'Sub-13';
    else if (edad <= 14) cat = 'Sub-14';
    else if (edad <= 15) cat = 'Sub-15';
    else if (edad <= 16) cat = 'Sub-16';
    else if (edad <= 17) cat = 'Sub-17';
    else if (edad <= 18) cat = 'Sub-18';
    else if (edad <= 19) cat = 'Sub-19';
    else if (edad <= 20) cat = 'Sub-20';
    else cat = 'Abierta';
    
    if (categoria) categoria.value = cat;

    if (representanteContainer) {
        if (edad < 18) {
            representanteContainer.style.display = 'block';
        } else {
            representanteContainer.style.display = 'none';
            if (idRepresentante) idRepresentante.value = '';
        }
    }
};

    if (fechaNacimiento) {
        fechaNacimiento.addEventListener('change', verificarEdad);
    }

    // =========================
    // VALIDACIÓN DE CÉDULA DUPLICADA VÍA AJAX
    // =========================

    function verificarCedulaDuplicada() {
        if (!cedula || !cedula.value || !regex.cedula.test(cedula.value)) return;
        
        if (cedulaTimeout) clearTimeout(cedulaTimeout);
        
        cedulaTimeout = setTimeout(function() {
            const cedulaVal = cedula.value;
            const idAlumno = document.getElementById('idAlumno');
            let excluir = '';
            if (idAlumno && idAlumno.value) {
                excluir = '&excluir=' + idAlumno.value;
            }
            
            $.ajax({
                url: '../../controlador/ctl_alumno.php?verificar_cedula=true&cedula=' + encodeURIComponent(cedulaVal) + excluir,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.existe) {
                        showError(cedula, 'Esta cédula ya está registrada');
                    } else if (regex.cedula.test(cedulaVal)) {
                        showValid(cedula);
                    }
                },
                error: function() {
                    console.log('Error al verificar cédula');
                }
            });
        }, 500);
    }

    if (cedula) {
        cedula.addEventListener('input', function() {
            this.value = this.value.replace(/[^0-8]/g, '');
            if (this.value.length === 0) {
                clearValidation(this);
                return;
            }
            if (!regex.cedula.test(this.value)) {
                showError(this, 'Debe contener 8 dígitos numéricos');
            } else {
                verificarCedulaDuplicada();
            }
        });
    }

    // =========================
    // VALIDAR NOMBRE
    // =========================

    if (nombre) {
        nombre.addEventListener('input', function() {
            this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '');
            if (this.value.length === 0) {
                clearValidation(this);
                return;
            }
            if (this.value.trim().length < 2) {
                showError(this, 'Debe tener al menos 2 letras');
            } else if (!regex.letras.test(this.value)) {
                showError(this, 'Solo letras y espacios');
            } else {
                showValid(this);
            }
        });
    }

    // =========================
    // VALIDAR APELLIDO
    // =========================

    if (apellido) {
        apellido.addEventListener('input', function() {
            this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '');
            if (this.value.length === 0) {
                clearValidation(this);
                return;
            }
            if (this.value.trim().length < 2) {
                showError(this, 'Debe tener al menos 2 letras');
            } else if (!regex.letras.test(this.value)) {
                showError(this, 'Solo letras y espacios');
            } else {
                showValid(this);
            }
        });
    }

    // =========================
    // VALIDAR TELEFONO
    // =========================

    if (telefono) {
        telefono.addEventListener('input', function() {
            this.value = formatTelefono(this.value);
            if (this.value.length > 0 && !regex.telefono.test(this.value)) {
                showError(this, 'Formato: 0412-1234567');
            } else if (this.value.length > 0) {
                showValid(this);
            } else {
                clearValidation(this);
            }
        });
    }

    // =========================
    // VALIDAR CORREO
    // =========================

    if (correo) {
        correo.addEventListener('input', function() {
            if (this.value.length > 0 && !regex.correo.test(this.value)) {
                showError(this, 'Correo inválido');
            } else if (this.value.length > 0) {
                showValid(this);
            } else {
                clearValidation(this);
            }
        });
    }

    // =========================
    // VALIDAR SELECTS
    // =========================

    if (categoria) {
        categoria.addEventListener('change', function() {
            if (this.value === '') {
                showError(this, 'Seleccione una categoría');
            } else {
                showValid(this);
            }
        });
    }

    if (localidadMunicipio) {
        localidadMunicipio.addEventListener('change', function() {
            if (this.value === '') {
                showError(this, 'Seleccione una localidad');
            } else {
                showValid(this);
            }
        });
    }

    if (direccion) {
        direccion.addEventListener('input', function() {
            if (this.value.trim() === '') {
                clearValidation(this);
            } else {
                showValid(this);
            }
        });
    }

    if (idRepresentante) {
        idRepresentante.addEventListener('change', function() {
            if (representanteContainer && representanteContainer.style.display === 'block') {
                if (this.value === '') {
                    showError(this, 'Debe seleccionar un representante');
                } else {
                    showValid(this);
                }
            }
        });
    }

    // =========================
    // CAMPOS ESTUDIO
    // =========================

    const estudiaSi = document.getElementById('estudiaSi');
    const estudiaNo = document.getElementById('estudiaNo');
    const camposEstudio = document.getElementById('camposEstudio');

    window.toggleCamposEstudio = function() {
        if (estudiaSi && estudiaSi.checked) {
            if (camposEstudio) camposEstudio.style.display = 'block';
        } else {
            if (camposEstudio) camposEstudio.style.display = 'none';
            if (dondeEstudia) clearValidation(dondeEstudia);
            if (grado) clearValidation(grado);
            if (seccion) clearValidation(seccion);
        }
    };

    if (estudiaSi && estudiaNo) {
        estudiaSi.addEventListener('change', toggleCamposEstudio);
        estudiaNo.addEventListener('change', toggleCamposEstudio);
    }

    // =========================
    // CAMPOS DEPORTE
    // =========================

    const deporteSi = document.getElementById('deporteSi');
    const deporteNo = document.getElementById('deporteNo');
    const camposDeporte = document.getElementById('camposDeporte');

    window.toggleCamposDeporte = function() {
        if (deporteSi && deporteSi.checked) {
            if (camposDeporte) camposDeporte.style.display = 'block';
        } else {
            if (camposDeporte) camposDeporte.style.display = 'none';
            if (deporteInput) clearValidation(deporteInput);
            if (centroIniciacionDeportivo) clearValidation(centroIniciacionDeportivo);
        }
    };

    if (deporteSi && deporteNo) {
        deporteSi.addEventListener('change', toggleCamposDeporte);
        deporteNo.addEventListener('change', toggleCamposDeporte);
    }

    // =========================
    // VALIDAR FORMULARIO COMPLETO
    // =========================

    window.validarFormularioCompleto = function(event) {
        let valido = true;

        // Validar cédula
        if (cedula && !regex.cedula.test(cedula.value)) {
            showError(cedula, 'Cédula inválida (7-10 dígitos)');
            valido = false;
        }

        // Validar nombre
        if (nombre && (!nombre.value.trim() || nombre.value.trim().length < 2 || !regex.letras.test(nombre.value))) {
            showError(nombre, 'Nombre inválido');
            valido = false;
        }

        // Validar apellido
        if (apellido && (!apellido.value.trim() || apellido.value.trim().length < 2 || !regex.letras.test(apellido.value))) {
            showError(apellido, 'Apellido inválido');
            valido = false;
        }

        // Validar sexo
        if (getSexoValue() === '') {
            Swal.fire({ icon: 'error', title: 'Campo requerido', text: 'Debe seleccionar un sexo' });
            valido = false;
        }

        // Validar fecha nacimiento
        if (fechaNacimiento && fechaNacimiento.value === '') {
            showError(fechaNacimiento, 'Seleccione una fecha');
            valido = false;
        }

        // Validar categoría
        if (categoria && categoria.value === '') {
            showError(categoria, 'Seleccione una categoría');
            valido = false;
        }

        // Validar localidad
        if (localidadMunicipio && localidadMunicipio.value === '') {
            showError(localidadMunicipio, 'Seleccione una localidad');
            valido = false;
        }

        // Validar dirección
        if (direccion && direccion.value === '') {
            showError(direccion, 'Ingrese una dirección');
            valido = false;
        }

        // Validar estudia
        const estudia = document.querySelector('input[name="estudia"]:checked');
        if (!estudia) {
            Swal.fire({ icon: 'error', title: 'Campos incompletos', text: 'Debe seleccionar si estudia o no' });
            valido = false;
        } else if (estudia.value === "Si") {
            if (dondeEstudia && dondeEstudia.value.trim() === '') {
                showError(dondeEstudia, 'Ingrese institución');
                valido = false;
            }
            if (grado && grado.value.trim() === '') {
                showError(grado, 'Ingrese grado');
                valido = false;
            }
            if (seccion && seccion.value.trim() === '') {
                showError(seccion, 'Ingrese sección');
                valido = false;
            }
        }

        // Validar deporte
        const deporte = document.querySelector('input[name="practicaDeporte"]:checked');
        if (!deporte) {
            Swal.fire({ icon: 'error', title: 'Campos incompletos', text: 'Debe seleccionar si practica deporte o no' });
            valido = false;
        } else if (deporte.value === "Si") {
            if (deporteInput && deporteInput.value.trim() === '') {
                showError(deporteInput, 'Ingrese deporte');
                valido = false;
            }
            if (centroIniciacionDeportivo && centroIniciacionDeportivo.value.trim() === '') {
                showError(centroIniciacionDeportivo, 'Ingrese centro de iniciación');
                valido = false;
            }
        }

        // Validar representante si es menor de edad
        if (representanteContainer && representanteContainer.style.display === 'block' && idRepresentante && idRepresentante.value === '') {
            showError(idRepresentante, 'Debe seleccionar un representante');
            valido = false;
        }

        if (!valido) {
            if (event) event.preventDefault();
            Swal.fire({ icon: 'error', title: 'Campos incompletos', text: 'Verifique todos los campos obligatorios' });
            return false;
        }

        // Si todo está válido, enviar formulario
        if (event) {
            event.preventDefault();
            const form = event.target;
            form.submit();
        }
        return false;
    };

    // =========================
    // RESET FORMULARIO
    // =========================

    const resetBtn = document.getElementById('resetBtn');
    if (resetBtn) {
        resetBtn.addEventListener('click', function() {
            document.querySelectorAll('.form-control, .form-select').forEach(input => {
                input.classList.remove('is-valid');
                input.classList.remove('is-invalid');
            });

            document.querySelectorAll('.invalid-feedback-real, .valid-feedback-real').forEach(div => {
                div.textContent = '';
            });

            if (camposEstudio) camposEstudio.style.display = 'none';
            if (camposDeporte) camposDeporte.style.display = 'none';
            if (representanteContainer) representanteContainer.style.display = 'none';

            if (sexoM) sexoM.checked = false;
            if (sexoF) sexoF.checked = false;
            
            if (estudiaSi) estudiaSi.checked = false;
            if (estudiaNo) estudiaNo.checked = false;
            
            if (deporteSi) deporteSi.checked = false;
            if (deporteNo) deporteNo.checked = false;
        });
    }

    // Inicializar verificación de edad
    verificarEdad();
    toggleCamposEstudio();
    toggleCamposDeporte();
});