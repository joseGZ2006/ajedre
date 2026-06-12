-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 12-06-2026 a las 20:44:39
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
  `telefono` varchar(12) DEFAULT NULL,
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
(4, '23424239', 'Jose', 'Zarragas', 'M', '2006-02-02', 20, 'Sub-20', '0412-1234567', 'Independencia', 'zarragasjose93@gmail.com', 'Casa del Ajedrez', 'Av. Principal', 'Escuela Nacional', '5to grado', 'A', 'futbol', 'deportiva', NULL, NULL, 'activo', '2026-06-12 11:28:27'),
(5, '12123131', 'Jose', 'Zarragas', 'M', '2012-02-21', 14, 'Sub-14', '0412-2343432', 'San Felipe', 'zarragasjose93@gmail.com', 'Casa del Ajedrez 32', 'Av. Principal', NULL, NULL, NULL, NULL, NULL, 1, NULL, 'activo', '2026-06-12 15:10:24'),
(6, '23424232', 'Josewee', 'Zarragas joss', 'M', '2012-02-02', 14, 'Sub-14', '0412-1234564', 'San Felipe', 'zarragasjose93@gmail.com', 'Casa del Ajedrez 32', 'Av. Principal', NULL, NULL, NULL, NULL, NULL, 10, NULL, 'activo', '2026-06-12 16:43:01');

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
  `telefono` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `ENTRENADOR`
--

INSERT INTO `ENTRENADOR` (`idEntrenador`, `idUsuario`, `idEspecialidad`, `cedula`, `nombre`, `apellido`, `telefono`) VALUES
(18, NULL, 5, '12345672', 'Yon', 'Ayan', '0412-1234543');

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
(5, 'Ajedrez Rápido'),
(1, 'Aperturas');

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
  `correo` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `telefono` varchar(12) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `parentesco` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Volcado de datos para la tabla `REPRESENTANTE`
--

INSERT INTO `REPRESENTANTE` (`idRepresentante`, `cedula`, `nombre`, `apellido`, `correo`, `telefono`, `parentesco`) VALUES
(1, '32342312', 'Sofia', 'Ayan', 'sdfsfdsf@gmail.com', '04121343432', 'padre'),
(4, '32123321', 'Jose', 'Zarragas', 'zarra2gasjose93@gmail.com', '0412-1234563', 'Tío'),
(6, '22342312', 'Sofia', 'Ayan', 'sdfsfdasf@gmail.com', '04122343432', 'Abuela'),
(7, '12323232', 'Jose', 'Zarragas', 'zarragasjose93@gmail.com', '0412-3333332', 'Padre'),
(8, '12123232', 'Jose', 'Zarragas', 'zarragasjose93@gmail.com', '93453453453', 'Madre'),
(9, '21123321', 'Josed', 'Zarragasw', 'zarragasjwwwose93@gmail.com', '03122123221', 'Tutor'),
(10, '32012302', 'Jose ali', 'Zarragas yaws', 'gasjose93@gmail.com', '04123212231', 'Padre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `TIPO_TORNEO`
--

CREATE TABLE `TIPO_TORNEO` (
  `idTipoTorneo` int NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `tipo` enum('individual','equipo','mixto') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
(8, 'ADMIN', '$2y$10$N9oq.8IFNEZ6/cuk3vXjMe9wQYtXRtFr.idk0kPmx75g3JOuLutk2', 'admin', 'activo'),
(9, 'Lagea', '$2y$10$KUdEUwwC78/01SbXM5BFYuBmh9uLOGYZnQoclJ4.vm3fBPZpZkria', 'alumno', 'activo'),
(12, 'antuan', '$2y$10$yLlqXxutq8qWAnxtpUaTS.DTjefPFHVfqplxFwsNxylG0wlDI1Ipa', 'admin', 'inactivo');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ALUMNO`
--
ALTER TABLE `ALUMNO`
  ADD PRIMARY KEY (`idAlumno`),
  ADD UNIQUE KEY `cedula` (`cedula`),
  ADD KEY `idRepresentante` (`idRepresentante`),
  ADD KEY `idUsuario` (`idUsuario`);

--
-- Indices de la tabla `ASIGNACION_CLASE`
--
ALTER TABLE `ASIGNACION_CLASE`
  ADD PRIMARY KEY (`idAsignacionClase`),
  ADD KEY `idEntrenador` (`idEntrenador`),
  ADD KEY `idHorarioClase` (`idHorarioClase`),
  ADD KEY `idAlumno` (`idAlumno`);

--
-- Indices de la tabla `ASISTENCIA_ALUMNO`
--
ALTER TABLE `ASISTENCIA_ALUMNO`
  ADD PRIMARY KEY (`idAsistenciaAlumno`),
  ADD KEY `idAsignacionClase` (`idAsignacionClase`),
  ADD KEY `fecha` (`fecha`);

--
-- Indices de la tabla `ASISTENCIA_ENTRENADOR`
--
ALTER TABLE `ASISTENCIA_ENTRENADOR`
  ADD PRIMARY KEY (`idAsistenciaEntrenador`),
  ADD KEY `idEntrenador` (`idEntrenador`),
  ADD KEY `fecha` (`fecha`);

--
-- Indices de la tabla `CLASIFICACION_FINAL`
--
ALTER TABLE `CLASIFICACION_FINAL`
  ADD PRIMARY KEY (`idClasificacionFinal`),
  ADD KEY `idAlumno` (`idAlumno`),
  ADD KEY `idTorneo` (`idTorneo`);

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
  ADD KEY `idAlumno` (`idAlumno`),
  ADD KEY `idTorneo` (`idTorneo`);

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
  ADD KEY `fecha` (`fecha`);

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
  MODIFY `idAlumno` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  MODIFY `idEntrenador` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `ESPECIALIDAD`
--
ALTER TABLE `ESPECIALIDAD`
  MODIFY `idEspecialidad` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
  MODIFY `idRepresentante` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `TIPO_TORNEO`
--
ALTER TABLE `TIPO_TORNEO`
  MODIFY `idTipoTorneo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `TORNEO`
--
ALTER TABLE `TORNEO`
  MODIFY `idTorneo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `USUARIO`
--
ALTER TABLE `USUARIO`
  MODIFY `idUsuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

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
