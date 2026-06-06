CREATE DATABASE IF NOT EXISTS ajedrez;
USE ajedrez;

CREATE TABLE `REPRESENTANTE` (
  `idRepresentante` INT AUTO_INCREMENT,
  `cedula` varchar(10) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `apellido` varchar(25) NOT NULL,
  `correo` varchar(30) NOT NULL,
  `telefono` varchar(11) DEFAULT NULL,
  `parentesco` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`idRepresentante`),
  UNIQUE (`cedula`)
) ENGINE=InnoDB;

CREATE TABLE `USUARIO` (
  `idUsuario` INT AUTO_INCREMENT,
  `nombreUsuario` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `rol` enum('alumno','entrenador','admin') NOT NULL,
  `estatus` enum('activo','inactivo') NOT NULL DEFAULT 'activo',
  PRIMARY KEY (`idUsuario`),
  UNIQUE (`nombreUsuario`)
) ENGINE=InnoDB;


CREATE TABLE `ALUMNO` (
  `idAlumno` INT AUTO_INCREMENT,
  `cedula` varchar(10) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `apellido` varchar(25) NOT NULL,
  `sexo` enum('M','F') DEFAULT NULL,
  `fechaNacimiento` date NOT NULL,
  `edad` int DEFAULT NULL,
  `categoria` varchar(25) DEFAULT NULL,
  `telefono` varchar(11) DEFAULT NULL,
  `localidadMunicipio` varchar(30) DEFAULT NULL,
  `correo` varchar(30) DEFAULT NULL,
  `club` varchar(30) DEFAULT NULL,
  `direccion` varchar(30) DEFAULT NULL,
  `dondeEstudia` varchar(30) DEFAULT NULL,
  `grado` varchar(20) DEFAULT NULL,
  `seccion` varchar(10) DEFAULT NULL,
  `deporte` varchar(25) DEFAULT NULL,
  `centroIniciacionDeportivo` varchar(30) DEFAULT NULL,
  `idRepresentante` int DEFAULT NULL,
  `idUsuario` int DEFAULT NULL,
  `estatus` enum('activo','inactivo','suspendido') DEFAULT 'activo',
  `fechaRegistro` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`idAlumno`),
  UNIQUE (`cedula`),
  INDEX (`idRepresentante`),
  INDEX (`idUsuario`),
  FOREIGN KEY (`idRepresentante`) REFERENCES `REPRESENTANTE`(`idRepresentante`) ON DELETE SET NULL,
  FOREIGN KEY (`idUsuario`) REFERENCES `USUARIO`(`idUsuario`) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE `ESPECIALIDAD` (
  `idEspecialidad` INT AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`idEspecialidad`),
  UNIQUE (`nombre`)
) ENGINE=InnoDB;

CREATE TABLE `ENTRENADOR` (
  `idEntrenador` INT AUTO_INCREMENT,
  `idUsuario` int DEFAULT NULL,
  `idEspecialidad` int DEFAULT NULL,
  `cedula` varchar(10) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `apellido` varchar(25) NOT NULL,
  `telefono` varchar(11) NOT NULL,
  PRIMARY KEY (`idEntrenador`),
  UNIQUE (`cedula`),
  INDEX (`idUsuario`),
  INDEX (`idEspecialidad`),
  FOREIGN KEY (`idUsuario`) REFERENCES `USUARIO`(`idUsuario`) ON DELETE SET NULL,
  FOREIGN KEY (`idEspecialidad`) REFERENCES `ESPECIALIDAD`(`idEspecialidad`) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE `HORARIO_CLASE` (
  `idHorarioClase` INT AUTO_INCREMENT,
  `diaSemana` enum('Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo') NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL,
  PRIMARY KEY (`idHorarioClase`)
) ENGINE=InnoDB;

CREATE TABLE `TIPO_TORNEO` (
  `idTipoTorneo` INT AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `tipo` enum('individual','equipo','mixto') NOT NULL,
  PRIMARY KEY (`idTipoTorneo`)
) ENGINE=InnoDB;

CREATE TABLE `TORNEO` (
  `idTorneo` INT AUTO_INCREMENT,
  `idTipoTorneo` int DEFAULT NULL,
  `nombre` varchar(30) NOT NULL,
  `fecha` date NOT NULL,
  `lugar` varchar(30) DEFAULT NULL,
  `categoria` varchar(25) DEFAULT NULL,
  `clasificacion` varchar(25) DEFAULT NULL,
  `estatus` enum('proximo','en_curso','finalizado','cancelado') NOT NULL DEFAULT 'proximo',
  `cupo` int NOT NULL,
  PRIMARY KEY (`idTorneo`),
  INDEX (`idTipoTorneo`),
  INDEX (`fecha`),
  FOREIGN KEY (`idTipoTorneo`) REFERENCES `TIPO_TORNEO`(`idTipoTorneo`) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE `ASIGNACION_CLASE` (
  `idAsignacionClase` INT AUTO_INCREMENT,
  `idAlumno` int DEFAULT NULL,
  `idEntrenador` int DEFAULT NULL,
  `idHorarioClase` int DEFAULT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date DEFAULT NULL,
  PRIMARY KEY (`idAsignacionClase`),
  INDEX (`idEntrenador`),
  INDEX (`idHorarioClase`),
  INDEX (`idAlumno`),
  FOREIGN KEY (`idAlumno`) REFERENCES `ALUMNO`(`idAlumno`) ON DELETE CASCADE,
  FOREIGN KEY (`idEntrenador`) REFERENCES `ENTRENADOR`(`idEntrenador`) ON DELETE SET NULL,
  FOREIGN KEY (`idHorarioClase`) REFERENCES `HORARIO_CLASE`(`idHorarioClase`) ON DELETE SET NULL
) ENGINE=InnoDB;

CREATE TABLE `ASISTENCIA_ALUMNO` (
  `idAsistenciaAlumno` INT AUTO_INCREMENT,
  `idAsignacionClase` int DEFAULT NULL,
  `fecha` date NOT NULL,
  `horaEntrada` time DEFAULT NULL,
  `horaSalida` time DEFAULT NULL,
  `estatus` enum('presente','ausente','tarde','justificado') NOT NULL DEFAULT 'presente',
  `observacion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idAsistenciaAlumno`),
  INDEX (`idAsignacionClase`),
  INDEX (`fecha`),
  FOREIGN KEY (`idAsignacionClase`) REFERENCES `ASIGNACION_CLASE`(`idAsignacionClase`) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `ASISTENCIA_ENTRENADOR` (
  `idAsistenciaEntrenador` INT AUTO_INCREMENT,
  `idEntrenador` int DEFAULT NULL,
  `fecha` date NOT NULL,
  `horaEntrada` time DEFAULT NULL,
  `horaSalida` time DEFAULT NULL,
  `alumnosEntrenados` int DEFAULT NULL,
  `observacion` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idAsistenciaEntrenador`),
  INDEX (`idEntrenador`),
  INDEX (`fecha`),
  FOREIGN KEY (`idEntrenador`) REFERENCES `ENTRENADOR`(`idEntrenador`) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `CLASIFICACION_FINAL` (
  `idClasificacionFinal` INT AUTO_INCREMENT,
  `idTorneo` int DEFAULT NULL,
  `idAlumno` int DEFAULT NULL,
  `posicion` int NOT NULL,
  `municipio` varchar(30) DEFAULT NULL,
  `estatusOriginal` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idClasificacionFinal`),
  INDEX (`idAlumno`),
  INDEX (`idTorneo`),
  FOREIGN KEY (`idTorneo`) REFERENCES `TORNEO`(`idTorneo`) ON DELETE CASCADE,
  FOREIGN KEY (`idAlumno`) REFERENCES `ALUMNO`(`idAlumno`) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `INSCRIPCION_ALUMNO` (
  `idInscripcionAlumno` INT AUTO_INCREMENT,
  `idAlumno` int DEFAULT NULL,
  `fecha` date NOT NULL,
  `estatus` enum('activo','inactivo','suspendido') NOT NULL DEFAULT 'activo',
  PRIMARY KEY (`idInscripcionAlumno`),
  INDEX (`idAlumno`),
  FOREIGN KEY (`idAlumno`) REFERENCES `ALUMNO`(`idAlumno`) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `INSCRIPCION_TORNEO` (
  `idInscripcionTorneo` INT AUTO_INCREMENT,
  `idAlumno` int DEFAULT NULL,
  `idTorneo` int DEFAULT NULL,
  `fecha` date NOT NULL,
  `estatus` enum('pendiente','confirmado','rechazado','cancelado') NOT NULL DEFAULT 'pendiente',
  `pago` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`idInscripcionTorneo`),
  INDEX (`idAlumno`),
  INDEX (`idTorneo`),
  FOREIGN KEY (`idAlumno`) REFERENCES `ALUMNO`(`idAlumno`) ON DELETE CASCADE,
  FOREIGN KEY (`idTorneo`) REFERENCES `TORNEO`(`idTorneo`) ON DELETE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `PUNTUACION_TEST` (
  `idPuntuacion` INT AUTO_INCREMENT,
  `idAsignacionClase` int DEFAULT NULL,
  `fecha` date NOT NULL,
  `numeroRonda` tinyint NOT NULL,
  `puntuacionRonda` decimal(5,2) NOT NULL,
  `puntuacionFinal` decimal(6,2) DEFAULT NULL,
  PRIMARY KEY (`idPuntuacion`),
  INDEX (`idAsignacionClase`),
  FOREIGN KEY (`idAsignacionClase`) REFERENCES `ASIGNACION_CLASE`(`idAsignacionClase`) ON DELETE CASCADE
) ENGINE=InnoDB;