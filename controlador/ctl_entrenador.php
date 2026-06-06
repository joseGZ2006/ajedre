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
    // Validaciones del lado del servidor
    $errores = [];
    
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
    
    if(!empty($_POST['telefono']) && !preg_match('/^\d{4}-\d{7}$/', $_POST['telefono'])) {
      $errores[] = "El teléfono debe tener el formato: 0412-1234567";
    }
    
    if(!empty($errores)) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error de Validación', 'text' => implode('<br>', $errores)];
        header("Location: ../vista/entrenadores/insert_entrenador.php");
        exit;
    }

    // Setear las variables o propiedades
    $ent->setCedula(trim($_POST['cedula']));
    $ent->setNombre(trim($_POST['nombre']));
    $ent->setApellido(trim($_POST['apellido']));
    $ent->setTelefono(!empty($_POST['telefono']) ? trim($_POST['telefono']) : null);
    
    // Opcional: si se quiere asignar usuario y especialidad
    $id_usuario = isset($_POST['id_usuario']) && !empty($_POST['id_usuario']) ? $_POST['id_usuario'] : null;
    $id_especialidad = isset($_POST['id_especialidad']) && !empty($_POST['id_especialidad']) ? $_POST['id_especialidad'] : null;

    // Invocamos al método de Registrar
    $datos = $ent->RegistrarEntrenador(
        $ent->getCedula(),
        $ent->getNombre(),
        $ent->getApellido(),
        $ent->getTelefono(),
        $id_usuario,
        $id_especialidad
    );
    
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
    // Invocamos al método de Listar
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
    // Mostrar (desencriptar) el valor de la variable 
    $ced = base64_decode($_GET['I']);
    // Setear las variables o propiedades
    $ent->setCedula($ced);

    // Invocamos al método de Consultar
    $datos = $ent->ConsultarEntrenador($ent->getCedula());
    
    if($datos === false){
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se encontró el entrenador solicitado.'];
        header("Location: ../vista/entrenadores/entrenador.php");
        exit;
    } else {
        // Ocultar (encriptar) el valor de las variables 
        $id = base64_encode($datos[0]);      // idEntrenador
        $ced = base64_encode($datos[1]);     // cedula
        $nom = base64_encode($datos[2]);     // nombre
        $ape = base64_encode($datos[3]);     // apellido
        $tel = base64_encode($datos[4]);     // telefono
        $idUsu = base64_encode($datos[5]);   // idUsuario
        $idEsp = base64_encode($datos[6]);   // idEspecialidad
        
        // Enviar los valores por la URL al archivo php
        header("Location: ../vista/entrenadores/detalle_entrenador.php?id=$id&ced=$ced&nom=$nom&ape=$ape&tel=$tel&idu=$idUsu&idesp=$idEsp");
        exit;
    }
}

############################################################################
### MOSTRAR ################################################################
############################################################################
if(isset($_GET['M']) && $_GET['M'] == "mos"){
    // Mostrar (desencriptar) el valor de la variable 
    $ced = base64_decode($_GET['I']);
    // Setear las variables o propiedades
    $ent->setCedula($ced);

    // Invocamos al método de Mostrar
    $datos = $ent->MostrarEntrenador($ent->getCedula());
    
    if($datos === false){
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se encontró el entrenador solicitado.'];
        header("Location: ../vista/entrenadores/entrenador.php");
        exit;
    } else {
        // Ocultar (encriptar) el valor de las variables 
        $id = base64_encode($datos[0]);      // idEntrenador
        $ced = base64_encode($datos[1]);     // cedula
        $nom = base64_encode($datos[2]);     // nombre
        $ape = base64_encode($datos[3]);     // apellido
        $tel = base64_encode($datos[4]);     // telefono
        $idUsu = base64_encode($datos[5]);   // idUsuario
        $idEsp = base64_encode($datos[6]);   // idEspecialidad
        $nomUsu = base64_encode($datos[7]);  // nombreUsuario
        $rol = base64_encode($datos[8]);     // rol
        $espNom = base64_encode($datos[9]);   // especialidad_nombre

        // Enviar los valores por la URL al archivo php
        header("Location: ../vista/entrenadores/edit_entrenador.php?id=$id&ced=$ced&nom=$nom&ape=$ape&tel=$tel&idu=$idUsu&idesp=$idEsp&nomusu=$nomUsu&rol=$rol&espnom=$espNom");
        exit;
    }
}

############################################################################
### ACTUALIZAR #############################################################
############################################################################
if(isset($_POST['modificar']) && $_POST['modificar'] == "modificar"){
    // Validaciones del lado del servidor
    $errores = [];
    
    
    
    if(!empty($_POST['telefono']) && !preg_match('/^\d{4}-\d{7}$/', $_POST['telefono'])) {
      $errores[] = "El teléfono debe tener el formato: 0412-1234567";
    }
    
    if(!empty($errores)) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error de Validación', 'text' => implode('<br>', $errores)];
        $ced_enc = base64_encode($_POST['cedula']);
        header("Location: ../vista/entrenadores/edit_entrenador.php?ced=$ced_enc");
        exit;
    }

    // Setear las variables o propiedades
    $ent->setCedula($_POST['cedula']);
    $ent->setNombre(trim($_POST['nombre']));
    $ent->setApellido(trim($_POST['apellido']));
    $ent->setTelefono(!empty($_POST['telefono']) ? trim($_POST['telefono']) : null);
    
    // Opcional: si se quiere actualizar usuario y especialidad
    $id_usuario = isset($_POST['id_usuario']) && !empty($_POST['id_usuario']) ? $_POST['id_usuario'] : null;
    $id_especialidad = isset($_POST['id_especialidad']) && !empty($_POST['id_especialidad']) ? $_POST['id_especialidad'] : null;

    $datos = $ent->ActualizarEntrenador(
        $ent->getCedula(),
        $ent->getNombre(),
        $ent->getApellido(),
        $ent->getTelefono(),
        $id_usuario,
        $id_especialidad
    );
    
    if($datos){
        $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => 'Entrenador actualizado con éxito.'];
        header("Location: ../vista/entrenadores/entrenador.php");
        exit;
    } else {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se pudo actualizar los datos. La cédula no existe o hubo un error.'];
        $ced_enc = base64_encode($_POST['cedula']);
        header("Location: ../vista/entrenadores/edit_entrenador.php?ced=$ced_enc");
        exit;
    }
}

############################################################################
### ELIMINAR ###############################################################
############################################################################
if(isset($_GET['E']) && $_GET['E'] == "eli"){
    // Mostrar (desencriptar) el valor de la variable 
    $ced = base64_decode($_GET['I']);
    // Setear las variables o propiedades
    $ent->setCedula($ced);

    try {
        // Invocamos al método de Eliminar
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