<?php
// Clase especialidad
class Especialidad {
    // DECLARACION DE LAS PROPIEDADES
    public $idEspecialidad, $nombre;

    // Setters
    public function setIdEspecialidad($idEspecialidad){ $this->idEspecialidad = $idEspecialidad; }
    public function setNombre($nombre){ $this->nombre = $nombre; }
     
    // Getters
    public function getIdEspecialidad(){ return $this->idEspecialidad; }
    public function getNombre(){ return $this->nombre; }

    // Función privada para validar nombre (consistente)
    private function validarNombre($nombre) {
        if(empty($nombre)) {
            return false;
        }
        // Solo letras y espacios (sin números ni guiones)
        return preg_match('/^[a-zA-ZáéíóúñÁÉÍÓÚÑ\s]+$/', $nombre);
    }

    ############################################################################
    ### REGISTRAR ##############################################################
    ############################################################################
    public function RegistrarEspecialidad($nombre){
        include("conexion.php");

        // Validaciones
        if(!$this->validarNombre($nombre)) {
            return false;
        }
        
        // Verificar si ya existe el nombre de la especialidad
        $sql = $conex->prepare("SELECT * FROM ESPECIALIDAD WHERE nombre = ?");
        $sql->execute([$nombre]);
        $num = $sql->rowCount();

        if ($num == 0){
            // Insertar nueva especialidad (idEspecialidad es auto incremental, no se envía)
            $sql = $conex->prepare("INSERT INTO ESPECIALIDAD (nombre) VALUES (?)");
            $insertar = $sql->execute([$nombre]);
            
            if($insertar) {
                return true;
            }
        }
        return false;
    }

    #############################################################################
    ### LISTAR ##################################################################
    #############################################################################
    public function ListarEspecialidad(){
        include("conexion.php");
        
        $sql = $conex->prepare("SELECT * FROM ESPECIALIDAD ORDER BY idEspecialidad");
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
    public function ConsultarEspecialidad($idEspecialidad){
        include("conexion.php");
        
        $sql = $conex->prepare("SELECT * FROM ESPECIALIDAD WHERE idEspecialidad = ?");
        $sql->execute([$idEspecialidad]);
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
    public function MostrarEspecialidad($idEspecialidad){
        include("conexion.php");
        
        $sql = $conex->prepare("SELECT * FROM ESPECIALIDAD WHERE idEspecialidad = ?");
        $sql->execute([$idEspecialidad]);
        $num_reg = $sql->rowCount();
        
        if ($num_reg > 0) {
            return $sql->fetch(PDO::FETCH_ASSOC);  
        } else {
            return false;
        }
    }

    #############################################################################
    ### ACTUALIZAR ESPECIALIDAD ################################################
    ############################################################################
    public function ActualizarEspecialidad($idEspecialidad, $nombre){
        include("conexion.php"); 

        // Validaciones
        if(!$this->validarNombre($nombre)) {
            return false;
        }

        // Verificar si ya existe el nombre en otra especialidad
        $sql = $conex->prepare("SELECT * FROM ESPECIALIDAD WHERE nombre = ? AND idEspecialidad != ?");
        $sql->execute([$nombre, $idEspecialidad]);
        $num = $sql->rowCount();

        if ($num == 0){
            // Actualizar especialidad
            $sql = $conex->prepare("UPDATE ESPECIALIDAD SET nombre = ? WHERE idEspecialidad = ?");
            $actualizar = $sql->execute([$nombre, $idEspecialidad]);
            
            if($actualizar) {
                return true;
            }
        }
        return false;
    }

    ############################################################################
    ### ELIMINAR ###############################################################
    ############################################################################
    public function EliminarEspecialidad($idEspecialidad){
        include("conexion.php"); 
        
        try {
            // Iniciar transacción
            $conex->beginTransaction();
            
            // Verificar si existe la especialidad
            $sql = $conex->prepare("SELECT idEspecialidad FROM ESPECIALIDAD WHERE idEspecialidad = ?");
            $sql->execute([$idEspecialidad]);
            $especialidad = $sql->fetch(PDO::FETCH_ASSOC);
            
            if(!$especialidad) {
                $conex->rollBack();
                return false;
            }
            
            // PRIMERO: Actualizar los entrenadores que tienen esta especialidad (poner NULL)
            $sql = $conex->prepare("UPDATE ENTRENADOR SET idEspecialidad = NULL WHERE idEspecialidad = ?");
            $sql->execute([$idEspecialidad]);
            
            // SEGUNDO: Eliminar la especialidad
            $sql = $conex->prepare("DELETE FROM ESPECIALIDAD WHERE idEspecialidad = ?");
            $eliminar = $sql->execute([$idEspecialidad]);
            
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