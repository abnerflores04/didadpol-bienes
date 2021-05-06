-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-05-2021 a las 00:00:30
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `didadpol_bienes`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_bitacora`
--

CREATE TABLE `tbl_bitacora` (
  `bit_id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL,
  `obj_id` int(11) NOT NULL,
  `bit_descripcion` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `bit_fecha` date NOT NULL,
  `bit_hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_objeto`
--

CREATE TABLE `tbl_objeto` (
  `obj_id` int(11) NOT NULL,
  `obj_nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `obj_descripcion` varchar(150) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_parametro`
--

CREATE TABLE `tbl_parametro` (
  `par_id` int(11) NOT NULL,
  `usu_id` int(11) NOT NULL,
  `par_nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `part_descripcion` int(150) NOT NULL,
  `par_valor` varchar(150) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_permiso`
--

CREATE TABLE `tbl_permiso` (
  `perm_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `obj_id` int(11) NOT NULL,
  `perm_consultar` tinyint(1) NOT NULL,
  `perm_insertar` tinyint(1) NOT NULL,
  `perm_actualizar` tinyint(1) NOT NULL,
  `perm_eliminar` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_rol`
--

CREATE TABLE `tbl_rol` (
  `rol_id` int(11) NOT NULL,
  `rol_nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `rol_descripcion` varchar(150) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_rol`
--

INSERT INTO `tbl_rol` (`rol_id`, `rol_nombre`, `rol_descripcion`) VALUES
(1, 'ADMINISTRADOR', 'ADMINISTRADOR DEL SISTEMA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE `tbl_usuario` (
  `usu_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `usu_usuario` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `usu_nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `usu_apellido` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `usu_password` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `usu_estado` enum('ACTIVO','INACTIVO','BLOQUEADO','VACACIONES','NUEVO') COLLATE utf8_spanish2_ci NOT NULL,
  `usu_correo_i` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `usu_correo_p` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `usu_celular` varchar(9) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`usu_id`, `rol_id`, `usu_usuario`, `usu_nombre`, `usu_apellido`, `usu_password`, `usu_estado`, `usu_correo_i`, `usu_correo_p`, `usu_celular`) VALUES
(1, 1, 'aflores', 'ABNER ANTONIO', 'FLORES CERRANO', 'Vm13WXVySmEzY1dWVkhGTllMcENOdz09', 'NUEVO', 'aflores@didadpol.gob.hn', 'aaflorescerrano@gmail.com', '3334-7223');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_bitacora`
--
ALTER TABLE `tbl_bitacora`
  ADD PRIMARY KEY (`bit_id`),
  ADD KEY `usu_id` (`usu_id`),
  ADD KEY `obj_id` (`obj_id`);

--
-- Indices de la tabla `tbl_objeto`
--
ALTER TABLE `tbl_objeto`
  ADD PRIMARY KEY (`obj_id`);

--
-- Indices de la tabla `tbl_parametro`
--
ALTER TABLE `tbl_parametro`
  ADD PRIMARY KEY (`par_id`),
  ADD KEY `usu_id` (`usu_id`);

--
-- Indices de la tabla `tbl_permiso`
--
ALTER TABLE `tbl_permiso`
  ADD PRIMARY KEY (`perm_id`),
  ADD KEY `rol_id` (`rol_id`),
  ADD KEY `obj_id` (`obj_id`);

--
-- Indices de la tabla `tbl_rol`
--
ALTER TABLE `tbl_rol`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`usu_id`),
  ADD KEY `rol_id` (`rol_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_bitacora`
--
ALTER TABLE `tbl_bitacora`
  MODIFY `bit_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_objeto`
--
ALTER TABLE `tbl_objeto`
  MODIFY `obj_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_parametro`
--
ALTER TABLE `tbl_parametro`
  MODIFY `par_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_permiso`
--
ALTER TABLE `tbl_permiso`
  MODIFY `perm_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_rol`
--
ALTER TABLE `tbl_rol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_bitacora`
--
ALTER TABLE `tbl_bitacora`
  ADD CONSTRAINT `tbl_bitacora_ibfk_1` FOREIGN KEY (`usu_id`) REFERENCES `tbl_usuario` (`usu_id`),
  ADD CONSTRAINT `tbl_bitacora_ibfk_2` FOREIGN KEY (`obj_id`) REFERENCES `tbl_objeto` (`obj_id`);

--
-- Filtros para la tabla `tbl_parametro`
--
ALTER TABLE `tbl_parametro`
  ADD CONSTRAINT `tbl_parametro_ibfk_1` FOREIGN KEY (`usu_id`) REFERENCES `tbl_usuario` (`usu_id`);

--
-- Filtros para la tabla `tbl_permiso`
--
ALTER TABLE `tbl_permiso`
  ADD CONSTRAINT `tbl_permiso_ibfk_1` FOREIGN KEY (`obj_id`) REFERENCES `tbl_objeto` (`obj_id`),
  ADD CONSTRAINT `tbl_permiso_ibfk_2` FOREIGN KEY (`rol_id`) REFERENCES `tbl_rol` (`rol_id`);

--
-- Filtros para la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD CONSTRAINT `tbl_usuario_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `tbl_rol` (`rol_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
