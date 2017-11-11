-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-11-2017 a las 11:36:02
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `bd_empresa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_incidencia`
--

CREATE TABLE `tbl_incidencia` (
  `idIncidencia` int(4) NOT NULL,
  `descripcionIncidencia` varchar(100) DEFAULT NULL,
  `fechaIncidencia` date DEFAULT NULL,
  `idRecurso` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_recurso`
--

CREATE TABLE `tbl_recurso` (
  `idRecurso` int(4) NOT NULL,
  `nombreRecursos` varchar(15) DEFAULT NULL,
  `tipoRecursos` enum('Sala','Material') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_reserva`
--

CREATE TABLE `tbl_reserva` (
  `idReserva` int(4) NOT NULL,
  `fechaReserva` date DEFAULT NULL,
  `fechaLiberamiento` date DEFAULT NULL,
  `Ocupada` tinyint(4) DEFAULT NULL,
  `Libre` tinyint(4) DEFAULT NULL,
  `idUsuario` int(4) DEFAULT NULL,
  `idRecurso` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE `tbl_usuario` (
  `idUsuario` int(4) NOT NULL,
  `nombreUsuario` varchar(15) DEFAULT NULL,
  `apellidoUsuario` varchar(15) DEFAULT NULL,
  `dniUsuario` varchar(9) DEFAULT NULL,
  `mailUsuario` varchar(35) DEFAULT NULL,
  `telefonoUsuario` decimal(9,0) DEFAULT NULL,
  `direccionUsuario` varchar(60) DEFAULT NULL,
  `idRecurso` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_incidencia`
--
ALTER TABLE `tbl_incidencia`
  ADD PRIMARY KEY (`idIncidencia`),
  ADD KEY `FK_incidencia_recurso` (`idRecurso`);

--
-- Indices de la tabla `tbl_recurso`
--
ALTER TABLE `tbl_recurso`
  ADD PRIMARY KEY (`idRecurso`);

--
-- Indices de la tabla `tbl_reserva`
--
ALTER TABLE `tbl_reserva`
  ADD PRIMARY KEY (`idReserva`),
  ADD KEY `FK_reserva_usuario` (`idUsuario`),
  ADD KEY `FK_reserva_recurso` (`idRecurso`);

--
-- Indices de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `FK_usuario_recurso` (`idRecurso`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_incidencia`
--
ALTER TABLE `tbl_incidencia`
  MODIFY `idIncidencia` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_recurso`
--
ALTER TABLE `tbl_recurso`
  MODIFY `idRecurso` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_reserva`
--
ALTER TABLE `tbl_reserva`
  MODIFY `idReserva` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  MODIFY `idUsuario` int(4) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_incidencia`
--
ALTER TABLE `tbl_incidencia`
  ADD CONSTRAINT `FK_incidencia_recurso` FOREIGN KEY (`idRecurso`) REFERENCES `tbl_recurso` (`idRecurso`);

--
-- Filtros para la tabla `tbl_reserva`
--
ALTER TABLE `tbl_reserva`
  ADD CONSTRAINT `FK_reserva_recurso` FOREIGN KEY (`idRecurso`) REFERENCES `tbl_recurso` (`idRecurso`),
  ADD CONSTRAINT `FK_reserva_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `tbl_usuario` (`idUsuario`);

--
-- Filtros para la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD CONSTRAINT `FK_usuario_recurso` FOREIGN KEY (`idRecurso`) REFERENCES `tbl_recurso` (`idRecurso`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
