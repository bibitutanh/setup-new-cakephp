/*
SQLyog Community Edition- MySQL GUI v6.56
MySQL - 5.6.16 : Database - cakephp249
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

CREATE DATABASE /*!32312 IF NOT EXISTS*/`cakephp249` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `cakephp249`;

/*Table structure for table `acos` */

DROP TABLE IF EXISTS `acos`;

CREATE TABLE `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `acos` */

/*Table structure for table `aros` */

DROP TABLE IF EXISTS `aros`;

CREATE TABLE `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `aros` */

/*Table structure for table `aros_acos` */

DROP TABLE IF EXISTS `aros_acos`;

CREATE TABLE `aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `aros_acos` */

/*Table structure for table `backend_user_groups` */

DROP TABLE IF EXISTS `backend_user_groups`;

CREATE TABLE `backend_user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `root` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `backend_user_groups` */

insert  into `backend_user_groups`(`id`,`name`,`root`) values (1,'Admin',1);

/*Table structure for table `backend_users` */

DROP TABLE IF EXISTS `backend_users`;

CREATE TABLE `backend_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `backend_user_group_id` int(11) DEFAULT NULL,
  `username` varchar(127) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `mail` varchar(255) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `backend_users` */

insert  into `backend_users`(`id`,`backend_user_group_id`,`username`,`password`,`first_name`,`last_name`,`mail`,`last_login`,`published`,`created`) values (1,NULL,'baonam1','5392ae62c2bcd167241044603e4e23e6945969cf','Bảo','Nam','baonam1@yahoo.com',NULL,1,'2014-05-13 14:28:58'),(2,1,'baonam','5392ae62c2bcd167241044603e4e23e6945969cf','Bảo','Nam','baonam@yahoo.com',NULL,1,'2014-05-13 14:29:48');

/*Table structure for table `comments` */

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content` text COLLATE utf8_unicode_ci,
  `status` char(1) COLLATE utf8_unicode_ci DEFAULT 'Y',
  `parent_id` int(11) unsigned DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `model` char(10) COLLATE utf8_unicode_ci DEFAULT 'Post',
  `creator` int(10) unsigned DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modifier` int(10) unsigned DEFAULT '0',
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `comments` */

/*Table structure for table `posts` */

DROP TABLE IF EXISTS `posts`;

CREATE TABLE `posts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` longtext,
  `status` char(1) DEFAULT 'Y',
  `created` datetime DEFAULT '0000-00-00 00:00:00',
  `creator` int(6) unsigned DEFAULT '0',
  `modified` datetime DEFAULT '0000-00-00 00:00:00',
  `modifier` int(6) unsigned DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `created_by` (`creator`),
  KEY `type_status_date` (`status`,`created`,`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `posts` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
