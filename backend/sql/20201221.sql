CREATE DATABASE  IF NOT EXISTS `seminarska_naloga_ep2020` /*!40100 DEFAULT CHARACTER SET utf16 COLLATE utf16_slovenian_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `seminarska_naloga_ep2020`;
-- MySQL dump 10.13  Distrib 8.0.22, for Linux (x86_64)
--
-- Host: localhost    Database: seminarska_naloga_ep2020
-- ------------------------------------------------------
-- Server version	8.0.22-0ubuntu0.20.04.3

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
-- Table structure for table `IZBRANI_ARTIKLI`
--

DROP TABLE IF EXISTS `IZBRANI_ARTIKLI`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `IZBRANI_ARTIKLI` (
  `ID_ARTIKEL` int NOT NULL,
  `IDNAKUPA` int NOT NULL,
  `KOLICINA` int DEFAULT NULL,
  PRIMARY KEY (`ID_ARTIKEL`,`IDNAKUPA`),
  KEY `FK_IZBRANI_ARTIKLI2` (`IDNAKUPA`),
  CONSTRAINT `FK_IZBRANI_ARTIKLI` FOREIGN KEY (`ID_ARTIKEL`) REFERENCES `PONUDBA` (`ID_ARTIKEL`),
  CONSTRAINT `FK_IZBRANI_ARTIKLI2` FOREIGN KEY (`IDNAKUPA`) REFERENCES `NAKUP` (`IDNAKUPA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `IZBRANI_ARTIKLI`
--

LOCK TABLES `IZBRANI_ARTIKLI` WRITE;
/*!40000 ALTER TABLE `IZBRANI_ARTIKLI` DISABLE KEYS */;
/*!40000 ALTER TABLE `IZBRANI_ARTIKLI` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `KATEGORIJE`
--

DROP TABLE IF EXISTS `KATEGORIJE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `KATEGORIJE` (
  `ID_KATEGORIJE` int unsigned NOT NULL AUTO_INCREMENT,
  `NAZIV_KATEGORIJE` varchar(50) COLLATE utf16_slovenian_ci DEFAULT NULL,
  PRIMARY KEY (`ID_KATEGORIJE`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf16 COLLATE=utf16_slovenian_ci COMMENT='Kategorije ponudbe';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `KATEGORIJE`
--

LOCK TABLES `KATEGORIJE` WRITE;
/*!40000 ALTER TABLE `KATEGORIJE` DISABLE KEYS */;
INSERT INTO `KATEGORIJE` VALUES (1,'Burgerji'),(2,'Pijača'),(3,'Priloge'),(4,'Steak'),(5,'Vedno paše');
/*!40000 ALTER TABLE `KATEGORIJE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `KRAJ`
--

DROP TABLE IF EXISTS `KRAJ`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `KRAJ` (
  `POSTNA_STEVILKA` int NOT NULL,
  `KRAJ` varchar(50) COLLATE utf16_slovenian_ci NOT NULL,
  PRIMARY KEY (`POSTNA_STEVILKA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `KRAJ`
--

LOCK TABLES `KRAJ` WRITE;
/*!40000 ALTER TABLE `KRAJ` DISABLE KEYS */;
INSERT INTO `KRAJ` VALUES (1000,'Ljubljana'),(1234,'ewqeq'),(1312,'Videm-Dobrepolje'),(2132,'ewew'),(2134,'rere'),(2142,'dsad'),(2323,'rer'),(3214,'dsad'),(4322,'DSAD'),(4324,'dsadsa'),(8000,'Novo Mesto'),(12314,'dsad');
/*!40000 ALTER TABLE `KRAJ` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `NAKUP`
--

DROP TABLE IF EXISTS `NAKUP`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `NAKUP` (
  `IDNAKUPA` int NOT NULL AUTO_INCREMENT,
  `ID_STATUS` int NOT NULL,
  `ID_STRANKA` int NOT NULL,
  `SKUPNA_CENA` int NOT NULL,
  `DATUMCAS_NAROCILA` datetime NOT NULL,
  `DATUMCAS_POTRDILA` datetime NOT NULL,
  PRIMARY KEY (`IDNAKUPA`),
  KEY `FK_IMA` (`ID_STATUS`),
  KEY `FK_IZVEDE` (`ID_STRANKA`),
  CONSTRAINT `FK_IMA` FOREIGN KEY (`ID_STATUS`) REFERENCES `STATUSNAKUPA` (`ID_STATUS`),
  CONSTRAINT `FK_IZVEDE` FOREIGN KEY (`ID_STRANKA`) REFERENCES `STRANKA` (`ID_STRANKA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `NAKUP`
--

LOCK TABLES `NAKUP` WRITE;
/*!40000 ALTER TABLE `NAKUP` DISABLE KEYS */;
/*!40000 ALTER TABLE `NAKUP` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `NASLOV`
--

DROP TABLE IF EXISTS `NASLOV`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `NASLOV` (
  `ID_NASLOV` int NOT NULL AUTO_INCREMENT,
  `POSTNA_STEVILKA` int NOT NULL,
  `ULICA` varchar(50) COLLATE utf16_slovenian_ci NOT NULL,
  `HISNA_STEVILKA` varchar(5) COLLATE utf16_slovenian_ci NOT NULL,
  PRIMARY KEY (`ID_NASLOV`),
  KEY `FK_LEZI_V` (`POSTNA_STEVILKA`),
  CONSTRAINT `FK_LEZI_V` FOREIGN KEY (`POSTNA_STEVILKA`) REFERENCES `KRAJ` (`POSTNA_STEVILKA`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf16 COLLATE=utf16_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `NASLOV`
--

LOCK TABLES `NASLOV` WRITE;
/*!40000 ALTER TABLE `NASLOV` DISABLE KEYS */;
INSERT INTO `NASLOV` VALUES (1,1000,'Predstruge','21a'),(2,1000,'Ponikve','21a'),(3,1000,'Ulica sv Petra','12'),(4,8000,'Gotna vas','51'),(5,8000,'Jurna vas','51');
/*!40000 ALTER TABLE `NASLOV` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PONUDBA`
--

DROP TABLE IF EXISTS `PONUDBA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `PONUDBA` (
  `ID_ARTIKEL` int NOT NULL AUTO_INCREMENT,
  `PATH_TO_IMG` varchar(75) COLLATE utf16_slovenian_ci NOT NULL DEFAULT '0',
  `CENA` float NOT NULL DEFAULT '0',
  `OPIS` text COLLATE utf16_slovenian_ci NOT NULL,
  `KATEGORIJA` int unsigned NOT NULL,
  `NAZIV_ARTIKEL` varchar(60) COLLATE utf16_slovenian_ci NOT NULL,
  PRIMARY KEY (`ID_ARTIKEL`),
  KEY `FK_ponudba_kategorije` (`KATEGORIJA`),
  CONSTRAINT `FK_ponudba_kategorije` FOREIGN KEY (`KATEGORIJA`) REFERENCES `KATEGORIJE` (`ID_KATEGORIJE`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf16 COLLATE=utf16_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PONUDBA`
--

LOCK TABLES `PONUDBA` WRITE;
/*!40000 ALTER TABLE `PONUDBA` DISABLE KEYS */;
INSERT INTO `PONUDBA` VALUES (1,'frontend\\static\\images\\ponudba\\domaci-burger.jpg',5.99,' Krompirjeva bombica popečena na maslu, 100% govedina slovenskega porekla, naša classic hišna omaka, sveža domača solata, rezine sladkega paradižnika in Cheddar sir.',1,'Burger domači'),(2,'frontend\\static\\images\\ponudba\\pommes.jpg',3.99,'Vsak dan sveže olupljen in narezan slovenski krompirček. Ocvrt v 100% arašidovem olju. Prava družba za tvoj najljubši burger.',3,'Pomfri krompirček'),(3,'frontend\\static\\images\\ponudba\\buffalo-wings.jpg',6.99,'Ljubitelji piščančjih perutničk poznajo užitek hrustljave začinjene kože, ki je bistvo te jedi.',5,'Buffalo perutničke'),(4,'frontend\\static\\images\\ponudba\\hotdog.png',4.99,'Juicy..tasty...with a good smell and lovely caramelized onion..?',1,'the Hot Dog'),(5,'frontend\\static\\images\\ponudba\\lemon-juice.png',2.5,'Narejeno iz domačega limoninega sirupa.',2,'Limonada'),(7,'frontend\\static\\images\\ponudba\\coca-cola.png',2.5,'Paše kot ata na mamo.',2,'Coca-cola'),(8,'frontend\\static\\images\\ponudba\\pizza.png',7.99,'Pizze iz fermentiranega testa z drožmi, vzhajanega 48 ur, pečene eno minuto na 450°C',5,'Pizza'),(9,'frontend\\static\\images\\ponudba\\piscancji-burger.jpg',6.99,'Piščančji file, paniran in ocvrt v panadi moke in jajčk, zeliščna ranch omaka, kisle kumarice, listnata solata in paradižnik. Postreženo v klasični krompirjevi bombeti.',1,'Burger Crispy Chicken'),(10,'frontend\\static\\images\\ponudba\\philly-steak.jpg',8.99,'Rezine 100% slovenske govedine, brez GSO, jalapeno paprika, karamelizirana čebulica in angleški cheddar sir. Zavito v domačo oljno štručko.',4,'Philly steak'),(11,'frontend\\static\\images\\ponudba\\roastbeef-steak.jpg',11.99,'100% black angus roastbeef govedina brez GSO, karamelizirana čebulica in originalni italijanski provolone sir. Zavito v domačo oljno štručko.',4,'Angus roastbeef steak');
/*!40000 ALTER TABLE `PONUDBA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `STATUSNAKUPA`
--

DROP TABLE IF EXISTS `STATUSNAKUPA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `STATUSNAKUPA` (
  `ID_STATUS` int NOT NULL AUTO_INCREMENT,
  `NAZIV_STATUS` varchar(10) COLLATE utf16_slovenian_ci NOT NULL,
  PRIMARY KEY (`ID_STATUS`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `STATUSNAKUPA`
--

LOCK TABLES `STATUSNAKUPA` WRITE;
/*!40000 ALTER TABLE `STATUSNAKUPA` DISABLE KEYS */;
/*!40000 ALTER TABLE `STATUSNAKUPA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `STRANKA`
--

DROP TABLE IF EXISTS `STRANKA`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `STRANKA` (
  `ID_STRANKA` int NOT NULL AUTO_INCREMENT,
  `ID_NASLOV` int DEFAULT NULL,
  `IME` varchar(25) COLLATE utf16_slovenian_ci NOT NULL,
  `PRIIMEK` varchar(25) COLLATE utf16_slovenian_ci NOT NULL,
  `EMAIL` varchar(50) COLLATE utf16_slovenian_ci DEFAULT NULL,
  `GESLO` varchar(100) COLLATE utf16_slovenian_ci DEFAULT NULL,
  `DATUMREGISTRACIJE` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `AKTIVIRAN` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID_STRANKA`),
  KEY `FK_SE_NAHAJA` (`ID_NASLOV`),
  CONSTRAINT `FK_SE_NAHAJA` FOREIGN KEY (`ID_NASLOV`) REFERENCES `NASLOV` (`ID_NASLOV`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf16 COLLATE=utf16_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `STRANKA`
--

LOCK TABLES `STRANKA` WRITE;
/*!40000 ALTER TABLE `STRANKA` DISABLE KEYS */;
INSERT INTO `STRANKA` VALUES (1,1,'Martin','Strekelj','strekelj123@gmail.com','219a402c','2020-12-21 14:17:20',0),(2,3,'Megi','Skufca','foo@bar.com','219a402c','2020-12-21 15:27:50',1),(5,5,'Micka','Kovačeva','foo12345@bar.com','219a402c','2020-12-21 14:17:20',0),(6,1,'Martin','Štrekelj','martin.strekelj123@gmail.com','219a402c','2020-12-21 14:17:20',0),(7,1,'Luka','Tomažič','luka.tomazic12@gmail.com','219a402c','2020-12-01 16:24:22',1);
/*!40000 ALTER TABLE `STRANKA` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ZAPOSLENI`
--

DROP TABLE IF EXISTS `ZAPOSLENI`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ZAPOSLENI` (
  `ID_ZAPOSLENI` int NOT NULL AUTO_INCREMENT,
  `IME` varchar(25) COLLATE utf16_slovenian_ci NOT NULL,
  `PRIIMEK` varchar(25) COLLATE utf16_slovenian_ci NOT NULL,
  `EMAIL` varchar(50) COLLATE utf16_slovenian_ci DEFAULT NULL,
  `GESLO` varchar(100) COLLATE utf16_slovenian_ci DEFAULT NULL,
  `ADMIN` tinyint(1) DEFAULT NULL,
  `IZBRISAN` tinyint(1) DEFAULT NULL,
  `CERT` varchar(50) COLLATE utf16_slovenian_ci NOT NULL,
  PRIMARY KEY (`ID_ZAPOSLENI`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf16 COLLATE=utf16_slovenian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ZAPOSLENI`
--

LOCK TABLES `ZAPOSLENI` WRITE;
/*!40000 ALTER TABLE `ZAPOSLENI` DISABLE KEYS */;
INSERT INTO `ZAPOSLENI` VALUES (1,'Simon','Babnik','simon@fud.si','simon123',0,0,'78843575bf3437d87361a2aba0a3fdea'),(2,'Martin','Štrekelj','martin@fud.si','martin123',1,0,'81d6f316d169150d0e8733866c38684d'),(3,'Luka','Tomažič','luka@fud.si','luka123',0,0,'24c8e8fdd203338d06e4330c28c90d1b');
/*!40000 ALTER TABLE `ZAPOSLENI` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-12-21 18:10:49
