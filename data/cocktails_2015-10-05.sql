# ************************************************************
# Sequel Pro SQL dump
# Version 4499
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Hôte: localhost (MySQL 5.5.42)
# Base de données: cocktails
# Temps de génération: 2015-10-05 17:24:29 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Affichage de la table favorite
# ------------------------------------------------------------

DROP TABLE IF EXISTS `favorite`;

CREATE TABLE `favorite` (
  `userId` int(11) NOT NULL,
  `recipeId` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userId`,`recipeId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Affichage de la table User
# ------------------------------------------------------------

DROP TABLE IF EXISTS `User`;

CREATE TABLE `User` (
  `login` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(60) NOT NULL DEFAULT '',
  `firstName` varchar(11) DEFAULT NULL,
  `lastName` varchar(11) DEFAULT NULL,
  `sex` enum('f','m') DEFAULT NULL,
  `email` varchar(128) DEFAULT NULL,
  `birthDate` date DEFAULT NULL,
  `address` varchar(11) DEFAULT NULL,
  `postalCode` int(5) DEFAULT NULL,
  `city` varchar(11) DEFAULT NULL,
  `phoneNumber` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`login`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;

INSERT INTO `User` (`login`, `password`, `firstName`, `lastName`, `sex`, `email`, `birthDate`, `address`, `postalCode`, `city`, `phoneNumber`)
VALUES
	('test0u','sha256:1000:DLy7S+/JowJ6bg8baE7cFnAJLlQWhtj3:7HwDNXPUqZ0s09O',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),
	('test1u','sha256:1000:DLy7S+/JowJ6bg8baE7cFnAJLlQWhtj3:7HwDNXPUqZ0s09O',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);

/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
