-- MySQL dump 10.16  Distrib 10.1.38-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: apt_rural
-- ------------------------------------------------------
-- Server version	10.1.38-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `correo` varchar(128) NOT NULL,
  `telefono` int(11) NOT NULL,
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `correo` (`correo`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'Maria','Perez','maria@gmail.com',789451263),(2,'Antonio','Martinez','antonio@gmail.com',456127893),(3,'Emi','Rodo','emi@gmail.com',987632541),(4,'Josep','Peig','josep@gmail.com',879543215),(5,'Anna','Perez','anna@gmail.com',589462423),(6,'Day','Vazquez','day@gmail.com',452454545),(7,'Rosi','Segura','rosi@gmail.com',789451236),(8,'Chris','Sancho','chris@gmail.com',4567891),(9,'Tania','Trujillo','tania@gmail.com',456123217),(10,'Tina','amat','mandi@gmail.com',456789635),(22,'Tina','Segura','p@gmail.com',456789635),(31,'Javi','GarzÃ³n','javigar@ghi.com',456585223),(34,'Juan','Magan','wfe@gmail.com',134866),(39,'Diane','M. Sanders','ofsP@gmail.com',236493),(40,'Bill','Gates','billgates@outlook.kom',1),(41,'Oscar','Santos','osr1702@gmail.com',687521465),(44,'Linus','Torvalds','linust@outoop.kom',876);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservas`
--

DROP TABLE IF EXISTS `reservas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservas` (
  `id_reserva` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `entrada` date NOT NULL,
  `salida` date NOT NULL,
  PRIMARY KEY (`id_reserva`),
  KEY `fk_reservas_clientes` (`id_cliente`),
  CONSTRAINT `fk_reservas_clientes` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservas`
--

LOCK TABLES `reservas` WRITE;
/*!40000 ALTER TABLE `reservas` DISABLE KEYS */;
INSERT INTO `reservas` VALUES (1,1,'2019-07-05','2019-08-02'),(13,39,'2019-08-25','2019-08-27'),(14,40,'2019-11-04','2019-11-08'),(17,41,'2019-09-03','2019-09-17'),(23,1,'2025-12-01','2025-12-15'),(24,1,'2025-12-28','2025-12-29'),(25,3,'2050-01-01','2050-05-01'),(27,1,'2025-01-01','2025-01-05'),(29,1,'2021-05-01','2021-05-30'),(30,1,'2021-06-01','2021-08-30'),(31,1,'2021-10-05','2021-10-08'),(32,5,'2023-12-01','2023-12-31'),(33,44,'2019-08-19','2019-08-25');
/*!40000 ALTER TABLE `reservas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-07-12 11:15:04
