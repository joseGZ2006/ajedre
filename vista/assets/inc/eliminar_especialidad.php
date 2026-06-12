
<script>
document.addEventListener('DOMContentLoaded', function() {
    const botonesEliminar = document.querySelectorAll('.btn-delete');
    
    botonesEliminar.forEach((boton) => {
        boton.addEventListener('click', function(e) {
            e.preventDefault();
            const nombre = this.getAttribute('data-nombre');
            const idEspecialidad = this.getAttribute('data-idEspecialidad');
            
            Swal.fire({
                title: '¿Eliminar especialidad?',
                text: `¿Estás seguro de que deseas eliminar la especialidad "${nombre}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `../../controlador/ctl_especialidad.php?E=eli&I=${btoa(idEspecialidad)}`;
                }
            });
        });
    });
});
</script>
