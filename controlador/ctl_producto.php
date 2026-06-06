<?php
session_start();
include("../modelo/conexion.php");
include("../modelo/clase_producto.php");

$prod = new Producto();

############################################################################
### REGISTRAR ##############################################################
############################################################################
if(isset($_POST['registrar']) && $_POST['registrar']=="registrar"){
    // Validaciones del lado del servidor
    $errores = [];
    
    if(empty($_POST['codigo_producto'])) {
        $errores[] = "El código del producto es requerido";
    }
    
    if(empty($_POST['nombre_producto']) || strlen($_POST['nombre_producto']) < 3) {
        $errores[] = "El nombre del producto es requerido (mínimo 3 caracteres)";
    }
    
    
    if(empty($_POST['tipo_producto']) || $_POST['tipo_producto'] == "--seleccione--") {
        $errores[] = "El tipo de producto es requerido";
    }
    
    if(!isset($_POST['cantidad']) || $_POST['cantidad'] < 0) {
        $errores[] = "La cantidad debe ser un valor positivo";
    }
    
    if(empty($_POST['estado'])) {
        $errores[] = "El estado del producto es requerido";
    }
    
    if(!empty($errores)) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error de Validación', 'text' => implode('<br>', $errores)];
        header("Location: ../vista/pantallas/productos/insert_producto.php");
        exit;
    }

    // Setear las variables o propiedades
    $prod->setCodigo_producto(trim($_POST['codigo_producto']));
    $prod->setNombre_producto(trim($_POST['nombre_producto']));
    $prod->setTipo_producto($_POST['tipo_producto']);
    $prod->setCantidad(intval($_POST['cantidad']));
    $prod->setEstado($_POST['estado']);

    // Invocamos al método de Registrar
    $datos = $prod->RegistrarProducto(
        $prod->getCodigo_producto(),
        $prod->getNombre_producto(),
        $prod->getTipo_producto(),
        $prod->getCantidad(),
        $prod->getEstado()
    );
    
    if($datos){ 
        $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => 'Producto Registrado con éxito.'];
        header("Location: ../vista/pantallas/productos/producto.php");
        exit;
    }else{
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se pudo registrar los datos. El código ya existe o hubo un error.'];
        header("Location: ../vista/pantallas/productos/insert_producto.php");
        exit;
    }
}

############################################################################
### LISTAR #################################################################
############################################################################
if(isset($_GET['L']) && $_GET['L']=="lis"){
    // Invocamos al método de Mostrar
    $datos = $prod->ListarProducto();

    if($datos === false || empty($datos)){
        $_SESSION['flash'] = ['icon' => 'info', 'title' => 'Información', 'text' => 'No hay productos registrados.'];
        header("Location: ../vista/pantallas/productos/insert_producto.php");
        exit;
    }else{
        // Enviar los valores por la URL al archivo php que LISTA los registros
        header("Location: ../vista/pantallas/productos/producto.php");
        exit;
    }
}

#############################################################################
### CONSULTAR ###############################################################
#############################################################################
if(isset($_GET['C']) && $_GET['C']=="con"){
    // Mostrar (desencriptar) el valor de la variable 
    $cod=base64_decode($_GET['I']);
    // Setear las variables o propiedades
    $prod->setCodigo_producto($cod);

    // Invocamos al método de Consultar
    $datos = $prod->ConsultarProducto($prod->getCodigo_producto());
    
    if($datos === false){
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se encontró el producto solicitado.'];
        header("Location: ../vista/pantallas/productos/producto.php");
        exit;
    }else{
        // Ocultar (encriptar) el valor de las variables 
        $cod=base64_encode($datos[0]);
        $nom=base64_encode($datos[1]);
        $tipo_P=base64_encode($datos[2]);
        $can=base64_encode($datos[3]);
        $est=base64_encode($datos[4]);
        // Envir los valores por la URL al archivo php
        header("Location: ../vista/pantallas/productos/select_producto.php?a=$cod&b=$nom&c=$tipo_P&d=$can&f=$est");
        exit;
    }
}

############################################################################
### MOSTRAR ################################################################
############################################################################
if(isset($_GET['M']) && $_GET['M']=="mos"){
    // Mostrar (desencriptar) el valor de la variable 
    $cod=base64_decode($_GET['I']);
    // Setear las variables o propiedades
    $prod->setCodigo_producto($cod);

    // Invocamos al método de Mostrar
    $datos = $prod->MostrarProducto($prod->getCodigo_producto());
    
    if($datos === false){
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se encontró el producto solicitado.'];
        header("Location: ../vista/pantallas/productos/producto.php");
        exit;
    }else{
        // Ocultar (encriptar) el valor de las variables 
        $cod=base64_encode($datos[0]);
        $nom=base64_encode($datos[1]);
        $tipo_P=base64_encode($datos[2]);
        $can=base64_encode($datos[3]);
        $est=base64_encode($datos[4]);
        // Envir los valores por la URL al archivo php
        header("Location: ../vista/pantallas/productos/update_producto.php?a=$cod&b=$nom&c=$tipo_P&d=$can&f=$est");
        exit;
    }
}

############################################################################
### ACTUALIZAR #############################################################
############################################################################
if(isset($_POST['modificar']) && $_POST['modificar']=="modificar"){
    // Validaciones del lado del servidor
    $errores = [];
    
    if(empty($_POST['nombre_producto']) || strlen($_POST['nombre_producto']) < 3) {
        $errores[] = "El nombre del producto es requerido (mínimo 3 caracteres)";
    }
    
    if(empty($_POST['tipo_producto'])) {
        $errores[] = "El tipo de producto es requerido";
    }
    
    if(!isset($_POST['cantidad']) || $_POST['cantidad'] < 0) {
        $errores[] = "La cantidad debe ser un valor positivo";
    }
    
    if(empty($_POST['estado'])) {
        $errores[] = "El estado del producto es requerido";
    }
    
    if(!empty($errores)) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error de Validación', 'text' => implode('<br>', $errores)];
        header("Location: ../vista/pantallas/productos/update_producto.php");
        exit;
    }

    // Setear las variables o propiedades
    $prod->setCodigo_producto($_POST['codigo_producto']);
    $prod->setNombre_producto(trim($_POST['nombre_producto']));
    $prod->setTipo_producto($_POST['tipo_producto']);
    $prod->setCantidad(intval($_POST['cantidad']));
    $prod->setEstado($_POST['estado']);

    // CORREGIDO: Orden correcto de los parámetros
    $datos = $prod->ActualizarProducto(
        $prod->getCodigo_producto(),    
        $prod->getNombre_producto(),    
        $prod->getTipo_producto(),      
        $prod->getCantidad(),           
        $prod->getEstado()              
    );
    
    if($datos){
        $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => 'Producto actualizado con éxito.'];
        header("Location: ../vista/pantallas/productos/producto.php");
        exit;
    }else{
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se pudo actualizar los datos. El código no existe o hubo un error.'];
        header("Location: ../vista/pantallas/productos/update_producto.php");
        exit;
    }
}

############################################################################
### ELIMINAR ###############################################################
############################################################################
if(isset($_GET['E']) && $_GET['E']=="eli"){
    // Mostrar (desencriptar) el valor de la variable 
    $cod=base64_decode($_GET['I']);
    // Setear las variables o propiedades
    $prod->setCodigo_producto($cod);

    try {
        //Invocamos al método de Eliminar
        $datos = $prod->EliminarProducto($prod->getCodigo_producto());
        
        if($datos){
            $_SESSION['flash'] = ['icon' => 'success', 'title' => 'Éxito', 'text' => 'Producto eliminado con éxito.'];
        } else {
            $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => 'No se pudo eliminar el producto.'];
        }
        
    } catch (Exception $e) {
        $_SESSION['flash'] = ['icon' => 'error', 'title' => 'Error', 'text' => $e->getMessage()];
    }
    
    header("Location: ../vista/pantallas/productos/producto.php");
    exit;
}

?>