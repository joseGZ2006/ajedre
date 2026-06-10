<?php
// Clase Usuario
class Usuario {
    // DECLARACION DE LAS PROPIEDADES
    public $idUsuario, $nombreUsuario, $contrasena, $rol, $estatus;

    // Setters
    public function setIdUsuario($idUsuario){ $this->idUsuario = $idUsuario; }
    public function setNombreUsuario($nombreUsuario){ $this->nombreUsuario = $nombreUsuario; }
    public function setContrasena($contrasena){ $this->contrasena = $contrasena; }
    public function setRol($rol){ $this->rol = $rol; }
    public function setEstatus($estatus){ $this->estatus = $estatus; }
     
    // Getters
    public function getIdUsuario(){ return $this->idUsuario; }
    public function getNombreUsuario(){ return $this->nombreUsuario; }
    public function getContrasena(){ return $this->contrasena; }
    public function getRol(){ return $this->rol; }
    public function getEstatus(){ return $this->estatus; }

    // Función privada para validar nombre de usuario
    private function validarNombreUsuario($nombre) {
        if(empty($nombre)) {
            return false;
        }
        return preg_match('/^[a-zA-Z0-9_.-]{3,50}$/', $nombre);
    }

    // Función privada para validar rol
    private function validarRol($rol) {
        $rolesPermitidos = ['admin', 'entrenador', 'alumno'];
        return in_array($rol, $rolesPermitidos);
    }

    // Función privada para validar estatus
    private function validarEstatus($estatus) {
        $estatusPermitidos = ['activo', 'inactivo'];
        return in_array($estatus, $estatusPermitidos);
    }



    /**
     * OBTENER LA INFORMACIÓN COMPLETA DEL USUARIO (incluyendo a quién pertenece)
     */
    public function obtenerUsuarioCompleto($idUsuario) {
        include("conexion.php");
        
        // Obtener datos básicos del usuario
        $sql = $conex->prepare("SELECT idUsuario, nombreUsuario, rol, estatus FROM USUARIO WHERE idUsuario = ?");
        $sql->execute([$idUsuario]);
        $usuario = $sql->fetch(PDO::FETCH_ASSOC);
        
        if(!$usuario) {
            return null;
        }
        
        // Verificar a quién pertenece según el rol
        $perteneceA = null;
        $tipoAsociacion = null;
        
        if($usuario['rol'] == 'entrenador') {
            // Buscar en la tabla ENTRENADOR
            $sql2 = $conex->prepare("
                SELECT e.idEntrenador, e.cedula, e.nombre, e.apellido, e.telefono, 
                       es.nombre as especialidad_nombre
                FROM ENTRENADOR e
                LEFT JOIN ESPECIALIDAD es ON e.idEspecialidad = es.idEspecialidad
                WHERE e.idUsuario = ?
            ");
            $sql2->execute([$idUsuario]);
            $entrenador = $sql2->fetch(PDO::FETCH_ASSOC);
            
            if($entrenador) {
                $tipoAsociacion = 'entrenador';
                $perteneceA = [
                    'id' => $entrenador['idEntrenador'],
                    'cedula' => $entrenador['cedula'],
                    'nombre' => $entrenador['nombre'],
                    'apellido' => $entrenador['apellido'],
                    'telefono' => $entrenador['telefono'],
                    'especialidad' => $entrenador['especialidad_nombre']
                ];
            }
        } 
        elseif($usuario['rol'] == 'alumno') {
            // Buscar en la tabla ALUMNO
            $sql2 = $conex->prepare("
                SELECT a.idAlumno, a.cedula, a.nombre, a.apellido, a.telefono, a.categoria,
                       a.fechaNacimiento, a.edad, a.correo, a.estatus as alumno_estatus,
                       r.nombre as representante_nombre, r.apellido as representante_apellido, r.telefono as representante_telefono
                FROM ALUMNO a
                LEFT JOIN REPRESENTANTE r ON a.idRepresentante = r.idRepresentante
                WHERE a.idUsuario = ?
            ");
            $sql2->execute([$idUsuario]);
            $alumno = $sql2->fetch(PDO::FETCH_ASSOC);
            
            if($alumno) {
                $tipoAsociacion = 'alumno';
                $perteneceA = [
                    'id' => $alumno['idAlumno'],
                    'cedula' => $alumno['cedula'],
                    'nombre' => $alumno['nombre'],
                    'apellido' => $alumno['apellido'],
                    'telefono' => $alumno['telefono'],
                    'categoria' => $alumno['categoria'],
                    'fechaNacimiento' => $alumno['fechaNacimiento'],
                    'edad' => $alumno['edad'],
                    'correo' => $alumno['correo'],
                    'estatus_alumno' => $alumno['alumno_estatus'],
                    'representante' => $alumno['representante_nombre'] ? $alumno['representante_nombre'] . ' ' . $alumno['representante_apellido'] : null,
                    'telefono_representante' => $alumno['representante_telefono']
                ];
            }
        }
        
        return [
            'usuario' => $usuario,
            'tipo_asociacion' => $tipoAsociacion,
            'pertenece_a' => $perteneceA
        ];
    }

    /**
     * OBTENER USUARIOS DISPONIBLES PARA ENTRENADOR
     * Solo usuarios con rol 'entrenador' que no estén en la tabla ENTRENADOR
     */
    public function obtenerUsuariosDisponiblesParaEntrenador() {
        include("conexion.php");
        
        $sql = $conex->prepare("
            SELECT u.idUsuario, u.nombreUsuario, u.rol, u.estatus 
            FROM USUARIO u 
            WHERE u.rol = 'entrenador' 
            AND u.estatus = 'activo'
            AND u.idUsuario NOT IN (
                SELECT e.idUsuario 
                FROM ENTRENADOR e 
                WHERE e.idUsuario IS NOT NULL
            )
            ORDER BY u.nombreUsuario
        ");
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return [];
    }

    /**
     * OBTENER USUARIOS DISPONIBLES PARA ALUMNO
     * Solo usuarios con rol 'alumno' que no estén en la tabla ALUMNO
     */
    public function obtenerUsuariosDisponiblesParaAlumno() {
        include("conexion.php");
        
        $sql = $conex->prepare("
            SELECT u.idUsuario, u.nombreUsuario, u.rol, u.estatus 
            FROM USUARIO u 
            WHERE u.rol = 'alumno' 
            AND u.estatus = 'activo'
            AND u.idUsuario NOT IN (
                SELECT a.idUsuario 
                FROM ALUMNO a 
                WHERE a.idUsuario IS NOT NULL
            )
            ORDER BY u.nombreUsuario
        ");
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return [];
    }

    /**
     * OBTENER TODOS LOS USUARIOS CON ROL ENTRENADOR (incluyendo asociados)
     */
    public function obtenerTodosUsuariosEntrenador() {
        include("conexion.php");
        
        $sql = $conex->prepare("
            SELECT u.idUsuario, u.nombreUsuario, u.rol, u.estatus,
                CASE WHEN e.idEntrenador IS NOT NULL THEN 'asociado' ELSE 'disponible' END as estado_asociacion
            FROM USUARIO u 
            LEFT JOIN ENTRENADOR e ON u.idUsuario = e.idUsuario
            WHERE u.rol = 'entrenador'
            ORDER BY u.nombreUsuario
        ");
        $sql->execute();
        
        if($sql->rowCount() > 0) {
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return [];
    }

    /**
     * VERIFICAR SI UN USUARIO YA ESTÁ ASOCIADO A UN ENTRENADOR
     */
    public function verificarUsuarioAsociadoAEntrenador($idUsuario) {
        include("conexion.php");
        
        $sql = $conex->prepare("SELECT COUNT(*) as total FROM ENTRENADOR WHERE idUsuario = ?");
        $sql->execute([$idUsuario]);
        $resultado = $sql->fetch(PDO::FETCH_ASSOC);
        
        return $resultado['total'] > 0;
    }

    /**
     * VERIFICAR SI UN USUARIO YA ESTÁ ASOCIADO A UN ALUMNO
     */
    public function verificarUsuarioAsociadoAAlumno($idUsuario) {
        include("conexion.php");
        
        $sql = $conex->prepare("SELECT COUNT(*) as total FROM ALUMNO WHERE idUsuario = ?");
        $sql->execute([$idUsuario]);
        $resultado = $sql->fetch(PDO::FETCH_ASSOC);
        
        return $resultado['total'] > 0;
    }

    /**
     * OBTENER USUARIO ACTUAL DE UN ENTRENADOR (para edición)
     */
    public function obtenerUsuarioActualEntrenador($id_entrenador) {
        include("conexion.php");
        
        $sql = $conex->prepare("
            SELECT u.idUsuario, u.nombreUsuario, u.rol, u.estatus 
            FROM ENTRENADOR e
            INNER JOIN USUARIO u ON e.idUsuario = u.idUsuario
            WHERE e.idEntrenador = ?
        ");
        $sql->execute([$id_entrenador]);
        
        if($sql->rowCount() > 0) {
            return $sql->fetch(PDO::FETCH_ASSOC);
        }
        return null;
    }

    /**
     * OBTENER USUARIO ACTUAL DE UN ALUMNO (para edición)
     */
    public function obtenerUsuarioActualAlumno($id_alumno) {
        include("conexion.php");
        
        $sql = $conex->prepare("
            SELECT u.idUsuario, u.nombreUsuario, u.rol, u.estatus 
            FROM ALUMNO a
            INNER JOIN USUARIO u ON a.idUsuario = u.idUsuario
            WHERE a.idAlumno = ?
        ");
        $sql->execute([$id_alumno]);
        
        if($sql->rowCount() > 0) {
            return $sql->fetch(PDO::FETCH_ASSOC);
        }
        return null;
    }

    ############################################################################
    ### REGISTRAR ##############################################################
    ############################################################################
    public function RegistrarUsuario($nombreUsuario, $contrasena, $rol, $estatus){
        include("conexion.php");

        // Validaciones
        if(!$this->validarNombreUsuario($nombreUsuario)) {
            return false;
        }
        if(!$this->validarRol($rol)) {
            return false;
        }
        if(!$this->validarEstatus($estatus)) {
            return false;
        }
        if(empty($contrasena) || strlen($contrasena) < 6) {
            return false;
        }
        
        // Verificar si ya existe el nombre de usuario
        $sql = $conex->prepare("SELECT idUsuario FROM USUARIO WHERE nombreUsuario = ?");
        $sql->execute([$nombreUsuario]);
        $num = $sql->rowCount();

        if ($num == 0){
            // Encriptar contraseña
            $hashedPassword = password_hash($contrasena, PASSWORD_DEFAULT);
            
            // Insertar nuevo usuario
            $sql = $conex->prepare("INSERT INTO USUARIO (nombreUsuario, contrasena, rol, estatus) VALUES (?, ?, ?, ?)");
            $insertar = $sql->execute([$nombreUsuario, $hashedPassword, $rol, $estatus]);
            
            if($insertar) {
                return true;
            }
            return false;
        }
        return 'exists';
    }

    #############################################################################
    ### LISTAR ##################################################################
    #############################################################################
    public function ListarUsuarios(){
        include("conexion.php");
        
        $sql = $conex->prepare("SELECT idUsuario, nombreUsuario, rol, estatus FROM USUARIO ORDER BY idUsuario");
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
    public function ConsultarUsuario($idUsuario){
        include("conexion.php");
        
        $sql = $conex->prepare("SELECT idUsuario, nombreUsuario, rol, estatus FROM USUARIO WHERE idUsuario = ?");
        $sql->execute([$idUsuario]);
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
    public function MostrarUsuario($idUsuario){
        include("conexion.php");
        
        $sql = $conex->prepare("SELECT idUsuario, nombreUsuario, rol, estatus FROM USUARIO WHERE idUsuario = ?");
        $sql->execute([$idUsuario]);
        $num_reg = $sql->rowCount();
        
        if ($num_reg > 0) {
            return $sql->fetch(PDO::FETCH_ASSOC);  
        } else {
            return false;
        }
    }

    #############################################################################
    ### ACTUALIZAR USUARIO ######################################################
    ############################################################################
    public function ActualizarUsuario($idUsuario, $nombreUsuario, $contrasena = null, $rol, $estatus){
        include("conexion.php"); 

        // Validaciones
        if(!$this->validarNombreUsuario($nombreUsuario)) {
            return false;
        }
        if(!$this->validarRol($rol)) {
            return false;
        }
        if(!$this->validarEstatus($estatus)) {
            return false;
        }
        if($contrasena !== null && strlen($contrasena) < 6) {
            return false;
        }

        // Verificar si ya existe el nombre de usuario en otro registro
        $sql = $conex->prepare("SELECT idUsuario FROM USUARIO WHERE nombreUsuario = ? AND idUsuario != ?");
        $sql->execute([$nombreUsuario, $idUsuario]);
        $num = $sql->rowCount();

        if ($num == 0){
            // Construir consulta dinámicamente según si se actualiza contraseña o no
            if ($contrasena !== null && !empty($contrasena)) {
                $hashedPassword = password_hash($contrasena, PASSWORD_DEFAULT);
                $sql = $conex->prepare("UPDATE USUARIO SET nombreUsuario = ?, contrasena = ?, rol = ?, estatus = ? WHERE idUsuario = ?");
                $actualizar = $sql->execute([$nombreUsuario, $hashedPassword, $rol, $estatus, $idUsuario]);
            } else {
                $sql = $conex->prepare("UPDATE USUARIO SET nombreUsuario = ?, rol = ?, estatus = ? WHERE idUsuario = ?");
                $actualizar = $sql->execute([$nombreUsuario, $rol, $estatus, $idUsuario]);
            }
            
            if($actualizar) {
                return true;
            }
            return false;
        }
        return 'exists';
    }

    ############################################################################
    ### ELIMINAR ###############################################################
    ############################################################################
    public function EliminarUsuario($idUsuario){
        include("conexion.php"); 
        
        try {
            // Verificar si el usuario está siendo utilizado en ALUMNO o ENTRENADOR
            $sql = $conex->prepare("SELECT idAlumno FROM ALUMNO WHERE idUsuario = ? LIMIT 1");
            $sql->execute([$idUsuario]);
            if($sql->rowCount() > 0) {
                return 'in_use';
            }
            
            $sql = $conex->prepare("SELECT idEntrenador FROM ENTRENADOR WHERE idUsuario = ? LIMIT 1");
            $sql->execute([$idUsuario]);
            if($sql->rowCount() > 0) {
                return 'in_use';
            }
            
            // Eliminar usuario
            $sql = $conex->prepare("DELETE FROM USUARIO WHERE idUsuario = ?");
            $eliminar = $sql->execute([$idUsuario]);
            
            if($eliminar) {
                return true;
            }
            return false;
            
        } catch (Exception $e) {
            return false;
        }
    }

    ############################################################################
    ### VERIFICAR EXISTENCIA POR NOMBRE DE USUARIO #############################
    ############################################################################
    public function VerificarExistenciaPorNombre($nombreUsuario){
        include("conexion.php");
        $sql = $conex->prepare("SELECT COUNT(*) as total FROM USUARIO WHERE nombreUsuario = ?");
        $sql->execute([$nombreUsuario]);
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        return $data['total'] > 0;
    }

    ############################################################################
    ### OBTENER USUARIO POR NOMBRE #############################################
    ############################################################################
    public function ObtenerUsuarioPorNombre($nombreUsuario){
        include("conexion.php");
        $sql = $conex->prepare("SELECT idUsuario, nombreUsuario, rol, estatus FROM USUARIO WHERE nombreUsuario = ?");
        $sql->execute([$nombreUsuario]);
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    ############################################################################
    ### INICIAR SESION #########################################################
    ############################################################################
    public function IniciarSesion($nombreUsuario, $contrasena){
        include("conexion.php");
        
        try {
            // Buscar usuario por nombre de usuario
            $sql = $conex->prepare("SELECT idUsuario, nombreUsuario, contrasena, rol, estatus 
                                   FROM USUARIO 
                                   WHERE nombreUsuario = ?");
            $sql->execute([$nombreUsuario]);
            $num_reg = $sql->rowCount();
            $data = $sql->fetch(PDO::FETCH_ASSOC);

            if ($num_reg > 0) {
                // Verificar si la contraseña coincide
                if (password_verify($contrasena, $data['contrasena'])) {
                    // Verificar si el usuario está activo
                    if ($data['estatus'] === 'activo') {
                        return [
                            'idUsuario' => $data['idUsuario'],
                            'nombreUsuario' => $data['nombreUsuario'],
                            'rol' => $data['rol'],
                            'estatus' => $data['estatus']
                        ];
                    } else {
                        return -1; // Usuario inactivo
                    }
                } else {
                    return 0; // Contraseña incorrecta
                }
            } else {
                return 0; // Usuario no encontrado
            }
        } catch (PDOException $e) {
            error_log("Error en inicio de sesión: " . $e->getMessage());
            return false;
        }
    }
}
?>