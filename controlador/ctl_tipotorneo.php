<?php
session_start();
include("../modelo/conexion.php");
include("../modelo/clase_tipotorneo.php");

$tipoTorneo = new TipoTorneo();

// Función para validar nombre (consistente con la clase)
function validarNombreTipoTorneo($nombre) {
    if(empty($nombre)) {
        return false;
    }
    // Misma validación que en la clase: solo letras y espacios
    return preg_match('/^[a-zA-ZáéíóúñÁÉÍÓÚÑ\s]+$/', $nombre);
}

// Función para validar tipo
function validarTipoTorneo($tipo) {
    $tiposPermitidos = ['individual', 'equipo', 'mixto'];
    return in_array($tipo, $tiposPermitidos);
}

############################################################################
### REGISTRAR ##############################################################
############################################################################
if(isset($_POST['registrar']) && $_POST['registrar'] == "registrar"){
    $errores = [];
    $nombre = trim($_POST['nombre']);
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';
    
    if(empty($nombre)) {
        $errores[] = "El nombre es requerido";
    } elseif(!validarNombreTipoTorneo($nombre)) {
        $errores[] = "El nombre solo puede contener letras y espacios";
    }
    
    if(empty($tipo)) {
        $errores[] = "El tipo es requerido";
    } elseif(!validarTipoTorneo($tipo)) {
        $errores[] = "El tipo debe ser: individual, equipo o mixto";
    }
    
    if(!empty($errores)) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error de Validación', 'text' => implode('<br>', $errores)];
        header("Location: ../vista/tipotorneo/insert_tipotorneo.php");
        exit;
    }

    $tipoTorneo->setNombre($nombre);
    $tipoTorneo->setTipo($tipo);
    $datos = $tipoTorneo->RegistrarTipoTorneo($tipoTorneo->getNombre(), $tipoTorneo->getTipo());
    
    if($datos){ 
        $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => 'Tipo de Torneo Registrado con éxito.'];
        header("Location: ../vista/tipotorneo/tipotorneo.php");
        exit;
    } else {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se pudo registrar los datos. El tipo de torneo ya existe o hubo un error.'];
        header("Location: ../vista/tipotorneo/insert_tipotorneo.php");
        exit;
    }
}

############################################################################
### LISTAR #################################################################
############################################################################
if(isset($_GET['L']) && $_GET['L'] == "lis"){
    $datos = $tipoTorneo->ListarTipoTorneo();

    if($datos === false || empty($datos)){
        $_SESSION['flash'] = ['icon' => 'info', 'title' => 'Información', 'text' => 'No hay tipos de torneo registrados.'];
    }
    
    header("Location: ../vista/tipotorneo/tipotorneo.php");
    exit;
}

#############################################################################
### CONSULTAR (VER DETALLE) #################################################
#############################################################################
if(isset($_GET['C']) && $_GET['C'] == "con"){
    if(!isset($_GET['I'])) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'ID de tipo de torneo no proporcionado.'];
        header("Location: ../vista/tipotorneo/tipotorneo.php");
        exit;
    }
    
    $id = $_GET['I'];
    
    if(!is_numeric($id)) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'ID de tipo de torneo inválido.'];
        header("Location: ../vista/tipotorneo/tipotorneo.php");
        exit;
    }
    
    $tipoTorneo->setIdTipoTorneo($id);
    $datos = $tipoTorneo->ConsultarTipoTorneo($tipoTorneo->getIdTipoTorneo());
    
    if($datos === false){
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se encontró el tipo de torneo solicitado.'];
        header("Location: ../vista/tipotorneo/tipotorneo.php");
        exit;
    } else {
        $idEncoded = base64_encode($datos['idTipoTorneo']);
        $nomEncoded = base64_encode($datos['nombre']);
        $tipoEncoded = base64_encode($datos['tipo']);
        
        header("Location: ../vista/tipotorneo/detalle_tipotorneo.php?id=$idEncoded&nom=$nomEncoded&tipo=$tipoEncoded");
        exit;
    }
}

############################################################################
### MOSTRAR PARA EDITAR ####################################################
############################################################################
if(isset($_GET['M']) && $_GET['M'] == "mos"){
    if(!isset($_GET['I'])) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'ID de tipo de torneo no proporcionado.'];
        header("Location: ../vista/tipotorneo/tipotorneo.php");
        exit;
    }
    
    $id = $_GET['I'];
    
    if(!is_numeric($id)) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'ID de tipo de torneo inválido.'];
        header("Location: ../vista/tipotorneo/tipotorneo.php");
        exit;
    }
    
    $tipoTorneo->setIdTipoTorneo($id);
    $datos = $tipoTorneo->MostrarTipoTorneo($tipoTorneo->getIdTipoTorneo());
    
    if($datos === false){
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se encontró el tipo de torneo solicitado.'];
        header("Location: ../vista/tipotorneo/tipotorneo.php");
        exit;
    } else {
        $idEncoded = base64_encode($datos['idTipoTorneo']);
        $nomEncoded = base64_encode($datos['nombre']);
        $tipoEncoded = base64_encode($datos['tipo']);
        
        header("Location: ../vista/tipotorneo/edit_tipotorneo.php?id=$idEncoded&nom=$nomEncoded&tipo=$tipoEncoded");
        exit;
    }
}

############################################################################
### ACTUALIZAR #############################################################
############################################################################
if(isset($_POST['actualizar']) && $_POST['actualizar'] == "actualizar"){
    $errores = [];
    $nombre = trim($_POST['nombre']);
    $tipo = isset($_POST['tipo']) ? $_POST['tipo'] : '';
    
    if(empty($nombre)) {
        $errores[] = "El nombre es requerido";
    } elseif(!validarNombreTipoTorneo($nombre)) {
        $errores[] = "El nombre solo puede contener letras y espacios";
    }
    
    if(empty($tipo)) {
        $errores[] = "El tipo es requerido";
    } elseif(!validarTipoTorneo($tipo)) {
        $errores[] = "El tipo debe ser: individual, equipo o mixto";
    }
    
    if(!empty($errores)) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error de Validación', 'text' => implode('<br>', $errores)];
        $idParam = isset($_POST['id']) ? $_POST['id'] : '';
        $nomParam = isset($_POST['nombre_original']) ? $_POST['nombre_original'] : '';
        $tipoParam = isset($_POST['tipo_original']) ? $_POST['tipo_original'] : '';
        header("Location: ../vista/tipotorneo/edit_tipotorneo.php?id=$idParam&nom=$nomParam&tipo=$tipoParam");
        exit;
    }

    $id = base64_decode($_POST['id']);
    $nombre = trim($_POST['nombre']);
    $tipo = $_POST['tipo'];
    
    $datos = $tipoTorneo->ActualizarTipoTorneo($id, $nombre, $tipo);
    
    if($datos){ 
        $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => 'Tipo de Torneo actualizado con éxito.'];
        header("Location: ../vista/tipotorneo/tipotorneo.php");
        exit;
    } else {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se pudo actualizar. El tipo de torneo ya existe o hubo un error.'];
        $idParam = isset($_POST['id']) ? $_POST['id'] : '';
        $nomParam = isset($_POST['nombre_original']) ? $_POST['nombre_original'] : '';
        $tipoParam = isset($_POST['tipo_original']) ? $_POST['tipo_original'] : '';
        header("Location: ../vista/tipotorneo/edit_tipotorneo.php?id=$idParam&nom=$nomParam&tipo=$tipoParam");
        exit;
    }
}

############################################################################
### ELIMINAR ###############################################################
############################################################################
if(isset($_GET['E']) && $_GET['E'] == "eli"){
    if(!isset($_GET['I'])) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'ID de tipo de torneo no proporcionado.'];
        header("Location: ../vista/tipotorneo/tipotorneo.php");
        exit;
    }
    
    $id = base64_decode($_GET['I']);
    
    if(!is_numeric($id)) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'ID de tipo de torneo inválido.'];
        header("Location: ../vista/tipotorneo/tipotorneo.php");
        exit;
    }
    
    $tipoTorneo->setIdTipoTorneo($id);

    try {
        $datos = $tipoTorneo->EliminarTipoTorneo($tipoTorneo->getIdTipoTorneo());
        
        if($datos){
            $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => 'Tipo de Torneo eliminado con éxito.'];
        } else {
            $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se pudo eliminar el tipo de torneo.'];
        }
        
    } catch (Exception $e) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => $e->getMessage()];
    }
    
    header("Location: ../vista/tipotorneo/tipotorneo.php");
    exit;
}

?>