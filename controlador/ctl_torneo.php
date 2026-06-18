<?php
session_start();
include("../modelo/conexion.php");
include("../modelo/clase_torneo.php");

$torneo = new Torneo();

// Función para validar nombre (consistente con la clase)
function validarNombreTorneo($nombre) {
    if(empty($nombre)) {
        return false;
    }
    return preg_match('/^[a-zA-ZáéíóúñÁÉÍÓÚÑ0-9\s\-\.]+$/', $nombre);
}

// Función para validar fecha
function validarFechaTorneo($fecha) {
    if(empty($fecha)) {
        return false;
    }
    $fechaObj = DateTime::createFromFormat('Y-m-d', $fecha);
    return $fechaObj && $fechaObj->format('Y-m-d') === $fecha;
}

// Función para validar estatus
function validarEstatusTorneo($estatus) {
    $estatusPermitidos = ['proximo', 'en_curso', 'finalizado', 'cancelado'];
    return in_array($estatus, $estatusPermitidos);
}

// Función para validar cupo
function validarCupoTorneo($cupo) {
    return is_numeric($cupo) && $cupo > 0 && $cupo <= 1000;
}

############################################################################
### REGISTRAR ##############################################################
############################################################################
if(isset($_POST['registrar']) && $_POST['registrar'] == "registrar"){
    $errores = [];
    $idTipoTorneo = isset($_POST['idTipoTorneo']) && $_POST['idTipoTorneo'] != '' ? $_POST['idTipoTorneo'] : null;
    $nombre = trim($_POST['nombre']);
    $fecha = trim($_POST['fecha']);
    $lugar = trim($_POST['lugar']);
    $categoria = trim($_POST['categoria']);
    $clasificacion = trim($_POST['clasificacion']);
    $estatus = isset($_POST['estatus']) ? $_POST['estatus'] : '';
    $cupo = isset($_POST['cupo']) ? trim($_POST['cupo']) : '';
    
    if(empty($nombre)) {
        $errores[] = "El nombre es requerido";
    } elseif(!validarNombreTorneo($nombre)) {
        $errores[] = "El nombre solo puede contener letras, números, espacios, guiones y puntos";
    }
    
    if(empty($fecha)) {
        $errores[] = "La fecha es requerida";
    } elseif(!validarFechaTorneo($fecha)) {
        $errores[] = "La fecha no es válida (formato YYYY-MM-DD)";
    }
    
    if(empty($lugar)) {
        $errores[] = "El lugar es requerido";
    } elseif(!validarNombreTorneo($lugar)) {
        $errores[] = "El lugar solo puede contener letras, números, espacios, guiones y puntos";
    }
    
    if(empty($estatus)) {
        $errores[] = "El estatus es requerido";
    } elseif(!validarEstatusTorneo($estatus)) {
        $errores[] = "El estatus debe ser: proximo, en_curso, finalizado o cancelado";
    }
    
    if(empty($cupo)) {
        $errores[] = "El cupo es requerido";
    } elseif(!validarCupoTorneo($cupo)) {
        $errores[] = "El cupo debe ser un número positivo mayor a 0 y menor a 1001";
    }
    
    if(!empty($errores)) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error de Validación', 'text' => implode('<br>', $errores)];
        header("Location: ../vista/torneo/insert_torneo.php");
        exit;
    }

    $resultado = $torneo->RegistrarTorneo($idTipoTorneo, $nombre, $fecha, $lugar, $categoria, $clasificacion, $estatus, $cupo);
    
    if($resultado['success']){ 
        $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => 'Torneo Registrado con éxito.'];
        header("Location: ../vista/torneo/torneo.php");
        exit;
    } else {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => $resultado['error']];
        header("Location: ../vista/torneo/insert_torneo.php");
        exit;
    }
}

############################################################################
### LISTAR #################################################################
############################################################################
if(isset($_GET['L']) && $_GET['L'] == "lis"){
    $datos = $torneo->ListarTorneo();

    if($datos === false || empty($datos)){
        $_SESSION['flash'] = ['icon' => 'info', 'title' => 'Información', 'text' => 'No hay torneos registrados.'];
    }
    
    header("Location: ../vista/torneo/torneo.php");
    exit;
}

#############################################################################
### CONSULTAR (VER DETALLE) #################################################
#############################################################################
if(isset($_GET['C']) && $_GET['C'] == "con"){
    if(!isset($_GET['I'])) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'ID de torneo no proporcionado.'];
        header("Location: ../vista/torneo/torneo.php");
        exit;
    }
    
    $id = $_GET['I'];
    
    if(!is_numeric($id)) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'ID de torneo inválido.'];
        header("Location: ../vista/torneo/torneo.php");
        exit;
    }
    
    $datos = $torneo->ConsultarTorneo($id);
    
    if($datos === false){
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se encontró el torneo solicitado.'];
        header("Location: ../vista/torneo/torneo.php");
        exit;
    } else {
        $idEncoded = base64_encode($datos['idTorneo']);
        $nomEncoded = base64_encode($datos['nombre']);
        $fechaEncoded = base64_encode($datos['fecha']);
        $lugarEncoded = base64_encode($datos['lugar']);
        $categoriaEncoded = base64_encode($datos['categoria'] ?? '');
        $clasificacionEncoded = base64_encode($datos['clasificacion'] ?? '');
        $estatusEncoded = base64_encode($datos['estatus']);
        $cupoEncoded = base64_encode($datos['cupo']);
        $tipoEncoded = base64_encode($datos['idTipoTorneo'] ?? '');
        $tipoNombreEncoded = base64_encode($datos['tipo_torneo_nombre'] ?? 'Sin tipo');
        
        header("Location: ../vista/torneo/detalle_torneo.php?id=$idEncoded&nom=$nomEncoded&fecha=$fechaEncoded&lugar=$lugarEncoded&categoria=$categoriaEncoded&clasificacion=$clasificacionEncoded&estatus=$estatusEncoded&cupo=$cupoEncoded&tipo=$tipoEncoded&tipoNombre=$tipoNombreEncoded");
        exit;
    }
}

############################################################################
### MOSTRAR PARA EDITAR ####################################################
############################################################################
if(isset($_GET['M']) && $_GET['M'] == "mos"){
    if(!isset($_GET['I'])) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'ID de torneo no proporcionado.'];
        header("Location: ../vista/torneo/torneo.php");
        exit;
    }
    
    $id = $_GET['I'];
    
    if(!is_numeric($id)) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'ID de torneo inválido.'];
        header("Location: ../vista/torneo/torneo.php");
        exit;
    }
    
    $datos = $torneo->MostrarTorneo($id);
    
    if($datos === false){
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se encontró el torneo solicitado.'];
        header("Location: ../vista/torneo/torneo.php");
        exit;
    } else {
        $idEncoded = base64_encode($datos['idTorneo']);
        $nomEncoded = base64_encode($datos['nombre']);
        $fechaEncoded = base64_encode($datos['fecha']);
        $lugarEncoded = base64_encode($datos['lugar']);
        $categoriaEncoded = base64_encode($datos['categoria'] ?? '');
        $clasificacionEncoded = base64_encode($datos['clasificacion'] ?? '');
        $estatusEncoded = base64_encode($datos['estatus']);
        $cupoEncoded = base64_encode($datos['cupo']);
        $tipoEncoded = base64_encode($datos['idTipoTorneo'] ?? '');
        
        header("Location: ../vista/torneo/edit_torneo.php?id=$idEncoded&nom=$nomEncoded&fecha=$fechaEncoded&lugar=$lugarEncoded&categoria=$categoriaEncoded&clasificacion=$clasificacionEncoded&estatus=$estatusEncoded&cupo=$cupoEncoded&tipo=$tipoEncoded");
        exit;
    }
}

############################################################################
### ACTUALIZAR #############################################################
############################################################################
if(isset($_POST['actualizar']) && $_POST['actualizar'] == "actualizar"){
    $errores = [];
    $idTipoTorneo = isset($_POST['idTipoTorneo']) && $_POST['idTipoTorneo'] != '' ? $_POST['idTipoTorneo'] : null;
    $nombre = trim($_POST['nombre']);
    $fecha = trim($_POST['fecha']);
    $lugar = trim($_POST['lugar']);
    $categoria = trim($_POST['categoria']);
    $clasificacion = trim($_POST['clasificacion']);
    $estatus = isset($_POST['estatus']) ? $_POST['estatus'] : '';
    $cupo = isset($_POST['cupo']) ? trim($_POST['cupo']) : '';
    
    if(empty($nombre)) {
        $errores[] = "El nombre es requerido";
    } elseif(!validarNombreTorneo($nombre)) {
        $errores[] = "El nombre solo puede contener letras, números, espacios, guiones y puntos";
    }
    
    if(empty($fecha)) {
        $errores[] = "La fecha es requerida";
    } elseif(!validarFechaTorneo($fecha)) {
        $errores[] = "La fecha no es válida (formato YYYY-MM-DD)";
    }
    
    if(empty($lugar)) {
        $errores[] = "El lugar es requerido";
    } elseif(!validarNombreTorneo($lugar)) {
        $errores[] = "El lugar solo puede contener letras, números, espacios, guiones y puntos";
    }
    
    if(empty($estatus)) {
        $errores[] = "El estatus es requerido";
    } elseif(!validarEstatusTorneo($estatus)) {
        $errores[] = "El estatus debe ser: proximo, en_curso, finalizado o cancelado";
    }
    
    if(empty($cupo)) {
        $errores[] = "El cupo es requerido";
    } elseif(!validarCupoTorneo($cupo)) {
        $errores[] = "El cupo debe ser un número positivo mayor a 0 y menor a 1001";
    }
    
    if(!empty($errores)) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error de Validación', 'text' => implode('<br>', $errores)];
        $idParam = isset($_POST['id']) ? $_POST['id'] : '';
        $nomParam = isset($_POST['nombre_original']) ? $_POST['nombre_original'] : '';
        $fechaParam = isset($_POST['fecha_original']) ? $_POST['fecha_original'] : '';
        $lugarParam = isset($_POST['lugar_original']) ? $_POST['lugar_original'] : '';
        $categoriaParam = isset($_POST['categoria_original']) ? $_POST['categoria_original'] : '';
        $clasificacionParam = isset($_POST['clasificacion_original']) ? $_POST['clasificacion_original'] : '';
        $estatusParam = isset($_POST['estatus_original']) ? $_POST['estatus_original'] : '';
        $cupoParam = isset($_POST['cupo_original']) ? $_POST['cupo_original'] : '';
        $tipoParam = isset($_POST['tipo_original']) ? $_POST['tipo_original'] : '';
        header("Location: ../vista/torneo/edit_torneo.php?id=$idParam&nom=$nomParam&fecha=$fechaParam&lugar=$lugarParam&categoria=$categoriaParam&clasificacion=$clasificacionParam&estatus=$estatusParam&cupo=$cupoParam&tipo=$tipoParam");
        exit;
    }

    $id = base64_decode($_POST['id']);
    
    $resultado = $torneo->ActualizarTorneo($id, $idTipoTorneo, $nombre, $fecha, $lugar, $categoria, $clasificacion, $estatus, $cupo);
    
    if($resultado['success']){ 
        $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => 'Torneo actualizado con éxito.'];
        header("Location: ../vista/torneo/torneo.php");
        exit;
    } else {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => $resultado['error']];
        $idParam = isset($_POST['id']) ? $_POST['id'] : '';
        $nomParam = isset($_POST['nombre_original']) ? $_POST['nombre_original'] : '';
        $fechaParam = isset($_POST['fecha_original']) ? $_POST['fecha_original'] : '';
        $lugarParam = isset($_POST['lugar_original']) ? $_POST['lugar_original'] : '';
        $categoriaParam = isset($_POST['categoria_original']) ? $_POST['categoria_original'] : '';
        $clasificacionParam = isset($_POST['clasificacion_original']) ? $_POST['clasificacion_original'] : '';
        $estatusParam = isset($_POST['estatus_original']) ? $_POST['estatus_original'] : '';
        $cupoParam = isset($_POST['cupo_original']) ? $_POST['cupo_original'] : '';
        $tipoParam = isset($_POST['tipo_original']) ? $_POST['tipo_original'] : '';
        header("Location: ../vista/torneo/edit_torneo.php?id=$idParam&nom=$nomParam&fecha=$fechaParam&lugar=$lugarParam&categoria=$categoriaParam&clasificacion=$clasificacionParam&estatus=$estatusParam&cupo=$cupoParam&tipo=$tipoParam");
        exit;
    }
}

############################################################################
### ELIMINAR ###############################################################
############################################################################
if(isset($_GET['E']) && $_GET['E'] == "eli"){
    if(!isset($_GET['I'])) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'ID de torneo no proporcionado.'];
        header("Location: ../vista/torneo/torneo.php");
        exit;
    }
    
    $id = base64_decode($_GET['I']);
    
    if(!is_numeric($id)) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'ID de torneo inválido.'];
        header("Location: ../vista/torneo/torneo.php");
        exit;
    }
    
    $resultado = $torneo->EliminarTorneo($id);
    
    if($resultado['success']){
        $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => 'Torneo eliminado con éxito.'];
    } else {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => $resultado['error']];
    }
    
    header("Location: ../vista/torneo/torneo.php");
    exit;
}

?>