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

    function validarSelect(input, message) {
        if (input.value === '') {
            showError(input, message);
        } else {
            showValid(input);
        }
    }

    function validarRequerido(input, message) {
        if (input.value.trim() === '') {
            showError(input, message);
        } else {
            showValid(input);
        }
    }

    // =========================
    // EXPRESIONES REGULARES
    // =========================

    const regex = {
        cedula: /^\d{7,10}$/,
        letras: /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/,
        telefono: /^[0-9]{4}-[0-9]{7}$/,
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
    const localidad = document.getElementById('localidad');
    const direccion = document.getElementById('direccion');
    const representante = document.getElementById('representante');
    const estadoAlumno = document.getElementById('estadoAlumno');
    const dondeEstudia = document.getElementById('dondeEstudia');
    const gradoEstudio = document.getElementById('grado');
    const seccionEstudio = document.getElementById('seccion');
    const deporteInput = document.getElementById('deporte');
    const controlInicioDeportivo = document.getElementById('controlInicioDeportivo');

    // =========================
    // SEXO CON RADIO BUTTONS
    // =========================
    const sexoM = document.getElementById('sexoM');
    const sexoF = document.getElementById('sexoF');

    function getSexoValue() {
        if (sexoM.checked) return 'M';
        if (sexoF.checked) return 'F';
        return '';
    }

    // =========================
    // MOSTRAR REPRESENTANTE SI ES MENOR DE EDAD
    // =========================

    const representanteContainer = document.getElementById('representanteContainer');

    function verificarEdad() {
        if (!fechaNacimiento.value) {
            representanteContainer.style.display = 'none';
            return;
        }

        const fechaNac = new Date(fechaNacimiento.value);
        const hoy = new Date();
        let edad = hoy.getFullYear() - fechaNac.getFullYear();
        const mesDiff = hoy.getMonth() - fechaNac.getMonth();
        
        if (mesDiff < 0 || (mesDiff === 0 && hoy.getDate() < fechaNac.getDate())) {
            edad--;
        }

        // Menor de edad: menos de 18 años
        if (edad < 18) {
            representanteContainer.style.display = 'block';
        } else {
            representanteContainer.style.display = 'none';
        }
    }

    function validarFechaNacimiento() {
        if (!fechaNacimiento.value) {
            clearValidation(fechaNacimiento);
            return;
        }

        const fechaNac = new Date(fechaNacimiento.value);
        const hoy = new Date();
        let edad = hoy.getFullYear() - fechaNac.getFullYear();
        const mesDiff = hoy.getMonth() - fechaNac.getMonth();

        if (mesDiff < 0 || (mesDiff === 0 && hoy.getDate() < fechaNac.getDate())) {
            edad--;
        }

        if (edad < 0 || edad > 120) {
            showError(fechaNacimiento, 'Fecha inválida');
        } else {
            showValid(fechaNacimiento);
        }
    }

    fechaNacimiento.addEventListener('change', function() {
        verificarEdad();
        validarFechaNacimiento();
    });

    // =========================
    // MODAL PARA AGREGAR REPRESENTANTE
    // =========================

    const btnGuardarRepresentante = document.getElementById('btnGuardarRepresentante');
    const modalRepCedula = document.getElementById('modalRepCedula');
    const modalRepNombre = document.getElementById('modalRepNombre');
    const modalRepApellido = document.getElementById('modalRepApellido');
    const modalRepTelefono = document.getElementById('modalRepTelefono');
    const modalRepParentesco = document.getElementById('modalRepParentesco');

    btnGuardarRepresentante.addEventListener('click', function() {
        const cedulaRep = modalRepCedula.value.trim();
        const nombreRep = modalRepNombre.value.trim();
        const telefonoRep = modalRepTelefono.value.trim();
        const parentescoRep = modalRepParentesco.value;

        if (!cedulaRep) {
            Swal.fire({ icon: 'error', title: 'Error', text: 'Ingrese la cédula del representante' });
            return;
        }
        if (!regex.cedula.test(cedulaRep)) {
            Swal.fire({ icon: 'error', title: 'Error', text: 'Cédula inválida (7-8 dígitos)' });
            return;
        }
        if (!nombreRep) {
            Swal.fire({ icon: 'error', title: 'Error', text: 'Ingrese el nombre del representante' });
            return;
        }
        if (!modalRepApellido.value.trim()) {
            Swal.fire({ icon: 'error', title: 'Error', text: 'Ingrese el apellido del representante' });
            return;
        }
        if (!parentescoRep) {
            Swal.fire({ icon: 'error', title: 'Error', text: 'Seleccione el parentesco del representante' });
            return;
        }

        Swal.fire({
            icon: 'success',
            title: 'Representante agregado exitosamente',
            timer: 1500,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });

        // Limpiar modal
        modalRepCedula.value = '';
        modalRepNombre.value = '';
        modalRepApellido.value = '';
        modalRepTelefono.value = '';
        modalRepParentesco.value = '';

        const modal = bootstrap.Modal.getInstance(document.getElementById('representanteModal'));
        modal.hide();
    });

    // =========================
    // VALIDAR CEDULA
    // =========================

    cedula.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
        if (this.value.length === 0) {
            clearValidation(this);
            return;
        }
        if (!regex.cedula.test(this.value)) {
            showError(this, 'Debe contener entre 7 y 8 dígitos');
        } else {
            showValid(this);
        }
    });

    // =========================
    // VALIDAR NOMBRE
    // =========================

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

    // =========================
    // VALIDAR APELLIDO
    // =========================

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

    // =========================
    // VALIDAR TELEFONO (opcional)
    // =========================

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

    // =========================
    // VALIDAR CORREO (opcional)
    // =========================

    correo.addEventListener('input', function() {
        if (this.value.length > 0 && !regex.correo.test(this.value)) {
            showError(this, 'Correo inválido');
        } else if (this.value.length > 0) {
            showValid(this);
        } else {
            clearValidation(this);
        }
    });

    categoria.addEventListener('change', function() {
        validarSelect(this, 'Seleccione una categoría');
    });

    localidad.addEventListener('change', function() {
        validarSelect(this, 'Seleccione una localidad');
    });

    direccion.addEventListener('input', function() {
        if (this.value.trim() === '') {
            clearValidation(this);
        } else {
            showValid(this);
        }
    });

    representante.addEventListener('change', function() {
        if (representanteContainer.style.display === 'block') {
            if (this.value === '') {
                showError(this, 'Debe seleccionar un representante');
            } else {
                showValid(this);
            }
        }
    });

    if (dondeEstudia) {
        dondeEstudia.addEventListener('input', function() {
            if (this.value.trim() === '') {
                clearValidation(this);
            } else {
                showValid(this);
            }
        });
    }

    if (gradoEstudio) {
        gradoEstudio.addEventListener('input', function() {
            if (this.value.trim() === '') {
                clearValidation(this);
            } else {
                showValid(this);
            }
        });
    }

    if (seccionEstudio) {
        seccionEstudio.addEventListener('input', function() {
            if (this.value.trim() === '') {
                clearValidation(this);
            } else {
                showValid(this);
            }
        });
    }

    if (deporteInput) {
        deporteInput.addEventListener('input', function() {
            if (this.value.trim() === '') {
                clearValidation(this);
            } else {
                showValid(this);
            }
        });
    }

    if (controlInicioDeportivo) {
        controlInicioDeportivo.addEventListener('input', function() {
            if (this.value.trim() === '') {
                clearValidation(this);
            } else {
                showValid(this);
            }
        });
    }

    // =========================
    // CAMPOS ESTUDIO
    // =========================

    const estudiaSi = document.getElementById('estudiaSi');
    const estudiaNo = document.getElementById('estudiaNo');
    const camposEstudio = document.getElementById('camposEstudio');

    estudiaSi.addEventListener('change', function() {
        camposEstudio.style.display = 'block';
        if (dondeEstudia && dondeEstudia.value.trim()) showValid(dondeEstudia);
        if (gradoEstudio && gradoEstudio.value.trim()) showValid(gradoEstudio);
        if (seccionEstudio && seccionEstudio.value.trim()) showValid(seccionEstudio);
    });

    estudiaNo.addEventListener('change', function() {
        camposEstudio.style.display = 'none';
        if (dondeEstudia) clearValidation(dondeEstudia);
        if (gradoEstudio) clearValidation(gradoEstudio);
        if (seccionEstudio) clearValidation(seccionEstudio);
    });

    // =========================
    // CAMPOS DEPORTE
    // =========================

    const deporteSi = document.getElementById('deporteSi');
    const deporteNo = document.getElementById('deporteNo');
    const camposDeporte = document.getElementById('camposDeporte');

    deporteSi.addEventListener('change', function() {
        camposDeporte.style.display = 'block';
        if (deporteInput && deporteInput.value.trim()) showValid(deporteInput);
        if (controlInicioDeportivo && controlInicioDeportivo.value.trim()) showValid(controlInicioDeportivo);
    });

    deporteNo.addEventListener('change', function() {
        camposDeporte.style.display = 'none';
        if (deporteInput) clearValidation(deporteInput);
        if (controlInicioDeportivo) clearValidation(controlInicioDeportivo);
    });

    // =========================
    // VALIDAR FORMULARIO COMPLETO
    // =========================

    window.validarFormularioCompleto = function(event) {
        let valido = true;

        // Validar cédula
        if (!regex.cedula.test(cedula.value)) {
            showError(cedula, 'Cédula inválida (7-8 dígitos)');
            valido = false;
        } else {
            showValid(cedula);
        }

    // Validar nombre
    if (!nombre.value.trim() || nombre.value.trim().length < 2) {
        showError(nombre, 'Nombre inválido');
        valido = false;
    } else if (!regex.letras.test(nombre.value)) {
        showError(nombre, 'Nombre inválido');
        valido = false;
    } else {
        showValid(nombre);
    }

    // Validar apellido
    if (!apellido.value.trim() || apellido.value.trim().length < 2) {
        showError(apellido, 'Apellido inválido');
        valido = false;
    } else if (!regex.letras.test(apellido.value)) {
        showError(apellido, 'Apellido inválido');
        valido = false;
    } else {
        showValid(apellido);
    }

    // Validar fecha nacimiento
    if (fechaNacimiento.value === '') {
        showError(fechaNacimiento, 'Seleccione una fecha');
        valido = false;
    } else {
        const fechaNac = new Date(fechaNacimiento.value);
        const hoy = new Date();
        let edad = hoy.getFullYear() - fechaNac.getFullYear();
        const mesDiff = hoy.getMonth() - fechaNac.getMonth();
        
        if (mesDiff < 0 || (mesDiff === 0 && hoy.getDate() < fechaNac.getDate())) {
            edad--;
        }
        
        if (edad < 0 || edad > 120) {
            showError(fechaNacimiento, 'Fecha inválida');
            valido = false;
        } else {
            showValid(fechaNacimiento);
        }
    }

    

    // Validar sexo (radio button)
    if (getSexoValue() === '') {
        Swal.fire({ 
            icon: 'error', 
            title: 'Campo requerido', 
            text: 'Debe seleccionar un sexo' 
        });
        valido = false;
    }

    // Validar categoría
    if (categoria.value === '') {
        showError(categoria, 'Seleccione una categoría');
        valido = false;
    } else {
        showValid(categoria);
    }

    // Validar localidad
    if (localidad.value === '') {
        showError(localidad, 'Seleccione una localidad');
        valido = false;
    } else {
        showValid(localidad);
    }

    // Validar dirección
    if (direccion.value === '') {
        showError(direccion, 'Ingrese una dirección');
        valido = false;
    } else {
        showValid(direccion);
    }

    // Validar estudia
    const estudia = document.querySelector('input[name="estudia"]:checked');
    if (!estudia) {
        Swal.fire({ icon: 'error', title: 'Campos incompletos', text: 'Debe seleccionar si estudia o no' });
        return false;
    }

    if (estudia.value === "Si") {
        const institucion = document.getElementById('dondeEstudia');
        const grado = document.getElementById('grado');
        const seccion = document.getElementById('seccion');

        if (institucion.value.trim() === '') {
            showError(institucion, 'Ingrese institución');
            valido = false;
        } else {
            showValid(institucion);
        }
        
        if (grado.value.trim() === '') {
            showError(grado, 'Ingrese grado');
            valido = false;
        } else {
            showValid(grado);
        }
        
        if (seccion.value.trim() === '') {
            showError(seccion, 'Ingrese sección');
            valido = false;
        } else {
            showValid(seccion);
        }
    }

    // Validar deporte
    const deporte = document.querySelector('input[name="practicaDeporte"]:checked');
    if (!deporte) {
        Swal.fire({ icon: 'error', title: 'Campos incompletos', text: 'Debe seleccionar si practica deporte o no' });
        return false;
    }

    if (deporte.value === "Si") {
        const deporteInput = document.getElementById('deporte');
        const controlInicio = document.getElementById('controlInicioDeportivo');

        if (deporteInput.value.trim() === '') {
            showError(deporteInput, 'Ingrese deporte');
            valido = false;
        } else {
            showValid(deporteInput);
        }
        
        if (controlInicio.value.trim() === '') {
            showError(controlInicio, 'Ingrese control de inicio');
            valido = false;
        } else {
            showValid(controlInicio);
        }
    }

    // Validar representante si es menor de edad y el contenedor está visible
    if (representanteContainer.style.display === 'block' && representante.value === '') {
        showError(representante, 'Debe seleccionar un representante');
        valido = false;
    } else if (representanteContainer.style.display === 'block' && representante.value !== '') {
        showValid(representante);
    }

    if (!valido) {
        event.preventDefault();
        Swal.fire({ icon: 'error', title: 'Campos incompletos', text: 'Verifique todos los campos obligatorios' });
        return false;
    }

    event.preventDefault();
    const form = event.target;
    Swal.fire({
        icon: 'success',
        title: '¡Registro exitoso!',
        text: 'El alumno ha sido registrado correctamente.',
        confirmButtonText: 'Aceptar'
    }).then(() => {
        if (form) form.submit();
    });
    return false;
};

    // =========================
    // RESET FORMULARIO
    // =========================

    const resetBtn = document.getElementById('resetBtn');

    resetBtn.addEventListener('click', function() {
        document.querySelectorAll('.form-control, .form-select').forEach(input => {
            input.classList.remove('is-valid');
            input.classList.remove('is-invalid');
        });

        document.querySelectorAll('.invalid-feedback-real').forEach(div => {
            div.textContent = '';
        });

        camposEstudio.style.display = 'none';
        camposDeporte.style.display = 'none';
        representanteContainer.style.display = 'none';

        // Resetear radio buttons
        sexoM.checked = false;
        sexoF.checked = false;
        estudiaSi.checked = false;
        estudiaNo.checked = false;
        deporteSi.checked = false;
        deporteNo.checked = false;

        // Resetear selects a valor por defecto
        if (estadoAlumno) {
            estadoAlumno.value = 'Activo';
        }
    });

    // Inicializar verificación de edad al cargar
    verificarEdad();
});

  