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

-- Dumping structure for table seminarska_naloga_ep2020.izbrani_artikli
DROP TABLE IF EXISTS `izbrani_artikli`;
CREATE TABLE IF NOT EXISTS `izbrani_artikli` (
  `ID_ARTIKEL` int(11) NOT NULL,
  `IDNAKUPA` int(11) NOT NULL,
  `KOLICINA` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_ARTIKEL`,`IDNAKUPA`),
  KEY `FK_IZBRANI_ARTIKLI2` (`IDNAKUPA`),
  CONSTRAINT `FK_IZBRANI_ARTIKLI` FOREIGN KEY (`ID_ARTIKEL`) REFERENCES `ponudba` (`ID_ARTIKEL`),
  CONSTRAINT `FK_IZBRANI_ARTIKLI2` FOREIGN KEY (`IDNAKUPA`) REFERENCES `nakup` (`IDNAKUPA`)
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_slovenian_ci;

-- Dumping data for table seminarska_naloga_ep2020.izbrani_artikli: ~0 rows (approximately)
/*!40000 ALTER TABLE `izbrani_artikli` DISABLE KEYS */;
/*!40000 ALTER TABLE `izbrani_artikli` ENABLE KEYS */;

-- Dumping structure for table seminarska_naloga_ep2020.kategorije
DROP TABLE IF EXISTS `kategorije`;
CREATE TABLE IF NOT EXISTS `kategorije` (
  `ID_KATEGORIJE` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `NAZIV_KATEGORIJE` varchar(50) COLLATE utf16_slovenian_ci DEFAULT NULL,
  PRIMARY KEY (`ID_KATEGORIJE`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf16 COLLATE=utf16_slovenian_ci COMMENT='Kategorije ponudbe';

-- Dumping data for table seminarska_naloga_ep2020.kategorije: ~4 rows (approximately)
/*!40000 ALTER TABLE `kategorije` DISABLE KEYS */;
INSERT INTO `kategorije` (`ID_KATEGORIJE`, `NAZIV_KATEGORIJE`) VALUES
	(1, 'Burgerji'),
	(2, 'Pijača'),
	(3, 'Priloge'),
	(4, 'Steak'),
	(5, 'Vedno paše');
/*!40000 ALTER TABLE `kategorije` ENABLE KEYS */;

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
	(1312, 'Videm-Dobrepolje'),
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

-- Dumping data for table seminarska_naloga_ep2020.naslov: ~4 rows (approximately)
/*!40000 ALTER TABLE `naslov` DISABLE KEYS */;
INSERT INTO `naslov` (`ID_NASLOV`, `POSTNA_STEVILKA`, `ULICA`, `HISNA_STEVILKA`) VALUES
	(1, 1000, 'Predstruge', '21a'),
	(2, 1000, 'Ponikve', '21a'),
	(3, 1000, 'Ulica sv Petra', '12'),
	(4, 8000, 'Gotna vas', '51'),
	(5, 8000, 'Jurna vas', '51');
/*!40000 ALTER TABLE `naslov` ENABLE KEYS */;

-- Dumping structure for table seminarska_naloga_ep2020.ponudba
DROP TABLE IF EXISTS `ponudba`;
CREATE TABLE IF NOT EXISTS `ponudba` (
  `ID_ARTIKEL` int(11) NOT NULL AUTO_INCREMENT,
  `PATH_TO_IMG` varchar(75) COLLATE utf16_slovenian_ci NOT NULL DEFAULT '0',
  `CENA` float NOT NULL DEFAULT 0,
  `OPIS` text COLLATE utf16_slovenian_ci NOT NULL,
  `KATEGORIJA` int(11) unsigned NOT NULL,
  `NAZIV_ARTIKEL` varchar(60) COLLATE utf16_slovenian_ci NOT NULL,
  PRIMARY KEY (`ID_ARTIKEL`),
  KEY `FK_ponudba_kategorije` (`KATEGORIJA`),
  CONSTRAINT `FK_ponudba_kategorije` FOREIGN KEY (`KATEGORIJA`) REFERENCES `kategorije` (`ID_KATEGORIJE`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf16 COLLATE=utf16_slovenian_ci;

-- Dumping data for table seminarska_naloga_ep2020.ponudba: ~10 rows (approximately)
/*!40000 ALTER TABLE `ponudba` DISABLE KEYS */;
INSERT INTO `ponudba` (`ID_ARTIKEL`, `PATH_TO_IMG`, `CENA`, `OPIS`, `KATEGORIJA`, `NAZIV_ARTIKEL`) VALUES
	(1, 'frontend\\static\\images\\ponudba\\domaci-burger.jpg', 5.99, ' Krompirjeva bombica popečena na maslu, 100% govedina slovenskega porekla, naša classic hišna omaka, sveža domača solata, rezine sladkega paradižnika in Cheddar sir.', 1, 'Burger domači'),
	(2, 'frontend\\static\\images\\ponudba\\pommes.jpg', 3.99, 'Vsak dan sveže olupljen in narezan slovenski krompirček. Ocvrt v 100% arašidovem olju. Prava družba za tvoj najljubši burger.', 3, 'Pomfri krompirček'),
	(3, 'frontend\\static\\images\\ponudba\\buffalo-wings.jpg', 6.99, 'Ljubitelji piščančjih perutničk poznajo užitek hrustljave začinjene kože, ki je bistvo te jedi.', 5, 'Buffalo perutničke'),
	(4, 'frontend\\static\\images\\ponudba\\hotdog.png', 4.99, 'Juicy..tasty...with a good smell and lovely caramelized onion..🤟', 1, 'the Hot Dog'),
	(5, 'frontend\\static\\images\\ponudba\\lemon-juice.png', 2.5, 'Narejeno iz domačega limoninega sirupa.', 2, 'Limonada'),
	(7, 'frontend\\static\\images\\ponudba\\coca-cola.png', 2.5, 'Paše kot ata na mamo.', 2, 'Coca-cola'),
	(8, 'frontend\\static\\images\\ponudba\\pizza.png', 7.99, 'Pizze iz fermentiranega testa z drožmi, vzhajanega 48 ur, pečene eno minuto na 450°C', 5, 'Pizza'),
	(9, 'frontend\\static\\images\\ponudba\\piscancji-burger.jpg', 6.99, 'Piščančji file, paniran in ocvrt v panadi moke in jajčk, zeliščna ranch omaka, kisle kumarice, listnata solata in paradižnik. Postreženo v klasični krompirjevi bombeti.', 1, 'Burger Crispy Chicken'),
	(10, 'frontend\\static\\images\\ponudba\\philly-steak.jpg', 8.99, 'Rezine 100% slovenske govedine, brez GSO, jalapeno paprika, karamelizirana čebulica in angleški cheddar sir. Zavito v domačo oljno štručko.', 4, 'Philly steak'),
	(11, 'frontend\\static\\images\\ponudba\\roastbeef-steak.jpg', 11.99, '100% black angus roastbeef govedina brez GSO, karamelizirana čebulica in originalni italijanski provolone sir. Zavito v domačo oljno štručko.', 4, 'Angus roastbeef steak');
/*!40000 ALTER TABLE `ponudba` ENABLE KEYS */;

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf16 COLLATE=utf16_slovenian_ci;

-- Dumping data for table seminarska_naloga_ep2020.stranka: ~4 rows (approximately)
/*!40000 ALTER TABLE `stranka` DISABLE KEYS */;
INSERT INTO `stranka` (`ID_STRANKA`, `ID_NASLOV`, `IME`, `PRIIMEK`, `EMAIL`, `GESLO`, `DATUMREGISTRACIJE`) VALUES
	(1, 1, 'Martin', 'Strekelj', 'strekelj123@gmail.com', '219a402c', '2020-11-28 12:25:21'),
	(2, 3, 'Megi', 'Skufca', 'foo@bar.com', '219a402c', '2020-11-28 12:34:03'),
	(5, 5, 'Micka', 'Kovačeva', 'foo12345@bar.com', '219a402c', '2020-11-28 12:40:54'),
	(6, 1, 'Martin', 'Štrekelj', 'martin.strekelj123@gmail.com', '219a402c', '2020-12-01 17:24:22');
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
