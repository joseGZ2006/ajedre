<?php
session_start();
include("../modelo/conexion.php");
include("../modelo/clase_entrenador.php");
include("../modelo/clase_usuario.php");

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
    // Validaciones del lado del servidor
    $errores = [];
    
    // Validar usuario seleccionado
    if(empty($_POST['id_usuario'])) {
        $errores[] = "Debe seleccionar un usuario para el entrenador";
    } else {
        $usuarioObj = new Usuario();
        $usuarioAsociado = $usuarioObj->verificarUsuarioAsociadoAEntrenador($_POST['id_usuario']);
        if($usuarioAsociado) {
            $errores[] = "El usuario seleccionado ya está asociado a otro entrenador";
        }
    }
    
    if(empty($_POST['cedula'])) {
        $errores[] = "La cédula es requerida";
    } elseif(!preg_match('/^\d{7,8}$/', $_POST['cedula'])) {
        $errores[] = "La cédula debe tener entre 7 y 8 dígitos numéricos";
    } else {
        // Verificar si la cédula ya existe
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
    
    if(empty($_POST['telefono'])) {
        $errores[] = "El teléfono es requerido";
    } elseif(!preg_match('/^\d{4}-\d{7}$/', $_POST['telefono'])) {
        $errores[] = "El teléfono debe tener el formato: 0412-1234567";
    }
    
    if(!empty($errores)) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error de Validación', 'text' => implode('<br>', $errores)];
        header("Location: ../vista/entrenadores/insert_entrenador.php");
        exit;
    }

    // Setear las variables
    $cedula = trim($_POST['cedula']);
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $telefono = trim($_POST['telefono']);
    $id_usuario = $_POST['id_usuario'];
    $id_especialidad = isset($_POST['id_especialidad']) && !empty($_POST['id_especialidad']) ? $_POST['id_especialidad'] : null;

    // Registrar entrenador con el usuario seleccionado
    $resultado = $ent->RegistrarEntrenador($cedula, $nombre, $apellido, $telefono, $id_usuario, $id_especialidad);
    
    if($resultado == true){ 
        $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => 'Entrenador registrado con éxito.'];
        header("Location: ../vista/entrenadores/entrenador.php");
        exit;
    } else {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se pudo registrar el entrenador. Verifique que la cédula no exista y que el usuario no esté asociado a otro entrenador.'];
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
### CONSULTAR ###############################################################
#############################################################################
if(isset($_GET['C']) && $_GET['C'] == "con"){
    $ced = base64_decode($_GET['I']);
    $ent->setCedula($ced);

    $datos = $ent->ConsultarEntrenador($ent->getCedula());
    
    if($datos === false){
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se encontró el entrenador solicitado.'];
        header("Location: ../vista/entrenadores/entrenador.php");
        exit;
    } else {
        $id = base64_encode($datos[0]);
        $ced = base64_encode($datos[1]);
        $nom = base64_encode($datos[2]);
        $ape = base64_encode($datos[3]);
        $tel = base64_encode($datos[4]);
        $idUsu = base64_encode($datos[5]);
        $idEsp = base64_encode($datos[6]);
        
        header("Location: ../vista/entrenadores/detalle_entrenador.php?id=$id&ced=$ced&nom=$nom&ape=$ape&tel=$tel&idu=$idUsu&idesp=$idEsp");
        exit;
    }
}

############################################################################
### MOSTRAR ################################################################
############################################################################
if(isset($_GET['M']) && $_GET['M'] == "mos"){
    $ced = base64_decode($_GET['I']);
    $ent->setCedula($ced);

    $datos = $ent->MostrarEntrenador($ent->getCedula());
    
    if($datos === false){
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se encontró el entrenador solicitado.'];
        header("Location: ../vista/entrenadores/entrenador.php");
        exit;
    } else {
        $id = base64_encode($datos[0]);
        $ced = base64_encode($datos[1]);
        $nom = base64_encode($datos[2]);
        $ape = base64_encode($datos[3]);
        $tel = base64_encode($datos[4]);
        $idUsu = base64_encode($datos[5]);
        $idEsp = base64_encode($datos[6]);
        $nomUsu = base64_encode($datos[7]);
        $rol = base64_encode($datos[8]);
        $espNom = base64_encode($datos[9]);

        header("Location: ../vista/entrenadores/edit_entrenador.php?ced=$ced&id=$id&nom=$nom&ape=$ape&tel=$tel&idu=$idUsu&idesp=$idEsp&nomusu=$nomUsu&rol=$rol&espnom=$espNom");
        exit;
    }
}

############################################################################
### ACTUALIZAR #############################################################
############################################################################
if(isset($_POST['modificar']) && $_POST['modificar'] == "modificar"){
    $errores = [];
    
    if(empty($_POST['id_usuario'])) {
        $errores[] = "Debe seleccionar un usuario para el entrenador";
    }
    
    if(empty($_POST['nombre'])) {
        $errores[] = "El nombre es requerido";
    }
    
    if(empty($_POST['apellido'])) {
        $errores[] = "El apellido es requerido";
    }
    
    if(empty($_POST['telefono'])) {
        $errores[] = "El teléfono es requerido";
    } elseif(!preg_match('/^\d{4}-\d{7}$/', $_POST['telefono'])) {
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
    $telefono = trim($_POST['telefono']);
    $id_usuario = $_POST['id_usuario'];
    $id_especialidad = isset($_POST['id_especialidad']) && !empty($_POST['id_especialidad']) ? $_POST['id_especialidad'] : null;

    $datos = $ent->ActualizarEntrenador($cedula, $nombre, $apellido, $telefono, $id_usuario, $id_especialidad);
    
    if($datos){
        $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => 'Entrenador actualizado con éxito.'];
        header("Location: ../vista/entrenadores/entrenador.php");
        exit;
    } else {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se pudo actualizar los datos.'];
        $ced_enc = base64_encode($cedula);
        header("Location: ../vista/entrenadores/edit_entrenador.php?ced=$ced_enc");
        exit;
    }
}

############################################################################
### ELIMINAR ###############################################################
############################################################################
if(isset($_GET['E']) && $_GET['E'] == "eli"){
    $ced = base64_decode($_GET['I']);
    $ent->setCedula($ced);

    try {
        $datos = $ent->EliminarEntrenador($ent->getCedula());
        
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