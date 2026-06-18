<header class="header">
    <div class="header-inner">
        <div style="display:flex;align-items:center;gap:16px">
            <button class="nav-btn" id="menuToggle"><i class="fas fa-bars"></i></button>
        </div>
        <div class="header-right" >
            <div class="profile-pill" id="profilePill">
                <i class="fas fa-user"></i>
                <span><?php echo isset($_SESSION['usu_ses']) ? htmlspecialchars($_SESSION['usu_ses']) : 'Usuario'; ?></span>
            </div>
            <div class="profile-menu" id="profileMenu">
                <a class="rounded-pill" href="../usuario/cambiar_credenciales.php">Mi Perfil</a>
                <a class="rounded-pill text-danger" href="#" id="btnCerrarSesion">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </a>
            </div>
        </div>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toggle del menú de perfil
    const profilePill = document.getElementById('profilePill');
    const profileMenu = document.getElementById('profileMenu');
    
    

    // Cerrar sesión con SweetAlert2
    const btnCerrarSesion = document.getElementById('btnCerrarSesion');
    
    btnCerrarSesion.addEventListener('click', function(e) {
        e.preventDefault();
        
        Swal.fire({
            title: '¿Cerrar sesión?',
            text: '¿Estás seguro que deseas cerrar sesión?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, cerrar sesión',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Redirigir al logout
                window.location.href = '../assets/inc/cerrar_sesion.php';
            }
        });
    });
});
</script>