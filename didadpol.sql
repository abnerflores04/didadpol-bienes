-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-06-2021 a las 23:34:43
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
-- Estructura de tabla para la tabla `tbl_articulo`
--

CREATE TABLE `tbl_articulo` (
  `art_id` int(11) NOT NULL,
  `tipo_falta_id` int(3) NOT NULL,
  `n_art` int(2) NOT NULL,
  `art_descrip` varchar(255) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_articulo`
--

INSERT INTO `tbl_articulo` (`art_id`, `tipo_falta_id`, `n_art`, `art_descrip`) VALUES
(1, 108, 1, 'Reincidencia de una Falta Leve sea la misma o distinta entre sí'),
(2, 108, 2, 'Excederse en el plazo de un asueto o licencia sin autorización hasta por veinticuatro (24) horas'),
(3, 108, 3, 'No presentarse o no acudir en caso de llamado a la Unidad Policial más cercana en casos de emergencia o catástrofes naturales'),
(4, 108, 4, 'El descuido o negligencia en el uso o manejo de las armas, maquinarias, equipo, vehículos o materiales asignados'),
(5, 108, 5, 'El incumplimiento injustificado de una orden transmitida por la autoridad competente, siempre y cuando la misma no constituya ilícito'),
(6, 108, 6, 'No honrar las deudas contraídas de cualquier índole o dar lugar a quejas fundamentadas de la ciudadanía, por el incumplimiento del pago a las deudas contraídas'),
(7, 108, 7, 'El incumpliendo de obligaciones alimentarias familiares de conformidad a la Ley'),
(8, 108, 8, 'Hacer uso de influencias en el servicio para beneficio personal'),
(9, 108, 9, 'No transmitir una consigna en el servicio policial'),
(10, 108, 10, 'Excusarse injustificadamente de estar enfermo o exagerar una dolencia para eludir el servicio'),
(11, 108, 11, 'Irrespeto a los principios de unidad y línea de mando'),
(12, 108, 12, 'No presentar en los plazos previstos en la Ley, la Declaración Jurada de Bienes ante el Tribunal Superior de Cuentas (TSC)'),
(13, 108, 13, 'Relacionarse con personas vinculadas a la delincuencia común'),
(14, 108, 14, 'Impedir o limitar que las personas puedan ejercer libremente sus derechos'),
(15, 108, 15, 'El maltrato físico contra personas, sin perjuicio de las responsabilidades penales o civiles que correspondan'),
(16, 108, 16, 'El maltrato verbal o psicológico contra sus superiores, subalternos o compañeros de carrera o servicio policial  y otras personas dentro o fuera del servicio'),
(17, 108, 17, 'Otras que se establezcan reglamentariamente'),
(18, 109, 1, 'Reincidencia en una falta grave, sea la misma o distinta entre sí'),
(19, 109, 2, 'El uso de drogas no autorizadas o la ingesta de bebidas alcohólicas, durante el servicio o presentarse bajo los efectos de éstas al mismo, determinado mediante prueba toxicológica o de alcolemia oportunamente practicada de conformidad a la ley'),
(20, 109, 3, 'Sustraer del local de trabajo o destinar a uso diferente del que corresponda, los materiales, herramientas, equipos o productos elaborados sin autorización expresa del jefe responsable'),
(21, 109, 4, 'No prestar auxilio a particulares o sus compañeros en circunstancias de peligro'),
(22, 109, 5, 'No reportar a sus superiores o a la Inspectoría General el conocimiento de hechos delictivos u otros que por razones de servicio está obligado a comunicar o hacerlo con retraso intencional o sin veracidad'),
(23, 109, 6, 'No iniciar oportunamente los procedimientos disciplinarios o retrasarlos de manera tal que prescriba la aplicación de la sanción correspondiente'),
(24, 109, 7, 'Facilitar o enajenar a personas naturales o jurídicas, insignias, prendas, equipo o armamento policial'),
(25, 109, 8, 'El uso indiscriminado, innecesario o excesivo de la fuerza en el desempeño de sus labores, conforme lo establecido en la reglamentación respectiva'),
(26, 109, 9, 'Extravío de armas, insignias, prendas policiales y equipo sin causa justificada o en caso de negligencia comprobada, debiendo además restituir su costo'),
(27, 109, 10, 'Promover o participar en suspensiones colectivas de labores de cualquier naturaleza'),
(28, 109, 11, 'Abandonar el servicio individual o colectivamente, para manifestar su inconformidad, aduciendo la violación de sus derechos'),
(29, 109, 12, 'Promover la organización de sindicatos u otras organizaciones similares de carácter gremial dentro de la institución'),
(30, 109, 13, 'El incumplimiento de la orden de asignación de destino o cargo'),
(31, 109, 14, 'La falta manifiesta de colaboración con los demás órganos del Estado'),
(32, 109, 15, 'Obligar a sus subalternos a solicitar créditos o contraer deudas de cualquier índole, para beneficio propio o de un tercero'),
(33, 109, 16, 'No usar identificación u ocultarla para evitar ser identificado, estando en servicio, excepto en aquellos casos en que sea debidamente autorizado'),
(34, 109, 17, 'Causar cualquier escándalo público que perjudique la imagen de la institución'),
(35, 109, 18, 'Utilización de equipo, vehículos y bienes de la institución en actividades ilícitas, as? como con fines particulares'),
(36, 109, 19, 'La violación de la discreción debida y del secreto profesional en asuntos e informaciones confidenciales del servicio'),
(37, 109, 20, 'Dilatar los procedimientos de investigación disciplinaria, mediante la presentación de recusaciones, sin fundamento alguno'),
(38, 109, 21, 'Perder una evidencia o no cumplir con la cadena de custodia'),
(39, 109, 22, 'No asistir a las audiencias judiciales a las que legalmente está obligado o en caso de asistir cambie su versión sobre los hechos, respecto a la declaración brindada en la etapa preparatoria de juicio'),
(40, 109, 23, 'El no entregar sus armas, indumentarias y equipos al Centro de Apoyo y Logística de la Policía Nacional, cuando el miembro de la Carrera Policial está con medidas disciplinarias objeto de suspensión por acciones administrativas o penales'),
(41, 109, 24, 'Dedicarse o permitir actividades de carácter ilícito, debidamente comprobadas'),
(42, 109, 25, 'Relacionarse con personas u organizaciones vinculadas con criminalidad organizada, maras, pandillas o narcotráfico'),
(43, 109, 26, 'Solicitar o aceptar a su nombre o de terceros, cualquier gratificación, beneficio o regalo de personas naturales o jurídicas, a cambio de facilitar la comisión de ilícitos por su acción u omisión'),
(44, 109, 27, 'No registrar en los libros, documentos o archivos tanto en forma física como digital correspondiente, los hechos o novedades pertinentes al servicio u omitir datos o detalles para desnaturalizar la veracidad de lo ocurrido u ordenado'),
(45, 109, 28, 'Alterar los libros, documentos o archivos tanto en forma física como digital correspondiente en que se registren los hechos o novedades pertinentes al servicio o extraer de los mismos hojas, pegar parches o efectuar enmendaduras para desnaturalizar la ver'),
(46, 109, 29, 'No registrar en el libro o registro respectivo, la evidencia decomisada, con indicación del nombre de la o las personas, dirección de la casa, local o lugar del decomiso, cantidad u otras características relevantes'),
(47, 109, 30, 'Destruir o sustraer del archivo oficial la correspondencia enviada o recibida y la información registrada en los libros respectivos'),
(48, 109, 31, 'Declarar ante cualquier superior o autoridad, hechos falsos u ocultar intencionalmente detalles para alterar la realidad de los hechos'),
(49, 109, 32, 'No realizar los embalajes o romper la garantía de autenticidad de las piezas de convicción'),
(50, 109, 33, 'No registrar, reportar e informar a los mandos policiales el decomiso de cualquier tipo de indicio en las estaciones policiales o en los patrullajes'),
(51, 109, 34, 'Aprovecharse de su cargo o grado para inducir, acosar o establecer relaciones de carácter sexual con sus compañeros o subalternos'),
(52, 109, 35, 'No presentarse a sus labores por tres (3) días consecutivos, sin que medie causa justificada'),
(53, 109, 36, 'No presentarse a sus labores por cuatro (4) días alternos dentro de un período de treinta (30) días calendario, contados desde la primera ausencia, sin que medie causa justificada'),
(54, 109, 37, 'Uso innecesario o imprudente de las armas de fuego que ponga en riesgo la integridad física o psíquica de las personas'),
(55, 109, 38, 'Rehusarse, eludir, impedir o de alguna manera obstaculizar la práctica a sí mismo o a otros, de cualquiera de las pruebas de evaluación de confianza'),
(56, 109, 39, 'La destrucción de documentación oficial, equipo o cualquier otro bien propiedad del Estado, salvo los casos de mero accidente debidamente comprobado'),
(57, 109, 40, 'La participación en actividades políticas partidistas de cualquier índole'),
(58, 109, 41, 'Negligencia, descuido o desinterés en el desempeño de la labor policial, que facilite de manera directa o indirecta la comisión de una falta o ilícito o que genere un perjuicio hacia la institución o la ciudadanía'),
(59, 109, 42, 'El ejercicio de trabajos particulares durante el miembro de la Carrera Policial se encuentre en reposo, suspendido de funciones y/o cargo'),
(60, 109, 43, 'La portación de armas no reglamentarias, en el ejercicio de su función policial o no dejar el arma reglamentaria en depósito cuando se encuentre fuera del servicio'),
(61, 109, 44, 'No dar cumplimiento a lo establecido en los respectivos reglamentos y manuales para la realización de operaciones y actividades policiales, cuya omisión resulte perjudicial para la institución'),
(62, 109, 45, 'Obtener dos (2) evaluaciones de idoneidad consecutivas con puntaje no satisfactorio o deficiente de conformidad al procedimiento de evaluación descrito en el reglamento correspondiente'),
(63, 109, 46, 'Las actuaciones arbitrarias o discriminatorias por cualquier causa que afecten las libertades ciudadanas, la dignidad de las personas o los derechos humanos'),
(64, 109, 47, 'Formar parte como socio, propietario o desempeñarse en cargos en empresas de seguridad privada'),
(65, 109, 48, 'Haber sido condenado mediante sentencia en materia alimentaria, violencia doméstica o negación de asistencia familiar'),
(66, 109, 49, 'Prohibición de recolectar dinero, dadivas, recompensas o similares por el ejercicio de una labor que por Ley está obligado a realizar'),
(67, 109, 50, 'Emitir o cumplir órdenes que de acuerdo a la Ley son ilegales'),
(68, 109, 51, 'Otras que se establezcan reglamentariamente');

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
-- Estructura de tabla para la tabla `tbl_depto`
--

CREATE TABLE `tbl_depto` (
  `depto_id` int(11) NOT NULL,
  `depto_nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_depto`
--

INSERT INTO `tbl_depto` (`depto_id`, `depto_nombre`) VALUES
(1, 'ATLÁNTIDA'),
(2, 'COLÓN\r\n'),
(3, 'COMAYAGUA'),
(4, 'COPÁN'),
(5, 'CORTÉS'),
(6, 'CHOLUTECA'),
(7, 'EL PARAÍSO'),
(8, 'FRANCISCO MORAZÁN'),
(9, 'GRACIAS A DIOS'),
(10, 'INTIBUCÁ'),
(11, 'ISLAS DE LA BAHÍA'),
(12, 'LA PAZ'),
(13, 'LEMPIRA'),
(14, 'OCOTEPEQUE'),
(15, 'OLANCHO'),
(16, 'SANTA BÁRBARA'),
(17, 'VALLE'),
(18, 'YORO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_est_proceso`
--

CREATE TABLE `tbl_est_proceso` (
  `est_proceso_id` int(11) NOT NULL,
  `est_proceso_descrip` varchar(150) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_est_proceso`
--

INSERT INTO `tbl_est_proceso` (`est_proceso_id`, `est_proceso_descrip`) VALUES
(1, 'INVESTIGACIÓN'),
(2, 'FORMALIZACION DE CARGO'),
(3, 'CIERRE PRELIMINAR'),
(4, 'CIERRE CON DILIGENCIAS'),
(5, 'REMITIDO CON CIERRE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_exp`
--

CREATE TABLE `tbl_exp` (
  `exp_id` int(11) NOT NULL,
  `nombre_denunciante` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `identidad_denunciante` varchar(15) COLLATE utf8_spanish2_ci NOT NULL,
  `genero_id` int(11) NOT NULL,
  `depto_id` int(11) NOT NULL,
  `municipio_id` int(11) NOT NULL,
  `num_exp` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre_investigado` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `rango_id` int(11) NOT NULL,
  `tipo_falta_id` int(11) NOT NULL,
  `investigador_id` int(11) NOT NULL,
  `fecha_inicio_exp` date NOT NULL,
  `fecha_final_exp` date NOT NULL,
  `fecha_inicio_i` date NOT NULL,
  `fecha_final_i_pre` date DEFAULT NULL,
  `fecha_final_i` date DEFAULT NULL,
  `diligencia_exp` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `est_proceso_id` int(11) NOT NULL,
  `fecha_remision_s` date NOT NULL,
  `observacion` text COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_exp`
--

INSERT INTO `tbl_exp` (`exp_id`, `nombre_denunciante`, `identidad_denunciante`, `genero_id`, `depto_id`, `municipio_id`, `num_exp`, `nombre_investigado`, `rango_id`, `tipo_falta_id`, `investigador_id`, `fecha_inicio_exp`, `fecha_final_exp`, `fecha_inicio_i`, `fecha_final_i_pre`, `fecha_final_i`, `diligencia_exp`, `est_proceso_id`, `fecha_remision_s`, `observacion`) VALUES
(3, 'ABNER FLORES', '0801199718412', 1, 8, 110, 'DPL-0801-2021-05255', 'PABLO MORÁN', 8, 108, 2, '2021-06-24', '2021-10-06', '0000-00-00', '0000-00-00', '2021-08-18', 'REVISON DE LIBRO DE NOVEDADES', 1, '0000-00-00', 'NINGUNA'),
(4, '', '', 1, 8, 110, 'DPL-0801-2021-00025', 'LUIS FUGON', 12, 108, 2, '2021-06-24', '2021-10-06', '0000-00-00', '0000-00-00', '2021-08-18', 'VISITA A POSTA DE SAN MIGUEL', 1, '0000-00-00', 'PROCESO'),
(5, 'JUAN PEREZ', '0610198800452', 1, 8, 110, 'DPL-0801-2021-01010', 'MARIO MARTINEZ', 12, 109, 3, '2021-05-01', '2021-08-13', '2021-05-06', '2021-05-14', '2021-06-25', 'VISITA A POSTA', 1, '2021-05-17', 'INVESTIGACION'),
(6, 'MARCO ZUNIGA', '0610198800454', 1, 8, 110, 'DPL-0801-2021-01258', 'JUAN PEREZ', 7, 109, 3, '2021-06-21', '2021-10-01', '0000-00-00', '0000-00-00', '2021-08-13', 'VISITA A POSTA', 1, '0000-00-00', 'INVESTIGACION'),
(7, 'CALEB GUILLEN', '0801199025245', 1, 8, 110, 'DPL-0801-2021-01254', 'JULIAN RAMOS', 5, 109, 3, '2021-06-25', '2021-10-07', '0000-00-00', '0000-00-00', '2021-08-19', 'HOLA', 1, '0000-00-00', 'HOLA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_exp_art`
--

CREATE TABLE `tbl_exp_art` (
  `exp_art_id` int(11) NOT NULL,
  `exp_id` int(11) NOT NULL,
  `art_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_exp_art`
--

INSERT INTO `tbl_exp_art` (`exp_art_id`, `exp_id`, `art_id`) VALUES
(1, 3, 2),
(2, 4, 5),
(3, 5, 21),
(4, 6, 19),
(5, 7, 21);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_feriado`
--

CREATE TABLE `tbl_feriado` (
  `id_feriado` int(11) NOT NULL,
  `feriado_descrip` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `feriado_fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_feriado`
--

INSERT INTO `tbl_feriado` (`id_feriado`, `feriado_descrip`, `feriado_fecha`) VALUES
(1, 'AÑO NUEVO', '2021-01-01'),
(2, 'JUEVES SANTO', '2021-04-01'),
(3, 'VIERNES SANTO', '2021-04-02'),
(4, 'SABADO SANTO', '2021-04-03'),
(5, 'DÍA DE LAS AMERICAS', '2021-04-14'),
(6, 'DÍA NACIONAL DEL TRABAJO', '2021-05-01'),
(7, 'DÍA DE LA INDEPENDENCIA', '2021-08-15'),
(8, 'DÍA DEL SOLDADO', '2021-10-03'),
(9, 'DÍA DEL LA RAZA', '2021-10-12'),
(10, 'DÍA DE LAS FUERZAS ARMADAS ', '2021-10-21'),
(11, 'NAVIDAD', '2021-12-25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_genero`
--

CREATE TABLE `tbl_genero` (
  `genero_id` int(11) NOT NULL,
  `genero_descrip` varchar(10) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_genero`
--

INSERT INTO `tbl_genero` (`genero_id`, `genero_descrip`) VALUES
(1, 'MASCULINO'),
(2, 'FEMENINO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_municipio`
--

CREATE TABLE `tbl_municipio` (
  `municipio_id` int(11) NOT NULL,
  `depto_id` int(11) NOT NULL,
  `municipio_nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_municipio`
--

INSERT INTO `tbl_municipio` (`municipio_id`, `depto_id`, `municipio_nombre`) VALUES
(1, 1, 'LA CEIBA'),
(2, 1, 'TELA'),
(3, 1, 'JUTIAPA'),
(4, 1, 'LA MASICA'),
(5, 1, 'SAN FRANCISCO'),
(6, 1, 'ARIZONA'),
(7, 1, 'ESPARTA'),
(8, 1, 'EL PORVENIR'),
(9, 2, 'TRUJILLO'),
(10, 2, 'BALFATE'),
(11, 2, 'IRIONA'),
(12, 2, 'LIMÓN'),
(13, 2, 'SABA'),
(14, 2, 'SANTA FE'),
(15, 2, 'SANTA ROSA DE AGUÁN'),
(16, 2, 'SONAGUERA'),
(17, 2, 'TOCOA'),
(18, 2, 'BONITO ORIENTAL'),
(19, 3, 'COMAYAGUA'),
(20, 3, 'AJUTERIQUE'),
(21, 3, 'EL ROSARIO'),
(22, 3, 'ESQUÍAS'),
(23, 3, 'HUMUYA'),
(24, 3, 'LA LIBERTAD'),
(25, 3, 'LAMANÍ'),
(26, 3, 'LA TRINIDAD'),
(27, 3, 'LEJAMANÍ'),
(28, 3, 'MEAMBAR'),
(29, 3, 'MINAS DE ORO'),
(30, 3, 'OJOS DE AGUA'),
(31, 3, 'SAN JERÓNIMO'),
(32, 3, 'SAN JOSÉ DE COMAYAGUA'),
(33, 3, 'SAN JOSÉ DEL POTRERO'),
(34, 3, 'SAN LUIS'),
(35, 3, 'SAN SEBASTIÁN\r\n'),
(36, 3, 'SIGUATEPEQUE'),
(37, 3, 'VILLA DE SAN ANTONIO'),
(38, 3, 'LAS LAJAS'),
(39, 3, 'TAULABÉ'),
(40, 4, 'SANTA ROSA DE COPÁN\r\n'),
(41, 4, 'CABAÑAS'),
(42, 4, 'CONCEPCIÓN'),
(43, 4, 'COPÁN RUINAS'),
(44, 4, 'CORQUÍN'),
(45, 4, 'CUCUYAGUA'),
(46, 4, 'DOLORES'),
(47, 4, 'DULCE NOMBRE'),
(48, 4, 'EL PARAÍSO'),
(49, 4, 'FLORIDA'),
(50, 4, 'LA JIGUA'),
(51, 4, 'LA UNIÓN'),
(52, 4, 'NUEVA ARCADIA'),
(53, 4, 'SAN AGUSTÍN'),
(54, 4, 'SAN ANTONIO'),
(55, 4, 'SAN JERÓNIMO'),
(56, 4, 'SAN JOSÉ'),
(57, 4, 'SAN JUAN DE OPOA'),
(58, 4, 'SAN NICOLÁS\r\n'),
(59, 4, 'SAN PEDRO'),
(60, 4, 'SANTA RITA'),
(61, 4, 'TRINIDAD DE COPÁN\r\n'),
(62, 4, 'VERACRUZ'),
(63, 5, 'SAN PEDRO SULA'),
(64, 5, 'CHOLOMA'),
(65, 5, 'OMOA'),
(66, 5, 'PIMIENTA'),
(67, 5, 'POTRERILLOS'),
(68, 5, 'PUERTO CORTÉS'),
(69, 5, 'SAN ANTONIO DE CORTÉS'),
(70, 5, 'SAN FRANCISCO DE YOJOA'),
(71, 5, 'SAN MANUEL'),
(72, 5, 'SANTA CRUZ DE YOJOA'),
(73, 5, 'VILLANUEVA'),
(74, 5, 'LA LIMA'),
(75, 6, 'CHOLUTECA'),
(76, 6, 'APACILAGUA'),
(77, 6, 'CONCEPCIÓN DE MARÍA'),
(78, 6, 'DUYURE'),
(79, 6, 'EL CORPUS'),
(80, 6, 'EL TRIUNFO'),
(81, 6, 'MARCOVIA'),
(82, 6, 'MOROLICA'),
(83, 6, 'NAMASIGUE'),
(84, 6, 'OROCUINA'),
(85, 6, 'PESPIRE'),
(86, 6, 'SAN ANTONIO DE FLORES'),
(87, 6, 'SAN ISIDRO'),
(88, 6, 'SAN JOSÉ'),
(89, 6, 'SAN MARCOS DE COLÓN'),
(90, 6, 'SANTA ANA DE YUSGUARE'),
(91, 7, 'YUSCARÁN\r\n'),
(92, 7, 'ALAUCA'),
(93, 7, 'DANLÍ'),
(94, 7, 'EL PARAÍSO'),
(95, 7, 'GUINOPE'),
(96, 7, 'JACALEAPA'),
(97, 7, 'LIURE'),
(98, 7, 'MOROCELÍ'),
(99, 7, 'OROPOLÍ'),
(100, 7, 'POTRERILLOS'),
(101, 7, 'SAN ANTONIO DE FLORES'),
(102, 7, 'SAN LUCAS'),
(103, 7, 'SAN MATÍAS'),
(104, 7, 'SOLEDAD'),
(105, 7, 'TEUPASENTI'),
(106, 7, 'TEXIGUAT'),
(107, 7, 'VADO ANCHO'),
(108, 7, 'YAUYUPE'),
(109, 7, 'TROJES'),
(110, 8, 'DISTRITO CENTRAL'),
(111, 8, 'ALUBARÉN'),
(112, 8, 'CURARÉN'),
(113, 8, 'CEDROS'),
(114, 8, 'EL PORVENIR'),
(115, 8, 'GUAIMACA'),
(116, 8, 'LA LIBERTAD'),
(117, 8, 'LA VENTA'),
(118, 8, 'LEPATERIQUE'),
(119, 8, 'MARAITA'),
(120, 8, 'MARALE'),
(121, 8, 'NUEVA ARMENIA'),
(122, 8, 'OJOJONA'),
(123, 8, 'ORICA'),
(124, 8, 'REITOCA'),
(125, 8, 'SABANAGRANDE'),
(126, 8, 'SAN ANTONIO DE ORIENTE'),
(127, 8, 'SAN BUENAVENTURA'),
(128, 8, 'SAN IGNACIO'),
(129, 8, 'SAN JUAN DE FLORES'),
(130, 8, 'SAN MIGUELITO'),
(131, 8, 'SANTA ANA'),
(132, 8, 'SANTA LUCÍA'),
(133, 8, 'TALANGA'),
(134, 8, 'TATUMBLA'),
(135, 8, 'VALLE DE ÁNGELES'),
(136, 8, 'VILLA DE SAN FRANCISCO'),
(137, 8, 'VALLECILLO'),
(138, 9, 'PUERTO LEMPIRA'),
(139, 9, 'BRUS LAGUNA'),
(140, 9, 'AHUAS'),
(141, 9, 'JUAN FRANCISCO BULNES'),
(142, 9, 'RAMÓN VILLEDA MORALES'),
(143, 9, 'WAMPUSIRPE'),
(144, 10, 'LA ESPERANZA'),
(145, 10, 'CAMASCA'),
(146, 10, 'COLOMONCAGUA'),
(147, 10, 'CONCEPCIÓN'),
(148, 10, 'DOLORES'),
(149, 10, 'INTIBUCA'),
(150, 10, 'JESÚS DE OTORO'),
(151, 10, 'MAGDALENA'),
(152, 10, 'MASAGUARA'),
(153, 10, 'SAN ANTONIO'),
(154, 10, 'SAN ISIDRO'),
(155, 10, 'SAN JUAN'),
(156, 10, 'SAN MARCOS DE LA SIERRA'),
(157, 10, 'SAN MIGUEL GUANCAPLA'),
(158, 10, 'SANTA LUCÍA'),
(159, 10, 'YAMARANGUILA'),
(160, 10, 'SAN FRANCISCO DE OPALACA'),
(161, 11, 'ROATÁN\r\n'),
(162, 11, 'GUANAJA'),
(163, 11, 'JOSÉ SANTOS GUARDIOLA'),
(164, 11, 'UTILA'),
(165, 12, 'LA PAZ'),
(166, 12, 'AGUANQUETERIQUE'),
(167, 12, 'CABAÑAS'),
(168, 12, 'CANE'),
(169, 12, 'CHINACLA'),
(170, 12, 'GUAJIQUIRO'),
(171, 12, 'LAUTERIQUE'),
(172, 12, 'MARCALA'),
(173, 12, 'MERCEDES DE ORIENTE'),
(174, 12, 'OPATORO'),
(175, 12, 'SAN ANTONIO DEL NORTE'),
(176, 12, 'SAN JOSÉ'),
(177, 12, 'SAN JUAN'),
(178, 12, 'SAN PEDRO DE TUTULE'),
(179, 12, 'SANTA ANA'),
(180, 12, 'SANTA ELENA'),
(181, 12, 'SANTA MARÍA'),
(182, 12, 'SANTIAGO DE PURINGLA'),
(183, 12, 'YARULA'),
(184, 13, 'GRACIAS'),
(185, 13, 'BELÉN'),
(186, 13, 'CANDELARIA'),
(187, 13, 'COLOLACA'),
(188, 13, 'ERANDIQUE'),
(189, 13, 'GUALCINCE'),
(190, 13, 'GUARITA'),
(191, 13, 'LA CAMPA'),
(192, 13, 'LA IGUALA'),
(193, 13, 'LAS FLORES'),
(194, 13, 'LA UNIÓN'),
(195, 13, 'LA VIRTUD'),
(196, 13, 'LEPAERA'),
(197, 13, 'MAPULACA'),
(198, 13, 'PIRAERA'),
(199, 13, 'SAN ANDRÉS'),
(200, 13, 'SAN FRANCISCO'),
(201, 13, 'SAN JUAN GUARITA'),
(202, 13, 'SAN MANUEL COLOHETE'),
(203, 13, 'SAN RAFAEL'),
(204, 13, 'SAN SEBASTIÁN\r\n'),
(205, 13, 'SANTA CRUZ'),
(206, 13, 'TALGUA'),
(207, 13, 'TAMBLA'),
(208, 13, 'TOMALA'),
(209, 13, 'VALLADOLID'),
(210, 13, 'VIRGINIA'),
(211, 13, 'SAN MARCOS DE CAIQUÍN'),
(212, 14, 'OCOTEPEQUE'),
(213, 14, 'BELÉN GUALCHO'),
(214, 14, 'CONCEPCIÓN'),
(215, 14, 'DOLORES MERENDÓN'),
(216, 14, 'FRATERNIDAD'),
(217, 14, 'LA ENCARNACIÓN'),
(218, 14, 'LA LABOR'),
(219, 14, 'LUCERNA'),
(220, 14, 'MERCEDES'),
(221, 14, 'SAN FERNANDO'),
(222, 14, 'SAN FRANCISCO DEL VALLE'),
(223, 14, 'SAN JORGE'),
(224, 14, 'SAN MARCOS'),
(225, 14, 'SANTA FE'),
(226, 14, 'SENSENTI'),
(227, 14, 'SINUAPA'),
(228, 15, 'JUTICALPA'),
(229, 15, 'CAMPAMENTO'),
(230, 15, 'CATACAMAS'),
(231, 15, 'CONCORDIA'),
(232, 15, 'DULCE NOMBRE DE CULM?'),
(233, 15, 'EL ROSARIO'),
(234, 15, 'ESQUIPULAS DEL NORTE'),
(235, 15, 'GUALACO'),
(236, 15, 'GUARIZAMA'),
(237, 15, 'GUATA'),
(238, 15, 'GUAYAPE'),
(239, 15, 'JANO'),
(240, 15, 'LA UNI?N'),
(241, 15, 'MANGULILE'),
(242, 15, 'MANTO'),
(243, 15, 'SALAMA'),
(244, 15, 'SAN ESTEBAN'),
(245, 15, 'SAN FRANCISCO DE BECERRA'),
(246, 15, 'SAN FRANCISCO DE LA PAZ'),
(247, 15, 'SANTA MARÍA DEL REAL'),
(248, 15, 'SILCA'),
(249, 15, 'YOCÓN'),
(250, 15, 'PATUCA'),
(251, 16, 'SANTA BÁRBARA'),
(252, 16, 'ARADA'),
(253, 16, 'ATIMA'),
(254, 16, 'AZACUALPA'),
(255, 16, 'CEGUACA'),
(256, 16, 'CONCEPCIÓN DEL NORTE'),
(257, 16, 'CONCEPCIÓN DEL SUR'),
(258, 16, 'CHINDA'),
(259, 16, 'EL NÍSPERO'),
(260, 16, 'GUALALA'),
(261, 16, 'ILAMA'),
(262, 16, 'LAS VEGAS'),
(263, 16, 'MACUELIZO'),
(264, 16, 'NARANJITO'),
(265, 16, 'NUEVO CELILAC'),
(266, 16, 'NUEVA FRONTERA'),
(267, 16, 'PETOA'),
(268, 16, 'PROTECCIÓN'),
(269, 16, 'QUIMISTÁN\r\n'),
(270, 16, 'SAN FRANCISCO DE OJUERA'),
(271, 16, 'SAN JOSÉ DE LAS COLINAS'),
(272, 16, 'SAN LUIS'),
(273, 16, 'SAN MARCOS'),
(274, 16, 'SAN NICOLÁS\r\n'),
(275, 16, 'SAN PEDRO ZACAPA'),
(276, 16, 'SANTA RITA'),
(277, 16, 'SAN VICENTE CENTENARIO'),
(278, 16, 'TRINIDAD'),
(279, 17, 'NACAOME'),
(280, 17, 'ALIANZA'),
(281, 17, 'AMAPALA'),
(282, 17, 'ARAMECINA'),
(283, 17, 'CARIDAD'),
(284, 17, 'GOASCORÁN\r\n'),
(285, 17, 'LANGUE'),
(286, 17, 'SAN FRANCISCO DE CORAY'),
(287, 17, 'SAN LORENZO'),
(288, 18, 'YORO'),
(289, 18, 'ARENAL'),
(290, 18, 'EL NEGRITO'),
(291, 18, 'EL PROGRESO'),
(292, 18, 'JOCÓN'),
(293, 18, 'MORAZÁN\r\n'),
(294, 18, 'OLANCHITO'),
(295, 18, 'SANTA RITA'),
(296, 18, 'SULACO'),
(297, 18, 'VICTORIA'),
(298, 18, 'YORITO');

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
-- Estructura de tabla para la tabla `tbl_puesto`
--

CREATE TABLE `tbl_puesto` (
  `puesto_id` int(11) NOT NULL,
  `puesto_nombre` varchar(150) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_puesto`
--

INSERT INTO `tbl_puesto` (`puesto_id`, `puesto_nombre`) VALUES
(1, 'ASISTENTE ADMINISTRATIVO'),
(2, 'ASISTENTE DE COMUNICACIÓN INSTITUCIONAL'),
(3, 'ASISTENTE EJECUTIVO '),
(4, 'AUDITOR INTERNO'),
(5, 'AUXILIAR DE ARCHIVO'),
(6, 'AUXILIAR DE FOTOCOPIADO'),
(7, 'AUXILIAR DE SERVICIOS GENERALES'),
(8, 'CONSERJE'),
(9, 'CONTADOR'),
(10, 'COORDINADOR GENERAL DE INVESTIGACIÓN\r\n'),
(11, 'DIRECTOR EJECUTIVO'),
(12, 'ESPECIALISTA TÉCNICO LEGAL '),
(13, 'ESPECIALISTA TÉCNICO LEGAL II'),
(14, 'GERENTE ADMINISTRATIVO'),
(15, 'INVESTIGADOR DE CASOS COMUNES'),
(16, 'INVESTIGADOR DE CASOS SENSITIVOS'),
(17, 'JEFE DE COMUNICACIÓN INSTITUCIONAL'),
(18, 'JEFE DE DENUNCIAS '),
(19, 'JEFE DE GESTIÓN DOCUMENTAL'),
(20, 'JEFE DE LA SECCION DE SERVICIOS LEGALES'),
(21, 'JEFE DE LA UPEG'),
(22, 'JEFE DE PRESUPUESTO'),
(23, 'JEFE DE RECURSOS HUMANOS'),
(24, 'JEFE DE TECNOLOGÍA DE LA INFORMACIÓN  '),
(25, 'JEFE REGIONAL NORTE'),
(26, 'MOTORISTA'),
(27, 'OFICIAL ADMINISTRATIVO '),
(28, 'OFICIAL DE ATENCIÓN AL USUARIO'),
(29, 'OFICIAL DE ATENCIÓN CIUDADANA Y DERECHOS HUMANOS '),
(30, 'OFICIAL DE BIENES '),
(31, 'OFICIAL DE CITACIONES Y NOTIFICACIONES'),
(32, 'OFICIAL DE CITACIONES Y NOTIFICACIONES'),
(33, 'OFICIAL DE COMPRAS '),
(34, 'OFICIAL DE PLANILLAS'),
(35, 'OFICIAL DE RECEPCIÓN DE DENUNCIAS '),
(39, 'OFICIAL DE TECNOLOGÍA DE LA INFORMACIÓN  '),
(40, 'OFICIAL DE TRANSPARENCIA'),
(41, 'SECRETARIA GENERAL'),
(42, 'SUPERVISOR DE RECURSOS HUMANOS'),
(43, 'SUPERVISOR JEFE DE SERVICIOS LEGALES NORTE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_rango`
--

CREATE TABLE `tbl_rango` (
  `rango_id` int(11) NOT NULL,
  `rango_descripcion` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_rango`
--

INSERT INTO `tbl_rango` (`rango_id`, `rango_descripcion`) VALUES
(1, 'DIRECTOR GENERAL'),
(2, 'COMISIONADO GENERAL'),
(3, 'COMISIONADO'),
(4, 'SUBCOMISIONADO'),
(5, 'COMISARIO'),
(6, 'SUBCOMIDARIO'),
(7, 'INSPECTOR'),
(8, 'SUBINSPECTOR'),
(9, 'SUBOFICIAL I'),
(10, 'SUBOFICIAL II'),
(11, 'SUBOFICIAL III'),
(12, 'CLASE I'),
(13, 'CLASE II'),
(14, 'CLASE III'),
(15, 'DPI'),
(16, 'POLICIA MILITAR'),
(17, 'POLICIA GENERAL'),
(18, 'ATIC'),
(19, 'SEC. SEGURIDAD'),
(20, 'POLICIA MUNICIPAL');

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
(1, 'ADMINISTRADOR', 'ADMINISTRADOR DEL SISTEMA'),
(2, 'INVESTIGADOR', 'INVESTIGADOR DE CASOS'),
(3, 'LEGAL', 'ESPECIALISTA TÉCNICO LEGAL');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_seccion`
--

CREATE TABLE `tbl_seccion` (
  `seccion_id` int(11) NOT NULL,
  `seccion_nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `seccion_descripcion` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_seccion`
--

INSERT INTO `tbl_seccion` (`seccion_id`, `seccion_nombre`, `seccion_descripcion`) VALUES
(1, 'DIRECCIÓN', ''),
(2, 'SUB-DIRECCIÓN', ''),
(3, 'COORDINACIÓN (SPS)', ''),
(4, 'SECRETARIA GENERAL', ''),
(5, 'GERENCIA DE INVESTIGACIÓN', ''),
(6, 'GERENCIA DE SERVICIOS LEGALES ', ''),
(7, 'GERENCIA DE PREVENCIÓN, EVALUACIÓN Y CERTIFICACIÓN ', ''),
(8, 'GERENCIA ADMINISTRATIVA', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_tipo_falta`
--

CREATE TABLE `tbl_tipo_falta` (
  `tipo_falta_id` int(11) NOT NULL,
  `tipo_falta_descrip` varchar(100) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_tipo_falta`
--

INSERT INTO `tbl_tipo_falta` (`tipo_falta_id`, `tipo_falta_descrip`) VALUES
(108, 'GRAVE'),
(109, 'MUY GRAVE');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_unidad`
--

CREATE TABLE `tbl_unidad` (
  `unidad_id` int(11) NOT NULL,
  `seccion_id` int(11) NOT NULL,
  `unidad_nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `unidad_descripcion` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_unidad`
--

INSERT INTO `tbl_unidad` (`unidad_id`, `seccion_id`, `unidad_nombre`, `unidad_descripcion`) VALUES
(1, 1, 'UNIDAD DE AUDITORIA INTERNA', ''),
(2, 1, 'UNIDAD DE TRANSPARENCIA', ''),
(3, 1, 'UNIDAD DE DERECHOS INSTITUCIONALES', ''),
(4, 1, 'UNIDAD DE COMUNICACIÓN INSTITUCIONAL', ''),
(5, 1, 'UNIDAD DE COOPERACIÓN EXTERNA ', ''),
(6, 1, 'UNIDAD DE CONTROL INTERNO', ''),
(7, 1, 'UNIDAD DE PLANIFICACION Y EVALUACIÓN DE LA GESTIÓN', ''),
(8, 1, 'OFICINA DE PROTOCOLO', ''),
(9, 2, 'CONSEJO  DISCIPLINARIO', ''),
(10, 2, 'OFICINA DE RESPONSABILIDAD Y DISCIPLINA', ''),
(11, 3, 'OFICINA ADMINISTRATIVA SPS', ''),
(12, 3, 'SECRETARIA ADJUNTA SPS', ''),
(13, 3, 'OFICINA DE ATENCIÓN AL CIUDADANO SPS', ''),
(14, 3, 'OFICINA DE CITACIONES Y NOTIFICACIONES SPS', ''),
(15, 3, 'UNIDAD LEGAL SPS', ''),
(16, 3, 'UNIDAD DE INVESTIGACIÓN SPS', ''),
(17, 3, 'OFICINA DE DENUNCIAS SPS', ''),
(18, 4, 'UNIDAD DE GESTION DOCUMENTAL', ''),
(19, 4, 'UNIDAD DE ATENCION AL CIUDADANO Y RECEPCIÓN DE DOCUMENTOS', ''),
(20, 4, 'UNIDAD DE CITACIONES Y NOTIFICACIONES', ''),
(21, 4, 'UNIDAD DE ESTADÍSTICA INSTITUCIONAL', ''),
(22, 5, 'UNIDAD DE DENUCIAS Y QUEJAS', ''),
(23, 5, 'UNIDAD DE INVESTIGACIÓN', ''),
(24, 5, 'UNIDAD ESPECIAL DE CASOS SENDITIVOS', ''),
(25, 5, 'OFICINA DE ANÁLISIS ESTADISTICO, ESTUDIO Y PREVENCIÓN DE FALTAS', ''),
(26, 6, 'UNIDAD DE GESTI?N DE DESCARGOS', 'Q'),
(27, 6, 'UNIDAD DE CUMPLIMIENTO DE MEDIDAS Y SEGUIMIENTO A PROCESOS JUDICIALES', 'Q'),
(28, 6, 'UNIDAD DE ASESORIA LEGAL', 'Q'),
(29, 7, 'OFICINA DE TRABAJO SOCIAL', 'Q'),
(30, 7, 'OFICINA DE PSICOLOGIA', 'Q'),
(31, 7, 'OFICINA DE TOXICOLOGIA', 'Q'),
(32, 7, 'OFICINA DE POLIGRAFIA', 'Q'),
(33, 8, 'UNIDAD DE CONTROL PRESUPUESTARIO Y FINNCIERO', 'Q'),
(34, 8, 'UNIDAD DE CONTABILIDAD', 'Q'),
(35, 8, 'UNIDAD DE RECURSOS HUMANOS', 'Q'),
(36, 8, 'UNIDAD DE CAPACITACION', 'Q'),
(37, 8, 'OFICINA DE PLANILLA', 'Q'),
(38, 8, 'UNIDAD DE TECNOLOG?AS DE INFORMACION ', 'Q'),
(39, 8, 'UNIDAD DE SERVICIOS LEGALES', 'Q'),
(40, 8, 'OFICINA DE COMPRAS ', 'Q'),
(41, 8, 'OFICINA DE BIENES', 'Q');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuario`
--

CREATE TABLE `tbl_usuario` (
  `usu_id` int(11) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `puesto_id` int(11) NOT NULL,
  `seccion_id` int(11) NOT NULL,
  `unidad_id` int(11) NOT NULL,
  `usu_usuario` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `usu_password` varchar(255) COLLATE utf8_spanish2_ci NOT NULL,
  `usu_nombre` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `usu_apellido` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `usu_identidad` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `usu_correo_i` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `usu_correo_p` varchar(150) COLLATE utf8_spanish2_ci NOT NULL,
  `usu_estado` enum('ACTIVO','INACTIVO','BLOQUEADO','VACACIONES','NUEVO') COLLATE utf8_spanish2_ci NOT NULL,
  `usu_celular` varchar(9) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `tbl_usuario`
--

INSERT INTO `tbl_usuario` (`usu_id`, `rol_id`, `puesto_id`, `seccion_id`, `unidad_id`, `usu_usuario`, `usu_password`, `usu_nombre`, `usu_apellido`, `usu_identidad`, `usu_correo_i`, `usu_correo_p`, `usu_estado`, `usu_celular`) VALUES
(1, 1, 39, 8, 38, 'aflores', 'ZEV5VVYwVEp1SkxnbGh4amJlOXE1dz09', 'ABNER ANTONIO', 'FLORES CERRANO', '0801199718412', 'aflores@didadpol.gob.hn', 'aaflorescerrano@gmail.com', 'ACTIVO', '33347223'),
(2, 2, 15, 5, 23, 'ecerrato', 'dGFPdTFZaFQrOTBxR1pNTStKb3BXZz09', 'DENNIS', 'SILVA', '0801555555555', 'ecerrato@didadpol.gob.hn', 'cerrato@gmail.com', 'NUEVO', '34558888'),
(3, 2, 15, 5, 23, 'jelvir', 'RERlZE1qL3NKQnlqbDJvRzFpTSt2Zz09', 'JUAN', 'CARLOS ELVIR', '0610198800425', 'jelvir@didadpol.gob.hn', 'jelvir@didadpol.gob.hh', 'NUEVO', '97898959'),
(4, 3, 13, 6, 26, 'gpalacios', 'VEdMSnRoWW42TGlveGFRK0gxbXpzZz09', 'GERARDO', 'PALACIOS', '0610198800411', 'gpalacios@didadpol.gob.hn', 'gpalacios@didadpol.gob.hn', 'NUEVO', '99998585');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_articulo`
--
ALTER TABLE `tbl_articulo`
  ADD PRIMARY KEY (`art_id`);

--
-- Indices de la tabla `tbl_bitacora`
--
ALTER TABLE `tbl_bitacora`
  ADD PRIMARY KEY (`bit_id`),
  ADD KEY `usu_id` (`usu_id`),
  ADD KEY `obj_id` (`obj_id`);

--
-- Indices de la tabla `tbl_depto`
--
ALTER TABLE `tbl_depto`
  ADD PRIMARY KEY (`depto_id`);

--
-- Indices de la tabla `tbl_est_proceso`
--
ALTER TABLE `tbl_est_proceso`
  ADD PRIMARY KEY (`est_proceso_id`);

--
-- Indices de la tabla `tbl_exp`
--
ALTER TABLE `tbl_exp`
  ADD PRIMARY KEY (`exp_id`),
  ADD KEY `investigador_id` (`investigador_id`),
  ADD KEY `rango_id` (`rango_id`),
  ADD KEY `tipo_falta_id` (`tipo_falta_id`),
  ADD KEY `est_proceso_id` (`est_proceso_id`),
  ADD KEY `depto_id` (`depto_id`),
  ADD KEY `municipio_id` (`municipio_id`),
  ADD KEY `genero_id` (`genero_id`);

--
-- Indices de la tabla `tbl_exp_art`
--
ALTER TABLE `tbl_exp_art`
  ADD PRIMARY KEY (`exp_art_id`),
  ADD KEY `exp_id` (`exp_id`),
  ADD KEY `art_id` (`art_id`);

--
-- Indices de la tabla `tbl_feriado`
--
ALTER TABLE `tbl_feriado`
  ADD PRIMARY KEY (`id_feriado`);

--
-- Indices de la tabla `tbl_genero`
--
ALTER TABLE `tbl_genero`
  ADD PRIMARY KEY (`genero_id`);

--
-- Indices de la tabla `tbl_municipio`
--
ALTER TABLE `tbl_municipio`
  ADD PRIMARY KEY (`municipio_id`),
  ADD KEY `depto_id` (`depto_id`);

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
-- Indices de la tabla `tbl_puesto`
--
ALTER TABLE `tbl_puesto`
  ADD PRIMARY KEY (`puesto_id`);

--
-- Indices de la tabla `tbl_rango`
--
ALTER TABLE `tbl_rango`
  ADD PRIMARY KEY (`rango_id`);

--
-- Indices de la tabla `tbl_rol`
--
ALTER TABLE `tbl_rol`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `tbl_seccion`
--
ALTER TABLE `tbl_seccion`
  ADD PRIMARY KEY (`seccion_id`);

--
-- Indices de la tabla `tbl_tipo_falta`
--
ALTER TABLE `tbl_tipo_falta`
  ADD PRIMARY KEY (`tipo_falta_id`);

--
-- Indices de la tabla `tbl_unidad`
--
ALTER TABLE `tbl_unidad`
  ADD PRIMARY KEY (`unidad_id`),
  ADD KEY `seccion_id` (`seccion_id`);

--
-- Indices de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD PRIMARY KEY (`usu_id`),
  ADD KEY `rol_id` (`rol_id`),
  ADD KEY `puesto_id` (`puesto_id`),
  ADD KEY `seccion_id` (`seccion_id`),
  ADD KEY `unidad_id` (`unidad_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_articulo`
--
ALTER TABLE `tbl_articulo`
  MODIFY `art_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT de la tabla `tbl_bitacora`
--
ALTER TABLE `tbl_bitacora`
  MODIFY `bit_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_depto`
--
ALTER TABLE `tbl_depto`
  MODIFY `depto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `tbl_est_proceso`
--
ALTER TABLE `tbl_est_proceso`
  MODIFY `est_proceso_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_exp`
--
ALTER TABLE `tbl_exp`
  MODIFY `exp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `tbl_exp_art`
--
ALTER TABLE `tbl_exp_art`
  MODIFY `exp_art_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `tbl_feriado`
--
ALTER TABLE `tbl_feriado`
  MODIFY `id_feriado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `tbl_genero`
--
ALTER TABLE `tbl_genero`
  MODIFY `genero_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `tbl_municipio`
--
ALTER TABLE `tbl_municipio`
  MODIFY `municipio_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=299;

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
-- AUTO_INCREMENT de la tabla `tbl_puesto`
--
ALTER TABLE `tbl_puesto`
  MODIFY `puesto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT de la tabla `tbl_rango`
--
ALTER TABLE `tbl_rango`
  MODIFY `rango_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `tbl_rol`
--
ALTER TABLE `tbl_rol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tbl_seccion`
--
ALTER TABLE `tbl_seccion`
  MODIFY `seccion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `tbl_tipo_falta`
--
ALTER TABLE `tbl_tipo_falta`
  MODIFY `tipo_falta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT de la tabla `tbl_unidad`
--
ALTER TABLE `tbl_unidad`
  MODIFY `unidad_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  MODIFY `usu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- Filtros para la tabla `tbl_exp`
--
ALTER TABLE `tbl_exp`
  ADD CONSTRAINT `tbl_exp_ibfk_2` FOREIGN KEY (`investigador_id`) REFERENCES `tbl_usuario` (`usu_id`),
  ADD CONSTRAINT `tbl_exp_ibfk_3` FOREIGN KEY (`rango_id`) REFERENCES `tbl_rango` (`rango_id`),
  ADD CONSTRAINT `tbl_exp_ibfk_4` FOREIGN KEY (`est_proceso_id`) REFERENCES `tbl_est_proceso` (`est_proceso_id`),
  ADD CONSTRAINT `tbl_exp_ibfk_5` FOREIGN KEY (`municipio_id`) REFERENCES `tbl_municipio` (`municipio_id`),
  ADD CONSTRAINT `tbl_exp_ibfk_6` FOREIGN KEY (`depto_id`) REFERENCES `tbl_depto` (`depto_id`),
  ADD CONSTRAINT `tbl_exp_ibfk_7` FOREIGN KEY (`genero_id`) REFERENCES `tbl_genero` (`genero_id`);

--
-- Filtros para la tabla `tbl_exp_art`
--
ALTER TABLE `tbl_exp_art`
  ADD CONSTRAINT `tbl_exp_art_ibfk_1` FOREIGN KEY (`exp_id`) REFERENCES `tbl_exp` (`exp_id`),
  ADD CONSTRAINT `tbl_exp_art_ibfk_2` FOREIGN KEY (`art_id`) REFERENCES `tbl_articulo` (`art_id`);

--
-- Filtros para la tabla `tbl_municipio`
--
ALTER TABLE `tbl_municipio`
  ADD CONSTRAINT `tbl_municipio_ibfk_1` FOREIGN KEY (`depto_id`) REFERENCES `tbl_depto` (`depto_id`);

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
-- Filtros para la tabla `tbl_unidad`
--
ALTER TABLE `tbl_unidad`
  ADD CONSTRAINT `tbl_unidad_ibfk_1` FOREIGN KEY (`seccion_id`) REFERENCES `tbl_seccion` (`seccion_id`);

--
-- Filtros para la tabla `tbl_usuario`
--
ALTER TABLE `tbl_usuario`
  ADD CONSTRAINT `tbl_usuario_ibfk_1` FOREIGN KEY (`rol_id`) REFERENCES `tbl_rol` (`rol_id`),
  ADD CONSTRAINT `tbl_usuario_ibfk_2` FOREIGN KEY (`seccion_id`) REFERENCES `tbl_seccion` (`seccion_id`),
  ADD CONSTRAINT `tbl_usuario_ibfk_3` FOREIGN KEY (`puesto_id`) REFERENCES `tbl_puesto` (`puesto_id`),
  ADD CONSTRAINT `tbl_usuario_ibfk_4` FOREIGN KEY (`unidad_id`) REFERENCES `tbl_unidad` (`unidad_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
