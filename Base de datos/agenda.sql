-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-01-2017 a las 21:29:31
-- Versión del servidor: 10.1.16-MariaDB
-- Versión de PHP: 7.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `agenda`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(15) NOT NULL,
  `apellidos` varchar(30) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `telefono1` varchar(9) NOT NULL,
  `telefono2` varchar(9) DEFAULT NULL,
  `nick` varchar(15) NOT NULL,
  `pass` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `nombre`, `apellidos`, `direccion`, `telefono1`, `telefono2`, `nick`, `pass`) VALUES
(0, '', '', '', '', '', 'admin', 'admin'),
(1, 'Juan Carlos', 'PÃ©rez Merida', 'C/ Granada nÂº 15', '957347465', '', 'juan', 'juan'),
(2, 'JosÃ© E', 'LÃ³pez Primero', 'C/ AlmerÃ­a nÂº 67', '873647384', '675892745', 'jose', 'jose'),
(3, 'MarÃ­a', 'CastaÃ±o GarcÃ­a', 'C/ Madrid nÂº 54', '947567352', '', 'maria', 'maria'),
(4, 'Juan', 'Lozano', 'C/ Avenida', '958736423', '', 'juan2', 'juan2'),
(5, 'Enrique', 'CastaÃ±o GarcÃ­a', 'C/ Priego nÂº 15', '923347564', '', 'enrique', 'enrique'),
(6, 'Luisa', 'SÃ¡nchez Cruzado', 'C/ Fernandez 4, 4Âº E', '666784635', '', 'luisa', 'luisa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `id_cliente` int(11) NOT NULL,
  `id_servicio` int(11) NOT NULL,
  `lugar` varchar(30) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`id_cliente`, `id_servicio`, `lugar`, `fecha`, `hora`) VALUES
(1, 1, 'Granada', '2017-01-06', '21:45:00'),
(1, 2, 'Granada', '2016-12-16', '23:00:00'),
(1, 2, 'Granada', '2016-12-24', '23:00:00'),
(1, 4, 'Madrid', '2017-01-01', '22:00:00'),
(1, 4, 'Madrid', '2017-02-01', '22:00:00'),
(1, 4, 'Granada', '2017-02-24', '14:00:00'),
(1, 5, 'Madrid', '2017-02-01', '22:00:00'),
(2, 3, 'Granada', '2017-01-27', '20:00:00'),
(3, 3, 'Granada', '2017-01-28', '04:34:00'),
(3, 3, 'Priego', '2017-02-06', '23:30:00'),
(3, 4, 'AlmerÃ­a', '2017-02-24', '03:04:00'),
(3, 5, 'AlmerÃ­a', '2017-02-24', '23:50:00'),
(5, 1, 'Valencia', '2017-02-14', '21:30:00'),
(6, 4, 'Zaragoza', '2017-01-10', '03:04:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `id` int(11) NOT NULL,
  `titular` varchar(100) NOT NULL,
  `contenido` varchar(1000) NOT NULL,
  `imagen` varchar(100) NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`id`, `titular`, `contenido`, `imagen`, `fecha`) VALUES
(2, 'Granada Gaming', 'Â¡Ya tenemos cerca el Granada Gaming! Estate atento a todas las novedades en nuestra web.', '../../IMG/noticias/2.jpg', '2016-09-12'),
(3, 'FicZone', 'Â¿Has sacado ya tus entradas para el FicZone? Pues no te quedes atrÃ¡s y consÃ­guelas.', '../../IMG/noticias/3.jpg', '2016-12-15'),
(5, 'Locura en el botellÃ³n de Granada', 'El botellÃ³n de Granada se "desmadra" y tienen que acudir los cuerpos de seguridad para controlar a la gran cantidad de personas que acudieron este fin de semana al habitual encuentro. SegÃºn fuente oficiales: "los jovenes estaban comenzando a realizar actos bandalicos".', '../../IMG/noticias/5.jpg', '2016-12-05'),
(6, 'Carlos Jeans en Mae West', 'Siempre es un placer tener a los djs mÃ¡s representativos de la escena nacional en nuestra sala, y mÃ¡s cuando en este caso estamos hablado de alguien tan polifacÃ©tico como Carlos Jean, mÃºsico, Dj y productor conocido por todos por su espacio en el Hormiguero, el programa de Pablo Motos.\r\n\r\nPero Carlos Jean es mucho mÃ¡s. Su proyecto Najwajean junto a Najwa Nimri, distintas BSO, producciones para artistas como Alejandro Sanz, Miguel BosÃ©, Hombres G o Fangoria, varias veces nominado a Grammy Latino al Mejor Album, ganador de los premios Onda o Premio Goya a la Mejor CanciÃ³n, es un buen resumen del amplio bagaje de este artista en su mÃ¡s de 20 aÃ±os en la escena.', '../../IMG/noticias/6.jpg', '2016-12-16'),
(10, 'Boda de Felipe de BorbÃ³n y Letizia Ortiz', 'La boda real entre el entonces prÃ­ncipe Felipe de BorbÃ³n y Letizia Ortiz se celebrÃ³ en la catedral de la Almudena de Madrid el 22 de mayo de 2004, ante mÃ¡s de 1.200 invitados. Al acontecimiento asistieron representantes de 12 casas reales reinantes y otros 12 pertenecientes a casas reales no reinantes.1\r\n\r\nTuvo la consideraciÃ³n de boda de Estado, la primera en EspaÃ±a desde hacÃ­a mÃ¡s de 50 aÃ±os, y fue tambiÃ©n la primera boda en celebrarse en la catedral de Madrid, que habÃ­a sido consagrada en el aÃ±o 1993.', '../../IMG/noticias/10.jpg', '2016-12-30'),
(13, 'La Tarasca de Granada', 'ada miÃ©rcoles de feria, a media maÃ±ana, se desvela el mejor secreto guardado que existe en Granada: el vestido de la Tarasca. Y una cosa es segura: no faltarÃ¡ quien lo critique, sea como sea el vestido, da igual largo que corto, discreto o de colores vistosos, clÃ¡sico o moderno, atrevido o coqueto. No hay que olvidar el famoso dicho existente en la ciudad de que vas vestida peor que la Tarasca. A pesar de ello, para cualquier profesional granadino de la sastrerÃ­a o el diseÃ±o es un privilegio ser llamado para vestir a la maniquÃ­ mÃ¡s famosa que existe en la ciudad. Y es que bien podemos considerar a la Tarasca como la reina de estas fiestas, Â¿o no es ella la mujer mÃ¡s caracterÃ­stica del Corpus? SeÃ±ora de la fiesta y emperatriz de la diversiÃ³n, la Tarasca cada aÃ±o pasea por la ciudad sobre el lomo de un fiero dragÃ³n que parece quedar rendido a sus pies, y es que esta modelo de coquetas medidas se siente la estrella de la mÃ¡s afamada pasarela de la ciudad.', '../../IMG/noticias/13.jpg', '2016-10-10'),
(14, 'Conferencia PHP y JavaScript', 'En Escuela Arte Granada este fin de semana habrÃ¡ una conferencia sobre el uso de los lenguajes de programaciÃ³n PHP y JavaScript.', '../../IMG/noticias/14.jpg', '2017-01-24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int(20) UNSIGNED NOT NULL,
  `nombre` varchar(20) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `precio` double NOT NULL,
  `imagen` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `nombre`, `descripcion`, `precio`, `imagen`) VALUES
(1, 'Boda', 'Nuestro servicio de boda harÃ¡ que vuestro dÃ­a se convierta en algo mucho mÃ¡s especial.', 1000, '../../IMG/servicios/1.jpg'),
(2, 'DJ', 'Nuestro servicio de DJ harÃ¡ que sus fiestas se conviertan en la envidia del resto. Siempre con los mejores equipos de audio a su disposiciÃ³n y los mejores djs del mercado.', 900, '../../IMG/servicios/2.jpg'),
(3, 'Catering', 'El servicio de catering que le ofrecemos harÃ¡ que sus comensales quieran que usted vuelva a celebrar algo.', 1800, '../../IMG/servicios/3.jpg'),
(4, 'Baile', 'Â¿Le gusta el baile? Pues prepare sus piernas para una larga jornada de baile con los mejores grupos. Tenemos a su disposiciÃ³n distintos temas musicales que le harÃ¡n disfrutar.', 200, '../../IMG/servicios/4.jpg'),
(5, 'GuarderÃ­a', 'No se preocupe mÃ¡s por los mÃ¡s pequeÃ±os de la casa, Â¡ahora podrÃ¡ traerlos a cualquier fiesta con nuestro servicio de guarderÃ­a!', 100, '../../IMG/servicios/5.jpg');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id_cliente`,`id_servicio`,`fecha`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
