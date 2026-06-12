<script>
document.addEventListener('DOMContentLoaded', function() {
   // Eliminación
    const botonesEliminar = document.querySelectorAll('.btn-delete');
    
    botonesEliminar.forEach((boton) => {
        boton.addEventListener('click', function(e) {
            e.preventDefault();
            const nombre = this.getAttribute('data-nombre');
            const cedula = this.getAttribute('data-cedula');
            
            Swal.fire({
                title: '¿Eliminar entrenador?',
                text: `¿Estás seguro de que deseas eliminar al entrenador "${nombre}"?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = `../../controlador/ctl_entrenador.php?E=eli&I=${btoa(cedula)}`;
                }
            });
        });
    });
});
</script>