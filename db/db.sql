-- MySQL dump 10.13  Distrib 8.0.25, for Linux (x86_64)
--
-- Host: localhost    Database: speed_courier
-- ------------------------------------------------------
-- Server version	5.6.16-1~exp1

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
-- Table structure for table `branches`
--

DROP TABLE IF EXISTS `branches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `branches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branches`
--

LOCK TABLES `branches` WRITE;
/*!40000 ALTER TABLE `branches` DISABLE KEYS */;
INSERT INTO `branches` VALUES (1,'Mzuzu'),(2,'Karonga'),(3,'Karonga'),(4,'Chitipa');
/*!40000 ALTER TABLE `branches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login`
--

DROP TABLE IF EXISTS `login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `login` (
  `loginID` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `role` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`loginID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login`
--

LOCK TABLES `login` WRITE;
/*!40000 ALTER TABLE `login` DISABLE KEYS */;
INSERT INTO `login` VALUES (1,'petros','1234','Admin'),(2,'lisa','1234','Customer'),(3,'chibaka','1234','Admin'),(4,'petros78','1234','Admin'),(5,'petros787','1234','Admin'),(6,'petros7879','1234','Admin'),(7,'petryyos7879','1234','Admin'),(8,'petryyos78793','1234','Admin'),(9,'oopre','1234','Admin');
/*!40000 ALTER TABLE `login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `notification` (
  `notificationID` int(11) NOT NULL AUTO_INCREMENT,
  `PackageStatus` varchar(45) DEFAULT NULL,
  `message` varchar(45) DEFAULT NULL,
  `parcelID` varchar(45) DEFAULT NULL,
  `location` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`notificationID`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
INSERT INTO `notification` VALUES (40,'Lilongwe',NULL,'38','Blantyre'),(41,'',NULL,'38','Mangochi'),(42,'',NULL,'38','Blantyre'),(43,'',NULL,'38','Lilongwe'),(44,'',NULL,'38','Salima'),(45,'Salima',NULL,'40','Nkhotakota'),(46,'',NULL,'38','Nkhotakota'),(47,'',NULL,'38','Kasungu'),(48,'',NULL,'38','Kasungu'),(49,'',NULL,'38','Kasungu'),(50,'',NULL,'38','In Transit'),(51,'',NULL,'38','Delivered'),(52,'',NULL,'38','Karonga'),(53,'',NULL,'38','In Transit'),(54,'',NULL,'38','Mzuzu'),(55,'',NULL,'38','Delivered');
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parcel`
--

DROP TABLE IF EXISTS `parcel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `parcel` (
  `parcelID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  `fee` varchar(45) DEFAULT NULL,
  `quantity` varchar(45) DEFAULT NULL,
  `destination` varchar(45) DEFAULT NULL,
  `referenceNumber` varchar(45) DEFAULT NULL,
  `weight` varchar(45) DEFAULT NULL,
  `receiver_phone` varchar(45) DEFAULT NULL,
  `amount` int(50) DEFAULT NULL,
  PRIMARY KEY (`parcelID`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parcel`
--

LOCK TABLES `parcel` WRITE;
/*!40000 ALTER TABLE `parcel` DISABLE KEYS */;
INSERT INTO `parcel` VALUES (38,'Bag','Red bag',NULL,NULL,'3','From Lilongwe To Blantyre','9oJwYydy1c','10','099942342',15600),(39,'','',NULL,NULL,'','','','','',0),(40,'somba','THE MANI S D',NULL,NULL,'34','From Salima To Nkhotakota','v8oVWCa3SM','4','0999324234',68600),(41,'','',NULL,NULL,'','','','','',0),(42,'','',NULL,NULL,'','','','','',0);
/*!40000 ALTER TABLE `parcel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment` (
  `paymentID` int(11) NOT NULL AUTO_INCREMENT,
  `referenceNumber` varchar(45) DEFAULT NULL,
  `date` varchar(45) DEFAULT NULL,
  `userID` varchar(45) DEFAULT NULL,
  `paymentMethod` varchar(45) DEFAULT NULL,
  `paymentAt` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`paymentID`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (13,'9oJwYydy1c','05/08/2022 09:52:10 am','null','Cash Payment','Drop Off','Cleared'),(14,'v8oVWCa3SM','05/14/2022 01:16:06 pm','null','Cash Payment','Drop Off','Cleared'),(15,'v8oVWCa3SM','05/14/2022 01:16:09 pm','null','Cash Payment','Drop Off','Cleared');
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prices`
--

DROP TABLE IF EXISTS `prices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `amount` varchar(45) DEFAULT NULL,
  `title` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prices`
--

LOCK TABLES `prices` WRITE;
/*!40000 ALTER TABLE `prices` DISABLE KEYS */;
INSERT INTO `prices` VALUES (1,'Per KG Cost','500','Set per KG price'),(2,'Between Districts	','300','Set Between Districts price'),(3,'Within District	','200','Set Within District price');
/*!40000 ALTER TABLE `prices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(45) DEFAULT NULL,
  `LastName` varchar(45) DEFAULT NULL,
  `Email` varchar(45) DEFAULT NULL,
  `Address` varchar(45) DEFAULT NULL,
  `Contact` varchar(45) DEFAULT NULL,
  `loginID` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'petros','kayange','kayangepetros@gmail.com','po box 171','09998008857','1'),(2,'lisa','phaso','phaso@gmail.com','pobbe 782','098884541','2'),(3,'chibaka','hannn','chibaka@gmail.com','mzuzu','09945343','3'),(4,'chibaka','hannn56','hanna@gmail.com','mbb','09878756','4'),(5,'chibaka','hannn56','hanna6@gmail.com','mbb','09878756','5'),(6,'chibaka','hannn56','hanna68@gmail.com','mbb','09878756','6'),(7,'chibaka','hannn56','hanhhna68@gmail.com','mbb','09878756','7'),(8,'chibaka','hannn56','hanhthna68@gmail.com','mbb','09878756','8'),(9,'tyrg','dfgdf','hartenna@gmail.com','mbb','099995464','9');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-17 22:08:12
