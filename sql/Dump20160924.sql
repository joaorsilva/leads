-- MySQL dump 10.13  Distrib 5.7.9, for Win64 (x86_64)
--
-- Host: 192.168.0.252    Database: leads
-- ------------------------------------------------------
-- Server version	5.7.13-0ubuntu0.16.04.2

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
-- Table structure for table `app_actions`
--

DROP TABLE IF EXISTS `app_actions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_actions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_modules_id` int(10) unsigned NOT NULL,
  `app_controllers_id` int(10) unsigned NOT NULL,
  `name` varchar(128) NOT NULL,
  `key` varchar(32) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `updated_date` datetime NOT NULL,
  `deleted_by` int(10) unsigned DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_actions`
--

LOCK TABLES `app_actions` WRITE;
/*!40000 ALTER TABLE `app_actions` DISABLE KEYS */;
/*!40000 ALTER TABLE `app_actions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_controllers`
--

DROP TABLE IF EXISTS `app_controllers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_controllers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `app_modules_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `key` varchar(32) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `updated_date` datetime NOT NULL,
  `deleted_by` int(10) unsigned DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_controllers`
--

LOCK TABLES `app_controllers` WRITE;
/*!40000 ALTER TABLE `app_controllers` DISABLE KEYS */;
INSERT INTO `app_controllers` VALUES (1,2,'Modules','bf17ac149e2e7a530c677e9bd51d3fd2',1,1,'0000-00-00 00:00:00',1,'2016-09-10 14:19:18',NULL,NULL,0),(2,3,'Controller 2','48ed192757d1bc6d4a36d16a10893f48',1,0,'2016-09-10 14:20:46',0,'2016-09-10 14:20:46',NULL,NULL,0);
/*!40000 ALTER TABLE `app_controllers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `app_modules`
--

DROP TABLE IF EXISTS `app_modules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `app_modules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `key` varchar(32) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `updated_date` datetime NOT NULL,
  `deleted_by` int(10) unsigned DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idnew_table_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `app_modules`
--

LOCK TABLES `app_modules` WRITE;
/*!40000 ALTER TABLE `app_modules` DISABLE KEYS */;
INSERT INTO `app_modules` VALUES (2,'Application','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-06-19 20:27:01',1,'2016-06-19 20:27:01',NULL,NULL,0),(3,'User','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-06-25 15:27:27',1,'2016-06-25 15:27:27',NULL,NULL,0),(4,'Unit','19c562a36aeb455d09534f93b4f5236f',1,2,'2016-06-25 16:20:33',2,'2016-09-09 18:34:50',NULL,NULL,0),(5,'Module 2','fae35184cc9121db497af2423562ef05',1,2,'2016-06-30 21:13:16',2,'2016-09-09 18:34:57',NULL,NULL,0),(6,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,2,'2016-06-30 21:13:16',2,'2016-07-06 19:19:05',NULL,NULL,0),(7,'Modle 1','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 12:56:19',1,'2016-09-09 12:56:19',NULL,NULL,0),(8,'Modle 1','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 13:25:43',1,'2016-09-09 13:25:43',NULL,NULL,0),(9,'Modle 1','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'0000-00-00 00:00:00',2,'2016-09-20 21:36:19',NULL,NULL,0),(10,'Modle 1','c65d9e700f641fa9a8e62c8a35516ccf',1,2,'0000-00-00 00:00:00',2,'2016-09-20 20:59:51',NULL,NULL,0),(11,'Modle 1','c65d9e700f641fa9a8e62c8a35516ccf',1,2,'0000-00-00 00:00:00',2,'2016-09-20 21:35:27',2,'2016-09-20 21:35:27',1),(12,'Modle 1','c65d9e700f641fa9a8e62c8a35516ccf',1,0,'0000-00-00 00:00:00',0,'2016-09-20 20:48:00',NULL,'2016-09-20 20:48:00',1),(13,'Modle 1','c65d9e700f641fa9a8e62c8a35516ccf',1,0,'0000-00-00 00:00:00',0,'2016-09-20 20:48:00',NULL,'2016-09-20 20:48:00',1),(14,'Modle 1','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 13:36:04',1,'2016-09-09 13:36:04',NULL,NULL,0),(15,'Modle 1','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 13:38:17',1,'2016-09-09 13:38:17',NULL,NULL,0),(16,'Module 1','841f9c6750a0cbaa28dcceeaff197733',1,1,'2016-09-09 13:40:32',1,'2016-09-09 20:54:12',NULL,NULL,0),(17,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 13:43:29',1,'2016-09-09 13:43:29',NULL,'2016-09-09 13:43:29',1),(18,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 13:46:33',1,'2016-09-09 13:46:33',NULL,'2016-09-09 13:46:33',1),(19,'Teste','8e6f6f815b50f474cf0dc22d4f400725',0,0,'0000-00-00 00:00:00',0,'2016-09-09 17:31:04',NULL,'2016-09-09 17:31:04',1),(20,'Teste','8e6f6f815b50f474cf0dc22d4f400725',0,0,'0000-00-00 00:00:00',0,'2016-09-09 17:30:50',NULL,'2016-09-09 17:30:50',1),(21,'Teste','8e6f6f815b50f474cf0dc22d4f400725',0,0,'0000-00-00 00:00:00',0,'2016-09-09 17:30:34',NULL,'2016-09-09 17:30:34',1),(22,'Teste','8e6f6f815b50f474cf0dc22d4f400725',0,0,'0000-00-00 00:00:00',0,'2016-09-09 17:32:59',NULL,'2016-09-09 17:32:59',1),(23,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 21:56:32',1,'2016-09-09 21:56:32',NULL,'2016-09-09 21:56:32',1),(24,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 21:58:07',1,'2016-09-09 21:58:07',NULL,'2016-09-09 21:58:07',1),(25,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:05:02',1,'2016-09-09 22:05:02',NULL,'2016-09-09 22:05:02',1),(26,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:05:52',1,'2016-09-09 22:05:52',NULL,'2016-09-09 22:05:52',1),(27,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:07:30',1,'2016-09-09 22:07:30',NULL,'2016-09-09 22:07:30',1),(28,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:07:39',1,'2016-09-09 22:07:39',NULL,'2016-09-09 22:07:39',1),(29,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:08:05',1,'2016-09-09 22:08:05',NULL,'2016-09-09 22:08:05',1),(30,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:08:06',1,'2016-09-09 22:08:06',NULL,'2016-09-09 22:08:06',1),(31,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:08:08',1,'2016-09-09 22:08:08',NULL,'2016-09-09 22:08:08',1),(32,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:08:10',1,'2016-09-09 22:08:10',NULL,'2016-09-09 22:08:10',1),(33,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:08:12',1,'2016-09-09 22:08:12',NULL,'2016-09-09 22:08:12',1),(34,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:08:13',1,'2016-09-09 22:08:13',NULL,'2016-09-09 22:08:13',1),(35,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:08:15',1,'2016-09-09 22:08:15',NULL,'2016-09-09 22:08:15',1),(36,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:08:17',1,'2016-09-09 22:08:17',NULL,'2016-09-09 22:08:17',1),(37,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:08:19',1,'2016-09-09 22:08:19',NULL,'2016-09-09 22:08:19',1),(38,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:08:21',1,'2016-09-09 22:08:21',NULL,'2016-09-09 22:08:21',1),(39,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:08:23',1,'2016-09-09 22:08:23',NULL,'2016-09-09 22:08:23',1),(40,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:08:24',1,'2016-09-09 22:08:24',NULL,'2016-09-09 22:08:24',1),(41,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:08:26',1,'2016-09-09 22:08:26',NULL,'2016-09-09 22:08:26',1),(42,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:08:28',1,'2016-09-09 22:08:28',NULL,'2016-09-09 22:08:28',1),(43,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:08:30',1,'2016-09-09 22:08:30',NULL,'2016-09-09 22:08:30',1),(44,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:08:32',1,'2016-09-09 22:08:32',NULL,'2016-09-09 22:08:32',1),(45,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:08:34',1,'2016-09-09 22:08:34',NULL,'2016-09-09 22:08:34',1),(46,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:08:36',1,'2016-09-09 22:08:36',NULL,'2016-09-09 22:08:36',1),(47,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:08:37',1,'2016-09-09 22:08:37',NULL,'2016-09-09 22:08:37',1),(48,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:08:39',1,'2016-09-09 22:08:39',NULL,'2016-09-09 22:08:39',1),(49,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:08:41',1,'2016-09-09 22:08:41',NULL,'2016-09-09 22:08:41',1),(50,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:08:43',1,'2016-09-09 22:08:43',NULL,'2016-09-09 22:08:43',1),(51,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:08:45',1,'2016-09-09 22:08:45',NULL,'2016-09-09 22:08:45',1),(52,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:08:47',1,'2016-09-09 22:08:47',NULL,'2016-09-09 22:08:47',1),(53,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:08:48',1,'2016-09-09 22:08:48',NULL,'2016-09-09 22:08:48',1),(54,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:08:50',1,'2016-09-09 22:08:50',NULL,'2016-09-09 22:08:50',1),(55,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:08:52',1,'2016-09-09 22:08:52',NULL,'2016-09-09 22:08:52',1),(56,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:08:54',1,'2016-09-09 22:08:54',NULL,'2016-09-09 22:08:54',1),(57,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:08:56',1,'2016-09-09 22:08:56',NULL,'2016-09-09 22:08:56',1),(58,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:08:58',1,'2016-09-09 22:08:58',NULL,'2016-09-09 22:08:58',1),(59,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:08:59',1,'2016-09-09 22:08:59',NULL,'2016-09-09 22:08:59',1),(60,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:09:01',1,'2016-09-09 22:09:01',NULL,'2016-09-09 22:09:01',1),(61,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:09:03',1,'2016-09-09 22:09:03',NULL,'2016-09-09 22:09:03',1),(62,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:09:05',1,'2016-09-09 22:09:05',NULL,'2016-09-09 22:09:05',1),(63,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:09:07',1,'2016-09-09 22:09:07',NULL,'2016-09-09 22:09:07',1),(64,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:09:09',1,'2016-09-09 22:09:09',NULL,'2016-09-09 22:09:09',1),(65,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:09:10',1,'2016-09-09 22:09:10',NULL,'2016-09-09 22:09:10',1),(66,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:09:12',1,'2016-09-09 22:09:12',NULL,'2016-09-09 22:09:12',1),(67,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:09:14',1,'2016-09-09 22:09:14',NULL,'2016-09-09 22:09:14',1),(68,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:09:16',1,'2016-09-09 22:09:16',NULL,'2016-09-09 22:09:16',1),(69,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:09:18',1,'2016-09-09 22:09:18',NULL,'2016-09-09 22:09:18',1),(70,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:09:20',1,'2016-09-09 22:09:20',NULL,'2016-09-09 22:09:20',1),(71,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:09:21',1,'2016-09-09 22:09:21',NULL,'2016-09-09 22:09:21',1),(72,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:09:23',1,'2016-09-09 22:09:23',NULL,'2016-09-09 22:09:23',1),(73,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:09:25',1,'2016-09-09 22:09:25',NULL,'2016-09-09 22:09:25',1),(74,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:09:27',1,'2016-09-09 22:09:27',NULL,'2016-09-09 22:09:27',1),(75,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:09:29',1,'2016-09-09 22:09:29',NULL,'2016-09-09 22:09:29',1),(76,'Modle 2','c65d9e700f641fa9a8e62c8a35516ccf',1,1,'2016-09-09 22:09:31',1,'2016-09-09 22:09:31',NULL,'2016-09-09 22:09:31',1);
/*!40000 ALTER TABLE `app_modules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_boards`
--

DROP TABLE IF EXISTS `lead_boards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_boards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `unit_organizations_id` int(10) unsigned NOT NULL,
  `name` varchar(64) NOT NULL,
  `description_key` varchar(45) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `updated_date` datetime NOT NULL,
  `deleted_by` int(10) unsigned DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idlead_board_UNIQUE` (`id`),
  UNIQUE KEY `idx_lead_boards_UNIQUE` (`unit_organizations_id`,`name`),
  KEY `fk_lead_boards_unit_idx` (`unit_organizations_id`),
  CONSTRAINT `fk_lead_boards_unit` FOREIGN KEY (`unit_organizations_id`) REFERENCES `unit_organizations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_boards`
--

LOCK TABLES `lead_boards` WRITE;
/*!40000 ALTER TABLE `lead_boards` DISABLE KEYS */;
/*!40000 ALTER TABLE `lead_boards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_event_types`
--

DROP TABLE IF EXISTS `lead_event_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_event_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `unit_organizations_id` int(10) unsigned NOT NULL,
  `name` varchar(64) NOT NULL,
  `description_key` varchar(45) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `updated_date` datetime NOT NULL,
  `deleted_by` int(10) unsigned DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `idx_lead_event_types_UNIQUE` (`unit_organizations_id`,`name`),
  CONSTRAINT `idx_lead_event_types_unit` FOREIGN KEY (`unit_organizations_id`) REFERENCES `unit_organizations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_event_types`
--

LOCK TABLES `lead_event_types` WRITE;
/*!40000 ALTER TABLE `lead_event_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `lead_event_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_events`
--

DROP TABLE IF EXISTS `lead_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lead_event_types_id` int(10) unsigned NOT NULL,
  `lead_leads_id` int(10) unsigned NOT NULL,
  `lead_messages_id` int(10) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `updated_date` datetime NOT NULL,
  `deleted_by` int(10) unsigned DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_events`
--

LOCK TABLES `lead_events` WRITE;
/*!40000 ALTER TABLE `lead_events` DISABLE KEYS */;
/*!40000 ALTER TABLE `lead_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_field_types`
--

DROP TABLE IF EXISTS `lead_field_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_field_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `description_key` varchar(45) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `updated_date` datetime NOT NULL,
  `deleted_by` int(10) unsigned DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idlead_field_types_UNIQUE` (`id`),
  UNIQUE KEY `idx_lead_field_types_UNIQUE` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_field_types`
--

LOCK TABLES `lead_field_types` WRITE;
/*!40000 ALTER TABLE `lead_field_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `lead_field_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_flows`
--

DROP TABLE IF EXISTS `lead_flows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_flows` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `unit_organizations_id` int(10) unsigned NOT NULL,
  `lead_boards_id` int(10) unsigned NOT NULL,
  `lead_steps_id` int(10) unsigned NOT NULL,
  `destination_organizations_id` int(10) unsigned NOT NULL,
  `deatination_boards_id` int(10) unsigned NOT NULL,
  `destination_steps_id` int(10) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `updated_date` datetime NOT NULL,
  `deleted_by` int(10) unsigned DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `idx_lead_flows_UNIQUE` (`unit_organizations_id`,`lead_boards_id`,`lead_steps_id`,`destination_organizations_id`,`deatination_boards_id`,`destination_steps_id`),
  KEY `idx_lead_flows_boards1_idx` (`lead_boards_id`),
  KEY `idx_lead_flows_steps1_idx` (`lead_steps_id`),
  KEY `idx_lead_flows_steps2_idx1` (`destination_steps_id`),
  KEY `idx_lead_flows_boards3_idx` (`deatination_boards_id`),
  KEY `idx_lead_flows_units3_idx` (`destination_organizations_id`),
  CONSTRAINT `idx_lead_flows_boards1` FOREIGN KEY (`lead_boards_id`) REFERENCES `lead_boards` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idx_lead_flows_boards3` FOREIGN KEY (`deatination_boards_id`) REFERENCES `lead_boards` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idx_lead_flows_steps1` FOREIGN KEY (`lead_steps_id`) REFERENCES `lead_steps` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idx_lead_flows_units1` FOREIGN KEY (`unit_organizations_id`) REFERENCES `unit_organizations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `idx_lead_flows_units3` FOREIGN KEY (`destination_organizations_id`) REFERENCES `unit_organizations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_flows`
--

LOCK TABLES `lead_flows` WRITE;
/*!40000 ALTER TABLE `lead_flows` DISABLE KEYS */;
/*!40000 ALTER TABLE `lead_flows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_leads`
--

DROP TABLE IF EXISTS `lead_leads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_leads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `unit_organizations_id` int(10) unsigned NOT NULL,
  `lead_origins_id` int(10) unsigned NOT NULL,
  `lead_status_id` int(10) unsigned NOT NULL,
  `lead_subjects_id` int(10) unsigned NOT NULL,
  `lead_steps_id` int(10) unsigned NOT NULL,
  `owner_id` int(10) unsigned DEFAULT NULL,
  `lead_priorities_id` int(10) unsigned NOT NULL,
  `cnt_contact_id` int(10) unsigned DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(14) DEFAULT NULL,
  `other` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `updated_date` datetime NOT NULL,
  `deleted_by` int(10) unsigned DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_lead_leads_unit_idx` (`unit_organizations_id`),
  KEY `fk_lead_leads_origin_idx` (`lead_origins_id`),
  KEY `fk_lead_leads_status_idx` (`lead_status_id`),
  KEY `fk_lead_leads_subject_idx` (`lead_subjects_id`),
  KEY `fk_lead_leads_step_idx` (`lead_steps_id`),
  KEY `fk_lead_leads_user_idx` (`owner_id`),
  KEY `fk_lead_leads_priority_idx` (`lead_priorities_id`),
  CONSTRAINT `fk_lead_leads_origin` FOREIGN KEY (`lead_origins_id`) REFERENCES `lead_origins` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lead_leads_priority` FOREIGN KEY (`lead_priorities_id`) REFERENCES `lead_priorities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lead_leads_status` FOREIGN KEY (`lead_status_id`) REFERENCES `lead_status` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lead_leads_step` FOREIGN KEY (`lead_steps_id`) REFERENCES `lead_steps` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lead_leads_subject` FOREIGN KEY (`lead_subjects_id`) REFERENCES `lead_subjects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lead_leads_unit` FOREIGN KEY (`unit_organizations_id`) REFERENCES `unit_organizations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lead_leads_user` FOREIGN KEY (`owner_id`) REFERENCES `user_users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_leads`
--

LOCK TABLES `lead_leads` WRITE;
/*!40000 ALTER TABLE `lead_leads` DISABLE KEYS */;
/*!40000 ALTER TABLE `lead_leads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_messages`
--

DROP TABLE IF EXISTS `lead_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_messages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lead_leads_id` int(10) unsigned NOT NULL,
  `origin_id` int(10) unsigned NOT NULL,
  `destination_id` int(10) unsigned NOT NULL,
  `message` text NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `updated_date` datetime NOT NULL,
  `deleted_by` int(10) unsigned DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `fk_lead_messages_lead_idx` (`lead_leads_id`),
  CONSTRAINT `fk_lead_messages_lead` FOREIGN KEY (`lead_leads_id`) REFERENCES `lead_leads` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_messages`
--

LOCK TABLES `lead_messages` WRITE;
/*!40000 ALTER TABLE `lead_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `lead_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_origins`
--

DROP TABLE IF EXISTS `lead_origins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_origins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `unit_organizations_id` int(10) unsigned NOT NULL,
  `name` varchar(64) NOT NULL,
  `description_key` varchar(45) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `updated_date` datetime NOT NULL,
  `deleted_by` int(10) unsigned DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idlead_origins_UNIQUE` (`id`),
  UNIQUE KEY `idx_lead_origins_UNIQUE` (`unit_organizations_id`,`name`),
  KEY `fk_lead_origins_units_idx` (`unit_organizations_id`),
  CONSTRAINT `fk_lead_origins_units` FOREIGN KEY (`unit_organizations_id`) REFERENCES `unit_organizations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_origins`
--

LOCK TABLES `lead_origins` WRITE;
/*!40000 ALTER TABLE `lead_origins` DISABLE KEYS */;
/*!40000 ALTER TABLE `lead_origins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_priorities`
--

DROP TABLE IF EXISTS `lead_priorities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_priorities` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `unit_orgazinations_id` int(10) unsigned NOT NULL,
  `name` varchar(64) NOT NULL,
  `description_key` varchar(45) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `updated_date` datetime NOT NULL,
  `deleted_by` int(10) unsigned DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  `priority` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  KEY `idx_lead_priorities_UNIQUE` (`unit_orgazinations_id`,`name`),
  CONSTRAINT `fk_lead_priorities_unit` FOREIGN KEY (`unit_orgazinations_id`) REFERENCES `unit_organizations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_priorities`
--

LOCK TABLES `lead_priorities` WRITE;
/*!40000 ALTER TABLE `lead_priorities` DISABLE KEYS */;
/*!40000 ALTER TABLE `lead_priorities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_status`
--

DROP TABLE IF EXISTS `lead_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `unit_organizations_id` int(10) unsigned NOT NULL,
  `name` varchar(64) NOT NULL,
  `description_key` varchar(45) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `updated_date` datetime NOT NULL,
  `deleted_by` int(10) unsigned DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idlead_status_UNIQUE` (`id`),
  UNIQUE KEY `idx_lead_status_UNIQUE` (`unit_organizations_id`,`name`),
  KEY `fk_lead_status_unit_idx` (`unit_organizations_id`),
  CONSTRAINT `fk_lead_status_unit` FOREIGN KEY (`unit_organizations_id`) REFERENCES `unit_organizations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_status`
--

LOCK TABLES `lead_status` WRITE;
/*!40000 ALTER TABLE `lead_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `lead_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_step_field_values`
--

DROP TABLE IF EXISTS `lead_step_field_values`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_step_field_values` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `lead_leads_id` int(10) unsigned NOT NULL,
  `lead_step_fields_id` int(10) unsigned NOT NULL,
  `val_int` int(11) DEFAULT NULL,
  `val_char` varchar(255) DEFAULT NULL,
  `val_text` text,
  `val_bool` tinyint(1) DEFAULT NULL,
  `val_decimal` decimal(15,3) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `updated_date` datetime NOT NULL,
  `deleted_by` int(10) unsigned DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idlead_step_field_values_UNIQUE` (`id`),
  KEY `lead_step_field_values_UNIQUE` (`lead_leads_id`,`lead_step_fields_id`),
  KEY `fk_lead_step_field_values_step_idx` (`lead_step_fields_id`),
  KEY `fk_lead_step_field_values_lead_idx` (`lead_leads_id`),
  CONSTRAINT `fk_lead_step_field_values_lead` FOREIGN KEY (`lead_leads_id`) REFERENCES `lead_leads` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lead_step_field_values_step` FOREIGN KEY (`lead_step_fields_id`) REFERENCES `lead_step_fields` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_step_field_values`
--

LOCK TABLES `lead_step_field_values` WRITE;
/*!40000 ALTER TABLE `lead_step_field_values` DISABLE KEYS */;
/*!40000 ALTER TABLE `lead_step_field_values` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_step_fields`
--

DROP TABLE IF EXISTS `lead_step_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_step_fields` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `lead_field_types_id` int(10) unsigned NOT NULL,
  `unit_organizations_id` int(10) unsigned NOT NULL,
  `lead_subjects_id` int(10) unsigned NOT NULL,
  `lead_steps_id` int(10) unsigned NOT NULL,
  `field_caption` varchar(64) NOT NULL,
  `field_name` varchar(64) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `updated_date` datetime NOT NULL,
  `deleted_by` int(10) unsigned DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idlead_type_fields_UNIQUE` (`id`),
  UNIQUE KEY `idx_lead_step_fields_UNIQUE` (`lead_field_types_id`,`unit_organizations_id`,`lead_subjects_id`,`lead_steps_id`,`field_name`),
  KEY `fk_lead_step_fields_parent_idx` (`parent_id`),
  KEY `fk_lead_step_fields_type_idx` (`lead_field_types_id`),
  KEY `fk_lead_step_fields_unit_idx` (`unit_organizations_id`),
  KEY `fk_lead_step_fields_steps_idx` (`lead_steps_id`),
  KEY `fk_lead_step_fields_subjects_idx` (`lead_subjects_id`),
  CONSTRAINT `fk_lead_step_fields_parent` FOREIGN KEY (`parent_id`) REFERENCES `lead_step_fields` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lead_step_fields_steps` FOREIGN KEY (`lead_steps_id`) REFERENCES `lead_steps` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lead_step_fields_type` FOREIGN KEY (`lead_field_types_id`) REFERENCES `lead_field_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lead_step_fields_unit` FOREIGN KEY (`unit_organizations_id`) REFERENCES `unit_organizations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fl_lead_step_fields_subjects` FOREIGN KEY (`lead_subjects_id`) REFERENCES `lead_subjects` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_step_fields`
--

LOCK TABLES `lead_step_fields` WRITE;
/*!40000 ALTER TABLE `lead_step_fields` DISABLE KEYS */;
/*!40000 ALTER TABLE `lead_step_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_steps`
--

DROP TABLE IF EXISTS `lead_steps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_steps` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `unit_organizations_id` int(10) unsigned NOT NULL,
  `lead_boards_id` int(10) unsigned NOT NULL,
  `name` varchar(64) NOT NULL,
  `description_key` varchar(45) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `updated_date` datetime NOT NULL,
  `deleted_by` int(10) unsigned DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`),
  UNIQUE KEY `idx_lead_steps_UNIQUE` (`unit_organizations_id`,`lead_boards_id`,`name`),
  KEY `fk_lead_steps_units_idx` (`unit_organizations_id`),
  KEY `fk_lead_steps_boards_idx` (`lead_boards_id`),
  CONSTRAINT `fk_lead_steps_boards` FOREIGN KEY (`lead_boards_id`) REFERENCES `lead_boards` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_lead_steps_units` FOREIGN KEY (`unit_organizations_id`) REFERENCES `unit_organizations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_steps`
--

LOCK TABLES `lead_steps` WRITE;
/*!40000 ALTER TABLE `lead_steps` DISABLE KEYS */;
/*!40000 ALTER TABLE `lead_steps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_subjects`
--

DROP TABLE IF EXISTS `lead_subjects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_subjects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `unit_organizations_id` int(10) unsigned NOT NULL,
  `name` varchar(64) NOT NULL,
  `description_key` varchar(45) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `updated_date` datetime NOT NULL,
  `deleted_by` int(10) unsigned DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idlead_subjects_UNIQUE` (`id`),
  UNIQUE KEY `idx_lead_subjects_UNIQUE` (`unit_organizations_id`,`name`),
  KEY `fk_lead_subjects_unit_idx` (`unit_organizations_id`),
  CONSTRAINT `fk_lead_subjects_unit` FOREIGN KEY (`unit_organizations_id`) REFERENCES `unit_organizations` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_subjects`
--

LOCK TABLES `lead_subjects` WRITE;
/*!40000 ALTER TABLE `lead_subjects` DISABLE KEYS */;
/*!40000 ALTER TABLE `lead_subjects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unit_organization_types`
--

DROP TABLE IF EXISTS `unit_organization_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unit_organization_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `updated_date` datetime NOT NULL,
  `deleted_by` int(10) unsigned DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit_organization_types`
--

LOCK TABLES `unit_organization_types` WRITE;
/*!40000 ALTER TABLE `unit_organization_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `unit_organization_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unit_organizations`
--

DROP TABLE IF EXISTS `unit_organizations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `unit_organizations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL,
  `unit_organization_types_id` int(10) unsigned NOT NULL,
  `name` varchar(128) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `updated_date` datetime NOT NULL,
  `deleted_by` int(10) unsigned DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idunit_organization_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit_organizations`
--

LOCK TABLES `unit_organizations` WRITE;
/*!40000 ALTER TABLE `unit_organizations` DISABLE KEYS */;
/*!40000 ALTER TABLE `unit_organizations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_assigned_organizations`
--

DROP TABLE IF EXISTS `user_assigned_organizations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_assigned_organizations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `unit_organizations_id` int(10) unsigned NOT NULL,
  `user_users_id` int(10) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `updated_date` datetime NOT NULL,
  `deleted_by` int(10) unsigned DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_assigned_organizations`
--

LOCK TABLES `user_assigned_organizations` WRITE;
/*!40000 ALTER TABLE `user_assigned_organizations` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_assigned_organizations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_assingned_roles`
--

DROP TABLE IF EXISTS `user_assingned_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_assingned_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_roles_id` int(10) unsigned NOT NULL,
  `user_users_id` int(10) unsigned NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `updated_date` datetime NOT NULL,
  `deleted_by` int(10) unsigned DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_assingned_roles`
--

LOCK TABLES `user_assingned_roles` WRITE;
/*!40000 ALTER TABLE `user_assingned_roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_assingned_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_role_permissions`
--

DROP TABLE IF EXISTS `user_role_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_role_permissions` (
  `id` int(10) unsigned NOT NULL,
  `app_modules_id` int(10) unsigned NOT NULL,
  `app_controllers_id` int(10) unsigned NOT NULL,
  `app_actions_id` int(10) unsigned NOT NULL,
  `user_roles_id` int(10) unsigned NOT NULL,
  `name` varchar(128) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `updated_date` datetime NOT NULL,
  `deleted_by` int(10) unsigned DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_role_permissions`
--

LOCK TABLES `user_role_permissions` WRITE;
/*!40000 ALTER TABLE `user_role_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_role_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_roles`
--

DROP TABLE IF EXISTS `user_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `updated_date` datetime NOT NULL,
  `deleted_by` int(10) unsigned DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_roles`
--

LOCK TABLES `user_roles` WRITE;
/*!40000 ALTER TABLE `user_roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_users`
--

DROP TABLE IF EXISTS `user_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(64) NOT NULL,
  `surename` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(1024) NOT NULL,
  `last_login` datetime NOT NULL,
  `last_operation` datetime NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned NOT NULL,
  `created_date` datetime NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `updated_date` datetime NOT NULL,
  `deleted_by` int(10) unsigned DEFAULT NULL,
  `deleted_date` datetime DEFAULT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_users`
--

LOCK TABLES `user_users` WRITE;
/*!40000 ALTER TABLE `user_users` DISABLE KEYS */;
INSERT INTO `user_users` VALUES (1,'The','System','root@spagiweb.com.br','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,1,'2016-06-26 00:00:00',1,'2016-06-26 00:00:00',NULL,NULL,0),(2,'João','Ribeiro da Silva','joao.r.silva@gmail.com','46bc3d91430f90d44b68b1334b9a978e','2016-09-20 18:36:44','2016-09-20 18:36:44',1,1,'2016-06-26 00:00:00',1,'2016-09-20 18:36:44',NULL,NULL,0);
/*!40000 ALTER TABLE `user_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'leads'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-09-24 13:10:47
