-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 04-06-2026 a las 14:46:29
-- Versión del servidor: 8.0.46-0ubuntu0.24.04.2
-- Versión de PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ajedrez`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ALUMNO`
--

CREATE TABLE `ALUMNO` (
  `idAlumno` int NOT NULL,
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
  `fechaRegistro` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ALUMNO`
--

INSERT INTO `ALUMNO` (`idAlumno`, `cedula`, `nombre`, `apellido`, `sexo`, `fechaNacimiento`, `edad`, `categoria`, `telefono`, `localidadMunicipio`, `correo`, `club`, `direccion`, `dondeEstudia`, `grado`, `seccion`, `deporte`, `centroIniciacionDeportivo`, `idRepresentante`, `idUsuario`, `estatus`, `fechaRegistro`) VALUES
(1, '30123456', 'Juan', 'Perez', 'M', '2010-05-15', 16, 'Sub-14', '04121234567', 'San Felipe', 'juan.perez@email.com', 'Club Ajedrez San Felipe', 'Calle Principal #123', 'U.E. San Felipe', '8vo grado', 'A', 'Futbol', 'Centro Deportivo San Felipe', 1, 2, 'activo', '2026-06-04 02:44:53');

--
-- Disparadores `ALUMNO`
--
DELIMITER $$
CREATE TRIGGER `calcular_edad_alumno_insert` BEFORE INSERT ON `ALUMNO` FOR EACH ROW BEGIN
    SET NEW.edad = TIMESTAMPDIFF(YEAR, NEW.fechaNacimiento, CURDATE())$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `calcular_edad_alumno_update` BEFORE UPDATE ON `ALUMNO` FOR EACH ROW BEGIN
    SET NEW.edad = TIMESTAMPDIFF(YEAR, NEW.fechaNacimiento, CURDATE())$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ASIGNACION_CLASE`
--

CREATE TABLE `ASIGNACION_CLASE` (
  `idAsignacionClase` int NOT NULL,
  `idAlumno` int DEFAULT NULL,
  `idEntrenador` int DEFAULT NULL,
  `idHorarioClase` int DEFAULT NULL,
  `fechaInicio` date NOT NULL,
  `fechaFin` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ASISTENCIA_ALUMNO`
--

CREATE TABLE `ASISTENCIA_ALUMNO` (
  `idAsistenciaAlumno` int NOT NULL,
  `idAsignacionClase` int DEFAULT NULL,
  `fecha` date NOT NULL,
  `horaEntrada` time DEFAULT NULL,
  `horaSalida` time DEFAULT NULL,
  `estatus` enum('presente','ausente','tarde','justificado') NOT NULL DEFAULT 'presente',
  `observacion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ASISTENCIA_ENTRENADOR`
--

CREATE TABLE `ASISTENCIA_ENTRENADOR` (
  `idAsistenciaEntrenador` int NOT NULL,
  `idEntrenador` int DEFAULT NULL,
  `fecha` date NOT NULL,
  `horaEntrada` time DEFAULT NULL,
  `horaSalida` time DEFAULT NULL,
  `alumnosEntrenados` int DEFAULT NULL,
  `observacion` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `CLASIFICACION_FINAL`
--

CREATE TABLE `CLASIFICACION_FINAL` (
  `idClasificacionFinal` int NOT NULL,
  `idTorneo` int DEFAULT NULL,
  `idAlumno` int DEFAULT NULL,
  `posicion` int NOT NULL,
  `municipio` varchar(30) DEFAULT NULL,
  `estatusOriginal` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ENTRENADOR`
--

CREATE TABLE `ENTRENADOR` (
  `idEntrenador` int NOT NULL,
  `idUsuario` int DEFAULT NULL,
  `idEspecialidad` int DEFAULT NULL,
  `cedula` varchar(10) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `apellido` varchar(25) NOT NULL,
  `telefono` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ESPECIALIDAD`
--

CREATE TABLE `ESPECIALIDAD` (
  `idEspecialidad` int NOT NULL,
  `nombre` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ESPECIALIDAD`
--

INSERT INTO `ESPECIALIDAD` (`idEspecialidad`, `nombre`) VALUES
(3, 'Ajedrez Avanzado'),
(1, 'Ajedrez Básico'),
(2, 'Ajedrez Intermedio');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `HORARIO_CLASE`
--

CREATE TABLE `HORARIO_CLASE` (
  `idHorarioClase` int NOT NULL,
  `diaSemana` enum('Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo') NOT NULL,
  `horaInicio` time NOT NULL,
  `horaFin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `INSCRIPCION_ALUMNO`
--

CREATE TABLE `INSCRIPCION_ALUMNO` (
  `idInscripcionAlumno` int NOT NULL,
  `idAlumno` int DEFAULT NULL,
  `fecha` date NOT NULL,
  `estatus` enum('activo','inactivo','suspendido') NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `INSCRIPCION_TORNEO`
--

CREATE TABLE `INSCRIPCION_TORNEO` (
  `idInscripcionTorneo` int NOT NULL,
  `idAlumno` int DEFAULT NULL,
  `idTorneo` int DEFAULT NULL,
  `fecha` date NOT NULL,
  `estatus` enum('pendiente','confirmado','rechazado','cancelado') NOT NULL DEFAULT 'pendiente',
  `pago` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PUNTUACION_TEST`
--

CREATE TABLE `PUNTUACION_TEST` (
  `idPuntuacion` int NOT NULL,
  `idAsignacionClase` int DEFAULT NULL,
  `fecha` date NOT NULL,
  `numeroRonda` tinyint NOT NULL,
  `puntuacionRonda` decimal(5,2) NOT NULL,
  `puntuacionFinal` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `REPRESENTANTE`
--

CREATE TABLE `REPRESENTANTE` (
  `idRepresentante` int NOT NULL,
  `cedula` varchar(10) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `apellido` varchar(25) NOT NULL,
  `correo` varchar(30) NOT NULL,
  `telefono` varchar(11) DEFAULT NULL,
  `parentesco` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `REPRESENTANTE`
--

INSERT INTO `REPRESENTANTE` (`idRepresentante`, `cedula`, `nombre`, `apellido`, `correo`, `telefono`, `parentesco`) VALUES
(1, '12345678', 'Juana', 'Perez', 'juana.perez@email.com', '04121234567', 'Madre'),
(2, '87654321', 'Carlos', 'Rodriguez', 'carlos.rodriguez@email.com', '04129876543', 'Padre'),
(3, '23456789', 'Maria', 'Gonzalez', 'maria.gonzalez@email.com', '04123456789', 'Tutor');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TIPO_TORNEO`
--

CREATE TABLE `TIPO_TORNEO` (
  `idTipoTorneo` int NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `tipo` enum('individual','equipo','mixto') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `TIPO_TORNEO`
--

INSERT INTO `TIPO_TORNEO` (`idTipoTorneo`, `nombre`, `tipo`) VALUES
(1, 'Torneo Rápido', 'individual'),
(2, 'Torneo Blitz', 'individual'),
(3, 'Torneo por Equipos', 'equipo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TORNEO`
--

CREATE TABLE `TORNEO` (
  `idTorneo` int NOT NULL,
  `idTipoTorneo` int DEFAULT NULL,
  `nombre` varchar(30) NOT NULL,
  `fecha` date NOT NULL,
  `lugar` varchar(30) DEFAULT NULL,
  `categoria` varchar(25) DEFAULT NULL,
  `clasificacion` varchar(25) DEFAULT NULL,
  `estatus` enum('proximo','en_curso','finalizado','cancelado') NOT NULL DEFAULT 'proximo',
  `cupo` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIO`
--

CREATE TABLE `USUARIO` (
  `idUsuario` int NOT NULL,
  `nombreUsuario` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `rol` enum('alumno','entrenador','admin') NOT NULL,
  `estatus` enum('activo','inactivo') NOT NULL DEFAULT 'activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `USUARIO`
--

INSERT INTO `USUARIO` (`idUsuario`, `nombreUsuario`, `contrasena`, `rol`, `estatus`) VALUES
(1, 'admin', '0192023a7bbd73250516f069df18b500', 'admin', 'activo'),
(2, 'juan.alumno', '0c82ca5b1092a0c21dcfe3200688046e', 'alumno', 'activo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ALUMNO`
--
ALTER TABLE `ALUMNO`
  ADD PRIMARY KEY (`idAlumno`),
  ADD UNIQUE KEY `cedula` (`cedula`),
  ADD KEY `idx_alumno_representante` (`idRepresentante`),
  ADD KEY `idx_alumno_usuario` (`idUsuario`);

--
-- Indices de la tabla `ASIGNACION_CLASE`
--
ALTER TABLE `ASIGNACION_CLASE`
  ADD PRIMARY KEY (`idAsignacionClase`),
  ADD KEY `idEntrenador` (`idEntrenador`),
  ADD KEY `idHorarioClase` (`idHorarioClase`),
  ADD KEY `idx_asignacion_alumno` (`idAlumno`);

--
-- Indices de la tabla `ASISTENCIA_ALUMNO`
--
ALTER TABLE `ASISTENCIA_ALUMNO`
  ADD PRIMARY KEY (`idAsistenciaAlumno`),
  ADD KEY `idAsignacionClase` (`idAsignacionClase`),
  ADD KEY `idx_asistencia_alumno_fecha` (`fecha`);

--
-- Indices de la tabla `ASISTENCIA_ENTRENADOR`
--
ALTER TABLE `ASISTENCIA_ENTRENADOR`
  ADD PRIMARY KEY (`idAsistenciaEntrenador`),
  ADD KEY `idEntrenador` (`idEntrenador`),
  ADD KEY `idx_asistencia_entrenador_fecha` (`fecha`);

--
-- Indices de la tabla `CLASIFICACION_FINAL`
--
ALTER TABLE `CLASIFICACION_FINAL`
  ADD PRIMARY KEY (`idClasificacionFinal`),
  ADD KEY `idAlumno` (`idAlumno`),
  ADD KEY `idx_clasificacion_torneo` (`idTorneo`);

--
-- Indices de la tabla `ENTRENADOR`
--
ALTER TABLE `ENTRENADOR`
  ADD PRIMARY KEY (`idEntrenador`),
  ADD UNIQUE KEY `cedula` (`cedula`),
  ADD KEY `idUsuario` (`idUsuario`),
  ADD KEY `idEspecialidad` (`idEspecialidad`);

--
-- Indices de la tabla `ESPECIALIDAD`
--
ALTER TABLE `ESPECIALIDAD`
  ADD PRIMARY KEY (`idEspecialidad`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `HORARIO_CLASE`
--
ALTER TABLE `HORARIO_CLASE`
  ADD PRIMARY KEY (`idHorarioClase`);

--
-- Indices de la tabla `INSCRIPCION_ALUMNO`
--
ALTER TABLE `INSCRIPCION_ALUMNO`
  ADD PRIMARY KEY (`idInscripcionAlumno`),
  ADD KEY `idAlumno` (`idAlumno`);

--
-- Indices de la tabla `INSCRIPCION_TORNEO`
--
ALTER TABLE `INSCRIPCION_TORNEO`
  ADD PRIMARY KEY (`idInscripcionTorneo`),
  ADD KEY `idx_inscripcion_alumno` (`idAlumno`),
  ADD KEY `idx_inscripcion_torneo` (`idTorneo`);

--
-- Indices de la tabla `PUNTUACION_TEST`
--
ALTER TABLE `PUNTUACION_TEST`
  ADD PRIMARY KEY (`idPuntuacion`),
  ADD KEY `idAsignacionClase` (`idAsignacionClase`);

--
-- Indices de la tabla `REPRESENTANTE`
--
ALTER TABLE `REPRESENTANTE`
  ADD PRIMARY KEY (`idRepresentante`),
  ADD UNIQUE KEY `cedula` (`cedula`);

--
-- Indices de la tabla `TIPO_TORNEO`
--
ALTER TABLE `TIPO_TORNEO`
  ADD PRIMARY KEY (`idTipoTorneo`);

--
-- Indices de la tabla `TORNEO`
--
ALTER TABLE `TORNEO`
  ADD PRIMARY KEY (`idTorneo`),
  ADD KEY `idTipoTorneo` (`idTipoTorneo`),
  ADD KEY `idx_torneo_fecha` (`fecha`);

--
-- Indices de la tabla `USUARIO`
--
ALTER TABLE `USUARIO`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `nombreUsuario` (`nombreUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ALUMNO`
--
ALTER TABLE `ALUMNO`
  MODIFY `idAlumno` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `ASIGNACION_CLASE`
--
ALTER TABLE `ASIGNACION_CLASE`
  MODIFY `idAsignacionClase` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ASISTENCIA_ALUMNO`
--
ALTER TABLE `ASISTENCIA_ALUMNO`
  MODIFY `idAsistenciaAlumno` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ASISTENCIA_ENTRENADOR`
--
ALTER TABLE `ASISTENCIA_ENTRENADOR`
  MODIFY `idAsistenciaEntrenador` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `CLASIFICACION_FINAL`
--
ALTER TABLE `CLASIFICACION_FINAL`
  MODIFY `idClasificacionFinal` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ENTRENADOR`
--
ALTER TABLE `ENTRENADOR`
  MODIFY `idEntrenador` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `ESPECIALIDAD`
--
ALTER TABLE `ESPECIALIDAD`
  MODIFY `idEspecialidad` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `HORARIO_CLASE`
--
ALTER TABLE `HORARIO_CLASE`
  MODIFY `idHorarioClase` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `INSCRIPCION_ALUMNO`
--
ALTER TABLE `INSCRIPCION_ALUMNO`
  MODIFY `idInscripcionAlumno` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `INSCRIPCION_TORNEO`
--
ALTER TABLE `INSCRIPCION_TORNEO`
  MODIFY `idInscripcionTorneo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `PUNTUACION_TEST`
--
ALTER TABLE `PUNTUACION_TEST`
  MODIFY `idPuntuacion` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `REPRESENTANTE`
--
ALTER TABLE `REPRESENTANTE`
  MODIFY `idRepresentante` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `TIPO_TORNEO`
--
ALTER TABLE `TIPO_TORNEO`
  MODIFY `idTipoTorneo` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `TORNEO`
--
ALTER TABLE `TORNEO`
  MODIFY `idTorneo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `USUARIO`
--
ALTER TABLE `USUARIO`
  MODIFY `idUsuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `ALUMNO`
--
ALTER TABLE `ALUMNO`
  ADD CONSTRAINT `ALUMNO_ibfk_1` FOREIGN KEY (`idRepresentante`) REFERENCES `REPRESENTANTE` (`idRepresentante`) ON DELETE SET NULL,
  ADD CONSTRAINT `ALUMNO_ibfk_2` FOREIGN KEY (`idUsuario`) REFERENCES `USUARIO` (`idUsuario`) ON DELETE SET NULL;

--
-- Filtros para la tabla `ASIGNACION_CLASE`
--
ALTER TABLE `ASIGNACION_CLASE`
  ADD CONSTRAINT `ASIGNACION_CLASE_ibfk_1` FOREIGN KEY (`idAlumno`) REFERENCES `ALUMNO` (`idAlumno`) ON DELETE CASCADE,
  ADD CONSTRAINT `ASIGNACION_CLASE_ibfk_2` FOREIGN KEY (`idEntrenador`) REFERENCES `ENTRENADOR` (`idEntrenador`) ON DELETE SET NULL,
  ADD CONSTRAINT `ASIGNACION_CLASE_ibfk_3` FOREIGN KEY (`idHorarioClase`) REFERENCES `HORARIO_CLASE` (`idHorarioClase`) ON DELETE SET NULL;

--
-- Filtros para la tabla `ASISTENCIA_ALUMNO`
--
ALTER TABLE `ASISTENCIA_ALUMNO`
  ADD CONSTRAINT `ASISTENCIA_ALUMNO_ibfk_1` FOREIGN KEY (`idAsignacionClase`) REFERENCES `ASIGNACION_CLASE` (`idAsignacionClase`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ASISTENCIA_ENTRENADOR`
--
ALTER TABLE `ASISTENCIA_ENTRENADOR`
  ADD CONSTRAINT `ASISTENCIA_ENTRENADOR_ibfk_1` FOREIGN KEY (`idEntrenador`) REFERENCES `ENTRENADOR` (`idEntrenador`) ON DELETE CASCADE;

--
-- Filtros para la tabla `CLASIFICACION_FINAL`
--
ALTER TABLE `CLASIFICACION_FINAL`
  ADD CONSTRAINT `CLASIFICACION_FINAL_ibfk_1` FOREIGN KEY (`idTorneo`) REFERENCES `TORNEO` (`idTorneo`) ON DELETE CASCADE,
  ADD CONSTRAINT `CLASIFICACION_FINAL_ibfk_2` FOREIGN KEY (`idAlumno`) REFERENCES `ALUMNO` (`idAlumno`) ON DELETE CASCADE;

--
-- Filtros para la tabla `ENTRENADOR`
--
ALTER TABLE `ENTRENADOR`
  ADD CONSTRAINT `ENTRENADOR_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `USUARIO` (`idUsuario`) ON DELETE SET NULL,
  ADD CONSTRAINT `ENTRENADOR_ibfk_2` FOREIGN KEY (`idEspecialidad`) REFERENCES `ESPECIALIDAD` (`idEspecialidad`) ON DELETE SET NULL;

--
-- Filtros para la tabla `INSCRIPCION_ALUMNO`
--
ALTER TABLE `INSCRIPCION_ALUMNO`
  ADD CONSTRAINT `INSCRIPCION_ALUMNO_ibfk_1` FOREIGN KEY (`idAlumno`) REFERENCES `ALUMNO` (`idAlumno`) ON DELETE CASCADE;

--
-- Filtros para la tabla `INSCRIPCION_TORNEO`
--
ALTER TABLE `INSCRIPCION_TORNEO`
  ADD CONSTRAINT `INSCRIPCION_TORNEO_ibfk_1` FOREIGN KEY (`idAlumno`) REFERENCES `ALUMNO` (`idAlumno`) ON DELETE CASCADE,
  ADD CONSTRAINT `INSCRIPCION_TORNEO_ibfk_2` FOREIGN KEY (`idTorneo`) REFERENCES `TORNEO` (`idTorneo`) ON DELETE CASCADE;

--
-- Filtros para la tabla `PUNTUACION_TEST`
--
ALTER TABLE `PUNTUACION_TEST`
  ADD CONSTRAINT `PUNTUACION_TEST_ibfk_1` FOREIGN KEY (`idAsignacionClase`) REFERENCES `ASIGNACION_CLASE` (`idAsignacionClase`) ON DELETE CASCADE;

--
-- Filtros para la tabla `TORNEO`
--
ALTER TABLE `TORNEO`
  ADD CONSTRAINT `TORNEO_ibfk_1` FOREIGN KEY (`idTipoTorneo`) REFERENCES `TIPO_TORNEO` (`idTipoTorneo`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
