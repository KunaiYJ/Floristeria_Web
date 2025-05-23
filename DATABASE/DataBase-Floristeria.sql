-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: localhost    Database: floristeria_db
-- ------------------------------------------------------
-- Server version	8.0.37

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
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `IDcategoria` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text,
  PRIMARY KEY (`IDcategoria`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (4,'Flores CDMX','asdasdasd'),(5,'Flores Guadalajara','askjdlaksjda');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientes` (
  `IDcliente` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `DateAdd` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`IDcliente`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Gerardo Olivares','6335432345','aklsdnaolksdnas','2024-09-02 20:00:16'),(2,'Francisco Moron','6334569122','Calle 10 ave 21','2024-09-04 17:09:06'),(3,'Reyna','63345678121','calle 1 ave 23','2024-09-04 17:22:27'),(4,'Yenitzi Olivares','6331233457','Calle 5 Ave 3','2024-09-04 17:28:51'),(5,'MIchell Ochoa','6330987652','Calle 8 ave 23','2024-09-04 17:30:02'),(9,'asdfasdf','4234234234234','Calla 5 ave 5','2024-09-04 17:45:11'),(10,'David Alejandro','6331233212','Calle 1 Ave 23','2024-10-23 08:18:59');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entradaproductos`
--

DROP TABLE IF EXISTS `entradaproductos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `entradaproductos` (
  `IDentrada` int NOT NULL AUTO_INCREMENT,
  `IDproducto` int DEFAULT NULL,
  `fecha` date NOT NULL,
  `stock` int NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `usuarioID` int DEFAULT NULL,
  PRIMARY KEY (`IDentrada`),
  KEY `IDproducto` (`IDproducto`),
  KEY `usuarioID` (`usuarioID`),
  CONSTRAINT `entradaproductos_ibfk_1` FOREIGN KEY (`IDproducto`) REFERENCES `productos` (`IDproducto`),
  CONSTRAINT `entradaproductos_ibfk_2` FOREIGN KEY (`usuarioID`) REFERENCES `usuarios` (`IDusuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entradaproductos`
--

LOCK TABLES `entradaproductos` WRITE;
/*!40000 ALTER TABLE `entradaproductos` DISABLE KEYS */;
/*!40000 ALTER TABLE `entradaproductos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inventario`
--

DROP TABLE IF EXISTS `inventario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `inventario` (
  `IDmovimiento` int NOT NULL AUTO_INCREMENT,
  `IDproducto` int DEFAULT NULL,
  `tipo_movimiento` enum('entrada','salida') NOT NULL,
  `cantidad` int NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`IDmovimiento`),
  KEY `FK_INVENTARIO_PRODUCTOS` (`IDproducto`),
  CONSTRAINT `FK_INVENTARIO_PRODUCTOS` FOREIGN KEY (`IDproducto`) REFERENCES `productos` (`IDproducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventario`
--

LOCK TABLES `inventario` WRITE;
/*!40000 ALTER TABLE `inventario` DISABLE KEYS */;
/*!40000 ALTER TABLE `inventario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos`
--

DROP TABLE IF EXISTS `pedidos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedidos` (
  `IDpedido` int NOT NULL AUTO_INCREMENT,
  `producto` varchar(100) NOT NULL,
  `descripcionPedido` varchar(255) DEFAULT NULL,
  `cantidad` int NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `contacto` varchar(100) NOT NULL,
  `FormaPago` varchar(50) NOT NULL,
  `fecha` date NOT NULL,
  `IDenvio` int DEFAULT NULL,
  `IDcliente` int DEFAULT NULL,
  `estado` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`IDpedido`),
  KEY `IDenvio` (`IDenvio`),
  KEY `fk_cliente` (`IDcliente`),
  CONSTRAINT `fk_cliente` FOREIGN KEY (`IDcliente`) REFERENCES `clientes` (`IDcliente`),
  CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`IDenvio`) REFERENCES `tipo_de_envio` (`IDenvio`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos`
--

LOCK TABLES `pedidos` WRITE;
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
INSERT INTO `pedidos` VALUES (4,'Ramo de Girasoles','ramo de girasol con flores blancas',2,'Calle 5 Ave 34 y 35, casa blanca','63332156985','Efectivo','2024-11-01',1,4,'Pagado'),(8,'Ramo Prueba 2','askdnalskdnas',2,'Calle 1 Ave 2','6336541232','Efectivo','2024-11-04',2,1,'Pagado'),(9,'Ramo Prueba 3','kdmoaskdmoaksd',2,'Calle 10 ave 20','6331233219','Tarjeta','2024-11-05',2,10,'Pagado'),(12,'Prueba 13','aoskdmaoksmd',2,'aoskldmaoklsmd','6331233219','Efectivo','2024-11-05',2,1,'Pagado'),(13,'Ramo Rosas 11','aoksmdoaksmdas',2,'asdasdasdas','6331233219','Efectivo','2024-11-06',1,1,'Pagado');
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pedidos_usuarios`
--

DROP TABLE IF EXISTS `pedidos_usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pedidos_usuarios` (
  `IDpedidoCliente` int NOT NULL AUTO_INCREMENT,
  `producto` varchar(255) DEFAULT NULL,
  `descripcion` text,
  `cantidad` int DEFAULT NULL,
  `direccion` varchar(255) DEFAULT NULL,
  `contacto` varchar(50) DEFAULT NULL,
  `formaPago` enum('Efectivo','Tarjeta') DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `IDenvio` int DEFAULT NULL,
  `usuarioID` int DEFAULT NULL,
  `estado` enum('Pendiente','Pagado','Terminado') DEFAULT NULL,
  PRIMARY KEY (`IDpedidoCliente`),
  KEY `IDenvio` (`IDenvio`),
  KEY `usuarioID` (`usuarioID`),
  CONSTRAINT `pedidos_usuarios_ibfk_1` FOREIGN KEY (`IDenvio`) REFERENCES `tipo_de_envio` (`IDenvio`) ON DELETE CASCADE,
  CONSTRAINT `pedidos_usuarios_ibfk_2` FOREIGN KEY (`usuarioID`) REFERENCES `usuarios` (`IDusuario`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pedidos_usuarios`
--

LOCK TABLES `pedidos_usuarios` WRITE;
/*!40000 ALTER TABLE `pedidos_usuarios` DISABLE KEYS */;
INSERT INTO `pedidos_usuarios` VALUES (1,'Ramo prueba 1','asodaoksdmasd',2,'aoiskdmaoksmd','6331233219','Tarjeta','2024-11-01',2,12,'Pagado'),(2,'Ramo prueba 2','asodaoksdmasd',2,'aoiskdmaoksmd','6331233219','Tarjeta','2024-11-01',1,12,'Terminado'),(3,'Prueba 12','oamksdmaoksd',2,'akosdmaoksmd','6331233219','Tarjeta','2024-11-04',2,12,'Pagado'),(6,'Prueba 23','asdasdasdasdas',2,'asdasdasdas','12341234123412','Efectivo','2024-11-08',1,12,'Pagado'),(7,'Rosas Blancas','niwuqneiqjwneqwe',1,'asodkmaosdkmas','6331233219','Efectivo','2024-11-07',2,12,'Pendiente');
/*!40000 ALTER TABLE `pedidos_usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `productos`
--

DROP TABLE IF EXISTS `productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `productos` (
  `IDproducto` int NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) NOT NULL,
  `precio` decimal(10,2) NOT NULL,
  `stock` int NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `IDproveedor` int DEFAULT NULL,
  `IDcategoria` int DEFAULT NULL,
  `nombreProducto` varchar(255) DEFAULT NULL,
  `cantidad_flores` int NOT NULL,
  `tags` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`IDproducto`),
  KEY `IDproveedor` (`IDproveedor`),
  KEY `productos_ibfk_2` (`IDcategoria`),
  CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`IDproveedor`) REFERENCES `proveedores` (`IDproveedor`),
  CONSTRAINT `productos_ibfk_2` FOREIGN KEY (`IDcategoria`) REFERENCES `categorias` (`IDcategoria`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productos`
--

LOCK TABLES `productos` WRITE;
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` VALUES (1,'Este ramo es especial para esa persona que le gusta el brillo del girasol',450.00,11,'845d6e0dc662c850143e4474398256e2','2024-10-03 21:47:37',2,5,'Ramo de Girasol (Actualizado)',30,'Girasoles,        Tulipanes,        Rosas,      Orquideas,   Flores'),(3,'alskdnmalksdnalsknd',200.00,24,'185e2015f58a5b1d31bad0f20f7b4634','2024-10-05 07:58:53',1,4,'Ramo de Rosas (Actualizado)',220,'Rosas');
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedores`
--

DROP TABLE IF EXISTS `proveedores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedores` (
  `IDproveedor` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `direccion` varchar(255) NOT NULL,
  `ciudad` varchar(100) DEFAULT NULL,
  `fecha` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`IDproveedor`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores`
--

LOCK TABLES `proveedores` WRITE;
/*!40000 ALTER TABLE `proveedores` DISABLE KEYS */;
INSERT INTO `proveedores` VALUES (1,'Flores Guadalajara','6334619826','Calle 1 ave 1','Guadalajara','2024-09-12 18:17:17'),(2,'Flores AP','6331231238','Calle 19 ave 22 y 23','Agua Prieta','2024-09-27 00:10:23');
/*!40000 ALTER TABLE `proveedores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proveedores_productos`
--

DROP TABLE IF EXISTS `proveedores_productos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `proveedores_productos` (
  `IDproveedor_producto` int NOT NULL AUTO_INCREMENT,
  `IDproveedor` int DEFAULT NULL,
  `IDproducto` int DEFAULT NULL,
  PRIMARY KEY (`IDproveedor_producto`),
  KEY `IDproveedor` (`IDproveedor`),
  KEY `IDproducto` (`IDproducto`),
  CONSTRAINT `proveedores_productos_ibfk_1` FOREIGN KEY (`IDproveedor`) REFERENCES `proveedores` (`IDproveedor`),
  CONSTRAINT `proveedores_productos_ibfk_2` FOREIGN KEY (`IDproducto`) REFERENCES `productos` (`IDproducto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proveedores_productos`
--

LOCK TABLES `proveedores_productos` WRITE;
/*!40000 ALTER TABLE `proveedores_productos` DISABLE KEYS */;
/*!40000 ALTER TABLE `proveedores_productos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `IDrol` int NOT NULL AUTO_INCREMENT,
  `puesto` varchar(50) NOT NULL,
  PRIMARY KEY (`IDrol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'administrador'),(2,'empleado'),(3,'cliente');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_de_envio`
--

DROP TABLE IF EXISTS `tipo_de_envio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tipo_de_envio` (
  `IDenvio` int NOT NULL AUTO_INCREMENT,
  `tipo_envio` varchar(50) NOT NULL,
  `costo` decimal(10,2) NOT NULL,
  PRIMARY KEY (`IDenvio`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_de_envio`
--

LOCK TABLES `tipo_de_envio` WRITE;
/*!40000 ALTER TABLE `tipo_de_envio` DISABLE KEYS */;
INSERT INTO `tipo_de_envio` VALUES (1,'Recoger',0.00),(2,'Enviar a Casa',50.00);
/*!40000 ALTER TABLE `tipo_de_envio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `IDusuario` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `estatus` varchar(50) NOT NULL,
  `confirmado` tinyint(1) NOT NULL DEFAULT '0',
  `token` varchar(255) DEFAULT NULL,
  `IDrol` int DEFAULT NULL,
  PRIMARY KEY (`IDusuario`),
  UNIQUE KEY `correo` (`email`),
  KEY `IDrol` (`IDrol`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`IDrol`) REFERENCES `roles` (`IDrol`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (12,'Isac','Montes Mendoza','Isac123@hotmail.com','$2y$10$QmEDESK6LfKRxU.2tPXza.w.f8fBOGxiehsxhaSmT0/ZBOxNrpGtO','1',1,'',1),(14,'David Alejandro','Figueroa Moreno','David.1@gmail.com','$2y$10$.Vv6hd5D.PTU3yVOFjPO2OIEmUY/GMnAKZgNEZsAeQwyZOHlNDFjC','1',0,'',2),(15,'Jorge Osvaldo','Vindiola','Jorge.2@gmail.com','$2y$10$DlL4DHZrVgSSG78ogBTVcevPiQ3oX32mIaPPb4aZr0lOdFm7iifVa','0',0,'',3),(16,'Fernanda','Olivares','Fernanda321@gmail.com','$2y$10$iy9d5uyXwN/4GwzzVysefuIMDoi4Vpcyp9GCqi.eZsKPQgokSmDGS','1',0,'',1),(17,'Adrian Alejandro','Hernandez','Adrian.A@gmail.com','$2y$10$ifLQsOIIUGV7RJWePjr6guhURvGycHzuGhL22LaZpL83X41SSIdcS','0',0,'',3),(21,'Julian','Mendoza','Julia.M@gmail.com','$2y$10$H4PPH//dbqeknZH30LUxbOHY2iC53zWbe7AUAZnhJY2TJ4bbx89Ke','1',0,'',2),(22,'Branyan','Montoya','Brayan.M@gmail.com','$2y$10$LoxkDh57zI6kNObThsHQ8uR3GgoW.C198/roeifgmiUscLu0ZiuYK','1',1,'',3),(23,'Ana ','Ochoa','Ana.O@gmail.com','$2y$10$/h2ybpXcIBwiGRD6.3A2nOu9laPGYL6/s11QIOwLGgspzSDOTjuqO','1',0,'',3),(24,'Misael','Pina','Pina.M@gmail.com','$2y$10$pEPjBtEESr6pRVMH2SBQyuyzi.Z1NwlODTJKrS2M2FAmuwsqMD/pa','1',0,'',3),(25,'David','Figueroa','david@gmail.com','$2y$10$Asz5NwRwv4ESyKoA.nmPoeJXb.6V6Sd/kr.gjMk83QiDKBYLV4a1a','1',0,'',2),(27,'Gerardo','Mancinas Olivares','Gerardo.M@gmail.com','$2y$10$EL7lvLoiXo3EfK00ff2axeez8B8uQk/LegjlW.hGEmftDxHoHfOaC','1',0,'66d60c5643bf4',3),(28,'Jennifer Karina','Chavez Ambrosio','Jennifer.K@gmail.com','$2y$10$h2YcFCB2MdMUaZo8SIjXzu3vN9foCEuho4rMhf1K.wv/EJbElCJx.','1',1,'',3),(29,'Juanito ','Perez','Juanito@gmail.com','$2y$10$a53OFEStJ5ik5cbf1Ovnf.IQ0VLjL7lvzoSq0TQ/LyzfIj.YfZxJ2','1',0,'',3),(30,'Fabian','Torres','Fabian.T@gmail.com','$2y$10$9oF6jyRxSAyv6zcekgzXnuhLTvW6NB9Fi/sdWeJoDqpTFVj81qPYy','',1,'',3),(31,'Misael','Pina Vega','misael@gmail.com','$2y$10$cpi6gQnoySg0cxpwhRsqwuJK8Nooj.a8ugy3JLWwQ5v5a5YS3WfxG','',1,'',3);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ventas`
--

DROP TABLE IF EXISTS `ventas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ventas` (
  `IDventa` int NOT NULL AUTO_INCREMENT,
  `ProductoID` int DEFAULT NULL,
  `cantidad` int NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `fecha` date NOT NULL,
  `ClienteID` int DEFAULT NULL,
  PRIMARY KEY (`IDventa`),
  KEY `ClienteID` (`ClienteID`),
  KEY `ventas_ibfk_1` (`ProductoID`),
  CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`ProductoID`) REFERENCES `productos` (`IDproducto`) ON DELETE CASCADE,
  CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`ClienteID`) REFERENCES `clientes` (`IDcliente`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ventas`
--

LOCK TABLES `ventas` WRITE;
/*!40000 ALTER TABLE `ventas` DISABLE KEYS */;
INSERT INTO `ventas` VALUES (1,3,2,400.00,'2024-10-22',5),(2,3,3,600.00,'2024-10-22',4),(3,3,2,400.00,'2024-10-25',10),(5,3,3,600.00,'2024-10-25',3),(6,3,1,200.00,'2024-10-25',9),(7,3,1,200.00,'2024-10-25',9),(8,3,1,200.00,'2024-10-25',9),(9,3,1,200.00,'2024-10-25',9),(10,3,1,200.00,'2024-10-25',9),(17,3,1,200.00,'2024-10-25',10),(21,3,1,200.00,'2024-10-30',10),(23,3,3,600.00,'2024-10-30',10),(25,3,1,200.00,'2024-11-06',10);
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

-- Dump completed on 2024-11-06 17:03:23
