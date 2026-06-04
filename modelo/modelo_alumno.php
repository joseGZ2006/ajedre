<?php
// Clase Alumno
class Alumno {
    // DECLARACION DE LAS PROPIEDADES
    public $idAlumno, $cedula, $nombre, $apellido, $sexo, $fechaNacimiento, $edad, $categoria, $telefono, $localidadMunicipio, $correo, $club, $direccion, $dondeEstudia, $grado, $seccion, $deporte, $centroIniciacionDeportivo, $idRepresentante, $idUsuario, $estatus, $fechaRegistro;

    // Setters
    public function setIdAlumno($idAlumno){ $this->idAlumno = $idAlumno; }
    public function setCedula($cedula){ $this->cedula = $cedula; }
    public function setNombre($nombre){ $this->nombre = $nombre; }
    public function setApellido($apellido){ $this->apellido = $apellido; }
    public function setSexo($sexo){ $this->sexo = $sexo; }
    public function setFechaNacimiento($fechaNacimiento){ $this->fechaNacimiento = $fechaNacimiento; }
    public function setEdad($edad){ $this->edad = $edad; }
    public function setCategoria($categoria){ $this->categoria = $categoria; }
    public function setTelefono($telefono){ $this->telefono = $telefono; }
    public function setLocalidadMunicipio($localidadMunicipio){ $this->localidadMunicipio = $localidadMunicipio; }
    public function setCorreo($correo){ $this->correo = $correo; }
    public function setClub($club){ $this->club = $club; }
    public function setDireccion($direccion){ $this->direccion = $direccion; }
    public function setDondeEstudia($dondeEstudia){ $this->dondeEstudia = $dondeEstudia; }
    public function setGrado($grado){ $this->grado = $grado; }
    public function setSeccion($seccion){ $this->seccion = $seccion; }
    public function setDeporte($deporte){ $this->deporte = $deporte; }
    public function setCentroIniciacionDeportivo($centroIniciacionDeportivo){ $this->centroIniciacionDeportivo = $centroIniciacionDeportivo; }
    public function setIdRepresentante($idRepresentante){ $this->idRepresentante = $idRepresentante; }
    public function setIdUsuario($idUsuario){ $this->idUsuario = $idUsuario; }
    public function setEstatus($estatus){ $this->estatus = $estatus; }
    public function setFechaRegistro($fechaRegistro){ $this->fechaRegistro = $fechaRegistro; }

    // Getters
    public function getIdAlumno(){ return $this->idAlumno; }
    public function getCedula(){ return $this->cedula; }
    public function getNombre(){ return $this->nombre; }
    public function getApellido(){ return $this->apellido; }
    public function getSexo(){ return $this->sexo; }
    public function getFechaNacimiento(){ return $this->fechaNacimiento; }
    public function getEdad(){ return $this->edad; }
    public function getCategoria(){ return $this->categoria; }
    public function getTelefono(){ return $this->telefono; }
    public function getLocalidadMunicipio(){ return $this->localidadMunicipio; }
    public function getCorreo(){ return $this->correo; }
    public function getClub(){ return $this->club; }
    public function getDireccion(){ return $this->direccion; }
    public function getDondeEstudia(){ return $this->dondeEstudia; }
    public function getGrado(){ return $this->grado; }
    public function getSeccion(){ return $this->seccion; }
    public function getDeporte(){ return $this->deporte; }
    public function getCentroIniciacionDeportivo(){ return $this->centroIniciacionDeportivo; }
    public function getIdRepresentante(){ return $this->idRepresentante; }
    public function getIdUsuario(){ return $this->idUsuario; }
    public function getEstatus(){ return $this->estatus; }
    public function getFechaRegistro(){ return $this->fechaRegistro; }

    ############################################################################
    ### REGISTRAR EN BITÁCORA #################################################
    ############################################################################
    private function registrarBitacora($accion, $descripcion) {
        // Comentar temporalmente si no existe la tabla bitacora
        // include("bitacora.php");
        // return Bitacora::registrar($accion, $descripcion);
        return true; // Temporal
    }

    ############################################################################
    ### VALIDACIONES ###########################################################
    ############################################################################

    private function calcularEdad($fechaNacimiento) {
        $fecha_actual = new DateTime();
        $fecha_nac = new DateTime($fechaNacimiento);
        return $fecha_actual->diff($fecha_nac)->y;
    }

    private function determinarCategoria($edad) {
        if ($edad < 8) return 'Sub-6';
        if ($edad <= 9) return 'Sub-8';
        if ($edad <= 11) return 'Sub-10';
        if ($edad <= 13) return 'Sub-12';
        if ($edad <= 15) return 'Sub-14';
        if ($edad <= 17) return 'Sub-16';
        if ($edad <= 20) return 'Sub-18';
        return 'Adultos';
    }

    private function validarCedula($cedula) {
        if (!preg_match('/^[0-9]{6,10}$/', $cedula)) {
            throw new Exception("La cédula debe contener solo números y tener entre 6 y 10 dígitos.");
        }
        return true;
    }

    private function validarNombreApellido($texto, $campo) {
        if (!preg_match('/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s\'-]{2,50}$/', $texto)) {
            throw new Exception("El $campo debe contener solo letras y tener entre 2 y 50 caracteres.");
        }
        return true;
    }

    private function validarSexo($sexo) {
        if (!in_array($sexo, ['M', 'F'])) {
            throw new Exception("El sexo debe ser M (Masculino) o F (Femenino).");
        }
        return true;
    }

    private function validarTelefono($telefono) {
        if (!empty($telefono) && !preg_match('/^[0-9]{7,15}$/', $telefono)) {
            throw new Exception("El formato del teléfono no es válido.");
        }
        return true;
    }

    private function validarEmail($email) {
        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("El formato del correo electrónico no es válido.");
        }
        return true;
    }

    private function validarFechaNacimiento($fecha) {
        $fecha_actual = new DateTime();
        $fecha_nac = new DateTime($fecha);
        $edad = $fecha_actual->diff($fecha_nac)->y;
        
        if ($edad < 4 || $edad > 120) {
            throw new Exception("La fecha de nacimiento no es válida. La edad debe estar entre 4 y 120 años.");
        }
        return true;
    }

    private function validarEstatus($estatus) {
        if (!in_array($estatus, ['activo', 'inactivo', 'suspendido'])) {
            throw new Exception("El estatus debe ser activo, inactivo o suspendido.");
        }
        return true;
    }

    private function validarDatosCompletos($datos) {
        $campos_requeridos = ['cedula', 'nombre', 'apellido', 'sexo', 'fechaNacimiento', 'estatus'];
        
        foreach ($campos_requeridos as $campo) {
            if (empty(trim($datos[$campo]))) {
                throw new Exception("El campo " . strtoupper(str_replace('_', ' ', $campo)) . " es requerido.");
            }
        }
        return true;
    }

    ############################################################################
    ### REGISTRAR ##############################################################
    ############################################################################
    public function RegistrarAlumno($cedula, $nombre, $apellido, $sexo, $fechaNacimiento, $telefono, $localidadMunicipio, $correo, $club, $direccion, $dondeEstudia, $grado, $seccion, $deporte, $centroIniciacionDeportivo, $idRepresentante, $idUsuario, $estatus){
        include("conexion.php");

        try {
            // Validar datos
            $datos = compact('cedula', 'nombre', 'apellido', 'sexo', 'fechaNacimiento', 'estatus');
            $this->validarDatosCompletos($datos);
            $this->validarCedula($cedula);
            $this->validarNombreApellido($nombre, 'nombre');
            $this->validarNombreApellido($apellido, 'apellido');
            $this->validarSexo($sexo);
            $this->validarTelefono($telefono);
            $this->validarEmail($correo);
            $this->validarFechaNacimiento($fechaNacimiento);
            $this->validarEstatus($estatus);

            // Calcular edad y categoría automáticamente
            $edad = $this->calcularEdad($fechaNacimiento);
            $categoria = $this->determinarCategoria($edad);

            // Verificar si ya existe el alumno por cédula
            $sql = $conex->prepare("SELECT * FROM ALUMNO WHERE cedula = ?");
            $sql->execute([$cedula]);
            $num = $sql->rowCount();

            if (!$num){
                // Insertar nuevo alumno
                $sql = $conex->prepare("INSERT INTO ALUMNO (cedula, nombre, apellido, sexo, fechaNacimiento, edad, categoria, telefono, localidadMunicipio, correo, club, direccion, dondeEstudia, grado, seccion, deporte, centroIniciacionDeportivo, idRepresentante, idUsuario, estatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $insertar = $sql->execute([$cedula, $nombre, $apellido, $sexo, $fechaNacimiento, $edad, $categoria, $telefono, $localidadMunicipio, $correo, $club, $direccion, $dondeEstudia, $grado, $seccion, $deporte, $centroIniciacionDeportivo, $idRepresentante, $idUsuario, $estatus]);
                
                if($insertar){
                    $this->registrarBitacora("REGISTRO_ALUMNO", "Alumno registrado: $cedula - $nombre $apellido, Categoría: $categoria");
                }

                return $insertar;
            }else{
                throw new Exception("Ya existe un alumno registrado con esta cédula.");
            }
        } catch (Exception $e) {
            error_log("Error al registrar alumno: " . $e->getMessage());
            throw $e;
        }
    }

    #############################################################################
    ### LISTAR ##################################################################
    #############################################################################
    public function ListarAlumnos(){
        include("conexion.php");
        
        try {
            $sql = $conex->prepare("SELECT 
                                        a.idAlumno,
                                        a.cedula,
                                        a.nombre,
                                        a.apellido,
                                        a.sexo,
                                        a.fechaNacimiento,
                                        a.edad,
                                        a.categoria,
                                        a.telefono,
                                        a.localidadMunicipio,
                                        a.correo,
                                        a.club,
                                        a.direccion,
                                        a.dondeEstudia,
                                        a.grado,
                                        a.seccion,
                                        a.deporte,
                                        a.centroIniciacionDeportivo,
                                        a.idRepresentante,
                                        a.idUsuario,
                                        a.estatus,
                                        a.fechaRegistro,
                                        r.nombre AS nombre_representante,
                                        r.apellido AS apellido_representante
                                    FROM ALUMNO a
                                    LEFT JOIN REPRESENTANTE r ON a.idRepresentante = r.idRepresentante
                                    ORDER BY a.apellido, a.nombre");
            $sql->execute();
            $num_reg = $sql->rowCount();

            if ($num_reg > 0) {
                return $sql->fetchAll(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        } catch (PDOException $e) {
            error_log("Error al listar alumnos: " . $e->getMessage());
            return false;
        }
    }

    #############################################################################
    ### LISTAR POR CATEGORIA ####################################################
    #############################################################################
    public function ListarAlumnosPorCategoria($categoria){
        include("conexion.php");
        
        try {
            $sql = $conex->prepare("SELECT a.*, r.nombre as nombre_representante, r.apellido as apellido_representante 
                                   FROM ALUMNO a 
                                   LEFT JOIN REPRESENTANTE r ON a.idRepresentante = r.idRepresentante 
                                   WHERE a.categoria = ?
                                   ORDER BY a.nombre, a.apellido");
            $sql->execute([$categoria]);
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error al listar alumnos por categoría: " . $e->getMessage());
            throw new Exception("Error al obtener la lista de alumnos por categoría.");
        }
    }

    #############################################################################
    ### CONSULTAR ###############################################################
    #############################################################################
    public function ConsultarAlumno($cedula){
        include("conexion.php");
        
        try {
            $this->validarCedula($cedula);
            
            $sql = $conex->prepare("SELECT a.*, r.nombre as nombre_representante, r.apellido as apellido_representante, r.telefono as telefono_representante, r.correo as correo_representante, r.parentesco, u.nombreUsuario, u.rol 
                                   FROM ALUMNO a 
                                   LEFT JOIN REPRESENTANTE r ON a.idRepresentante = r.idRepresentante 
                                   LEFT JOIN USUARIO u ON a.idUsuario = u.idUsuario 
                                   WHERE a.cedula = ?");
            $sql->execute([$cedula]);
            $num_reg = $sql->rowCount();
            
            if ($num_reg > 0) {
                return $sql->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        } catch (Exception $e) {
            error_log("Error al consultar alumno: " . $e->getMessage());
            throw $e;
        }
    }

    #############################################################################
    ### CONSULTAR POR ID ########################################################
    #############################################################################
    public function ConsultarAlumnoPorId($idAlumno){
        include("conexion.php");
        
        try {
            $sql = $conex->prepare("SELECT a.*, r.nombre as nombre_representante, r.apellido as apellido_representante, r.telefono as telefono_representante, r.correo as correo_representante, r.parentesco, u.nombreUsuario, u.rol 
                                   FROM ALUMNO a 
                                   LEFT JOIN REPRESENTANTE r ON a.idRepresentante = r.idRepresentante 
                                   LEFT JOIN USUARIO u ON a.idUsuario = u.idUsuario 
                                   WHERE a.idAlumno = ?");
            $sql->execute([$idAlumno]);
            
            if ($sql->rowCount() > 0) {
                return $sql->fetch(PDO::FETCH_ASSOC);
            } else {
                return false;
            }
        } catch (PDOException $e) {
            error_log("Error al consultar alumno por ID: " . $e->getMessage());
            throw new Exception("Error al consultar el alumno.");
        }
    }

    ############################################################################
    ### ACTUALIZAR #############################################################
    ############################################################################
    public function ActualizarAlumno($idAlumno, $cedula, $nombre, $apellido, $sexo, $fechaNacimiento, $telefono, $localidadMunicipio, $correo, $club, $direccion, $dondeEstudia, $grado, $seccion, $deporte, $centroIniciacionDeportivo, $idRepresentante, $idUsuario, $estatus){
        include("conexion.php");

        try {
            // Validar datos
            $datos = compact('cedula', 'nombre', 'apellido', 'sexo', 'fechaNacimiento', 'estatus');
            $this->validarDatosCompletos($datos);
            $this->validarCedula($cedula);
            $this->validarNombreApellido($nombre, 'nombre');
            $this->validarNombreApellido($apellido, 'apellido');
            $this->validarSexo($sexo);
            $this->validarTelefono($telefono);
            $this->validarEmail($correo);
            $this->validarFechaNacimiento($fechaNacimiento);
            $this->validarEstatus($estatus);

            // Calcular edad y categoría automáticamente
            $edad = $this->calcularEdad($fechaNacimiento);
            $categoria = $this->determinarCategoria($edad);

            // Verificar si existe el alumno
            $sql = $conex->prepare("SELECT * FROM ALUMNO WHERE idAlumno = ?");
            $sql->execute([$idAlumno]);
            $num = $sql->rowCount();

            if ($num > 0){
                $sql = $conex->prepare("UPDATE ALUMNO SET cedula = ?, nombre = ?, apellido = ?, sexo = ?, fechaNacimiento = ?, edad = ?, categoria = ?, telefono = ?, localidadMunicipio = ?, correo = ?, club = ?, direccion = ?, dondeEstudia = ?, grado = ?, seccion = ?, deporte = ?, centroIniciacionDeportivo = ?, idRepresentante = ?, idUsuario = ?, estatus = ? WHERE idAlumno = ?");
                $actualizar = $sql->execute([$cedula, $nombre, $apellido, $sexo, $fechaNacimiento, $edad, $categoria, $telefono, $localidadMunicipio, $correo, $club, $direccion, $dondeEstudia, $grado, $seccion, $deporte, $centroIniciacionDeportivo, $idRepresentante, $idUsuario, $estatus, $idAlumno]);
                
                if($actualizar){
                    $this->registrarBitacora("ACTUALIZACION_ALUMNO", "Alumno actualizado: $cedula - $nombre $apellido, Categoría: $categoria");
                }
                
                return $actualizar;
            }else{
                throw new Exception("No existe un alumno registrado con este ID.");
            }
        } catch (Exception $e) {
            error_log("Error al actualizar alumno: " . $e->getMessage());
            throw $e;
        }
    }

    ############################################################################
    ### ACTUALIZAR ESTATUS #####################################################
    ############################################################################
    public function ActualizarEstatusAlumno($idAlumno, $estatus){
        include("conexion.php");

        try {
            $this->validarEstatus($estatus);

            $sql = $conex->prepare("SELECT * FROM ALUMNO WHERE idAlumno = ?");
            $sql->execute([$idAlumno]);
            $alumno = $sql->fetch(PDO::FETCH_ASSOC);

            if ($alumno){
                $sql = $conex->prepare("UPDATE ALUMNO SET estatus = ? WHERE idAlumno = ?");
                $actualizar = $sql->execute([$estatus, $idAlumno]);
                
                if($actualizar){
                    $this->registrarBitacora("ACTUALIZACION_ESTATUS_ALUMNO", "Estatus de alumno actualizado: {$alumno['cedula']} - {$alumno['nombre']} {$alumno['apellido']} a $estatus");
                }
                
                return $actualizar;
            }else{
                throw new Exception("No existe un alumno registrado con este ID.");
            }
        } catch (Exception $e) {
            error_log("Error al actualizar estatus de alumno: " . $e->getMessage());
            throw $e;
        }
    }

    ############################################################################
    ### ELIMINAR ###############################################################
    ############################################################################
    public function EliminarAlumno($idAlumno){
        include("conexion.php");

        try {
            // Verificar si existe el alumno antes de eliminar
            $sql = $conex->prepare("SELECT * FROM ALUMNO WHERE idAlumno = ?");
            $sql->execute([$idAlumno]);
            $num = $sql->rowCount();

            if($num > 0){
                // Obtener datos para bitácora antes de eliminar
                $data = $sql->fetch(PDO::FETCH_ASSOC);
                $nombre_completo = $data['nombre'] . " " . $data['apellido'];
                
                // Iniciar transacción
                $conex->beginTransaction();

                try {
                    // Eliminar el alumno
                    $sql_alumno = $conex->prepare("DELETE FROM ALUMNO WHERE idAlumno = ?");
                    $eliminar = $sql_alumno->execute([$idAlumno]);
                    
                    if($eliminar){
                        $conex->commit();
                        $this->registrarBitacora("ELIMINACION_ALUMNO", "Alumno eliminado: {$data['cedula']} - $nombre_completo");
                        return $eliminar;
                    } else {
                        throw new Exception("Error al eliminar el alumno.");
                    }
                    
                } catch (Exception $e) {
                    $conex->rollBack();
                    throw $e;
                }
                
            } else {
                throw new Exception("No existe un alumno registrado con este ID.");
            }
        } catch (Exception $e) {
            error_log("Error al eliminar alumno: " . $e->getMessage());
            throw $e;
        }
    }

    ############################################################################
    ### OBTENER CATEGORIAS DISPONIBLES #########################################
    ############################################################################
    public function ObtenerCategorias(){
        return [
            'Sub-6' => 'Sub-6 (Menores de 6 años)',
            'Sub-8' => 'Sub-8 (6-7 años)',
            'Sub-10' => 'Sub-10 (8-9 años)',
            'Sub-12' => 'Sub-12 (10-11 años)',
            'Sub-14' => 'Sub-14 (12-13 años)',
            'Sub-16' => 'Sub-16 (14-15 años)',
            'Sub-18' => 'Sub-18 (16-17 años)',
            'Adultos' => 'Adultos (18+ años)'
        ];
    }

    ############################################################################
    ### ESTADISTICAS ###########################################################
    ############################################################################
    public function ObtenerEstadisticas(){
        include("conexion.php");
        
        try {
            $stats = [];
            
            // Total de alumnos
            $sql = $conex->query("SELECT COUNT(*) as total FROM ALUMNO");
            $stats['total'] = $sql->fetch(PDO::FETCH_ASSOC)['total'];
            
            // Alumnos por estatus
            $sql = $conex->query("SELECT estatus, COUNT(*) as cantidad FROM ALUMNO GROUP BY estatus");
            $stats['por_estatus'] = $sql->fetchAll(PDO::FETCH_ASSOC);
            
            // Alumnos por categoría
            $sql = $conex->query("SELECT categoria, COUNT(*) as cantidad FROM ALUMNO GROUP BY categoria ORDER BY categoria");
            $stats['por_categoria'] = $sql->fetchAll(PDO::FETCH_ASSOC);
            
            // Alumnos por sexo
            $sql = $conex->query("SELECT sexo, COUNT(*) as cantidad FROM ALUMNO GROUP BY sexo");
            $stats['por_sexo'] = $sql->fetchAll(PDO::FETCH_ASSOC);
            
            return $stats;
        } catch (PDOException $e) {
            error_log("Error al obtener estadísticas: " . $e->getMessage());
            throw new Exception("Error al obtener estadísticas de alumnos.");
        }
    }
}
?>