-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-07-2022 a las 19:10:29
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `void`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `comdel` (`idco` BIGINT(11))   BEGIN
		DELETE FROM comentario WHERE idcom=idco;
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `comiu` (`idco` BIGINT(11), `idus` BIGINT(11), `idin` BIGINT(11), `desco` TEXT, `fecco` DATETIME)   BEGIN
		IF NOT EXISTS(SELECT idcom FROM comentario WHERE idcom=idco) THEN
			INSERT INTO comentario(idcom, idusu, idinc, descom, feccom) 
			VALUES (idco, idus, idin, desco, fecco);
		ELSE
			UPDATE comentario
			SET idcom=idco, idusu=idus, idinc=idin, descom=desco, feccom=fecco
			WHERE idcom=idco;
		END IF;
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `domdel` (`iddo` BIGINT(11))   BEGIN
		DELETE FROM dominio 
		WHERE iddom=iddo;
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `domiu` (IN `iddo` BIGINT(11), IN `nomdo` VARCHAR(70), IN `pardo` VARCHAR(50))   BEGIN
		IF NOT EXISTS (SELECT iddom FROM dominio WHERE iddom=iddo) THEN
			INSERT INTO dominio(iddom,nomdom, pardom) 
			VALUES (iddo, nomdo, pardo);
		ELSE
			UPDATE dominio 
			SET nomdom=nomdo, pardom=pardo 
			WHERE iddom=iddo;
		END IF;
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `incdel` (IN `idin` BIGINT(11))   BEGIN
        DELETE FROM incidente WHERE idinc=idin;
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `inciu` (`idin` BIGINT(11), `idus` BIGINT(11), `feccr` DATETIME, `codub` BIGINT(11), `textin` TEXT, `imgin` VARCHAR(100), `tip` INT(5), `fechecre` DATETIME, `estad` INT(5), `la` FLOAT(10,6), `ln` FLOAT(10,6))   BEGIN
        IF NOT EXISTS(SELECT idinc FROM incidente WHERE idinc=idin)
        THEN
                INSERT INTO incidente (idinc, idusu, feccre, codubi, textinc, imginc, tipo, fechecrep, estado, lat, lng)
                VALUES (idin, idus, feccr, codub, textin, imgin, tip, fechecre, estad, la, ln);
        ELSE
                UPDATE incidente
                SET idusu=idus, codubi=codub, textinc=textin, imginc=imgin, tipo=tip, fechecrep=fechecre, estado=estad, lat= la, lng=ln
                WHERE idinc=idin;
        END IF;
        END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pagdel` (`pagi` BIGINT(11))   BEGIN
		DELETE FROM pagina WHERE pagid=pagi;
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pagiu` (IN `pagi` BIGINT(11), IN `pagno` VARCHAR(40), IN `pagar` VARCHAR(100), IN `pagmo` INT(3), IN `pagor` INT(3), IN `pagme` VARCHAR(30), IN `icon` VARCHAR(255))   BEGIN
		IF NOT EXISTS(SELECT pagid FROM pagina WHERE pagid=pagi) THEN
			INSERT INTO pagina(pagid,pagnom,pagarc,pagmos,pagord,pagmen,icono) VALUES
			(pagi,pagno,pagar,pagmo,pagor,pagme,icon);
		ELSE
			UPDATE pagina
			SET pagnom=pagno, pagarc=pagar,pagmos=pagmo, pagord=pagor, 
			pagmen=pagme, icono=icon
			WHERE pagid=pagi;
		END IF;
	
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pefdel` (`pefi` BIGINT(11))   BEGIN
		DELETE FROM perfil 
		WHERE pefid=pefi;
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pefiu` (IN `pefi` BIGINT(11), IN `pefno` VARCHAR(50), IN `pagpri` BIGINT(11))   BEGIN
		IF NOT EXISTS (SELECT pefid FROM perfil WHERE pefid=pefi) THEN
			INSERT INTO perfil(pefid, pefnom, pagprin) VALUES (pefi, pefno, pagpri);
		ELSE
			UPDATE perfil SET pefnom=pefno, pagprin=pagpri WHERE pefid=pefi;
		END IF;
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ubidel` (`codub` BIGINT(11))   BEGIN
		DELETE FROM ubicacion WHERE codubi=codub;
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ubiiu` (`codub` BIGINT(11), `nomub` VARCHAR(30), `depub` BIGINT(11))   BEGIN
		IF NOT EXISTS(SELECT codubi FROM ubicacion WHERE codubi=codub) THEN
			INSERT INTO ubicacion(codubi, nomubi, depubi) 
			VALUES (codub, nomub, depub);
		ELSE
			UPDATE ubicacion 
			SET codubi=codub, nomubi=nomub, depubi=depub
			WHERE codubi=codub;
		END IF;
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usudel` (`idus` BIGINT(11))   BEGIN
		DELETE FROM usuario WHERE idusu=idus;
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `usuiu` (IN `idus` BIGINT(11), IN `nomus` VARCHAR(50), IN `apeus` VARCHAR(50), IN `pefi` BIGINT(11), IN `dirus` VARCHAR(100), IN `telus` VARCHAR(10), IN `codub` BIGINT(11), IN `emaus` VARCHAR(100), IN `pasus` VARCHAR(100), IN `sex` INT(5), IN `imgu` VARCHAR(120), IN `actus` TINYINT(1))   BEGIN
		IF NOT EXISTS(SELECT idusu FROM usuario WHERE idusu=idus) THEN
			INSERT INTO usuario(idusu, nomusu, apeusu, pefid, dirusu, telusu, codubi, emausu, pasusu, sexo, imgus, actusu) 
			VALUES (idus, nomus, apeus, pefi, dirus, telus, codub, emaus, pasus, sex, imgu, actus);
		ELSE
			UPDATE usuario
			SET idusu=idus, nomusu=nomus, apeusu=apeus, pefid=pefi, dirusu=dirus, telusu=telus, codubi=codub, emausu=emaus, pasusu=pasus, sexo=sex, imgus=imgu
			WHERE idusu=idus;
		END IF;
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `valdel` (`codva` INT(5))   BEGIN
		DELETE FROM valor WHERE codval=codva;
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `valiu` (IN `codva` INT(5), IN `iddo` BIGINT(11), IN `nomva` VARCHAR(60), IN `parva` VARCHAR(100))   BEGIN
              IF NOT EXISTS(SELECT codval FROM valor WHERE codval=codva) THEN
                  INSERT INTO valor(codval,iddom, nomval, parval) VALUES
                  (codva, iddo, nomva, parva);
              ELSE
                  UPDATE valor
                  SET iddom=iddo, nomval=nomva, parval=parva
                  WHERE codval=codva;
              END IF;
     END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dominio`
--

CREATE TABLE `dominio` (
  `iddom` bigint(11) NOT NULL,
  `nomdom` varchar(70) DEFAULT NULL,
  `pardom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `dominio`
--

INSERT INTO `dominio` (`iddom`, `nomdom`, `pardom`) VALUES
(1, 'Sexo', ''),
(2, 'Estado', ''),
(3, 'Tipo de incidente', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagina`
--

CREATE TABLE `pagina` (
  `pagid` bigint(11) NOT NULL,
  `pagnom` varchar(40) DEFAULT NULL,
  `pagarc` varchar(100) DEFAULT NULL,
  `pagmos` int(3) DEFAULT NULL,
  `pagord` int(3) NOT NULL,
  `pagmen` varchar(30) NOT NULL,
  `icono` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pagina`
--

INSERT INTO `pagina` (`pagid`, `pagnom`, `pagarc`, `pagmos`, `pagord`, `pagmen`, `icono`) VALUES
(302, 'PÃ¡gina', 'view/vpag.php', 1, 14, 'Home', 'uil-home-alt'),
(303, 'Perfil', 'vista/vpef.php', 1, 13, 'Home', 'uil-home-alt'),
(304, 'ConfiguraciÃ³n', 'vista/vcon.php', 2, 11, 'Home', 'uil-home-alt'),
(305, 'Datos personales', 'vista/vusu.php', 1, 12, 'Home', 'uil-home-alt'),
(306, 'Ventas', 'vista/vcom.php', 1, 4, 'Home', 'uil-home-alt'),
(307, 'Inventario', 'vista/vinc.php', 1, 3, 'Home', 'uil-home-alt'),
(308, 'Valor', 'vista/vval.php', 1, 16, 'Home', 'uil-home-alt'),
(309, 'Dominio', 'view/vdom.php', 1, 15, 'Home', 'uil-home-alt'),
(310, 'UbicaciÃ³n', 'vista/vubi.php', 1, 17, 'Home', 'uil-home-alt'),
(314, 'Productos', 'vista/vdusu.php', 1, 5, 'Home', 'uil-home-alt'),
(315, 'Estadisticas', 'vista/vest.php', 1, 7, 'Home', 'uil-home-alt'),
(316, 'Graficos', 'vista/vgraf.php', 1, 6, 'Home', 'uil-home-alt'),
(1001, 'Roles', 'view/vprofile.php', 1, 2, 'Home', 'uil-home-alt'),
(1067, 'Servicios', '#Espacio', 1, 1, 'Home', 'uil-home-alt'),
(1068, 'CONFIGURACIÃ“N', '#Espacio', 1, 21, 'Home', NULL),
(1069, 'Otros', '#Espacio', 1, 20, 'Home', 'uil-home-alt'),
(1070, 'SALIR', 'view/vsal.php', 1, 30, 'Home', 'uil-home-alt');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagper`
--

CREATE TABLE `pagper` (
  `pagid` bigint(11) NOT NULL,
  `pefid` bigint(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pagper`
--

INSERT INTO `pagper` (`pagid`, `pefid`) VALUES
(1067, 3),
(307, 3),
(306, 3),
(314, 3),
(1069, 3),
(1070, 3),
(316, 2),
(1067, 2),
(314, 2),
(1068, 2),
(305, 2),
(315, 2),
(308, 2),
(310, 2),
(1069, 2),
(1070, 2),
(1067, 1),
(307, 1),
(306, 1),
(314, 1),
(316, 1),
(315, 1),
(1068, 1),
(305, 1),
(303, 1),
(302, 1),
(309, 1),
(308, 1),
(310, 1),
(1069, 1),
(1070, 1),
(1001, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perfil`
--

CREATE TABLE `perfil` (
  `pefid` bigint(11) NOT NULL,
  `pefnom` varchar(50) DEFAULT NULL,
  `pagprin` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `perfil`
--

INSERT INTO `perfil` (`pefid`, `pefnom`, `pagprin`) VALUES
(1, 'Administrador', 1001),
(2, 'EnteSeg', 1001),
(3, 'Usuario', 1001),
(4, '23', 1001),
(5, 'Vendedor', 1001);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ubicacion`
--

CREATE TABLE `ubicacion` (
  `codubi` bigint(11) NOT NULL,
  `nomubi` varchar(30) NOT NULL,
  `depubi` bigint(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ubicacion`
--

INSERT INTO `ubicacion` (`codubi`, `nomubi`, `depubi`) VALUES
(5, 'ANTIOQUIA', 0),
(8, 'ATLANTICO', 0),
(11, 'BOGOTÃ D.C.', 0),
(13, 'BOLIVAR', 0),
(15, 'BOYACA', 0),
(17, 'CALDAS', 0),
(18, 'CAQUETA', 0),
(19, 'CAUCA', 0),
(20, 'CESAR', 0),
(23, 'CORDOBA', 0),
(25, 'CUNDINAMARCA', 0),
(27, 'CHOCO', 0),
(41, 'HUILA', 0),
(44, 'LA GUAJIRA', 0),
(47, 'MAGDALENA', 0),
(50, 'META', 0),
(52, 'NARIÃ‘O', 0),
(54, 'NORTE DE SANTANDER', 0),
(63, 'QUINDIO', 0),
(66, 'RISALDA', 0),
(68, 'SANTANDER', 0),
(70, 'SUCRE', 0),
(73, 'TOLIMA', 0),
(76, 'VALLE', 0),
(81, 'ARAUCA', 0),
(85, 'CASANARE', 0),
(86, 'PUTUMAYO', 0),
(88, 'SAN ANDRES Y PROVIDE', 0),
(91, 'AMAZONAS', 0),
(94, 'GUAINIA', 0),
(97, 'VAUPES', 0),
(99, 'VICHADA', 0),
(5001, 'Medellin', 5),
(5002, 'Abejorral', 5),
(5004, 'Abriaqui', 5),
(5021, 'Alejandria', 5),
(5030, 'Amaga', 5),
(5031, 'Amalfi', 5),
(5034, 'Andes', 5),
(5036, 'Angelopolis', 5),
(5038, 'Angostura', 5),
(5040, 'Anori', 5),
(5042, 'Antioquia', 5),
(5044, 'Anza', 5),
(5045, 'Apartado', 5),
(5051, 'Arboletes', 5),
(5055, 'Argelia', 5),
(5059, 'Armenia', 5),
(5079, 'Barbosa', 5),
(5086, 'Belmira', 5),
(5088, 'Bello', 5),
(5091, 'Betania', 5),
(5093, 'Betulia', 5),
(5101, 'Bolivar', 5),
(5107, 'Briceno', 5),
(5113, 'Buritica', 5),
(5120, 'Caceres', 5),
(5125, 'Caicedo', 5),
(5129, 'Caldas', 5),
(5134, 'Campamento', 5),
(5138, 'CaÃ±asgordas', 5),
(5142, 'Caracoli', 5),
(5145, 'Caramanta', 5),
(5147, 'Carepa', 5),
(5148, 'Carmen de Viboral', 5),
(5150, 'Carolina', 5),
(5154, 'Caucasia', 5),
(5172, 'Chigorodo', 5),
(5190, 'Cisneros', 5),
(5197, 'Cocorna', 5),
(5206, 'Concepcion', 5),
(5209, 'Concordia', 5),
(5212, 'Copacabana', 5),
(5234, 'Dabeiba', 5),
(5237, 'Don Matias', 5),
(5240, 'Ebejico', 5),
(5250, 'El Bagre', 5),
(5264, 'Entrerrios', 5),
(5266, 'Envigado', 5),
(5282, 'Fredonia', 5),
(5284, 'Frontino', 5),
(5306, 'Giraldo', 5),
(5308, 'Girardota', 5),
(5310, 'Gomez Plata', 5),
(5313, 'Granada', 5),
(5315, 'Guadalupe', 5),
(5318, 'Guarne', 5),
(5321, 'Guatape', 5),
(5347, 'Heliconia', 5),
(5353, 'Hispania', 5),
(5360, 'Itagui', 5),
(5361, 'Ituango', 5),
(5364, 'Jardin', 5),
(5368, 'Jerico', 5),
(5376, 'La Ceja', 5),
(5380, 'La Estrella', 5),
(5390, 'La Pintada', 5),
(5400, 'La Union', 5),
(5411, 'Liborina', 5),
(5425, 'Maceo', 5),
(5440, 'Marinilla', 5),
(5467, 'Montebello', 5),
(5475, 'Murindo', 5),
(5480, 'Mutata', 5),
(5483, 'NariÃ±o', 5),
(5490, 'Necocli', 5),
(5495, 'Nechi', 5),
(5501, 'Olaya', 5),
(5541, 'PeÃ±ol', 5),
(5543, 'Peque', 5),
(5576, 'Pueblorrico', 5),
(5579, 'Puerto Berrio', 5),
(5585, 'Puerto Nare (La Magd', 5),
(5591, 'Puerto Triunfo', 5),
(5604, 'Remedios', 5),
(5607, 'Retiro', 5),
(5615, 'Rionegro', 5),
(5628, 'Sabanalarga', 5),
(5631, 'Sabaneta', 5),
(5642, 'Salgar', 5),
(5647, 'San Andres', 5),
(5649, 'San Carlos', 5),
(5652, 'San Francisco', 5),
(5656, 'San Jeronimo', 5),
(5658, 'San Jose de la Monta', 5),
(5659, 'San Juan de Uraba', 5),
(5660, 'San Luis', 5),
(5664, 'San Pedro', 5),
(5665, 'San Pedro de Uraba', 5),
(5667, 'San Rafael', 5),
(5670, 'San Roque', 5),
(5674, 'San Vicente', 5),
(5679, 'Santa Barbara', 5),
(5686, 'Santa Rosa de Osos', 5),
(5690, 'Santo Domingo', 5),
(5697, 'Santuario', 5),
(5736, 'Segovia', 5),
(5756, 'Sonson', 5),
(5761, 'Sopetran', 5),
(5789, 'Tamesis', 5),
(5790, 'Taraza', 5),
(5792, 'Tarso', 5),
(5809, 'Titiribi', 5),
(5819, 'Toledo', 5),
(5837, 'Turbo', 5),
(5842, 'Uramita', 5),
(5847, 'Urrao', 5),
(5854, 'Valdivia', 5),
(5856, 'Valparaiso', 5),
(5858, 'Vegachi', 5),
(5861, 'Venecia', 5),
(5873, 'Vigia del Fuerte', 5),
(5885, 'Yali', 5),
(5887, 'Yarumal', 5),
(5890, 'Yolombo', 5),
(5893, 'Yondo (Casabe)', 5),
(5895, 'Zaragoza', 5),
(8001, 'Barranquilla', 8),
(8078, 'Baranoa', 8),
(8137, 'Campo de la Cruz', 8),
(8141, 'Candelaria', 8),
(8296, 'Galapa', 8),
(8372, 'Juan de Acosta', 8),
(8421, 'Luruaco', 8),
(8433, 'Malambo', 8),
(8436, 'Manati', 8),
(8520, 'Palmar de Varela', 8),
(8549, 'Piojo', 8),
(8558, 'Polo Nuevo', 8),
(8560, 'Ponedera', 8),
(8573, 'Puerto Colombia', 8),
(8606, 'Repelon', 8),
(8634, 'Sabanagrande', 8),
(8638, 'Sabanalarga', 8),
(8675, 'Santa Lucia', 8),
(8685, 'Santo Tomas', 8),
(8758, 'Soledad', 8),
(8770, 'Suan', 8),
(8832, 'Tubara', 8),
(8849, 'Usiacuri', 8),
(9001, 'Barranquilla', 9),
(11001, 'Bogota', 11),
(13006, 'Achi', 13),
(13030, 'Altos del Rosario', 13),
(13042, 'Arenal', 13),
(13052, 'Arjona', 13),
(13062, 'Arroyohondo', 13),
(13074, 'Barranco de Loba', 13),
(13140, 'Calamar', 13),
(13160, 'Cantagallo', 13),
(13188, 'Cicuco', 13),
(13212, 'Cordoba', 13),
(13222, 'Clemencia', 13),
(13244, 'El Carmen de Bolivar', 13),
(13248, 'El Guamo', 13),
(13268, 'El PeÃ±on', 13),
(13300, 'Hatillo de Loba', 13),
(13430, 'Magangue', 13),
(13433, 'Mahates', 13),
(13440, 'Margarita', 13),
(13442, 'Maria La Baja', 13),
(13458, 'Montecristo', 13),
(13468, 'Mompos', 13),
(13473, 'Morales', 13),
(13549, 'Pinillos', 13),
(13580, 'Regidor', 13),
(13600, 'Rio Viejo', 13),
(13620, 'San Cristobal', 13),
(13647, 'San Estanislao', 13),
(13650, 'San Fernando', 13),
(13654, 'San Jacinto', 13),
(13655, 'San Jacinto del Cauc', 13),
(13657, 'San Juan Nepomuceno', 13),
(13667, 'San Martin de Loba', 13),
(13670, 'San Pablo', 13),
(13673, 'Santa Catalina', 13),
(13683, 'Santa Rosa', 13),
(13688, 'Santa Rosa del Sur', 13),
(13744, 'Simiti', 13),
(13760, 'Soplaviento', 13),
(13780, 'Talaigua NUevo', 13),
(13810, 'Tiquisio (Puerto Ric', 13),
(13836, 'Turbaco', 13),
(13838, 'Turbana', 13),
(13873, 'Villanueva', 13),
(13894, 'Zambrano', 13),
(14001, 'Cartagena', 14),
(15001, 'Tunja', 15),
(15022, 'Almeida', 15),
(15047, 'Aquitania', 15),
(15051, 'Arcabuco', 15),
(15087, 'Belen', 15),
(15090, 'Berbeo', 15),
(15092, 'Beteitiva', 15),
(15097, 'Boavita', 15),
(15104, 'Boyaca', 15),
(15106, 'Briceno', 15),
(15109, 'Buenavista', 15),
(15114, 'Busbanza', 15),
(15131, 'Caldas', 15),
(15135, 'Campohermoso', 15),
(15162, 'Cerinza', 15),
(15172, 'Chinavita', 15),
(15176, 'Chiquinquira', 15),
(15180, 'Chiscas', 15),
(15183, 'Chita', 15),
(15185, 'Chitaraque', 15),
(15187, 'Chivata', 15),
(15189, 'Cienega', 15),
(15204, 'Combita', 15),
(15212, 'Coper', 15),
(15215, 'Corrales', 15),
(15218, 'Covarachia', 15),
(15223, 'Cubara', 15),
(15224, 'Cucaita', 15),
(15226, 'Cuitiva', 15),
(15232, 'Chiquiza', 15),
(15236, 'Chivor', 15),
(15238, 'Duitama', 15),
(15244, 'El Cocuy', 15),
(15248, 'El Espino', 15),
(15272, 'Firavitoba', 15),
(15276, 'Floresta', 15),
(15293, 'Gachantiva', 15),
(15296, 'Gameza', 15),
(15299, 'Garagoa', 15),
(15317, 'Guacamayas', 15),
(15322, 'Guateque', 15),
(15325, 'Guayata', 15),
(15332, 'Guican', 15),
(15362, 'Iza', 15),
(15367, 'Jenesano', 15),
(15368, 'Jerico', 15),
(15377, 'Labranzagrande', 15),
(15380, 'La Capilla', 15),
(15401, 'La Victoria', 15),
(15403, 'La Uvita', 15),
(15407, 'VIlla de Leyva', 15),
(15425, 'Macanal', 15),
(15442, 'Maripi', 15),
(15455, 'Miraflores', 15),
(15464, 'Mongua', 15),
(15466, 'Mongui', 15),
(15469, 'Moniquira', 15),
(15476, 'Motavita', 15),
(15480, 'Muzo', 15),
(15491, 'Nobsa', 15),
(15494, 'Nuevo Colon', 15),
(15500, 'Oicata', 15),
(15507, 'Otanche', 15),
(15511, 'Pachavita', 15),
(15514, 'Paez', 15),
(15516, 'Paipa', 15),
(15518, 'Pajarito', 15),
(15522, 'Panqueba', 15),
(15531, 'Pauna', 15),
(15533, 'Paya', 15),
(15537, 'Paz de Rio', 15),
(15542, 'Pesca', 15),
(15550, 'Pisba', 15),
(15572, 'Puerto Boyaca', 15),
(15580, 'Quipama', 15),
(15599, 'Ramiriqui', 15),
(15600, 'Raquira', 15),
(15621, 'Rondon', 15),
(15632, 'Saboya', 15),
(15638, 'Sachica', 15),
(15646, 'Samaca', 15),
(15660, 'San Eduardo', 15),
(15664, 'San Jose de Pare', 15),
(15667, 'San Luis de Gaceno', 15),
(15673, 'San Mateo', 15),
(15676, 'San Miguel de Sema', 15),
(15681, 'San Pablo de Borbur', 15),
(15686, 'Santana', 15),
(15690, 'Santa Maria', 15),
(15693, 'Santa Rosa de Viterb', 15),
(15696, 'Santa Sofia', 15),
(15720, 'Sativanorte', 15),
(15723, 'Sativasur', 15),
(15740, 'Siachoque', 15),
(15753, 'Soata', 15),
(15755, 'Socota', 15),
(15757, 'Socha', 15),
(15759, 'Sogamoso', 15),
(15761, 'Somondoco', 15),
(15762, 'Sora', 15),
(15763, 'Sotaquira', 15),
(15764, 'Soraca', 15),
(15774, 'Susacon', 15),
(15776, 'Sutamarchan', 15),
(15778, 'Sutatenza', 15),
(15790, 'Tasco', 15),
(15798, 'Tenza', 15),
(15804, 'Tibana', 15),
(15806, 'Tibasosa', 15),
(15808, 'Tinjaca', 15),
(15810, 'Tipacoque', 15),
(15814, 'Toca', 15),
(15816, 'Togui', 15),
(15820, 'Topaga', 15),
(15822, 'Tota', 15),
(15832, 'Tunungua', 15),
(15835, 'Turmeque', 15),
(15837, 'Tuta', 15),
(15839, 'Tutaza', 15),
(15842, 'Umbita', 15),
(15861, 'Ventaquemada', 15),
(15879, 'Viracacha', 15),
(15897, 'Zetaquira', 15),
(17001, 'Manizales', 17),
(17013, 'Aguadas', 17),
(17042, 'Anserma', 17),
(17050, 'Aranzazu', 17),
(17088, 'Belalcazar', 17),
(17174, 'Chinchina', 17),
(17272, 'Filadelfia', 17),
(17380, 'La Dorada', 17),
(17388, 'La Merced', 17),
(17433, 'Manzanares', 17),
(17442, 'Marmato', 17),
(17444, 'Marquetalia', 17),
(17446, 'Marulanda', 17),
(17486, 'Neira', 17),
(17495, 'Norcasia', 17),
(17513, 'Pacora', 17),
(17524, 'Palestina', 17),
(17541, 'Pensilvania', 17),
(17614, 'Riosucio', 17),
(17616, 'Risaralda', 17),
(17653, 'Salamina', 17),
(17662, 'Samana', 17),
(17665, 'San Jose', 17),
(17777, 'Supia', 17),
(17867, 'Victoria', 17),
(17873, 'Villamaria', 17),
(17877, 'Viterbo', 17),
(18001, 'Florencia', 18),
(18029, 'Albania', 18),
(18094, 'Belen de los Andaqui', 18),
(18150, 'Cartagena del Chaira', 18),
(18205, 'Curillo', 18),
(18247, 'El Doncello', 18),
(18256, 'El Paujil', 18),
(18410, 'La Montanita', 18),
(18460, 'Milan', 18),
(18479, 'Morelia', 18),
(18592, 'Puerto Rico', 18),
(18610, 'San Jose del Fragua', 18),
(18753, 'San Vicente del Cagu', 18),
(18756, 'Solano', 18),
(18785, 'Solita', 18),
(18860, 'Valparaiso', 18),
(19001, 'Popayan', 19),
(19022, 'Almaguer', 19),
(19050, 'Argelia', 19),
(19075, 'Balboa', 19),
(19100, 'Bolivar', 19),
(19110, 'Buenos Aires', 19),
(19130, 'Cajibio', 19),
(19137, 'Caldono', 19),
(19142, 'Caloto', 19),
(19212, 'Corinto', 19),
(19256, 'El Tambo', 19),
(19290, 'Florencia', 19),
(19318, 'Guapi', 19),
(19355, 'Inza', 19),
(19364, 'Jambalo', 19),
(19392, 'La Sierra', 19),
(19397, 'La Vega', 19),
(19418, 'Lopez (Micay)', 19),
(19450, 'Mercaderes', 19),
(19455, 'Miranda', 19),
(19473, 'Morales', 19),
(19513, 'Padilla', 19),
(19517, 'Paez', 19),
(19532, 'Patia (EL Bordo)', 19),
(19533, 'Piamonte', 19),
(19548, 'Piendamo', 19),
(19573, 'Puerto Tejada', 19),
(19585, 'Purace', 19),
(19622, 'Rosas', 19),
(19693, 'San Sebastian', 19),
(19698, 'Santander de Quilich', 19),
(19701, 'Santa Rosa', 19),
(19743, 'Silvia', 19),
(19760, 'Sotara', 19),
(19780, 'Suarez', 19),
(19785, 'Sucre', 19),
(19807, 'Timbio', 19),
(19809, 'Timbiqui', 19),
(19821, 'Toribio', 19),
(19824, 'ToToro', 19),
(19845, 'Villarica', 19),
(20001, 'Valledupar', 20),
(20011, 'Aguachica', 20),
(20013, 'Agustin Codazzi', 20),
(20032, 'Astrea', 20),
(20045, 'Becerril', 20),
(20060, 'Bosconia', 20),
(20175, 'Chimichagua', 20),
(20178, 'Chiriguana', 20),
(20228, 'Curumani', 20),
(20238, 'El Copey', 20),
(20250, 'El Paso', 20),
(20295, 'Gamarra', 20),
(20310, 'Gonzalez', 20),
(20383, 'La Gloria', 20),
(20400, 'La Jagua de Ibirico', 20),
(20443, 'Manaure Balcon del C', 20),
(20517, 'Pailitas', 20),
(20550, 'Pelaya', 20),
(20570, 'Pueblo Bello', 20),
(20614, 'Rio de Oro', 20),
(20621, 'Robles (La Paz)', 20),
(20710, 'San Alberto', 20),
(20750, 'San Diego', 20),
(20770, 'San Martin', 20),
(20787, 'Tamalameque', 20),
(23001, 'Monteria', 23),
(23068, 'Ayapel', 23),
(23079, 'Buenavista', 23),
(23090, 'Canalete', 23),
(23162, 'Cerete', 23),
(23168, 'Chima', 23),
(23182, 'Chinu', 23),
(23189, 'Cienaga de Oro', 23),
(23300, 'Cotorra', 23),
(23350, 'La Apartada', 23),
(23417, 'Lorica', 23),
(23419, 'Los Cordobas', 23),
(23464, 'Momil', 23),
(23466, 'Montelibano', 23),
(23500, 'MoÃ±itos', 23),
(23555, 'Planeta Rica', 23),
(23570, 'Pueblo Nuevo', 23),
(23574, 'Puerto Escondido', 23),
(23580, 'Puerto Libertador', 23),
(23586, 'Purisima', 23),
(23660, 'Sahagun', 23),
(23670, 'San Andres Sotavento', 23),
(23672, 'San Antero', 23),
(23675, 'San Bernardo del Vie', 23),
(23678, 'San Carlos', 23),
(23686, 'San Pelayo', 23),
(23807, 'Tierralta', 23),
(23855, 'Valencia', 23),
(25001, 'Agua de Dios', 25),
(25019, 'Alban', 25),
(25035, 'Anapoima', 25),
(25040, 'Anolaima', 25),
(25053, 'Arbelaez', 25),
(25086, 'Beltran', 25),
(25095, 'Bituima', 25),
(25099, 'Bojaca', 25),
(25120, 'Cabrera', 25),
(25123, 'Cachipay', 25),
(25126, 'CajicÃ¡', 25),
(25148, 'Caparrapi', 25),
(25151, 'Caqueza', 25),
(25154, 'Carmen de Carupa', 25),
(25168, 'Chaguani', 25),
(25175, 'ChÃ­a', 25),
(25178, 'Chipaque', 25),
(25181, 'Choachi', 25),
(25183, 'Choconta', 25),
(25200, 'Cogua', 25),
(25214, 'Cota', 25),
(25224, 'Cucunuba', 25),
(25245, 'El Colegio', 25),
(25258, 'El PeÃ±on', 25),
(25260, 'El Rosal', 25),
(25269, 'Facatativa', 25),
(25279, 'Fomeque', 25),
(25281, 'Fosca', 25),
(25286, 'Funza', 25),
(25288, 'Fuquene', 25),
(25290, 'Fusagasuga', 25),
(25293, 'Gachala', 25),
(25295, 'Gachancipa', 25),
(25297, 'Gacheta', 25),
(25299, 'Gama', 25),
(25307, 'Girardot', 25),
(25312, 'Granada', 25),
(25317, 'Guacheta', 25),
(25320, 'Guaduas', 25),
(25322, 'Guasca', 25),
(25324, 'Guataqui', 25),
(25326, 'Guatavita', 25),
(25328, 'Guayabal de Siquima', 25),
(25335, 'Guayabetal', 25),
(25339, 'Gutierrez', 25),
(25368, 'Jerusalen', 25),
(25372, 'Junin', 25),
(25377, 'La Calera', 25),
(25386, 'La Mesa', 25),
(25394, 'La Palma', 25),
(25398, 'La PeÃ±a', 25),
(25402, 'La Vega', 25),
(25407, 'Lenguazaque', 25),
(25426, 'Macheta', 25),
(25430, 'Madrid', 25),
(25436, 'Manta', 25),
(25438, 'Medina', 25),
(25473, 'Mosquera', 25),
(25483, 'NariÃ±o', 25),
(25486, 'Nemocon', 25),
(25488, 'Nilo', 25),
(25489, 'Nimaima', 25),
(25491, 'Nocaima', 25),
(25506, 'Ospina Perez (Veneci', 25),
(25513, 'Pacho', 25),
(25518, 'Paime', 25),
(25524, 'Pandi', 25),
(25530, 'Paratebueno', 25),
(25535, 'Pasca', 25),
(25572, 'Puerto Salgar', 25),
(25580, 'Puli', 25),
(25592, 'Quebradanegra', 25),
(25594, 'Quetame', 25),
(25596, 'Quipile', 25),
(25599, 'Rafael Reyes (Apulo)', 25),
(25612, 'Ricaurte', 25),
(25645, 'San Antonio de Teque', 25),
(25649, 'San Bernardo', 25),
(25653, 'San Cayetano', 25),
(25658, 'San Francisco', 25),
(25662, 'San Juan de Rio Seco', 25),
(25718, 'Sasaima', 25),
(25736, 'Sesquile', 25),
(25740, 'Sibate', 25),
(25743, 'Silvania', 25),
(25745, 'Simijaca', 25),
(25754, 'Soacha', 25),
(25758, 'Sopo', 25),
(25769, 'Subachoque', 25),
(25772, 'Suesca', 25),
(25777, 'Supata', 25),
(25779, 'Susa', 25),
(25781, 'Sutatausa', 25),
(25785, 'Tabio', 25),
(25793, 'Tausa', 25),
(25797, 'Tena', 25),
(25799, 'Tenjo', 25),
(25805, 'Tibacuy', 25),
(25807, 'Tibirita', 25),
(25815, 'Tocaima', 25),
(25817, 'TocancipÃ¡', 25),
(25823, 'Topaipi', 25),
(25839, 'Ubala', 25),
(25841, 'Ubaque', 25),
(25843, 'Ubate', 25),
(25845, 'Une', 25),
(25851, 'Utica', 25),
(25862, 'Vergara', 25),
(25867, 'Viani', 25),
(25871, 'Villagomez', 25),
(25873, 'Villapinzon', 25),
(25875, 'Villeta', 25),
(25878, 'Viota', 25),
(25885, 'Yacopi', 25),
(25898, 'Zipacon', 25),
(25899, 'ZipaquirÃ¡', 25),
(27001, 'Quibdo', 27),
(27006, 'Acandi', 27),
(27025, 'Alto Baudo (Pie de P', 27),
(27050, 'Atrato', 27),
(27073, 'Bagado', 27),
(27075, 'Bahia Solano (Mutis)', 27),
(27077, 'Bajo Baudo (Pizarro)', 27),
(27086, 'BelÃ©n de Bajira', 27),
(27099, 'Bojaya (Bellavista)', 27),
(27135, 'Canton de San Pablo ', 27),
(27150, 'Carmen del Darien', 27),
(27160, 'Certegui', 27),
(27205, 'Condoto', 27),
(27245, 'El Carmen de Atrato', 27),
(27250, 'Litoral del Bajo San', 27),
(27361, 'Itsmina', 27),
(27372, 'Jurado', 27),
(27413, 'Lloro', 27),
(27425, 'Medio Atrato', 27),
(27430, 'Medio Baudo (Boca de', 27),
(27450, 'Medio San Juan', 27),
(27491, 'Novita', 27),
(27495, 'Nuqui', 27),
(27580, 'Rio Iro', 27),
(27600, 'Rioquito', 27),
(27615, 'Riosucio', 27),
(27660, 'San Jose del Palmar', 27),
(27745, 'Sipi', 27),
(27787, 'Tado', 27),
(27800, 'Unguia', 27),
(27810, 'Union Panamericana', 27),
(41001, 'Neiva', 41),
(41006, 'Acevedo', 41),
(41013, 'Agrado', 41),
(41016, 'Aipe', 41),
(41020, 'Algeciras', 41),
(41026, 'Altamira', 41),
(41078, 'Baraya', 41),
(41132, 'Campoalegre', 41),
(41206, 'Colombia', 41),
(41244, 'Elias', 41),
(41298, 'Garzon', 41),
(41306, 'Gigante', 41),
(41319, 'Guadalupe', 41),
(41349, 'Hobo', 41),
(41357, 'Iquira', 41),
(41359, 'Isnos (San Jose de I', 41),
(41378, 'La Argentina', 41),
(41396, 'La Plata', 41),
(41483, 'Nataga', 41),
(41503, 'Oporapa', 41),
(41518, 'Paicol', 41),
(41524, 'Palermo', 41),
(41530, 'Palestina', 41),
(41548, 'Pital', 41),
(41551, 'Pitalito', 41),
(41615, 'Rivera', 41),
(41660, 'Saladoblanco', 41),
(41668, 'San Agustin', 41),
(41676, 'Santa Maria', 41),
(41770, 'Suaza', 41),
(41791, 'Tarqui', 41),
(41797, 'Tesalia', 41),
(41799, 'Tello', 41),
(41801, 'Teruel', 41),
(41807, 'Timana', 41),
(41872, 'Villavieja', 41),
(41885, 'Yaguara', 41),
(44001, 'Riohacha', 44),
(44035, 'Albania', 44),
(44078, 'Barrancas', 44),
(44090, 'Dibulla', 44),
(44098, 'Distraccion', 44),
(44110, 'El Molino', 44),
(44279, 'Fonseca', 44),
(44378, 'Hatonuevo', 44),
(44420, 'La Jagua del Pilar', 44),
(44430, 'Maicao', 44),
(44560, 'Manaure', 44),
(44650, 'San Juan del Cesar', 44),
(44847, 'Uribia', 44),
(44855, 'Urumita', 44),
(44874, 'Villanueva', 44),
(47001, 'Santa Marta', 47),
(47030, 'Algarrobo', 47),
(47053, 'Aracataca', 47),
(47058, 'Ariguani (El Dificil', 47),
(47161, 'Cerro San Antonio', 47),
(47170, 'Chivolo', 47),
(47189, 'Cienaga', 47),
(47205, 'Concordia', 47),
(47245, 'El Banco', 47),
(47258, 'El PiÃ±on', 47),
(47268, 'El Reten', 47),
(47288, 'Fundacion', 47),
(47318, 'Guamal', 47),
(47460, 'Nueva Granada', 47),
(47541, 'Pedraza', 47),
(47545, 'PijiÃ±o del Carmen (P', 47),
(47551, 'Pivijay', 47),
(47555, 'Plato', 47),
(47570, 'Puebloviejo', 47),
(47605, 'Remolino', 47),
(47660, 'Sabanas de San Angel', 47),
(47675, 'Salamina', 47),
(47692, 'San Sebastian de Bue', 47),
(47703, 'San Zenon', 47),
(47707, 'Santa Ana', 47),
(47720, 'Santa Barbara de Pin', 47),
(47745, 'Sitio Nuevo', 47),
(47798, 'Tenerife', 47),
(47960, 'Zapayan', 47),
(47980, 'Zona Bananera', 47),
(47981, 'CARTAGENA', 13),
(47982, 'Catambuco', 52),
(47983, 'Bordo', 19),
(47984, 'BriceÃ±o', 25),
(47985, 'Siberia', 25),
(50001, 'Villavicencio', 50),
(50006, 'Acacias', 50),
(50110, 'Barranca de Upia', 50),
(50124, 'Cabuyaro', 50),
(50150, 'Castilla La Nueva', 50),
(50223, 'Cubarral', 50),
(50226, 'Cumaral', 50),
(50245, 'El Calvario', 50),
(50251, 'El Castillo', 50),
(50270, 'El Dorado', 50),
(50287, 'Fuente de Oro', 50),
(50313, 'Granada', 50),
(50318, 'Guamal', 50),
(50325, 'Mapiripan', 50),
(50330, 'Mesetas', 50),
(50350, 'La Macarena', 50),
(50370, 'La Uribe', 50),
(50400, 'Lejanias', 50),
(50450, 'Puerto Concordia', 50),
(50517, 'pooooo', 11001),
(50568, 'Puerto Gaitan', 50),
(50573, 'Puerto Lopez', 50),
(50577, 'Puerto Lleras', 50),
(50590, 'Puerto Rico', 50),
(50606, 'Restrepo', 50),
(50680, 'San Carlos de Guaroa', 50),
(50683, 'San Juan de Arama', 50),
(50686, 'San Juanito', 50),
(50689, 'San Martin', 50),
(50711, 'Vistahermosa', 50),
(51246, 'nose', 5001),
(52001, 'Pasto', 52),
(52019, 'Alban (San Jose)', 52),
(52022, 'Aldana', 52),
(52036, 'Ancuya', 52),
(52051, 'Arboleda (Berruecos)', 52),
(52079, 'Barbacoas', 52),
(52083, 'Belen', 52),
(52110, 'Buesaco', 52),
(52203, 'Colon (Genova)', 52),
(52207, 'Consaca', 52),
(52210, 'Contadero', 52),
(52215, 'Cordoba', 52),
(52224, 'Cuaspud (Carlosama)', 52),
(52227, 'Cumbal', 52),
(52233, 'Cumbitara', 52),
(52240, 'Chachagui', 52),
(52250, 'El Charco', 52),
(52254, 'El PeÃ±ol', 52),
(52256, 'El Rosario', 52),
(52258, 'El Tablon', 52),
(52260, 'El Tambo', 52),
(52287, 'Funes', 52),
(52317, 'Guachucal', 52),
(52320, 'Guaitarilla', 52),
(52323, 'Gualmatan', 52),
(52352, 'Iles', 52),
(52354, 'Imues', 52),
(52356, 'Ipiales', 52),
(52378, 'La Cruz', 52),
(52381, 'La Florida', 52),
(52385, 'La Llanada', 52),
(52390, 'La Tola', 52),
(52399, 'La Union', 52),
(52405, 'Leiva', 52),
(52411, 'Linares', 52),
(52418, 'Los Andes (Sotomayor', 52),
(52427, 'Magui (Payan)', 52),
(52435, 'Mallama (Piedrancha)', 52),
(52473, 'Mosquera', 52),
(52480, 'NariÃ±o', 52),
(52490, 'Olaya Herrera(Bocas ', 52),
(52506, 'Ospina', 52),
(52520, 'Francisco Pizarro (S', 52),
(52540, 'Policarpa', 52),
(52560, 'Potosi', 52),
(52565, 'Providencia', 52),
(52573, 'Puerres', 52),
(52585, 'Pupiales', 52),
(52612, 'Ricaurte', 52),
(52621, 'Roberto Payan (San J', 52),
(52678, 'Samaniego', 52),
(52683, 'Sandona', 52),
(52685, 'San Bernardo', 52),
(52687, 'San Lorenzo', 52),
(52693, 'San Pablo', 52),
(52694, 'San Pedro de Cartago', 52),
(52696, 'Santa Barbara (Iscua', 52),
(52699, 'Santa Cruz (Guachave', 52),
(52720, 'Sapuyes', 52),
(52786, 'Taminango', 52),
(52788, 'Tangua', 52),
(52835, 'Tumaco', 52),
(52838, 'Tuquerres', 52),
(52885, 'Yacuanquer', 52),
(54001, 'Cucuta', 54),
(54003, 'Abrego', 54),
(54051, 'Arboledas', 54),
(54099, 'Bochalema', 54),
(54109, 'Bucarasica', 54),
(54125, 'Cacota', 54),
(54128, 'Cachira', 54),
(54174, 'Chitaga', 54),
(54206, 'Convencion', 54),
(54223, 'Cucutilla', 54),
(54239, 'Durania', 54),
(54245, 'El Carmen', 54),
(54250, 'El Tarra', 54),
(54261, 'El Zulia', 54),
(54313, 'Gramalote', 54),
(54344, 'Hacari', 54),
(54347, 'Herran', 54),
(54377, 'Labateca', 54),
(54385, 'La Esperanza', 54),
(54398, 'La Playa', 54),
(54405, 'Los Patios', 54),
(54418, 'Lourdes', 54),
(54480, 'Mutiscua', 54),
(54498, 'OcaÃ±a', 54),
(54518, 'Pamplona', 54),
(54520, 'Pamplonita', 54),
(54553, 'Puerto Santander', 54),
(54599, 'Ragonvalia', 54),
(54660, 'Salazar', 54),
(54670, 'San Calixto', 54),
(54673, 'San Cayetano', 54),
(54680, 'Santiago', 54),
(54720, 'Sardinata', 54),
(54743, 'Silos', 54),
(54800, 'Teorama', 54),
(54810, 'Tibu', 54),
(54820, 'Toledo', 54),
(54871, 'Villa Caro', 54),
(54874, 'Villa del Rosario', 54),
(63001, 'Armenia', 63),
(63111, 'Buenavista', 63),
(63130, 'Calarca', 63),
(63190, 'Circasia', 63),
(63212, 'Cordoba', 63),
(63272, 'Filandia', 63),
(63302, 'Genova', 63),
(63401, 'La Tebaida', 63),
(63470, 'Montenegro', 63),
(63548, 'Pijao', 63),
(63594, 'Quimbaya', 63),
(63690, 'Salento', 63),
(66001, 'Pereira', 66),
(66045, 'Apia', 66),
(66075, 'Balboa', 66),
(66088, 'Belen de Umbria', 66),
(66170, 'Dosquebradas', 66),
(66318, 'Guatica', 66),
(66383, 'La Celia', 66),
(66400, 'La Virginia', 66),
(66440, 'Marsella', 66),
(66456, 'Mistrato', 66),
(66572, 'Pueblo Rico', 66),
(66594, 'Quinchia', 66),
(66682, 'Santa Rosa de Cabal', 66),
(66687, 'Santuario', 66),
(68001, 'Bucaramanga', 68),
(68013, 'Aguada', 68),
(68020, 'Albania', 68),
(68051, 'Aratoca', 68),
(68077, 'Barbosa', 68),
(68079, 'Barichara', 68),
(68081, 'Barrancabermeja', 68),
(68092, 'Betulia', 68),
(68101, 'Bolivar', 68),
(68121, 'Cabrera', 68),
(68132, 'California', 68),
(68147, 'Capitanejo', 68),
(68152, 'Carcasi', 68),
(68160, 'Cepita', 68),
(68162, 'Cerrito', 68),
(68167, 'Charala', 68),
(68169, 'Charta', 68),
(68176, 'Chima', 68),
(68179, 'Chipata', 68),
(68190, 'Cimitarra', 68),
(68207, 'Concepcion', 68),
(68209, 'Confines', 68),
(68211, 'Contratacion', 68),
(68217, 'Coromoro', 68),
(68229, 'Curiti', 68),
(68235, 'El Carmen de Chucuri', 68),
(68245, 'El Guacamayo', 68),
(68250, 'El PeÃ±on', 68),
(68255, 'El Playon', 68),
(68264, 'Encino', 68),
(68266, 'Enciso', 68),
(68271, 'Florian', 68),
(68276, 'Floridablanca', 68),
(68296, 'Galan', 68),
(68298, 'Gambita', 68),
(68307, 'Giron', 68),
(68318, 'Guaca', 68),
(68320, 'Guadalupe', 68),
(68322, 'Guapota', 68),
(68324, 'Guavata', 68),
(68327, 'Guepsa', 68),
(68344, 'Hato', 68),
(68368, 'Jesus Maria', 68),
(68370, 'Jordan', 68),
(68377, 'La Belleza', 68),
(68385, 'Landazuri', 68),
(68397, 'La Paz', 68),
(68406, 'Lebrija', 68),
(68418, 'Los Santos', 68),
(68425, 'Macaravita', 68),
(68432, 'Malaga', 68),
(68444, 'Matanza', 68),
(68464, 'Mogotes', 68),
(68468, 'Molagavita', 68),
(68498, 'Ocamonte', 68),
(68500, 'Oiba', 68),
(68502, 'Onzaga', 68),
(68522, 'Palmar', 68),
(68524, 'Palmas Socorro', 68),
(68533, 'Paramo', 68),
(68547, 'Piedecuesta', 68),
(68549, 'Pinchote', 68),
(68572, 'Puente Nacional', 68),
(68573, 'Puerto Parra', 68),
(68575, 'Puerto Wilches', 68),
(68615, 'Rionegro', 68),
(68655, 'Sabana de Torres', 68),
(68669, 'San Andres', 68),
(68673, 'San Benito', 68),
(68679, 'San Gil', 68),
(68682, 'San Joaquin', 68),
(68684, 'San Jose de Miranda', 68),
(68686, 'San Miguel', 68),
(68689, 'San Vicente de Chucu', 68),
(68705, 'Santa Barbara', 68),
(68720, 'Santa Helena del Opo', 68),
(68745, 'Simacota', 68),
(68755, 'Socorro', 68),
(68770, 'Suaita', 68),
(68773, 'Sucre', 68),
(68780, 'Surata', 68),
(68820, 'Tona', 68),
(68855, 'Valle de San Jose', 68),
(68861, 'Velez', 68),
(68867, 'Vetas', 68),
(68872, 'Villanueva', 68),
(68895, 'Zapatoca', 68),
(70001, 'Sincelejo', 70),
(70110, 'Buenavista', 70),
(70124, 'Caimito', 70),
(70204, 'Coloso (Ricaurte)', 70),
(70215, 'Corozal', 70),
(70221, 'CoveÃ±as', 70),
(70230, 'Chalan', 70),
(70233, 'El Roble', 70),
(70235, 'Galeras (Nueva Grana', 70),
(70265, 'Guaranda', 70),
(70400, 'La Union', 70),
(70418, 'Los Palmitos', 70),
(70429, 'Majagual', 70),
(70473, 'Morroa', 70),
(70508, 'Ovejas', 70),
(70523, 'Palmito', 70),
(70670, 'Sampues', 70),
(70678, 'San Benito Abad', 70),
(70702, 'San Juan de Betulia', 70),
(70708, 'San Marcos', 70),
(70713, 'San Onofre', 70),
(70717, 'San Pedro', 70),
(70742, 'Since', 70),
(70771, 'Sucre', 70),
(70820, 'Tolu', 70),
(70823, 'Toluviejo', 70),
(73001, 'Ibague', 73),
(73024, 'Alpujarra', 73),
(73026, 'Alvarado', 73),
(73030, 'Ambalema', 73),
(73043, 'Anzoategui', 73),
(73055, 'Armero (Guayabal)', 73),
(73067, 'Ataco', 73),
(73124, 'Cajamarca', 73),
(73148, 'Carmen de Apicala', 73),
(73152, 'Casabianca', 73),
(73168, 'Chaparral', 73),
(73200, 'Coello', 73),
(73217, 'Coyaima', 73),
(73226, 'Cunday', 73),
(73236, 'Dolores', 73),
(73268, 'Espinal', 73),
(73270, 'Falan', 73),
(73275, 'Flandes', 73),
(73283, 'Fresno', 73),
(73319, 'Guamo', 73),
(73347, 'Herveo', 73),
(73349, 'Honda', 73),
(73352, 'Icononzo', 73),
(73408, 'Lerida', 73),
(73411, 'Libano', 73),
(73443, 'Mariquita', 73),
(73449, 'Melgar', 73),
(73461, 'Murillo', 73),
(73483, 'Natagaima', 73),
(73504, 'Ortega', 73),
(73520, 'Palocabildo', 73),
(73547, 'Piedras', 73),
(73555, 'Planadas', 73),
(73563, 'Prado', 73),
(73585, 'Purificacion', 73),
(73616, 'Rioblanco', 73),
(73622, 'Roncesvalles', 73),
(73624, 'Rovira', 73),
(73671, 'SaldaÃ±a', 73),
(73675, 'San Antonio', 73),
(73678, 'San Luis', 73),
(73686, 'Santa Isabel', 73),
(73770, 'Suarez', 73),
(73854, 'Valle de San Juan', 73),
(73861, 'Venadillo', 73),
(73870, 'Villahermosa', 73),
(73873, 'Villarica', 73),
(75878, 'patty', 5042),
(76001, 'Cali', 76),
(76020, 'Alcala', 76),
(76036, 'Andalucia', 76),
(76041, 'Ansermanuevo', 76),
(76054, 'Argelia', 76),
(76100, 'Bolivar', 76),
(76109, 'Buenaventura', 76),
(76111, 'Buga', 76),
(76113, 'Bugalagrande', 76),
(76122, 'Caicedonia', 76),
(76126, 'Darien', 76),
(76130, 'Candelaria', 76),
(76147, 'Cartago', 76),
(76233, 'Dagua', 76),
(76243, 'El Aguila', 76),
(76246, 'El Cairo', 76),
(76248, 'El Cerrito', 76),
(76250, 'El Dovio', 76),
(76275, 'Florida', 76),
(76306, 'Ginebra', 76),
(76318, 'Guacari', 76),
(76364, 'Jamundi', 76),
(76377, 'La Cumbre', 76),
(76400, 'La Union', 76),
(76403, 'La Victoria', 76),
(76497, 'Obando', 76),
(76520, 'Palmira', 76),
(76563, 'Pradera', 76),
(76606, 'Restrepo', 76),
(76616, 'Riofrio', 76),
(76622, 'Roldanillo', 76),
(76670, 'San Pedro', 76),
(76736, 'Sevilla', 76),
(76823, 'Toro', 76),
(76828, 'Trujillo', 76),
(76834, 'Tulua', 76),
(76845, 'Ulloa', 76),
(76863, 'Versalles', 76),
(76869, 'Vijes', 76),
(76890, 'Yotoco', 76),
(76892, 'Yumbo', 76),
(76895, 'Zarzal', 76),
(81001, 'Arauca', 81),
(81065, 'Arauquita', 81),
(81220, 'Cravo Norte', 81),
(81300, 'Fortul', 81),
(81591, 'Puerto Rondon', 81),
(81736, 'Saravena', 81),
(81794, 'Tame', 81),
(85001, 'Yopal', 85),
(85010, 'Aguazul', 85),
(85015, 'Chameza', 85),
(85125, 'Hato Corozal', 85),
(85136, 'La Salina', 85),
(85139, 'Mani', 85),
(85162, 'Monterrey', 85),
(85225, 'Nunchia', 85),
(85230, 'Orocue', 85),
(85250, 'Paz de Ariporo', 85),
(85263, 'Pore', 85),
(85279, 'Recetor', 85),
(85300, 'Sabanalarga', 85),
(85315, 'Sacama', 85),
(85325, 'San Luis de Palenque', 85),
(85400, 'Tamara', 85),
(85410, 'Tauramena', 85),
(85430, 'Trinidad', 85),
(85440, 'Villanueva', 85),
(86001, 'Mocoa', 86),
(86219, 'Colon', 86),
(86320, 'Orito', 86),
(86568, 'Puerto Asis', 86),
(86569, 'Puerto Caicedo', 86),
(86571, 'Puerto Guzman', 86),
(86573, 'Puerto Leguizamo', 86),
(86749, 'Sibundoy', 86),
(86755, 'San Francisco', 86),
(86757, 'San Miguel (La Dorad', 86),
(86760, 'Santiago', 86),
(86865, 'Valle del Guamuez', 86),
(86885, 'Villagarzon', 86),
(88001, 'San Andres', 88),
(88564, 'Providencia', 88),
(91001, 'Leticia', 91),
(91263, 'El Encanto (CD)', 91),
(91405, 'La Chorrera (CD)', 91),
(91407, 'La Pedrera (CD)', 91),
(91430, 'La Victoria (CD)', 91),
(91460, 'Miriti Parana (CD)', 91),
(91530, 'Puerto Alegria (CD)', 91),
(91536, 'Puerto Arica (CD)', 91),
(91540, 'Puerto NariÃ±o', 91),
(91669, 'Puerto Santander (CD', 91),
(91798, 'Tarapaca (CD)', 91),
(94001, 'Puerto Inirida', 94),
(94343, 'Barranco Minas (CD)', 94),
(94663, 'Mapiripana (CD)', 94),
(94883, 'San Felipe (CD)', 94),
(94884, 'Puerto Colombia (CD)', 94),
(94885, 'La Guadalupe (CD)', 94),
(94886, 'Cacahual (CD)', 94),
(94887, 'Pana Pana (Campo Ale', 94),
(94888, 'Morichal (Morichal N', 94),
(95000, 'Guaviare', 94),
(95001, 'San Jose del Guaviar', 94),
(95015, 'Calamar', 94),
(95025, 'El Retorno', 94),
(95200, 'Miraflores', 94),
(97001, 'Mitu', 97),
(97161, 'Caruru', 97),
(97511, 'Pacoa (CD)', 97),
(97666, 'Taraira', 97),
(97777, 'Papunaua (Morichal) ', 97),
(97889, 'Yavarate (CD)', 97),
(99001, 'Puerto CarreÃ±o', 99),
(99524, 'La Primavera', 99),
(99624, 'Santa Rosalia', 99),
(99773, 'Cumaribo', 99);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `iduser` bigint(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `idprofile` bigint(11) NOT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(10) DEFAULT NULL,
  `codubi` bigint(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `imgus` varchar(120) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `fecsolusu` datetime DEFAULT NULL,
  `clausu` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`iduser`, `name`, `lastname`, `idprofile`, `address`, `phone`, `codubi`, `email`, `password`, `imgus`, `status`, `fecsolusu`, `clausu`) VALUES
(4, 'Duvan', 'Robayo', 1, '1d3', '311825', 25175, 'xx.duvanxx@hotmail.com', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'image/duvan', 1, '2021-06-17 12:59:26', '0f92fb6b60b12d7caacc00d92fa7c189f24ccf6f'),
(17, 'David', 'Velasquez', 1, 'TV.22 N°8-58', '3142649227', 25899, 'dovelasquez03@misena.edu.co', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'image/indefinido', 1, NULL, NULL),
(20, 'Esperanza', 'Gomez', 3, '69', '3323232222', 54405, 'esperanza69@gmail.com', '10470c3b4b1fed12c3baac014be15fac67c6e815', 'image/hope', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `valor`
--

CREATE TABLE `valor` (
  `codval` int(5) NOT NULL,
  `iddom` bigint(11) DEFAULT NULL,
  `nomval` varchar(60) DEFAULT NULL,
  `parval` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `valor`
--

INSERT INTO `valor` (`codval`, `iddom`, `nomval`, `parval`) VALUES
(1, 1, 'Masculino', ''),
(2, 1, 'Femenino', NULL),
(3, 1, 'Otro', NULL),
(4, 2, 'En revision', NULL),
(5, 2, 'Resuelto', NULL),
(6, 2, 'En espera', NULL),
(7, 3, 'Hurto', NULL),
(8, 3, 'Agresion', NULL),
(9, 3, 'Violacion', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `dominio`
--
ALTER TABLE `dominio`
  ADD PRIMARY KEY (`iddom`);

--
-- Indices de la tabla `pagina`
--
ALTER TABLE `pagina`
  ADD PRIMARY KEY (`pagid`);

--
-- Indices de la tabla `pagper`
--
ALTER TABLE `pagper`
  ADD KEY `fk_pagpxpag` (`pagid`),
  ADD KEY `fk_pagpxper` (`pefid`);

--
-- Indices de la tabla `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`pefid`),
  ADD KEY `pagprin` (`pagprin`);

--
-- Indices de la tabla `ubicacion`
--
ALTER TABLE `ubicacion`
  ADD PRIMARY KEY (`codubi`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`iduser`),
  ADD UNIQUE KEY `emausu` (`email`),
  ADD UNIQUE KEY `emausu_2` (`email`),
  ADD KEY `fpef` (`idprofile`),
  ADD KEY `fubi` (`codubi`);

--
-- Indices de la tabla `valor`
--
ALTER TABLE `valor`
  ADD PRIMARY KEY (`codval`),
  ADD KEY `fk_domxval` (`iddom`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `dominio`
--
ALTER TABLE `dominio`
  MODIFY `iddom` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `perfil`
--
ALTER TABLE `perfil`
  MODIFY `pefid` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `iduser` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `valor`
--
ALTER TABLE `valor`
  MODIFY `codval` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `pagper`
--
ALTER TABLE `pagper`
  ADD CONSTRAINT `pagper_ibfk_1` FOREIGN KEY (`pefid`) REFERENCES `perfil` (`pefid`),
  ADD CONSTRAINT `pagper_ibfk_2` FOREIGN KEY (`pagid`) REFERENCES `pagina` (`pagid`);

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fpef` FOREIGN KEY (`idprofile`) REFERENCES `perfil` (`pefid`),
  ADD CONSTRAINT `fubi` FOREIGN KEY (`codubi`) REFERENCES `ubicacion` (`codubi`);

--
-- Filtros para la tabla `valor`
--
ALTER TABLE `valor`
  ADD CONSTRAINT `fk_domxval` FOREIGN KEY (`iddom`) REFERENCES `dominio` (`iddom`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
