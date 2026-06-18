<?php
// Clase TipoTorneo
class TipoTorneo {
    // DECLARACION DE LAS PROPIEDADES
    public $idTipoTorneo, $nombre, $tipo;

    // Setters
    public function setIdTipoTorneo($idTipoTorneo){ $this->idTipoTorneo = $idTipoTorneo; }
    public function setNombre($nombre){ $this->nombre = $nombre; }
    public function setTipo($tipo){ $this->tipo = $tipo; }
     
    // Getters
    public function getIdTipoTorneo(){ return $this->idTipoTorneo; }
    public function getNombre(){ return $this->nombre; }
    public function getTipo(){ return $this->tipo; }

    // Función privada para validar nombre (consistente)
    private function validarNombre($nombre) {
        if(empty($nombre)) {
            return false;
        }
        // Solo letras y espacios (sin números ni guiones)
        return preg_match('/^[a-zA-ZáéíóúñÁÉÍÓÚÑ\s]+$/', $nombre);
    }

    // Función privada para validar tipo
    private function validarTipo($tipo) {
        $tiposPermitidos = ['individual', 'equipo', 'mixto'];
        return in_array($tipo, $tiposPermitidos);
    }

    ############################################################################
    ### REGISTRAR ##############################################################
    ############################################################################
    public function RegistrarTipoTorneo($nombre, $tipo){
        include("conexion.php");

        // Validaciones
        if(!$this->validarNombre($nombre)) {
            return false;
        }
        if(!$this->validarTipo($tipo)) {
            return false;
        }
        
        // Verificar si ya existe el nombre del tipo de torneo
        $sql = $conex->prepare("SELECT * FROM TIPO_TORNEO WHERE nombre = ?");
        $sql->execute([$nombre]);
        $num = $sql->rowCount();

        if ($num == 0){
            // Insertar nuevo tipo de torneo
            $sql = $conex->prepare("INSERT INTO TIPO_TORNEO (nombre, tipo) VALUES (?, ?)");
            $insertar = $sql->execute([$nombre, $tipo]);
            
            if($insertar) {
                return true;
            }
        }
        return false;
    }

    #############################################################################
    ### LISTAR ##################################################################
    #############################################################################
    public function ListarTipoTorneo(){
        include("conexion.php");
        
        $sql = $conex->prepare("SELECT * FROM TIPO_TORNEO ORDER BY idTipoTorneo");
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
    public function ConsultarTipoTorneo($idTipoTorneo){
        include("conexion.php");
        
        $sql = $conex->prepare("SELECT * FROM TIPO_TORNEO WHERE idTipoTorneo = ?");
        $sql->execute([$idTipoTorneo]);
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
    public function MostrarTipoTorneo($idTipoTorneo){
        include("conexion.php");
        
        $sql = $conex->prepare("SELECT * FROM TIPO_TORNEO WHERE idTipoTorneo = ?");
        $sql->execute([$idTipoTorneo]);
        $num_reg = $sql->rowCount();
        
        if ($num_reg > 0) {
            return $sql->fetch(PDO::FETCH_ASSOC);  
        } else {
            return false;
        }
    }

    #############################################################################
    ### ACTUALIZAR TIPO TORNEO ##################################################
    ############################################################################
    public function ActualizarTipoTorneo($idTipoTorneo, $nombre, $tipo){
        include("conexion.php"); 

        // Validaciones
        if(!$this->validarNombre($nombre)) {
            return false;
        }
        if(!$this->validarTipo($tipo)) {
            return false;
        }

        // Verificar si ya existe el nombre en otro tipo de torneo
        $sql = $conex->prepare("SELECT * FROM TIPO_TORNEO WHERE nombre = ? AND idTipoTorneo != ?");
        $sql->execute([$nombre, $idTipoTorneo]);
        $num = $sql->rowCount();

        if ($num == 0){
            // Actualizar tipo de torneo
            $sql = $conex->prepare("UPDATE TIPO_TORNEO SET nombre = ?, tipo = ? WHERE idTipoTorneo = ?");
            $actualizar = $sql->execute([$nombre, $tipo, $idTipoTorneo]);
            
            if($actualizar) {
                return true;
            }
        }
        return false;
    }

    ############################################################################
    ### ELIMINAR ###############################################################
    ############################################################################
    public function EliminarTipoTorneo($idTipoTorneo){
        include("conexion.php"); 
        
        try {
            // Iniciar transacción
            $conex->beginTransaction();
            
            // Verificar si existe el tipo de torneo
            $sql = $conex->prepare("SELECT idTipoTorneo FROM TIPO_TORNEO WHERE idTipoTorneo = ?");
            $sql->execute([$idTipoTorneo]);
            $tipoTorneo = $sql->fetch(PDO::FETCH_ASSOC);
            
            if(!$tipoTorneo) {
                $conex->rollBack();
                return false;
            }
            
            // PRIMERO: Actualizar los torneos que tienen este tipo (poner NULL)
            // Nota: Asegúrate de que la tabla TORNEO existe
            $sql = $conex->prepare("UPDATE TORNEO SET idTipoTorneo = NULL WHERE idTipoTorneo = ?");
            $sql->execute([$idTipoTorneo]);
            
            // SEGUNDO: Eliminar el tipo de torneo
            $sql = $conex->prepare("DELETE FROM TIPO_TORNEO WHERE idTipoTorneo = ?");
            $eliminar = $sql->execute([$idTipoTorneo]);
            
            if($eliminar) {
                $conex->commit();
                return true;
            } else {
                $conex->rollBack();
                return false;
            }
            
        } catch (Exception $e) {
            $conex->rollBack();
            return false;
        }
    }

}
?>