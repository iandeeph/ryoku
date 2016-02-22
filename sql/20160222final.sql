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
-- Table structure for table `brand`
--

DROP TABLE IF EXISTS `brand`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brand` (
  `idbrand` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  PRIMARY KEY (`idbrand`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brand`
--

LOCK TABLES `brand` WRITE;
/*!40000 ALTER TABLE `brand` DISABLE KEYS */;
INSERT INTO `brand` VALUES (5,'Brand 2'),(14,'Brand 1');
/*!40000 ALTER TABLE `brand` ENABLE KEYS */;
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
INSERT INTO `client` VALUES (1,'ABCsadasdasd'),(2,'Client 2'),(3,'Client 3'),(4,'Client 4'),(5,'Client 5'),(6,'Client 6'),(7,'Client 7'),(8,'Client 8'),(9,'Client 9'),(10,'Client 10'),(11,'Client 11'),(12,'Client 12'),(13,'Client 13'),(14,'Client 14'),(15,'Client 15'),(16,'Client 16');
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
) ENGINE=InnoDB AUTO_INCREMENT=217 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (9,'Profile Company','images/banner.jpg','about',1),(10,'Client Images','images/owl1.jpg','client',1),(11,'Client Images','images/owl2.jpg','client',2),(12,'Client Images','images/owl3.jpg','client',3),(13,'Client Images','images/owl4.jpg','client',4),(14,'Client Images','images/owl5.jpg','client',5),(15,'Client Images','images/owl6.jpg','client',6),(16,'Client Images','images/owl7.jpg','client',7),(17,'Client Images','images/owl8.jpg','client',8),(18,'Client Images','images/owl1.jpg','client',9),(19,'Client Images','images/owl2.jpg','client',10),(20,'Client Images','images/owl3.jpg','client',11),(21,'Client Images','images/owl4.jpg','client',12),(22,'Client Images','images/owl5.jpg','client',13),(23,'Client Images','images/owl6.jpg','client',14),(24,'Client Images','images/owl7.jpg','client',15),(25,'Client Images','images/facebook-xxl.png','client',16),(26,'googleplus','images/googleplus.png','social',2),(27,'blogspot','images/blogspot.png','social',3),(28,'facebook','images/facebook.png','social',4),(29,'Company Logo','images/logo.png','company',1),(30,'Our Service','images/pic2.jpg','Service',1),(31,'Our Service','images/pic1.jpg','Service',2),(32,'Our Service','images/pic.jpg','Service',3),(33,'Pemasangan','images/pic.jpg','Project',1),(34,'Perakitan','images/pic2.jpg','Project',2),(35,'Penjualan','images/pic1.jpg','Project',3),(36,'Our Service','images/pic1.jpg','Service',2),(37,'Our Service','images/pic2.jpg','Service',3),(38,'Pemasangan','images/pic.jpg','Project',1),(39,'Perakitan','images/pic2.jpg','Project',2),(40,'Penjualan','images/pic1.jpg','Project',3),(41,'Our Service','images/pic.jpg','Service',1),(42,'Product Images','images/owl1.jpg','Product',1),(70,'Brand Images','images/owl5.jpg','Brand',5),(79,'Brand Images','images/Fix_web.jpg','Brand',14),(84,'Product Images','images/owl1.jpg','Product',1),(123,'Product Images','images/Cermati-Logo.1455632402.png','product',1),(124,'Product Images','images/Screenshot from 2015-12-28 11:17:57.1455632402.png','product',1),(125,'Product Images','images/noimage.1455632402.jpg','product',1),(126,'Product Images','images/kartu keluarga.1455632402.jpg','product',1),(127,'Product Images','images/Screenshot from 2015-12-03 11:09:19.1455632402.png','product',1),(128,'Product Images','images/gplus.1455632402.png','product',1),(129,'Product Images','images/waterfallModel.1455632402.png','product',1),(130,'Product Images','images/slide1.1455632402.jpg','product',1),(131,'Product Images','images/slide2.1455632402.jpg','product',1),(132,'Product Images','images/slide3.1455632402.jpg','product',1),(133,'Product Images','images/back.1455632402.jpg','product',1),(135,'Product Images','images/Screenshot from 2015-10-22 02:58:21.1455632402.png','product',1),(138,'Product Images','images/Screenshot from 2015-10-09 17:28:39.png','product',30),(139,'Product Images','images/Screenshot from 2015-10-01 16:57:00.png','product',30),(140,'Product Images','images/Screenshot from 2015-10-21 10:51:25.png','product',30),(141,'Product Images','images/Screenshot from 2015-10-09 17:28:32.png','product',30),(142,'Product Images','images/Screenshot from 2015-10-09 17:28:13.png','product',30),(143,'Product Images','images/Screenshot from 2015-10-09 17:27:54.png','product',30),(144,'Product Images','images/Screenshot from 2016-02-16 15:56:16.png','product',30),(145,'Product Images','images/Screenshot from 2015-10-09 17:27:56.png','product',30),(146,'Product Images','images/Screenshot from 2015-10-09 17:27:58.png','product',30),(147,'Product Images','images/Screenshot from 2015-10-01 16:56:50.png','product',30),(148,'Product Images','images/Screenshot from 2015-10-01 16:57:06.png','product',30),(149,'Product Images','images/Screenshot from 2015-10-02 10:27:12.png','product',30),(150,'Product Images','images/Screenshot from 2015-12-17 10:53:52.png','product',30),(151,'Product Images','images/Screenshot from 2015-09-15 17:16:54.png','product',30),(152,'Product Images','images/Screenshot from 2015-11-27 10:59:27.png','product',30),(153,'Product Images','images/facebook-xxl.1455806206.png','product',31),(154,'Product Images','images/Cermati-Logo.1455806206.png','product',31),(155,'Product Images','images/Screenshot from 2015-12-28 11:17:57.1455806206.png','product',31),(156,'Product Images','images/noimage.1455806206.jpg','product',31),(157,'Product Images','images/kartu keluarga.1455806206.jpg','product',31),(158,'Product Images','images/Screenshot from 2015-12-03 11:09:19.1455806206.png','product',31),(159,'Product Images','images/gplus.1455806206.png','product',31),(160,'Product Images','images/waterfallModel.1455806206.png','product',31),(161,'Product Images','images/slide1.1455806206.jpg','product',31),(162,'Product Images','images/slide2.1455806206.jpg','product',31),(163,'Product Images','images/slide3.1455806206.jpg','product',31),(164,'Product Images','images/back.1455806206.jpg','product',31),(165,'Product Images','images/child3.1455806206.jpg','product',31),(166,'Product Images','images/Screenshot from 2015-10-22 02:58:21.1455806206.png','product',31),(167,'Product Images','images/instagram.png','product',31),(168,'Product Images','images/Fix_web.jpg','product',31),(169,'Product Images','images/Discovering-what-success-looks-like.jpg','product',31),(170,'Product Images','images/facebook-xxl.1455811221.png','product',32),(171,'Product Images','images/Cermati-Logo.1455811221.png','product',32),(172,'Product Images','images/Screenshot from 2015-12-28 11:17:57.1455811221.png','product',32),(173,'Product Images','images/noimage.1455811221.jpg','product',32),(174,'Product Images','images/kartu keluarga.1455811221.jpg','product',32),(175,'Product Images','images/Screenshot from 2015-12-03 11:09:19.1455811221.png','product',32),(176,'Product Images','images/gplus.1455811221.png','product',32),(177,'Product Images','images/waterfallModel.1455811221.png','product',32),(178,'Product Images','images/slide1.1455811221.jpg','product',32),(179,'Product Images','images/slide2.1455811221.jpg','product',32),(180,'Product Images','images/slide3.1455811221.jpg','product',32),(181,'Product Images','images/back.1455811221.jpg','product',32),(182,'Product Images','images/child3.1455811221.jpg','product',32),(183,'Product Images','images/Screenshot from 2015-10-22 02:58:21.1455811221.png','product',32),(184,'Product Images','images/instagram.1455811221.png','product',32),(185,'Product Images','images/Fix_web.1455811221.jpg','product',32),(186,'Product Images','images/Discovering-what-success-looks-like.1455811221.jpg','product',32),(187,'Product Images','images/client server.png','product',32),(188,'Product Images','images/support-sprite.png','product',32),(189,'Product Images','images/Screenshot from 2015-09-17 17:57:29.png','product',32),(190,'Product Images','images/facebook-xxl.1455908045.png','project',1),(191,'Product Images','images/Cermati-Logo.1455908045.png','project',1),(192,'Product Images','images/Screenshot from 2015-12-28 11:17:57.1455908045.png','project',1),(193,'Product Images','images/noimage.1455908045.jpg','project',1),(194,'Product Images','images/kartu keluarga.1455908045.jpg','project',1),(195,'Product Images','images/Screenshot from 2015-12-03 11:09:19.1455908045.png','project',1),(196,'Product Images','images/gplus.1455908045.png','project',1),(197,'Product Images','images/waterfallModel.1455908045.png','project',1),(198,'Product Images','images/slide1.1455908045.jpg','project',1),(199,'Product Images','images/slide2.1455908045.jpg','project',1),(200,'Product Images','images/slide3.1455908045.jpg','project',1),(201,'Product Images','images/back.1455908045.jpg','project',1),(202,'Product Images','images/child3.1455908045.jpg','project',1),(203,'Product Images','images/facebook-xxl.1455951843.png','product',33),(204,'Product Images','images/Cermati-Logo.1455951843.png','product',33),(205,'Product Images','images/Screenshot from 2015-12-28 11:17:57.1455951843.png','product',33),(206,'Product Images','images/noimage.1455951843.jpg','product',33),(207,'Product Images','images/kartu keluarga.1455951843.jpg','product',33),(208,'Product Images','images/Screenshot from 2015-12-03 11:09:19.1455951843.png','product',33),(209,'Product Images','images/gplus.1455951843.png','product',33),(210,'Product Images','images/waterfallModel.1455951843.png','product',33),(211,'Product Images','images/slide1.1455951843.jpg','product',33),(212,'Product Images','images/slide2.1455951843.jpg','product',33),(213,'Product Images','images/slide3.1455951843.jpg','product',33),(214,'Product Images','images/back.1455951843.jpg','product',33),(215,'Product Images','images/child3.1455951843.jpg','product',33),(216,'Product Images','images/Screenshot from 2015-10-22 02:58:21.1455951843.png','product',33);
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
  `mainCategory` varchar(45) NOT NULL,
  `subCategory` varchar(45) DEFAULT NULL,
  `contentWord` text NOT NULL,
  PRIMARY KEY (`idproduct`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product`
--

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;
INSERT INTO `product` VALUES (1,'Gear Pump Brand 1',14,'Accesories','Pipe','<p>sdasadasdsaas das d</p>\r\n<p>as&nbsp;</p>\r\n<p>das&nbsp;</p>\r\n<p>d</p>\r\n<p>as das das das da s</p>\r\n<p>d as das</p>\r\n<p>das das&nbsp;</p>'),(30,'asdasdasdasd',5,'Main Cat 1','Sub Cat 1','<p>asdasdas d asdas das d a sdas as d4asd 4asd asd asd</p>\r\n<p>&nbsp;as</p>\r\n<p>&nbsp;das d asdas da sdas</p>\r\n<p>d asdasd</p>\r\n<p>as&nbsp;</p>\r\n<p>da ssd&nbsp;</p>\r\n<p>as das d asdass</p>'),(31,'asdasdasdas',5,'Accesories','asdadasdasd','<p>asda as das da d &nbsp;da ds as</p>\r\n<p>&nbsp;da sd as das d asd as da d ad a sd as as d a</p>\r\n<p>s das das d as das d as da sdas &nbsp;ad a sd</p>\r\n<p>a d asd as d ad as da sd as das d ad as da a</p>\r\n<p>d as da sd ad a dasdas dasd asd a sd as da s</p>'),(32,'asdasdsadasdasdasda',14,'asdasdasda','asdadasdasd','<p>Some text to product specification</p>'),(33,'Product 1',5,'Main Cat 1','Pipe','<p>asdasdsadasd as d as da s da s da sd as das da d asd as dasdasd a da</p>');
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
INSERT INTO `profile` VALUES (1,'Ryoku Profile','<p style=\"text-align: justify;\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut porta porttitor magna sed iaculis. Aenean hendrerit viverra nunc, et viverra nunc. Aenean dolor risus, finibus eu tempor nec, congue quis sem. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque quis feugiat mauris, tristique rhoncus massa. Fusce faucibus varius turpis, eget suscipit massa condimentum at. Fusce volutpat risus eu mauris sagittis porta. Mauris vehicula risus eu urna facilisis aliquam. Morbi viverra, nisi a ultricies hendrerit, libero velit fermentum diam, quis accumsan risus ipsum ut felis. Vivamus ac orci ligula. Vestibulum vitae augue luctus, congue enim ut, mattis arcu. Vivamus nisi velit, interdum at pulvinar auctor, elementum vel nisi. Nulla ultrices ac elit ac molestie. Phasellus iaculis lobortis rhoncus. Phasellus sagittis elit nec velit pellentesque, a imperdiet nibh varius.</p>');
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
  `contentWord` text NOT NULL,
  `idclient` int(11) NOT NULL,
  PRIMARY KEY (`idproject`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project`
--

LOCK TABLES `project` WRITE;
/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` VALUES (1,'Pemasangan Pompa Daur Ulang 2','Jakarta','1997-10-16','<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut porta porttitor magna sed iaculis. Aenean hendrerit viverra nunc, et viverra nunc. Aenean dolor risus, finibus eu tempor nec, congue quis sem. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque quis feugiat mauris, tristique rhoncus massa. Fusce faucibus varius turpis, eget suscipit massa condimentum at. Fusce volutpat risus eu mauris sagittis porta. Mauris vehicula risus eu urna facilisis aliquam. Morbi viverra, nisi a ultricies hendrerit, libero velit fermentum diam, quis accumsan risus ipsum ut felis. Vivamus ac orci ligula. Vestibulum vitae augue luctus, congue enim ut, mattis arcu. Vivamus nisi velit, interdum at pulvinar auctor, elementum vel nisi. Nulla ultrices ac elit ac molestie. Phasellus iaculis lobortis rhoncus. Phasellus sagittis elit nec velit pellentesque, a imperdiet nibh varius. sadasdasdasd</p>',1),(2,'Perakitan Pompa Pemadam','Jakarta','2013-07-25','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut porta porttitor magna sed iaculis. Aenean hendrerit viverra nunc, et viverra nunc. Aenean dolor risus, finibus eu tempor nec, congue quis sem. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque quis feugiat mauris, tristique rhoncus massa. Fusce faucibus varius turpis, eget suscipit massa condimentum at. Fusce volutpat risus eu mauris sagittis porta. Mauris vehicula risus eu urna facilisis aliquam. Morbi viverra, nisi a ultricies hendrerit, libero velit fermentum diam, quis accumsan risus ipsum ut felis. Vivamus ac orci ligula. Vestibulum vitae augue luctus, congue enim ut, mattis arcu. Vivamus nisi velit, interdum at pulvinar auctor, elementum vel nisi. Nulla ultrices ac elit ac molestie. Phasellus iaculis lobortis rhoncus. Phasellus sagittis elit nec velit pellentesque, a imperdiet nibh varius.',2),(3,'Penjualan Filter Regulator','Bandung','2016-01-28','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut porta porttitor magna sed iaculis. Aenean hendrerit viverra nunc, et viverra nunc. Aenean dolor risus, finibus eu tempor nec, congue quis sem. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque quis feugiat mauris, tristique rhoncus massa. Fusce faucibus varius turpis, eget suscipit massa condimentum at. Fusce volutpat risus eu mauris sagittis porta. Mauris vehicula risus eu urna facilisis aliquam. Morbi viverra, nisi a ultricies hendrerit, libero velit fermentum diam, quis accumsan risus ipsum ut felis. Vivamus ac orci ligula. Vestibulum vitae augue luctus, congue enim ut, mattis arcu. Vivamus nisi velit, interdum at pulvinar auctor, elementum vel nisi. Nulla ultrices ac elit ac molestie. Phasellus iaculis lobortis rhoncus. Phasellus sagittis elit nec velit pellentesque, a imperdiet nibh varius.',3),(30,'asdasdasdsa','sadsadasdasdasda','2014-04-02','<p>Some text to project description</p>',11),(31,'asdsadas','asdsadasdasd','1995-06-02','<p>Some text to project description</p>',16);
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service`
--

LOCK TABLES `service` WRITE;
/*!40000 ALTER TABLE `service` DISABLE KEYS */;
INSERT INTO `service` VALUES (1,'Pengelasan','Ini yang kami kerjakan.. Melakukan pengelasan bla bla bla bla'),(2,'Bubut','Ini yang kami kerjakan.. Melakukan pengelasan bla bla bla bla'),(3,'Pemasangan Pipa','Ini yang kami kerjakan.. Melakukan pengelasan bla bla bla bla'),(5,'asdasdas','asdasdasdas');
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
INSERT INTO `social` VALUES (1,'<p style=\"text-align: center;\">Contact us through many ways. You can still find us via social networking that we have. Always contact us to see our latest products.</p>',NULL,NULL),(2,NULL,'google+ ','https://plus.google.com/106530056449750098391'),(3,NULL,'blogspot','ryoku-petrojaya-mandiri.blogspot.com'),(4,NULL,'facebook','www.facebook.com/ryokupetrojayamandiri');
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitor`
--

LOCK TABLES `visitor` WRITE;
/*!40000 ALTER TABLE `visitor` DISABLE KEYS */;
INSERT INTO `visitor` VALUES (1,'2016-01-27 00:00:00','Kristian','Heryanto','08992112203','christ.lupher@gmai.com','Test'),(2,'2016-01-27 00:00:00','Inul','Daratista','08992112203','christ.lupher@gmai.com','Test test'),(3,'2016-02-21 00:34:21','sadasd','asdasdasda','08992112203','christ.lupher@gmail.com','asdsadasdasdasdsadasdasdas');
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

-- Dump completed on 2016-02-22 22:18:41
