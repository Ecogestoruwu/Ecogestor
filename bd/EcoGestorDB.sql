-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-06-2025 a las 20:17:49
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
  `idCuenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `colaborador_has_residuo`
--

CREATE TABLE `colaborador_has_residuo` (
  `Colaborador_idColaborador` int(11) NOT NULL,
  `Residuo_idResiduo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `idCuenta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
  MODIFY `idColaborador` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cuenta`
--
ALTER TABLE `cuenta`
  MODIFY `idCuenta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  MODIFY `idPublicacion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `punto_recoleccion`
--
ALTER TABLE `punto_recoleccion`
  MODIFY `idPunto_Recoleccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `residuo`
--
ALTER TABLE `residuo`
  MODIFY `idResiduo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `solicitud_recoleccion`
--
ALTER TABLE `solicitud_recoleccion`
  MODIFY `idSolicitud_Recoleccion` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT;

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
