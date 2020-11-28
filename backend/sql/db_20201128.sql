-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               10.5.8-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for seminarska_naloga_ep2020
DROP DATABASE IF EXISTS `seminarska_naloga_ep2020`;
CREATE DATABASE IF NOT EXISTS `seminarska_naloga_ep2020` /*!40100 DEFAULT CHARACTER SET utf16 COLLATE utf16_slovenian_ci */;
USE `seminarska_naloga_ep2020`;

-- Dumping structure for table seminarska_naloga_ep2020.artikli
DROP TABLE IF EXISTS `artikli`;
CREATE TABLE IF NOT EXISTS `artikli` (
  `ID_ARTIKEL` int(11) NOT NULL AUTO_INCREMENT,
  `CENA` decimal(10,0) NOT NULL,
  `OPIS` text COLLATE utf16_slovenian_ci NOT NULL,
  `NAZIV_ARTIKEL` varchar(60) COLLATE utf16_slovenian_ci NOT NULL,
  PRIMARY KEY (`ID_ARTIKEL`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_slovenian_ci;

-- Dumping data for table seminarska_naloga_ep2020.artikli: ~0 rows (approximately)
/*!40000 ALTER TABLE `artikli` DISABLE KEYS */;
/*!40000 ALTER TABLE `artikli` ENABLE KEYS */;

-- Dumping structure for table seminarska_naloga_ep2020.izbrani_artikli
DROP TABLE IF EXISTS `izbrani_artikli`;
CREATE TABLE IF NOT EXISTS `izbrani_artikli` (
  `ID_ARTIKEL` int(11) NOT NULL,
  `IDNAKUPA` int(11) NOT NULL,
  `KOLICINA` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_ARTIKEL`,`IDNAKUPA`),
  KEY `FK_IZBRANI_ARTIKLI2` (`IDNAKUPA`),
  CONSTRAINT `FK_IZBRANI_ARTIKLI` FOREIGN KEY (`ID_ARTIKEL`) REFERENCES `artikli` (`ID_ARTIKEL`),
  CONSTRAINT `FK_IZBRANI_ARTIKLI2` FOREIGN KEY (`IDNAKUPA`) REFERENCES `nakup` (`IDNAKUPA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_slovenian_ci;

-- Dumping data for table seminarska_naloga_ep2020.izbrani_artikli: ~0 rows (approximately)
/*!40000 ALTER TABLE `izbrani_artikli` DISABLE KEYS */;
/*!40000 ALTER TABLE `izbrani_artikli` ENABLE KEYS */;

-- Dumping structure for table seminarska_naloga_ep2020.kraj
DROP TABLE IF EXISTS `kraj`;
CREATE TABLE IF NOT EXISTS `kraj` (
  `POSTNA_STEVILKA` int(11) NOT NULL,
  `KRAJ` varchar(50) COLLATE utf16_slovenian_ci NOT NULL,
  PRIMARY KEY (`POSTNA_STEVILKA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_slovenian_ci;

-- Dumping data for table seminarska_naloga_ep2020.kraj: ~1 rows (approximately)
/*!40000 ALTER TABLE `kraj` DISABLE KEYS */;
INSERT INTO `kraj` (`POSTNA_STEVILKA`, `KRAJ`) VALUES
	(1000, 'Ljubljana'),
	(8000, 'Novo Mesto');
/*!40000 ALTER TABLE `kraj` ENABLE KEYS */;

-- Dumping structure for table seminarska_naloga_ep2020.nakup
DROP TABLE IF EXISTS `nakup`;
CREATE TABLE IF NOT EXISTS `nakup` (
  `IDNAKUPA` int(11) NOT NULL AUTO_INCREMENT,
  `ID_STATUS` int(11) NOT NULL,
  `ID_STRANKA` int(11) NOT NULL,
  `SKUPNA_CENA` int(11) NOT NULL,
  `DATUMCAS_NAROCILA` datetime NOT NULL,
  `DATUMCAS_POTRDILA` datetime NOT NULL,
  PRIMARY KEY (`IDNAKUPA`),
  KEY `FK_IMA` (`ID_STATUS`),
  KEY `FK_IZVEDE` (`ID_STRANKA`),
  CONSTRAINT `FK_IMA` FOREIGN KEY (`ID_STATUS`) REFERENCES `statusnakupa` (`ID_STATUS`),
  CONSTRAINT `FK_IZVEDE` FOREIGN KEY (`ID_STRANKA`) REFERENCES `stranka` (`ID_STRANKA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_slovenian_ci;

-- Dumping data for table seminarska_naloga_ep2020.nakup: ~0 rows (approximately)
/*!40000 ALTER TABLE `nakup` DISABLE KEYS */;
/*!40000 ALTER TABLE `nakup` ENABLE KEYS */;

-- Dumping structure for table seminarska_naloga_ep2020.naslov
DROP TABLE IF EXISTS `naslov`;
CREATE TABLE IF NOT EXISTS `naslov` (
  `ID_NASLOV` int(11) NOT NULL AUTO_INCREMENT,
  `POSTNA_STEVILKA` int(11) NOT NULL,
  `ULICA` varchar(50) COLLATE utf16_slovenian_ci NOT NULL,
  `HISNA_STEVILKA` varchar(5) COLLATE utf16_slovenian_ci NOT NULL,
  PRIMARY KEY (`ID_NASLOV`),
  KEY `FK_LEZI_V` (`POSTNA_STEVILKA`),
  CONSTRAINT `FK_LEZI_V` FOREIGN KEY (`POSTNA_STEVILKA`) REFERENCES `kraj` (`POSTNA_STEVILKA`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf16 COLLATE=utf16_slovenian_ci;

-- Dumping data for table seminarska_naloga_ep2020.naslov: ~5 rows (approximately)
/*!40000 ALTER TABLE `naslov` DISABLE KEYS */;
INSERT INTO `naslov` (`ID_NASLOV`, `POSTNA_STEVILKA`, `ULICA`, `HISNA_STEVILKA`) VALUES
	(1, 1000, 'Predstruge', '21a'),
	(2, 1000, 'Ponikve', '21a'),
	(3, 1000, 'Ulica sv Petra', '12'),
	(4, 8000, 'Gotna vas', '51'),
	(5, 8000, 'Jurna vas', '51');
/*!40000 ALTER TABLE `naslov` ENABLE KEYS */;

-- Dumping structure for table seminarska_naloga_ep2020.statusnakupa
DROP TABLE IF EXISTS `statusnakupa`;
CREATE TABLE IF NOT EXISTS `statusnakupa` (
  `ID_STATUS` int(11) NOT NULL AUTO_INCREMENT,
  `NAZIV_STATUS` varchar(10) COLLATE utf16_slovenian_ci NOT NULL,
  PRIMARY KEY (`ID_STATUS`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_slovenian_ci;

-- Dumping data for table seminarska_naloga_ep2020.statusnakupa: ~0 rows (approximately)
/*!40000 ALTER TABLE `statusnakupa` DISABLE KEYS */;
/*!40000 ALTER TABLE `statusnakupa` ENABLE KEYS */;

-- Dumping structure for table seminarska_naloga_ep2020.stranka
DROP TABLE IF EXISTS `stranka`;
CREATE TABLE IF NOT EXISTS `stranka` (
  `ID_STRANKA` int(11) NOT NULL AUTO_INCREMENT,
  `ID_NASLOV` int(11) DEFAULT NULL,
  `IME` varchar(25) COLLATE utf16_slovenian_ci NOT NULL,
  `PRIIMEK` varchar(25) COLLATE utf16_slovenian_ci NOT NULL,
  `EMAIL` varchar(50) COLLATE utf16_slovenian_ci DEFAULT NULL,
  `GESLO` varchar(100) COLLATE utf16_slovenian_ci DEFAULT NULL,
  `DATUMREGISTRACIJE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`ID_STRANKA`),
  KEY `FK_SE_NAHAJA` (`ID_NASLOV`),
  CONSTRAINT `FK_SE_NAHAJA` FOREIGN KEY (`ID_NASLOV`) REFERENCES `naslov` (`ID_NASLOV`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf16 COLLATE=utf16_slovenian_ci;

-- Dumping data for table seminarska_naloga_ep2020.stranka: ~3 rows (approximately)
/*!40000 ALTER TABLE `stranka` DISABLE KEYS */;
INSERT INTO `stranka` (`ID_STRANKA`, `ID_NASLOV`, `IME`, `PRIIMEK`, `EMAIL`, `GESLO`, `DATUMREGISTRACIJE`) VALUES
	(1, 1, 'Martin', 'Strekelj', 'strekelj123@gmail.com', '219a402c', '2020-11-28 12:25:21'),
	(2, 3, 'Megi', 'Skufca', 'foo@bar.com', '219a402c', '2020-11-28 12:34:03'),
	(5, 5, 'Micka', 'Kovačeva', 'foo12345@bar.com', '219a402c', '2020-11-28 12:40:54');
/*!40000 ALTER TABLE `stranka` ENABLE KEYS */;

-- Dumping structure for table seminarska_naloga_ep2020.zaposleni
DROP TABLE IF EXISTS `zaposleni`;
CREATE TABLE IF NOT EXISTS `zaposleni` (
  `ID_ZAPOSLENI` int(11) NOT NULL AUTO_INCREMENT,
  `IME` varchar(25) COLLATE utf16_slovenian_ci NOT NULL,
  `PRIIMEK` varchar(25) COLLATE utf16_slovenian_ci NOT NULL,
  `EMAIL` varchar(50) COLLATE utf16_slovenian_ci DEFAULT NULL,
  `GESLO` varchar(100) COLLATE utf16_slovenian_ci DEFAULT NULL,
  `ADMIN` tinyint(1) DEFAULT NULL,
  `IZBRISAN` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`ID_ZAPOSLENI`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_slovenian_ci;

-- Dumping data for table seminarska_naloga_ep2020.zaposleni: ~0 rows (approximately)
/*!40000 ALTER TABLE `zaposleni` DISABLE KEYS */;
/*!40000 ALTER TABLE `zaposleni` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
