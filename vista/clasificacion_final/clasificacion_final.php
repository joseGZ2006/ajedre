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

        <!-- MAIN CONTENT -->
        <div class="main-content">
            <div class="catalog-header">
                <h1 class="page-title"><i class="fas fa-ranking-star me-2"></i> CLASIFICACIÓN FINAL DE TORNEOS</h1>
                <button class="btn btn-custom"><a href="./insert_clasificacion_final.html"><i
                            class="fas fa-plus-circle me-2"></i>Nueva Clasificación</a></button>
            </div>

            <!-- TABLA DE CLASIFICACIONES -->
            <div class="table-responsive">
                <table class="table alumno-table" id="clasificacionTable">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Torneo</th>
                            <th>Alumno</th>
                            <th>Posición</th>
                            <th>Municipio</th>
                            <th>Estatus Original</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Fila 1 -->
                        <tr>
                            <td>1</td>
                            <td>Torneo Nacional de Ajedrez 2025</td>
                            <td>Carlos Pérez</td>
                            <td><span class="badge bg-warning">🥇 1°</span></td>
                            <td>Libertador</td>
                            <td><span class="badge bg-success">Clasificado</span></td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_clasificacion_final.html?id=1"><i
                                        class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_clasificacion_final.html?id=1"><i
                                        class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="1"
                                    data-nombre="Carlos Pérez - Torneo Nacional">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Fila 2 -->
                        <tr>
                            <td>2</td>
                            <td>Torneo Nacional de Ajedrez 2025</td>
                            <td>Ana Rodríguez</td>
                            <td><span class="badge bg-secondary">🥈 2°</span></td>
                            <td>Chacao</td>
                            <td><span class="badge bg-success">Clasificado</span></td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_clasificacion_final.html?id=2"><i
                                        class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_clasificacion_final.html?id=2"><i
                                        class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="2"
                                    data-nombre="Ana Rodríguez - Torneo Nacional">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Fila 3 -->
                        <tr>
                            <td>3</td>
                            <td>Torneo Nacional de Ajedrez 2025</td>
                            <td>Luis Fernández</td>
                            <td><span class="badge bg-info">🥉 3°</span></td>
                            <td>Baruta</td>
                            <td><span class="badge bg-success">Clasificado</span></td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_clasificacion_final.html?id=3"><i
                                        class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_clasificacion_final.html?id=3"><i
                                        class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="3"
                                    data-nombre="Luis Fernández - Torneo Nacional">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Fila 4 -->
                        <tr>
                            <td>4</td>
                            <td>Campeonato Regional Centro</td>
                            <td>María González</td>
                            <td><span class="badge bg-warning">🥇 1°</span></td>
                            <td>Municipio Sucre</td>
                            <td><span class="badge bg-success">Clasificado</span></td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_clasificacion_final.html?id=4"><i
                                        class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_clasificacion_final.html?id=4"><i
                                        class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="4"
                                    data-nombre="María González - Regional Centro">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Fila 5 -->
                        <tr>
                            <td>5</td>
                            <td>Campeonato Regional Centro</td>
                            <td>José Martínez</td>
                            <td><span class="badge bg-secondary">🥈 2°</span></td>
                            <td>Municipio Sucre</td>
                            <td><span class="badge bg-warning">Suplente</span></td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_clasificacion_final.html?id=5"><i
                                        class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_clasificacion_final.html?id=5"><i
                                        class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="5"
                                    data-nombre="José Martínez - Regional Centro">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                        <!-- Fila 6 -->
                        <tr>
                            <td>6</td>
                            <td>Torneo Nacional de Ajedrez 2025</td>
                            <td>Valentina Rojas</td>
                            <td><span class="badge bg-dark">4°</span></td>
                            <td>Libertador</td>
                            <td><span class="badge bg-danger">Eliminado</span></td>
                            <td>
                                <a class="btn btn-sm btn-secondary" href="./detalle_clasificacion_final.html?id=6"><i
                                        class="fas fa-eye"></i></a>
                                <a class="btn btn-sm btn-primary" href="./edit_clasificacion_final.html?id=6"><i
                                        class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger btn-delete" data-id="6"
                                    data-nombre="Valentina Rojas - Torneo Nacional">
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
    <script>
        function confirmarEliminacion(nombreClasificacion, id) {
            Swal.fire({
                title: '¿Eliminar clasificación?',
                text: `¿Estás seguro de que deseas eliminar la clasificación "${nombreClasificacion}" con ID ${id}?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: '¡Eliminado!',
                        text: `La clasificación "${nombreClasificacion}" ha sido eliminada.`,
                        icon: 'success',
                        confirmButtonColor: '#3085d6'
                    });
                } else {
                    Swal.fire({
                        title: 'Cancelado',
                        text: 'La eliminación fue cancelada',
                        icon: 'info',
                        confirmButtonColor: '#3085d6',
                        timer: 2000,
                        showConfirmButton: false
                    });
                }
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            const botonesEliminar = document.querySelectorAll('.btn-delete');

            botonesEliminar.forEach((boton) => {
                boton.addEventListener('click', function (e) {
                    e.preventDefault();
                    const id = this.getAttribute('data-id');
                    const nombre = this.getAttribute('data-nombre');
                    confirmarEliminacion(nombre, id);
                });
            });

            // Búsqueda en tiempo real
            document.getElementById('searchInput')?.addEventListener('keyup', function (e) {
                const filter = e.target.value.toLowerCase();
                const rows = document.querySelectorAll('#clasificacionTable tbody tr');
                rows.forEach(row => {
                    const text = row.innerText.toLowerCase();
                    row.style.display = text.includes(filter) ? '' : 'none';
                });
            });

            document.getElementById('searchBtn')?.addEventListener('click', function () {
                const filter = document.getElementById('searchInput').value.toLowerCase();
                const rows = document.querySelectorAll('#clasificacionTable tbody tr');
                rows.forEach(row => {
                    const text = row.innerText.toLowerCase();
                    row.style.display = text.includes(filter) ? '' : 'none';
                });
            });
        });
    </script>
</body>

</html>