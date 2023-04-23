-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-04-2023 a las 19:49:23
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
(1, 'The Legend of Zelda: Breath of the Wild', 'https://assets.nintendo.com/image/upload/ar_16:9,c_lpad,w_656/b_white/f_auto/q_auto/ncom/software/switch/70010000000025/7137262b5a64d921e193653f8aa0b722925abc5680380ca0e18a5cfd91697f58', '', 'Un juego de aventuras de mundo abierto en el que exploras el vasto mundo de Hyrule.', 'https://www.nintendo.com/games/detail/the-legend-of-zelda-breath-of-the-wild-swi', 1, 4),
(2, 'Super Mario Odyssey', 'https://assets.nintendo.com/image/upload/ar_16:9,c_lpad,w_656/b_white/f_auto/q_auto/ncom/software/switch/70010000001130/c42553b4fd0312c31e70ec7468c6c9bccd739f340152925b9600631f2d29f8b5', '', 'Un juego de plataformas en el que Mario viaja por diferentes reinos para salvar a la princesa Peach.', 'https://www.nintendo.com/games/detail/super-mario-odyssey-switch/', 3, 4),
(3, 'Animal Crossing: New Horizons', 'https://assets.nintendo.com/image/upload/ar_16:9,c_lpad,w_656/b_white/f_auto/q_auto/ncom/software/switch/70010000027619/9989957eae3a6b545194c42fec2071675c34aadacd65e6b33fdfe7b3b6a86c3a', '', 'Un juego de simulación en el que vives en una isla desierta y construyes tu propio paraíso.', 'https://www.nintendo.com/games/detail/animal-crossing-new-horizons-switch/', 4, 4),
(4, 'Cyberpunk 2077', 'https://i.blogs.es/ef9e7e/cyberpunk-2077-edgerunners/840_560.jpeg', '', 'Un juego de rol de acción en primera persona en un mundo futurista donde puedes hacer lo que quieras.', 'https://www.cyberpunk.net/es/es/', 5, 1),
(5, 'Red Dead Redemption 2', 'https://image.api.playstation.com/gs2-sec/appkgo/prod/CUSA08519_00/12/i_3da1cf7c41dc7652f9b639e1680d96436773658668c7dc3930c441291095713b/i/icon0.png', '', 'Un juego de acción de mundo abierto en el salvaje oeste, donde controlas a un bandido llamado Arthur Morgan.', 'https://www.rockstargames.com/reddeadredemption2/es', 2, 1),
(6, 'The Witcher 3: Wild Hunt', 'https://image.api.playstation.com/vulcan/ap/rnd/202211/0711/kh4MUIuMmHlktOHar3lVl6rY.png', '', 'Un juego de rol de acción en tercera persona en el que juegas como Geralt de Rivia, un cazador de monstruos.', 'https://thewitcher.com/en/witcher3', 5, 1),
(7, 'God of War', 'https://image.api.playstation.com/vulcan/ap/rnd/202207/1210/4xJ8XB3bi888QTLZYdl7Oi0s.png', '', 'Un juego de acción y aventuras en tercera persona en el que juegas como Kratos, un guerrero espartano que lucha contra los dioses.', 'https://www.playstation.com/es-es/games/god-of-war-ps4/', 2, 2),
(8, 'Horizon Zero Dawn', 'https://arsonyb2c.vtexassets.com/arquivos/ids/356841/Horizon-Zero-Dawn-2.jpg?v=637577175864000000', '', 'Un juego de acción y aventuras en tercera persona en un mundo post-apocalíptico donde cazas máquinas para sobrevivir.', 'https://www.playstation.com/es-es/games/horizon-zero-dawn-ps4/', 1, 2),
(9, 'Spider Man', 'https://image.api.playstation.com/vulcan/img/rnd/202011/0714/vuF88yWPSnDfmFJVTyNJpVwW.png', '', 'Un juego de acción en tercera persona en el que juegas como Peter Parker, el hombre araña, mientras luchas contra villanos de Nueva York. ', 'https://www.playstation.com/es-es/games/marvels-spider-man-ps4/', 2, 2),
(10, 'Demon\'s Souls', 'https://image.api.playstation.com/vulcan/img/rnd/202011/1717/GemRaOZaCMhGxQ9dRhnQQyT5.png', '', 'Un juego de rol de acción en tercera persona en el que luchas contra criaturas aterradoras en un mundo oscuro y peligroso.', 'https://www.playstation.com/es-es/games/demons-souls/', 5, 3),
(11, 'Ratchet & Clank: Una dimensión aparte', 'https://image.api.playstation.com/vulcan/ap/rnd/202101/2921/HMoV5LrlrOPvRvo0ASyQD4Es.jpg', '', 'Un juego de plataformas y acción en tercera persona en el que viajas entre diferentes dimensiones para salvar al universo.', 'https://www.playstation.com/es-es/games/ratchet-and-clank-rift-apart/', 3, 3),
(12, 'Returnal', 'https://image.api.playstation.com/vulcan/ap/rnd/202011/1621/4ItSbqJE88H019Ua3WBQKLF8.png', '', 'Un juego de acción en tercera persona en el que luchas contra enemigos en un planeta alienígena hostil.', 'https://www.playstation.com/es-es/games/returnal/', 2, 3),
(13, 'Halo Infinite', 'https://store-images.s-microsoft.com/image/apps.21536.13727851868390641.c9cc5f66-aff8-406c-af6b-440838730be0.68796bde-cbf5-4eaa-a299-011417041da6', '', 'Un juego de acción en primera persona en el que luchas contra los alienígenas en un vasto universo de ciencia ficción.', 'https://www.xbox.com/es-ES/games/halo-infinite', 2, 5),
(14, 'Ori and the Will of the Wisps', 'https://cdn.cloudflare.steamstatic.com/steam/apps/1057090/ss_332602f57287e62e4f5c9e661678e8761fabb44c.1920x1080.jpg?t=1667504225', '', 'Un juego de plataformas y aventuras en tercera persona en el que juegas como Ori, un pequeño espíritu que debe enfrentarse a diferentes desafíos en su búsqueda para salvar a su amigo.', 'https://www.xbox.com/es-ES/games/ori-will-of-the-wisps', 3, 5),
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
