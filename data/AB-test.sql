/*
SQLyog Ultimate v9.60 
MySQL - 5.5.16 : Database - abtest
*********************************************************************
*/


/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`abtest` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `abtest`;

/*Table structure for table `feature` */

DROP TABLE IF EXISTS `feature`;

CREATE TABLE `feature` (
  `feature_id` int(22) NOT NULL AUTO_INCREMENT,
  `feature_tag` varchar(255) NOT NULL,
  `feature_desc` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`feature_id`),
  UNIQUE KEY `feature_tag_unique` (`feature_tag`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Table structure for table `feature_x_abgroup` */

DROP TABLE IF EXISTS `feature_x_abgroup`;

CREATE TABLE `feature_x_abgroup` (
  `fxa_id` int(11) NOT NULL AUTO_INCREMENT,
  `fxa_abgroup` smallint(6) DEFAULT NULL,
  `fxa_feature` int(11) DEFAULT NULL,
  PRIMARY KEY (`fxa_id`),
  UNIQUE KEY `group_x_feature_unique` (`fxa_abgroup`,`fxa_feature`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=latin1;


/*Table structure for table `users` */

/*
DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) COLLATE utf8_bin NOT NULL,
  `ab_group` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1097 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
*/

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
