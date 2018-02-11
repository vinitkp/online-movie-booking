# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.16)
# Database: movie_booking
# Generation Time: 2018-02-11 10:40:09 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table Booking
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Booking`;

CREATE TABLE `Booking` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `show_id` int(11) DEFAULT NULL,
  `seat_id` varchar(40) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `Booking` WRITE;
/*!40000 ALTER TABLE `Booking` DISABLE KEYS */;

INSERT INTO `Booking` (`id`, `show_id`, `seat_id`, `user_id`)
VALUES
	(1,1,'Gold_J_3',1),
	(2,1,'Platinum_K_4',1),
	(5,1,'Gold_J_3',1),
	(6,1,'Platinum_K_4',1),
	(7,1,'Gold_J_3',1),
	(8,1,'Platinum_K_4',1),
	(9,1,'Gold_J_3',1),
	(10,1,'Platinum_K_4',1),
	(11,1,'Gold_J_3',1),
	(12,1,'Platinum_K_4',1),
	(13,1,'Gold_J_3',1),
	(14,1,'Platinum_K_4',1),
	(15,1,'Gold_J_3',1),
	(16,1,'Platinum_K_4',1),
	(17,1,'Gold_J_3',1),
	(18,1,'Platinum_K_4',1),
	(19,1,'Silver_E_5',1),
	(20,1,'Silver_E_6',1),
	(21,1,'Silver_D_6',1),
	(22,1,'Silver_D_7',1),
	(23,1,'Silver_E_7',1),
	(24,1,'Silver_A_4',1),
	(25,1,'Silver_C_7',1),
	(26,1,'Gold_G_8',1),
	(27,1,'Gold_H_7',1),
	(28,1,'Platinum_K_10',1),
	(29,2,'Silver_C_5',1),
	(30,2,'Silver_C_6',1),
	(31,5,'Gold_F_6',1),
	(32,5,'Gold_G_6',1),
	(33,2,'Silver_D_6',1);

/*!40000 ALTER TABLE `Booking` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Movie
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Movie`;

CREATE TABLE `Movie` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `language` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `Movie` WRITE;
/*!40000 ALTER TABLE `Movie` DISABLE KEYS */;

INSERT INTO `Movie` (`id`, `name`, `language`)
VALUES
	(1,'Padmavati','hindi'),
	(2,'Darkest Hour','english');

/*!40000 ALTER TABLE `Movie` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Screen
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Screen`;

CREATE TABLE `Screen` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `theatre_id` int(11) NOT NULL,
  `screen_name` varchar(40) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `Screen` WRITE;
/*!40000 ALTER TABLE `Screen` DISABLE KEYS */;

INSERT INTO `Screen` (`id`, `theatre_id`, `screen_name`)
VALUES
	(1,1,'audi-1'),
	(2,1,'audi-2');

/*!40000 ALTER TABLE `Screen` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Seat_Type
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Seat_Type`;

CREATE TABLE `Seat_Type` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `screen_id` int(11) DEFAULT NULL,
  `name` varchar(40) DEFAULT NULL,
  `number_of_seats` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `Seat_Type` WRITE;
/*!40000 ALTER TABLE `Seat_Type` DISABLE KEYS */;

INSERT INTO `Seat_Type` (`id`, `screen_id`, `name`, `number_of_seats`)
VALUES
	(1,1,'Silver',50),
	(2,1,'Gold',50),
	(3,1,'Platinum',20);

/*!40000 ALTER TABLE `Seat_Type` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Movie_Show
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Movie_Show`;

CREATE TABLE `Movie_Show` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `movie_id` int(11) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `screen_id` int(11) DEFAULT NULL,
  `show_date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `Movie_Show` WRITE;
/*!40000 ALTER TABLE `Movie_Show` DISABLE KEYS */;

INSERT INTO `Movie_Show` (`id`, `movie_id`, `start_time`, `screen_id`, `show_date`)
VALUES
	(1,1,'09:00:00',1,'2018-02-18'),
	(2,1,'12:00:00',1,'2018-02-18'),
	(3,1,'03:00:00',2,'2018-02-18'),
	(4,1,'18:00:00',2,'2018-02-18'),
	(5,2,'14:00:00',2,'2018-02-18');

/*!40000 ALTER TABLE `Movie_Show` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Theatre
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Theatre`;

CREATE TABLE `Theatre` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  `city` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `Theatre` WRITE;
/*!40000 ALTER TABLE `Theatre` DISABLE KEYS */;

INSERT INTO `Theatre` (`id`, `name`, `city`)
VALUES
	(1,'pvr','pune');

/*!40000 ALTER TABLE `Theatre` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Ticket_rate
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Ticket_rate`;

CREATE TABLE `Ticket_rate` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `show_id` int(11) DEFAULT NULL,
  `seat_id` int(11) DEFAULT NULL,
  `rate` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `Ticket_rate` WRITE;
/*!40000 ALTER TABLE `Ticket_rate` DISABLE KEYS */;

INSERT INTO `Ticket_rate` (`id`, `show_id`, `seat_id`, `rate`)
VALUES
	(1,1,1,100),
	(2,1,2,200),
	(3,1,3,300);

/*!40000 ALTER TABLE `Ticket_rate` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table User
# ------------------------------------------------------------

DROP TABLE IF EXISTS `User`;

CREATE TABLE `User` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `email_id` varchar(40) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
