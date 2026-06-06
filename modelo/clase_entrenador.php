<?php
// Clase Entrenador
class Entrenador {
    // DECLARACION DE LAS PROPIEDADES
    public $id_entrenador, $id_usuario, $id_especialidad, $cedula, $nombre, $apellido, $telefono;

    // Setters
    public function setId_entrenador($id_entrenador){ $this->id_entrenador = $id_entrenador; }
    public function setId_usuario($id_usuario){ $this->id_usuario = $id_usuario; }
    public function setId_especialidad($id_especialidad){ $this->id_especialidad = $id_especialidad; }
    public function setCedula($cedula){ $this->cedula = $cedula; }
    public function setNombre($nombre){ $this->nombre = $nombre; }
    public function setApellido($apellido){ $this->apellido = $apellido; }
    public function setTelefono($telefono){ $this->telefono = $telefono; }
     
    // Getters
    public function getId_entrenador(){ return $this->id_entrenador; }
    public function getId_usuario(){ return $this->id_usuario; }
    public function getId_especialidad(){ return $this->id_especialidad; }
    public function getCedula(){ return $this->cedula; }
    public function getNombre(){ return $this->nombre; }
    public function getApellido(){ return $this->apellido; }
    public function getTelefono(){ return $this->telefono; }

    ############################################################################
    ### VERIFICAR SI EL ENTRENADOR ESTÁ ASOCIADO A ASIGNACIONES ################
    ############################################################################
    private function verificarEntrenadorEnAsignaciones($id_entrenador) {
        include("conexion.php");
        
        $sql = $conex->prepare("SELECT COUNT(*) as total FROM ASIGNACION_CLASE WHERE idEntrenador = ?");
        $sql->execute([$id_entrenador]);
        $resultado = $sql->fetch(PDO::FETCH_ASSOC);
        
        if($resultado['total'] > 0) {
            return true;
        }
        
        // Verificar también en asistencia_entrenador
        $sql2 = $conex->prepare("SELECT COUNT(*) as total FROM ASISTENCIA_ENTRENADOR WHERE idEntrenador = ?");
        $sql2->execute([$id_entrenador]);
        $resultado2 = $sql2->fetch(PDO::FETCH_ASSOC);
        
        return ($resultado2['total'] > 0);
    }

    ############################################################################
    ### REGISTRAR ##############################################################
    ############################################################################
    public function RegistrarEntrenador($cedula, $nombre, $apellido, $telefono, $id_usuario = null, $id_especialidad = null){
        include("conexion.php");

        // Validaciones
        if(empty($cedula) || empty($nombre) || empty($apellido)) {
            return false;
        }

        // Validar formato de cédula (7-8 dígitos)
        if(!preg_match('/^\d{7,8}$/', $cedula)) {
            return false;
        }

        // Validar nombre y apellido (solo letras y espacios)
        if(!preg_match('/^[a-zA-ZáéíóúñÁÉÍÓÚÑ\s]+$/', $nombre)) {
            return false;
        }
        
        if(!preg_match('/^[a-zA-ZáéíóúñÁÉÍÓÚÑ\s]+$/', $apellido)) {
            return false;
        }

        // Validar teléfono si no está vacío (formato: 4 dígitos + guión + 7 dígitos = 12 caracteres)
        if(!empty($telefono) && !preg_match('/^\d{4}-\d{7}$/', $telefono)) {
            return false;
        }

        // Verificar si ya existe la cédula
        $sql = $conex->prepare("SELECT * FROM ENTRENADOR WHERE cedula = ?");
        $sql->execute([$cedula]);
        $num = $sql->rowCount();

        if ($num == 0){
            // Insertar nuevo entrenador
            $sql = $conex->prepare("INSERT INTO ENTRENADOR (cedula, nombre, apellido, telefono, idUsuario, idEspecialidad) VALUES (?, ?, ?, ?, ?, ?)");
            $insertar = $sql->execute([$cedula, $nombre, $apellido, $telefono, $id_usuario, $id_especialidad]);
            
            if($insertar) {
                return true;
            }
        }
        return false;
    }

    #############################################################################
    ### LISTAR ##################################################################
    #############################################################################
    public function ListarEntrenador(){
        include("conexion.php");
        
        $sql = $conex->prepare("SELECT e.*, u.nombreUsuario, es.nombre as especialidad_nombre 
                                FROM ENTRENADOR e 
                                LEFT JOIN USUARIO u ON e.idUsuario = u.idUsuario 
                                LEFT JOIN ESPECIALIDAD es ON e.idEspecialidad = es.idEspecialidad
                                ORDER BY e.nombre, e.apellido");
        $sql->execute();
        $num_reg = $sql->rowCount();

        if ($num_reg > 0) {
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return false;
        }
    }

    #############################################################################
    ### LISTAR TODOS LOS ENTRENADORES (para entrenador.php)
    #############################################################################
    public function ListarEntrenadores(){
        include("conexion.php");
        
        $sql = $conex->prepare("SELECT idEntrenador, cedula, nombre, apellido, telefono 
                                FROM ENTRENADOR 
                                ORDER BY nombre, apellido");
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return false;
    }

    #############################################################################
    ### CONSULTAR POR CÉDULA ####################################################
    #############################################################################
    public function ConsultarEntrenador($cedula){
        include("conexion.php");
        
        $sql = $conex->prepare("SELECT e.*, u.nombreUsuario, u.rol, es.nombre as especialidad_nombre 
                                FROM ENTRENADOR e 
                                LEFT JOIN USUARIO u ON e.idUsuario = u.idUsuario 
                                LEFT JOIN ESPECIALIDAD es ON e.idEspecialidad = es.idEspecialidad
                                WHERE e.cedula = ?");
        $sql->execute([$cedula]);
        $num_reg = $sql->rowCount();
        
        if ($num_reg > 0) {
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            $registro = [
                $data['idEntrenador'],
                $data['cedula'],
                $data['nombre'],
                $data['apellido'],
                $data['telefono'],
                $data['idUsuario'],
                $data['idEspecialidad'],
                $data['nombreUsuario'],
                $data['rol'],
                $data['especialidad_nombre']
            ];
            return $registro;
        } else {
            return false;
        }
    }

    #############################################################################
    ### CONSULTAR POR ID ########################################################
    #############################################################################
    public function ConsultarEntrenadorPorId($id_entrenador){
        include("conexion.php");
        
        $sql = $conex->prepare("SELECT e.*, u.nombreUsuario, u.rol, es.nombre as especialidad_nombre 
                                FROM ENTRENADOR e 
                                LEFT JOIN USUARIO u ON e.idUsuario = u.idUsuario 
                                LEFT JOIN ESPECIALIDAD es ON e.idEspecialidad = es.idEspecialidad
                                WHERE e.idEntrenador = ?");
        $sql->execute([$id_entrenador]);
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
    public function MostrarEntrenador($cedula){
        include("conexion.php");
        
        $sql = $conex->prepare("SELECT e.*, u.nombreUsuario, u.rol, es.nombre as especialidad_nombre 
                                FROM ENTRENADOR e 
                                LEFT JOIN USUARIO u ON e.idUsuario = u.idUsuario 
                                LEFT JOIN ESPECIALIDAD es ON e.idEspecialidad = es.idEspecialidad
                                WHERE e.cedula = ?");
        $sql->execute([$cedula]);
        $num_reg = $sql->rowCount();
        
        if ($num_reg > 0) {
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            $registro = [
                $data['idEntrenador'],
                $data['cedula'],
                $data['nombre'],
                $data['apellido'],
                $data['telefono'],
                $data['idUsuario'],
                $data['idEspecialidad'],
                $data['nombreUsuario'],
                $data['rol'],
                $data['especialidad_nombre']
            ];
            return $registro;
        } else {
            return false;
        }
    }

    ############################################################################
    ### ACTUALIZAR #############################################################
    ############################################################################
    public function ActualizarEntrenador($cedula, $nombre, $apellido, $telefono, $id_usuario = null, $id_especialidad = null){
        include("conexion.php"); 

        // Validaciones
        if(empty($nombre) || empty($apellido)) {
            return false;
        }

        // Validar nombre y apellido (solo letras y espacios)
        if(!preg_match('/^[a-zA-ZáéíóúñÁÉÍÓÚÑ\s]+$/', $nombre)) {
            return false;
        }
        
        if(!preg_match('/^[a-zA-ZáéíóúñÁÉÍÓÚÑ\s]+$/', $apellido)) {
            return false;
        }

    // Validar teléfono si no está vacío (formato: 4 dígitos + guión + 7 dígitos = 12 caracteres)
    if(!empty($telefono) && !preg_match('/^\d{4}-\d{7}$/', $telefono)) {
        return false;
    }

        // Verificar si existe el entrenador antes de actualizar
        $sql = $conex->prepare("SELECT * FROM ENTRENADOR WHERE cedula = ?");
        $sql->execute([$cedula]);
        $num = $sql->rowCount();

        if ($num > 0){
            // Actualizar entrenador
            $sql = $conex->prepare("UPDATE ENTRENADOR SET nombre = ?, apellido = ?, telefono = ?, idUsuario = ?, idEspecialidad = ? WHERE cedula = ?");
            $actualizar = $sql->execute([$nombre, $apellido, $telefono, $id_usuario, $id_especialidad, $cedula]);
            
            if($actualizar) {
                return true;
            }
        }
        return false;
    }

    ############################################################################
    ### ELIMINAR ###############################################################
    ############################################################################
    public function EliminarEntrenador($cedula){
        include("conexion.php"); 

        // Primero obtener el ID del entrenador
        $sql = $conex->prepare("SELECT idEntrenador, nombre, apellido FROM ENTRENADOR WHERE cedula = ?");
        $sql->execute([$cedula]);
        $entrenador = $sql->fetch(PDO::FETCH_ASSOC);
        
        if(!$entrenador) {
            return false;
        }
        
        $id_entrenador = $entrenador['idEntrenador'];
        $nombre_completo = $entrenador['nombre'] . ' ' . $entrenador['apellido'];

        // Verificar si el entrenador está asociado a alguna asignación de clase
        if ($this->verificarEntrenadorEnAsignaciones($id_entrenador)) {
            throw new Exception("No se puede eliminar el entrenador porque está asociado a una o más asignaciones de clase o registros de asistencia.");
        }

        // Eliminar el entrenador
        $sql = $conex->prepare("DELETE FROM ENTRENADOR WHERE cedula = ?");
        $eliminar = $sql->execute([$cedula]); 
        
        if($eliminar) {
            return true;
        }
        
        return false;
    }

    ############################################################################
    ### VERIFICAR SI EXISTE CÉDULA #############################################
    ############################################################################
    public function verificarCedulaExistente($cedula, $excluir_cedula = null) {
        include("conexion.php");
        
        if($excluir_cedula) {
            $sql = $conex->prepare("SELECT COUNT(*) as total FROM ENTRENADOR WHERE cedula = ? AND cedula != ?");
            $sql->execute([$cedula, $excluir_cedula]);
        } else {
            $sql = $conex->prepare("SELECT COUNT(*) as total FROM ENTRENADOR WHERE cedula = ?");
            $sql->execute([$cedula]);
        }
        
        $resultado = $sql->fetch(PDO::FETCH_ASSOC);
        return $resultado['total'] > 0;
    }

    ############################################################################
    ### OBTENER TODAS LAS ESPECIALIDADES #######################################
    ############################################################################
    public function obtenerEspecialidades() {
        include("conexion.php");
        
        $sql = $conex->prepare("SELECT * FROM ESPECIALIDAD ORDER BY nombre");
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return false;
    }
}
?>