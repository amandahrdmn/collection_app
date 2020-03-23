# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.29)
# Database: collection_app
# Generation Time: 2020-03-23 14:51:24 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table plant_types
# ------------------------------------------------------------

DROP TABLE IF EXISTS `plant_types`;

CREATE TABLE `plant_types` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `plant_types` WRITE;
/*!40000 ALTER TABLE `plant_types` DISABLE KEYS */;

INSERT INTO `plant_types` (`id`, `type`)
VALUES
	(1,'tree'),
	(2,'shrub'),
	(3,'rose'),
	(4,'Climber/Wall shrub'),
	(5,'perennial'),
	(6,'Annual/Biennial/Bedding'),
	(7,'Rock plant'),
	(8,'Bulb'),
	(9,'Water/Bog plant'),
	(10,'Tender/Exotic plant');

/*!40000 ALTER TABLE `plant_types` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table plants
# ------------------------------------------------------------

DROP TABLE IF EXISTS `plants`;

CREATE TABLE `plants` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `science_name` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `plants` WRITE;
/*!40000 ALTER TABLE `plants` DISABLE KEYS */;

INSERT INTO `plants` (`id`, `science_name`, `name`, `type`)
VALUES
	(1,'Querbus robur','English Oak',1),
	(2,'Davidia involucrata','Dove tree,  Handkerchief tree',1),
	(3,'Populus x canescens','Gray poplar',1),
	(4,'Acer platanoides','Crimson King',1),
	(5,'Fraxinus excelsior','Jaspidea',1),
	(6,'Aesculus chinensis','Chinese horse-chestnut',1),
	(7,'Osmanthus delavayi','Delavay osmanthus',2),
	(8,'Rosa Jaqueline du Pre','Harwanna',3),
	(9,'Clematis Arctic Queen','Evitwo',4),
	(10,'Romneya coulteri','Tree poppy',5);

/*!40000 ALTER TABLE `plants` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
