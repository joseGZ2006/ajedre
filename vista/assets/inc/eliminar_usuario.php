<script>
    function confirmarEliminacion(nombreUsuario, idEncoded) {
        Swal.fire({
            title: '¿Eliminar usuario?',
            text: `¿Estás seguro de que deseas eliminar al usuario "${nombreUsuario}"?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `../../controlador/ctl_usuario.php?E=eli&I=${idEncoded}`;
            }
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const botonesEliminar = document.querySelectorAll('.btn-delete');
        botonesEliminar.forEach((boton) => {
            boton.addEventListener('click', function(e) {
                e.preventDefault();
                const nombre = this.getAttribute('data-nombre');
                const id = this.getAttribute('data-id');
                confirmarEliminacion(nombre, id);
            });
        });
    });
</script>