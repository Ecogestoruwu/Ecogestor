-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3307
-- Tiempo de generación: 03-07-2025 a las 09:55:09
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `ecogestordb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaborador`
--

CREATE TABLE `colaborador` (
  `idColaborador` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `servicio_ofrecido` varchar(100) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `direccion` varchar(200) DEFAULT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL,
  `idCuenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `colaborador`
--

INSERT INTO `colaborador` (`idColaborador`, `nombre`, `servicio_ofrecido`, `telefono`, `direccion`, `foto_perfil`, `idCuenta`) VALUES
(1, 'Donghee ', 'recoleccion', NULL, NULL, NULL, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaborador_has_residuo`
--

CREATE TABLE `colaborador_has_residuo` (
  `Colaborador_idColaborador` int(11) NOT NULL,
  `Residuo_idResiduo` int(11) NOT NULL,
  `observaciones` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `idComentario` int(11) NOT NULL,
  `contenido` text NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `idUsuario` int(11) DEFAULT NULL,
  `idComentarioPadre` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `comentario`
--

INSERT INTO `comentario` (`idComentario`, `contenido`, `fecha`, `idUsuario`, `idComentarioPadre`) VALUES
(1, '¿Qué haces normalmente con tus aparatos electrónicos cuando dejan de funcionar?', '2025-07-03 00:45:13', 1, NULL),
(2, '¿Sabías que los residuos electrónicos contienen materiales tóxicos que pueden dañar el medio ambiente si no se reciclan adecuadamente?', '2025-07-03 00:45:13', 1, NULL),
(3, '¿Estarías dispuesto(a) a llevar tus aparatos electrónicos viejos a un punto de recolección cercano para su reciclaje?', '2025-07-03 00:45:13', 1, NULL),
(4, 'Normalmente los guardo en casa porque no sé dónde llevarlos para reciclarlos correctamente.', '2025-07-03 01:18:58', 1, 1),
(5, 'No se', '2025-07-03 09:25:04', 1, 1),
(6, 'uyyy', '2025-07-03 09:30:27', 1, 5),
(7, 'Normalmente los guardo en casa', '2025-07-03 09:30:59', 1, 1),
(9, '¿Qué haces normalmente con tus aparatos electrónicos?', '2025-07-03 09:46:36', 1, NULL),
(10, 'Ay bueno', '2025-07-03 09:47:12', 1, 7),
(11, 'NO se x2', '2025-07-03 09:47:35', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuenta`
--

CREATE TABLE `cuenta` (
  `idCuenta` int(11) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `clave` varchar(45) NOT NULL,
  `rol` int(11) NOT NULL,
  `estado` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `cuenta`
--

INSERT INTO `cuenta` (`idCuenta`, `correo`, `clave`, `rol`, `estado`) VALUES
(1, 'jodonghee123@gmail.com', 'SnNudnJuczk5', 1, 1),
(2, 'djo@udistrital.edu.co', 'ZGpvMTIzNA==', 2, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacion`
--

CREATE TABLE `publicacion` (
  `idPublicacion` int(11) NOT NULL,
  `titulo` mediumtext NOT NULL,
  `descripcion` longtext DEFAULT NULL,
  `tipo` varchar(200) NOT NULL,
  `fecha_publicacion` date NOT NULL,
  `enlace` longtext DEFAULT NULL,
  `Colaborador_idColaborador` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `publicacion`
--

INSERT INTO `publicacion` (`idPublicacion`, `titulo`, `descripcion`, `tipo`, `fecha_publicacion`, `enlace`, `Colaborador_idColaborador`) VALUES
(2, 'Legislación Ambiental', 'La página ofrece un panorama claro, ordenado y actualizado de la legislación ambiental colombiana, desde normas marco —que establecen instituciones y principios— hasta regulaciones específicas de sectores (agua, residuos, fauna, licencias), incluyendo instrumentos internacionales ratificados por el país. Se trata de una base útil para cualquier investigación, aplicación práctica o consulta en derecho ambiental en Colombia.', 'recurso informativo', '2025-03-12', 'https://justiciaambientalcolombia.org/herramientas-juridicas/legislacion-ambiental/', 1),
(3, 'Colombia avanza en materia de educación ambiental: Una Política Renovada y Transformadora', 'el Gobierno acelera una reforma profunda para modernizar la educación ambiental, integrando diversidad cultural y compromisos internacionales, con miras a fomentar una sociedad ambientalmente consciente y resiliente.', 'Noticia', '2025-01-26', 'https://www.minambiente.gov.co/colombia-avanza-en-materia-de-educacion-ambiental-una-politica-renovada-y-transformadora/', 1),
(7, '¿Qué beneficios nos trae el reciclaje? 5 datos que necesitas saber', 'El artículo articula cómo el reciclaje —junto al compostaje y otras estrategias de economía circular— no solo reduce la extracción de recursos y las emisiones de carbono, sino que también protege ecosistemas, combate la pobreza mediante generación de empleo y fortalece sistemas de gestión de residuos. Además, enfatiza la responsabilidad ciudadana en este cambio cultural y ambiental.', 'recurso informativo', '2025-01-11', 'https://www.nationalgeographicla.com/medio-ambiente/2023/05/que-beneficios-nos-trae-el-reciclaje-5-datos-que-necesitas-saber', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `punto_recoleccion`
--

CREATE TABLE `punto_recoleccion` (
  `idPunto_Recoleccion` int(11) NOT NULL,
  `nombre` longtext NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `latitud` decimal(10,8) NOT NULL,
  `longitud` decimal(11,8) NOT NULL,
  `estado` varchar(45) NOT NULL,
  `Colaborador_idColaborador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `punto_recoleccion`
--

INSERT INTO `punto_recoleccion` (`idPunto_Recoleccion`, `nombre`, `direccion`, `latitud`, `longitud`, `estado`, `Colaborador_idColaborador`) VALUES
(1, 'punto_suba_papel', 'calle 121 # 51-19', 4.70317054, -74.05985374, 'a', 1),
(2, 'punto_suba_plastico', 'calle 120 # 51-19', 4.70274077, -74.05990573, 'B', 1),
(3, 'Punto Reciclaje Norte', 'Calle 123 #45-67, Bogotá', 4.70112877, -74.03641792, 'Activo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `punto_residuo`
--

CREATE TABLE `punto_residuo` (
  `Residuo_idResiduo` int(11) NOT NULL,
  `Punto_Recoleccion_idPunto_Recoleccion` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `residuo`
--

CREATE TABLE `residuo` (
  `idResiduo` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` longtext DEFAULT NULL,
  `categoria` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `residuo`
--

INSERT INTO `residuo` (`idResiduo`, `nombre`, `descripcion`, `categoria`) VALUES
(1, 'Botella de plástico', 'Botellas PET reciclables comúnmente usadas para agua y refrescos.', 'plastico'),
(2, 'Papel de oficina', 'Hojas blancas usadas en impresión y escritura.', 'papel'),
(3, 'Lata de aluminio', 'Latas de bebidas como cerveza o refrescos.', 'metal'),
(4, 'Pilhas usadas', 'Baterías pequeñas usadas en controles y relojes. No deben ir a la basura común.', 'peligroso');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `solicitud_recoleccion`
--

CREATE TABLE `solicitud_recoleccion` (
  `idSolicitud_Recoleccion` int(11) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `fecha_solicitud` date NOT NULL,
  `fecha_programada` datetime DEFAULT NULL,
  `estado` varchar(45) NOT NULL,
  `Usuario_idUsuario` int(11) NOT NULL,
  `Residuo_idResiduo` int(11) NOT NULL,
  `Colaborador_idColaborador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `solicitud_recoleccion`
--

INSERT INTO `solicitud_recoleccion` (`idSolicitud_Recoleccion`, `direccion`, `fecha_solicitud`, `fecha_programada`, `estado`, `Usuario_idUsuario`, `Residuo_idResiduo`, `Colaborador_idColaborador`) VALUES
(1, 'Calle 123, Ciudad A', '2025-06-27', '2026-02-22 11:01:00', 'programada', 1, 1, 1),
(2, 'Av. Siempre Viva 742', '2025-06-27', NULL, 'Pendiente', 1, 2, 1),
(3, 'Plaza Central, Zona B', '2025-06-27', '2025-06-30 01:01:00', 'programada', 1, 3, 1),
(4, 'Callejón Verde #55', '2025-06-27', NULL, 'Pendiente', 1, 4, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `nickname` varchar(45) DEFAULT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL,
  `idCuenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`idUsuario`, `nombre`, `apellido`, `telefono`, `nickname`, `foto_perfil`, `idCuenta`) VALUES
(1, 'Json', 'Jo', NULL, NULL, NULL, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `colaborador`
--
ALTER TABLE `colaborador`
  ADD PRIMARY KEY (`idColaborador`),
  ADD KEY `fk_Colaborador_Cuenta1_idx` (`idCuenta`);

--
-- Indices de la tabla `colaborador_has_residuo`
--
ALTER TABLE `colaborador_has_residuo`
  ADD PRIMARY KEY (`Colaborador_idColaborador`,`Residuo_idResiduo`),
  ADD KEY `Residuo_idResiduo` (`Residuo_idResiduo`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`idComentario`),
  ADD KEY `fk_usuario_comentario` (`idUsuario`),
  ADD KEY `fk_comentario_padre` (`idComentarioPadre`);

--
-- Indices de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  ADD PRIMARY KEY (`idCuenta`),
  ADD UNIQUE KEY `correo_UNIQUE` (`correo`);

--
-- Indices de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  ADD PRIMARY KEY (`idPublicacion`),
  ADD KEY `fk_Publicacion_Colaborador1_idx` (`Colaborador_idColaborador`);

--
-- Indices de la tabla `punto_recoleccion`
--
ALTER TABLE `punto_recoleccion`
  ADD PRIMARY KEY (`idPunto_Recoleccion`),
  ADD KEY `fk_Punto_Recoleccion_Colaborador1_idx` (`Colaborador_idColaborador`);

--
-- Indices de la tabla `punto_residuo`
--
ALTER TABLE `punto_residuo`
  ADD PRIMARY KEY (`Residuo_idResiduo`,`Punto_Recoleccion_idPunto_Recoleccion`),
  ADD KEY `fk_Punto` (`Punto_Recoleccion_idPunto_Recoleccion`),
  ADD KEY `fk_Residuo` (`Residuo_idResiduo`);

--
-- Indices de la tabla `residuo`
--
ALTER TABLE `residuo`
  ADD PRIMARY KEY (`idResiduo`);

--
-- Indices de la tabla `solicitud_recoleccion`
--
ALTER TABLE `solicitud_recoleccion`
  ADD PRIMARY KEY (`idSolicitud_Recoleccion`),
  ADD KEY `Usuario_idUsuario` (`Usuario_idUsuario`),
  ADD KEY `Residuo_idResiduo` (`Residuo_idResiduo`),
  ADD KEY `Colaborador_idColaborador` (`Colaborador_idColaborador`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `fk_Usuario_Cuenta1_idx` (`idCuenta`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `colaborador`
--
ALTER TABLE `colaborador`
  MODIFY `idColaborador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `idComentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  MODIFY `idCuenta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  MODIFY `idPublicacion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `punto_recoleccion`
--
ALTER TABLE `punto_recoleccion`
  MODIFY `idPunto_Recoleccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `residuo`
--
ALTER TABLE `residuo`
  MODIFY `idResiduo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `solicitud_recoleccion`
--
ALTER TABLE `solicitud_recoleccion`
  MODIFY `idSolicitud_Recoleccion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `colaborador`
--
ALTER TABLE `colaborador`
  ADD CONSTRAINT `colaborador_ibfk_1` FOREIGN KEY (`idCuenta`) REFERENCES `cuenta` (`idCuenta`);

--
-- Filtros para la tabla `colaborador_has_residuo`
--
ALTER TABLE `colaborador_has_residuo`
  ADD CONSTRAINT `colaborador_has_residuo_ibfk_1` FOREIGN KEY (`Colaborador_idColaborador`) REFERENCES `colaborador` (`idColaborador`),
  ADD CONSTRAINT `colaborador_has_residuo_ibfk_2` FOREIGN KEY (`Residuo_idResiduo`) REFERENCES `residuo` (`idResiduo`);

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `fk_comentario_padre` FOREIGN KEY (`idComentarioPadre`) REFERENCES `comentario` (`idComentario`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_usuario_comentario` FOREIGN KEY (`idUsuario`) REFERENCES `usuario` (`idUsuario`) ON DELETE SET NULL;

--
-- Filtros para la tabla `publicacion`
--
ALTER TABLE `publicacion`
  ADD CONSTRAINT `publicacion_ibfk_1` FOREIGN KEY (`Colaborador_idColaborador`) REFERENCES `colaborador` (`idColaborador`);

--
-- Filtros para la tabla `punto_recoleccion`
--
ALTER TABLE `punto_recoleccion`
  ADD CONSTRAINT `punto_recoleccion_ibfk_1` FOREIGN KEY (`Colaborador_idColaborador`) REFERENCES `colaborador` (`idColaborador`);

--
-- Filtros para la tabla `punto_residuo`
--
ALTER TABLE `punto_residuo`
  ADD CONSTRAINT `punto_residuo_ibfk_1` FOREIGN KEY (`Residuo_idResiduo`) REFERENCES `residuo` (`idResiduo`),
  ADD CONSTRAINT `punto_residuo_ibfk_2` FOREIGN KEY (`Punto_Recoleccion_idPunto_Recoleccion`) REFERENCES `punto_recoleccion` (`idPunto_Recoleccion`);

--
-- Filtros para la tabla `solicitud_recoleccion`
--
ALTER TABLE `solicitud_recoleccion`
  ADD CONSTRAINT `solicitud_recoleccion_ibfk_1` FOREIGN KEY (`Usuario_idUsuario`) REFERENCES `usuario` (`idUsuario`),
  ADD CONSTRAINT `solicitud_recoleccion_ibfk_2` FOREIGN KEY (`Residuo_idResiduo`) REFERENCES `residuo` (`idResiduo`),
  ADD CONSTRAINT `solicitud_recoleccion_ibfk_3` FOREIGN KEY (`Colaborador_idColaborador`) REFERENCES `colaborador` (`idColaborador`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`idCuenta`) REFERENCES `cuenta` (`idCuenta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
