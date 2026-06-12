<?php
// Clase Alumno con protección contra inyección SQL
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

    // ==================== MÉTODOS PRIVADOS ====================
    
    private function calcularEdad($fechaNacimiento) {
        $fecha_actual = new DateTime();
        $fecha_nac = new DateTime($fechaNacimiento);
        $edad = $fecha_actual->diff($fecha_nac)->y;
        return $edad;
    }

    private function determinarCategoria($edad) {
        if ($edad < 6) return 'Sub-6';
        if ($edad <= 7) return 'Sub-7';
        if ($edad <= 8) return 'Sub-8';
        if ($edad <= 9) return 'Sub-9';
        if ($edad <= 10) return 'Sub-10';
        if ($edad <= 11) return 'Sub-11';
        if ($edad <= 12) return 'Sub-12';
        if ($edad <= 13) return 'Sub-13';
        if ($edad <= 14) return 'Sub-14';
        if ($edad <= 15) return 'Sub-15';
        if ($edad <= 16) return 'Sub-16';
        if ($edad <= 17) return 'Sub-17';
        if ($edad <= 18) return 'Sub-18';
        if ($edad <= 19) return 'Sub-19';
        if ($edad <= 20) return 'Sub-20';
        return 'Abierta';
    }

    // ==================== VERIFICACIONES ====================
    
    public function verificarCedulaExistente($cedula, $excluirId = null) {
        include("conexion.php");
        
        try {
            if($excluirId) {
                $sql = $conex->prepare("SELECT COUNT(*) as total FROM ALUMNO WHERE cedula = ? AND idAlumno != ?");
                $sql->execute([$cedula, $excluirId]);
            } else {
                $sql = $conex->prepare("SELECT COUNT(*) as total FROM ALUMNO WHERE cedula = ?");
                $sql->execute([$cedula]);
            }
            
            $resultado = $sql->fetch(PDO::FETCH_ASSOC);
            return $resultado['total'] > 0;
        } catch (PDOException $e) {
            error_log("Error verificarCedulaExistente: " . $e->getMessage());
            return false;
        }
    }
    
    private function verificarAlumnoEnUso($idAlumno) {
        include("conexion.php");
        
        try {
            $sql = $conex->prepare("SELECT COUNT(*) as total FROM ASIGNACION_CLASE WHERE idAlumno = ?");
            $sql->execute([$idAlumno]);
            $resultado = $sql->fetch(PDO::FETCH_ASSOC);
            if($resultado['total'] > 0) return true;
            
            $sql = $conex->prepare("SELECT COUNT(*) as total FROM INSCRIPCION_TORNEO WHERE idAlumno = ?");
            $sql->execute([$idAlumno]);
            $resultado = $sql->fetch(PDO::FETCH_ASSOC);
            if($resultado['total'] > 0) return true;
            
            $sql = $conex->prepare("SELECT COUNT(*) as total FROM CLASIFICACION_FINAL WHERE idAlumno = ?");
            $sql->execute([$idAlumno]);
            $resultado = $sql->fetch(PDO::FETCH_ASSOC);
            return $resultado['total'] > 0;
        } catch (PDOException $e) {
            error_log("Error verificarAlumnoEnUso: " . $e->getMessage());
            return false;
        }
    }

    // ==================== REGISTRAR ====================
    
    public function RegistrarAlumno($cedula, $nombre, $apellido, $sexo, $fechaNacimiento, $telefono, $localidadMunicipio, $correo, $club, $direccion, $dondeEstudia, $grado, $seccion, $deporte, $centroIniciacionDeportivo, $idRepresentante, $estatus){
        include("conexion.php");

        try {
            $edad = $this->calcularEdad($fechaNacimiento);
            $categoria = $this->determinarCategoria($edad);

            // Verificar cédula
            if($this->verificarCedulaExistente($cedula)) return 'cedula_exists';
            
            $sql = $conex->prepare("INSERT INTO ALUMNO (
                cedula, nombre, apellido, sexo, fechaNacimiento, edad, categoria, 
                telefono, localidadMunicipio, correo, club, direccion, 
                dondeEstudia, grado, seccion, deporte, centroIniciacionDeportivo, 
                idRepresentante, estatus
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            
            $insertar = $sql->execute([
                $cedula, $nombre, $apellido, $sexo, $fechaNacimiento, $edad, $categoria,
                $telefono, $localidadMunicipio, $correo, $club, $direccion,
                $dondeEstudia, $grado, $seccion, $deporte, $centroIniciacionDeportivo,
                $idRepresentante, $estatus
            ]);
            
            return $insertar ? true : false;
            
        } catch (PDOException $e) {
            error_log("Error al registrar alumno: " . $e->getMessage());
            return false;
        }
    }

    // ==================== LISTAR ====================
    
    public function ListarAlumnos(){
        include("conexion.php");
        
        try {
            $sql = $conex->prepare("SELECT 
                                        a.*, 
                                        r.nombre AS nombre_representante, 
                                        r.apellido AS apellido_representante
                                    FROM ALUMNO a
                                    LEFT JOIN REPRESENTANTE r ON a.idRepresentante = r.idRepresentante
                                    ORDER BY a.apellido, a.nombre");
            $sql->execute();
            
            if($sql->rowCount() > 0) {
                return $sql->fetchAll(PDO::FETCH_ASSOC);
            }
            return false;
        } catch (PDOException $e) {
            error_log("Error al listar alumnos: " . $e->getMessage());
            return false;
        }
    }

    // ==================== CONSULTAR POR CÉDULA ====================
    
    public function ConsultarAlumno($cedula){
        include("conexion.php");
        
        try {
            $sql = $conex->prepare("SELECT 
                                        a.*, 
                                        r.nombre as nombre_representante, 
                                        r.apellido as apellido_representante, 
                                        r.telefono as telefono_representante, 
                                        r.correo as correo_representante, 
                                        r.parentesco
                                   FROM ALUMNO a 
                                   LEFT JOIN REPRESENTANTE r ON a.idRepresentante = r.idRepresentante 
                                   WHERE a.cedula = ?");
            $sql->execute([$cedula]);
            
            if($sql->rowCount() > 0) {
                return $sql->fetch(PDO::FETCH_ASSOC);
            }
            return false;
        } catch (PDOException $e) {
            error_log("Error al consultar alumno: " . $e->getMessage());
            return false;
        }
    }
    
    // ==================== CONSULTAR POR ID ====================
    
    public function ConsultarAlumnoPorId($idAlumno){
        include("conexion.php");
        
        try {
            $sql = $conex->prepare("SELECT * FROM ALUMNO WHERE idAlumno = ?");
            $sql->execute([$idAlumno]);
            
            if($sql->rowCount() > 0) {
                return $sql->fetch(PDO::FETCH_ASSOC);
            }
            return false;
        } catch (PDOException $e) {
            error_log("Error al consultar alumno por ID: " . $e->getMessage());
            return false;
        }
    }

    // ==================== ACTUALIZAR ====================
    
    public function ActualizarAlumno($idAlumno, $cedula, $nombre, $apellido, $sexo, $fechaNacimiento, $telefono, $localidadMunicipio, $correo, $club, $direccion, $dondeEstudia, $grado, $seccion, $deporte, $centroIniciacionDeportivo, $idRepresentante, $estatus){
        include("conexion.php");

        try {
            $edad = $this->calcularEdad($fechaNacimiento);
            $categoria = $this->determinarCategoria($edad);
            
            // Verificar cédula duplicada
            if($this->verificarCedulaExistente($cedula, $idAlumno)) return 'cedula_exists';
            
            $sql = $conex->prepare("UPDATE ALUMNO SET 
                cedula = ?, nombre = ?, apellido = ?, sexo = ?, fechaNacimiento = ?, 
                edad = ?, categoria = ?, telefono = ?, localidadMunicipio = ?, 
                correo = ?, club = ?, direccion = ?, dondeEstudia = ?, grado = ?, 
                seccion = ?, deporte = ?, centroIniciacionDeportivo = ?, 
                idRepresentante = ?, estatus = ? 
                WHERE idAlumno = ?");
            
            $actualizar = $sql->execute([
                $cedula, $nombre, $apellido, $sexo, $fechaNacimiento,
                $edad, $categoria, $telefono, $localidadMunicipio,
                $correo, $club, $direccion, $dondeEstudia, $grado,
                $seccion, $deporte, $centroIniciacionDeportivo,
                $idRepresentante, $estatus, $idAlumno
            ]);
            
            return $actualizar ? true : false;
            
        } catch (PDOException $e) {
            error_log("Error al actualizar alumno: " . $e->getMessage());
            return false;
        }
    }

    // ==================== ELIMINAR ====================
    
    public function EliminarAlumno($idAlumno){
        include("conexion.php");

        try {
            $sql = $conex->prepare("SELECT * FROM ALUMNO WHERE idAlumno = ?");
            $sql->execute([$idAlumno]);
            if($sql->rowCount() == 0) return false;
            
            if ($this->verificarAlumnoEnUso($idAlumno)) return 'in_use';
            
            $conex->beginTransaction();
            $sql_alumno = $conex->prepare("DELETE FROM ALUMNO WHERE idAlumno = ?");
            $eliminar = $sql_alumno->execute([$idAlumno]);
            
            if($eliminar){
                $conex->commit();
                return true;
            } else {
                $conex->rollBack();
                return false;
            }
        } catch (PDOException $e) {
            if($conex->inTransaction()) $conex->rollBack();
            error_log("Error al eliminar alumno: " . $e->getMessage());
            return false;
        }
    }
}
?>