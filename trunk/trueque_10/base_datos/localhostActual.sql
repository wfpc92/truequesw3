-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 05-06-2013 a las 16:45:47
-- Versión del servidor: 5.5.24-log
-- Versión de PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `trueque`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `categoria_id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) NOT NULL,
  PRIMARY KEY (`categoria_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`categoria_id`, `nombre`) VALUES
(1, 'Antiguedades'),
(2, 'Camaras'),
(3, 'Casas'),
(4, 'Celulares'),
(5, 'Cine'),
(6, 'Computadores'),
(7, 'Deporte'),
(8, 'Electrodomesticos'),
(9, 'Joyas'),
(10, 'Juguetes'),
(11, 'Libros'),
(12, 'Licores'),
(13, 'Musica'),
(14, 'Vehiculos'),
(15, 'Videojuegos'),
(16, 'Otros');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cuidad`
--

CREATE TABLE IF NOT EXISTS `cuidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=79 ;

--
-- Volcado de datos para la tabla `cuidad`
--

INSERT INTO `cuidad` (`id`, `nombre`) VALUES
(1, 'Popayan'),
(2, 'Cali'),
(3, 'Aguachica Cesar'),
(4, 'Apartadó Antioquia'),
(5, 'Arauca'),
(6, 'Armenia Quindío'),
(7, ' Barrancabermeja '),
(8, 'Barranquilla'),
(9, 'Bello Antioquia'),
(10, 'Bogotá '),
(11, 'Bucaramanga '),
(12, 'Buenaventura '),
(13, 'Buga '),
(14, 'Cali '),
(15, 'Cartago '),
(16, 'Cartagena Bolívar'),
(17, ' Caucasia Antioquia'),
(18, ' Cereté Córdoba'),
(19, 'Chia Cundinamarca'),
(20, 'Ciénaga '),
(21, 'Chia Cundinamarca'),
(22, 'Ciénaga Magdalena'),
(23, 'Cúcuta Norte '),
(24, 'Dosquebradas '),
(25, 'Duitama Boyacá'),
(26, 'Envigado Antioquia'),
(27, 'Facatativá '),
(28, 'Florencia Caqueta'),
(29, 'Floridablanca '),
(30, 'Fusagasugá '),
(31, 'Girardot'),
(32, 'Girón Santander'),
(33, 'Ibagué Tolima'),
(34, 'Ipiales Nariño'),
(35, 'Itagüí Antioquia'),
(36, 'Jamundí '),
(37, 'Lorica Córdoba'),
(38, 'Los Patios '),
(39, 'Magangué Bolivar'),
(40, 'Maicao Guajira'),
(41, 'Malambo Atlántico'),
(42, 'Manizales Caldas'),
(43, 'Medellín Antioquia'),
(44, 'Melgar Tolima'),
(45, 'Montería Córdoba'),
(46, 'Neiva Huila'),
(47, 'Ocaña Santander'),
(48, ' Paipa, Boyacá'),
(49, 'Palmira '),
(50, 'Pamplona '),
(51, 'Pasto Nariño'),
(52, 'Pereira Risaralda'),
(53, 'Piedecuesta '),
(54, 'Pitalito Huila'),
(55, 'Popayán Cauca'),
(56, 'Quibdó Choco'),
(57, 'Riohacha Guajira'),
(58, 'Rionegro'),
(59, 'Sabanalarga'),
(60, 'Sahagún Córdoba'),
(61, 'San Andrés Isla'),
(62, 'Santa Marta'),
(63, 'Sincelejo Sucre'),
(64, 'Soacha '),
(65, 'Sogamoso'),
(66, 'Soledad Atlántico'),
(67, 'Tibú '),
(68, 'Tuluá '),
(69, 'Tumaco Nariño'),
(70, 'Tunja Boyacá'),
(71, 'Turbo Antioquia'),
(72, ' Valledupar Cesar'),
(73, 'Villa de leyva'),
(74, 'Villa del Rosario'),
(75, 'Villavicencio Meta'),
(76, 'Yopal Casanare'),
(77, 'Yumbo '),
(78, 'Zipaquirá ');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permuta`
--

CREATE TABLE IF NOT EXISTS `permuta` (
  `producto_recibe` int(20) NOT NULL,
  `producto_solicita` int(20) NOT NULL,
  `fechapermuta` date NOT NULL,
  KEY `fk_producto_solicita` (`producto_solicita`),
  KEY `fk_producto_recibe` (`producto_recibe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `permuta`
--

INSERT INTO `permuta` (`producto_recibe`, `producto_solicita`, `fechapermuta`) VALUES
(1, 100, '2013-06-05'),
(2, 101, '2013-06-05'),
(2, 101, '2013-06-05');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE IF NOT EXISTS `producto` (
  `producto_id` int(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `imagen` varchar(300) NOT NULL DEFAULT 'http://localhost/trueque_10/images/default.jpg',
  `fechaingreso` date NOT NULL DEFAULT '0000-00-00',
  `usuario_id` int(20) NOT NULL,
  `estado_publicacion` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`producto_id`),
  KEY `nombre` (`nombre`),
  KEY `fk_usuario_producto` (`usuario_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=114 ;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`producto_id`, `nombre`, `descripcion`, `categoria_id`, `imagen`, `fechaingreso`, `usuario_id`, `estado_publicacion`) VALUES
(1, 'Camara Antigua Kodak', 'Camara con proceso de  placa húmeda con colodión húmedo. Es necesario que el fotógrafo prepare artesanalmente las placas, en un cuarto oscuro de  estudios fotográficos.', 1, 'http://localhost/trueque_10//images/camara.jpg', '2013-04-02', 25, 0),
(2, 'Pelicula Avengers', 'Formato : DVD.\r\nPelícula estadounidense de superhéroes de 2012 escrita y dirigida por Joss Whedon. Fue producida por Marvel Studios y distribuida por Walt Disney Pictures, y basada en el cómic homónimo de Marvel Comics. Es parte del Universo Cinematográfico de Marvel, que enlaza varias películas de superhéroes de Marvel como Iron Man (2008), El Increíble Hulk (2008), Iron Man 2 (2010), Thor (2011) y Capitán América: el primer vengador (2011)', 5, 'http://localhost/trueque_10//images/avengers.jpg', '2013-06-03', 13, 0),
(3, 'PC de Escritorio HP Pavilion a6200la', 'Procesador base: Pentium E2140 (C) de 1,6 GHz: Bus frontal a 800 MHz, Socket 775.\r\nConjunto de chips: Intel 945GC\r\nPlaca base: Fabricante: ECS, Nombre de la placa base: 945GCT-HM, Nombre de la placa base HP/Compaq: Livermore8-GL6', 6, 'http://localhost/trueque_10//images/campu3.jpg', '2013-05-26', 13, 1),
(4, 'Aletas BioFuse', 'Diseñadas usando materiales y tecnologías actuales, y testadas por nuestros atletas, son el complemento ideal para cualquier sesión de entrenamiento.\r\nPensadas para incrementar la velocidad en el agua, Mejora la fuerza de las piernas y la flexibilidad de los tobillos, Dos tipos de densidades: pala densa, calzante más suave y cómodo, 100% silicona.\r\nCon robustos pero flexibles accesorios y dispositivos de ayuda al entrenamiento que trabajan junto con tu cuerpo en el agua para incrementar tu fuerza, resistencia o para darte una visión clara de tu línea de nado.', 7, 'http://localhost/trueque_10//images/aletas.jpg', '2013-06-03', 13, 1),
(5, 'Olla arrocera antiaderente UNIVERSAL', 'Detalles:  Marca Universal, Vasija De aluminio con interior antiadherente , con Asas y perilla termorresistente, Tapa En vidrio templado, Capacidad1.5 libras, Contiene Vaporera / cuchara y taza medidora de plástico', 8, 'http://localhost/trueque_10//images/arroz.jpg', '2013-05-13', 13, 1),
(7, 'Muñeca Emily pratz', 'Aún se encuentra en su estuche, viene con dos mudas de ropa y una colección de zapatos, Es una muñeca articulada y tiene Como accesorios un bolso  para cada vestido, unos aretes y un anillo.', 10, 'http://localhost/trueque_10//images/barbie.jpg', '2013-05-31', 13, 1),
(8, 'Cien años de soledad', 'El libro se encuentra en muy buen estado, no se ha escrito nada sobre él y es el libro original. El libro trata de  una novela del escritor colombiano y Premio Nobel de Literatura en 1982, Gabriel García Márquez. Considerada una obra maestra de la literatura hispanoamericana y universal, es una de las obras más traducidas y leídas en español.', 11, 'http://localhost/trueque_10//images/100.jpg', '2013-05-22', 13, 1),
(9, 'Licor Cuarenta Y Tres', 'Es un licor español, de color dorado, confeccionado, según la leyenda, a partir de 43 distintos cítricos, frutas y especias del mediterráneo. Su sabor es dulce, y muy versátil, variando enormemente según la mezcla con la que se tome. Contiene un 31% de volumen de alcohol etílico.', 12, 'http://localhost/trueque_10//images/43.jpg', '2013-04-18', 13, 1),
(10, 'Acordeón', 'Formado por dos cajas armónicas de madera convenientemente estacionada  revestidas externamente en celuloide y unidas entre sí por un fuelle de cartón, piel y tela. Una de las cajas lleva un teclado que se ejecuta con la mano derecha. La otra lleva una serie de botones y se ejecuta con la mano izquierda.', 13, 'http://localhost/trueque_10//images/acordeon.jpg', '2013-06-03', 13, 1),
(12, 'MONTEREY 298 SS', 'Lancha súper deportiva, muy rápida. Navegación radical ideal para deportes acuáticos, y salidas de media travesía. Yachting Spain tours s. l. ofrece los detalles de buena fe pero no los garantiza, el comprador debería de realizar una inspección en su propio interés. . Color blanco', 14, 'http://localhost/trueque_10//images/barcoElegante.jpg', '2013-04-19', 13, 1),
(13, 'Call Of Duty World at War', 'Contiene un nuevo y amplio arsenal de armas con las que deberemos enfrentarnos a un grupo de enemigos que amenazan el plante. En total, tendremos más de 70 nuevas armas, desde rifles de asalto hasta lásers, rifles de francotirador y prismáticos de visión nocturna. incluye gráficos mejorados y cinemáticas de alta calidad. Además, las partidas estarán enriquecidas con efectos especiales y batallas muy realistas', 15, 'http://localhost/trueque_10//images/callofduty.jpg', '2013-04-16', 13, 1),
(21, 'Ferrania Rondine', 'Pequeña cámara italiana fabricada por Ferrania en 1948. Con objetivo del tipo meniscus Linear 75 mm f 8,8. Una velocidad de 1/75 sg. más pose. Un visor reflex y otro deportivo abatible. Utiliza película en rollo del tipo 127 para negativos de 4x6,5 cms.', 1, 'http://localhost/trueque_10//images/camara2.jpg', '2013-01-30', 14, 1),
(22, 'Casa Hermosa Placilla', 'Claros del Bosque\r\nLocación - Curauma, cuartos - 4  ,Baños – 3, Garajes – 2.Excelente Casa ubicada en sector de Curauma, Living y comedor separados, Amplia cocina, Bar, 5 dormitorios (principal en suite) 1 Oficina, 2 baños completos, 1/2 baño Visita, Lavandería, 2, Invernadero/observatorio, Patio servicio, Amplia terraza de pino Oregón ( 25 M2 aprox.), Piscina revestida en azulejos. Quincho, mesón, Parrilla, Horno de barro, Estacionamiento 2 autos con portón eléctrico Cerco eléctrico, alarma Riego automático, Calefacción Central.', 3, 'http://localhost/trueque_10//images/casaHermosaPlacilla.jpg', '2013-04-10', 14, 1),
(23, 'Nokia Lumia 925', 'El Nokia Lumia 925 es la evolución del Lumia 920, esta vez utilizando metal para su chasis combinado con el policarbonato, resultando en un smartphone más delgado y liviano. Posee una pantalla AMOLED ClearBlack de 4.5 pulgadas a 1280x768 pixels, cámara de 8.7 megapixels con lente Carl Zeiss, flash LED dual y estabilización óptica de imagen, procesador dual-core Snapdragon a 1.5GHz, 1GB de RAM, 16GB de almacenamiento interno, batería de 2000mAh, conectividad HSPA+ y 4G LTE, y corre Windows Phone 8.', 4, 'http://localhost/trueque_10//images/nokia-lumia-925-launch-10_610x407.jpg', '2013-03-26', 14, 1),
(24, 'Clash of the Titans', 'película estadounidense de fantasía, remake de una película de 1981 del mismo nombre.\r\nPerseo (Sam Worthington) es hijo del dios Zeus (Liam Neeson) y la esposa humana de Acrisio (Jason Flemyng), el antiguo rey de Argos. En otras palabras: Perseo es un semi-dios. Al enterarse de lo sucedido, Acrisio asesina a su mujer y encierra el cadáver junto al bebé recién nacido en un ataúd que arroja al mar. Por esta acción de maldad, el hombre es convertido en una bestia por los dioses. Mientras tanto, el pescador Dictis (Pete Postlethwaite) encuentra el ataúd y adopta al niño.', 5, 'http://localhost/trueque_10//images/clashofthetitanss.jpg', '2013-03-14', 14, 1),
(25, 'PC de Escritorio HP Pavilion w5030la', 'Hardware: Pentium4 515 (P) 2.93 GHz: bus frontal a 533 MHz, Zócalo LGA775, Juego de chips: Intel 915GV, Placa base: Fabricante: Asus, Nombre de la placa base: PTGD-LA, Nombre de la placa base de HP: Goldfish2-GL8E ,Unidad de disco duro: 120 GB SATA, 7200 rpm, Monitor con LCD plano de 15" con altavoces integrados, Monitor con LCD plano de 17" con altavoces integrados, Unidad 16x DVD(+/-)R/RW DL (debe utilizar discos de medios de doble capa a fin de aprovechar la tecnología DL)', 6, 'http://localhost/trueque_10//images/copmpu.jpg', '2013-04-21', 14, 1),
(26, 'Balon de futbol americano', 'Esta autografiada por uno de los más grandes jugadores de la liga inglesa. La pelota reglamentaria de fútbol americano es de goma inflada y está recubierta de cuero o goma. Tiene la forma de un esferoide alargado, con una circunferencia de 72,4 cm alrededor del eje largo y 54 cm alrededor del eje corto; tiene entre 397 y 425 g de peso', 7, 'http://localhost/trueque_10//images/balonAmericano.jpg', '2013-04-17', 14, 1),
(27, 'Equipo de sonido Sony Genezi', 'Características: Puerto USB capaz de reproducir y grabar en MP3, Reproducción de: discos CD-R/CD-RW y MP3, Potencia máxima: 4400W (PMPO), Potencia real: 400W (RMS), CD, Radio, Casete, Audio y USB (Entrada Portátil), Control remoto', 8, 'http://localhost/trueque_10//images/equipo.jpg', '2013-02-27', 14, 1),
(28, 'Carro juguete', 'Hermoso regalo para tu hijo     tiene sonidos reales    volante direccional y   pito. Reconocida marca  -se entrega en su respectiva caja .Regalo ideal para su hijo', 10, 'http://localhost/trueque_10//images/cajaconCarros.jpg', '2013-05-22', 14, 1),
(29, 'Accesorios para mujer', 'Cadena de plata con dijes en forma de estrella y luna. Esta acompañada por una pulsera y un anillo. Acero quirúrgico, cadena plata italiana.', 9, 'http://localhost/trueque_10//images/acces.jpg', '2013-06-02', 14, 1),
(30, 'Álgebra de Baldor', 'es un libro del matemático cubano Aurelio Baldor. La primera edición se produjo el 19 de junio de 1941. El texto de Baldor es el libro más consultado en escuelas y colegios de Latinoamérica, incluso más que El Quijote de Miguel de Cervantes. El Álgebra de Baldor tiene 5.790 puntos en total', 11, 'http://localhost/trueque_10//images/algebra.jpg', '2013-05-31', 14, 1),
(31, 'Crema de Licor Amarula', 'Amarula es una crema de licor que se elabora en Sudáfrica. Se hace con azúcar, nata y el fruto del árbol africano marula (Sclerocarya birrea), también llamado localmente «árbol del elefante». Ha tenido cierto éxito internacional en competiciones de bebidas alcohólicas, ganando una medalla de oro en la San Francisco World Spirits Competition de 2006.', 12, 'http://localhost/trueque_10//images/amarula.jpg', '2013-04-25', 14, 1),
(32, 'Amplificador Laney de 30 watts', 'Excelente amplificador marca laney de 30 watts para guitarra. input, crunge, master, bass, mid, treble, cd, line in, ext speaker, parlante de 10". El amplificador es completamente garantizado, se entrega probado y sellado en su caja, expedimos factura, somos tienda real, por lo tanto puedes llegar a nuestra tienda, verlo, tocarlo y escucharlo.', 13, 'http://localhost/trueque_10//images/amplificador.jpg', '2013-06-03', 14, 1),
(33, 'Camion DAF - CF85. 380', 'Camion en perfecto estado. cuatro ejes con eje direccional y elevable. monta una grua hiab 122 xs. tiene una capacidad de carga de 18tn. intarder, aire acondicionado, ruedas al 75 por ciento, laterales de aluminio 80cm. el eje direccional, tiene el mismo giro que el delantero camion comodo y practico No contesto mensajes solo tlf. Color amarillo', 14, 'http://localhost/trueque_10//images/camion.jpg', '2013-05-15', 14, 1),
(34, 'XBox 360', 'están su unidad central de procesamiento basado en un IBM PowerPC y su unidad de procesamiento gráfico que soporta la tecnología de Shaders Unificados. El sistema incorpora un puerto especial para agregar un disco duro externo y es compatible con la mayoría de los aparatos con conector USB gracias a sus puertos USB 2.0. Los accesorios de este sistema pueden ser utilizados en una computadora personal como son los mandos y el volante Xbox 360', 15, 'http://localhost/trueque_10//images/images.jpg', '2013-04-27', 14, 1),
(36, 'Lampara Araña', 'Apliques de techo, Estilo: Cristal, Contemporáneo, Luz de Techo con Abalorios, Espacio Recomendado: Sala de estar, Dormitorio, Tamaño del Espacio Sugerido: 50-60?, Número de Luces: 11 y Más, Acabado: Cromo, Materiales: Cristal, Acero Inoxidable\r\nDimensiones del Producto: 63L*63W*50H cm (25L*25W*20H inch), Tipo de Lámpara: Halógeno\r\nDirección del haz de luz: Luz Downlight, Fuente de Alimentación: 20W*18, Base de Bombilla: 18*G4, Bombilla Incluida o No: Bombilla Incluida, Voltaje: 110-120 V, 220-240V, Ancho/Diámetro: 60-80cm, Altura: 50-80cm, Peso Neto (Kg): 5, Nota: La placa del techo puede variar a la de la foto en relación de su ubicación regional.', 1, 'http://localhost/trueque_10//images/candelabro1.jpg', '2013-03-25', 15, 1),
(37, 'Casa Bosque', 'El terreno es 1.497 metros cuadrados, construido 290 mts cuadrados,calefacción por caldera y sistema de radiadores, con circuito de día y noche, termo paneles, piso flotante, amplio living separado del living, cocina, comedor de diario, lavadero, despensa, dos portones automáticos, 2 autos bajo\ntecho, escritorio, 5 dormitorios ( 3 de ellos en suite ) más pieza de servicio\ncon baño, más baño de visita, total: 6 dormitorios, 5 baños.\nLa casa cuenta con una mansarda de app 80 mts cuadrados, la cual podría habilitarse si la persona queda corta de espacio, no está terminada, pero tiene\nventanas con protecciones, arranque sanitario, de luz, losa, sólo le falta el\npiso y la escalera ( en caso de habilitarse )la casa la proyectó un arquitecto, la construyó constructora pardo, tiene absolutamente todos los papeles al día.', 3, 'http://localhost/trueque_10//images/casaBosque.jpg', '2013-06-03', 15, 1),
(38, 'Nokia Asha 501', 'Al Nokia Asha 501 es un teléfono celular corriendo la nueva plataforma asha 1.0 con pantalla qvga táctil de 3 pulgadas, cámara de 3.2 megapixels, wi-fi, bluetooth, radio fm y ranura microsd.', 4, 'http://localhost/trueque_10//images/asha501cover.jpg', '2013-05-14', 15, 1),
(39, 'Camara Fotografica Asahi Optical', 'Esta cámara fabricada en el año de 1978 por asahi optical es la reflex más pequeña del mundo, cabe en la palma de la mano y tiene una apariencia casi de juguete. Sus características son: medición ttl, disparo automático en un rango de velocidades que van de 1 a 1/750 de sg., diafragmas también automáticos de f 2,8 a 18, de estas dos funciones se encarga un mismo mecanismo situado en la cámara delante del espejo reflex y visible a primera vista cuando no tiene un objetivo montado, éstos no van dotados del mecanismo de palas para los diafragmas, pero sí con un anillo de enfoque, el cual podemos ajustar en el visor en una pantalla mate y por imagen partida. Utiliza para la toma de fotografías cartuchos de película del tipo 110 (13x17mm) y esta considerada por algunos autores como un sistema reflex de sistema completo, pues tiene una gama de seis ópticas intercambiables, flash y motor adaptables, parasoles y filtros específicos. funciona con dos pilas de botón tipo sr44.', 2, 'http://localhost/trueque_10//images/5586076382_2c23c9d80f_z.jpg', '2013-05-16', 15, 1),
(40, 'Pelicula El Rito', 'Formato: DVD. El rito, cuyo título original en inglés es The Rite, es una película de terror. Michael Kovak (Colin O''Donoghue) está decepcionado con su padre, Istvan (Rutger Hauer) y con la vida familiar, por lo que decide entrar en un seminario y renunciar sus votos. El tiempo pasa y Michael se convertirá en sacerdote, sin embargo escribe una carta de renuncia al Padre Matthew (Toby Jones), alegando falta de fe. Mientras el Padre Matthew trata de renovar la fe de Michael algo sucede y el Padre Superior le dice que está llamado a ser sacerdote, tenga o no fe. Tras aceptar a regañadientes una invitación para viajar a Roma, para asistir a un curso sobre exorcismo.', 5, 'http://localhost/trueque_10//images/elrito.jpg', '2013-04-12', 15, 1),
(41, 'Dell Inspiron', 'Procesador 2.ª generación de procesadores Intel Core i3-2330M ,Memoria RAM DDR3 SDRAM de 4.096 MB a 1.333 MHz canal dual [1x4.096] GPU Intel HD Graphics 3000; Tarjeta gráfica NVIDIA 525m de 1GB Pantalla WLED de alta definición , Almacenamiento SATA disco duro de hasta 500 GB3 , Puerto VGA; Conector de red 10/100 integrado; LAN (RJ45); Conector de adaptador de CA; Conectores de audio (1 de salida de línea, 1 de entrada de micrófono); Lector de tarjetas 8 en 1Dimensiones\nAnchura: 376,0 mm (14,80"); Altura: 29,7 mm (1,17") por delante / 33,8 mm (1,33") por detrás; Profundidad: 260,2 mm (10,24”) Peso 2,65 kg (5,84 libras)', 6, 'http://localhost/trueque_10//images/dellinspiron.jpg', '2013-05-06', 15, 1),
(42, 'Balón de Baloncesto College', 'Piel rugosa, o material sintético, que facilita el agarre de los jugadores aún con las manos sudadas es de color negro, Circunferencia: 68 - 73 cm, Diámetro: 23-24 cm, Peso: 567 - 650 g.\r\nel balón está diseñado de tal manera que soltado desde 1,80 m de altura, bote entre 1,40 y 1,60 m de altura.', 7, 'http://localhost/trueque_10//images/balondeBaloncesto.jpg', '2013-06-03', 15, 1),
(43, 'Equipo Samsung', 'Capacidad para 1 disco, Pantalla 2C-FLT disponible, Tipo bandeja, Tipo de altavoz abierto, Repetir / Saltar / Buscar disponible, Cronómetro / Reloj / Apagado automático disponible, Demostración disponible, Temporizador para grabación de radio disponible, Giga Sound Blast disponible, Altavoz con luces LED disponible, Volumen con luces LED disponible, Respuesta de frecuencia de 20 Hz ~ 20 KHz, EZ MP3 Maker disponible, Crystal Amplifier Plus disponible, Cambio automático disponible.', 8, 'http://localhost/trueque_10//images/equipo2.jpg', '2013-06-03', 15, 1),
(44, 'Libro Las Chicas de Alambre', 'Las chicas de alambre es un libro muy interesante que habla de la vida de las modelos de cómo es su día rutinario y como son los criterios que una modelo debe de tener; realmente me parece algo impresionante como pueden llegar a quedar esas modelos durante y después de estar en la anorexia y como se pueden envolverse tanto en ese mundo del modelaje; me parece que el libro de las chicas de alambre es un gran libro.\r\nEl libro se encuentra en muy buen estado, está como nuevo.', 11, 'http://localhost/trueque_10//images/IMM(2).JPG', '2013-06-03', 15, 1),
(45, 'Coches de Metal de Cars Disney', 'Juego de 2 coches en miniatura (Francesco Bernoulli y Rayo McQueen)con set de parqueadero y pista incluidos. Se encuentran en buen estado.', 10, 'http://localhost/trueque_10//images/car.jpg', '2013-06-04', 15, 1),
(46, 'Licor Royale Deluxe', 'La botella fue creada por el joyero Donald Edge, quien ha realizado una verdadera joya. El famoso recipiente tiene un estilo de circular con un símbolo medieval de atribución cristiana con la cruz sobre un globo terráqueo.\n\nAdemás, esta botella y el licor de frambuesas que lleva en su interior que se han convertido en el licor más caro del mundo según los Records Guinness, fue utilizado en el desayuno más caro del mundo.', 12, 'http://localhost/trueque_10//images/BebidaLicorFino1.jpg', '2013-05-02', 15, 1),
(47, 'Bateria YAMAHA', 'Como nueva, muy poco uso. Tiene maletas para el bombo y para el timbal, ambos tienen contras, los cuatro toms son sin contras, al estilo antiguo. Tiene un soporte para crash, para el carles y los platos que se ven en la foto, lo unico que falta es el soporte de la caja, lo demas todo original y como nuevo.', 13, 'http://localhost/trueque_10//images/bateria.jpg', '2013-04-17', 15, 1),
(48, 'Toyota Yaris', 'Único dueño alarma cierre centralizado alza vidrios puertas delanteras neumáticos michelin recientes, batería nueva en perfecto estado, vehículo con una dirección muy cómoda ideal para primer auto, o para gente joven.', 14, 'http://localhost/trueque_10//images/the-new-toyota-yaris-03.jpg', '2013-06-04', 15, 1),
(49, 'Cadena Corazon', 'Realizada en oro blanco, pavé de brillantes de calidad river por pétalos y un diamante  amarillo para aportar una nota de color. Femenina, elegante y sofisticada, una pieza exclusiva', 9, 'http://localhost/trueque_10//images/cadena4.jpg', '2013-06-04', 15, 1),
(50, 'Controles XBox 360', 'Tecnología inalámbrica a 2,4 GHz con cobertura de 9 metros\r\nUsa hasta cuatro controles de manera simultanea con una consola\r\nPuerto de audífono integrado para jugar y comunicarte en Xbox LIVE\r\nVibración ajustable para alargar la duración de las baterías\r\nUsa el botón Guía Xbox 360 para mantenerte en contacto con tus amigos, acceder a tus juegos o para encender y apagar tu Xbox 360. Están como nuevos. Colores: Plateado y Rojo', 15, 'http://localhost/trueque_10//images/controles.jpg', '2013-06-04', 15, 1),
(51, 'Lavadora Appiani 530 Lb', 'Lavado a vapor, esteriliza las prendas.\r\n11,4 kg de carga. Sistema de secado Direct Condensing Dry. Panel inclinado ergonómico. Tecnología antibacterial Nano silver. Bloqueo para niños. Limpieza de tambor. Bajo consumo energético.', 8, 'http://localhost/trueque_10//images/lavadora.jpg', '2013-06-04', 15, 1),
(52, 'Antiguo Candelabro de Bronce', 'Antiguo candelabro de bronce y cristal cortado; 90 cms. de alto X 70 cms. de ancho, electrificado para 12 luces. En muy buen estado de conservación.', 1, 'http://localhost/trueque_10//images/candelabroPared.jpg', '2013-06-04', 16, 1),
(53, 'Camara Olympus SP500UZ', 'Camara de fotos semiprofesional olympus sp500uz completamente nueva mas dos targetas de memoria xd una de 256m y otra de 2g mas funda tiene 4 pilas recargables y cargador caracteristicas 6 millones de píxeles Objetivo zoom 10x.', 2, 'http://localhost/trueque_10//images/cam2.jpg', '2013-06-04', 16, 1),
(54, 'Casa Campestre', 'Características: hall de acceso, cocina amoblada, living comedor, terraza, dormitorio principal en suite, 2 dormitorios, 1 baño completo, 1 estacionamiento, bodega, guardia las 24 horas, acceso restringido, piscina, 2 quinchos, estacionamiento de visita', 3, 'http://localhost/trueque_10//images/acienda.jpg', '2013-06-04', 16, 1),
(55, 'Celular Nokia 301', 'El nokia 301 es un teléfono celular series 40 con una pantalla de 2.4 pulgadas, cámara de 3.2 megapixels, aplicaciones facebook, twitter, whatsapp, variedad de colores y cuenta también con una versión sim dual.', 4, 'http://localhost/trueque_10//images/nokia-301-feature.jpg', '2013-06-04', 16, 1),
(57, 'Pelicula Blu Ray+DVD  El Turista', 'Película de 2010, remake de Anthony Zimmer (2005), dirigida por Florian Henckel von Donnersmarck y protagonizada por Johnny Depp y Angelina Jolie.', 5, 'http://localhost/trueque_10//images/foto_12027.jpg', '2013-06-04', 16, 1),
(58, 'Dell Optiplex 755', 'Computadora de escritorio marca DELL Modelo Optiplex 755, de torre, con HDD de 160GB SATA, Memoria de 2GB DDR2, CD/DVD Lector SATA, 8 puertos USB, Microprocesador CORE 2 VPro de Doble Nucleo a 2.33GHz con bus de 1,333MHz y Cache de L2 de 4MB, con Monitor de LCD de 15", con teclado, Mouse y bocinas. le he instalado W7 Ultimate y trabaja perfectamente', 6, 'http://localhost/trueque_10//images/delloptiplex.jpg', '2013-03-05', 16, 1),
(59, 'Bate de Beisbol Compuesto', 'Material: Fibra de carbono y aluminio, con  recubrimiento de pintura azul y agarre de goma. Cuenta con un año de uso.', 7, 'http://localhost/trueque_10//images/bates.jpg', '2013-06-02', 16, 1),
(60, 'Licuadora Avance Collection HR1869/60', 'La licuadora Avance Collection HR1869/60 de Philips te permitirá disfrutar de excelentes zumos gracias a su potente motor de 2 velocidades de 700 W.\r\nSu tubo de alimentación XXL acepta frutas y verduras enteras. ¡No hay necesidad de cortar los ingredientes! Además, te permite hacer hasta 2,5 litros de zumo y servirlo fácilmente. \r\nEquipada con elementos lavables en el lavavajillas, la licuadora de Philips Avance Collection HR1869/60 también recupera toda la pulpa en el mismo lugar para un vaciado fácil.', 8, 'http://localhost/trueque_10//images/licuadora.jpg', '2013-06-04', 16, 1),
(61, 'Anillo de Con Imitación de Diamante Dorado', 'Anillo de moda para mujer de color oro. Los materiales son cristal y aleación. Dimensiones: 13x8x5', 9, 'http://localhost/trueque_10//images/anilloGrande.jpg', '2013-04-25', 16, 1),
(62, 'Carro de Control Remoto', 'Carro de Control Remoto Land-Rover RRS Autorizado RC, Fuente de poder: Brush Electric, Tipo de Auto: On-Road, Color: Negro/Blanco, Distancia Control Remoto: 20m, Batería para el transmisor: 9V.', 10, 'http://localhost/trueque_10//images/carrito.jpg', '2013-04-17', 16, 1),
(63, 'Libro Original La Divina Comedia', 'La divina comedia es una de las obras señeras de la humanidad. Nadie hasta hoy ha logrado alcanzar las cumbres de la inspiración y la fantasía arrebatadora de que hace gala el genial florentino en su poema inmortal. Es el libro original y se encuentra en perfecto estado.', 11, 'http://localhost/trueque_10//images/comedia.jpg', '2013-06-04', 16, 1),
(64, 'Chambord Liqueur Royale', 'Licor elaborado en el valle del Loira en Francia. Botella esférica con una filacteria dorada en el medio cuerpo, y en el cuello está rematada con una corona dorada. El licor tiene un profundo color rojizo púrpura. Al ser totalmente natural y sin conservantes, eso significa que debe ser bebido antes de los seis meses tras su apertura. Tiene un contenido del 16,5% en alcohol por volumen.', 12, 'http://localhost/trueque_10//images/chambord-licor-frambuesa-importado-frances.jpg', '2013-06-04', 16, 1),
(65, 'Flauta dulce Yamaha YRS-23', 'Sistema: Alemán. Construcción: Agujero doble. Realización: 3 piezas. Acabado de la superficie: Blanco. Cabeza: Cabezal de plástico. Material: Plástico. Afinación: Do - La = 442 Hz. Característica: Fácil mantenimiento y robusta, ¡Ideal para principiantes!. Accesorios: Funda , Tabla de digitación.', 13, 'http://localhost/trueque_10//images/flauta.jpg', '2013-06-04', 16, 1),
(66, 'Chevrolet Aveo 2012', 'Chevrolet aveo año 2012 totalmente nuevo tapiceria de tela perfecto estado', 14, 'http://localhost/trueque_10//images/chevrolet-aveo-2012_MLV-F-TUC_43221542_1.jpg', '2013-06-04', 16, 1),
(67, 'WarCraft PC', 'Las poderosas razas de la Alianza y la Orda continúan su feroz guerra, en esta tercera entrega de una de las sagas de estrategia más populares de PC y ahora lo tendrás en tu pc, para que armes tus estrategias y seas el mejor en tu raza. Vistosos escenarios y mapeados completamente tridimensionales. Incluye elementos y situaciones más propias de estrategia. Para edades superiores a los 12 años. Totalmente en español.', 15, 'http://localhost/trueque_10//images/craft.jpg', '2013-06-03', 16, 1),
(68, 'Carroza Antigua', 'Preciosa carroza antigua de hojalata. Años 30s. Muy grande.Posiblemente repintado de epoca, y posible manufactura española. A reparar rueda trasera y precisara reparo, limpieza y restauración porque seguro que faltaran complementos. Muy bonita, tal cual salida de una casa catalana antigua.', 1, 'http://localhost/trueque_10//images/carroosa.jpg', '2013-04-25', 17, 1),
(69, 'Nikon Coolpix P1', 'proporciona compatibilidad con las cámaras Coolpix P1 y P2 utilizando Nikon Wireless Camera Setup Utility v2.1 para conectarse inalámbricamente a sistemas con Windows Vista (versión de 32 bits). Esta actualización permite la descarga e instalación desde sistemas enumerados de Macintosh, pero la actualización no es para sistemas Macintosh. Puedes actualizar el firmware de la cámara a través de un sistema Mac para uso con sistemas Windows Vista. La conexión inalámbrica a ordenadores Macintosh basados en Intel no está garantizada con este firmware.', 2, 'http://localhost/trueque_10//images/cam3.jpg', '2013-03-13', 17, 1),
(70, 'Nikon Coolpix P100', 'Su cuerpo esta diseñado para un buen agarre. Sus fotos son de buena calidad, nítida resolución para captar los detalles + finos, recortar de forma creativa y producir buenas ampliaciones.\r\nSus 10.3 MP te permite crear impresiones de 16'' x 20''. Su 26x de zoom óptico gran angular te permite captar paisajes de enormes dimensiones, en 1ros. planos de la acción tienen lugar en el campo de béisbol o fútbol. Posee un sensor CMOS de nueva iluminación trasera. Ráfaga de disparo rapido de aprox. 120fps. para imágenes de hasta 1.1 MP.', 2, 'http://localhost/trueque_10//images/cam4.jpg', '2013-06-04', 17, 1),
(71, 'Casa Finca', 'Bella casa en condominio jardines de curauma, condominio cerrado con portón eléctrico y cito fono. características: primer piso: hall de acceso, baño de visita, dormitorio matrimonial con amplios closet y baño en suite con vanitorios de mármol, cocina amplia con despensa, horno, cocina y campana empotrada y comedor de diario. segundo piso: sala de estar, 2 dormitorios con closet, baño de visita completa, patio amplio con pasto, quincho y terrazas con hermoso techo de madera bodega', 3, 'http://localhost/trueque_10//images/casaFinca.jpg', '2013-06-04', 17, 1),
(72, 'Samsung Galaxy S Advance', 'El samsung galaxy s advance es un smartphone corriendo android 2.3 gingerbread, con una pantalla super amoled de 4 pulgadas, procesador dual-core a 1ghz, 768mb de ram, cámara de 5 megapixels con flash led, 16gb de memoria interna y radio fm. Seis meses de uso. Incluye forro protector.', 4, 'http://localhost/trueque_10//images/Samsung-Galaxy-S-Advance.jpg', '2013-06-04', 17, 1),
(73, 'Harry Potter y La Orden del Fenix DVD', 'Quinto largometraje de la serie de películas Harry Potter, basada en la novela homónima de la escritora británica J. K. Rowling. La película fue dirigida por David Yates, y contó con Michael Goldenberg como guionista en reemplazo de Steve Kloves, quien realizó idéntica labor en las cuatro primeras películas.', 5, 'http://localhost/trueque_10//images/harry.jpg', '2013-06-04', 17, 1),
(74, 'Elite Pad 900', 'la HP ElitePad 900 cuenta con almacenamiento de 32 GB o 64 GB, un procesador Intel Atom Clover Trail, y 2 GB de memoria RAM. Además contará, dependiendo del modelo, con conectividad 3G o 4G. En cuanto a la pantalla, ésta tiene una resolución de 1280×800 píxeles, protección Gorilla Glass de segunda generación, y una relación de aspecto de 16:10. También incorpora dos cámaras: la frontal (de 1080p) y la trasera (con resolución de 8 megapíxeles y flash LED).', 6, 'http://localhost/trueque_10//images/eliteIpad900.jpg', '2013-06-04', 17, 1),
(75, 'Bicicleta BH', 'Dispone: De un regulador del esfuerzo con distintas posiciones de resistencia.\r\nY de una unidad electrónica que muestra simultáneamente la velocidad y rpm alternativamente, la distancia, el tiempo del ejercicio, las calorías consumidas y el pulso. Esta pantalla se encenderá automáticamente al comenzar el ejercicio, o pulsando cualquier tecla del monitor. Y se apagará automáticamente  cuando la unidad esté 4 minutos parada.', 7, 'http://localhost/trueque_10//images/bicicleta.jpg', '2013-06-04', 17, 1),
(76, 'Eliptica Pro Form 485E Profesional', 'Esta como nueva es eliptica pro form 485E la profesional no la pequeña, una útil, herramienta para hacer ejercicio cardio. Utilízala para cumplir con la recomendación de los Centros para el Control y la Prevención o como una solución para un día lluvioso cuando no puedas salir a dar tu habitual paseo o correr, tiene todas las características básicas de diseño que encontrarías en cualquier entrenador elíptico', 7, 'http://localhost/trueque_10//images/bicicleta-eliptica-wt-8-6-mag.jpg', '2013-06-04', 17, 1),
(77, 'PROFICOOK AE1002. Licuadora + Batidora de Vaso', '- Licuadora profesional construida en acero inoxidable de alta calidad\r\n- Potencia 1200 W\r\n- Jarra de zumo de 1000 ml aprox\r\n- 9 niveles de velocidad\r\n- Contenedor de pulpa de 2 l aprox.\r\n- Boca de llenado extra grande\r\n- Extrae un 30% más de zumo\r\n \r\nBatidora:\r\n- Recipiente de 1,8 l\r\n- Apto para lavavajillas\r\n- Circuito de seguridad', 8, 'http://localhost/trueque_10//images/licuadroraymas.jpg', '2013-06-04', 17, 1),
(78, 'Juego de Anillos para dama', 'Juego de tres anillos para dama. Contiene un anillo con un hermoso diamante, con aplicaciones de oro. Otro anillo con diamantes originales y finalmente una imitacion de esmeraldas.', 9, 'http://localhost/trueque_10//images/anillos.jpg', '2013-06-04', 17, 1),
(79, 'El cuervo y otros poemas', 'De Edgar Allan Poe. El cuervo habla sobre un hombre que acababa de perder a una mujer llamada Leonora y un cuervo, que toca la puerta de su cuarto mientras que el señor se repite “Es un visitante tocando quedo a la puerta de mi cuarto. Eso es todo, y nada más." Este se encuentra en el libro además de otros poemas muy interesantes.', 11, 'http://localhost/trueque_10//images/images1.jpg', '2013-06-04', 17, 1),
(80, 'Cognac Courvoisier XO Imperial', 'Tiene una reserva de 25-30 años. Creado con una mezcla de cognacs muy viejos dando como resultado un producto supremo. Con su caracter harmonioso y complejo, COURVOISIER XO Imperial es un perfecto balance de sabores intensos.\r\nEs intensamente aromático y de gran sabor con textura sedosa y un bouquet redondo con notas de naranja, albaricoque y pera. Muy rico y complejo con aromas de chocolate, vainilla y ambar, y las viejas barricas añaden exotismo y toques especioso.', 12, 'http://localhost/trueque_10//images/CourvoisierXO.jpg', '2013-06-04', 17, 1),
(81, 'Guitarra Fender CD 60 KB', '-Número de cuerdas: 6 cuerdas\r\n-Forma del cuerpo: Dreadnought\r\n-Cutaway: No\r\n-Construcción: Laminada\r\n-Color: Negro\r\n-Acabado: Brillante\r\n-Tapa armónica: Abeto rojo europeo\r\n-Fondo/Aros: Caoba\r\n-Mástil: Nato\r\n-Diapasón: Palisandro\r\n-Inlays en el diapasón: Dots\r\n-Anchura de la cejilla: 43 mm', 13, 'http://localhost/trueque_10//images/descarga.jpg', '2013-06-04', 17, 1),
(82, 'Carro clasico volkswagen', 'Con motor 1600, documentos al dia,con sonido entrada usb, cauchos nuevos, tapiceria buen diseño,pintura cromo', 14, 'http://localhost/trueque_10//images/carroAntiguo.jpg', '2013-06-04', 17, 1),
(83, 'Crash Bandiccot PlayStation 2', 'Por mucho que Crash consiga siempre frustrar sus planes, el Doctor Neo Cortex no se da nunca por vencido en sus intentos de conquistar el mundo. En esta ocasión, con la ayuda de Aku-Aku y los Elementales -unas antiguas máscaras con los poderes del fuego, el agua, el aire y la tierra-, ha conseguido dar vida a su última creación: Crunch el superbandicoot.', 15, 'http://localhost/trueque_10//images/crash.jpg', '2013-06-04', 17, 1),
(84, 'Coche antiguo', 'Se vende carrito de bebes antiguo en muy buen estado ideal para decoracion por solo 250e es probable que tenga unos 50 o 60 años esta muy poco visto.', 1, 'http://localhost/trueque_10//images/coche.jpg', '2013-06-04', 18, 1),
(85, 'Codak Retine 020', 'fabricada en friedrichshafen, alemania por aka en los años 1956-62, esta versión con un diseño muy bonito se diferencia de la anterior en que tiene fotómetro, objetivo isco-göttingen isconar 45 mm f 2,8-16, obturador prontor-svs con velocidades de b, 1-1/300 sg. y retardador, funcionando, aunque algo perezosa y con leves rastros de uso, la lente frontal tiene algo de perdida del revestimiento y arañazos provocados por una mala limpieza, dato a tener muy en cuenta a la hora de adquirir cámaras antiguas.', 2, 'http://localhost/trueque_10//images/cam5.jpg', '2013-06-04', 18, 1),
(86, 'Casa Condominio Alto Curauma', 'Condominio alto curauma, 2 piscinas, 3 quinchos, club house, minimarket, vigilancia 24 horas, primer piso:hall de acceso, dormitorio u oficce, baño de visita con extractor de aire, dormitorio matrimonial amplio con closet y baño en suite con vanitorio, queda con cortinas interior de la ventana que son nuevas. living y comedor, quedan las cortinas del living que son nuevas, cocina con muebles y queda cocina nueva, loggia cerrada y techada, segundo piso, sala de estar amplia, baño completo, 2 dormitorios con closet, patio, con cerámicos y bodega, queda toda la casa con las lámparas.', 3, 'http://localhost/trueque_10//images/casaGrande.jpg', '2013-06-04', 18, 1),
(87, 'Nokia 206', 'El nokia 206 es un sencillo teléfono celular s40 con una pantalla qvga de 2.4 pulgadas, cámara de 1.3 megapixels, bluetooth, nokia slam para compartir archivos por bluetooth, whatsapp preinstalado, y ranura microsd. también cuenta con una versión sim dual con el mismo nombre.', 4, 'http://localhost/trueque_10//images/images2.jpg', '2013-06-04', 18, 1),
(88, 'Noia Asha 210', 'El nokia asha 210 es un teléfono celular con teclado qwerty físico que ofrece rápido acceso a facebook o whatsapp según región y está destinado a competir con blackberry. se trata de un series 40 con una pantalla qvga de 2.4 pulgadas, cámara de 2 megapixels, wi-fi, radio fm y ranura microsd.', 4, 'http://localhost/trueque_10//images/images_(1).jpg', '2013-06-04', 19, 1),
(89, 'Nokia 105', 'El nokia 105 es un teléfono celular extremadamente económico, destinado a aquellos que aún no cuentan con un celular en alguna parte del mundo. el 105 posee una pantalla color, radio fm, alarmas, es a prueba de polvo y agua, linterna y una batería capaz de sostener 35 días en espera.', 4, 'http://localhost/trueque_10//images/nokia-105-1.jpg', '2013-06-04', 20, 1),
(90, 'Nokia Lumia 720', 'El nokia lumia 720 es otro smartphone de gama media de nokia, que utiliza un chasis de policarbonato en varios colores. el lumia 720 posee una pantalla lcd clearblack de 4.3 pulgadas con vidrio curvado y controles táctiles ultra sensibles que permiten operarla con guantes. también cuenta con una cámara de 6.7 pulgadas de gran apertura con lente carl zeiss.', 4, 'http://localhost/trueque_10//images/nokia_lumia_720_7_221757171040.jpg', '2013-06-04', 21, 1),
(91, 'Nokia Asha 205', 'El nokia asha 205 es un teléfono celular series 40 con una pantalla de 2.4 pulgadas y teclado qwerty físico. el asha 205 posee la nueva característica slam que permite compartir multimedia rápidamente y en forma transparente a través de bluetooth. en cuanto al resto de características, posee cámara vga, 10mb de almacenamiento interno, botón facebook para rápido acceso a la red social y ranura microsd. también existe una variante sim dual del celular bajo el mismo nombre.', 4, 'http://localhost/trueque_10//images/Nokia-Asha-205-hands-on.jpg', '2013-06-04', 22, 1),
(92, 'Camara Fotografica Sony Nek-720', 'Características del producto, color: negro, 16 megapixeles, resolución máxima de 16600000 , pantalla lcd de 2,7", zoom óptico de 10x, zoom digital de 4x,  sensor ccd, velocidad de obturador de 8-1/1600 segundos, grabador de video hd con sonido, detección de rostros y sonrisas, flash incorporado, cuenta con 13 efectos de filtro, estabilizador óptico de imagen mega o.i.s, batería de litio recargable, 1 año de garantía', 2, 'http://localhost/trueque_10//images/cam6.jpg', '2013-06-04', 22, 1),
(93, 'Casa Popayan', 'Casa prácticamente nueva menos de 1 de habitada, está en magníficas condiciones. Ubicada en uno de los sectores más tranquilos de la ciudad. La casa es duplex, en la primera planta tiene la terraza, garaje, estudio, sala, comedor, baño social, cocina integral, zona de labores y patio; en el segundo nivel se encuentra el hall de alcobas, 1 baño, 2 alcobas y la alcoba principal con baño privado y balcón.', 3, 'http://localhost/trueque_10//images/casaMejos.jpg', '2013-06-04', 22, 1),
(94, 'Apartamento Barrio San José Medellin', 'Posee 3 cuartos. Apartamento ubicado en un primer piso en un Multifamiliar, en el barrio San José, el apartamento tiene 3 alcobas, 2 baños, sala, comedor, cocina, patio y garaje, está enrejado', 3, 'http://localhost/trueque_10//images/departamentoEnCurauma.jpg', '2013-06-04', 23, 1),
(95, 'Nokia Lumia 510', 'El nokia lumia 510 es un smartphone windows phone destinado a ser el más económico de nokia. el lumia 510 cuenta con una pantalla wvga de 4 pulgadas, cámara de 5 megapixels con captura de video vga a 30fps, procesador qualcomm de 800mhz, 256mb de ram y 4gb de almacenamiento interno. el lumia 510 corre windows phone mango, pero será actualizado a windows phone 7.8.', 4, 'http://localhost/trueque_10//images/nokia-lumia-510-lead-1350993271.jpg', '2013-06-04', 23, 1),
(96, 'Camara de Video Sony Handycam 990X', 'Color: Negro, Zoom Digital: 300x, Zoom Óptico: 25x, Video cámara Full HD, Pantalla LCD /Clear Photo de 2,7", Balance de blanco, Micrófono Zoom,  altavoz monoral, Formatos de Imagen: JPEG y AVCHD, Detección de rostros, Sistema de filtro de colores primarios, Estabilizador de imagen SteadyShot, Reducción de ruido, Cable USB incorporado, para transferencia de archivos y carga de la cámara, Compensación de contraluz automático, Velocidad del Obturador: 1/8-1/10000, Formato de Audio: Dolby Digital de 2 canales estéreo, Dolby Digital Stereo Creator, Sensor de imagen 1/5.8"(3,1 mm) retro iluminado Exmor R CMOS Sensor, Fuente de Energía: Batería Lithium FV, 1 año de Garantía', 2, 'http://localhost/trueque_10//images/video2.jpg', '2013-06-04', 23, 1),
(97, 'Casa Portal Villa Campestre Cali', 'Conjunto portal de villa campestre. Casas de 128m2, 3 habitaciones, 3 baños, ubicado en villa campestre. Alta valorización, tranquilidad, seguridad, aproveche, cerca a carulla, olímpica, y cercano al centro comercial buenavista.  vías principales, transporte de buses y transmetro con ruta a toda barranquilla. Esta ubicada cerca a las mejores universidades (universidad del norte, u libre, u san martin) y colegios (col. del sagrado corazón, col. británico internacional, entre otros). La casa conjunto cerrado, cuenta con piscina, parqueadero de visitantes, salón social, portería 24 horas. la casa es de 2 pisos, 128 m2, más patio de 18 m2, circulación de aire, 2 parqueaderos, terraza, recibo, baño social, sala-comedor, cocina integral, patio con espacio para la instalación del cuarto del servicio. en el segundo piso cuenta con 3 alcobas, 2 baños, estudio, hall de alcobas, balcón, alcoba principal con vestier y baño.', 3, 'http://localhost/trueque_10//images/casa.jpg', '2013-06-04', 24, 1),
(98, 'Samsung Rex 80', 'El samsung rex 80 es un teléfono celular gsm con una pantalla tft qvga de 3 pulgadas, cámara de 3.2 megapixels, wi-fi b/g/n, bluetooth 3.0, sim dual opcional, integración con redes sociales y ranura microsd', 4, 'http://localhost/trueque_10//images/343997.jpg', '2013-06-04', 24, 1),
(99, 'Camara Canon EOS 3D', 'En este modelo el visor sólo ofrece recuadro para el encuadre con el 50 mm, por lo que se hace necesario el uso de visores externos con los demás objetivos, en la imagen aparece montada con un voluminoso pero poco luminoso (seguramente por razones de diseño, que como he comentado antes las ópticas tienen que combinarse con las ya fijas en el cuerpo y la luz tiene que pasar forzosamente por la abertura máxima existente) 80 mm f4 y un 35 mm f 5,6, todos de la marca schneider-kreuznach', 2, 'http://localhost/trueque_10//images/camara1.jpg', '2013-06-04', 24, 1),
(100, 'Casa Remodelada', 'Casa en pradomar remodelada, 1535 metros cuadrados de área, garaje doble, sala comedor amplios, salón de estar, baño social, cocina, cuarto de labores, tres habitaciones área de labores, patio súper amplio. las habitaciones cada una con su baño, el salón de estar y las habitaciones tienen aire acond.', 3, 'http://localhost/trueque_10//images/casaMadera.jpg', '2013-06-04', 13, 1),
(101, 'Samsung z510', '¿Por qué no habrían de combinarse la elegancia y la belleza con el sentido práctico? en el samsung sgh-z510 encontramos esta combinación. por una parte, posee un aspecto delicado y de líneas elegantes gracias a la capa de magnesio, y por otra, sólo pesa 97 gramos, lo cual lo hace sorprendentemente ligero. en otras palabras: el lujo hecho realidad.', 4, 'http://localhost/trueque_10//images/175146_10.jpg', '2013-06-04', 25, 1),
(102, 'Camara Canon Retina Plegable', 'Esta retina plegable incorpora una estructura metálica exterior alrededor del fuelle protegiéndolo y dándole quizás una mayor protección contra la luz y una mayor durabilidad.', 2, 'http://localhost/trueque_10//images/cam10.jpg', '2013-06-04', 25, 1),
(103, 'Casa tres niveles', 'Espaciosa, muy iluminada consta de 3 niveles. En el primer nivel sala doble, comedor espacioso cocina integral con red de gas mesón en marmol, barra americana, cuarto de empleada con su baño y zona de ropas independiente. Alrededor zonas verdes y sector muy tranquilo. En el segundo nivel 3 alcobas la principal con baño y doble closet, las otras dos con closet,en este nivel también se encuentra', 3, 'http://localhost/trueque_10//images/modernaCasa.jpg', '2013-06-04', 19, 1),
(104, 'Camara Olympus wtk-36', 'cámara de telémetro y con ópticas intercambiables, no tiene fotómetro. obturador synchro-compur con velocidades de b, 1-1/500 sg. y diafragmas de f 2,8-22 para el 50 mm, ambos mecanismos van incorporados en la parte no desmontable del objetivo, por lo que las distintas ópticas intercambiables están exentas de ellos, así mismo éstas se combinan con la parte óptica fija que queda detrás del obturador.', 2, 'http://localhost/trueque_10//images/camara11.jpg', '2013-06-04', 19, 1),
(105, 'Amplia Casa Loma los Parra', 'Ubicada cerca de la Transversal Inferior y Loma Los Parra. Queda muy cerca el C.C. El Tesoro. Tiene 20 años de construida,  Área del Lote 300 m²,  Área construida 320 m² en 2 niveles,  Comodidades, 2 Salas,  Comedor independiente, Baño social,  Cocina integral tipo isla con red de gas,  Comedor auxiliar,  Zona de ropas independiente,  Alcoba de servicio con baño,  Estadero,  Patio amplio con jardín. Nivel 2:  Hall de alcobas, Biblioteca,  Alcoba principal con baño, vestier y closet ,  1 alcoba con baño, vestier y closet , 2 Alcobas con closet y balcón , Baño de alcobas. Pisos en mármol , 4 parqueaderos (2 cubiertos y 2 descubiertos), cuarto útil ,  La Unidad cuenta con salón social, zonas verdes, juegos infantiles, parqueadero de visitantes, portería con vigilancia 24 hrs., circuito cerrado TV de seguridad.', 3, 'http://localhost/trueque_10//images/casaMedio.jpg', '2013-06-04', 20, 1),
(106, 'Conjunto especial de Camaras Fotograficas', 'Ofrezco un grupo de camaras de varias marcsa, entre las que se encuentran dos Canon profesionales, 3 Sony y el resto son Nikon. Todas en muy buen estado, con poco uso compradas hace menos de dos años.', 2, 'http://localhost/trueque_10//images/camaras.jpg', '2013-06-04', 20, 1),
(107, 'El codigo Da Vinci y su Diccionario', 'Novela de misterio escrita por Dan Brown y publicada por primera vez por Random House en 2003 (ISBN 0-385-50420-9). Se ha convertido en un best seller mundial, con más de 80 millones de ejemplares vendidos y traducido a 44 idiomas.', 11, 'http://localhost/trueque_10//images/da_vinci.jpg', '2013-06-04', 22, 1),
(108, 'Don Quijote de la Mancha', 'El libro nos presentan a este personaje como un loco trastornado a causa de las novelas de caballerías, pero, ¿Quién dice que el señor Quijana era sólo eso? ¿Por algún motivo será la cumbre de la literatura española verdad? Y aquí se plantea la duda héroe o simplemente viejo loco.', 11, 'http://localhost/trueque_10//images/donQuijote.jpg', '2013-06-04', 22, 1),
(109, 'GASGAS - SM HALLEY 125CC.', 'Se vende moto de 125cc Gas Gas SM Halley, se puede conducir con carnet de coche, la moto solo tiene 3. 500 Km, La vendo porque no la utilizo, ahora le saque seguro para de vez en cuando darle una vuelta, el seguro se puede aprovechar para el comprador, la moto siempre está en garaje, y no cambio por quads, se puede ver y probar. Para gente interesada o información atiendo watsap y el precio es negociable. . Color Negra', 14, 'http://localhost/trueque_10//images/motos.jpg', '2013-06-04', 25, 1),
(110, 'Warcraft III: Reign of Chaos', 'Tercera parte de uno de los juegos de estrategia en tiempo real más importante que existen. Esta tercera parte ofrece un remozado aspecto 3D además de incluir elementos propios de los RPG, más bandos y una historia más elaborada, lo que se intentará unir a las virtudes que han hecho grande esta saga.', 15, 'http://localhost/trueque_10//images/craft1.jpg', '2013-06-04', 25, 1),
(111, 'Timbales', 'Se intercambian 9 tambores y 1 timbal, con las siguientes características: • tambor cadete 35, 5 Ø x 18 cm. (14 Ø x 7 ). - casco de madera. - aros de nylon rojo. - casco de madera. - 6 varillas de tensión cromadas. - bordonero ajustable. - parches de plástico • timbal cofradia 38 Ø x 40 cm. (15 Ø x 16 ). - casco de madera. - aros de nylon rojo. - casco de madera. - 6 varillas de tensión cromadas. - parche de plástico. los tambores van sin correaje. (solo dispongo de 4 incluidos)', 13, 'http://localhost/trueque_10//images/timbales.jpg', '2013-06-04', 25, 1),
(112, 'Sheridan es un licor de café. Para ocasiones especiales', 'Sheridan es un licor de cafe producido en Dublin por Thomas Sheridan & Sons. Fue introducido en 1994 y su botella caracteristica y combinacion the licor de leche blanco y licor de cafe y sabores a whisky lo han convertido en una de las bebidas premium mas famosas del mundo. Es mas rico que el Baylies. UN REGALO SUMAMENTE ESPECIAL o para disfrutarlo en familia.\r\n\r\nNota: Se hacen entregas en el DF y área metropolitana o en alguna estacion del metro de cualquier linea\r\n\r\nTiempo de respuesta 4 horas desde que lo solicitas hasta la entrega dependiendo del lugar de entrega. Si la zona es centrica el tiempo baja a 3 horas.', 12, 'http://localhost/trueque_10//images/sheridanhome_0.jpg', '2013-06-04', 25, 1),
(113, 'Mitos Griegos', 'Esta es la recopilacion de los mitos griegos mas conocidos. La historia del Rey Midas, quien sucumbe ante la terrible fuerza de su ambicion o Narciso, quien se enamora de su propia imagen al descubrir su reflejo en el agua. Tambien hay hombres que se convierten en animales, dioses que se casan con mortales.', 11, 'http://localhost/trueque_10//images/mitos.jpg', '2013-06-04', 25, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `telefono`
--

CREATE TABLE IF NOT EXISTS `telefono` (
  `telefono_id` int(20) NOT NULL AUTO_INCREMENT,
  `telefono` int(20) NOT NULL,
  `usuario_id` int(20) NOT NULL,
  PRIMARY KEY (`telefono_id`),
  KEY `fk_usuario_telefono` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `usuario_id` int(20) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `nivel` int(1) NOT NULL DEFAULT '1',
  `id_ciudad` int(11) NOT NULL,
  `avatar` varchar(124) NOT NULL DEFAULT 'http://localhost/trueque_10/images/avatar.jpg',
  PRIMARY KEY (`usuario_id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario_id`, `nombre`, `apellido`, `email`, `contrasena`, `nivel`, `id_ciudad`, `avatar`) VALUES
(12, 'Alexis', 'Ruano', 'alexis@gmail.com', '3c75ccfafda2150b5c25b6e290f1ba0975444cbf', 0, 0, 'http://localhost/trueque_10/images/avatar.jpg'),
(13, 'Edward', 'Giraldo', 'edward@gmail.com', 'fac21fc04e980f366260130b2e5aa2fe32fecb26', 1, 0, 'http://localhost/trueque_10/images/avatar.jpg'),
(14, 'Paola', 'Martinez', 'paola@gmail.com', '5e7960ae59608c00deb29ea1d233a7b8ddf65d73', 1, 0, 'http://localhost/trueque_10/images/avatar.jpg'),
(15, 'Andrea', 'Zambrano', 'andrea@gmail.com', '08dd0d9cba826ebae188f009be71e66297a2f1ae', 1, 0, 'http://localhost/trueque_10/images/avatar.jpg'),
(16, 'Elkin', 'Hurtado', 'elkin@gmail.com', '848708b1171f92833aff70e5b9f872f6a16146e0', 1, 0, 'http://localhost/trueque_10/images/avatar.jpg'),
(17, 'Andres', 'Castillo', 'andresf@gmail.com', '280c93e72eeeb4eadf92e9d0dceb7c501a068e66', 1, 0, 'http://localhost/trueque_10/images/avatar.jpg'),
(18, 'Andres', 'Florez', 'andressteven@gmail.com', '02b81dfb78aed264e808f86f3ab4b3e3d4a91921', 1, 0, 'http://localhost/trueque_10/images/avatar.jpg'),
(19, 'Karen', 'Bolaños', 'karen@gmail.com', 'eee82986f34d650e5554e2850f7408368587b0fb', 1, 0, 'http://localhost/trueque_10//images/110811-203306.jpg'),
(20, 'Silvana', 'Garcia', 'silvana@gmail.com', '826a3326d0bf1bd93071029d3ef7aa8f8cc517d6', 1, 0, 'http://localhost/trueque_10/images/avatar.jpg'),
(21, 'Diana', 'Hoyos', 'diana@hotmail.com', '77772f8b65d7855969f9edf0507ab9131df2b665', 1, 0, 'http://localhost/trueque_10/images/avatar.jpg'),
(22, 'Susana', 'Meneses', 'susana@gmail.com', 'd33c5d30450d32d2f4d15b17f7a87edf5401f957', 1, 0, 'http://localhost/trueque_10/images/avatar.jpg'),
(23, 'Cristian', 'Martinez', 'cristian@gmail.com', '53b0fb369195f17959fdf71074bd72c3e5867ac0', 1, 0, 'http://localhost/trueque_10/images/avatar.jpg'),
(24, 'Santiago', 'Torres', 'santiago@gmail.com', 'c6c5b6c3b52f1d55e910816691e2b1936ef2d763', 1, 0, 'http://localhost/trueque_10/images/avatar.jpg'),
(25, 'Juan Manuel', 'Bravo', 'jmanuel@gmail.com', '18da790128fb74a04f7981e9560f21bb83736dde', 1, 0, 'http://localhost/trueque_10/images/avatar.jpg');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `permuta`
--
ALTER TABLE `permuta`
  ADD CONSTRAINT `fk_producto_recibe` FOREIGN KEY (`producto_recibe`) REFERENCES `producto` (`producto_id`),
  ADD CONSTRAINT `fk_producto_solicita` FOREIGN KEY (`producto_solicita`) REFERENCES `producto` (`producto_id`),
  ADD CONSTRAINT `fk_sol_rec` FOREIGN KEY (`producto_solicita`) REFERENCES `producto` (`producto_id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `fk_usuario_producto` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`);

--
-- Filtros para la tabla `telefono`
--
ALTER TABLE `telefono`
  ADD CONSTRAINT `fk_usuario_telefono` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`usuario_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
