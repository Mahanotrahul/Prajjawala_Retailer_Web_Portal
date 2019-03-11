-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: lpg_sco_admin
-- ------------------------------------------------------
-- Server version	5.7.21-log

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
-- Table structure for table `consumer`
--

DROP TABLE IF EXISTS `consumer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consumer` (
  `CONSUMER_ID` int(20) NOT NULL AUTO_INCREMENT,
  `NAME_OF_CONSUMER` varchar(50) DEFAULT NULL,
  `DATE_OF_BIRTH` date DEFAULT NULL,
  `PHONE_NUMBER` bigint(20) DEFAULT NULL,
  `AADHAR_NUMBER` bigint(20) DEFAULT NULL,
  `CITY` varchar(20) DEFAULT NULL,
  `STATE` varchar(20) DEFAULT NULL,
  `COMPLETE_ADDRESS` varchar(120) DEFAULT NULL,
  `RETAILER_ID` int(10) DEFAULT NULL,
  `PIN` int(6) DEFAULT NULL,
  UNIQUE KEY `CONSUMER_ID_UNIQUE` (`CONSUMER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consumer`
--

LOCK TABLES `consumer` WRITE;
/*!40000 ALTER TABLE `consumer` DISABLE KEYS */;
/*!40000 ALTER TABLE `consumer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consumer_complains`
--

DROP TABLE IF EXISTS `consumer_complains`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consumer_complains` (
  `CONSUMER_ID_` int(20) NOT NULL AUTO_INCREMENT,
  `DATE_REGISTERED` date DEFAULT NULL,
  `TYPE_OF_COMPLAIN` varchar(50) DEFAULT NULL,
  `COMPLAINT` varchar(250) DEFAULT NULL,
  UNIQUE KEY `CONSUMER_ID__UNIQUE` (`CONSUMER_ID_`),
  KEY `consumer_id_idx` (`CONSUMER_ID_`),
  KEY `constomer_id_idx` (`CONSUMER_ID_`),
  CONSTRAINT `CONSUMER_ID` FOREIGN KEY (`CONSUMER_ID_`) REFERENCES `consumer` (`CONSUMER_ID`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consumer_complains`
--

LOCK TABLES `consumer_complains` WRITE;
/*!40000 ALTER TABLE `consumer_complains` DISABLE KEYS */;
/*!40000 ALTER TABLE `consumer_complains` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `consumer_gas_usage`
--

DROP TABLE IF EXISTS `consumer_gas_usage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `consumer_gas_usage` (
  `CONSUMER_ID` int(20) DEFAULT NULL,
  `LAST_RECHARGE_DATE` date DEFAULT NULL,
  `LAST_RECHARGE_AMOUNT` int(50) DEFAULT NULL,
  `LAST_RECHARGE_GAS_EQUIVALENT` decimal(4,2) DEFAULT NULL,
  `CURRENT_LPG_LEFT` decimal(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `consumer_gas_usage`
--

LOCK TABLES `consumer_gas_usage` WRITE;
/*!40000 ALTER TABLE `consumer_gas_usage` DISABLE KEYS */;
/*!40000 ALTER TABLE `consumer_gas_usage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lpg_sco_01_seq`
--

DROP TABLE IF EXISTS `lpg_sco_01_seq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lpg_sco_01_seq` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `current_value` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2000000000003 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lpg_sco_01_seq`
--

LOCK TABLES `lpg_sco_01_seq` WRITE;
/*!40000 ALTER TABLE `lpg_sco_01_seq` DISABLE KEYS */;
INSERT INTO `lpg_sco_01_seq` VALUES (2000000000000,'2'),(2000000000001,'23'),(2000000000002,'25');
/*!40000 ALTER TABLE `lpg_sco_01_seq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recharge_plan`
--

DROP TABLE IF EXISTS `recharge_plan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recharge_plan` (
  `OFFER_ID` int(20) DEFAULT NULL,
  `OFFER_AMOUNT` decimal(5,2) DEFAULT NULL,
  `OFFER_DESCRIPTION` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recharge_plan`
--

LOCK TABLES `recharge_plan` WRITE;
/*!40000 ALTER TABLE `recharge_plan` DISABLE KEYS */;
/*!40000 ALTER TABLE `recharge_plan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `recharge_plans`
--

DROP TABLE IF EXISTS `recharge_plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `recharge_plans` (
  `OFFER_ID` int(20) DEFAULT NULL,
  `OFFER_AMOUNT` decimal(5,2) DEFAULT NULL,
  `OFFER_DESCRIPTION` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `recharge_plans`
--

LOCK TABLES `recharge_plans` WRITE;
/*!40000 ALTER TABLE `recharge_plans` DISABLE KEYS */;
/*!40000 ALTER TABLE `recharge_plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `retailer`
--

DROP TABLE IF EXISTS `retailer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `retailer` (
  `RETAILER_ID` varchar(10) NOT NULL,
  `NAME` varchar(50) DEFAULT NULL,
  `DATE_OF_BIRTH` date DEFAULT NULL,
  `PHONE_NUMBER` bigint(20) DEFAULT NULL,
  `AADHAAR_NUMBER` bigint(20) DEFAULT NULL,
  `CITY` varchar(20) DEFAULT NULL,
  `STATE` varchar(20) DEFAULT NULL,
  `SHOP_ADDRESS` varchar(120) DEFAULT NULL,
  `LISCENCE_NUMBER` varchar(15) DEFAULT NULL,
  `LOGIN_USERNAME` varchar(25) DEFAULT NULL,
  `LOGIN_PASSWORD` varchar(25) DEFAULT NULL,
  `NUMBER_OF_CONSUMERS` int(12) DEFAULT NULL,
  PRIMARY KEY (`RETAILER_ID`),
  UNIQUE KEY `RETAILER_ID_UNIQUE` (`RETAILER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `retailer`
--

LOCK TABLES `retailer` WRITE;
/*!40000 ALTER TABLE `retailer` DISABLE KEYS */;
/*!40000 ALTER TABLE `retailer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `retailer_information`
--

DROP TABLE IF EXISTS `retailer_information`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `retailer_information` (
  `RETAILER_ID` int(20) DEFAULT NULL,
  `NAME` varchar(50) DEFAULT NULL,
  `DATE_OF_BIRTH` date DEFAULT NULL,
  `PHONE_NUMBER` bigint(20) DEFAULT NULL,
  `AADHAAR_NUMBER` bigint(20) DEFAULT NULL,
  `CITY` varchar(20) DEFAULT NULL,
  `STATE` varchar(20) DEFAULT NULL,
  `SHOP_ADDRESS` varchar(120) DEFAULT NULL,
  `LISCENCE_NUMBER` varchar(15) DEFAULT NULL,
  `LOGIN_USERNAME` varchar(25) DEFAULT NULL,
  `LOGIN_PASSWORD` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `retailer_information`
--

LOCK TABLES `retailer_information` WRITE;
/*!40000 ALTER TABLE `retailer_information` DISABLE KEYS */;
/*!40000 ALTER TABLE `retailer_information` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'lpg_sco_admin'
--

--
-- Dumping routines for database 'lpg_sco_admin'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-30 18:56:29
