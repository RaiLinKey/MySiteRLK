-- MySQL dump 10.13  Distrib 8.0.18, for Win64 (x86_64)
--
-- Host: localhost    Database: site_db
-- ------------------------------------------------------
-- Server version	8.0.18

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
-- Table structure for table `work_cards`
--

DROP TABLE IF EXISTS `work_cards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `work_cards` (
  `id_work_cards` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `img_url` varchar(255) NOT NULL,
  `href_url` varchar(255) NOT NULL,
  `id_of_cat` int(11) NOT NULL,
  PRIMARY KEY (`id_work_cards`),
  KEY `fk_work_cards_cat_idx` (`id_of_cat`),
  CONSTRAINT `fk_work_cards_cat` FOREIGN KEY (`id_of_cat`) REFERENCES `cat` (`id_cat`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `work_cards`
--

LOCK TABLES `work_cards` WRITE;
/*!40000 ALTER TABLE `work_cards` DISABLE KEYS */;
INSERT INTO `work_cards` VALUES (1,'Плелист — главная','img/png/playlist1.png','work-cards/lessons/playlist/index.htm',1),(2,'Плелист — песня 1','img/png/playlist2.png','work-cards/lessons/playlist/music1/music1.htm',1),(3,'Плелист — песня 2','img/png/playlist3.png','work-cards/lessons/playlist/music2/music2.htm',1),(4,'HTML-версия','img/png/rainbow1.png','work-cards/homeworks/rainbow/html_version.htm',2),(5,'CSS-версия','img/png/rainbow2.png','work-cards/homeworks/rainbow/css_version.htm',2),(6,'Современная вёрстка','img/png/practic.png','work-cards/homeworks/myself-work/verstka/div-verst-v2.htm',3);
/*!40000 ALTER TABLE `work_cards` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-05-29 12:52:47
