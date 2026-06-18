<?php
// Clase Torneo
class Torneo {
    // DECLARACION DE LAS PROPIEDADES
    public $idTorneo, $idTipoTorneo, $nombre, $fecha, $lugar, $categoria, $clasificacion, $estatus, $cupo;

    // Setters
    public function setIdTorneo($idTorneo){ $this->idTorneo = $idTorneo; }
    public function setIdTipoTorneo($idTipoTorneo){ $this->idTipoTorneo = $idTipoTorneo; }
    public function setNombre($nombre){ $this->nombre = $nombre; }
    public function setFecha($fecha){ $this->fecha = $fecha; }
    public function setLugar($lugar){ $this->lugar = $lugar; }
    public function setCategoria($categoria){ $this->categoria = $categoria; }
    public function setClasificacion($clasificacion){ $this->clasificacion = $clasificacion; }
    public function setEstatus($estatus){ $this->estatus = $estatus; }
    public function setCupo($cupo){ $this->cupo = $cupo; }
     
    // Getters
    public function getIdTorneo(){ return $this->idTorneo; }
    public function getIdTipoTorneo(){ return $this->idTipoTorneo; }
    public function getNombre(){ return $this->nombre; }
    public function getFecha(){ return $this->fecha; }
    public function getLugar(){ return $this->lugar; }
    public function getCategoria(){ return $this->categoria; }
    public function getClasificacion(){ return $this->clasificacion; }
    public function getEstatus(){ return $this->estatus; }
    public function getCupo(){ return $this->cupo; }

    // Función privada para validar nombre
    private function validarNombre($nombre) {
        if(empty($nombre)) {
            return false;
        }
        // Solo letras, espacios, números y caracteres básicos
        return preg_match('/^[a-zA-ZáéíóúñÁÉÍÓÚÑ0-9\s\-\.]+$/', $nombre);
    }

    // Función privada para validar fecha
    private function validarFecha($fecha) {
        if(empty($fecha)) {
            return false;
        }
        $fechaObj = DateTime::createFromFormat('Y-m-d', $fecha);
        return $fechaObj && $fechaObj->format('Y-m-d') === $fecha;
    }

    // Función privada para validar lugar
    private function validarLugar($lugar) {
        if(empty($lugar)) {
            return false;
        }
        return preg_match('/^[a-zA-ZáéíóúñÁÉÍÓÚÑ0-9\s\-\.]+$/', $lugar);
    }

    // Función privada para validar estatus
    private function validarEstatus($estatus) {
        $estatusPermitidos = ['proximo', 'en_curso', 'finalizado', 'cancelado'];
        return in_array($estatus, $estatusPermitidos);
    }

    // Función privada para validar cupo
    private function validarCupo($cupo) {
        return is_numeric($cupo) && $cupo > 0 && $cupo <= 1000;
    }

    ############################################################################
    ### REGISTRAR ##############################################################
    ############################################################################
    public function RegistrarTorneo($idTipoTorneo, $nombre, $fecha, $lugar, $categoria, $clasificacion, $estatus, $cupo){
        include("conexion.php");

        // Validaciones
        if(!$this->validarNombre($nombre)) {
            return ['success' => false, 'error' => 'El nombre solo puede contener letras, números, espacios, guiones y puntos.'];
        }
        if(!$this->validarFecha($fecha)) {
            return ['success' => false, 'error' => 'La fecha no es válida.'];
        }
        if(!$this->validarLugar($lugar)) {
            return ['success' => false, 'error' => 'El lugar solo puede contener letras, números, espacios, guiones y puntos.'];
        }
        if(!$this->validarEstatus($estatus)) {
            return ['success' => false, 'error' => 'El estatus no es válido.'];
        }
        if(!$this->validarCupo($cupo)) {
            return ['success' => false, 'error' => 'El cupo debe ser un número positivo mayor a 0 y menor a 1001.'];
        }
        
        // Verificar si ya existe el nombre del torneo
        $sql = $conex->prepare("SELECT * FROM TORNEO WHERE nombre = ?");
        $sql->execute([$nombre]);
        $num = $sql->rowCount();

        if ($num == 0){
            // Insertar nuevo torneo
            $sql = $conex->prepare("INSERT INTO TORNEO (idTipoTorneo, nombre, fecha, lugar, categoria, clasificacion, estatus, cupo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $insertar = $sql->execute([$idTipoTorneo, $nombre, $fecha, $lugar, $categoria, $clasificacion, $estatus, $cupo]);
            
            if($insertar) {
                return ['success' => true];
            } else {
                return ['success' => false, 'error' => 'Error al insertar en la base de datos.'];
            }
        } else {
            return ['success' => false, 'error' => 'Ya existe un torneo con ese nombre.'];
        }
    }

    #############################################################################
    ### LISTAR ##################################################################
    #############################################################################
    public function ListarTorneo(){
        include("conexion.php");
        
        $sql = $conex->prepare("SELECT t.*, tt.nombre as tipo_torneo_nombre 
                                FROM TORNEO t 
                                LEFT JOIN TIPO_TORNEO tt ON t.idTipoTorneo = tt.idTipoTorneo 
                                ORDER BY t.idTorneo");
        $sql->execute();
        $num_reg = $sql->rowCount();

        if ($num_reg > 0) {
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    #############################################################################
    ### CONSULTAR POR ID ########################################################
    #############################################################################
    public function ConsultarTorneo($idTorneo){
        include("conexion.php");
        
        $sql = $conex->prepare("SELECT t.*, tt.nombre as tipo_torneo_nombre 
                                FROM TORNEO t 
                                LEFT JOIN TIPO_TORNEO tt ON t.idTipoTorneo = tt.idTipoTorneo 
                                WHERE t.idTorneo = ?");
        $sql->execute([$idTorneo]);
        $num_reg = $sql->rowCount();

        if ($num_reg > 0) {
            return $sql->fetch(PDO::FETCH_ASSOC);  
        } else {
            return false;
        }
    }
    
    ############################################################################
    ### MOSTRAR ################################################################
    ############################################################################
    public function MostrarTorneo($idTorneo){
        include("conexion.php");
        
        $sql = $conex->prepare("SELECT t.*, tt.nombre as tipo_torneo_nombre 
                                FROM TORNEO t 
                                LEFT JOIN TIPO_TORNEO tt ON t.idTipoTorneo = tt.idTipoTorneo 
                                WHERE t.idTorneo = ?");
        $sql->execute([$idTorneo]);
        $num_reg = $sql->rowCount();
        
        if ($num_reg > 0) {
            return $sql->fetch(PDO::FETCH_ASSOC);  
        } else {
            return false;
        }
    }

    #############################################################################
    ### ACTUALIZAR TORNEO #######################################################
    ############################################################################
    public function ActualizarTorneo($idTorneo, $idTipoTorneo, $nombre, $fecha, $lugar, $categoria, $clasificacion, $estatus, $cupo){
        include("conexion.php"); 

        // Validaciones
        if(!$this->validarNombre($nombre)) {
            return ['success' => false, 'error' => 'El nombre solo puede contener letras, números, espacios, guiones y puntos.'];
        }
        if(!$this->validarFecha($fecha)) {
            return ['success' => false, 'error' => 'La fecha no es válida.'];
        }
        if(!$this->validarLugar($lugar)) {
            return ['success' => false, 'error' => 'El lugar solo puede contener letras, números, espacios, guiones y puntos.'];
        }
        if(!$this->validarEstatus($estatus)) {
            return ['success' => false, 'error' => 'El estatus no es válido.'];
        }
        if(!$this->validarCupo($cupo)) {
            return ['success' => false, 'error' => 'El cupo debe ser un número positivo mayor a 0 y menor a 1001.'];
        }

        // Verificar si ya existe el nombre en otro torneo
        $sql = $conex->prepare("SELECT * FROM TORNEO WHERE nombre = ? AND idTorneo != ?");
        $sql->execute([$nombre, $idTorneo]);
        $num = $sql->rowCount();

        if ($num == 0){
            // Actualizar torneo
            $sql = $conex->prepare("UPDATE TORNEO SET idTipoTorneo = ?, nombre = ?, fecha = ?, lugar = ?, categoria = ?, clasificacion = ?, estatus = ?, cupo = ? WHERE idTorneo = ?");
            $actualizar = $sql->execute([$idTipoTorneo, $nombre, $fecha, $lugar, $categoria, $clasificacion, $estatus, $cupo, $idTorneo]);
            
            if($actualizar) {
                return ['success' => true];
            } else {
                return ['success' => false, 'error' => 'Error al actualizar en la base de datos.'];
            }
        } else {
            return ['success' => false, 'error' => 'Ya existe otro torneo con ese nombre.'];
        }
    }

    ############################################################################
    ### ELIMINAR ###############################################################
    ############################################################################
    public function EliminarTorneo($idTorneo){
        include("conexion.php"); 
        
        try {
            // Iniciar transacción
            $conex->beginTransaction();
            
            // Verificar si existe el torneo
            $sql = $conex->prepare("SELECT idTorneo FROM TORNEO WHERE idTorneo = ?");
            $sql->execute([$idTorneo]);
            $torneo = $sql->fetch(PDO::FETCH_ASSOC);
            
            if(!$torneo) {
                $conex->rollBack();
                return ['success' => false, 'error' => 'El torneo no existe.'];
            }
            
            // Eliminar el torneo
            $sql = $conex->prepare("DELETE FROM TORNEO WHERE idTorneo = ?");
            $eliminar = $sql->execute([$idTorneo]);
            
            if($eliminar) {
                $conex->commit();
                return ['success' => true];
            } else {
                $conex->rollBack();
                return ['success' => false, 'error' => 'Error al eliminar el torneo.'];
            }
            
        } catch (Exception $e) {
            $conex->rollBack();
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    ############################################################################
    ### OBTENER TIPOS DE TORNEO PARA SELECT ####################################
    ############################################################################
    public function ObtenerTiposTorneo(){
        include("conexion.php");
        
        $sql = $conex->prepare("SELECT idTipoTorneo, nombre FROM TIPO_TORNEO ORDER BY nombre");
        $sql->execute();
        $num_reg = $sql->rowCount();

        if ($num_reg > 0) {
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

}
?>