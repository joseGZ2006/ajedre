<?php
// Mostrar mensajes flash
if(isset($_SESSION['flash'])) {
    echo "<script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: '{$_SESSION['flash']['icon']}',
                title: '{$_SESSION['flash']['title']}',
                html: '{$_SESSION['flash']['text']}',
                confirmButtonColor: '#3085d6'
            });
        });
    </script>";
    unset($_SESSION['flash']);
}
?>