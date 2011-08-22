-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 19-08-2011 a las 11:17:11
-- Versión del servidor: 5.5.8
-- Versión de PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `biblos-g1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acceso`
--

CREATE TABLE IF NOT EXISTS `acceso` (
  `usuario_dni` int(10) unsigned NOT NULL,
  `fecha_hora_entrada` datetime NOT NULL,
  `fecha_hora_salida` datetime DEFAULT NULL,
  PRIMARY KEY (`usuario_dni`,`fecha_hora_entrada`),
  KEY `fk_acceso_usuario1` (`usuario_dni`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcar la base de datos para la tabla `acceso`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `autor`
--

CREATE TABLE IF NOT EXISTS `autor` (
  `id_autor` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_autor` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  `apellido1` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  `apellido2` varchar(25) COLLATE latin1_spanish_ci DEFAULT NULL,
  `nacionalidad` varchar(25) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`id_autor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=17 ;

--
-- Volcar la base de datos para la tabla `autor`
--

INSERT INTO `autor` (`id_autor`, `nombre_autor`, `apellido1`, `apellido2`, `nacionalidad`) VALUES
(1, 'abento', 'fail', NULL, 'noruego'),
(2, 'abhayananda', 'dada', NULL, 'huruguayo'),
(3, 'abhinavagupta', 'halam', 'malicon', 'marroqui'),
(4, 'alexader', 'Sergei', 'Abramov', 'Checoslovaco'),
(5, 'Alafred', 'Bester', NULL, 'Aleman'),
(6, 'tomas', 'de Iriarte', NULL, 'español'),
(7, 'Joaquin', 'Abreu', 'Orta', 'Catalan'),
(8, 'Francisco', 'Aceball', NULL, 'Español'),
(9, 'Eduardo', 'Acevedo', 'Díaz', 'Español'),
(10, 'Patricio', 'dela Escosura', NULL, 'Rumano'),
(11, 'Friedrich', 'Nitzsche', NULL, 'Polaco'),
(13, 'Friedrich', 'Nitzsche', NULL, 'Polaco'),
(15, 'Antonio', 'de Trueba', NULL, 'Español'),
(16, 'Soledad', 'Acosta', 'de Samper', 'Mejicana');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dewey`
--

CREATE TABLE IF NOT EXISTS `dewey` (
  `id_categoria_dewey` smallint(3) unsigned zerofill NOT NULL,
  `categoria_dewey` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id_categoria_dewey`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcar la base de datos para la tabla `dewey`
--

INSERT INTO `dewey` (`id_categoria_dewey`, `categoria_dewey`) VALUES
(000, 'Obras Generales'),
(100, 'Filosofía'),
(200, 'Religión'),
(300, 'Ciencias Sociales'),
(400, 'Lingüística'),
(500, 'Ciencias Puras'),
(600, 'Ciencias Aplicadas'),
(700, 'Artes y Recreación'),
(800, 'Literatura'),
(900, 'Historia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `editorial`
--

CREATE TABLE IF NOT EXISTS `editorial` (
  `id_editorial` tinyint(4) NOT NULL AUTO_INCREMENT,
  `nombre_editorial` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id_editorial`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci AUTO_INCREMENT=6 ;

--
-- Volcar la base de datos para la tabla `editorial`
--

INSERT INTO `editorial` (`id_editorial`, `nombre_editorial`) VALUES
(1, 'Acteón Editorial'),
(2, 'Agrotecnicas'),
(3, 'Calambur'),
(4, 'Edibesa'),
(5, 'Planeta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plantilla`
--

CREATE TABLE IF NOT EXISTS `plantilla` (
  `id_plantilla` tinyint(3) unsigned NOT NULL,
  `nombre_plantilla` varchar(45) COLLATE latin1_spanish_ci NOT NULL,
  PRIMARY KEY (`id_plantilla`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcar la base de datos para la tabla `plantilla`
--

INSERT INTO `plantilla` (`id_plantilla`, `nombre_plantilla`) VALUES
(1, 'plantilla1'),
(2, 'plantilla 2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `titulo`
--

CREATE TABLE IF NOT EXISTS `titulo` (
  `dewey_id_categoria_dewey` smallint(3) unsigned zerofill NOT NULL,
  `id_apellido` varchar(3) COLLATE latin1_spanish_ci NOT NULL,
  `id_titulo` varchar(3) COLLATE latin1_spanish_ci NOT NULL,
  `nombre` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  `fecha_publicacion` date NOT NULL,
  `fecha_adquisicion` date NOT NULL,
  `sinopsis` text COLLATE latin1_spanish_ci NOT NULL,
  `numero_paginas` smallint(5) unsigned NOT NULL,
  `isbn` bigint(20) unsigned zerofill NOT NULL,
  `fecha_prestamo` datetime NOT NULL,
  `fecha_devolucion_propuesta` datetime NOT NULL,
  `fecha_devolucion_efectiva` datetime DEFAULT NULL,
  `editorial_id_editorial` tinyint(4) NOT NULL,
  `edicion` tinyint(4) NOT NULL,
  PRIMARY KEY (`dewey_id_categoria_dewey`,`id_apellido`,`id_titulo`),
  KEY `fk_titulo_dewey1` (`dewey_id_categoria_dewey`),
  KEY `fk_titulo_editorial1` (`editorial_id_editorial`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcar la base de datos para la tabla `titulo`
--

INSERT INTO `titulo` (`dewey_id_categoria_dewey`, `id_apellido`, `id_titulo`, `nombre`, `fecha_publicacion`, `fecha_adquisicion`, `sinopsis`, `numero_paginas`, `isbn`, `fecha_prestamo`, `fecha_devolucion_propuesta`, `fecha_devolucion_efectiva`, `editorial_id_editorial`, `edicion`) VALUES
(000, 'IRI', 'FAB', 'Fábula 12', '1978-10-25', '2005-12-12', 'Las fábulas de Jean de La Fontaine constituyen una de las cumbres del clasicismo y una obra maestra de la literatura francesa de todos los tiempos. Inspiradas en los modelos clásicos, desde Esopo a Horacio, pero también en la tradición de los cuentos orientales, la mayoría tienen como protagonistas a animales antropomórficos...', 196, 00000000000000000006, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 4, 0),
(100, 'DAD', 'DAT', 'dattatreya. La Canción de', '0000-00-00', '0000-00-00', '"De todos los tratados místicos de la literatura india antigua, el Avadhut Gita, o Canción del Avadhut, es uno de los más elocuentes y apremiantes. Su tema es el conocimiento unitivo obtenido a través de la visión mística, el conocimiento del eterno Sí Mismo. Este conocimiento no se limita a los místicos de una determinada tradición cultural, sino que es universal entre todos aquellos que han logrado la visión mística"', 196, 00000000000000000002, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 4, 0),
(100, 'HAL', 'LAC', 'Tantraloka', '1956-02-25', '0000-00-00', 'Todo esto revela un arte. Evocar la vacuidad en no importa que lugar del cuerpo, de\r\nmanera instantánea y deslumbrante; o bien extender esta vacuidad al «objeto cuerpo» por\r\nentero; meditar sobre este como si no contuviera nada ni en el interior ni en el exterior, no\r\nsiendo la piel más que un muro, una película diáfana entre dos vacíos, etc. (Vijñana\r\nBhairava Tantra) todo esto, en una cierta medida, se aprende pero se tropezará a menudo\r\ncon resistencias insospechadas. El individuo no acepta fácilmente el dejar la prisión que ha\r\nconstruido él mismo. Una cosa es jugar filosóficamente con la idea de vacuidad y otra cosa\r\nes el realizarla directamente en su propio cuerpo y en su mental, hasta no ser más que una\r\nforma vacía, una energía sin contornos, sin límites, radiante y vibrante.', 300, 00000000000000000003, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 3, 0),
(100, 'NIE', 'ASI', 'Así habla Zaratustra', '1965-12-25', '2004-06-06', 'Sinopsis: Cuando contaba con treinta años, Zaratustra —legendario filósofo persa, cuyo nombre en español es Zoroastro, quien se cree vivió en el siglo VI a. C.— decide retirarse a la soledad de la montaña, acompañado solamente por sus dos animales heráldicos: el águila, que simboliza el orgullo, y la serpiente, la sabiduría. Durante su voluntario retiro, adquiere conocimiento y un día considera que ha llegado el momento de bajar a predicar a los hombres.\r\nAl llegar a la ciudad, encuentra al pueblo reunido en el mercado y "comete la gran tontería" de hablar a todos, que es como no hablar. Su fracaso es total y el pueblo se burla de él. Desde entonces, por lo tanto, Zaratustra buscará discípulos a quienes dirigir sus discursos, que en esencia son desafíos a los antiguos ideales y creencias.\r\nEl tema central de la primera parte es la muerte de Dios, ser cuyo peso —dice— ya no debe abrumar al hombre a fin de ser libre para conquistar, no "el otro mundo", sino este mundo suyo. Luego de explicar de qué manera debe realizarse la evolución del espíritu humano (las tres transformaciones), siguen disertaciones donde ataca las virtudes que actúan como adormideras de esa evolución: "la tranquila somnolencia de la moral", la aridez libresca de una cultura sedentaria, el ascetismo, etc.; en cambio, exalta la guerra, la amistad, la vida, conceptos con sentido en sí mismos y, en fin, la generosidad de la sana virtud dada.\r\nAl terminar la primera serie de sus discursos, Zaratustra se despide de sus discípulos y vuelve nuevamente a la soledad de las montañas. Sus últimas palabras son: "Muertos están todos los dioses; ahora queremos que viva el superhombre."', 340, 00000000000000000011, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 1, 0),
(300, 'ACE', 'ALM', 'Alma Asturiana, Alma Espa', '1995-10-23', '2001-02-06', 'La trama de esta obra marcada por un régimen dictatorial, el terror, la maldad y la muerte comienza a desarrollarse en “El portal del Señor”, un sitio donde se agrupaban los pordioseros como Pelele, un hombre que, al escuchar la expresión “madre”, se fastidiaba hasta el punto tal que había llegado a matar al coronel José Parrales por haberlo despertado al grito de esa palabra.\r\n\r\nTras cometer ese asesinato, Pelele huye y sus compañeros son llevados por la policía en rol de testigos aunque, mediante torturas, son obligados a mentir con el fin de responsabiliz', 256, 00000000000000000008, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 1, 0),
(300, 'ACO', 'EPI', 'Epistolas', '1956-12-06', '1984-02-15', ' En las Epístolas nosotros encontramos la exposición del resultado de esa obra gloriosa de gracia, mediante la cual el hombre es colocado en un terreno enteramente nuevo con Dios, en reconciliación con Él; así como el desarrollo de los consejos de Dios en Cristo, conforme a los cuales este nuevo mundo es establecido y ordenado. Al presentarnos esta exposición de los modos de obrar de Dios en conexión con la obra que es la base de estos consejos, son expuestos claramente la perfecta eficacia de la obra misma, y el orden de nuestras relaciones con Dios; de modo que el sistema completo, el completo plan de Dios, y la manera en que fue puesto en ejecución, son presentados. Y al hacer esto, lo que el hombres es, lo que Dios es, lo que la vida eterna es, son puestos claramente ante nosotros. ', 516, 00000000000000000013, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 5, 0),
(400, 'TRU', 'POR', 'Porque hay un poeta mas y', '1956-06-05', '1995-11-06', '«No tendrán que decir nuestros hijos:\r\n«Ahí estaba el santo árbol cuyo recuerdo\r\nevocan llorando nuestros poetas y cronistas\r\ncuando cantan y narran las glorias y desventuras\r\nde la patria, y nuestras madres de familia cuando\r\narrullan a sus hijos en la cuna; a la sombra de\r\naquel árbol se alzaba una tosca silla de piedra\r\ndonde los grandes reyes de Castilla se sentaban\r\na recibir el homenaje de Vizcaya después de\r\njurar que respetarían y ampararían sus libertades;\r\nDoña Isabel II, que era su sucesora, dejó aquí\r\nde ser su imitadora, pues ella fue quien derribó\r\naquel árbol y aquella silla, ¡bendecidos\r\nde sus progenitores y los nuestros!»\r\nNo, no tendrán que decir esto nuestros hijos».', 156, 00000000000000000012, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 3, 0),
(500, 'ESC', 'CHA', 'Chañarcillo', '1968-10-25', '1995-12-02', 'Esta investigación tiene como objetivo dar a conocer a uno de los autores más\r\nimportantes en la historia del teatro chileno, como es el caso de Antonio\r\nAcevedo Hernández, a través de los siguientes puntos de estudio: vida y obra\r\ndel autor, contexto histórico de su obra, análisis dramatúrgico de su obra\r\nChañarcillo y conclusiones.', 198, 00000000000000000010, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 3, 0),
(600, 'BES', 'FUE', 'Fuera de este mundo', '1993-10-25', '2003-02-24', 'Dos hermanos, Walter y Danny, descubren una caja mágica que contiene un juego del espacio llamado Zathura. Cuando empiezan a jugar, instantáneamente son lanzados a un universo de meteoros, con piratas del espacio, robots diabólicos, frenéticos cambios de gravedad y un agujero negro. Si quieren sobrevivir, deberán dejar de lado su rivalidad y [...]', 256, 00000000000000000005, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 3, 0),
(700, 'ABR', 'OPU', 'Opúsculo sobre la inmoral', '1996-02-12', '2006-06-06', 'En los últimos tiempos se ha discutido públicamente la imposición del Impuesto a la Renta Personal (IRP), establecido por la Ley No LEY N° 2421/04 de Reordenamiento Administrativo y de Adecuación Fiscal, la que en su artículo 1° modifica el artículo 237 “que establece el nuevo régimen tributario” de la anterior ley 125/91, implementada en 1992.\r\n	\r\n	Gadgets powered by Google\r\n\r\n   Los regímenes tributarios son particularmente sensibles a la población y a la opinión pública en general, ya que de ello dependerá que el Estado, el que en su condición de monopolista y haciendo uso del PODER de imponer a los ciudadanos por medio de leyes, el pago obligatorio de cierta porción de sus ingresos y/o gastos, para financiar los gastos estatales. En otras palabras, es un tema sensible por que afecta directamente el bolsillo de la población. Ante esta situación, mucho se ha discutido internacionalmente sobre la moralidad que recae detrás del cobro de cada impuesto.', 258, 00000000000000000007, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 2, 0),
(700, 'ACO', 'LOS', 'Los Piratas de Cartagena', '1989-10-02', '2000-01-01', 'Presentación: El libro está presentado en cinco cuadros que a su vez se dividen en varias partes marcadas con un número que especifica a qué parte pertenece, a excepción del último cuadro, el cual se encuentra dividido en once capítulos.\r\n\r\nClase de lenguaje: El lenguaje manejado en la obra es de tipo objetivo, pues presenta los hechos tal cual ocurrieron, sin ningún tipo de decoración ni de opinión de la autora.\r\n\r\nTema: El libro presenta la historia de varios asaltos y saqueos a la ciudad de Cartagena por parte de varios piratas, que sabiendo acerca de la importancia de la misma para España y de sus riquezas, decidieron atacarla. Cada uno de los cuadros presenta una historia diferente.\r\n\r\nÉpoca: Debido a que cada uno de los cuadros presenta una historia diferente, no puede establecerse una época general para el relato, sin embargo, las historias se llevan a cabo entre los siglos XVI y XVIII.', 235, 00000000000000000012, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 3, 0),
(700, 'FAI', 'LAS', 'Las Mil y una noches.(Res', '1982-08-17', '1995-08-18', 'Sinopsis del libroLas mil y una noches es una de las obras más importantes e influyentes de la literatura universal. Se trata de una recopilación de cuentos y leyendas de origen hindú, árabe y persa, de los cuales no existe un texto definitivo, sino múltiples versiones.\r\nEl rey Schahriar, tras sufrir las infidelidades de su esposa, decide casarse cada día con una joven virgen que es ejecutada a la mañana siguiente para evitar así cualquier otra traición. Para impedir que todas las muchachas del reino mueran, la joven Scherezade se ofrece como voluntaria para casarse con el monarca, y utiliza su astucia para proponerle un pacto mediante el cual no podrá ser ejecutada hasta que no acabe de contarle una historia. Los cuentos que la componen se prolongarán a lo largo de mil y una noches, y acabarán por cautivar al monarca y disuadirle de su cruel empresa.', 250, 00000000000000000001, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 5, 0),
(800, 'ACE', 'NAT', 'Nativa', '1998-03-27', '2006-02-24', 'Díaz Escritor uruguayo que nació en Villa de la Unión en 1851 y murió en 1924.Iniciador de la novela uruguaya, fue político, diplomático, diputado, senador y representó a su país en Argentina, Estados Unidos e Italia. Su apasionamiento político por uno de los partidos nacionalistas de su país, el partido Blanco, lo llevó a abandonar sus estudios universitarios para tomar parte en un movimiento revolucionario. Así fue como conoció por dos veces la triste amargura el destierro. No sólo su labor periodística fue prolífica e importante, sino que su obra literaria está formada por seis novelas: Brenda, Ismael, Nativa, Grito de Gloria, Soledad y Lanza y Sable.Son los hechos de la vida y formación de la nación uruguaya que están pintados con todo vigor e inmenso realismo lo que hace más valiosas estas novelas. Esta obra fue publicada en 1890. El autor cuenta en grandes panoramas el subterráneo hervor revolucionario, mientras la dominación luso brasilera se esfuerza en consolidar la conquista de la llamada Provincia Cisplatina. La figura histórica de Leonardo Olivera aparece muy bien dibujada, con toques definitivos, tal como hoy lo glorifica la historia.Eduardo Acevedo Díaz, contribuye con ésta obra, como con sus otras novelas famosas: Brenda, Ismael, Grito de Gloria, Soledad y Lanza y Sable a la narración de la reconstrucción de la historia uruguaya, en el período de formación de la nacionalidad.De sus páginas van surgiendo, más allá de la fantasía de los episodios novelescos y dando perspectiva a la bien lograda caracterización de los personajes, el amanecer promisorio de una sociedad en creación, con todas sus contradicciones y aspiraciones, con sus característicasespeciales que la vanorientando,más allá del desorden y el tumulto, a lograr la independencia y fortalecerla en un régimen de abiertade\r\n\r\n\r\n', 356, 00000000000000000009, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 4, 0),
(900, 'SER', 'ESC', 'La Escala del tiempo', '1986-12-12', '2005-10-21', 'Desde hace unos meses surgieron varios sitios que nos permiten reseñar informaciòn sobre una línea de tiempo. Y alguien se encargó, obteniendo un excelente trabajo, de recopilar la historia del libro.\r\n\r\nDesde la invención del papel (el la actualmente conflictiva zona del Tibet), los primeros escritos, el impulso de la iglesia y sus evangelios, la invención de la imprenta, la primer biblia, la primer impresión del hombre de Vitrubio, y la montaña de literatura que ha surgido desde ese momento en adelante.\r\n\r\nPor cada “hito” representado hay imágenes, un mapa del lugar y un texto explicativo (en inglés). Se puede ver en formato de linea de tiempo (timeline), listado cronológico (list) o en forma de revista en linea (flipbook).', 189, 00000000000000000004, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `titulo_has_autor`
--

CREATE TABLE IF NOT EXISTS `titulo_has_autor` (
  `titulo_dewey_id_categoria_dewey` smallint(3) unsigned zerofill NOT NULL,
  `titulo_id_apellido` varchar(3) COLLATE latin1_spanish_ci NOT NULL,
  `titulo_id_titulo` varchar(3) COLLATE latin1_spanish_ci NOT NULL,
  `autor_id_autor` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`titulo_dewey_id_categoria_dewey`,`titulo_id_apellido`,`titulo_id_titulo`,`autor_id_autor`),
  KEY `fk_titulo_has_autor_autor1` (`autor_id_autor`),
  KEY `fk_titulo_has_autor_titulo1` (`titulo_dewey_id_categoria_dewey`,`titulo_id_apellido`,`titulo_id_titulo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcar la base de datos para la tabla `titulo_has_autor`
--

INSERT INTO `titulo_has_autor` (`titulo_dewey_id_categoria_dewey`, `titulo_id_apellido`, `titulo_id_titulo`, `autor_id_autor`) VALUES
(100, 'HAL', 'LAC', 1),
(700, 'FAI', 'LAS', 1),
(100, 'DAD', 'DAT', 2),
(900, 'SER', 'ESC', 4),
(600, 'BES', 'FUE', 5),
(000, 'IRI', 'FAB', 6),
(700, 'ABR', 'OPU', 7),
(300, 'ACE', 'ALM', 8),
(800, 'ACE', 'NAT', 9),
(500, 'ESC', 'CHA', 10),
(100, 'NIE', 'ASI', 11),
(700, 'ACO', 'LOS', 11),
(400, 'TRU', 'POR', 13),
(300, 'ACO', 'EPI', 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `dni` int(10) unsigned NOT NULL,
  `clave` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `direccion` varchar(70) COLLATE latin1_spanish_ci NOT NULL,
  `nombre_usuario` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  `apellido1_usuario` varchar(25) COLLATE latin1_spanish_ci NOT NULL,
  `apellido2_usuario` varchar(25) COLLATE latin1_spanish_ci DEFAULT NULL,
  `telefono` int(10) unsigned DEFAULT NULL,
  `email` varchar(45) COLLATE latin1_spanish_ci DEFAULT NULL,
  `es_administrador` tinyint(1) NOT NULL,
  `plantilla_id_plantilla` tinyint(3) unsigned NOT NULL,
  `titulo_dewey_id_categoria_dewey` smallint(3) unsigned zerofill DEFAULT NULL,
  `titulo_id_apellido` varchar(3) COLLATE latin1_spanish_ci DEFAULT NULL,
  `titulo_id_titulo` varchar(3) COLLATE latin1_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`dni`),
  KEY `fk_usuario_plantilla1` (`plantilla_id_plantilla`),
  KEY `fk_usuario_titulo1` (`titulo_dewey_id_categoria_dewey`,`titulo_id_apellido`,`titulo_id_titulo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcar la base de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`dni`, `clave`, `direccion`, `nombre_usuario`, `apellido1_usuario`, `apellido2_usuario`, `telefono`, `email`, `es_administrador`, `plantilla_id_plantilla`, `titulo_dewey_id_categoria_dewey`, `titulo_id_apellido`, `titulo_id_titulo`) VALUES
(1, '1', 'dirección1', 'lector1', 'lector1-apellido1', 'lector1-apellido2', NULL, NULL, 0, 1, NULL, NULL, NULL),
(2, '2', 'dirección2', 'administrador1', 'administrado1-apellido1', 'administrador1-apellido2', NULL, NULL, 1, 1, NULL, NULL, NULL);

--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `acceso`
--
ALTER TABLE `acceso`
  ADD CONSTRAINT `fk_acceso_usuario1` FOREIGN KEY (`usuario_dni`) REFERENCES `usuario` (`dni`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `titulo`
--
ALTER TABLE `titulo`
  ADD CONSTRAINT `fk_titulo_dewey1` FOREIGN KEY (`dewey_id_categoria_dewey`) REFERENCES `dewey` (`id_categoria_dewey`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_titulo_editorial1` FOREIGN KEY (`editorial_id_editorial`) REFERENCES `editorial` (`id_editorial`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `titulo_has_autor`
--
ALTER TABLE `titulo_has_autor`
  ADD CONSTRAINT `fk_titulo_has_autor_autor1` FOREIGN KEY (`autor_id_autor`) REFERENCES `autor` (`id_autor`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_titulo_has_autor_titulo1` FOREIGN KEY (`titulo_dewey_id_categoria_dewey`, `titulo_id_apellido`, `titulo_id_titulo`) REFERENCES `titulo` (`dewey_id_categoria_dewey`, `id_apellido`, `id_titulo`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_usuario_plantilla1` FOREIGN KEY (`plantilla_id_plantilla`) REFERENCES `plantilla` (`id_plantilla`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_usuario_titulo1` FOREIGN KEY (`titulo_dewey_id_categoria_dewey`, `titulo_id_apellido`, `titulo_id_titulo`) REFERENCES `titulo` (`dewey_id_categoria_dewey`, `id_apellido`, `id_titulo`) ON DELETE NO ACTION ON UPDATE NO ACTION;
