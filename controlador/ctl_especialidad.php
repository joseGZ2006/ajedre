<?php
session_start();
include("../modelo/conexion.php");
include("../modelo/clase_especialidad.php");

$espe = new Especialidad();

// Función para validar nombre (consistente con la clase)
function validarNombreEspecialidad($nombre) {
    if(empty($nombre)) {
        return false;
    }
    // Misma validación que en la clase: solo letras y espacios
    return preg_match('/^[a-zA-ZáéíóúñÁÉÍÓÚÑ\s]+$/', $nombre);
}

############################################################################
### REGISTRAR ##############################################################
############################################################################
if(isset($_POST['registrar']) && $_POST['registrar'] == "registrar"){
    $errores = [];
    $nombre = trim($_POST['nombre']);
    
    if(empty($nombre)) {
        $errores[] = "El nombre es requerido";
    } elseif(!validarNombreEspecialidad($nombre)) {
        $errores[] = "El nombre solo puede contener letras y espacios";
    }
    
    if(!empty($errores)) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error de Validación', 'text' => implode('<br>', $errores)];
        header("Location: ../vista/especialidad/insert_especialidad.php");
        exit;
    }

    $espe->setNombre($nombre);
    $datos = $espe->RegistrarEspecialidad($espe->getNombre());
    
    if($datos){ 
        $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => 'Especialidad Registrada con éxito.'];
        header("Location: ../vista/especialidad/especialidad.php");
        exit;
    } else {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se pudo registrar los datos. La especialidad ya existe o hubo un error.'];
        header("Location: ../vista/especialidad/insert_especialidad.php");
        exit;
    }
}

############################################################################
### LISTAR #################################################################
############################################################################
if(isset($_GET['L']) && $_GET['L'] == "lis"){
    $datos = $espe->ListarEspecialidad();

    if($datos === false || empty($datos)){
        $_SESSION['flash'] = ['icon' => 'info', 'title' => 'Información', 'text' => 'No hay especialidades registradas.'];
    }
    
    header("Location: ../vista/especialidad/especialidad.php");
    exit;
}

#############################################################################
### CONSULTAR (VER DETALLE) #################################################
#############################################################################
if(isset($_GET['C']) && $_GET['C'] == "con"){
    if(!isset($_GET['I'])) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'ID de especialidad no proporcionado.'];
        header("Location: ../vista/especialidad/especialidad.php");
        exit;
    }
    
    $id = $_GET['I'];
    
    if(!is_numeric($id)) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'ID de especialidad inválido.'];
        header("Location: ../vista/especialidad/especialidad.php");
        exit;
    }
    
    $espe->setIdEspecialidad($id);
    $datos = $espe->ConsultarEspecialidad($espe->getIdEspecialidad());
    
    if($datos === false){
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se encontró la especialidad solicitada.'];
        header("Location: ../vista/especialidad/especialidad.php");
        exit;
    } else {
        $idEncoded = base64_encode($datos['idEspecialidad']);
        $nomEncoded = base64_encode($datos['nombre']);
        
        header("Location: ../vista/especialidad/detalle_especialidad.php?id=$idEncoded&nom=$nomEncoded");
        exit;
    }
}

############################################################################
### MOSTRAR PARA EDITAR ####################################################
############################################################################
if(isset($_GET['M']) && $_GET['M'] == "mos"){
    if(!isset($_GET['I'])) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'ID de especialidad no proporcionado.'];
        header("Location: ../vista/especialidad/especialidad.php");
        exit;
    }
    
    $id = $_GET['I'];
    
    if(!is_numeric($id)) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'ID de especialidad inválido.'];
        header("Location: ../vista/especialidad/especialidad.php");
        exit;
    }
    
    $espe->setIdEspecialidad($id);
    $datos = $espe->MostrarEspecialidad($espe->getIdEspecialidad());
    
    if($datos === false){
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se encontró la especialidad solicitada.'];
        header("Location: ../vista/especialidad/especialidad.php");
        exit;
    } else {
        $idEncoded = base64_encode($datos['idEspecialidad']);
        $nomEncoded = base64_encode($datos['nombre']);
        
        header("Location: ../vista/especialidad/edit_especialidad.php?id=$idEncoded&nom=$nomEncoded");
        exit;
    }
}

############################################################################
### ACTUALIZAR #############################################################
############################################################################
if(isset($_POST['actualizar']) && $_POST['actualizar'] == "actualizar"){
    $errores = [];
    $nombre = trim($_POST['nombre']);
    
    if(empty($nombre)) {
        $errores[] = "El nombre es requerido";
    } elseif(!validarNombreEspecialidad($nombre)) {
        $errores[] = "El nombre solo puede contener letras y espacios";
    }
    
    if(!empty($errores)) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error de Validación', 'text' => implode('<br>', $errores)];
        $idParam = isset($_POST['id']) ? $_POST['id'] : '';
        $nomParam = isset($_POST['nombre_original']) ? $_POST['nombre_original'] : '';
        header("Location: ../vista/especialidad/edit_especialidad.php?id=$idParam&nom=$nomParam");
        exit;
    }

    $id = base64_decode($_POST['id']);
    $nombre = trim($_POST['nombre']);
    
    $datos = $espe->ActualizarEspecialidad($id, $nombre);
    
    if($datos){ 
        $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => 'Especialidad actualizada con éxito.'];
        header("Location: ../vista/especialidad/especialidad.php");
        exit;
    } else {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se pudo actualizar. La especialidad ya existe o hubo un error.'];
        $idParam = isset($_POST['id']) ? $_POST['id'] : '';
        $nomParam = isset($_POST['nombre_original']) ? $_POST['nombre_original'] : '';
        header("Location: ../vista/especialidad/edit_especialidad.php?id=$idParam&nom=$nomParam");
        exit;
    }
}

############################################################################
### ELIMINAR ###############################################################
############################################################################
if(isset($_GET['E']) && $_GET['E'] == "eli"){
    if(!isset($_GET['I'])) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'ID de especialidad no proporcionado.'];
        header("Location: ../vista/especialidad/especialidad.php");
        exit;
    }
    
    $id = base64_decode($_GET['I']);
    
    if(!is_numeric($id)) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'ID de especialidad inválido.'];
        header("Location: ../vista/especialidad/especialidad.php");
        exit;
    }
    
    $espe->setIdEspecialidad($id);

    try {
        $datos = $espe->EliminarEspecialidad($espe->getIdEspecialidad());
        
        if($datos){
            $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => 'Especialidad eliminada con éxito.'];
        } else {
            $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se pudo eliminar la especialidad.'];
        }
        
    } catch (Exception $e) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => $e->getMessage()];
    }
    
    header("Location: ../vista/especialidad/especialidad.php");
    exit;
}

?>