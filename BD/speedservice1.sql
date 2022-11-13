-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: speedservice
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categorias` (
  `idCategoria` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` varchar(250) NOT NULL,
  `descripcionCategoria` varchar(250) NOT NULL,
  `imgCategoria` varchar(250) NOT NULL,
  `bajaCategoria` tinyint(4) NOT NULL,
  PRIMARY KEY (`idCategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'flete','Dejá tu carga en buenas manos.','servicio_flete.jpg',0),(2,'Mandado','Nuestro destino es tu confianza.','servicio_mandado.jpg',0),(3,'remis','Si querés moverte, nosotros te llevamos.','servicio_remis.jpg',0);
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_servicio`
--

DROP TABLE IF EXISTS `estado_servicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `estado_servicio` (
  `idEstadoServicio` int(11) NOT NULL AUTO_INCREMENT,
  `estadoServicio` varchar(250) NOT NULL,
  PRIMARY KEY (`idEstadoServicio`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_servicio`
--

LOCK TABLES `estado_servicio` WRITE;
/*!40000 ALTER TABLE `estado_servicio` DISABLE KEYS */;
INSERT INTO `estado_servicio` VALUES (1,'Pendiente de aprobación'),(2,'Aprobado'),(3,'Rechazado');
/*!40000 ALTER TABLE `estado_servicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fotos_vehiculo`
--

DROP TABLE IF EXISTS `fotos_vehiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fotos_vehiculo` (
  `idFoto` int(11) NOT NULL AUTO_INCREMENT,
  `urlFoto` varchar(250) NOT NULL,
  `idVehiculo` int(11) NOT NULL,
  PRIMARY KEY (`idFoto`),
  KEY `FK_vehiculo` (`idVehiculo`),
  CONSTRAINT `relacion_foto_vehiculo` FOREIGN KEY (`idVehiculo`) REFERENCES `vehiculos` (`idVehiculo`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fotos_vehiculo`
--

LOCK TABLES `fotos_vehiculo` WRITE;
/*!40000 ALTER TABLE `fotos_vehiculo` DISABLE KEYS */;
INSERT INTO `fotos_vehiculo` VALUES (52,'camioneta1.jpg',23),(53,'camioneta2.jpg',23),(54,'camioneta7.jpg',24),(55,'camioneta2.jpg',25),(56,'camioneta3.jpg',26),(57,'camioneta2.jpg',27);
/*!40000 ALTER TABLE `fotos_vehiculo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notificaciones`
--

DROP TABLE IF EXISTS `notificaciones`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notificaciones` (
  `idNotificacion` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(250) NOT NULL,
  `idUsuarioNotificado` int(11) NOT NULL,
  `idSolicitud` int(11) NOT NULL,
  `idProveedor` int(11) NOT NULL,
  `visto` tinyint(4) NOT NULL,
  PRIMARY KEY (`idNotificacion`),
  KEY `FK_usuarioNotificado` (`idUsuarioNotificado`),
  KEY `FK_usuarioProveedor` (`idProveedor`),
  KEY `FK_solicitud` (`idSolicitud`),
  CONSTRAINT `relacion_notificacion_proveedor` FOREIGN KEY (`idProveedor`) REFERENCES `usuarios` (`idUsuario`),
  CONSTRAINT `relacion_notificacion_solicitud` FOREIGN KEY (`idSolicitud`) REFERENCES `solicitud_servicio` (`idSolicitud`),
  CONSTRAINT `relacion_notificacion_usuario_notificado` FOREIGN KEY (`idUsuarioNotificado`) REFERENCES `usuarios` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notificaciones`
--

LOCK TABLES `notificaciones` WRITE;
/*!40000 ALTER TABLE `notificaciones` DISABLE KEYS */;
INSERT INTO `notificaciones` VALUES (1,'asdasda',2,9,3,2),(3,'Este sale andando',6,11,7,2),(4,'Calle 21 484',6,12,7,2);
/*!40000 ALTER TABLE `notificaciones` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedido`
--

DROP TABLE IF EXISTS `pedido`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_emisor` int(11) NOT NULL,
  `id_usuario_receptor` int(11) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_asd` (`id_usuario_emisor`),
  KEY `fk_asd1` (`id_usuario_receptor`),
  CONSTRAINT `relacion_pedido_proveedor` FOREIGN KEY (`id_usuario_receptor`) REFERENCES `servicios` (`idServicio`),
  CONSTRAINT `relacion_pedido_usuario` FOREIGN KEY (`id_usuario_emisor`) REFERENCES `usuarios` (`idUsuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedido`
--

LOCK TABLES `pedido` WRITE;
/*!40000 ALTER TABLE `pedido` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedido` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publicidad`
--

DROP TABLE IF EXISTS `publicidad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publicidad` (
  `idPublicidad` int(11) NOT NULL AUTO_INCREMENT,
  `nombrePublicidad` varchar(255) NOT NULL,
  `fotoPublicidad` varchar(255) NOT NULL,
  `contacto` varchar(255) NOT NULL,
  `direccionPublicidad` varchar(255) DEFAULT NULL,
  `fechaAlta` date NOT NULL,
  `fechaBaja` date NOT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idPublicidad`),
  KEY `idUsuario` (`idUsuario`),
  CONSTRAINT `publicidad_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publicidad`
--

LOCK TABLES `publicidad` WRITE;
/*!40000 ALTER TABLE `publicidad` DISABLE KEYS */;
INSERT INTO `publicidad` VALUES (2,'MaleCaraPan','enTusNalgas','tuCulitoBbb','0800TusNalgas','1990-05-02','1990-05-02',6),(3,'la cara del pan','flete.jpg','elCulitoDeMale iLove','calle 21 484','2022-11-07','2022-12-08',6),(4,'TimoBoludo','detalle-servicio.jpg','elCulitoDeMale iLove','calle 21 484','2022-11-12','2022-11-21',6);
/*!40000 ALTER TABLE `publicidad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rol` (
  `idRol` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(100) NOT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (1,'usuario'),(2,'proveedor'),(3,'administrador');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicios`
--

DROP TABLE IF EXISTS `servicios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servicios` (
  `idServicio` int(11) NOT NULL AUTO_INCREMENT,
  `nombreServicio` varchar(250) NOT NULL,
  `descripcionServicio` text NOT NULL,
  `horarioServicio` varchar(300) NOT NULL,
  `idCategoria` int(11) NOT NULL,
  `idVehiculo` int(11) NOT NULL,
  `fechaAltaServicio` datetime NOT NULL DEFAULT current_timestamp(),
  `alcance` text NOT NULL,
  `likes` int(11) DEFAULT NULL,
  `idEstadoServicio` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `precioServicio` decimal(10,2) NOT NULL,
  PRIMARY KEY (`idServicio`),
  KEY `FK_Estado_Servicio` (`idEstadoServicio`),
  KEY `FK_categoria` (`idCategoria`),
  KEY `FK_vehiculo` (`idVehiculo`),
  KEY `FK_usuario` (`idUsuario`),
  CONSTRAINT `relacion_servicio_categoria` FOREIGN KEY (`idCategoria`) REFERENCES `categorias` (`idCategoria`),
  CONSTRAINT `relacion_servicio_estado` FOREIGN KEY (`idEstadoServicio`) REFERENCES `estado_servicio` (`idEstadoServicio`),
  CONSTRAINT `relacion_servicio_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`),
  CONSTRAINT `relacion_servicio_vehiculo` FOREIGN KEY (`idVehiculo`) REFERENCES `vehiculos` (`idVehiculo`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicios`
--

LOCK TABLES `servicios` WRITE;
/*!40000 ALTER TABLE `servicios` DISABLE KEYS */;
INSERT INTO `servicios` VALUES (9,'Fletes Mario Perez','Fletes y Mudanzas.','09 a 20',1,23,'2022-09-26 12:38:46','500km',NULL,2,3,500.00),(10,'fletes firulete','Fast fast','8 a 16',2,24,'2022-10-17 20:51:21','50',NULL,2,6,0.00),(11,'Fletes firulay','asd','8 a 16',2,25,'2022-10-17 20:53:08','50',NULL,2,6,0.00),(12,'fletes firulete1','asadasda','8 a 17',1,26,'2022-10-17 20:54:27','50',NULL,2,6,0.00),(13,'Fletes firulay1','Llego de tok','8 a 16',1,27,'2022-10-18 20:25:00','50',NULL,2,7,0.00);
/*!40000 ALTER TABLE `servicios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `solicitud_servicio`
--

DROP TABLE IF EXISTS `solicitud_servicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `solicitud_servicio` (
  `idSolicitud` int(11) NOT NULL AUTO_INCREMENT,
  `fecha` date NOT NULL,
  `hora` varchar(250) NOT NULL,
  `descripcion` text NOT NULL,
  `precioServicio` decimal(10,2) NOT NULL,
  `idCliente` int(11) NOT NULL,
  `idEstado` int(11) NOT NULL,
  `idServicio` int(11) NOT NULL,
  PRIMARY KEY (`idSolicitud`),
  KEY `FK_Cliente` (`idCliente`),
  KEY `FK_estado` (`idEstado`),
  KEY `FK_servicio` (`idServicio`),
  CONSTRAINT `relacion_solicitud_cliente` FOREIGN KEY (`idCliente`) REFERENCES `usuarios` (`idUsuario`),
  CONSTRAINT `relacion_solicitud_estado` FOREIGN KEY (`idEstado`) REFERENCES `estado_servicio` (`idEstadoServicio`),
  CONSTRAINT `relacion_solicitud_servicio` FOREIGN KEY (`idServicio`) REFERENCES `servicios` (`idServicio`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `solicitud_servicio`
--

LOCK TABLES `solicitud_servicio` WRITE;
/*!40000 ALTER TABLE `solicitud_servicio` DISABLE KEYS */;
INSERT INTO `solicitud_servicio` VALUES (1,'2022-10-20','16 horas.','Flete para Av. San Martin 334 a Repulica 1029',500.00,3,1,9),(2,'2022-12-20','15:30 hs.','Flete de Av. La Plata 123 a Repulica 3309',500.00,2,2,9),(3,'2022-12-20','15:30 hs.','Flete de Av. La Plata 123 a Repulica 3309',500.00,2,1,9),(4,'2022-12-20','15:30 hs.','Flete de Av. La Plata 123 a Repulica 3309',500.00,2,1,9),(5,'2022-12-20','15:30 hs.','Flete de Av. La Plata 123 a Repulica 3309',500.00,2,1,9),(6,'2022-12-20','15:30 hs.','Flete de Av. La Plata 123 a Repulica 3309',500.00,2,2,9),(7,'2022-12-20','15:30 hs.','Flete de Av. La Plata 123 a Repulica 3309',500.00,2,1,9),(8,'2022-10-15','asddas','asdasda',500.00,2,2,9),(9,'2022-10-15','asddas','asdasda',500.00,2,2,9),(10,'2012-12-12','16:30','MaleCaraDePan',0.00,6,1,12),(11,'2020-12-12','16:30','Este sale andando',1500.00,6,2,13),(12,'2022-11-09','22:30','Calle 21 484',850.00,6,2,13);
/*!40000 ALTER TABLE `solicitud_servicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_vehiculo`
--

DROP TABLE IF EXISTS `tipo_vehiculo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_vehiculo` (
  `idTipo` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(250) NOT NULL,
  PRIMARY KEY (`idTipo`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_vehiculo`
--

LOCK TABLES `tipo_vehiculo` WRITE;
/*!40000 ALTER TABLE `tipo_vehiculo` DISABLE KEYS */;
INSERT INTO `tipo_vehiculo` VALUES (1,'bicicleta'),(2,'moto'),(3,'auto'),(4,'camion'),(5,'camioneta');
/*!40000 ALTER TABLE `tipo_vehiculo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `imgUsuario` varchar(250) NOT NULL,
  `nombreCompleto` varchar(250) NOT NULL,
  `correo` varchar(250) NOT NULL,
  `password` varchar(400) NOT NULL,
  `telefono` varchar(100) NOT NULL,
  `dni` varchar(8) NOT NULL,
  `direccion` varchar(250) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `fechaDeAlta` datetime NOT NULL DEFAULT current_timestamp(),
  `idRol` int(11) NOT NULL,
  `verificado` varchar(255) NOT NULL,
  PRIMARY KEY (`idUsuario`),
  KEY `FK_rol` (`idRol`),
  CONSTRAINT `relacion_usuario_rol` FOREIGN KEY (`idRol`) REFERENCES `rol` (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'flan.jpg','Manuel Diaz','manu@gmail.com','','4564564654','32659879','asdasdasd 123','1990-05-02','2022-09-01 20:19:36',3,''),(2,'usuario1.jpg','Florencia Perez','prueba@gmail.com','$2y$10$0edUJAL5N4074mHvM..YJuNhRwnWgMbvVo1OJlYrt7siCZZYhihiq','4564-654546','35989656','Av. san martin 334','2006-09-04','2022-09-05 11:22:17',1,'TRUE'),(3,'usuario2.jpg','Federico Paez','fede@gmail.com','$2y$10$9x/7rZyYPAvQt0G7UVm51.XtkkpIvergqhlsNrOMsOnYoCcKK4Vtq','2364-569865','32656989','Av. Libertador 335','2006-02-02','2022-09-05 12:28:02',1,'TRUE'),(4,'team-4.jpg','Fran Perez','fran@gmail.com','$2y$10$nVxe6Px/FDVwNBd/ddiNZufV9bIgwxWS1TpAkOaINQCvt2YZR69x2','2365-659865','32656989','Av. Suipacha 32','2000-02-02','2022-09-05 12:32:30',3,'TRUE'),(6,'usuario1.jpg','timote','timo_futbol@hotmail.com','$2y$10$YoeD8xhJryc3lxI9ozRuGOAxjxUcpRD83Slz7tiT/h7pmRrY77OLm','2346-454545','12345678','1221','1996-12-12','2022-10-17 20:00:21',1,'TRUE'),(7,'usuario2.jpg','Eugenio','timopereyra@gmail.com','$2y$10$jUDcgOFzHCuXS0n0oX1ihuw6JI3PpypNFzBukQRwmRD/rx9Ct7e.O','2346-454545','12345678','484','1990-12-12','2022-10-18 20:13:03',2,'TRUE');
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehiculos`
--

DROP TABLE IF EXISTS `vehiculos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehiculos` (
  `idVehiculo` int(11) NOT NULL AUTO_INCREMENT,
  `patente` varchar(12) DEFAULT NULL,
  `img_seguro` varchar(250) DEFAULT NULL,
  `img_vtv` varchar(250) DEFAULT NULL,
  `capacidad` text NOT NULL,
  `descripcionVehiculo` varchar(250) NOT NULL,
  `idTipo` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  PRIMARY KEY (`idVehiculo`),
  KEY `FK_tipo` (`idTipo`),
  KEY `FK_usuario` (`idUsuario`),
  CONSTRAINT `relacion_vehiculo_tipo` FOREIGN KEY (`idTipo`) REFERENCES `tipo_vehiculo` (`idTipo`),
  CONSTRAINT `relacion_vehiculo_usuario` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehiculos`
--

LOCK TABLES `vehiculos` WRITE;
/*!40000 ALTER TABLE `vehiculos` DISABLE KEYS */;
INSERT INTO `vehiculos` VALUES (23,'730asd','SEGURO1.jpg','VTV1.jpg','8000 kg.','Camioneta 0 km.',5,3),(24,'abc123','SEGURO1.jpg','VTV1.jpg','1212','asd',5,6),(25,'abc321','SEGURO2.png','VTV2.jpg','1212','asdasda',5,6),(26,'abc678','SEGURO3.jpg','VTV3.png','21212','asdas',5,6),(27,'zxy987','SEGURO2.png','VTV2.jpg','1000','De a puñado',5,7);
/*!40000 ALTER TABLE `vehiculos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-11-10 19:13:41
