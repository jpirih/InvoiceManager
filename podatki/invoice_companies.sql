-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: localhost    Database: invoice
-- ------------------------------------------------------
-- Server version	5.5.5-10.0.24-MariaDB-7

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
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `postal_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(155) COLLATE utf8_unicode_ci NOT NULL,
  `url` text COLLATE utf8_unicode_ci NOT NULL,
  `company_logo` text COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,'Pričaraj.si','Disk informatika, Marko šubic s.p.','Selo 41a','4226','Žiri','https://www.pricaraj.si/','https://www.pricaraj.si/media/neoshop/default/logo_1.png','Slovenija','2016-04-30 06:43:18','2016-05-01 06:15:20'),(2,'Enaa.com','GAMBIT TRADE d.o.o.','Savska cesta 3a','1000','Ljubljana','http://www.enaa.com/','http://static.enaa.com/images/enaA_logo_02.png','Slovenija','2016-04-30 09:46:32','2016-04-30 09:46:32'),(3,'Bob','Si.mobil.d.d.','Šmartinska cesta 134b','1000','Ljubljana','http://www.bob.si/','http://vignette2.wikia.nocookie.net/paygsimwithdata/images/5/5d/Bob_logo.jpg/revision/latest?cb=20101001191244','Slovenija','2016-04-30 09:50:51','2016-04-30 09:50:51'),(4,'ZZZS - obv. zdravstveno zavarovanje','ZZZS OE Ljubljana','Miklošičeva cesta 24','1507','Ljubljana','http://www.zzzs.si/','http://mi.audax.si/uploads/gallery_pictures_big/Logo_zzzs.png','Slovenija','2016-04-30 09:55:30','2016-04-30 09:55:30'),(5,'POLANS','POLANS, telekomunikacijske storitve d.o.o.','Hotovlja 78a','4223','Poljane nad Škofjo Loko','http://www.polans.si/','http://www.polans.si/templates/siteground-j15-59/images/header_bg_moder2_doo.jpg','Slovenija','2016-04-30 09:59:45','2016-04-30 09:59:45');
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-05-07  8:24:23
