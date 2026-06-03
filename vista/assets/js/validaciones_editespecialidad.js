document.addEventListener('DOMContentLoaded', function () {

    const nombre = document.getElementById('nombre');

    function showError(input, message) {
        input.classList.add('is-invalid');
        input.classList.remove('is-valid');
        const fb = document.getElementById(input.id + 'Feedback');
        if (fb) {
            fb.textContent = message;
            fb.classList.remove('valid-feedback-real');
            fb.classList.add('invalid-feedback-real');
        }
    }

    function showValid(input) {
        input.classList.remove('is-invalid');
        input.classList.add('is-valid');
        const fb = document.getElementById(input.id + 'Feedback');
        if (fb) {
            fb.textContent = '✓ válido';
            fb.classList.remove('invalid-feedback-real');
            fb.classList.add('valid-feedback-real');
        }
    }

    function clearValidation(input) {
        input.classList.remove('is-valid');
        input.classList.remove('is-invalid');
        const fb = document.getElementById(input.id + 'Feedback');
        if (fb) {
            fb.textContent = '';
            fb.classList.remove('invalid-feedback-real');
            fb.classList.remove('valid-feedback-real');
        }
    }

    const regex = {
        letras: /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/
    };

    // TIEMPO REAL
    nombre.addEventListener('input', function () {

        this.value = this.value.replace(/[^A-Za-zÁÉÍÓÚáéíóúÑñ\s]/g, '');

        if (this.value.trim() === '') {
            clearValidation(this);
            return;
        }

        if (!regex.letras.test(this.value)) {
            showError(this, 'Solo letras y espacios');
        } else {
            showValid(this);
        }

    });

    // VALIDAR FORMULARIO
    window.validarEditarEspecialidad = function (event) {
        let valido = true;

        if (nombre.value.trim() === '') {
            showError(nombre, 'El nombre es obligatorio');
            valido = false;
        } else if (!regex.letras.test(nombre.value)) {
            showError(nombre, 'Solo letras y espacios');
            valido = false;
        }

        if (!valido) {
            event.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Campo inválido',
                text: 'Debe ingresar un nombre válido'
            });
            return false;
        }

        event.preventDefault();
        const form = event.target;
        Swal.fire({
            icon: 'success',
            title: '¡Registro exitoso!',
            text: 'La especialidad se ha actualizado correctamente.',
            confirmButtonText: 'Aceptar'
        }).then(() => {
            if (form) form.submit();
        });
        return false;
    };

    // RESET
    document.getElementById('resetBtn')
        .addEventListener('click', function () {
            nombre.classList.remove('is-valid', 'is-invalid');
            document.getElementById('nombreFeedback').textContent = '';
        });

});