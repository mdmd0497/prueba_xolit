-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3307
-- Tiempo de generación: 08-12-2021 a las 23:50:49
-- Versión del servidor: 10.4.19-MariaDB
-- Versión de PHP: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `empresa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `idAdministrador` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `clave` varchar(45) NOT NULL,
  `foto` varchar(45) DEFAULT NULL,
  `telefono` varchar(45) DEFAULT NULL,
  `celular` varchar(45) DEFAULT NULL,
  `estado` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`idAdministrador`, `nombre`, `apellido`, `correo`, `clave`, `foto`, `telefono`, `celular`, `estado`) VALUES
(1, 'Admin', 'Admin', 'admin@a.co', '202cb962ac59075b964b07152d234b70', 'image/1639003482.png', '123', '123', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `areas`
--

CREATE TABLE `areas` (
  `idAreas` int(11) NOT NULL,
  `n_area` varchar(200) NOT NULL,
  `empleado_idEmpleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `areas`
--

INSERT INTO `areas` (`idAreas`, `n_area`, `empleado_idEmpleado`) VALUES
(1, 'Soporte', 1),
(2, 'Desarrollo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargo`
--

CREATE TABLE `cargo` (
  `idCargo` int(11) NOT NULL,
  `n_cargo` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cargo`
--

INSERT INTO `cargo` (`idCargo`, `n_cargo`) VALUES
(1, 'ingeniero'),
(2, 'Recursos Humanos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `idEmpleado` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `apellido` varchar(45) NOT NULL,
  `correo` varchar(45) NOT NULL,
  `clave` varchar(45) NOT NULL,
  `foto` varchar(45) DEFAULT NULL,
  `state` tinyint(4) NOT NULL,
  `cargo_idCargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`idEmpleado`, `nombre`, `apellido`, `correo`, `clave`, `foto`, `state`, `cargo_idCargo`) VALUES
(1, 'Michael', 'Moreno', '1@e.com', 'c4ca4238a0b923820dcc509a6f75849b', '', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logadministrador`
--

CREATE TABLE `logadministrador` (
  `idLogAdministrador` int(11) NOT NULL,
  `accion` varchar(45) NOT NULL,
  `informacion` text NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `ip` varchar(45) NOT NULL,
  `so` varchar(45) NOT NULL,
  `explorador` varchar(45) NOT NULL,
  `administrador_idAdministrador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `logadministrador`
--

INSERT INTO `logadministrador` (`idLogAdministrador`, `accion`, `informacion`, `fecha`, `hora`, `ip`, `so`, `explorador`, `administrador_idAdministrador`) VALUES
(1, 'Log In', '', '2021-12-08', '17:34:02', '127.0.0.1', 'WINNT', 'Firefox', 1),
(2, 'Crear Cargo', 'N_cargo: ingeniero', '2021-12-08', '17:34:09', '127.0.0.1', 'WINNT', 'Firefox', 1),
(3, 'Editar Cargo', 'N_cargo: ingeniero', '2021-12-08', '17:34:16', '127.0.0.1', 'WINNT', 'Firefox', 1),
(4, 'Crear Empleado', 'Nombre: Michael; Apellido: Moreno; Correo: 1@e.com; Clave: 1; State: 1; Cargo: ingeniero', '2021-12-08', '17:34:38', '127.0.0.1', 'WINNT', 'Firefox', 1),
(5, 'Crear Areas', 'N_area: Soporte; Empleado: Michael Moreno', '2021-12-08', '17:35:07', '127.0.0.1', 'WINNT', 'Firefox', 1),
(6, 'Log In', '', '2021-12-08', '17:42:50', '127.0.0.1', 'WINNT', 'Firefox', 1),
(7, 'Crear Cargo', 'N_cargo: Recursos Humanos', '2021-12-08', '17:43:02', '127.0.0.1', 'WINNT', 'Firefox', 1),
(8, 'Editar foto in Administrador', 'Foto: image/1639003482.png', '2021-12-08', '17:44:42', '127.0.0.1', 'WINNT', 'Firefox', 1),
(9, 'Crear Areas', 'N_area: Desarrollo; Empleado: Michael Moreno', '2021-12-08', '17:45:17', '127.0.0.1', 'WINNT', 'Firefox', 1),
(10, 'Log In', '', '2021-12-08', '17:48:25', '127.0.0.1', 'WINNT', 'Firefox', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logempleado`
--

CREATE TABLE `logempleado` (
  `idLogEmpleado` int(11) NOT NULL,
  `accion` varchar(45) NOT NULL,
  `informacion` text NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `ip` varchar(45) NOT NULL,
  `so` varchar(45) NOT NULL,
  `explorador` varchar(45) NOT NULL,
  `empleado_idEmpleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`idAdministrador`);

--
-- Indices de la tabla `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`idAreas`),
  ADD KEY `empleado_idEmpleado` (`empleado_idEmpleado`);

--
-- Indices de la tabla `cargo`
--
ALTER TABLE `cargo`
  ADD PRIMARY KEY (`idCargo`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`idEmpleado`),
  ADD KEY `cargo_idCargo` (`cargo_idCargo`);

--
-- Indices de la tabla `logadministrador`
--
ALTER TABLE `logadministrador`
  ADD PRIMARY KEY (`idLogAdministrador`),
  ADD KEY `administrador_idAdministrador` (`administrador_idAdministrador`);

--
-- Indices de la tabla `logempleado`
--
ALTER TABLE `logempleado`
  ADD PRIMARY KEY (`idLogEmpleado`),
  ADD KEY `empleado_idEmpleado` (`empleado_idEmpleado`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `idAdministrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `areas`
--
ALTER TABLE `areas`
  MODIFY `idAreas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `cargo`
--
ALTER TABLE `cargo`
  MODIFY `idCargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `empleado`
--
ALTER TABLE `empleado`
  MODIFY `idEmpleado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `logadministrador`
--
ALTER TABLE `logadministrador`
  MODIFY `idLogAdministrador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `logempleado`
--
ALTER TABLE `logempleado`
  MODIFY `idLogEmpleado` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `areas`
--
ALTER TABLE `areas`
  ADD CONSTRAINT `areas_ibfk_1` FOREIGN KEY (`empleado_idEmpleado`) REFERENCES `empleado` (`idEmpleado`);

--
-- Filtros para la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD CONSTRAINT `empleado_ibfk_1` FOREIGN KEY (`cargo_idCargo`) REFERENCES `cargo` (`idCargo`);

--
-- Filtros para la tabla `logadministrador`
--
ALTER TABLE `logadministrador`
  ADD CONSTRAINT `logadministrador_ibfk_1` FOREIGN KEY (`administrador_idAdministrador`) REFERENCES `administrador` (`idAdministrador`);

--
-- Filtros para la tabla `logempleado`
--
ALTER TABLE `logempleado`
  ADD CONSTRAINT `logempleado_ibfk_1` FOREIGN KEY (`empleado_idEmpleado`) REFERENCES `empleado` (`idEmpleado`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
