<!DOCTYPE html>
<html lang="es">
<head>
    <?php include '../assets/inc/head.php'; ?>
</head>

<body>
<div class="page-container">

    <!-- SIDEBAR -->
    <?php include '../assets/inc/sidebar.php'; ?>

    <!-- HEADER -->
    <?php include '../assets/inc/header.php'; ?>

        <!-- HEADER -->
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
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="avatar">
                        <span>Lagea111</span>
                    </div>
                    <div class="profile-menu" id="profileMenu">
                        <a href="#">Configuración</a>
                        <a href="../loyaut/login.html">Cerrar sesión</a>
                    </div>
                </div>
            </div>
        </header>

    <!-- MAIN -->
    <div class="main-content">

        <!-- HEADER DEL MÓDULO -->
        <div class="catalog-header">

            <h1 class="page-title">
                <i class="fas fa-clipboard-list me-2"></i> ASISTENCIA
            </h1>

            <!-- RADIOS PRO -->
            <div style="display:flex;gap:15px;align-items:center">

                <label>
                    <input type="radio" name="tipo" value="entrenador" checked>
                    Entrenadores
                </label>

                <label>
                    <input type="radio" name="tipo" value="alumno">
                    Alumnos
                </label>

            </div>

            <a id="btnRegistrar" href="insert_asistenciaentrenador.html" class="btn btn-custom">
                <i class="fas fa-plus-circle me-2"></i> Nueva Asistencia
            </a>

        </div>

        <!-- TABLA ENTRENADOR -->
        <div class="table-responsive" id="tablaEntrenador">

            <table class="table alumno-table">

                <thead>
                    <tr>
                        <th>Entrenador</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>José Pérez</td>
                        <td>
                            <a class="btn btn-sm btn-secondary" href="./detalle_asistenciaentrenador.html"><i class="fas fa-eye"></i></a>
                            <a class="btn btn-sm btn-primary" href="./edit_asistenciaentrenador.html"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-sm btn-danger btn-delete" data-id="1" data-nombre="Ajedrez Básico">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>María Gómez</td>
                        <td>
                            <a class="btn btn-sm btn-secondary" href="./detalle_asistenciaentrenador.html"><i class="fas fa-eye"></i></a>
                            <a class="btn btn-sm btn-primary" href="./edit_asistenciaentrenador.html"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-sm btn-danger btn-delete" data-id="1" data-nombre="Ajedrez Básico">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

        <!-- TABLA ALUMNOS -->
        <div class="table-responsive" id="tablaAlumno" style="display:none">

            <table class="table alumno-table">

                <thead>
                    <tr>
                        <th>Alumno</th>
                        <th>Acciones</th>
                    </tr>
                </thead>

                <tbody>

                    <tr>
                        <td>Carlos Ruiz</td>
                        <td>
                            <a class="btn btn-sm btn-secondary" href="./detalle_asistenciaalumnos.html"><i class="fas fa-eye"></i></a>
                            <a class="btn btn-sm btn-primary" href="./edit_asistenciaalumnos.html"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-sm btn-danger btn-delete" data-id="1" data-nombre="Ajedrez Básico">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>

                    <tr>
                        <td>Laura Díaz</td>
                        <td>
                            <a class="btn btn-sm btn-secondary" href="./detalle_asistenciaalumnos.html"><i class="fas fa-eye"></i></a>
                            <a class="btn btn-sm btn-primary" href="./edit_asistenciaalumnos.html"><i class="fas fa-edit"></i></a>
                            <button class="btn btn-sm btn-danger btn-delete" data-id="1" data-nombre="Ajedrez Básico">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

<script src="../assets/js/jquery-3.6.0.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../assets/js/sidebar.js"></script>
<script src="../assets/js/sweetalert2.all.min.js"></script>

<!-- JS CONTROLADOR -->
<script>
document.addEventListener("DOMContentLoaded", function () {

    const radios = document.querySelectorAll("input[name='tipo']");
    const tablaEntrenador = document.getElementById("tablaEntrenador");
    const tablaAlumno = document.getElementById("tablaAlumno");
    const btn = document.getElementById("btnRegistrar");

    function cambiar(tipo){

        if(tipo === "entrenador"){
            tablaEntrenador.style.display = "block";
            tablaAlumno.style.display = "none";
            btn.href = "insert_asistenciaentrenador.html";
        }

        if(tipo === "alumno"){
            tablaEntrenador.style.display = "none";
            tablaAlumno.style.display = "block";
            btn.href = "insert_asistenciaalumnos.html";
        }
    }

    radios.forEach(r => {
        r.addEventListener("change", function(){
            cambiar(this.value);
        });
    });

    cambiar("entrenador");

});
</script>

</body>
</html>