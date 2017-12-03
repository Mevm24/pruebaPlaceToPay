CREATE DATABASE  IF NOT EXISTS `pruebaplacetopay` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `pruebaplacetopay`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: pruebaplacetopay
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.25-MariaDB

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
-- Table structure for table `bank`
--

DROP TABLE IF EXISTS `bank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bank` (
  `idbank` int(11) NOT NULL,
  `bankCode` varchar(4) NOT NULL,
  `bankName` varchar(60) DEFAULT NULL,
  `entityCode` varchar(12) DEFAULT NULL,
  `serviceCode` varchar(12) DEFAULT NULL,
  `amountValue` double DEFAULT NULL,
  `taxValue` double DEFAULT NULL,
  `description` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`idbank`),
  UNIQUE KEY `bankCode_UNIQUE` (`bankCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bank`
--

LOCK TABLES `bank` WRITE;
/*!40000 ALTER TABLE `bank` DISABLE KEYS */;
/*!40000 ALTER TABLE `bank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `person`
--

DROP TABLE IF EXISTS `person`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `person` (
  `idperson` int(11) NOT NULL AUTO_INCREMENT,
  `document` varchar(12) DEFAULT NULL,
  `documentType` varchar(3) DEFAULT NULL,
  `firstName` varchar(60) DEFAULT NULL,
  `lastName` varchar(60) DEFAULT NULL,
  `company` varchar(60) DEFAULT NULL,
  `emailAddres` varchar(80) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `country` varchar(2) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `mobile` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`idperson`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `person`
--

LOCK TABLES `person` WRITE;
/*!40000 ALTER TABLE `person` DISABLE KEYS */;
INSERT INTO `person` VALUES (1,'123456879','CC','Marco','Moisés',NULL,'marcovillegasmoises@gmail.com','Calle 23 # 16-75 Alcázares',NULL,NULL,NULL,NULL,'3005969815'),(2,'123456','NIT','Empresa','Empresa','Company1','company@mail.com','Cale 123 # 12-34',NULL,NULL,NULL,NULL,NULL),(3,'84759-5','NIT',NULL,NULL,NULL,NULL,'Calle 12 # 12-12',NULL,NULL,NULL,NULL,'87459'),(4,'847582059-5','NIT',NULL,NULL,'Empresa1','email@mail.com','Calle 12 # 12-12',NULL,NULL,NULL,NULL,'87459');
/*!40000 ALTER TABLE `person` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactionresult`
--

DROP TABLE IF EXISTS `transactionresult`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactionresult` (
  `transactionID` int(11) NOT NULL,
  `sessionID` varchar(32) DEFAULT NULL,
  `returnCode` varchar(30) DEFAULT NULL,
  `trazabilityCode` varchar(40) DEFAULT NULL,
  `transactionCycle` int(11) DEFAULT NULL,
  `bankCurrency` varchar(3) DEFAULT NULL,
  `bankFactor` float DEFAULT NULL,
  `bankURL` varchar(255) DEFAULT NULL,
  `responseCode` int(11) DEFAULT NULL,
  `responseReasonCode` varchar(3) DEFAULT NULL,
  `responseReasonText` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`transactionID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactionresult`
--

LOCK TABLES `transactionresult` WRITE;
/*!40000 ALTER TABLE `transactionresult` DISABLE KEYS */;
INSERT INTO `transactionresult` VALUES (1452840854,'943f9ead64dd6c560d0f072229c940ec','FAIL_NOHOST','000000',-1,'COP',1,'',0,'XH','No se pudo crear la transacción, por favor intente más tarde o comuníquese con la empresa.'),(1452840864,'8d2b0d21973dae1676207c4f95c7abab','SUCCESS','1367493',1,'COP',1,'https://registro.desarrollo.pse.com.co/PSEUserRegister/StartTransaction.htm?enc=tnPcJHMKlSnmRpHM8fAbu1642Y1XzSH19HLEVZn%2b4axevHlZxuGTgQ%2bg9VMn1Auj',3,'?-','Transacción pendiente. Por favor verificar si el débito fue realizado en el Banco.'),(1452846088,'29475ed6028a8c605e960d6cb4f2c077','SUCCESS','1367555',5,'COP',1,'https://registro.desarrollo.pse.com.co/PSEUserRegister/StartTransaction.htm?enc=tnPcJHMKlSnmRpHM8fAbu%2fJdAZ36Bh5EMNC0hTVUGvN7AuLr7uAvR7rSuFd418IT',3,'?-','Transacción pendiente. Por favor verificar si el débito fue realizado en el Banco.'),(1452846345,'1f45e7f97ab4bffdc70f64ffe25b4b1d','SUCCESS','1367559',6,'COP',1,'https://registro.desarrollo.pse.com.co/PSEUserRegister/StartTransaction.htm?enc=tnPcJHMKlSnmRpHM8fAbu%2fJdAZ36Bh5EMNC0hTVUGvNOGCBFw0msclhWTrcHiiaK',3,'?-','Transacción pendiente. Por favor verificar si el débito fue realizado en el Banco.'),(1452846477,'bd75bfca5d5ec964cdb38a267d7143e1','SUCCESS','1367560',1,'COP',1,'https://registro.desarrollo.pse.com.co/PSEUserRegister/StartTransaction.htm?enc=tnPcJHMKlSnmRpHM8fAbu%2fJdAZ36Bh5EMNC0hTVUGvOtvlV1epR%2fioznlYTik8ja',3,'?-','Transacción pendiente. Por favor verificar si el débito fue realizado en el Banco.'),(1452846542,'7dd9355d402e3c114cebfb8c71cbd304','SUCCESS','1367561',1,'COP',1,'https://registro.desarrollo.pse.com.co/PSEUserRegister/StartTransaction.htm?enc=tnPcJHMKlSnmRpHM8fAbu%2fJdAZ36Bh5EMNC0hTVUGvO%2b1FPKnd6ccjdGmukusNT%2b',3,'?-','Transacción pendiente. Por favor verificar si el débito fue realizado en el Banco.'),(1452846547,'78d5cc30b32baa6f56666778c38c26e2','SUCCESS','1367562',1,'COP',1,'https://registro.desarrollo.pse.com.co/PSEUserRegister/StartTransaction.htm?enc=tnPcJHMKlSnmRpHM8fAbu%2fJdAZ36Bh5EMNC0hTVUGvNqU7gx7bSTtZ%2bEViIgqtNb',3,'?-','Transacción pendiente. Por favor verificar si el débito fue realizado en el Banco.'),(1452846566,'11f2fb1f60b73a624833cad964d0b4a9','SUCCESS','1367564',1,'COP',1,'https://registro.desarrollo.pse.com.co/PSEUserRegister/StartTransaction.htm?enc=tnPcJHMKlSnmRpHM8fAbu%2fJdAZ36Bh5EMNC0hTVUGvOAMKFVI49lijpcPuglXS12',3,'?-','Transacción pendiente. Por favor verificar si el débito fue realizado en el Banco.'),(1452846581,'4c496ecb706dea66ca2951ad6ef9741a','SUCCESS','1367565',1,'COP',1,'https://registro.desarrollo.pse.com.co/PSEUserRegister/StartTransaction.htm?enc=tnPcJHMKlSnmRpHM8fAbu%2fJdAZ36Bh5EMNC0hTVUGvNVc37R410J0h22dq3x4mDW',3,'?-','Transacción pendiente. Por favor verificar si el débito fue realizado en el Banco.'),(1452850179,'34620623368247dbcc57056f56024cf1','SUCCESS','1367580',1,'COP',1,'https://registro.desarrollo.pse.com.co/PSEUserRegister/StartTransaction.htm?enc=V%2brHQIwzrDzFvDKfmDEJ7lJJ7A7vnPIzyI3ELS9zpJHzetHPhKOAfty5FujDicKX',3,'?-','Transacción pendiente. Por favor verificar si el débito fue realizado en el Banco.'),(1452850430,'97072cd3fd69f5ef6161bd275ae5a5a1','SUCCESS','1367581',1,'COP',1,'https://registro.desarrollo.pse.com.co/PSEUserRegister/StartTransaction.htm?enc=tnPcJHMKlSnmRpHM8fAbu%2fJdAZ36Bh5EMNC0hTVUGvNehTJBZeyVaZatG5TsGoip',3,'?-','Transacción pendiente. Por favor verificar si el débito fue realizado en el Banco.'),(1452851032,'31ee11ecb5548e140a0192011f10338e','SUCCESS','1367582',1,'COP',1,'https://registro.desarrollo.pse.com.co/PSEUserRegister/StartTransaction.htm?enc=tnPcJHMKlSnmRpHM8fAbu%2fJdAZ36Bh5EMNC0hTVUGvObqXQqgCRrf83LUMjXbCKy',3,'?-','Transacción pendiente. Por favor verificar si el débito fue realizado en el Banco.'),(1452851197,'79f0a87bbe9f1ce56178cff07eb052e9','SUCCESS','1367583',1,'COP',1,'https://registro.desarrollo.pse.com.co/PSEUserRegister/StartTransaction.htm?enc=tnPcJHMKlSnmRpHM8fAbu%2fJdAZ36Bh5EMNC0hTVUGvPfyn45cTK4xYugNG1WHXjL',3,'?-','Transacción pendiente. Por favor verificar si el débito fue realizado en el Banco.'),(1452851299,'2a8f720fbadbdcce605b488b122d47f7','SUCCESS','1367584',1,'COP',1,'https://registro.desarrollo.pse.com.co/PSEUserRegister/StartTransaction.htm?enc=tnPcJHMKlSnmRpHM8fAbu%2fJdAZ36Bh5EMNC0hTVUGvO88PN32BhvhojPLUs3gxq1',3,'?-','Transacción pendiente. Por favor verificar si el débito fue realizado en el Banco.');
/*!40000 ALTER TABLE `transactionresult` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-03 13:26:25
