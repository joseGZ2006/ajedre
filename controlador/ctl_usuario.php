<?php
session_start();
include("../modelo/conexion.php");
include("../modelo/clase_usuario.php");

$usuario = new Usuario();

// Función para validar nombre de usuario
function validarNombreUsuario($nombre) {
    if(empty($nombre)) {
        return false;
    }
    return preg_match('/^[a-zA-Z0-9_.-]{3,50}$/', $nombre);
}

// Función para validar rol
function validarRol($rol) {
    $rolesPermitidos = ['admin', 'entrenador', 'alumno'];
    return in_array($rol, $rolesPermitidos);
}

// Función para validar estatus
function validarEstatus($estatus) {
    $estatusPermitidos = ['activo', 'inactivo'];
    return in_array($estatus, $estatusPermitidos);
}

############################################################################
### REGISTRAR ##############################################################
############################################################################
if(isset($_POST['registrar']) && $_POST['registrar'] == "registrar"){
    $errores = [];
    $nombreUsuario = trim($_POST['nombreUsuario']);
    $contrasena = $_POST['contrasena'];
    $rol = $_POST['rol'];
    $estatus = $_POST['estatus'];
    
    // Validaciones
    if(empty($nombreUsuario)) {
        $errores[] = "El nombre de usuario es requerido";
    } elseif(!validarNombreUsuario($nombreUsuario)) {
        $errores[] = "El nombre de usuario debe tener entre 3 y 50 caracteres y solo puede contener letras, números, puntos, guiones o guión bajo";
    }
    
    if(empty($contrasena)) {
        $errores[] = "La contraseña es requerida";
    } elseif(strlen($contrasena) < 6) {
        $errores[] = "La contraseña debe tener al menos 6 caracteres";
    }
    
    if(empty($rol)) {
        $errores[] = "El rol es requerido";
    } elseif(!validarRol($rol)) {
        $errores[] = "Rol no válido";
    }
    
    if(empty($estatus)) {
        $errores[] = "El estatus es requerido";
    } elseif(!validarEstatus($estatus)) {
        $errores[] = "Estatus no válido";
    }
    
    if(!empty($errores)) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error de Validación', 'text' => implode('<br>', $errores)];
        header("Location: ../vista/usuario/insert_usuario.php");
        exit;
    }

    $usuario->setNombreUsuario($nombreUsuario);
    $usuario->setContrasena($contrasena);
    $usuario->setRol($rol);
    $usuario->setEstatus($estatus);
    
    $datos = $usuario->RegistrarUsuario(
        $usuario->getNombreUsuario(),
        $usuario->getContrasena(),
        $usuario->getRol(),
        $usuario->getEstatus()
    );
    
    if($datos === true){ 
        $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => 'Usuario registrado con éxito.'];
        header("Location: ../vista/usuario/usuario.php");
        exit;
    } elseif($datos === 'exists') {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'El nombre de usuario ya existe.'];
        header("Location: ../vista/usuario/insert_usuario.php");
        exit;
    } else {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se pudo registrar el usuario.'];
        header("Location: ../vista/usuario/insert_usuario.php");
        exit;
    }
}

############################################################################
### LISTAR #################################################################
############################################################################
if(isset($_GET['L']) && $_GET['L'] == "lis"){
    $datos = $usuario->ListarUsuarios();

    if($datos === false || empty($datos)){
        $_SESSION['flash'] = ['icon' => 'info', 'title' => 'Información', 'text' => 'No hay usuarios registrados.'];
    }
    
    $_SESSION['lista_usuarios'] = $datos;
    
    header("Location: ../vista/usuario/usuario.php");
    exit;
}

#############################################################################
### CONSULTAR (VER DETALLE) #################################################
#############################################################################
if(isset($_GET['C']) && $_GET['C'] == "con"){
    if(!isset($_GET['I'])) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'ID de usuario no proporcionado.'];
        header("Location: ../vista/usuario/usuario.php");
        exit;
    }
    
    $id = $_GET['I'];
    
    if(!is_numeric($id)) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'ID de usuario inválido.'];
        header("Location: ../vista/usuario/usuario.php");
        exit;
    }
    
    $usuario->setIdUsuario($id);
    $datos = $usuario->ConsultarUsuario($usuario->getIdUsuario());
    
    if($datos === false){
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se encontró el usuario solicitado.'];
        header("Location: ../vista/usuario/usuario.php");
        exit;
    } else {
        // Codificar datos sensibles
        $idEncoded = base64_encode($datos['idUsuario']);
        $nombreEncoded = base64_encode($datos['nombreUsuario']);
        $rolEncoded = base64_encode($datos['rol']);
        $estatusEncoded = base64_encode($datos['estatus']);
        
        header("Location: ../vista/usuario/detalle_usuario.php?id=$idEncoded&nom=$nombreEncoded&rol=$rolEncoded&est=$estatusEncoded");
        exit;
    }
}

############################################################################
### MOSTRAR PARA EDITAR ####################################################
############################################################################
if(isset($_GET['M']) && $_GET['M'] == "mos"){
    if(!isset($_GET['I'])) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'ID de usuario no proporcionado.'];
        header("Location: ../vista/usuario/usuario.php");
        exit;
    }
    
    $id = $_GET['I'];
    
    if(!is_numeric($id)) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'ID de usuario inválido.'];
        header("Location: ../vista/usuario/usuario.php");
        exit;
    }
    
    $usuario->setIdUsuario($id);
    $datos = $usuario->MostrarUsuario($usuario->getIdUsuario());
    
    if($datos === false){
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se encontró el usuario solicitado.'];
        header("Location: ../vista/usuario/usuario.php");
        exit;
    } else {
        // Codificar datos sensibles
        $idEncoded = base64_encode($datos['idUsuario']);
        $nombreEncoded = base64_encode($datos['nombreUsuario']);
        $rolEncoded = base64_encode($datos['rol']);
        $estatusEncoded = base64_encode($datos['estatus']);
        
        header("Location: ../vista/usuario/edit_usuario.php?id=$idEncoded&nom=$nombreEncoded&rol=$rolEncoded&est=$estatusEncoded");
        exit;
    }
}

############################################################################
### ACTUALIZAR #############################################################
############################################################################
if(isset($_POST['actualizar']) && $_POST['actualizar'] == "actualizar"){
    $errores = [];
    $id = base64_decode($_POST['id']);
    $nombreUsuario = trim($_POST['nombreUsuario']);
    $contrasena = !empty($_POST['contrasena']) ? $_POST['contrasena'] : null;
    $rol = $_POST['rol'];
    $estatus = $_POST['estatus'];
    
    // Validaciones
    if(empty($nombreUsuario)) {
        $errores[] = "El nombre de usuario es requerido";
    } elseif(!validarNombreUsuario($nombreUsuario)) {
        $errores[] = "El nombre de usuario debe tener entre 3 y 50 caracteres y solo puede contener letras, números, puntos, guiones o guión bajo";
    }
    
    if($contrasena !== null && strlen($contrasena) < 6) {
        $errores[] = "La contraseña debe tener al menos 6 caracteres";
    }
    
    if(empty($rol)) {
        $errores[] = "El rol es requerido";
    } elseif(!validarRol($rol)) {
        $errores[] = "Rol no válido";
    }
    
    if(empty($estatus)) {
        $errores[] = "El estatus es requerido";
    } elseif(!validarEstatus($estatus)) {
        $errores[] = "Estatus no válido";
    }
    
    if(!empty($errores)) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error de Validación', 'text' => implode('<br>', $errores)];
        $idParam = isset($_POST['id']) ? $_POST['id'] : '';
        $nomParam = isset($_POST['nombre_original']) ? $_POST['nombre_original'] : '';
        $rolParam = isset($_POST['rol_original']) ? $_POST['rol_original'] : '';
        $estParam = isset($_POST['estatus_original']) ? $_POST['estatus_original'] : '';
        header("Location: ../vista/usuario/edit_usuario.php?id=$idParam&nom=$nomParam&rol=$rolParam&est=$estParam");
        exit;
    }

    $datos = $usuario->ActualizarUsuario($id, $nombreUsuario, $contrasena, $rol, $estatus);
    
    if($datos === true){ 
        $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => 'Usuario actualizado con éxito.'];
        header("Location: ../vista/usuario/usuario.php");
        exit;
    } elseif($datos === 'exists') {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'El nombre de usuario ya existe.'];
        $idParam = isset($_POST['id']) ? $_POST['id'] : '';
        $nomParam = isset($_POST['nombre_original']) ? $_POST['nombre_original'] : '';
        $rolParam = isset($_POST['rol_original']) ? $_POST['rol_original'] : '';
        $estParam = isset($_POST['estatus_original']) ? $_POST['estatus_original'] : '';
        header("Location: ../vista/usuario/edit_usuario.php?id=$idParam&nom=$nomParam&rol=$rolParam&est=$estParam");
        exit;
    } else {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se pudo actualizar el usuario.'];
        $idParam = isset($_POST['id']) ? $_POST['id'] : '';
        $nomParam = isset($_POST['nombre_original']) ? $_POST['nombre_original'] : '';
        $rolParam = isset($_POST['rol_original']) ? $_POST['rol_original'] : '';
        $estParam = isset($_POST['estatus_original']) ? $_POST['estatus_original'] : '';
        header("Location: ../vista/usuario/edit_usuario.php?id=$idParam&nom=$nomParam&rol=$rolParam&est=$estParam");
        exit;
    }
}

############################################################################
### ELIMINAR ###############################################################
############################################################################
if(isset($_GET['E']) && $_GET['E'] == "eli"){
    if(!isset($_GET['I'])) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'ID de usuario no proporcionado.'];
        header("Location: ../vista/usuario/usuario.php");
        exit;
    }
    
    $id = base64_decode($_GET['I']);
    
    if(!is_numeric($id)) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'ID de usuario inválido.'];
        header("Location: ../vista/usuario/usuario.php");
        exit;
    }
    
    $usuario->setIdUsuario($id);

    try {
        $datos = $usuario->EliminarUsuario($usuario->getIdUsuario());
        
        if($datos === true){
            $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => 'Usuario eliminado con éxito.'];
        } elseif($datos === 'in_use') {
            $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se puede eliminar el usuario porque está siendo utilizado en otros registros.'];
        } else {
            $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se pudo eliminar el usuario.'];
        }
        
    } catch (Exception $e) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => $e->getMessage()];
    }
    
    header("Location: ../vista/usuario/usuario.php");
    exit;
}

############################################################################
### INICIAR SESION #########################################################
############################################################################
if(isset($_POST['aceptar']) && $_POST['aceptar'] == "aceptar"){
    $nombreUsuario = trim($_POST['nombreUsuario']);
    $contrasena = $_POST['contrasena'];
    
    // Validaciones básicas
    if(empty($nombreUsuario)) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'Ingrese su nombre de usuario.'];
        header("Location: ../vista/loyaut/login.php");
        exit;
    }
    
    if(empty($contrasena)) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'Ingrese su contraseña.'];
        header("Location: ../vista/loyaut/login.php");
        exit;
    }
    
    $resultado = $usuario->IniciarSesion($nombreUsuario, $contrasena);
    
    if(is_array($resultado)){
        // Inicio de sesión exitoso
        $_SESSION['id_ses'] = $resultado['idUsuario'];
        $_SESSION['usu_ses'] = $resultado['nombreUsuario'];
        $_SESSION['rol_ses'] = $resultado['rol'];
        $_SESSION['est_ses'] = $resultado['estatus'];
        
        // Guardar mensaje de bienvenida en una variable de sesión separada
        $_SESSION['bienvenida'] = "Bienvenido {$resultado['nombreUsuario']}";
        
        // También mantener el flash para otros mensajes
        $_SESSION['flash'] = ['icon' => 'success', 'title' => 'BIENVENIDO', 'text' => "Bienvenido {$resultado['nombreUsuario']}"];
        
        header("Location: ../vista/loyaut/dashboard.php");
        exit;
        
    } elseif($resultado === -1) {
        // Usuario inactivo
        $_SESSION['flash'] = ['icon' => 'warning', 'title' => 'Usuario Inactivo', 'text' => 'Usuario INACTIVO. Consulte al ADMINISTRADOR del sistema.'];
        header("Location: ../vista/loyaut/login.php");
        exit;
        
    } else {
        // Credenciales incorrectas
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error de Autenticación', 'text' => 'Usuario o contraseña incorrectos.'];
        header("Location: ../vista/loyaut/login.php");
        exit;
    }
}

############################################################################
### CAMBIAR CREDENCIALES ###################################################
############################################################################
if(isset($_POST['cambiar']) && $_POST['cambiar'] == "cambiar"){
    
    // Verificar que el usuario esté logueado
    if(!isset($_SESSION['id_ses'])) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'Debe iniciar sesión para realizar esta acción.'];
        header("Location: ../vista/loyaut/login.php");
        exit;
    }
    
    // Guardar la URL de retorno si existe
    $return_url = isset($_POST['return_url']) ? $_POST['return_url'] : '../vista/usuario/usuario.php';
    
    $idUsuario = $_SESSION['id_ses'];
    $nombreUsuario = trim($_POST['nombre_usuario']);
    $contrasena_actual = $_POST['contrasena_actual'];
    $contrasena_nueva = $_POST['contrasena_nueva'];
    $confirmar_contrasena = $_POST['confirmar_contrasena'];
    
    // Validar campos obligatorios
    $errores = [];
    
    if(empty($nombreUsuario)) {
        $errores[] = "El nombre de usuario es requerido";
    }
    
    if(empty($contrasena_actual)) {
        $errores[] = "Debe ingresar su contraseña actual";
    }
    
    if(empty($contrasena_nueva)) {
        $errores[] = "La nueva contraseña es requerida";
    } elseif(strlen($contrasena_nueva) < 6) {
        $errores[] = "La nueva contraseña debe tener al menos 6 caracteres";
    }
    
    if($contrasena_nueva !== $confirmar_contrasena) {
        $errores[] = "Las contraseñas nuevas no coinciden";
    }
    
    if(!empty($errores)) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error de Validación', 'text' => implode('<br>', $errores)];
        header("Location: ../vista/usuario/cambiar_credenciales.php");
        exit;
    }
    
    // Llamar al método de la clase
    $resultado = $usuario->CambiarUsuario($idUsuario, $nombreUsuario, $contrasena_actual, $contrasena_nueva, $confirmar_contrasena);
    
    if($resultado['success']) {
        $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => $resultado['message']];
        // Redirigir a la página anterior o al dashboard
        header("Location: " . $return_url);
        exit;
    } else {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => $resultado['message']];
        header("Location: ../vista/usuario/cambiar_credenciales.php");
        exit;
    }
}

############################################################################
### CAMBIAR SOLO CONTRASEÑA ################################################
############################################################################
if(isset($_POST['cambiar_contrasena']) && $_POST['cambiar_contrasena'] == "cambiar_contrasena"){
    
    if(!isset($_SESSION['id_ses'])) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'Debe iniciar sesión.'];
        header("Location: ../vista/loyaut/login.php");
        exit;
    }
    
    $idUsuario = $_SESSION['id_ses'];
    $contrasena_actual = $_POST['contrasena_actual'];
    $contrasena_nueva = $_POST['contrasena_nueva'];
    $confirmar_contrasena = $_POST['confirmar_contrasena'];
    
    $errores = [];
    
    if(empty($contrasena_actual)) {
        $errores[] = "Debe ingresar su contraseña actual";
    }
    
    if(empty($contrasena_nueva)) {
        $errores[] = "La nueva contraseña es requerida";
    } elseif(strlen($contrasena_nueva) < 6) {
        $errores[] = "La nueva contraseña debe tener al menos 6 caracteres";
    }
    
    if($contrasena_nueva !== $confirmar_contrasena) {
        $errores[] = "Las contraseñas nuevas no coinciden";
    }
    
    if(!empty($errores)) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error de Validación', 'text' => implode('<br>', $errores)];
        header("Location: ../vista/usuario/cambiar_contrasena.php");
        exit;
    }
    
    $resultado = $usuario->CambiarContrasena($idUsuario, $contrasena_actual, $contrasena_nueva, $confirmar_contrasena);
    
    if($resultado['success']) {
        $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => $resultado['message']];
        header("Location: ../vista/dashboard.php");
        exit;
    } else {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => $resultado['message']];
        header("Location: ../vista/usuario/cambiar_contrasena.php");
        exit;
    }
}

############################################################################
### CAMBIAR SOLO NOMBRE DE USUARIO #########################################
############################################################################
if(isset($_POST['cambiar_nombre']) && $_POST['cambiar_nombre'] == "cambiar_nombre"){
    
    if(!isset($_SESSION['id_ses'])) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'Debe iniciar sesión.'];
        header("Location: ../vista/loyaut/login.php");
        exit;
    }
    
    $idUsuario = $_SESSION['id_ses'];
    $nombreUsuario = trim($_POST['nombre_usuario']);
    $contrasena_actual = $_POST['contrasena_actual'];
    
    $errores = [];
    
    if(empty($nombreUsuario)) {
        $errores[] = "El nombre de usuario es requerido";
    } elseif(!validarNombreUsuario($nombreUsuario)) {
        $errores[] = "El nombre de usuario debe tener entre 3 y 50 caracteres";
    }
    
    if(empty($contrasena_actual)) {
        $errores[] = "Debe ingresar su contraseña actual para confirmar";
    }
    
    if(!empty($errores)) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error de Validación', 'text' => implode('<br>', $errores)];
        header("Location: ../vista/usuario/cambiar_nombre.php");
        exit;
    }
    
    $resultado = $usuario->CambiarNombreUsuario($idUsuario, $nombreUsuario, $contrasena_actual);
    
    if($resultado['success']) {
        $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => $resultado['message']];
        header("Location: ../vista/dashboard.php");
        exit;
    } else {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => $resultado['message']];
        header("Location: ../vista/usuario/cambiar_nombre.php");
        exit;
    }
}


?>