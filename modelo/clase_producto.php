<?php
// Clase Producto
class Producto {
    // DECLARACION DE LAS PROPIEDADES
    public $codigo_producto, $nombre_producto, $tipo_producto, $cantidad, $estado;

    // Setters
    public function setCodigo_producto($codigo_producto){ $this->codigo_producto = $codigo_producto; }
    public function setNombre_producto($nombre_producto){ $this->nombre_producto = $nombre_producto; }
    public function setTipo_producto($tipo_producto){ $this->tipo_producto = $tipo_producto; }
    public function setCantidad($cantidad){ $this->cantidad = $cantidad; }
    public function setEstado($estado){ $this->estado = $estado; }
     
    // Getters
    public function getCodigo_producto(){ return $this->codigo_producto; }
    public function getNombre_producto(){ return $this->nombre_producto; }
    public function getTipo_producto(){ return $this->tipo_producto; }
    public function getCantidad(){ return $this->cantidad; }
    public function getEstado(){ return $this->estado; }

    ############################################################################
    ### VERIFICAR SI EL PRODUCTO ESTÁ ASOCIADO A SOLICITUDES ###################
    ############################################################################
    private function verificarProductoEnSolicitudes($codigo_producto) {
        include("conexion.php");
        
        $sql = $conex->prepare("SELECT COUNT(*) as total FROM solicitud_productos WHERE codigo_producto = ?");
        $sql->execute([$codigo_producto]);
        $resultado = $sql->fetch(PDO::FETCH_ASSOC);
        
        return $resultado['total'] > 0;
    }

    ############################################################################
    ### REGISTRAR ##############################################################
    ############################################################################
    public function RegistrarProducto($codigo_producto, $nombre_producto, $tipo_producto, $cantidad, $estado){
        include("conexion.php");
        include("bitacora.php");

        // Validaciones
        if(empty($codigo_producto) || empty($nombre_producto) || empty($tipo_producto)) {
            return false;
        }

        if($cantidad < 0) {
            return false;
        }

        // Determinar estado basado en cantidad
        $estado_final = ($cantidad > 0) ? 'DISPONIBLE' : 'AGOTADO';

        // Verificar si ya existe el producto
        $sql = $conex->prepare("SELECT * FROM producto WHERE codigo_producto = ?");
        $sql->execute([$codigo_producto]);
        $num = $sql->rowCount();

        if (!$num){
            // Insertar nuevo producto
            $sql = $conex->prepare("INSERT INTO producto (codigo_producto, nombre_producto, tipo_producto, cantidad, estado) VALUES (?, ?, ?, ?, ?)");
            $insertar = $sql->execute([$codigo_producto, $nombre_producto, $tipo_producto, $cantidad, $estado_final]);
            
            if($insertar) {
                Bitacora::registrar("REGISTRAR_PRODUCTO", "Se registró el producto: $codigo_producto - $nombre_producto");
                return true;
            }
        }
        return false;
    }

    #############################################################################
    ### LISTAR ##################################################################
    #############################################################################
    public function ListarProducto(){
        include("conexion.php");
        
        $sql = $conex->prepare("SELECT * FROM producto");
        $sql->execute();
        $num_reg = $sql->rowCount();

        if ($num_reg > 0) {
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    #############################################################################
    ### CONSULTAR ###############################################################
    #############################################################################
    public function ConsultarProducto($codigo_producto){
        include("conexion.php");
        
        $sql = $conex->prepare("SELECT * FROM producto WHERE codigo_producto = ?");
        $sql->execute([$codigo_producto]);
        $num_reg = $sql->rowCount();
        
        if ($num_reg > 0) {
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            $registro = [
                $data['codigo_producto'],
                $data['nombre_producto'],
                $data['tipo_producto'],
                $data['cantidad'],
                $data['estado']
            ];
            return $registro;
        } else {
            return false;
        }
    }
    
    ############################################################################
    ### MOSTRAR ################################################################
    ############################################################################
    public function MostrarProducto($codigo_producto){
        include("conexion.php");
        
        $sql = $conex->prepare("SELECT * FROM producto WHERE codigo_producto = ?");
        $sql->execute([$codigo_producto]);
        $num_reg = $sql->rowCount();
        
        if ($num_reg > 0) {
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            $registro = [
                $data['codigo_producto'],
                $data['nombre_producto'],
                $data['tipo_producto'],
                $data['cantidad'],
                $data['estado']
            ];
            return $registro;
        } else {
            return false;
        }
    }

    ############################################################################
    ### ACTUALIZAR #############################################################
    ############################################################################
    public function ActualizarProducto($codigo_producto, $nombre_producto, $tipo_producto, $cantidad, $estado){
        include("conexion.php"); 
        include("bitacora.php");

        // Validaciones
        if(empty($nombre_producto) || empty($tipo_producto)) {
            return false;
        }

        if($cantidad < 0) {
            return false;
        }

        // Determinar estado basado en cantidad (IGNORAR el estado recibido)
        $estado_final = ($cantidad > 0) ? 'DISPONIBLE' : 'AGOTADO';

        // Verificar si existe el producto antes de actualizar
        $sql = $conex->prepare("SELECT * FROM producto WHERE codigo_producto = ?");
        $sql->execute([$codigo_producto]);
        $num = $sql->rowCount();

        if ($num > 0){
            // Actualizar producto
            $sql = $conex->prepare("UPDATE producto SET nombre_producto = ?, tipo_producto = ?, cantidad = ?, estado = ? WHERE codigo_producto = ?");
            $actualizar = $sql->execute([$nombre_producto, $tipo_producto, $cantidad, $estado_final, $codigo_producto]);
            
            if($actualizar) {
                // Registrar en bitácora
                Bitacora::registrar("ACTUALIZAR_PRODUCTO", "Se actualizó el producto: $codigo_producto - $nombre_producto");
                return true;
            }
        }
        return false;
    }

    ############################################################################
    ### ELIMINAR ###############################################################
    ############################################################################
    public function EliminarProducto($codigo_producto){
        include("conexion.php"); 
        include("bitacora.php");

        // Verificar si el producto está asociado a alguna solicitud
        if ($this->verificarProductoEnSolicitudes($codigo_producto)) {
            throw new Exception("No se puede eliminar el producto porque está asociado a una o más solicitudes.");
        }

        // Verificar si existe el producto antes de eliminar
        $sql = $conex->prepare("SELECT * FROM producto WHERE codigo_producto = ?");
        $sql->execute([$codigo_producto]);
        $num = $sql->rowCount();

        if ($num > 0){
            // Obtener datos del producto para la bitácora
            $producto = $sql->fetch(PDO::FETCH_ASSOC);
            $nombre_producto = $producto['nombre_producto'];
            
            $sql = $conex->prepare("DELETE FROM producto WHERE codigo_producto = ?");
            $eliminar = $sql->execute([$codigo_producto]); 
            
            if($eliminar) {
                // Registrar en bitácora
                Bitacora::registrar("ELIMINAR_PRODUCTO", "Se eliminó el producto: $codigo_producto - $nombre_producto");
                return true;
            }
        }
        return false;
    }

    ############################################################################
    ### ACTUALIZAR ESTADO AUTOMÁTICO ###########################################
    ############################################################################
    public function actualizarEstadoAutomatico($codigo_producto) {
        include("conexion.php");
        
        // Obtener cantidad actual
        $sql = $conex->prepare("SELECT cantidad FROM producto WHERE codigo_producto = ?");
        $sql->execute([$codigo_producto]);
        $producto = $sql->fetch(PDO::FETCH_ASSOC);
        
        if($producto) {
            $nuevo_estado = ($producto['cantidad'] > 0) ? 'DISPONIBLE' : 'AGOTADO';
            
            // Actualizar estado
            $sql = $conex->prepare("UPDATE producto SET estado = ? WHERE codigo_producto = ?");
            return $sql->execute([$nuevo_estado, $codigo_producto]);
        }
        return false;
    }
}
?>