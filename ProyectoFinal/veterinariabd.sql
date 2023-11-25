-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: veterinariabd
-- ------------------------------------------------------
-- Server version	8.0.30

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categoria`
--

DROP TABLE IF EXISTS `categoria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categoria` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `fechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaActualizacion` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categoria`
--

LOCK TABLES `categoria` WRITE;
/*!40000 ALTER TABLE `categoria` DISABLE KEYS */;
INSERT INTO `categoria` VALUES (1,'Alimentos Secos','Alimentos excelentes para mantener la higiene dental de la mascota.',1,'2023-10-18 17:08:50',NULL),(2,'Alimentos Húmedos','El alimento húmedo es una excelente manera de darle a la mascota un mayor nivel de hidratación',1,'2023-10-18 17:27:42',NULL),(3,'Alimentos Semi-Húmedos','Son convenientes para alimentar, fáciles de guardar y generalmente más sabrosos para las mascotas qu',1,'2023-10-18 17:31:20',NULL),(5,'Alimentos Enlatados','Permite que las mascotas con problemas odontológicos puedan ingerirlas sin generarles dolor.',1,'2023-10-21 04:09:22',NULL),(6,'Accesorios de Paseo','Artículos adecuados para mascotas hiperactivas.',1,'2023-10-22 04:34:56',NULL),(7,'Artículos de Aseo','Productos adecuados para sus mascotas',1,'2023-10-26 11:47:41',NULL),(8,'Medicamentos','Medicinas requeridas para cada mascota.',1,'2023-10-26 11:49:23',NULL),(9,'Ropas','Ropas diseñadas para sus mascotas.',1,'2023-10-26 11:50:18',NULL),(10,'Juguetes','Artículos para interacción entre el dueño y su mascota.',1,'2023-10-30 20:26:34',NULL),(11,'Medicamentos','Medicamentos adecuados para las mascotas.',1,'2023-11-06 04:11:08',NULL);
/*!40000 ALTER TABLE `categoria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idUsuarios` int DEFAULT NULL,
  `ciNit` varchar(11) NOT NULL,
  `razonSocial` varchar(85) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `fechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaActualizacion` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `UsuarioID` (`idUsuarios`),
  CONSTRAINT `clientes_ibfk_1` FOREIGN KEY (`idUsuarios`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,1,'8000421','Pedro',1,'2023-10-25 16:47:07',NULL),(2,2,'5468974','Carmen',1,'2023-10-25 16:51:30',NULL),(3,1,'3649851','Eduardo',1,'2023-10-25 16:52:44',NULL),(4,1,'4653219','Gerardo',1,'2023-10-27 01:23:01',NULL),(5,1,'6553215','Feliciano',1,'2023-10-27 01:24:52',NULL),(6,1,'9654321','Perci',1,'2023-10-27 03:56:50',NULL),(7,3,'4616461','Geronimo',1,'2023-10-27 04:25:48',NULL),(8,1,'8946532','Melisa',1,'2023-11-03 00:03:59',NULL),(9,1,'6534615','Marco',1,'2023-11-03 00:04:00',NULL),(10,1,'6262559','Elias',1,'2023-11-03 00:08:13',NULL),(11,1,'3654632-A','jhamil',1,'2023-11-06 06:58:23',NULL);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detalleventas`
--

DROP TABLE IF EXISTS `detalleventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detalleventas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idVentas` int NOT NULL,
  `idProductos` int NOT NULL,
  `cantidadV` int NOT NULL,
  `precioUnitario` decimal(10,2) NOT NULL,
  `nombre` varchar(85) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `VentaID` (`idVentas`),
  KEY `ProductoID` (`idProductos`),
  CONSTRAINT `detalleventas_ibfk_1` FOREIGN KEY (`idVentas`) REFERENCES `ventas` (`id`),
  CONSTRAINT `detalleventas_ibfk_2` FOREIGN KEY (`idProductos`) REFERENCES `productos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=72 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detalleventas`
--

LOCK TABLES `detalleventas` WRITE;
/*!40000 ALTER TABLE `detalleventas` DISABLE KEYS */;
INSERT INTO `detalleventas` VALUES (1,1,1,10,220.00,'Bolsa de Viaje para Gatos'),(2,2,4,4,8.00,'dogPro 100g'),(3,2,5,3,40.50,'Collar Anti Parasitario'),(4,3,3,3,650.90,'Casa para Perros'),(5,3,1,5,220.00,'Bolsa de Viaje para Gatos'),(6,4,4,3,8.00,'dogPro 100g'),(7,4,5,8,40.50,'Collar Anti Parasitario'),(8,5,4,3,8.00,'dogPro 100g'),(9,5,5,8,40.50,'Collar Anti Parasitario'),(10,6,3,4,650.90,'Casa para Perros'),(11,6,2,9,7.00,'dogchaw 100g'),(12,7,5,4,40.50,'Collar Anti Parasitario'),(13,7,4,9,8.00,'dogPro 100g'),(14,8,6,5,51.60,'Pelota mordedora'),(15,9,2,4,7.00,'dogchaw 100g'),(16,10,1,3,220.00,'Bolsa de Viaje para Gatos'),(17,10,3,6,650.90,'Casa para Perros'),(18,11,1,5,220.00,'Bolsa de Viaje para Gatos'),(19,11,2,3,7.00,'dogchaw 100g'),(20,12,4,4,8.00,'dogPro 100g'),(21,12,3,2,650.90,'Casa para Perros'),(22,12,6,7,51.60,'Pelota mordedora'),(23,12,4,9,8.00,'dogPro 100g'),(24,13,1,3,220.00,'Bolsa de Viaje para Gatos'),(25,13,3,1,650.90,'Casa para Perros'),(26,13,4,9,8.00,'dogPro 100g'),(27,14,3,1,650.90,'Casa para Perros'),(28,14,8,10,37.59,'Arnés para perros'),(29,15,3,3,650.90,'Casa para Perros'),(30,15,6,3,51.60,'Pelota mordedora'),(31,15,4,5,8.00,'dogPro 100g'),(32,16,7,3,24.60,'hueso Mordedor'),(33,17,2,3,7.00,'dogchaw 100g'),(34,18,2,3,7.00,'dogchaw 100g'),(35,19,2,3,7.00,'dogchaw 100g'),(36,20,8,3,37.59,'Arnés para perros'),(37,21,5,3,40.50,'Collar Anti Parasitario'),(38,21,8,3,37.59,'Arnés para perros'),(39,22,5,3,40.50,'Collar Anti Parasitario'),(40,22,8,3,37.59,'Arnés para perros'),(41,23,5,3,40.50,'Collar Anti Parasitario'),(42,23,7,5,24.60,'hueso Mordedor'),(43,24,6,5,51.60,'Pelota mordedora'),(44,24,8,5,37.59,'Arnés para perros'),(45,25,1,5,220.00,'Bolsa de Viaje para Gatos'),(46,25,6,5,51.60,'Pelota mordedora'),(47,26,2,3,7.00,'dogchaw 100g'),(48,26,4,6,8.00,'dogPro 100g'),(49,27,1,1,220.00,'Bolsa de Viaje para Gatos'),(50,27,2,3,7.00,'dogchaw 100g'),(51,28,1,3,220.00,'Bolsa de Viaje para Gatos'),(52,29,1,3,220.00,'Bolsa de Viaje para Gatos'),(53,30,8,3,37.59,'Arnés para perros'),(54,30,7,4,24.60,'hueso Mordedor'),(55,31,2,3,7.00,'dogchaw 100g'),(56,31,5,4,40.50,'Collar Anti Parasitario'),(57,32,3,5,650.90,'Casa para Perros'),(58,32,6,5,51.60,'Pelota mordedora'),(59,33,3,5,650.90,'Casa para Perros'),(60,33,4,3,8.00,'dogPro 100g'),(61,34,6,6,51.60,'Pelota mordedora'),(62,34,1,4,220.00,'Bolsa de Viaje para Gatos'),(63,35,5,3,40.50,'Collar Anti Parasitario'),(64,35,3,6,650.90,'Casa para Perros'),(65,36,7,5,24.60,'hueso Mordedor'),(66,36,5,6,40.50,'Collar Anti Parasitario'),(67,37,5,3,40.50,'Collar Anti Parasitario'),(68,37,6,4,51.60,'Pelota mordedora'),(69,38,7,3,24.60,'hueso Mordedor'),(70,38,5,8,40.50,'Collar Anti Parasitario'),(71,39,2,4,7.00,'dogchaw 100g');
/*!40000 ALTER TABLE `detalleventas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombreP` varchar(50) NOT NULL,
  `precioBase` decimal(10,2) NOT NULL,
  `stock` int NOT NULL,
  `imagen` varchar(255) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `fechaRegistro` date DEFAULT NULL,
  `fechaActualizacion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `idCategoria` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_productos_categoria2_idx` (`idCategoria`),
  CONSTRAINT `fk_productos_categoria2` FOREIGN KEY (`idCategoria`) REFERENCES `categoria` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'Bolsa de Viaje para Gatos',220.00,184,'bolsaGatos_4.jpg',1,'2023-10-20','2023-10-21 03:46:55',6),(2,'dogchaw 100g',7.00,487,'dogChaw_1.png',1,'2023-10-22','2023-10-22 04:08:46',3),(3,'Casa para Perros',650.90,184,'casaPerros.jpg',1,'2023-10-26','2023-10-26 13:14:42',6),(4,'dogPro 100g',8.00,491,'dogPro_1.png',1,'2023-10-26','2023-10-26 13:16:23',1),(5,'Collar Anti Parasitario',40.50,476,'collar antipulgas.jpeg',1,'2023-10-26','2023-10-26 14:01:51',7),(6,'Pelota mordedora',51.60,475,'pelota mordedora perros_2.jpg',1,'2023-10-30','2023-10-30 20:27:51',10),(7,'hueso Mordedor',24.60,488,'Hueso Mordedor.jpeg',1,'2023-11-06','2023-11-07 00:07:23',10),(8,'Arnés para perros',37.59,492,'arnes para perros.jpg',1,'2023-11-06','2023-11-07 00:10:24',6),(9,'Plato para gatos',40.49,500,'plato gatos.jpeg',1,'2023-11-02','2023-11-07 00:12:20',10),(10,'green pet perfume',50.80,200,'pet green perfume.jpg',1,'2023-11-20','2023-11-20 20:59:38',1);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nombre_usuario` varchar(50) NOT NULL,
  `correo_electronico` varchar(100) NOT NULL,
  `whatsapp` int NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `tipo_usuario` enum('empleado','administrador') NOT NULL,
  `codigo_verificacion` int DEFAULT NULL,
  `estado` tinyint(1) DEFAULT '0',
  `fechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaActualizacion` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `codigo_verificacion_UNIQUE` (`codigo_verificacion`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'fenix','zzlaigthzz@gmail.com',60369846,'$2y$10$d1dyAGs8swgKs3hjci/rJOfvqwX343Is.jo6VnzRgM6MbbWSeWsUW','administrador',70088335,1,'2023-10-25 04:24:32',NULL),(2,'fercho','borena4405@unbiex.com',70770612,'$2y$10$vKXcVv4q8IaqEVDWc3aU2uStFZiGOA.jeTP1dgzl40yGSWlO99Sfy','empleado',61392134,1,'2023-10-25 16:49:19',NULL),(3,'root','reposal958@monutri.com',65343546,'$2y$10$s.6YVNXXivmtLNp70U6jZOI7U0QAdXR85YOAcGUq1xhBGC7cplWbq','administrador',36833895,1,'2023-10-27 04:04:35',NULL),(4,'raul','lijove1351@undewp.com',85421394,'$2y$10$GoSnnQEDAWKISHBDr9t7teCrRUZvByAGSM1nd1rYNMlQji4Fq/GPq','empleado',52960704,1,'2023-11-01 05:38:27',NULL),(5,'rogelio','cilere1382@mkurg.com',72849641,'$2y$10$RqeRGlN.yrjVTvBYRbdFROjqg2dScZlCB2k7329G.W.WEiJ5vH6U2','administrador',89709156,1,'2023-11-09 23:19:53',NULL),(6,'angel','bowabor188@rdluxe.com',45621378,'$2y$10$nu2HEomDzvRzxKJE/8oGiOwkkkQJo99p8vcYmuWSUV6r82zmmcK2q','administrador',53797782,1,'2023-11-10 01:02:29',NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventas`
--

DROP TABLE IF EXISTS `ventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ventas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idClientes` int NOT NULL,
  `idUsuarios` int NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `estado` tinyint(1) NOT NULL DEFAULT '1',
  `FechaRegistro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `fechaActualizacion` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ClienteID` (`idClientes`),
  KEY `ventas_ibfk_2_idx` (`idUsuarios`),
  CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`idClientes`) REFERENCES `clientes` (`id`),
  CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`idUsuarios`) REFERENCES `usuarios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas`
--

LOCK TABLES `ventas` WRITE;
/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
INSERT INTO `ventas` VALUES (1,5,1,2200.00,1,'2023-11-01 04:40:52',NULL),(2,1,1,153.50,1,'2023-11-02 23:59:34',NULL),(3,8,1,3052.70,1,'2023-11-03 01:55:47',NULL),(4,5,1,348.00,1,'2023-11-03 15:20:39',NULL),(5,5,1,348.00,1,'2023-11-03 15:20:39',NULL),(6,10,1,2666.60,1,'2023-11-03 15:21:44',NULL),(7,3,2,234.00,1,'2023-11-03 15:22:34',NULL),(8,5,2,258.00,1,'2023-11-03 15:23:33',NULL),(9,1,1,28.00,1,'2023-11-03 17:23:05',NULL),(10,1,1,4565.40,1,'2023-11-03 22:47:27',NULL),(11,3,1,1121.00,1,'2023-11-04 01:49:55',NULL),(12,8,1,1767.00,1,'2023-11-06 04:54:04',NULL),(13,3,1,1382.90,1,'2023-11-06 05:00:14',NULL),(14,1,1,1026.80,1,'2023-11-07 01:02:08',NULL),(15,5,1,2147.50,1,'2023-11-07 12:00:33',NULL),(16,6,1,73.80,1,'2023-11-08 11:56:04',NULL),(17,6,1,21.00,1,'2023-11-08 11:56:43',NULL),(18,6,1,21.00,1,'2023-11-08 11:57:02',NULL),(19,6,1,21.00,1,'2023-11-08 11:57:15',NULL),(20,2,1,112.77,1,'2023-11-08 12:08:30',NULL),(21,2,1,234.27,1,'2023-11-08 12:14:52',NULL),(22,2,1,234.27,1,'2023-11-08 12:18:06',NULL),(23,4,1,244.50,1,'2023-11-08 13:03:46',NULL),(24,11,1,445.95,1,'2023-11-08 13:19:48',NULL),(25,11,1,1358.00,1,'2023-11-08 13:54:45',NULL),(26,1,6,69.00,1,'2023-11-10 01:05:38',NULL),(27,2,1,241.00,1,'2023-11-13 14:47:09',NULL),(28,9,1,660.00,1,'2023-11-13 15:51:32',NULL),(29,7,1,660.00,1,'2023-11-13 16:12:47',NULL),(30,11,1,211.17,1,'2023-11-14 15:14:50',NULL),(31,11,1,183.00,1,'2023-11-14 15:24:19',NULL),(32,7,1,3512.50,1,'2023-11-19 10:29:41',NULL),(33,11,1,3278.50,1,'2023-11-19 10:35:06',NULL),(34,11,1,1189.60,1,'2023-11-19 10:40:31',NULL),(35,7,1,4026.90,1,'2023-11-19 10:50:34',NULL),(36,10,1,366.00,1,'2023-11-19 10:54:51',NULL),(37,8,1,327.90,1,'2023-11-19 11:00:33',NULL),(38,6,2,397.80,1,'2023-11-19 15:06:24',NULL),(39,8,1,28.00,1,'2023-11-24 20:37:14',NULL);
/*!40000 ALTER TABLE `ventas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-11-25 12:26:07
