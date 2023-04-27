-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-04-2023 a las 20:32:57
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `juegos`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `generos`
--

CREATE TABLE `generos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `generos`
--

INSERT INTO `generos` (`id`, `nombre`) VALUES
(1, 'Aventuras'),
(2, 'Accion'),
(3, 'Plataformas'),
(4, 'Simulacion'),
(5, 'Rol');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `juegos`
--

CREATE TABLE `juegos` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `imagen` text NOT NULL,
  `tipo_imagen` varchar(10) NOT NULL,
  `descripcion` varchar(255) DEFAULT NULL,
  `url` varchar(80) NOT NULL,
  `id_genero` int(11) NOT NULL,
  `id_plataforma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `juegos`
--

INSERT INTO `juegos` (`id`, `nombre`, `imagen`, `tipo_imagen`, `descripcion`, `url`, `id_genero`, `id_plataforma`) VALUES
(1, 'The Legend of Zelda: Breath of the Wild', 'https://media.vandal.net/m/3-2020/20203218214135_1.jpg', '', 'Un juego de aventuras de mundo abierto en el que exploras el vasto mundo de Hyrule.', 'https://www.nintendo.com/games/detail/the-legend-of-zelda-breath-of-the-wild-swi', 1, 4),
(2, 'Super Mario Odyssey', 'https://img-eshop.cdn.nintendo.net/i/c42553b4fd0312c31e70ec7468c6c9bccd739f340152925b9600631f2d29f8b5.jpg', '', 'Un juego de plataformas en el que Mario viaja por diferentes reinos para salvar a la princesa Peach.', 'https://www.nintendo.com/games/detail/super-mario-odyssey-switch/', 3, 4),
(3, 'Animal Crossing: New Horizons', 'https://cloudfront-us-east-1.images.arcpublishing.com/infobae/5VJ74BHKU5BDVPGRYGDPLPD6XI.jpg', '', 'Un juego de simulación en el que vives en una isla desierta y construyes tu propio paraíso.', 'https://www.nintendo.com/games/detail/animal-crossing-new-horizons-switch/', 4, 4),
(4, 'Cyberpunk 2077', 'https://arc-anglerfish-arc2-prod-infobae.s3.amazonaws.com/public/EAT2VA3SYRF6NAV2ZXOXF3DZHQ.jpg', '', 'Un juego de rol de acción en primera persona en un mundo futurista donde puedes hacer lo que quieras.', 'https://www.cyberpunk.net/es/es/', 5, 1),
(5, 'Red Dead Redemption 2', 'https://compass-ssl.xbox.com/assets/64/02/6402981a-9446-46d8-8289-e370f3158746.jpg?n=Red-Dead-Redemption-II_GLP-Page-Hero-1084_1920x1080.jpg', '', 'Un juego de acción de mundo abierto en el salvaje oeste, donde controlas a un bandido llamado Arthur Morgan.', 'https://www.rockstargames.com/reddeadredemption2/es', 2, 1),
(6, 'The Witcher 3: Wild Hunt', 'https://media.vandal.net/master/3-2023/20233520343041_1.jpg', '', 'Un juego de rol de acción en tercera persona en el que juegas como Geralt de Rivia, un cazador de monstruos.', 'https://thewitcher.com/en/witcher3', 5, 1),
(7, 'God of War: Ragnarok', 'https://media.vandal.net/m/11-2022/202211218263381_1.jpg', '', 'Un juego de acción y aventuras en tercera persona en el que juegas como Kratos, un guerrero espartano que lucha contra los dioses.', 'https://www.playstation.com/es-es/games/god-of-war-ps4/', 2, 2),
(8, 'Horizon Zero Dawn', 'https://media.vandal.net/m/8-2020/20208518551383_1.jpg', '', 'Un juego de acción y aventuras en tercera persona en un mundo post-apocalíptico donde cazas máquinas para sobrevivir.', 'https://www.playstation.com/es-es/games/horizon-zero-dawn-ps4/', 1, 2),
(9, 'Spider Man', 'https://blog.latam.playstation.com/tachyon/sites/3/2022/06/35cad566eb5c0eb56188715723bbcb0c3d28982d.jpg', '', 'Un juego de acción en tercera persona en el que juegas como Peter Parker, el hombre araña, mientras luchas contra villanos de Nueva York. ', 'https://www.playstation.com/es-es/games/marvels-spider-man-ps4/', 2, 2),
(10, 'Demon\'s Souls', 'https://www.cinepremiere.com.mx/wp-content/uploads/2020/11/demon-s-souls.jpg', '', 'Un juego de rol de acción en tercera persona en el que luchas contra criaturas aterradoras en un mundo oscuro y peligroso.', 'https://www.playstation.com/es-es/games/demons-souls/', 5, 3),
(11, 'Ratchet & Clank: Una dimensión aparte', 'https://media.vandal.net/m/6-2021/20216216415454_1.jpg', '', 'Un juego de plataformas y acción en tercera persona en el que viajas entre diferentes dimensiones para salvar al universo.', 'https://www.playstation.com/es-es/games/ratchet-and-clank-rift-apart/', 3, 3),
(12, 'Returnal', 'https://culturageek.com.ar/wp-content/uploads/2022/12/ezgif-2-4119d57df4d6-fe9f.jpg', '', 'Un juego de acción en tercera persona en el que luchas contra enemigos en un planeta alienígena hostil.', 'https://www.playstation.com/es-es/games/returnal/', 2, 3),
(13, 'Halo Infinite', 'https://cloudfront-us-east-1.images.arcpublishing.com/infobae/ZYD6TYX3JFDBNIRXKHZ6SEBQFU.jpg', '', 'Un juego de acción en primera persona en el que luchas contra los alienígenas en un vasto universo de ciencia ficción.', 'https://www.xbox.com/es-ES/games/halo-infinite', 2, 5),
(14, 'Ori and the Will of the Wisps', 'https://locosxlosjuegos.com/wp-content/uploads/2020/03/Ori-and-the-Will-of-the-Wisps.png', '', 'Un juego de plataformas y aventuras en tercera persona en el que juegas como Ori, un pequeño espíritu que debe enfrentarse a diferentes desafíos en su búsqueda para salvar a su amigo.', 'https://www.xbox.com/es-ES/games/ori-will-of-the-wisps', 3, 5),
(15, 'Forza Horizon 4', 'https://store-images.s-microsoft.com/image/apps.65321.14343301090572358.2000000000007864118.569586ba-1cf6-47bd-b527-388324d91441', '', 'Un juego de simulación de carreras en el que puedes conducir por un mundo abierto en el Reino Unido.', 'https://www.xbox.com/es-ES/games/forza-horizon-4', 4, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plataformas`
--

CREATE TABLE `plataformas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Volcado de datos para la tabla `plataformas`
--

INSERT INTO `plataformas` (`id`, `nombre`) VALUES
(1, 'PC'),
(2, 'Playstation 4'),
(3, 'Playstation 5'),
(4, 'Nintendo Switch'),
(5, 'XBox S');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `generos`
--
ALTER TABLE `generos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_genero_idx` (`id_genero`),
  ADD KEY `fk_plataforma_idx` (`id_plataforma`);

--
-- Indices de la tabla `plataformas`
--
ALTER TABLE `plataformas`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `generos`
--
ALTER TABLE `generos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `juegos`
--
ALTER TABLE `juegos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `plataformas`
--
ALTER TABLE `plataformas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `juegos`
--
ALTER TABLE `juegos`
  ADD CONSTRAINT `fk_genero` FOREIGN KEY (`id_genero`) REFERENCES `generos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_plataforma` FOREIGN KEY (`id_plataforma`) REFERENCES `plataformas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
