/*
SQLyog Ultimate v10.41 
MySQL - 5.5.5-10.1.37-MariaDB : Database - laravel_v1_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`laravel_v1_db` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `laravel_v1_db`;

/*Table structure for table `com_email` */

DROP TABLE IF EXISTS `com_email`;

CREATE TABLE `com_email` (
  `email_id` varchar(2) NOT NULL,
  `email_name` varchar(100) DEFAULT NULL,
  `email_address` varchar(50) DEFAULT NULL,
  `smtp_host` varchar(50) DEFAULT NULL,
  `smtp_port` varchar(5) DEFAULT NULL,
  `smtp_username` varchar(50) DEFAULT NULL,
  `smtp_password` varchar(50) DEFAULT NULL,
  `use_smtp` enum('1','0') DEFAULT '1',
  `use_authorization` enum('1','0') DEFAULT '1',
  `mdb` varchar(10) DEFAULT NULL,
  `mdb_name` varchar(50) DEFAULT NULL,
  `mdd` datetime DEFAULT NULL,
  PRIMARY KEY (`email_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `com_email` */

insert  into `com_email`(`email_id`,`email_name`,`email_address`,`smtp_host`,`smtp_port`,`smtp_username`,`smtp_password`,`use_smtp`,`use_authorization`,`mdb`,`mdb_name`,`mdd`) values ('01','[No Reply] Laravel','armisianto.othermail@gmail.com','ssl://smtp.gmail.com','465','armisianto.othermail@gmail.com','adjndovlkrzbvvot','1','1',NULL,NULL,NULL);

/*Table structure for table `com_group` */

DROP TABLE IF EXISTS `com_group`;

CREATE TABLE `com_group` (
  `group_id` varchar(2) NOT NULL,
  `group_name` varchar(50) DEFAULT NULL,
  `group_desc` varchar(100) DEFAULT NULL,
  `mdb` varchar(10) DEFAULT NULL,
  `crd` datetime DEFAULT NULL,
  `mdd` datetime DEFAULT NULL,
  PRIMARY KEY (`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `com_group` */

insert  into `com_group`(`group_id`,`group_name`,`group_desc`,`mdb`,`crd`,`mdd`) values ('01','Developer','Kelompok Pengguna Khusus Developer Aplikasi','1605200001',NULL,'2016-06-01 15:11:41'),('02','Operator','Pengguna Aplikasi','1804170001',NULL,'2019-01-21 15:30:23');

/*Table structure for table `com_menu` */

DROP TABLE IF EXISTS `com_menu`;

CREATE TABLE `com_menu` (
  `nav_id` varchar(10) NOT NULL,
  `portal_id` varchar(2) DEFAULT NULL,
  `parent_id` varchar(10) DEFAULT NULL,
  `nav_title` varchar(50) DEFAULT NULL,
  `nav_desc` varchar(100) DEFAULT NULL,
  `nav_url` varchar(100) DEFAULT NULL,
  `nav_no` int(11) unsigned DEFAULT NULL,
  `active_st` enum('1','0') DEFAULT '1',
  `display_st` enum('1','0') DEFAULT '1',
  `nav_icon` varchar(50) DEFAULT NULL,
  `mdb` varchar(10) DEFAULT NULL,
  `crd` datetime DEFAULT NULL,
  `mdd` datetime DEFAULT NULL,
  PRIMARY KEY (`nav_id`),
  KEY `FK_com_menu_p` (`portal_id`),
  CONSTRAINT `com_menu_ibfk_1` FOREIGN KEY (`portal_id`) REFERENCES `com_portal` (`portal_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `com_menu` */

insert  into `com_menu`(`nav_id`,`portal_id`,`parent_id`,`nav_title`,`nav_desc`,`nav_url`,`nav_no`,`active_st`,`display_st`,`nav_icon`,`mdb`,`crd`,`mdd`) values ('1000000002','10','0','Pengaturan Sistem','Settings','#settings',1,'1','1','fa fa-gears','1909160001',NULL,'2019-09-26 09:49:05'),('1000000004','10','1000000002','Application Portal','-','/sistem/portal',11,'1','1',NULL,'1909160001',NULL,'2019-09-26 09:49:25'),('1000000005','10','1000000002','Groups','-','/sistem/groups',12,'1','1',NULL,'1909160001',NULL,'2019-09-26 09:49:30'),('1000000006','10','1000000002','Roles','-','/sistem/roles',13,'1','1',NULL,'1909160001',NULL,'2019-09-26 09:49:35'),('1000000007','10','1000000002','Navigation','-','/sistem/menu',14,'1','1',NULL,'1909160001',NULL,'2019-09-26 09:49:39'),('1000000009','10','1000000002','Permissions','-','/sistem/permissions',15,'1','1',NULL,'1909160001',NULL,'2019-09-26 09:49:45'),('1000000180','10','1000000178','Data Ijin Pegawai','-','kepegawaian/master/ijin',224,'1','1','','1804170001',NULL,'2019-01-03 11:22:59'),('1000000181','10','0','Dashboard','-','/home/developer',0,'1','1','fa fa-dashboard','1909160001','2019-09-26 09:47:19','2019-09-26 09:47:19'),('1000000182','10','0','User','-','/sistem/users',2,'1','1','fa fa-users','1909160001','2019-09-26 09:50:21','2019-09-26 09:50:21'),('2000000001','20','0','Dashboard','-','dashboard/welcome',1,'1','1','fa fa-dashboard','1804170001',NULL,'2019-04-15 14:06:50');

/*Table structure for table `com_password_resets` */

DROP TABLE IF EXISTS `com_password_resets`;

CREATE TABLE `com_password_resets` (
  `reset_id` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('waiting','done') COLLATE utf8_unicode_ci DEFAULT NULL,
  `crd` datetime DEFAULT NULL,
  `mdd` datetime DEFAULT NULL,
  `mdb` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`reset_id`),
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `com_password_resets` */

/*Table structure for table `com_portal` */

DROP TABLE IF EXISTS `com_portal`;

CREATE TABLE `com_portal` (
  `portal_id` varchar(2) NOT NULL,
  `portal_nm` varchar(50) DEFAULT NULL,
  `site_title` varchar(100) DEFAULT NULL,
  `site_desc` varchar(100) DEFAULT NULL,
  `meta_desc` varchar(255) DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `mdb` varchar(50) DEFAULT NULL,
  `crd` datetime DEFAULT NULL,
  `mdd` datetime DEFAULT NULL,
  PRIMARY KEY (`portal_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `com_portal` */

insert  into `com_portal`(`portal_id`,`portal_nm`,`site_title`,`site_desc`,`meta_desc`,`meta_keyword`,`mdb`,`crd`,`mdd`) values ('10','Private Area','PT. Time Excelindo','Management Tools | PT. Time Excelindo',NULL,NULL,NULL,NULL,'2019-09-24 09:14:45'),('20','Operator Portal','E-Performance Kementerian Perhubungan','E-Performance Kementerian Perhubungan','E-Performance Kementerian Perhubungan','E-Performance, Kementerian Perhubungan, Kemenhub, Dephub, Aplikasi Kinerja','1804170001','2019-04-15 13:18:03',NULL);

/*Table structure for table `com_preferences` */

DROP TABLE IF EXISTS `com_preferences`;

CREATE TABLE `com_preferences` (
  `pref_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pref_group` varchar(50) DEFAULT NULL,
  `pref_nm` varchar(50) DEFAULT NULL,
  `pref_label` varchar(50) DEFAULT NULL,
  `pref_value` text,
  `mdb` varchar(50) DEFAULT NULL,
  `mdd` datetime DEFAULT NULL,
  PRIMARY KEY (`pref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `com_preferences` */

/*Table structure for table `com_reset_pass` */

DROP TABLE IF EXISTS `com_reset_pass`;

CREATE TABLE `com_reset_pass` (
  `data_id` varchar(20) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `nomor_telepon` varchar(50) DEFAULT NULL,
  `nama_lengkap` varchar(50) DEFAULT NULL,
  `jabatan` varchar(50) DEFAULT NULL,
  `request_date` datetime DEFAULT NULL,
  `request_st` enum('waiting','done') DEFAULT NULL,
  `request_expired` datetime DEFAULT NULL,
  `request_key` varchar(50) DEFAULT NULL,
  `response_by` varchar(10) DEFAULT NULL,
  `response_date` datetime DEFAULT NULL,
  `response_notes` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`data_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `com_reset_pass` */

insert  into `com_reset_pass`(`data_id`,`email`,`nomor_telepon`,`nama_lengkap`,`jabatan`,`request_date`,`request_st`,`request_expired`,`request_key`,`response_by`,`response_date`,`response_notes`) values ('15488336843589','wellynojutsu@gmail.com','-','Developer PT. Time Excelindo',NULL,'2019-01-30 14:34:44','waiting',NULL,'781RYB',NULL,NULL,NULL);

/*Table structure for table `com_role` */

DROP TABLE IF EXISTS `com_role`;

CREATE TABLE `com_role` (
  `role_id` varchar(5) NOT NULL,
  `group_id` varchar(2) DEFAULT NULL,
  `role_nm` varchar(100) DEFAULT NULL,
  `role_desc` varchar(100) DEFAULT NULL,
  `default_page` varchar(50) DEFAULT NULL,
  `mdb` varchar(50) DEFAULT NULL,
  `crd` datetime DEFAULT NULL,
  `mdd` datetime DEFAULT NULL,
  PRIMARY KEY (`role_id`),
  KEY `group_id` (`group_id`),
  CONSTRAINT `com_role_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `com_group` (`group_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `com_role` */

insert  into `com_role`(`role_id`,`group_id`,`role_nm`,`role_desc`,`default_page`,`mdb`,`crd`,`mdd`) values ('01001','01','Developer','Pembuat aplikasi','home/developer','1605200001',NULL,'2016-05-22 18:56:37'),('02001','02','Operator','Operator','home/operator','1909160001','2019-09-25 09:40:27','2019-09-25 09:40:27');

/*Table structure for table `com_role_menu` */

DROP TABLE IF EXISTS `com_role_menu`;

CREATE TABLE `com_role_menu` (
  `role_id` varchar(5) NOT NULL,
  `nav_id` varchar(10) NOT NULL,
  `role_tp` varchar(4) NOT NULL DEFAULT '1111',
  PRIMARY KEY (`nav_id`,`role_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `com_role_menu_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `com_role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `com_role_menu_ibfk_2` FOREIGN KEY (`nav_id`) REFERENCES `com_menu` (`nav_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `com_role_menu` */

insert  into `com_role_menu`(`role_id`,`nav_id`,`role_tp`) values ('01001','1000000002','1111'),('01001','1000000004','1111'),('01001','1000000005','1111'),('01001','1000000006','1111'),('01001','1000000007','1111'),('01001','1000000009','1111'),('01001','1000000181','1111'),('01001','1000000182','1111');

/*Table structure for table `com_role_user` */

DROP TABLE IF EXISTS `com_role_user`;

CREATE TABLE `com_role_user` (
  `user_id` varchar(10) NOT NULL,
  `role_id` varchar(5) NOT NULL,
  `role_default` enum('1','2') DEFAULT '2',
  `role_display` enum('1','0') DEFAULT '1',
  PRIMARY KEY (`user_id`,`role_id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `com_role_user_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `com_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `com_role_user_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `com_role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `com_role_user` */

insert  into `com_role_user`(`user_id`,`role_id`,`role_default`,`role_display`) values ('1909160001','01001','1','1');

/*Table structure for table `com_user` */

DROP TABLE IF EXISTS `com_user`;

CREATE TABLE `com_user` (
  `user_id` varchar(10) NOT NULL,
  `user_alias` varchar(50) DEFAULT NULL,
  `user_name` varchar(50) DEFAULT NULL,
  `user_pass` varchar(255) DEFAULT NULL,
  `user_key` varchar(50) DEFAULT NULL,
  `user_mail` varchar(50) DEFAULT NULL,
  `user_img_name` varchar(255) DEFAULT NULL,
  `user_img_path` varchar(255) DEFAULT NULL,
  `user_st` enum('1','0','2') DEFAULT '0',
  `user_completed` enum('1','0') DEFAULT '0',
  `mdb` varchar(10) DEFAULT NULL,
  `mdb_name` varchar(50) DEFAULT NULL,
  `mdd` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `com_user` */

insert  into `com_user`(`user_id`,`user_alias`,`user_name`,`user_pass`,`user_key`,`user_mail`,`user_img_name`,`user_img_path`,`user_st`,`user_completed`,`mdb`,`mdb_name`,`mdd`) values ('1909160001','Developer','armisianto.othermail@gmail.com','$2y$10$ZLt5ejssvMN1PigMxTELDeAef7HBbeGCd9lCXwGhIBWUQ2u653DrC','846467','armisianto.othermail@gmail.com','1804170001_20190130042637.jpg','resource/doc/images/users/','1','1','1','Armisianto','2014-08-06 10:00:52'),('1909160002','Operator','armisianto@gmail.com','$2y$10$ZLt5ejssvMN1PigMxTELDeAef7HBbeGCd9lCXwGhIBWUQ2u653DrC','846467','armisianto@gmail.com','1804170001_20190130042637.jpg','resource/doc/images/users/','1','1','1','Armisianto','2014-08-06 10:00:52');

/*Table structure for table `com_user_login` */

DROP TABLE IF EXISTS `com_user_login`;

CREATE TABLE `com_user_login` (
  `user_id` varchar(10) NOT NULL,
  `login_date` datetime NOT NULL,
  `logout_date` datetime DEFAULT NULL,
  `ip_address` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`user_id`,`login_date`),
  CONSTRAINT `com_user_login_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `com_user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `com_user_login` */

insert  into `com_user_login`(`user_id`,`login_date`,`logout_date`,`ip_address`) values ('1909160001','2019-01-30 16:36:40','2019-01-30 16:37:07','::1'),('1909160001','2019-04-12 15:59:29',NULL,'::1'),('1909160001','2019-04-15 13:16:54','2019-04-15 15:42:29','::1');

/*Table structure for table `com_user_super` */

DROP TABLE IF EXISTS `com_user_super`;

CREATE TABLE `com_user_super` (
  `user_id` varchar(10) NOT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `com_user_super_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `com_user` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `com_user_super` */

insert  into `com_user_super`(`user_id`) values ('1');

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_09_15_032737_create_videos_table',1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
