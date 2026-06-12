<?php
session_start();
include("../modelo/conexion.php");
include("../modelo/clase_entrenador.php");

// Verificar cédula duplicada vía AJAX
if(isset($_GET['verificar_cedula']) && $_GET['verificar_cedula'] == 'true') {
    header('Content-Type: application/json');
    $cedula = $_GET['cedula'];
    $excluir = isset($_GET['excluir']) ? $_GET['excluir'] : null;
    
    $ent = new Entrenador();
    $existe = $ent->verificarCedulaExistente($cedula, $excluir);
    
    echo json_encode(['existe' => $existe]);
    exit;
}

$ent = new Entrenador();

############################################################################
### REGISTRAR ##############################################################
############################################################################
if(isset($_POST['registrar']) && $_POST['registrar'] == "registrar"){
    $errores = [];
    
    if(empty($_POST['cedula'])) {
        $errores[] = "La cédula es requerida";
    } elseif(!preg_match('/^\d{7,8}$/', $_POST['cedula'])) {
        $errores[] = "La cédula debe tener entre 7 y 8 dígitos numéricos";
    } else {
        if($ent->verificarCedulaExistente($_POST['cedula'])) {
            $errores[] = "Ya existe un entrenador registrado con esta cédula";
        }
    }
    
    if(empty($_POST['nombre'])) {
        $errores[] = "El nombre es requerido";
    } elseif(!preg_match('/^[a-zA-ZáéíóúñÁÉÍÓÚÑ\s]+$/', $_POST['nombre'])) {
        $errores[] = "El nombre solo puede contener letras y espacios";
    }
    
    if(empty($_POST['apellido'])) {
        $errores[] = "El apellido es requerido";
    } elseif(!preg_match('/^[a-zA-ZáéíóúñÁÉÍÓÚÑ\s]+$/', $_POST['apellido'])) {
        $errores[] = "El apellido solo puede contener letras y espacios";
    }
    
    if(!empty($_POST['telefono']) && !preg_match('/^\d{4}-\d{7}$/', $_POST['telefono'])) {
        $errores[] = "El teléfono debe tener el formato: 0412-1234567";
    }
    
    if(!empty($errores)) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error de Validación', 'text' => implode('<br>', $errores)];
        header("Location: ../vista/entrenadores/insert_entrenador.php");
        exit;
    }

    $cedula = trim($_POST['cedula']);
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $telefono = !empty($_POST['telefono']) ? trim($_POST['telefono']) : null;
    $id_usuario = null;
    $idEspecialidad = trim($_POST['idEspecialidad']);

    $datos = $ent->RegistrarEntrenador($cedula, $nombre, $apellido, $telefono, $id_usuario, $idEspecialidad);
    
    if($datos){ 
        $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => 'Entrenador Registrado con éxito.'];
        header("Location: ../vista/entrenadores/entrenador.php");
        exit;
    } else {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se pudo registrar los datos. La cédula ya existe o hubo un error.'];
        header("Location: ../vista/entrenadores/insert_entrenador.php");
        exit;
    }
}

############################################################################
### LISTAR #################################################################
############################################################################
if(isset($_GET['L']) && $_GET['L'] == "lis"){
    $datos = $ent->ListarEntrenador();

    if($datos === false || empty($datos)){
        $_SESSION['flash'] = ['icon' => 'info', 'title' => 'Información', 'text' => 'No hay entrenadores registrados.'];
    }
    
    header("Location: ../vista/entrenadores/entrenador.php");
    exit;
}

#############################################################################
### CONSULTAR (para detalle) ################################################
#############################################################################
if(isset($_GET['C']) && $_GET['C'] == "con"){
    $ced = base64_decode($_GET['I']);
    $datos = $ent->ConsultarEntrenador($ced);
    
    if($datos === false){
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se encontró el entrenador solicitado.'];
        header("Location: ../vista/entrenadores/entrenador.php");
        exit;
    } else {
        $ced = base64_encode($datos[1]);
        header("Location: ../vista/entrenadores/detalle_entrenador.php?ced=$ced");
        exit;
    }
}

############################################################################
### MOSTRAR (para editar) ##################################################
############################################################################
if(isset($_GET['M']) && $_GET['M'] == "mos"){
    $ced = base64_decode($_GET['I']);
    $datos = $ent->MostrarEntrenador($ced);
    
    if($datos === false){
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se encontró el entrenador solicitado.'];
        header("Location: ../vista/entrenadores/entrenador.php");
        exit;
    } else {
        $ced = base64_encode($datos[1]);
        header("Location: ../vista/entrenadores/edit_entrenador.php?ced=$ced");
        exit;
    }
}

############################################################################
### ACTUALIZAR #############################################################
############################################################################
if(isset($_POST['modificar']) && $_POST['modificar'] == "modificar"){
    $errores = [];
    
    if(empty($_POST['nombre'])) {
        $errores[] = "El nombre es requerido";
    } elseif(!preg_match('/^[a-zA-ZáéíóúñÁÉÍÓÚÑ\s]+$/', $_POST['nombre'])) {
        $errores[] = "El nombre solo puede contener letras y espacios";
    }
    
    if(empty($_POST['apellido'])) {
        $errores[] = "El apellido es requerido";
    } elseif(!preg_match('/^[a-zA-ZáéíóúñÁÉÍÓÚÑ\s]+$/', $_POST['apellido'])) {
        $errores[] = "El apellido solo puede contener letras y espacios";
    }
    
    if(!empty($_POST['telefono']) && !preg_match('/^\d{4}-\d{7}$/', $_POST['telefono'])) {
        $errores[] = "El teléfono debe tener el formato: 0412-1234567";
    }
    
    if(!empty($errores)) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error de Validación', 'text' => implode('<br>', $errores)];
        $ced_enc = base64_encode($_POST['cedula']);
        header("Location: ../vista/entrenadores/edit_entrenador.php?ced=$ced_enc");
        exit;
    }

    $cedula = $_POST['cedula'];
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $telefono = !empty($_POST['telefono']) ? trim($_POST['telefono']) : null;
    
    // id_usuario siempre null
    $id_usuario = null;
    $id_especialidad = $_POST['idEspecialidad'];

    $datos = $ent->ActualizarEntrenador($cedula, $nombre, $apellido, $telefono, $id_usuario, $id_especialidad);
    
    if($datos){
        $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => 'Entrenador actualizado con éxito.'];
        header("Location: ../vista/entrenadores/entrenador.php");
        exit;
    } else {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se pudo actualizar los datos.'];
        $ced_enc = base64_encode($_POST['cedula']);
        header("Location: ../vista/entrenadores/edit_entrenador.php?ced=$ced_enc");
        exit;
    }
}

############################################################################
### ELIMINAR ###############################################################
############################################################################
if(isset($_GET['E']) && $_GET['E'] == "eli"){
    $ced = base64_decode($_GET['I']);
    
    try {
        $datos = $ent->EliminarEntrenador($ced);
        
        if($datos){
            $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => 'Entrenador eliminado con éxito.'];
        } else {
            $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se pudo eliminar el entrenador.'];
        }
        
    } catch (Exception $e) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => $e->getMessage()];
    }
    
    header("Location: ../vista/entrenadores/entrenador.php");
    exit;
}
?>