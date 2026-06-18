<?php
session_start();

include("../modelo/conexion.php");
include("../modelo/clase_alumno.php");

$alumno = new Alumno();

// Función para sanitizar datos
function sanitizar($dato) {
    $dato = trim($dato);
    $dato = strip_tags($dato);
    $dato = htmlspecialchars($dato);
    return $dato;
}

// Función para validar fecha
function validarFecha($fecha) {
    $date = DateTime::createFromFormat('Y-m-d', $fecha);
    return $date && $date->format('Y-m-d') === $fecha;
}

// ==================== REGISTRAR ====================
if (isset($_POST['registrar']) && $_POST['registrar'] == 'registrar') {
    $errores = [];
    
    // Sanitizar datos
    $cedula = sanitizar($_POST['cedula']);
    $nombre = sanitizar($_POST['nombre']);
    $apellido = sanitizar($_POST['apellido']);
    $sexo = sanitizar($_POST['sexo']);
    $fechaNacimiento = sanitizar($_POST['fechaNacimiento']);
    $telefono = !empty($_POST['telefono']) ? sanitizar($_POST['telefono']) : null;
    $localidadMunicipio = sanitizar($_POST['localidadMunicipio']);
    $correo = !empty($_POST['correo']) ? sanitizar($_POST['correo']) : null;
    $club = !empty($_POST['club']) ? sanitizar($_POST['club']) : null;
    $direccion = sanitizar($_POST['direccion']);
    
    // Campos condicionales - Estudia
    $estudia = sanitizar($_POST['estudia']);
    $dondeEstudia = null;
    $grado = null;
    $seccion = null;
    if($estudia == 'Si') {
        $dondeEstudia = !empty($_POST['dondeEstudia']) ? sanitizar($_POST['dondeEstudia']) : null;
        $grado = !empty($_POST['grado']) ? sanitizar($_POST['grado']) : null;
        $seccion = !empty($_POST['seccion']) ? sanitizar($_POST['seccion']) : null;
    }
    
    // Campos condicionales - Deporte
    $practicaDeporte = sanitizar($_POST['practicaDeporte']);
    $deporte = null;
    $centroIniciacionDeportivo = null;
    if($practicaDeporte == 'Si') {
        $deporte = !empty($_POST['deporte']) ? sanitizar($_POST['deporte']) : null;
        $centroIniciacionDeportivo = !empty($_POST['centroIniciacionDeportivo']) ? sanitizar($_POST['centroIniciacionDeportivo']) : null;
    }
    
    $idRepresentante = !empty($_POST['idRepresentante']) ? sanitizar($_POST['idRepresentante']) : null;
    $estatus = 'activo'; // Siemre activo al registrar

    // Validaciones
    if(empty($cedula)) {
        $errores[] = "La cédula es requerida";
    } elseif(!preg_match('/^\d{7,10}$/', $cedula)) {
        $errores[] = "La cédula debe tener entre 7 y 10 dígitos numéricos";
    }
    
    if(empty($nombre)) {
        $errores[] = "El nombre es requerido";
    } elseif(!preg_match('/^[a-zA-ZáéíóúñÁÉÍÓÚÑ\s]{2,50}$/', $nombre)) {
        $errores[] = "El nombre solo puede contener letras";
    }
    
    if(empty($apellido)) {
        $errores[] = "El apellido es requerido";
    } elseif(!preg_match('/^[a-zA-ZáéíóúñÁÉÍÓÚÑ\s]{2,50}$/', $apellido)) {
        $errores[] = "El apellido solo puede contener letras";
    }
    
    if(empty($sexo)) {
        $errores[] = "El sexo es requerido";
    } elseif(!in_array($sexo, ['M', 'F'])) {
        $errores[] = "Sexo no válido";
    }
    
    if(empty($fechaNacimiento)) {
        $errores[] = "La fecha de nacimiento es requerida";
    } elseif(!validarFecha($fechaNacimiento)) {
        $errores[] = "Formato de fecha inválido";
    }
    
    if(!empty($telefono) && !preg_match('/^\d{4}-\d{7}$/', $telefono)) {
        $errores[] = "El teléfono debe tener el formato: 0412-1234567";
    }
    
    if(!empty($correo) && !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        $errores[] = "El correo electrónico no es válido";
    }
    
    if(empty($localidadMunicipio)) {
        $errores[] = "La localidad es requerida";
    }
    
    if(empty($direccion)) {
        $errores[] = "La dirección es requerida";
    }
    
    // Validar representante para menores de edad
    $edad = date_diff(date_create($fechaNacimiento), date_create('today'))->y;
    if ($edad < 18 && empty($idRepresentante)) {
        $errores[] = "Los alumnos menores de 18 años deben tener un representante asignado.";
    }
    
    // Verificar cédula duplicada
    if($alumno->verificarCedulaExistente($cedula)) {
        $errores[] = "Ya existe un alumno registrado con esta cédula.";
    }
    
    if(!empty($errores)) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error de Validación', 'text' => implode('<br>', $errores)];
        header("Location: ../vista/alumnos/insert_alumno.php");
        exit;
    }

    $datos = $alumno->RegistrarAlumno(
        $cedula, $nombre, $apellido, $sexo, $fechaNacimiento,
        $telefono, $localidadMunicipio, $correo, $club, $direccion,
        $dondeEstudia, $grado, $seccion, $deporte, $centroIniciacionDeportivo,
        $idRepresentante, $estatus
    );
    
    if($datos === true){ 
        $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => 'Alumno registrado con éxito.'];
        header("Location: ../vista/alumnos/alumno.php");
        exit;
    } elseif($datos === 'cedula_exists') {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'La cédula ya está registrada.'];
        header("Location: ../vista/alumnos/insert_alumno.php");
        exit;
    } else {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se pudo registrar el alumno.'];
        header("Location: ../vista/alumnos/insert_alumno.php");
        exit;
    }
}

// ==================== LISTAR ====================
if(isset($_GET['L']) && $_GET['L']=="lis"){
    $datos = $alumno->ListarAlumnos();
    
    if($datos === false || empty($datos)){
        $_SESSION['flash'] = ['icon' => 'info', 'title' => 'Información', 'text' => 'No hay alumnos registrados.'];
    }
    
    $_SESSION['lista_alumnos'] = $datos;
    header("Location: ../vista/alumnos/alumno.php");
    exit;
}

// ==================== CONSULTAR (VER DETALLE) ====================
if(isset($_GET['C']) && $_GET['C']=="con"){
    try {
        if(!isset($_GET['I'])) {
            throw new Exception("ID no proporcionado.");
        }
        
        $ci = base64_decode($_GET['I']);
        
        if(!preg_match('/^\d{7,10}$/', $ci)) {
            throw new Exception("Cédula no válida.");
        }
        
        $datos = $alumno->ConsultarAlumno($ci);
        
        if($datos === false){
            $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se encontró el alumno solicitado.'];
            header("Location: ../vista/alumnos/alumno.php");
            exit;
        } else {
            // Codificar datos para URL
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
            $repNom = base64_encode($datos['nombre_representante'] ?? '');
            $repApe = base64_encode($datos['apellido_representante'] ?? '');
            $repTel = base64_encode($datos['telefono_representante'] ?? '');
            $repPar = base64_encode($datos['parentesco'] ?? '');
            $status = base64_encode($datos['estatus']);
            $estudia = base64_encode($datos['dondeEstudia'] ? 'Si' : 'No');
            $practicaDeporte = base64_encode($datos['deporte'] ? 'Si' : 'No');
            
            header("Location: ../vista/alumnos/detalle_alumno.php?id=$id&ced=$ced&nom=$nom&ape=$ape&sex=$sex&fna=$fna&edad=$edad&cat=$cat&tel=$tel&loc=$loc&ema=$ema&club=$club&dir=$dir&est=$est&gra=$gra&sec=$sec&dep=$dep&cen=$cen&rep=$rep&repNom=$repNom&repApe=$repApe&repTel=$repTel&repPar=$repPar&status=$status&estudia=$estudia&practicaDeporte=$practicaDeporte");
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => $e->getMessage()];
        header("Location: ../vista/alumnos/alumno.php");
        exit;
    }
}

// ==================== MOSTRAR PARA EDITAR ====================
if(isset($_GET['M']) && $_GET['M']=="mos"){
    try {
        if(!isset($_GET['I'])) {
            throw new Exception("ID no proporcionado.");
        }
        
        $ci = base64_decode($_GET['I']);
        
        if(!preg_match('/^\d{7,10}$/', $ci)) {
            throw new Exception("Cédula no válida.");
        }
        
        $datos = $alumno->ConsultarAlumno($ci);
        
        if($datos === false){
            $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se encontró el alumno solicitado.'];
            header("Location: ../vista/alumnos/alumno.php");
            exit;
        } else {
            // Codificar datos para URL
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
            $status = base64_encode($datos['estatus']);
            $estudia = base64_encode($datos['dondeEstudia'] ? 'Si' : 'No');
            $practicaDeporte = base64_encode($datos['deporte'] ? 'Si' : 'No');
            
            header("Location: ../vista/alumnos/edit_alumno.php?id=$id&ced=$ced&nom=$nom&ape=$ape&sex=$sex&fna=$fna&tel=$tel&loc=$loc&ema=$ema&club=$club&dir=$dir&est=$est&gra=$gra&sec=$sec&dep=$dep&cen=$cen&rep=$rep&status=$status&estudia=$estudia&practicaDeporte=$practicaDeporte");
            exit;
        }
    } catch (Exception $e) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => $e->getMessage()];
        header("Location: ../vista/alumnos/alumno.php");
        exit;
    }
}

// ==================== ACTUALIZAR ====================
if(isset($_POST['modificar']) && $_POST['modificar'] == "modificar"){
    try {
        $errores = [];
        
        // Sanitizar datos
        $idAlumno = sanitizar($_POST['idAlumno']);
        $cedula = sanitizar($_POST['cedula']);
        $nombre = sanitizar($_POST['nombre']);
        $apellido = sanitizar($_POST['apellido']);
        $sexo = sanitizar($_POST['sexo']);
        $fechaNacimiento = sanitizar($_POST['fechaNacimiento']);
        $telefono = !empty($_POST['telefono']) ? sanitizar($_POST['telefono']) : null;
        $localidadMunicipio = sanitizar($_POST['localidadMunicipio']);
        $correo = !empty($_POST['correo']) ? sanitizar($_POST['correo']) : null;
        $club = !empty($_POST['club']) ? sanitizar($_POST['club']) : null;
        $direccion = sanitizar($_POST['direccion']);
        $estatus = sanitizar($_POST['estatus']);
        
        // Campos condicionales - Estudia
        $estudia = sanitizar($_POST['estudia']);
        $dondeEstudia = null;
        $grado = null;
        $seccion = null;
        if($estudia == 'Si') {
            $dondeEstudia = !empty($_POST['dondeEstudia']) ? sanitizar($_POST['dondeEstudia']) : null;
            $grado = !empty($_POST['grado']) ? sanitizar($_POST['grado']) : null;
            $seccion = !empty($_POST['seccion']) ? sanitizar($_POST['seccion']) : null;
        }
        
        // Campos condicionales - Deporte
        $practicaDeporte = sanitizar($_POST['practicaDeporte']);
        $deporte = null;
        $centroIniciacionDeportivo = null;
        if($practicaDeporte == 'Si') {
            $deporte = !empty($_POST['deporte']) ? sanitizar($_POST['deporte']) : null;
            $centroIniciacionDeportivo = !empty($_POST['centroIniciacionDeportivo']) ? sanitizar($_POST['centroIniciacionDeportivo']) : null;
        }
        
        $idRepresentante = !empty($_POST['idRepresentante']) ? sanitizar($_POST['idRepresentante']) : null;

        // Validaciones
        if(empty($idAlumno)) $errores[] = "ID de alumno no válido";
        
        if(empty($cedula)) $errores[] = "La cédula es requerida";
        elseif(!preg_match('/^\d{7,8}$/', $cedula)) $errores[] = "La cédula debe tener entre 7 y 8 dígitos";
        
        if(empty($nombre)) $errores[] = "El nombre es requerido";
        elseif(!preg_match('/^[a-zA-ZáéíóúñÁÉÍÓÚÑ\s]{2,50}$/', $nombre)) $errores[] = "El nombre solo puede contener letras";
        
        if(empty($apellido)) $errores[] = "El apellido es requerido";
        elseif(!preg_match('/^[a-zA-ZáéíóúñÁÉÍÓÚÑ\s]{2,50}$/', $apellido)) $errores[] = "El apellido solo puede contener letras";
        
        if(empty($sexo)) $errores[] = "El sexo es requerido";
        elseif(!in_array($sexo, ['M', 'F'])) $errores[] = "Sexo no válido";
        
        if(empty($fechaNacimiento)) $errores[] = "La fecha de nacimiento es requerida";
        elseif(!validarFecha($fechaNacimiento)) $errores[] = "Formato de fecha inválido";
        
        if(!empty($telefono) && !preg_match('/^\d{4}-\d{7}$/', $telefono)) $errores[] = "El teléfono debe tener el formato: 0412-1234567";
        
        if(!empty($correo) && !filter_var($correo, FILTER_VALIDATE_EMAIL)) $errores[] = "El correo electrónico no es válido";
        
        if(empty($localidadMunicipio)) $errores[] = "La localidad es requerida";
        
        if(empty($direccion)) $errores[] = "La dirección es requerida";
        
        if(empty($estatus)) $errores[] = "El estatus es requerido";
        elseif(!in_array($estatus, ['activo', 'inactivo', 'suspendido'])) $errores[] = "Estatus no válido";
        
        // Validar representante para menores de edad
        $edad = date_diff(date_create($fechaNacimiento), date_create('today'))->y;
        if ($edad < 18 && empty($idRepresentante)) {
            $errores[] = "Los alumnos menores de 18 años deben tener un representante asignado.";
        }
        
        // Verificar cédula duplicada (excluyendo el actual)
        if($alumno->verificarCedulaExistente($cedula, $idAlumno)) {
            $errores[] = "Ya existe otro alumno registrado con esta cédula.";
        }
        
        if(!empty($errores)) {
            $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error de Validación', 'text' => implode('<br>', $errores)];
            header("Location: ../vista/alumnos/edit_alumno.php?id=" . base64_encode($idAlumno));
            exit;
        }

        $datos = $alumno->ActualizarAlumno(
            $idAlumno, $cedula, $nombre, $apellido, $sexo, $fechaNacimiento,
            $telefono, $localidadMunicipio, $correo, $club, $direccion,
            $dondeEstudia, $grado, $seccion, $deporte, $centroIniciacionDeportivo,
            $idRepresentante, $estatus
        );
        
        if($datos === true){
            $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => 'Alumno actualizado con éxito.'];
            header("Location: ../vista/alumnos/alumno.php");
            exit;
        } elseif($datos === 'cedula_exists') {
            $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'La cédula ya está registrada en otro alumno.'];
            header("Location: ../vista/alumnos/edit_alumno.php?id=" . base64_encode($idAlumno));
            exit;
        } else {
            $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se pudo actualizar el alumno.'];
            header("Location: ../vista/alumnos/edit_alumno.php?id=" . base64_encode($idAlumno));
            exit;
        }
    } catch (Exception $e) {
        error_log("Error al actualizar alumno: " . $e->getMessage());
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'Ocurrió un error al actualizar el alumno.'];
        header("Location: ../vista/alumnos/alumno.php");
        exit;
    }
}

// ==================== ELIMINAR ====================
if(isset($_GET['E']) && $_GET['E']=="eli"){
    try {
        if(!isset($_GET['I'])) {
            throw new Exception("ID no proporcionado.");
        }
        
        $ci = base64_decode($_GET['I']);
        
        if(!preg_match('/^\d{7,10}$/', $ci)) {
            throw new Exception("Cédula no válida.");
        }
        
        // Primero consultar para obtener el ID
        $datos_alumno = $alumno->ConsultarAlumno($ci);
        
        if($datos_alumno === false) {
            throw new Exception("No se encontró el alumno.");
        }
        
        $resultado = $alumno->EliminarAlumno($datos_alumno['idAlumno']);
        
        if($resultado === true){
            $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => 'Alumno eliminado con éxito.'];
        } elseif($resultado === 'in_use') {
            $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se puede eliminar el alumno porque tiene registros asociados (clases, torneos, etc.).'];
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

// ==================== VERIFICAR CÉDULA (AJAX) ====================
if(isset($_GET['verificar_cedula']) && $_GET['verificar_cedula'] == 'true'){
    $cedula = sanitizar($_GET['cedula']);
    $excluir = isset($_GET['excluir']) ? sanitizar($_GET['excluir']) : null;
    
    $existe = $alumno->verificarCedulaExistente($cedula, $excluir);
    
    header('Content-Type: application/json');
    echo json_encode(['existe' => $existe]);
    exit;
}

// Si no se recibe ninguna acción válida
header("Location: ../vista/alumnos/alumno.php");
exit;
?>