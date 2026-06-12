       <header class="header">
            <div class="header-inner">
                <div style="display:flex;align-items:center;gap:16px">
                    <button class="nav-btn" id="menuToggle"><i class="fas fa-bars"></i></button>
                </div>
                <div class="header-right" style="position:relative">
                    <div class="profile-pill" id="profilePill">
                        <i class="fas fa-user"></i>
                        <span><?php echo isset($_SESSION['usu_ses']) ? htmlspecialchars($_SESSION['usu_ses']) : 'Usuario'; ?></span>
                    </div>
                    <div class="profile-menu" id="profileMenu">
                        <a class="rounded-pill" href="../usuario/cambiar_credenciales.php">Mi Perfil</a>
                        <a class="rounded-pill text-danger" href="../assets/inc/cerrar_sesion.php" onclick="return confirm('¿Está seguro que desea cerrar sesión?');">
                            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                        </a>
                    </div>
                </div>
            </div>
        </header>