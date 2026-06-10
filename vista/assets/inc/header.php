       <header class="header">
            <div class="header-inner">
                <div style="display:flex;align-items:center;gap:16px">
                    <button class="nav-btn" id="menuToggle"><i class="fas fa-bars"></i></button>
                    <div class="search-form">
                        <input type="text" id="searchInput" placeholder="Buscar por nombre, ID o aula...">
                        <button class="search-btn" id="searchBtn"><i class="fas fa-search"></i></button>
                        <button class="mobile-menu-btn" id="mobileMenuBtn"><i class="fas fa-bars"></i></button>
                    </div>
                </div>
                <div class="header-right" style="position:relative">
                    <div class="profile-pill" id="profilePill">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="avatar">
                        <span><?php echo isset($_SESSION['usu_ses']) ? htmlspecialchars($_SESSION['usu_ses']) : 'Usuario'; ?></span>
                    </div>
                    <div class="profile-menu" id="profileMenu">
                        <a class="rounded-pill" href="#">Mi Perfil</a>
                        <a class="rounded-pill text-danger" href="../assets/inc/cerrar_sesion.php" onclick="return confirm('¿Está seguro que desea cerrar sesión?');">
                            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                        </a>
                    </div>
                </div>
            </div>
        </header>