<?php
session_start();
header('Content-Type: application/json');

// Manejo de errores para AJAX
error_reporting(E_ALL);
ini_set('display_errors', 0); // No mostrar errores en pantalla

// Función para enviar respuesta JSON segura
function jsonResponse($success, $message, $data = []) {
    echo json_encode(array_merge(['success' => $success, 'message' => $message], $data));
    exit;
}

include("../modelo/conexion.php");
include("../modelo/clase_representante.php");

$rep = new Representante();

############################################################################
### REGISTRAR REPRESENTANTE (AJAX) #########################################
############################################################################
if(isset($_POST['registrar_ajax']) && $_POST['registrar_ajax'] == "registrar_ajax"){
    
    // Validar campos requeridos
    $errores = [];
    
    $cedula = trim($_POST['cedula'] ?? '');
    $nombre = trim($_POST['nombre'] ?? '');
    $apellido = trim($_POST['apellido'] ?? '');
    $correo = trim($_POST['correo'] ?? '');
    $telefono = trim($_POST['telefono'] ?? '');
    $parentesco = trim($_POST['parentesco'] ?? 'Tutor');
    
    if(empty($cedula)) $errores[] = 'La cédula es requerida';
    if(empty($nombre)) $errores[] = 'El nombre es requerido';
    if(empty($apellido)) $errores[] = 'El apellido es requerido';
    if(empty($correo)) $errores[] = 'El correo es requerido';
    if(!empty($correo) && !filter_var($correo, FILTER_VALIDATE_EMAIL)) $errores[] = 'El correo no es válido';
    
    if(!empty($errores)){
        jsonResponse(false, implode(', ', $errores));
    }
    
    // Verificar si la cédula ya existe
    try {
        $verificar = $conex->prepare("SELECT COUNT(*) FROM REPRESENTANTE WHERE cedula = ?");
        $verificar->execute([$cedula]);
        if($verificar->fetchColumn() > 0){
            jsonResponse(false, 'Ya existe un representante con esta cédula');
        }
    } catch(PDOException $e){
        jsonResponse(false, 'Error al verificar cédula: ' . $e->getMessage());
    }

    $resultado = $rep->RegistrarRepresentante(
        $cedula, 
        $nombre, 
        $apellido, 
        $correo, 
        $telefono, 
        $parentesco
    );
    
    if($resultado['success']){ 
        try {
            // Obtener el ID del representante recién insertado
            $sql = $conex->prepare("SELECT idRepresentante FROM REPRESENTANTE WHERE cedula = ?");
            $sql->execute([$cedula]);
            $row = $sql->fetch(PDO::FETCH_ASSOC);
            
            if($row) {
                jsonResponse(true, 'Representante registrado con éxito', [
                    'id' => $row['idRepresentante'],
                    'cedula' => $cedula,
                    'nombre' => $nombre,
                    'apellido' => $apellido,
                    'parentesco' => $parentesco
                ]);
            } else {
                jsonResponse(false, 'Representante registrado pero no se pudo obtener el ID');
            }
        } catch(PDOException $e) {
            jsonResponse(false, 'Error al obtener ID del representante');
        }
    } else {
        $mensaje = isset($resultado['errores']) ? implode(', ', $resultado['errores']) : 'Error al registrar representante';
        jsonResponse(false, $mensaje);
    }
    exit;
}

############################################################################
### LISTAR REPRESENTANTES (AJAX) ###########################################
############################################################################
if(isset($_GET['action']) && $_GET['action'] == 'listar'){
    try {
        $sql = $conex->prepare("SELECT idRepresentante, cedula, nombre, apellido, parentesco, correo, telefono FROM REPRESENTANTE ORDER BY nombre, apellido");
        $sql->execute();
        $representantes = $sql->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode([
            'success' => true,
            'representantes' => $representantes
        ]);
    } catch(PDOException $e) {
        echo json_encode([
            'success' => false,
            'message' => 'Error al cargar representantes: ' . $e->getMessage(),
            'representantes' => []
        ]);
    }
    exit;
}

// Si no se especificó ninguna acción
jsonResponse(false, 'Acción no válida');
?>