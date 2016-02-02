-- MySQL dump 10.13  Distrib 5.5.47, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: dbryoku
-- ------------------------------------------------------
-- Server version	5.5.47-0ubuntu0.14.04.1

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
-- Table structure for table `banner`
--

DROP TABLE IF EXISTS `banner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `banner` (
  `idbanner` int(11) NOT NULL AUTO_INCREMENT,
  `contentWord` text NOT NULL,
  PRIMARY KEY (`idbanner`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `banner`
--

LOCK TABLES `banner` WRITE;
/*!40000 ALTER TABLE `banner` DISABLE KEYS */;
INSERT INTO `banner` VALUES (9,'A man who works with his hands a laborer; a man who works with his hands and his brain is a craftman; but a man'),(10,'A man who works with his hands a laborer; a man who works with his hands and his brain is a craftman; but a man'),(11,'A man who works with his hands a laborer; a man who works with his hands and his brain is a craftman; but a man'),(12,'A man who works with his hands a laborer; a man who works with his hands and his brain is a craftman; but a man'),(13,'A man who works with his hands a laborer; a man who works with his hands and his brain is a craftman; but a man'),(14,'A man who works with his hands a laborer; a man who works with his hands and his brain is a craftman; but a man'),(15,'A man who works with his hands a laborer; a man who works with his hands and his brain is a craftman; but a man'),(16,'A man who works with his hands a laborer; a man who works with his hands and his brain is a craftman; but a man');
/*!40000 ALTER TABLE `banner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brand`
--

DROP TABLE IF EXISTS `brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brand` (
  `idbrand` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `idcategory` varchar(45) NOT NULL,
  PRIMARY KEY (`idbrand`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brand`
--

LOCK TABLES `brand` WRITE;
/*!40000 ALTER TABLE `brand` DISABLE KEYS */;
INSERT INTO `brand` VALUES (1,'ABC','10'),(2,'XYZ','10'),(3,'HGT','13'),(4,'XYZ','10'),(5,'ABC','10'),(6,'XYZ','10'),(7,'XYZ','10'),(8,'ABC','10'),(9,'XYZ','10'),(10,'XYZ','10'),(11,'HGT','13'),(12,'XYZ','10'),(13,'ABC','10'),(14,'XYZ','10');
/*!40000 ALTER TABLE `brand` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `idcategory` int(11) NOT NULL AUTO_INCREMENT,
  `owner` varchar(45) NOT NULL,
  `idowner` int(11) NOT NULL,
  `main` varchar(45) DEFAULT NULL,
  `sub` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idcategory`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'project',1,'Pemasangan',NULL),(2,'project',1,'Pemasangan','Pompa'),(3,'project',1,'Pemasangan','Pipa'),(4,'project',2,'Perakitan',''),(5,'project',2,'Perakitan','Filter'),(6,'project',2,'Perakitan','Regulator'),(7,'project',3,'Penjualan',NULL),(8,'project',3,'Penjualan','Pompa'),(9,'project',3,'Penjualan','Aksesoris'),(10,'product',1,'Pump',''),(11,'product',1,'Pump','Gear Pump'),(12,'product',1,'Pump','Diaghpram Pump'),(13,'product',2,'Accesories',''),(14,'product',2,'Accesories','Filter Regulator'),(15,'project',2,'Perakitan','Pompa'),(16,'product',3,'Pump',''),(17,'product',3,'Pump','Gear Pump'),(18,'product',3,'Pump','Diaghpram Pump'),(19,'product',4,'Accesories',''),(20,'product',4,'Accesories','Filter Regulator'),(21,'product',5,'Pump',''),(22,'product',5,'Pump','Gear Pump'),(23,'product',5,'Pump','Diaghpram Pump'),(24,'product',6,'Accesories',''),(25,'product',6,'Accesories','Filter Regulator'),(26,'product',7,'Pump',''),(27,'product',7,'Pump','Gear Pump'),(28,'product',7,'Pump','Diaghpram Pump'),(29,'product',8,'Accesories',''),(30,'product',8,'Accesories','Filter Regulator'),(31,'product',9,'Pump',''),(32,'product',9,'Pump','Gear Pump'),(33,'product',9,'Pump','Diaghpram Pump'),(34,'product',10,'Accesories',''),(35,'product',10,'Accesories','Filter Regulator'),(36,'product',11,'Pump',''),(37,'product',11,'Pump','Gear Pump'),(38,'product',11,'Pump','Diaghpram Pump'),(39,'product',12,'Accesories',''),(40,'product',12,'Accesories','Filter Regulator'),(41,'product',13,'Pump',''),(42,'product',13,'Pump','Gear Pump'),(43,'product',13,'Pump','Diaghpram Pump'),(44,'product',14,'Accesories',''),(45,'product',14,'Accesories','Filter Regulator'),(46,'product',14,'Pump',''),(47,'product',14,'Pump','Gear Pump'),(48,'product',14,'Pump','Diaghpram Pump');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `client` (
  `idclient` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`idclient`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `client`
--

LOCK TABLES `client` WRITE;
/*!40000 ALTER TABLE `client` DISABLE KEYS */;
INSERT INTO `client` VALUES (1,'Client 1'),(2,'Client 2'),(3,'Client 3'),(4,'Client 4'),(5,'Client 5'),(6,'Client 6'),(7,'Client 7'),(8,'Client 8'),(9,'Client 9'),(10,'Client 10'),(11,'Client 11'),(12,'Client 12'),(13,'Client 13'),(14,'Client 14'),(15,'Client 15'),(16,'Client 16');
/*!40000 ALTER TABLE `client` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company` (
  `idcompany` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`idcompany`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
INSERT INTO `company` VALUES (1,'CV. RYOKU PETROJAYA MANDIRI');
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `idimages` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `owner` varchar(45) NOT NULL,
  `idowner` int(11) NOT NULL,
  PRIMARY KEY (`idimages`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (1,'Gallery Post Example','images/owl1.jpg','banner',9),(2,'Gallery Post Example','images/owl2.jpg','banner',10),(3,'Gallery Post Example','images/owl3.jpg','banner',11),(4,'Gallery Post Example','images/owl4.jpg','banner',12),(5,'Gallery Post Example','images/owl5.jpg','banner',13),(6,'Gallery Post Example','images/owl6.jpg','banner',14),(7,'Gallery Post Example','images/owl7.jpg','banner',15),(8,'Gallery Post Example','images/owl8.jpg','banner',16),(9,'Profile Company','images/banner.jpg','about',1),(10,'Client Images','images/owl1.jpg','client',1),(11,'Client Images','images/owl2.jpg','client',2),(12,'Client Images','images/owl3.jpg','client',3),(13,'Client Images','images/owl4.jpg','client',4),(14,'Client Images','images/owl5.jpg','client',5),(15,'Client Images','images/owl6.jpg','client',6),(16,'Client Images','images/owl7.jpg','client',7),(17,'Client Images','images/owl8.jpg','client',8),(18,'Client Images','images/owl1.jpg','client',9),(19,'Client Images','images/owl2.jpg','client',10),(20,'Client Images','images/owl3.jpg','client',11),(21,'Client Images','images/owl4.jpg','client',12),(22,'Client Images','images/owl5.jpg','client',13),(23,'Client Images','images/owl6.jpg','client',14),(24,'Client Images','images/owl7.jpg','client',15),(25,'Client Images','images/owl8.jpg','client',16),(26,'googleplus','images/googleplus.png','social',2),(27,'blogspot','images/blogspot.png','social',3),(28,'facebook','images/facebook.png','social',4),(29,'Company Logo','images/logo.png','company',1),(30,'Our Service','images/pic.jpg','Service',1),(31,'Our Service','images/pic1.jpg','Service',2),(32,'Our Service','images/pic2.jpg','Service',3),(33,'Pemasangan','images/pic.jpg','Project',1),(34,'Perakitan','images/pic2.jpg','Project',2),(35,'Penjualan','images/pic1.jpg','Project',3),(36,'Our Service','images/pic1.jpg','Service',2),(37,'Our Service','images/pic2.jpg','Service',3),(38,'Pemasangan','images/pic.jpg','Project',1),(39,'Perakitan','images/pic2.jpg','Project',2),(40,'Penjualan','images/pic1.jpg','Project',3),(41,'Our Service','images/pic.jpg','Service',1),(42,'Product Images','images/owl1.jpg','Product',1),(43,'Product Images','images/owl2.jpg','Product',2),(44,'Product Images','images/owl3.jpg','Product',3),(45,'Product Images','images/owl4.jpg','Product',4),(46,'Product Images','images/owl5.jpg','Product',5),(47,'Product Images','images/owl6.jpg','Product',6),(48,'Product Images','images/owl7.jpg','Product',7),(49,'Product Images','images/owl8.jpg','Product',8),(50,'Product Images','images/owl1.jpg','Product',9),(51,'Product Images','images/owl2.jpg','Product',10),(52,'Product Images','images/owl3.jpg','Product',11),(53,'Product Images','images/owl4.jpg','Product',12),(54,'Product Images','images/owl5.jpg','Product',13),(55,'Product Images','images/owl6.jpg','Product',14),(56,'Product Images','images/owl7.jpg','Product',15),(57,'Product Images','images/owl8.jpg','Product',16),(58,'Product Images','images/owl1.jpg','Product',17),(59,'Product Images','images/owl2.jpg','Product',18),(60,'Product Images','images/owl3.jpg','Product',19),(61,'Product Images','images/owl4.jpg','Product',20),(62,'Product Images','images/owl5.jpg','Product',21),(63,'Product Images','images/owl6.jpg','Product',22),(64,'Product Images','images/owl7.jpg','Product',23),(65,'Product Images','images/owl8.jpg','Product',24),(66,'Brand Images','images/owl1.jpg','Brand',1),(67,'Brand Images','images/owl2.jpg','Brand',2),(68,'Brand Images','images/owl3.jpg','Brand',3),(69,'Brand Images','images/owl4.jpg','Brand',4),(70,'Brand Images','images/owl5.jpg','Brand',5),(71,'Brand Images','images/owl6.jpg','Brand',6),(72,'Brand Images','images/owl7.jpg','Brand',7),(73,'Brand Images','images/owl8.jpg','Brand',8),(74,'Brand Images','images/owl1.jpg','Brand',9),(75,'Brand Images','images/owl2.jpg','Brand',10),(76,'Brand Images','images/owl3.jpg','Brand',11),(77,'Brand Images','images/owl4.jpg','Brand',12),(78,'Brand Images','images/owl5.jpg','Brand',13),(79,'Brand Images','images/owl6.jpg','Brand',14),(80,'Product Images','images/owl5.jpg','Product',25),(81,'Product Images','images/owl6.jpg','Product',26),(82,'Product Images','images/owl7.jpg','Product',27),(83,'Product Images','images/owl8.jpg','Product',28),(84,'Product Images','images/owl1.jpg','Product',1),(85,'Product Images','images/owl2.jpg','Product',2),(86,'Product Images','images/owl3.jpg','Product',3),(87,'Product Images','images/owl4.jpg','Product',4),(88,'Product Images','images/owl5.jpg','Product',5),(89,'Product Images','images/owl6.jpg','Product',6),(90,'Product Images','images/owl7.jpg','Product',7),(91,'Product Images','images/owl8.jpg','Product',8),(92,'Product Images','images/owl1.jpg','Product',9),(93,'Product Images','images/owl2.jpg','Product',10),(94,'Product Images','images/owl3.jpg','Product',11),(95,'Product Images','images/owl4.jpg','Product',12),(96,'Product Images','images/owl5.jpg','Product',13),(97,'Product Images','images/owl6.jpg','Product',14),(98,'Product Images','images/owl7.jpg','Product',15),(99,'Product Images','images/owl8.jpg','Product',16),(100,'Product Images','images/owl1.jpg','Product',17),(101,'Product Images','images/owl2.jpg','Product',18),(102,'Product Images','images/owl3.jpg','Product',19),(103,'Product Images','images/owl4.jpg','Product',20),(104,'Product Images','images/owl5.jpg','Product',21),(105,'Product Images','images/owl6.jpg','Product',22),(106,'Product Images','images/owl7.jpg','Product',23),(107,'Product Images','images/owl8.jpg','Product',24);
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `outlet`
--

DROP TABLE IF EXISTS `outlet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `outlet` (
  `idoutlet` int(11) NOT NULL AUTO_INCREMENT,
  `idcompany` int(11) NOT NULL,
  `address` text NOT NULL,
  PRIMARY KEY (`idoutlet`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `outlet`
--

LOCK TABLES `outlet` WRITE;
/*!40000 ALTER TABLE `outlet` DISABLE KEYS */;
INSERT INTO `outlet` VALUES (1,1,'GEDUNG HARKOT, Lantai Dasar Blok B5 No.02 Jl. Raya Merdeka No.53, Kel. Sukajadi Kec. Karawaci - Tangerang 15111');
/*!40000 ALTER TABLE `outlet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phone`
--

DROP TABLE IF EXISTS `phone`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phone` (
  `idphone` int(11) NOT NULL AUTO_INCREMENT,
  `idoutlet` int(11) NOT NULL,
  `phone` varchar(25) NOT NULL,
  `fax` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`idphone`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phone`
--

LOCK TABLES `phone` WRITE;
/*!40000 ALTER TABLE `phone` DISABLE KEYS */;
INSERT INTO `phone` VALUES (1,1,'(+62 21) 5576 2060','(+62 21) 5576 2060');
/*!40000 ALTER TABLE `phone` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `idproduct` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `idbrand` int(11) NOT NULL,
  `idcategory` int(11) NOT NULL,
  `contentWord` text NOT NULL,
  PRIMARY KEY (`idproduct`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Gear Pump XYZ',1,11,'sdasadasdsa'),(2,'Diapghram Pump ABC',2,14,'asadasdasd'),(3,'Filter Regulator 3 Ways',3,17,'sadsadas'),(4,'Gear Pump XYZ',4,20,'asdasdas'),(5,'Diapghram Pump ABC',5,22,'asdasdas'),(6,'Filter Regulator 3 Ways',6,25,'asdasdas'),(7,'Gear Pump XYZ',7,27,'asdasda'),(8,'Diapghram Pump ABC',8,30,'asdasdsa'),(9,'Filter Regulator 3 Ways',9,32,'sadasda'),(10,'Gear Pump XYZ',10,35,'asdasdas'),(11,'Diapghram Pump ABC',11,37,'asdasda'),(12,'Filter Regulator 3 Ways',12,40,'asdsada'),(13,'Diapghram Pump ABC',13,42,'asdadasda'),(14,'Filter Regulator 3 Ways',14,45,'asdasdas'),(15,'Gear Pump XYZ',1,12,'sdasadasdsa'),(16,'Diapghram Pump ABC',2,14,'asadasdasd'),(17,'Filter Regulator 3 Ways',3,18,'sadsadas'),(18,'Gear Pump XYZ',4,17,'asdasdas'),(19,'Diapghram Pump ABC',5,23,'asdasdas'),(20,'Filter Regulator 3 Ways',6,25,'asdasdas'),(21,'Gear Pump XYZ',7,28,'asdasda'),(22,'Diapghram Pump ABC',8,30,'asdasdsa'),(23,'Filter Regulator 3 Ways',9,33,'sadasda'),(24,'Gear Pump XYZ',10,35,'asdasdas'),(25,'Diapghram Pump ABC',11,38,'asdasda'),(26,'Filter Regulator 3 Ways',12,40,'asdsada'),(27,'Diapghram Pump ABC',13,43,'asdadasda'),(28,'Filter Regulator 3 Ways',14,47,'asdasdas');
/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `profile` (
  `idprofile` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `aboutWord` text NOT NULL,
  PRIMARY KEY (`idprofile`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` VALUES (1,'Ryoku Profile','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut porta porttitor magna sed iaculis. Aenean hendrerit viverra nunc, et viverra nunc. Aenean dolor risus, finibus eu tempor nec, congue quis sem. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque quis feugiat mauris, tristique rhoncus massa. Fusce faucibus varius turpis, eget suscipit massa condimentum at. Fusce volutpat risus eu mauris sagittis porta. Mauris vehicula risus eu urna facilisis aliquam. Morbi viverra, nisi a ultricies hendrerit, libero velit fermentum diam, quis accumsan risus ipsum ut felis. Vivamus ac orci ligula. Vestibulum vitae augue luctus, congue enim ut, mattis arcu. Vivamus nisi velit, interdum at pulvinar auctor, elementum vel nisi. Nulla ultrices ac elit ac molestie. Phasellus iaculis lobortis rhoncus. Phasellus sagittis elit nec velit pellentesque, a imperdiet nibh varius.');
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project` (
  `idproject` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `location` varchar(45) NOT NULL,
  `date` date NOT NULL,
  `idcategory` int(11) NOT NULL,
  `contentWord` text NOT NULL,
  `idproduct` int(11) NOT NULL,
  PRIMARY KEY (`idproject`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project`
--

LOCK TABLES `project` WRITE;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` VALUES (1,'Pemasangan Pompa Daur Ulang','Jakarta','2015-01-27',2,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut porta porttitor magna sed iaculis. Aenean hendrerit viverra nunc, et viverra nunc. Aenean dolor risus, finibus eu tempor nec, congue quis sem. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque quis feugiat mauris, tristique rhoncus massa. Fusce faucibus varius turpis, eget suscipit massa condimentum at. Fusce volutpat risus eu mauris sagittis porta. Mauris vehicula risus eu urna facilisis aliquam. Morbi viverra, nisi a ultricies hendrerit, libero velit fermentum diam, quis accumsan risus ipsum ut felis. Vivamus ac orci ligula. Vestibulum vitae augue luctus, congue enim ut, mattis arcu. Vivamus nisi velit, interdum at pulvinar auctor, elementum vel nisi. Nulla ultrices ac elit ac molestie. Phasellus iaculis lobortis rhoncus. Phasellus sagittis elit nec velit pellentesque, a imperdiet nibh varius.',1),(2,'Perakitan Pompa Pemadam','Jakarta','2013-07-25',15,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut porta porttitor magna sed iaculis. Aenean hendrerit viverra nunc, et viverra nunc. Aenean dolor risus, finibus eu tempor nec, congue quis sem. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque quis feugiat mauris, tristique rhoncus massa. Fusce faucibus varius turpis, eget suscipit massa condimentum at. Fusce volutpat risus eu mauris sagittis porta. Mauris vehicula risus eu urna facilisis aliquam. Morbi viverra, nisi a ultricies hendrerit, libero velit fermentum diam, quis accumsan risus ipsum ut felis. Vivamus ac orci ligula. Vestibulum vitae augue luctus, congue enim ut, mattis arcu. Vivamus nisi velit, interdum at pulvinar auctor, elementum vel nisi. Nulla ultrices ac elit ac molestie. Phasellus iaculis lobortis rhoncus. Phasellus sagittis elit nec velit pellentesque, a imperdiet nibh varius.',0),(3,'Penjualan Filter Regulator','Bandung','2016-01-28',9,'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut porta porttitor magna sed iaculis. Aenean hendrerit viverra nunc, et viverra nunc. Aenean dolor risus, finibus eu tempor nec, congue quis sem. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque quis feugiat mauris, tristique rhoncus massa. Fusce faucibus varius turpis, eget suscipit massa condimentum at. Fusce volutpat risus eu mauris sagittis porta. Mauris vehicula risus eu urna facilisis aliquam. Morbi viverra, nisi a ultricies hendrerit, libero velit fermentum diam, quis accumsan risus ipsum ut felis. Vivamus ac orci ligula. Vestibulum vitae augue luctus, congue enim ut, mattis arcu. Vivamus nisi velit, interdum at pulvinar auctor, elementum vel nisi. Nulla ultrices ac elit ac molestie. Phasellus iaculis lobortis rhoncus. Phasellus sagittis elit nec velit pellentesque, a imperdiet nibh varius.',0);
/*!40000 ALTER TABLE `project` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service`
--

DROP TABLE IF EXISTS `service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service` (
  `idservice` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `contentWord` text NOT NULL,
  PRIMARY KEY (`idservice`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service`
--

LOCK TABLES `service` WRITE;
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
INSERT INTO `service` VALUES (1,'Pengelasan','Ini yang kami kerjakan.. Melakukan pengelasan bla bla bla bla'),(2,'Bubut','Ini yang kami kerjakan.. Melakukan pengelasan bla bla bla bla'),(3,'Pemasangan','Ini yang kami kerjakan.. Melakukan pengelasan bla bla bla bla');
/*!40000 ALTER TABLE `service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `social`
--

DROP TABLE IF EXISTS `social`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `social` (
  `idsocial` int(11) NOT NULL AUTO_INCREMENT,
  `contentWord` text,
  `name` varchar(45) DEFAULT NULL,
  `link` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idsocial`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `social`
--

LOCK TABLES `social` WRITE;
/*!40000 ALTER TABLE `social` DISABLE KEYS */;
INSERT INTO `social` VALUES (1,'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem',NULL,NULL),(2,NULL,'google+','https://plus.google.com/106530056449750098391'),(3,NULL,'blogspot','ryoku-petrojaya-mandiri.blogspot.com'),(4,NULL,'facebook','www.facebook.com/ryokupetrojayamandiri');
/*!40000 ALTER TABLE `social` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `iduser` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `privilege` int(11) NOT NULL,
  PRIMARY KEY (`iduser`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','admin','Kristian','Heryanto','christ.lupher@gmail.com',1),(2,'operator','operator','Operator','Website','christ.lupher@gmail.com',2);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visitor`
--

DROP TABLE IF EXISTS `visitor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `visitor` (
  `idvisitor` int(11) NOT NULL AUTO_INCREMENT,
  `datePost` datetime NOT NULL,
  `firstName` varchar(45) NOT NULL,
  `lastName` varchar(45) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`idvisitor`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitor`
--

LOCK TABLES `visitor` WRITE;
/*!40000 ALTER TABLE `visitor` DISABLE KEYS */;
INSERT INTO `visitor` VALUES (1,'2016-01-27 00:00:00','Kristian','Heryanto','08992112203','christ.lupher@gmai.com','Test'),(2,'2016-01-27 00:00:00','Inul','Daratista','08992112203','christ.lupher@gmai.com','Test test');
/*!40000 ALTER TABLE `visitor` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-02-03  2:18:28
