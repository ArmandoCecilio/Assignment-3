-- MySQL dump 10.13  Distrib 8.0.32, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: mydb
-- ------------------------------------------------------
-- Server version	8.0.32

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
-- Table structure for table `clientprofile`
--

DROP TABLE IF EXISTS `clientprofile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clientprofile` (
  `member_ID` mediumint NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `address_1` varchar(100) NOT NULL,
  `address_2` varchar(100) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zipcode` varchar(9) NOT NULL,
  PRIMARY KEY (`member_ID`),
  KEY `member_ID` (`member_ID`),
  CONSTRAINT `clientprofile_ibfk_1` FOREIGN KEY (`member_ID`) REFERENCES `member` (`member_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientprofile`
--

LOCK TABLES `clientprofile` WRITE;
/*!40000 ALTER TABLE `clientprofile` DISABLE KEYS */;
INSERT INTO `clientprofile` VALUES (118,'Armando Cecilio','23','','7','ME','2aaaaaa'),(119,'test','Cecilio','test','Houston','TN','77061'),(120,'test6','test 6','123 mainstreet','Houston','TX','123456788'),(121,'Armando Cecilio','123 456 Main St, Houston','none','Houston','TX','770611111'),(122,'Team 35','Houston, TX 123 main st','','Houston','TX','777777777');
/*!40000 ALTER TABLE `clientprofile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fuelquoteform`
--

DROP TABLE IF EXISTS `fuelquoteform`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `fuelquoteform` (
  `quote_id` int NOT NULL AUTO_INCREMENT,
  `member_ID` mediumint NOT NULL,
  `gallons_requested` decimal(10,2) NOT NULL,
  `delivery_date` date NOT NULL,
  `suggested_price` decimal(10,2) NOT NULL,
  `total_amount_due` decimal(10,2) NOT NULL,
  PRIMARY KEY (`quote_id`,`member_ID`),
  KEY `fuelquoteform_ibfk_1_idx` (`member_ID`),
  CONSTRAINT `fk_member_id` FOREIGN KEY (`member_ID`) REFERENCES `member` (`member_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fuelquoteform`
--

LOCK TABLES `fuelquoteform` WRITE;
/*!40000 ALTER TABLE `fuelquoteform` DISABLE KEYS */;
INSERT INTO `fuelquoteform` VALUES (3,119,10.00,'2010-10-10',0.00,0.00),(4,119,20.00,'2020-03-02',30.00,600.00),(5,119,10.00,'2020-02-02',10.00,100.00),(6,119,10.00,'2010-10-10',10.00,100.00),(7,119,10.00,'2010-10-10',10.00,100.00),(8,119,10.00,'2020-10-10',20.00,200.00),(9,120,1000.00,'2020-10-10',10.00,10000.00),(10,121,10.00,'2010-10-10',100.00,1000.00),(11,120,10.00,'2000-10-10',10.00,100.00),(12,119,10.00,'2010-10-10',1.00,11.70),(13,119,1500.00,'2000-10-10',1.00,1740.00),(14,119,1500.00,'2010-10-10',1.00,1740.00),(15,119,1500.00,'2010-10-10',10.00,17400.00),(16,119,1000.00,'2010-10-10',0.00,0.00),(17,119,1500.00,'2010-10-10',0.00,0.00),(18,122,10.00,'2010-10-10',10.00,100.00);
/*!40000 ALTER TABLE `fuelquoteform` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `member`
--

DROP TABLE IF EXISTS `member`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `member` (
  `member_ID` mediumint NOT NULL AUTO_INCREMENT,
  `password` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`member_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `member`
--

LOCK TABLES `member` WRITE;
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` VALUES (118,'$2y$10$c5ThnJwQrgQQ8BDd6zqDRe6E2hnkW3pRZpIO/wnkJv1vHN3iNRbjy','test1'),(119,'$2y$10$pKHuGcDvRra8ZFjCepXN6ObTrth.GePaQc5E2JJCF/Wugrmo72EiG','test2'),(120,'$2y$10$lWDe4.vrTaXH1R1.0qRSmOgXawpxpj5qA/zDUWZWGdbNaQra4wwTK','test6'),(121,'$2y$10$eAeGNnKsNwIFqUzVmeVW4O6wvc2T3rF2VBE35hKxZ8.3hEB.6nt6.','test7'),(122,'$2y$10$QWTuzA1NLPl4iPTVsyLLx.mBsVrwcMv8RtlmI/lUwwhOa/Rqe9NHa','team35');
/*!40000 ALTER TABLE `member` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `visitor`
--

DROP TABLE IF EXISTS `visitor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `visitor` (
  `visitor_ID` int NOT NULL,
  `first_name` varchar(45) NOT NULL,
  `middle_initial` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `phone_number` varchar(45) NOT NULL,
  `email_address` varchar(45) NOT NULL,
  `parking_purchased` tinyint NOT NULL,
  `PARK_Park_ID` int NOT NULL,
  PRIMARY KEY (`visitor_ID`),
  KEY `fk_VISITOR_PARK1_idx` (`PARK_Park_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `visitor`
--

LOCK TABLES `visitor` WRITE;
/*!40000 ALTER TABLE `visitor` DISABLE KEYS */;
/*!40000 ALTER TABLE `visitor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'mydb'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-04-27 21:16:03
