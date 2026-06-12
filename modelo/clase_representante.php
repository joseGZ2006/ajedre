<?php 
    class Representante {

        public $idRepresentante, $cedula, $nombre, $apellido, $correo, $telefono, $parentesco;
        
        // Setters
        public function setIdRepresentante($idRepresentante){$this->idRepresentante = $idRepresentante; }
        public function setCedula($cedula){$this->cedula = $cedula; }
        public function setNombre($nombre){$this->nombre = $nombre; }
        public function setApellido($apellido){$this->apellido = $apellido; }
        public function setCorreo($correo){$this->correo = $correo; }
        public function setTelefono($telefono){$this->telefono = $telefono; }
        public function setParentesco($parentesco){$this->parentesco = $parentesco; }

        // Getters
        public function getIdRepresentante(){ return $this->idRepresentante; }
        public function getCedula(){ return $this->cedula; }
        public function getNombre(){ return $this->nombre; }
        public function getApellido(){ return $this->apellido; }
        public function getCorreo(){ return $this->correo; }
        public function getTelefono(){ return $this->telefono; }
        public function getParentesco(){ return $this->parentesco; }

        ############################################################################
        ### REGISTRAR ##############################################################
        ############################################################################
        public function RegistrarRepresentante($cedula, $nombre, $apellido, $correo, $telefono, $parentesco){
            include("conexion.php");
            
            // Validaciones
            $errores = [];
            
            // Validar cédula (7-10 dígitos)
            if(!preg_match('/^[0-9]{7,10}$/', $cedula)){
                $errores[] = "La cédula debe tener entre 7 y 10 dígitos numéricos";
            }
            
            // Validar nombre (solo letras y espacios)
            if(!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,50}$/', $nombre)){
                $errores[] = "El nombre debe contener solo letras y tener entre 2 y 50 caracteres";
            }
            
            // Validar apellido (solo letras)
            if(!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]{2,50}$/', $apellido)){
                $errores[] = "El apellido debe contener solo letras y tener entre 2 y 50 caracteres";
            }
            
            // Validar correo (requerido)
            if(empty($correo)){
                $errores[] = "El correo electrónico es requerido";
            } elseif(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
                $errores[] = "El correo electrónico no es válido";
            }
            
            // Validar parentesco (ampliar lista)
            $parentescos_validos = ['Padre', 'Madre', 'Tío', 'Tía', 'Abuelo', 'Abuela', 'Hermano', 'Hermana', 'Tutor', 'Tutor Legal'];
            if(empty($parentesco)){
                $parentesco = 'Tutor'; // Valor por defecto
            }
            
            // Si hay errores, retornar array de errores
            if(!empty($errores)){
                return ['success' => false, 'errores' => $errores];
            }
            
            try {
                // Verificar si ya existe la cédula
                $sql = $conex->prepare("SELECT idRepresentante FROM REPRESENTANTE WHERE cedula = ?");
                $sql->execute([$cedula]);
                $num = $sql->rowCount();

                if ($num == 0){
                    // Insertar nuevo representante
                    $sql = $conex->prepare("INSERT INTO REPRESENTANTE (cedula, nombre, apellido, correo, telefono, parentesco) VALUES (?, ?, ?, ?, ?, ?)");
                    $insertar = $sql->execute([$cedula, $nombre, $apellido, $correo, $telefono, $parentesco]);
                    
                    if($insertar) {
                        return ['success' => true];
                    } else {
                        return ['success' => false, 'errores' => ['Error al insertar en la base de datos']];
                    }
                } else {
                    return ['success' => false, 'errores' => ['Ya existe un representante con esta cédula']];
                }
            } catch (PDOException $e) {
                return ['success' => false, 'errores' => ['Error en la base de datos: ' . $e->getMessage()]];
            }
        }

        #############################################################################
        ### LISTAR ##################################################################
        #############################################################################
        public function ListarRepresentante(){
            include("conexion.php");
            
            $sql = $conex->prepare("SELECT * FROM REPRESENTANTE ORDER BY cedula");
            $sql->execute();
            $num_reg = $sql->rowCount();

            if ($num_reg > 0) {
                return $sql->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        }

        #############################################################################
        ### CONSULTAR POR CÉDULA ####################################################
        #############################################################################
        public function ConsultarRepresentante($cedula){
            include("conexion.php");
            
            $sql = $conex->prepare("SELECT * FROM REPRESENTANTE WHERE cedula = ?");
            $sql->execute([$cedula]);
            $num_reg = $sql->rowCount();
            
            if ($num_reg > 0) {
                $data = $sql->fetch(PDO::FETCH_ASSOC);
                $registro = [
                    $data['idRepresentante'],
                    $data['cedula'],
                    $data['nombre'],
                    $data['apellido'],
                    $data['correo'],
                    $data['telefono'],
                    $data['parentesco']
                ];
                return $registro;
            } else {
                return false;
            }
        }

        #############################################################################
        ### CONSULTAR POR ID ########################################################
        #############################################################################
        public function ConsultarRepresentantePorId($idRepresentante){
            include("conexion.php");
            
            $sql = $conex->prepare("SELECT * FROM REPRESENTANTE WHERE idRepresentante = ?");
            $sql->execute([$idRepresentante]);
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
        public function MostrarRepresentante($cedula){
            include("conexion.php");
            
            $sql = $conex->prepare("SELECT * FROM REPRESENTANTE WHERE cedula = ?");
            $sql->execute([$cedula]);
            $num_reg = $sql->rowCount();
            
            if ($num_reg > 0) {
                $data = $sql->fetch(PDO::FETCH_ASSOC);
                $registro = [
                   $data['idRepresentante'],
                    $data['cedula'],
                    $data['nombre'],
                    $data['apellido'],
                    $data['correo'],
                    $data['telefono'],
                    $data['parentesco']
                ];
                return $registro;
            } else {
                return false;
            }
        }

        #############################################################################
        ### ACTUALIZAR REPRESENTANTE ################################################
        ############################################################################
        public function ActualizarRepresentante($idRepresentante, $correo, $telefono, $parentesco){
            include("conexion.php"); 
            
            // Validaciones
            $errores = [];
            
            // Validar correo (si se proporciona)
            if(!empty($correo) && !filter_var($correo, FILTER_VALIDATE_EMAIL)){
                $errores[] = "El correo electrónico no es válido";
            }
            
            // Validar parentesco
            $parentescos_validos = ['Padre', 'Madre', 'Tío', 'Tía', 'Abuelo', 'Abuela', 'Hermano', 'Hermana', 'Tutor', 'Tutor Legal'];
            if(empty($parentesco) || !in_array($parentesco, $parentescos_validos)){
                $errores[] = "Debe seleccionar un parentesco válido";
            }
            
            // Si hay errores, retornar array de errores
            if(!empty($errores)){
                return ['success' => false, 'errores' => $errores];
            }
            
            // Verificar si existe el representante antes de actualizar
            $sql = $conex->prepare("SELECT * FROM REPRESENTANTE WHERE idRepresentante = ?");
            $sql->execute([$idRepresentante]);
            $num = $sql->rowCount();

            if ($num > 0){ 
                // Actualizar representante
                $sql = $conex->prepare("UPDATE REPRESENTANTE SET correo = ?, telefono = ?, parentesco = ? WHERE idRepresentante = ?");
                $actualizar = $sql->execute([$correo, $telefono, $parentesco, $idRepresentante]);
                
                if($actualizar) {
                    return ['success' => true];
                } else {
                    return ['success' => false, 'errores' => ['Error al actualizar en la base de datos']];
                }
            } else {
                return ['success' => false, 'errores' => ['No se encontró el representante a actualizar']];
            }
        }

        ############################################################################
        ### ELIMINAR ###############################################################
        ############################################################################
        public function EliminarRepresentante($idRepresentante){
            include("conexion.php"); 
            
            try {
                // Verificar si existe el representante
                $sql = $conex->prepare("SELECT * FROM REPRESENTANTE WHERE idRepresentante = ?");
                $sql->execute([$idRepresentante]);
                $num = $sql->rowCount();

                if($num > 0){
                    // Verificar si tiene alumnos asociados
                    $sql_alumnos = $conex->prepare("SELECT * FROM ALUMNO WHERE idRepresentante = ?");
                    $sql_alumnos->execute([$idRepresentante]);
                    $num_alumnos = $sql_alumnos->rowCount();
                    
                    if($num_alumnos > 0){
                        return ['success' => false, 'errores' => ['No se puede eliminar el representante porque tiene ' . $num_alumnos . ' alumno(s) asociado(s)']];
                    }
                    
                    // Eliminar representante
                    $sql = $conex->prepare("DELETE FROM REPRESENTANTE WHERE idRepresentante = ?");
                    $eliminar = $sql->execute([$idRepresentante]);
                    
                    if($eliminar) {
                        return ['success' => true];
                    } else {
                        return ['success' => false, 'errores' => ['Error al eliminar de la base de datos']];
                    }
                } else {
                    return ['success' => false, 'errores' => ['No se encontró el representante a eliminar']];
                }
            } catch (Exception $e) {
                return ['success' => false, 'errores' => ['Error: ' . $e->getMessage()]];
            }
        }
    }
?>