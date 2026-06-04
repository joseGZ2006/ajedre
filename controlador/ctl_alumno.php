<?php
session_start();
include("../modelo/conexion.php");
include("../modelo/modelo_alumno.php");

$alumno = new Alumno();

// Función para sanitizar datos
function sanitizar($dato) {
    return htmlspecialchars(trim($dato), ENT_QUOTES, 'UTF-8');
}

// Función para validar fechas
function validarFecha($fecha) {
    $date = DateTime::createFromFormat('Y-m-d', $fecha);
    return $date && $date->format('Y-m-d') === $fecha;
}

############################################################################
### REGISTRAR ##############################################################
############################################################################
if(isset($_POST['registrar']) && $_POST['registrar']=="registrar"){
    try {
        // Sanitizar datos
        $cedula = sanitizar($_POST['cedula']);
        $nombre = sanitizar($_POST['nombre']);
        $apellido = sanitizar($_POST['apellido']);
        $sexo = sanitizar($_POST['sexo']);
        $fechaNacimiento = sanitizar($_POST['fechaNacimiento']);
        $telefono = sanitizar($_POST['telefono']);
        $localidadMunicipio = sanitizar($_POST['localidadMunicipio']);
        $correo = sanitizar($_POST['correo']);
        $club = sanitizar($_POST['club']);
        $direccion = sanitizar($_POST['direccion']);
        $dondeEstudia = sanitizar($_POST['dondeEstudia']);
        $grado = sanitizar($_POST['grado']);
        $seccion = sanitizar($_POST['seccion']);
        $deporte = sanitizar($_POST['deporte']);
        $centroIniciacionDeportivo = sanitizar($_POST['centroIniciacionDeportivo']);
        $idRepresentante = !empty($_POST['idRepresentante']) ? sanitizar($_POST['idRepresentante']) : null;
        $idUsuario = !empty($_POST['idUsuario']) ? sanitizar($_POST['idUsuario']) : null;
        $estatus = sanitizar($_POST['estatus']);

        // Validar campos requeridos
        if(empty($cedula) || empty($nombre) || empty($apellido) || empty($sexo) || empty($fechaNacimiento) || empty($estatus)) {
            throw new Exception("Todos los campos marcados con * son obligatorios.");
        }

        // Validar formato de fecha
        if(!validarFecha($fechaNacimiento)) {
            throw new Exception("Formato de fecha inválido. Use YYYY-MM-DD.");
        }
        
        // Validar representante para menores de edad
        $edad = date_diff(date_create($fechaNacimiento), date_create('today'))->y;
        if ($edad < 18 && empty($idRepresentante)) {
            throw new Exception("Los alumnos menores de 18 años deben tener un representante asignado.");
        }

        // Registrar alumno
        $datos = $alumno->RegistrarAlumno(
            $cedula, $nombre, $apellido, $sexo, $fechaNacimiento,
            $telefono, $localidadMunicipio, $correo, $club, $direccion,
            $dondeEstudia, $grado, $seccion, $deporte, $centroIniciacionDeportivo,
            $idRepresentante, $idUsuario, $estatus
        );
        
        if($datos){
            $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => 'Alumno Registrado con éxito.'];
            header("Location: ../vista/alumnos/alumno.php");
            exit;
        } else {
            throw new Exception("No se pudo registrar el alumno.");
        }
    } catch (Exception $e) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => $e->getMessage()];
        header("Location: ../vista/alumnos/insert_alumno.php");
        exit;
    }
}

############################################################################
### LISTAR #################################################################
############################################################################
if(isset($_GET['L']) && $_GET['L']=="lis"){
    try {
        $datos = $alumno->ListarAlumnos();
        
        if($datos === false || empty($datos)){
            $_SESSION['flash'] = ['icon' => 'info', 'title' => 'Información', 'text' => 'No hay alumnos registrados.'];
        } else {
            $_SESSION['lista_alumnos'] = $datos;
        }
        
        header("Location: ../vista/alumnos/alumno.php");
        exit;
    } catch (Exception $e) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => $e->getMessage()];
        header("Location: ../vista/alumnos/alumno.php");
        exit;
    }
}

############################################################################
### LISTAR POR CATEGORIA ###################################################
############################################################################
if(isset($_GET['LC']) && $_GET['LC']=="cat"){
    try {
        $categoria = isset($_GET['categoria']) ? sanitizar($_GET['categoria']) : null;
        
        if(!$categoria) {
            throw new Exception("Categoría no especificada.");
        }
        
        $datos = $alumno->ListarAlumnosPorCategoria($categoria);
        
        if($datos === false || empty($datos)){
            $_SESSION['flash'] = ['icon' => 'info', 'title' => 'Información', 'text' => "No hay alumnos en la categoría $categoria."];
        } else {
            $_SESSION['lista_alumnos'] = $datos;
        }
        
        header("Location: ../vista/alumnos/alumno.php");
        exit;
    } catch (Exception $e) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => $e->getMessage()];
        header("Location: ../vista/alumnos/alumno.php");
        exit;
    }
}

#############################################################################
### CONSULTAR ###############################################################
#############################################################################
if(isset($_GET['C']) && $_GET['C']=="con"){
    try {
        $ci = base64_decode($_GET['I']);
        
        if(!preg_match('/^[0-9]{6,10}$/', $ci)) {
            throw new Exception("Cédula no válida.");
        }
        
        $datos = $alumno->ConsultarAlumno($ci);
        
        if($datos === false){
            $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se encontró el alumno solicitado.'];
            header("Location: ../vista/alumnos/alumno.php");
            exit;
        } else {
            // Encriptar datos para enviar por URL
            $id = base64_encode($datos['idAlumno']);
            $ced = base64_encode($datos['cedula']);
            $nom = base64_encode($datos['nombre']);
            $ape = base64_encode($datos['apellido']);
            $sex = base64_encode($datos['sexo']);
            $fna = base64_encode($datos['fechaNacimiento']);
            $edad = base64_encode($datos['edad']);
            $cat = base64_encode($datos['categoria']);
            $tel = base64_encode($datos['telefono']);
            $loc = base64_encode($datos['localidadMunicipio']);
            $ema = base64_encode($datos['correo']);
            $club = base64_encode($datos['club']);
            $dir = base64_encode($datos['direccion']);
            $est = base64_encode($datos['dondeEstudia']);
            $gra = base64_encode($datos['grado']);
            $sec = base64_encode($datos['seccion']);
            $dep = base64_encode($datos['deporte']);
            $cen = base64_encode($datos['centroIniciacionDeportivo']);
            $rep = base64_encode($datos['idRepresentante']);
            $usu = base64_encode($datos['idUsuario']);
            $status = base64_encode($datos['estatus']);
            
            header("Location: ../vista/alumnos/detalle_alumno.php?id=$id&a=$ced&b=$nom&c=$ape&d=$sex&e=$fna&f=$edad&g=$cat&h=$tel&i=$loc&j=$ema&k=$club&l=$dir&m=$est&n=$gra&o=$sec&p=$dep&q=$cen&r=$rep&s=$usu&t=$status");
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => $e->getMessage()];
        header("Location: ../vista/alumnos/alumno.php");
        exit;
    }
}

############################################################################
### MOSTRAR PARA ACTUALIZAR ################################################
############################################################################
if(isset($_GET['M']) && $_GET['M']=="mos"){
    try {
        $ci = base64_decode($_GET['I']);
        
        if(!preg_match('/^[0-9]{6,10}$/', $ci)) {
            throw new Exception("Cédula no válida.");
        }
        
        $datos = $alumno->ConsultarAlumno($ci);
        
        if($datos === false){
            $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se encontró el alumno solicitado.'];
            header("Location: ../vista/alumnos/alumno.php");
            exit;
        } else {
            // Encriptar datos para enviar por URL
            $id = base64_encode($datos['idAlumno']);
            $ced = base64_encode($datos['cedula']);
            $nom = base64_encode($datos['nombre']);
            $ape = base64_encode($datos['apellido']);
            $sex = base64_encode($datos['sexo']);
            $fna = base64_encode($datos['fechaNacimiento']);
            $tel = base64_encode($datos['telefono']);
            $loc = base64_encode($datos['localidadMunicipio']);
            $ema = base64_encode($datos['correo']);
            $club = base64_encode($datos['club']);
            $dir = base64_encode($datos['direccion']);
            $est = base64_encode($datos['dondeEstudia']);
            $gra = base64_encode($datos['grado']);
            $sec = base64_encode($datos['seccion']);
            $dep = base64_encode($datos['deporte']);
            $cen = base64_encode($datos['centroIniciacionDeportivo']);
            $rep = base64_encode($datos['idRepresentante']);
            $usu = base64_encode($datos['idUsuario']);
            $status = base64_encode($datos['estatus']);
            
            header("Location: ../vista/alumnos/edit_alumno.php?id=$id&a=$ced&b=$nom&c=$ape&d=$sex&e=$fna&h=$tel&i=$loc&j=$ema&k=$club&l=$dir&m=$est&n=$gra&o=$sec&p=$dep&q=$cen&r=$rep&s=$usu&t=$status");
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => $e->getMessage()];
        header("Location: ../vista/alumnos/alumno.php");
        exit;
    }
}

############################################################################
### ACTUALIZAR #############################################################
############################################################################
if(isset($_POST['modificar']) && $_POST['modificar']=="modificar"){
    try {
        // Sanitizar datos
        $idAlumno = sanitizar($_POST['idAlumno']);
        $cedula = sanitizar($_POST['cedula']);
        $nombre = sanitizar($_POST['nombre']);
        $apellido = sanitizar($_POST['apellido']);
        $sexo = sanitizar($_POST['sexo']);
        $fechaNacimiento = sanitizar($_POST['fechaNacimiento']);
        $telefono = sanitizar($_POST['telefono']);
        $localidadMunicipio = sanitizar($_POST['localidadMunicipio']);
        $correo = sanitizar($_POST['correo']);
        $club = sanitizar($_POST['club']);
        $direccion = sanitizar($_POST['direccion']);
        $dondeEstudia = sanitizar($_POST['dondeEstudia']);
        $grado = sanitizar($_POST['grado']);
        $seccion = sanitizar($_POST['seccion']);
        $deporte = sanitizar($_POST['deporte']);
        $centroIniciacionDeportivo = sanitizar($_POST['centroIniciacionDeportivo']);
        $idRepresentante = !empty($_POST['idRepresentante']) ? sanitizar($_POST['idRepresentante']) : null;
        $idUsuario = !empty($_POST['idUsuario']) ? sanitizar($_POST['idUsuario']) : null;
        $estatus = sanitizar($_POST['estatus']);

        // Validar campos requeridos
        if(empty($idAlumno) || empty($cedula) || empty($nombre) || empty($apellido) || empty($sexo) || empty($fechaNacimiento) || empty($estatus)) {
            throw new Exception("Todos los campos marcados con * son obligatorios.");
        }

        // Validar formato de fecha
        if(!validarFecha($fechaNacimiento)) {
            throw new Exception("Formato de fecha inválido. Use YYYY-MM-DD.");
        }

        $datos = $alumno->ActualizarAlumno(
            $idAlumno, $cedula, $nombre, $apellido, $sexo, $fechaNacimiento,
            $telefono, $localidadMunicipio, $correo, $club, $direccion,
            $dondeEstudia, $grado, $seccion, $deporte, $centroIniciacionDeportivo,
            $idRepresentante, $idUsuario, $estatus
        );
        
        if($datos){
            $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => 'Datos del alumno actualizados con éxito'];
            header("Location: ../vista/alumnos/alumno.php");
            exit;
        } else {
            throw new Exception("No se pudo actualizar el alumno.");
        }
    } catch (Exception $e) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => $e->getMessage()];
        header("Location: ../vista/alumnos/edit_alumno.php?id=" . base64_encode($idAlumno) . 
               "&a=" . base64_encode($cedula) . 
               "&b=" . base64_encode($nombre) . 
               "&c=" . base64_encode($apellido) . 
               "&d=" . base64_encode($sexo) . 
               "&e=" . base64_encode($fechaNacimiento) . 
               "&h=" . base64_encode($telefono) . 
               "&i=" . base64_encode($localidadMunicipio) . 
               "&j=" . base64_encode($correo) . 
               "&k=" . base64_encode($club) . 
               "&l=" . base64_encode($direccion) . 
               "&m=" . base64_encode($dondeEstudia) . 
               "&n=" . base64_encode($grado) . 
               "&o=" . base64_encode($seccion) . 
               "&p=" . base64_encode($deporte) . 
               "&q=" . base64_encode($centroIniciacionDeportivo) . 
               "&r=" . base64_encode($idRepresentante) . 
               "&s=" . base64_encode($idUsuario) . 
               "&t=" . base64_encode($estatus));
        exit;
    }
}

############################################################################
### ACTUALIZAR ESTATUS #####################################################
############################################################################
if(isset($_POST['actualizar_estatus']) && $_POST['actualizar_estatus']=="actualizar"){
    try {
        $idAlumno = sanitizar($_POST['idAlumno']);
        $estatus = sanitizar($_POST['estatus']);
        
        if(empty($idAlumno) || empty($estatus)) {
            throw new Exception("Datos incompletos para actualizar estatus.");
        }
        
        $datos = $alumno->ActualizarEstatusAlumno($idAlumno, $estatus);
        
        if($datos){
            $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => 'Estatus actualizado con éxito'];
        } else {
            $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se pudo actualizar el estatus'];
        }
        
        header("Location: ../vista/alumnos/alumno.php");
        exit;
    } catch (Exception $e) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => $e->getMessage()];
        header("Location: ../vista/alumnos/alumno.php");
        exit;
    }
}

############################################################################
### ELIMINAR ###############################################################
############################################################################
if(isset($_GET['E']) && $_GET['E']=="eli"){
    try {
        $ci = base64_decode($_GET['I']);
        
        if(!preg_match('/^[0-9]{6,10}$/', $ci)) {
            throw new Exception("Cédula no válida.");
        }
        
        // Primero consultar para obtener el ID
        $datos_alumno = $alumno->ConsultarAlumno($ci);
        
        if($datos_alumno === false) {
            throw new Exception("No se encontró el alumno.");
        }
        
        $resultado = $alumno->EliminarAlumno($datos_alumno['idAlumno']);
        
        if($resultado){
            $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => 'Alumno eliminado con éxito.'];
        } else {
            $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se pudo eliminar el alumno.'];
        }
        
        header("Location: ../vista/alumnos/alumno.php");
        exit;
    } catch (Exception $e) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => $e->getMessage()];
        header("Location: ../vista/alumnos/alumno.php");
        exit;
    }
}

############################################################################
### OBTENER CATEGORIAS #####################################################
############################################################################
if(isset($_GET['categorias']) && $_GET['categorias']=="listar"){
    try {
        $categorias = $alumno->ObtenerCategorias();
        
        header('Content-Type: application/json');
        echo json_encode([
            'success' => true,
            'data' => $categorias
        ]);
        exit;
    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
        exit;
    }
}

############################################################################
### BUSCAR POR CÉDULA ######################################################
############################################################################
if(isset($_GET['buscar_cedula'])){
    try {
        $cedula = sanitizar($_GET['buscar_cedula']);
        
        if(!preg_match('/^[0-9]{6,10}$/', $cedula)) {
            throw new Exception("Cédula no válida.");
        }
        
        $datos = $alumno->ConsultarAlumno($cedula);
        
        if($datos !== false && !empty($datos)){
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'idAlumno' => $datos['idAlumno'],
                'cedula' => $datos['cedula'],
                'nombre' => $datos['nombre'],
                'apellido' => $datos['apellido'],
                'sexo' => $datos['sexo'],
                'fechaNacimiento' => $datos['fechaNacimiento'],
                'edad' => $datos['edad'],
                'categoria' => $datos['categoria'],
                'telefono' => $datos['telefono'],
                'localidadMunicipio' => $datos['localidadMunicipio'],
                'correo' => $datos['correo'],
                'club' => $datos['club'],
                'direccion' => $datos['direccion'],
                'dondeEstudia' => $datos['dondeEstudia'],
                'grado' => $datos['grado'],
                'seccion' => $datos['seccion'],
                'deporte' => $datos['deporte'],
                'centroIniciacionDeportivo' => $datos['centroIniciacionDeportivo'],
                'idRepresentante' => $datos['idRepresentante'],
                'nombre_representante' => $datos['nombre_representante'] ?? '',
                'apellido_representante' => $datos['apellido_representante'] ?? '',
                'idUsuario' => $datos['idUsuario'],
                'estatus' => $datos['estatus']
            ]);
            exit;
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'message' => 'Alumno no encontrado'
            ]);
            exit;
        }
    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
        exit;
    }
}

############################################################################
### BUSCAR POR ID ##########################################################
############################################################################
if(isset($_GET['buscar_id'])){
    try {
        $idAlumno = sanitizar($_GET['buscar_id']);
        
        if(empty($idAlumno) || !is_numeric($idAlumno)) {
            throw new Exception("ID no válido.");
        }
        
        $datos = $alumno->ConsultarAlumnoPorId($idAlumno);
        
        if($datos !== false && !empty($datos)){
            header('Content-Type: application/json');
            echo json_encode([
                'success' => true,
                'idAlumno' => $datos['idAlumno'],
                'cedula' => $datos['cedula'],
                'nombre' => $datos['nombre'],
                'apellido' => $datos['apellido'],
                'sexo' => $datos['sexo'],
                'fechaNacimiento' => $datos['fechaNacimiento'],
                'edad' => $datos['edad'],
                'categoria' => $datos['categoria'],
                'telefono' => $datos['telefono'],
                'localidadMunicipio' => $datos['localidadMunicipio'],
                'correo' => $datos['correo'],
                'club' => $datos['club'],
                'direccion' => $datos['direccion'],
                'dondeEstudia' => $datos['dondeEstudia'],
                'grado' => $datos['grado'],
                'seccion' => $datos['seccion'],
                'deporte' => $datos['deporte'],
                'centroIniciacionDeportivo' => $datos['centroIniciacionDeportivo'],
                'idRepresentante' => $datos['idRepresentante'],
                'nombre_representante' => $datos['nombre_representante'] ?? '',
                'apellido_representante' => $datos['apellido_representante'] ?? '',
                'idUsuario' => $datos['idUsuario'],
                'nombreUsuario' => $datos['nombreUsuario'] ?? '',
                'estatus' => $datos['estatus']
            ]);
            exit;
        } else {
            header('Content-Type: application/json');
            echo json_encode([
                'success' => false,
                'message' => 'Alumno no encontrado'
            ]);
            exit;
        }
    } catch (Exception $e) {
        header('Content-Type: application/json');
        echo json_encode([
            'success' => false,
            'message' => $e->getMessage()
        ]);
        exit;
    }
}

// Si no se recibe ninguna acción válida
header("Location: ../vista/alumnos/alumno.php");
exit;
?>