<?php
session_start();
include("../modelo/conexion.php");
include("../modelo/clase_representante.php");

$rep = new Representante();

############################################################################
### REGISTRAR ##############################################################
############################################################################
if(isset($_POST['registrar']) && $_POST['registrar'] == "registrar"){
  
    $cedula = trim($_POST['cedula']);
    $nombre = trim($_POST['nombre']);
    $apellido = trim($_POST['apellido']);
    $correo = trim($_POST['correo']);
    $telefono = trim($_POST['telefono']);
    $parentesco = trim($_POST['parentesco']);

    $rep->setCedula($cedula);
    $rep->setNombre($nombre);
    $rep->setApellido($apellido);
    $rep->setCorreo($correo);
    $rep->setTelefono($telefono);
    $rep->setParentesco($parentesco);

    $resultado = $rep->RegistrarRepresentante(
        $rep->getCedula(), 
        $rep->getNombre(), 
        $rep->getApellido(), 
        $rep->getCorreo(), 
        $rep->getTelefono(), 
        $rep->getParentesco()
    );
    
    if($resultado['success']){ 
        $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => 'Representante registrado con éxito.'];
        header("Location: ../vista/representantes/representante.php");
        exit;
    } else {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => implode(', ', $resultado['errores'])];
        header("Location: ../vista/representantes/insert_representante.php");
        exit;
    }
}

############################################################################
### ACTUALIZAR #############################################################
############################################################################
if(isset($_POST['actualizar']) && $_POST['actualizar'] == "actualizar"){
  
    $idRepresentante = trim($_POST['idRepresentante']);
    $correo = trim($_POST['correo']);
    $telefono = trim($_POST['telefono']);
    $parentesco = trim($_POST['parentesco']);

    $resultado = $rep->ActualizarRepresentante($idRepresentante, $correo, $telefono, $parentesco);
    
    if($resultado['success']){ 
        $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => 'Representante actualizado con éxito.'];
        header("Location: ../vista/representantes/representante.php");
        exit;
    } else {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => implode(', ', $resultado['errores'])];
        header("Location: ../vista/representantes/edit_representante.php?ced=" . base64_encode($_POST['cedula_original']));
        exit;
    }
}

############################################################################
### ELIMINAR ###############################################################
############################################################################
if(isset($_POST['eliminar']) && $_POST['eliminar'] == "eliminar"){
  
    $idRepresentante = trim($_POST['idRepresentante']);

    $resultado = $rep->EliminarRepresentante($idRepresentante);
    
    if($resultado['success']){ 
        $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => 'Representante eliminado con éxito.'];
    } else {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => implode(', ', $resultado['errores'])];
    }
    
    header("Location: ../vista/representantes/representante.php");
    exit;
}

############################################################################
### LISTAR #################################################################
############################################################################
if(isset($_GET['L']) && $_GET['L'] == "lis"){
    $datos = $rep->ListarRepresentante();

    if($datos === false || empty($datos)){
        $_SESSION['flash'] = ['icon' => 'info', 'title' => 'Información', 'text' => 'No hay representantes registrados.'];
    }
    
    header("Location: ../vista/representantes/representante.php");
    exit;
}

#############################################################################
### CONSULTAR (para detalle) ################################################
#############################################################################
if(isset($_GET['C']) && $_GET['C'] == "con"){
    $ced = base64_decode($_GET['I']);
    $datos = $rep->ConsultarRepresentante($ced);
    
    if($datos === false){
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se encontró el representante solicitado.'];
        header("Location: ../vista/representantes/representante.php");
        exit;
    } else {
        $ced = base64_encode($datos[1]);
        header("Location: ../vista/representantes/detalle_representante.php?ced=$ced");
        exit;
    }
}

############################################################################
### MOSTRAR (para editar) ##################################################
############################################################################
if(isset($_GET['M']) && $_GET['M'] == "mos"){
    $ced = base64_decode($_GET['I']);
    $datos = $rep->MostrarRepresentante($ced);
    
    if($datos === false){
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se encontró el representante solicitado.'];
        header("Location: ../vista/representantes/representante.php");
        exit;
    } else {
        // Guardar datos en sesión para el formulario de edición
        $_SESSION['edit_representante'] = [
            'idRepresentante' => $datos[0],
            'cedula' => $datos[1],
            'nombre' => $datos[2],
            'apellido' => $datos[3],
            'correo' => $datos[4],
            'telefono' => $datos[5],
            'parentesco' => $datos[6]
        ];
        header("Location: ../vista/representantes/edit_representante.php");
        exit;
    }
}
?>