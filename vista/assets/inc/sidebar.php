        <aside class="sidebar" role="navigation">
            <div class="logo" style="position: relative;">
                <img src="../assets/images/logodeajedrez.png" alt="logo">
                <div class="brand">
                    <div class="brand">Casa del Ajedrez</div>
                    <div class="muted">MN Marcos Pérez</div>
                </div>
                <button id="closeSidebarBtn" class="sidebar-close-btn" aria-label="Cerrar menú">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <nav class="menu">
                <div class="section">PRINCIPAL</div>
                    <ul class="menu-list">

                        <li class="menu-item" data-href="../loyaut/dashboard.php">
                            <div class="icon"><i class="fas fa-tachometer-alt"></i></div>
                            <div class="label">Inicio</div>
                        </li> 

                       
                        <!-- MAESTROS  -->
                      
                        
                        <!-- Usuario -->
                        <li class="menu-item" data-href="../../controlador/ctl_usuario.php?L=lis">
                            <div class="icon"><i class="fas fa-user"></i></div>
                            <div class="label">Usuario</div>
                        </li>
                        
                        <!-- Representante -->
                        <li class="menu-item" data-href="../../controlador/ctl_representante.php?L=lis">
                            <div class="icon"><i class="fas fa-users"></i></div>
                            <div class="label">Representante</div>
                        </li> 

                        <!-- Alumno -->
                        <li class="menu-item" data-href="../../controlador/ctl_alumno.php?L=lis">
                            <div class="icon"><i class="fas fa-user-graduate"></i></div>
                            <div class="label">Alumno</div>
                        </li>

                        <!-- Entrenador -->
                        <li class="menu-item" data-href="../../controlador/ctl_entrenador.php?L=lis">
                            <div class="icon"><i class="fas fa-chalkboard-user"></i></div>
                            <div class="label">Entrenador</div>
                        </li>

                        <!-- Especialidad -->
                        <li class="menu-item" data-href="../../controlador/ctl_especialidad.php?L=lis">
                            <div class="icon"><i class="fas fa-book"></i></div>
                            <div class="label">Especialidad</div>
                        </li>

                        <!-- Tipos de Torneo  -->
                        <li class="menu-item" data-href="../../controlador/ctl_tipotorneo.php?L=lis">
                            <div class="icon"><i class="fas fa-list"></i></div>
                            <div class="label">Tipos de Torneo</div>
                        </li>

                        <!-- 2. PROCESOS -->
                       

                        <!-- Clase  -->
                        <li class="menu-item" data-href="../asignacion_clase/asignacion_clase.php">
                            <div class="icon"><i class="fas fa-chess-board"></i></div>
                            <div class="label">Clase</div>
                        </li>

                        <!-- Horario de Clase  -->
                        <li class="menu-item" data-href="../horarios/horario.php">
                            <div class="icon"><i class="fas fa-calendar-alt"></i></div>
                            <div class="label">Horario de Clase</div>
                        </li>

                        <!-- Inscripciones Alumno  -->
                        <li class="menu-item" data-href="../inscripcion_alumno/inscripcion_alumno.php">
                            <div class="icon"><i class="fas fa-clipboard-list"></i></div>
                            <div class="label">Inscripciones Alumno</div>
                        </li>

                        <!-- Asistencia  -->
                        <li class="menu-item" data-href="../asistencias/asistencia.php">
                            <div class="icon"><i class="fas fa-clipboard-list"></i></div>
                            <div class="label">Asistencia</div>
                        </li>

                        <!-- Torneo  -->
                        <li class="menu-item" data-href="../../controlador/ctl_torneo.php?L=lis">
                            <div class="icon"><i class="fas fa-trophy"></i></div>
                            <div class="label">Torneo</div>
                        </li>

                        <!-- Inscripciones Torneo  -->
                        <li class="menu-item" data-href="../inscripcion_torneo/inscripcion_torneo.php">
                            <div class="icon"><i class="fas fa-clipboard-list"></i></div>
                            <div class="label">Inscripciones Torneo</div>
                        </li>
                </ul>
            </nav>
        </aside>
        <div id="sidebarOverlay" class="sidebar-overlay"></div>

