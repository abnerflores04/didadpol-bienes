-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 21-05-2021 a las 06:36:27
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
-- Base de datos: `didadpol`
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
(1, 'ADMINISTRADOR', 'ADMINISTRADOR DEL SISTEMA DE BIENES-DIDAPOL'),
(2, 'MOTORISTA', 'CONDUCTOR DESIGNADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_salida`
--

CREATE TABLE `tbl_salida` (
  `salida_id` int(11) NOT NULL,
  `motorista_id` int(11) NOT NULL,
  `tipo_salida_id` int(11) NOT NULL,
  `salida_fecha` date NOT NULL,
  `salida_observacion` varchar(255) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_salida`
--

INSERT INTO `tbl_salida` (`salida_id`, `motorista_id`, `tipo_salida_id`, `salida_fecha`, `salida_observacion`) VALUES
(1, 2, 1, '2021-05-18', 'RETETETERTER'),
(2, 2, 1, '2021-05-19', 'WTWETWER'),
(3, 6, 2, '2021-05-20', 'GGGHGHGHHGHGHG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_salida`
--

CREATE TABLE `tbl_tipo_salida` (
  `tipo_salida_id` int(11) NOT NULL,
  `tipo_salida_descripcion` varchar(255) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_tipo_salida`
--

INSERT INTO `tbl_tipo_salida` (`tipo_salida_id`, `tipo_salida_descripcion`) VALUES
(1, 'GIRA'),
(2, 'DILIGENCIA');

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
(1, 1, 'aflores', 'ABNER ANTONIO', 'FLORES CERRANO', 'cVJ4S2dkS2k5dUhsM1luWnZySUVkdz09', 'ACTIVO', 'aflores@didadpol.gob.hn', 'aaflorescerrano@gmail.com', '3334-7223'),
(2, 2, 'lperez', 'LUIS MIGUEL', 'PEREZ ', 'UjcxT3dnemJ0OXBRNHRWWFovdDgzZz09', 'NUEVO', 'default@didadpol.gob.hn', 'default@gmail.com', '9999-9999'),
(3, 1, 'mbarahona', 'MELANIE MICHELL', 'BARAHONA', 'TFVoZzNtZ0J5SXNmbnpNY29PTDNkUT09', 'NUEVO', 'defaultt@didadpol.gob.hn', 'defaultt@gmail.com', '2222-2221'),
(5, 1, 'jserrano', 'JOSEPH EZEQUIEL', 'SERRANO', 'dmEyNGRuRExEbStvWU15RWVzdWZvQT09', 'NUEVO', 'defult@didadpol.gob.hn', 'default@yahoo.com', ''),
(6, 2, 'dmartinez', 'DYLAN JAIR', 'MARTINEZ', 'SWpmaWJCTUZKRUhoOXhRenQzVHJ0QT09', 'NUEVO', 'dmartinez@didadpol.gob.hn', 'martinez@gmail.com', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario_salida`
--

CREATE TABLE `tbl_usuario_salida` (
  `usu_sal_id` int(11) NOT NULL,
  `colaborador_id` int(11) NOT NULL,
  `salida_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_usuario_salida`
--

INSERT INTO `tbl_usuario_salida` (`usu_sal_id`, `colaborador_id`, `salida_id`) VALUES
(1, 1, 1),
(2, 3, 1),
(3, 5, 1),
(4, 1, 2),
(5, 3, 2),
(6, 3, 3);

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
-- Indices de la tabla `tbl_salida`
--
ALTER TABLE `tbl_salida`
  ADD PRIMARY KEY (`salida_id`),
  ADD KEY `tipo_salida_id` (`tipo_salida_id`),
  ADD KEY `motorista_id` (`motorista_id`);

--
-- Indices de la tabla `tbl_tipo_salida`
--
ALTER TABLE `tbl_tipo_salida`
  ADD PRIMARY KEY (`tipo_salida_id`);

--
-- Indices de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`usu_id`),
  ADD KEY `rol_id` (`rol_id`);

--
-- Indices de la tabla `tbl_usuario_salida`
--
ALTER TABLE `tbl_usuario_salida`
  ADD PRIMARY KEY (`usu_sal_id`),
  ADD KEY `salida_id` (`salida_id`),
  ADD KEY `colaborador_id` (`colaborador_id`);

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
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_salida`
--
ALTER TABLE `tbl_salida`
  MODIFY `salida_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_salida`
--
ALTER TABLE `tbl_tipo_salida`
  MODIFY `tipo_salida_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `tbl_usuario_salida`
--
ALTER TABLE `tbl_usuario_salida`
  MODIFY `usu_sal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
-- Filtros para la tabla `tbl_salida`
--
ALTER TABLE `tbl_salida`
  ADD CONSTRAINT `tbl_salida_ibfk_1` FOREIGN KEY (`tipo_salida_id`) REFERENCES `tbl_tipo_salida` (`tipo_salida_id`),
  ADD CONSTRAINT `tbl_salida_ibfk_2` FOREIGN KEY (`motorista_id`) REFERENCES `tbl_usuario` (`usu_id`);

--
-- Filtros para la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD CONSTRAINT `tbl_usuario_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `tbl_rol` (`rol_id`);

--
-- Filtros para la tabla `tbl_usuario_salida`
--
ALTER TABLE `tbl_usuario_salida`
  ADD CONSTRAINT `tbl_usuario_salida_ibfk_3` FOREIGN KEY (`salida_id`) REFERENCES `tbl_salida` (`salida_id`),
  ADD CONSTRAINT `tbl_usuario_salida_ibfk_4` FOREIGN KEY (`colaborador_id`) REFERENCES `tbl_usuario` (`usu_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
