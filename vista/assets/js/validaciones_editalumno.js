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
        input.classList.remove('is-valid');
        input.classList.remove('is-invalid');
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

        letras: /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]{2,50}$/,

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
    const sexo = document.getElementById('sexo');
    const telefono = document.getElementById('telefono');
    const correo = document.getElementById('correo');
    const categoria = document.getElementById('categoria');
    const localidad = document.getElementById('localidad');
    const direccion = document.getElementById('direccion');

    const institucion = document.getElementById('dondeEstudia');
    const grado = document.getElementById('grado');
    const seccion = document.getElementById('seccion');

    const deporte = document.getElementById('deporte');
    const controlInicio = document.getElementById('controlInicioDeportivo');

    const representante = document.getElementById('representante');
    const representanteContainer = document.getElementById('representanteContainer');

    // =========================
    // FECHAS
    // =========================

    fechaNacimiento.min = "1926-01-01";
    fechaNacimiento.max = "2026-12-31";

    // =========================
    // REPRESENTANTE POR EDAD
    // =========================

    function verificarEdad() {

        if (!fechaNacimiento.value) return;

        const fecha = new Date(fechaNacimiento.value);
        const hoy = new Date();

        let edad = hoy.getFullYear() - fecha.getFullYear();

        const mes = hoy.getMonth() - fecha.getMonth();

        if (mes < 0 || (mes === 0 && hoy.getDate() < fecha.getDate())) {
            edad--;
        }
        if (edad < 18) {
            representanteContainer.style.display = 'block';
        }
        else {
            representanteContainer.style.display = 'none';
        }
    }

    function getSexoValue() {
        if (sexo && sexo.value !== '') return sexo.value;
        return '';
    }

    fechaNacimiento.addEventListener('change', verificarEdad);

    // =========================
    // VALIDACIONES EN TIEMPO REAL
    // =========================

    cedula.addEventListener('input', function() {

        this.value = this.value.replace(/[^0-8]/g, '');

        if (this.value.length === 0) return clearValidation(this);

        if (!regex.cedula.test(this.value)) {
            showError(this, 'Debe contener 7 u 8 números');
        } else {
            showValid(this);
        }
    });

    nombre.addEventListener('input', function() {

        this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '');

        if (this.value.trim().length === 0) {
            showError(this, 'El nombre es requerido');
        }
        else if (this.value.trim().length < 2 || this.value.trim().length > 50) {
            showError(this, 'El nombre debe tener entre 2 y 50 caracteres');
        }
        else if (!regex.letras.test(this.value)) {
            showError(this, 'El nombre solo puede contener letras');
        }
        else {
            showValid(this);
        }
    });

    apellido.addEventListener('input', function() {

        this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '');
        
        if (this.value.trim().length === 0) {
            showError(this, 'El apellido es requerido');
        }
        else if (this.value.trim().length < 2 || this.value.trim().length > 50) {
            showError(this, 'El apellido debe tener entre 2 y 50 caracteres');
        }
        else if (!regex.letras.test(this.value)) {
            showError(this, 'El apellido solo puede contener letras');
        }
        else {
            showValid(this);
        }
    });

    telefono.addEventListener('input', function() {

        this.value = formatTelefono(this.value);

        if (this.value.trim() === '') {
            clearValidation(this);
        }
        else if (!regex.telefono.test(this.value)) {
            showError(this, 'El teléfono debe tener el formato: 0412-1234567');
        }
        else {
            showValid(this);
        }
    });

    correo.addEventListener('input', function() {

        if (this.value.trim() === '') {
            clearValidation(this);
        }
        else if (!regex.correo.test(this.value)) {
            showError(this, 'El correo electrónico no es válido');
        }
        else {
            showValid(this);
        }
    });

    institucion.addEventListener('input', function() {

        if (this.value.trim().length === 0) {
            showError(this, 'La institución es obligatoria');
        } else {
            showValid(this);
        }
    });

    grado.addEventListener('input', function() {

        if (this.value.trim().length === 0) {
            showError(this, 'El grado es obligatorio');
        } else {
            showValid(this);
        }
    });

    seccion.addEventListener('input', function() {

        if (this.value.trim().length === 0) {
            showError(this, 'La sección es obligatoria');
        } else {
            showValid(this);
        }
    });

    // =========================
    // VALIDAR FORMULARIO
    // =========================

    window.validarFormularioCompleto = function(event) {
        let valido = true;

        // CÉDULA
        if (!regex.cedula.test(cedula.value)) {
            showError(cedula, 'Cédula inválida');
            valido = false;
        }

        // NOMBRE
        if (nombre.value.trim() === '' || nombre.value.trim().length < 2 || nombre.value.trim().length > 50 || !regex.letras.test(nombre.value)) {
            showError(nombre, 'Nombre obligatorio');
            valido = false;
        }

        // APELLIDO
        if (apellido.value.trim() === '' || apellido.value.trim().length < 2 || apellido.value.trim().length > 50 || !regex.letras.test(apellido.value)) {
            showError(apellido, 'Apellido obligatorio');
            valido = false;
        }

        // FECHA
        if (fechaNacimiento.value === '') {
            showError(fechaNacimiento, 'Seleccione fecha');
            valido = false;
        }

        // SEXO
        if (getSexoValue() === '') {
            Swal.fire({
                icon: 'error',
                title: 'Campo requerido',
                text: 'Seleccione sexo'
            });
            valido = false;
        }

        // TELÉFONO
        if (telefono.value.trim() !== '' && !regex.telefono.test(telefono.value)) {
            showError(telefono, 'Teléfono inválido');
            valido = false;
        }

        // CORREO
        if (correo.value.trim() !== '' && !regex.correo.test(correo.value)) {
            showError(correo, 'Correo inválido');
            valido = false;
        }

        // CATEGORÍA
        if (categoria.value === '') {
            showError(categoria, 'Seleccione categoría');
            valido = false;
        }

        // LOCALIDAD
        if (localidad.value === '') {
            showError(localidad, 'Seleccione localidad');
            valido = false;
        }

        // INSTITUCIÓN
        if (institucion.value.trim() === '') {
            showError(institucion, 'Institución obligatoria');
            valido = false;
        }

        // GRADO
        if (grado.value.trim() === '') {
            showError(grado, 'Grado obligatorio');
            valido = false;
        }

        // SECCIÓN
        if (seccion.value.trim() === '') {
            showError(seccion, 'Sección obligatoria');
            valido = false;
        }

        // DEPORTE
        if (deporte && deporte.value === '') {
            showError(deporte, 'Seleccione deporte');
            valido = false;
        }

        if (controlInicio && controlInicio.value.trim() === '') {
            showError(controlInicio, 'Ingrese control deportivo');
            valido = false;
        }

        // DIRECCIÓN
        if (direccion.value.trim() === '') {
            showError(direccion, 'Ingrese dirección');
            valido = false;
        }

        // REPRESENTANTE
        if (representanteContainer && representanteContainer.style.display === 'block') {
            if (representante.value === '') {
                showError(representante, 'Seleccione representante');
                valido = false;
            }
        }

        if (!valido) {
            event.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Campos incompletos',
                text: 'Debe completar todos los campos obligatorios'
            });
            return false;
        }

        event.preventDefault();
        const form = event.target;
        Swal.fire({
            icon: 'success',
            title: '¡Registro exitoso!',
            text: 'Los datos del alumno se han actualizado correctamente.',
            confirmButtonText: 'Aceptar'
        }).then(() => {
            if (form) form.submit();
        });
        return false;
    };

});