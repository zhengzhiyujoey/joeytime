-- MySQL dump 10.13  Distrib 5.6.20, for linux-glibc2.5 (x86_64)
--
-- Host: localhost    Database: mezok_13820609_joeytime
-- ------------------------------------------------------
-- Server version	5.6.20

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
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `groups` int(11) DEFAULT NULL,
  `disabled` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'joey','180547ca0cd2adaff68217e1f29ef1f6',1,0),(2,'admin','180547ca0cd2adaff68217e1f29ef1f6',1,0);
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admingroup`
--

DROP TABLE IF EXISTS `admingroup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admingroup` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(64) NOT NULL DEFAULT '',
  `purview` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admingroup`
--

LOCK TABLES `admingroup` WRITE;
/*!40000 ALTER TABLE `admingroup` DISABLE KEYS */;
INSERT INTO `admingroup` VALUES (1,'super manager',''),(2,'content manager','');
/*!40000 ALTER TABLE `admingroup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `body` text,
  `image` varchar(128) DEFAULT NULL,
  `sort_ids` varchar(64) DEFAULT '',
  `recommended` tinyint(4) DEFAULT '0',
  `author` varchar(32) NOT NULL DEFAULT '',
  `addtime` varchar(32) DEFAULT NULL,
  `uptime` varchar(32) DEFAULT NULL,
  `letter` varchar(4) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (1,'åª³å¦‡å„¿','    è¿™æ˜¯æ”¹ç‰ˆçš„ç¬¬ä¸€ç¯‡ï¼Œå†™ç»™æˆ‘çš„åª³å¦‡å„¿ã€‚åœ¨è¿‡å‡ å¤©å°±å¿«æ˜¯100å¤©äº†ï¼Œååˆ†ä¹‹ä¸€ï¼Œå“ˆå“ˆã€‚\r\nä¸æƒ³ç»™å¤ªå¤šçš„é™ˆè¯ºï¼Œå› ä¸ºæˆ‘æ€•åšä¸åˆ°ï¼Œåªæ˜¯æƒ³å¥½å¥½çæƒœçœ¼å‰ï¼ŒåŠªåŠ›åŠªåŠ›ï¼Œç»™ä½ ä¸€ä¸ªå®Œç¾Žçš„æ˜Žå¤©ã€‚å› ä¸ºæˆ‘å¾ˆçˆ±å¾ˆçˆ±ä½ ã€‚',NULL,'2',1,'joey',NULL,'1414930720','x'),(2,'dfï¼Œdu å‘½ä»¤ä¹‹linux ','df æ˜¾ç¤ºæœåŠ¡å™¨æ–‡ä»¶ç³»ç»Ÿç£ç›˜å ç”¨æƒ…å†µ\r\n-h(Hä¸€æ ·)\r\n-T æ˜¾ç¤ºç£ç›˜ç±»åž‹\r\ndu æŸ¥çœ‹æ–‡ä»¶æˆ–ç£ç›˜å¤§å°\r\n-h   æœ€åŽä¸€è¡ŒçŽ°å®žçš„æ˜¯æ€»å¤§å°\r\n-c   æ˜¾ç¤ºå¤šä¸ªæ–‡ä»¶å¤§å°\r\n',NULL,'1',0,'joey','1414424652','1414500326','d'),(3,'which  whereis   find  locate','linux ä¸‹æŸ¥æ‰¾\r\nwhich æŸ¥æ‰¾ç³»ç»Ÿå‘½ä»¤æ‰€åœ¨çš„ç›®å½•\r\nwhereis   æŸ¥æ‰¾å®‰è£…è¿‡çš„ç¨‹åºæ‰€åœ¨ç›®å½•\r\nlocate  find æŸ¥æ‰¾æ–‡ä»¶å',NULL,'1',0,'joey','1414424652','1414500329','w'),(4,'æ€§æ ¼ç›²ç‚¹','1.  åŠžäº‹èƒ½åŠ›ä¸è¶³ï¼Œäº‹æƒ…åŠžçš„ä¸æ¼‚äº®ï¼Œåšäº‹è®¤çœŸï¼Œæœ‰å¤´æœ‰å°¾ã€‚\r\n2.  æ„å¿—åŠ›ä¸å¤Ÿåšå¼ºï¼Œåšäº‹æ— æ³•åšæŒ\r\n3.  äº¤å‹èƒ½åŠ›ä¸å¤Ÿï¼Œä¸å¤Ÿä¸»åŠ¨\r\n4.   çŸ¥è¯†é¢ä¸å¤Ÿå¹¿ ',NULL,'2',1,'joey',NULL,'1414929374','x'),(5,'gitç®€å•å°ç»“','1. æœ¬åœ°æ­å»ºgitï¼Œapt-get install git  æäº¤åˆ°github\r\n2. æœ¬åœ°è¿˜æœ‰githubä¸Šå„è‡ªå»ºç«‹ä»“åº“\r\n3. åˆå§‹åŒ–æœ¬åœ°ä»“åº“ å³git init ç„¶åŽï¼Œé…ç½®\r\ngit config --global user.name &quot;Your Name &quot; \r\ngit config --global user.email  &quot;Your Email&quot;\r\n4. ç”Ÿæˆkey ssh-keygen -t rsa -C &quot;email&quot; //é‚®ç®±åŒä¸Š\r\n //å¤åˆ¶é‡Œé¢çš„å¯†é’¥ .ssh/id_rsa.pub ç™»é™†åˆ°githubä¸Š,ç„¶åŽå°†å¤åˆ¶çš„å¯†é’¥åŠ å…¥\r\n5.  ssh git@github.com æµ‹è¯•è¿žæŽ¥githubæ˜¯å¦æˆåŠŸ',NULL,'1',0,'joey',NULL,'1414930527','g'),(6,'ubuntu ä¸‹ä¸ºç«ç‹å®‰è£…flash','æ‰‹åŠ¨ä¸‹è½½adobe flashå®‰è£…åŒ…\r\nè§£åŽ‹ï¼Œå°†è§£åŽ‹åŽçš„libflashplayer.so å¤åˆ¶åˆ°/usr/lib/mozilla/plugins/ä¸‹ ï¼Œå°†/usr/å¤åˆ¶åˆ°/usr/ ä¸‹\r\né‡å¯ç«ç‹ï¼Œå°±okäº†ã€‚',NULL,'1',0,'joey',NULL,'1414938991','u');
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sentence`
--

DROP TABLE IF EXISTS `sentence`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sentence` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `body` text,
  `sort_ids` varchar(64) DEFAULT '',
  `recommended` tinyint(4) DEFAULT '0',
  `author` varchar(32) NOT NULL DEFAULT '',
  `addtime` varchar(32) DEFAULT NULL,
  `uptime` varchar(32) DEFAULT NULL,
  `letter` varchar(4) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sentence`
--

LOCK TABLES `sentence` WRITE;
/*!40000 ALTER TABLE `sentence` DISABLE KEYS */;
INSERT INTO `sentence` VALUES (1,'one day one linux commend','1',0,'joey',NULL,'1414502295','b'),(2,'å½©è™¹å¤©å ‚','1',0,'joey',NULL,'1414502299',''),(3,'hahaha','1',0,'joey',NULL,'1414502301',''),(4,'ddddddddddddddddddd','1',0,'joey',NULL,'1414502304',''),(5,'come on ,joeytime','2',0,'joey',NULL,'1414502314','c'),(6,'åˆæ¬¡ç™»é™†','2',0,'admin','1414502675','1414502675','c');
/*!40000 ALTER TABLE `sentence` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sort`
--

DROP TABLE IF EXISTS `sort`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sort` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) DEFAULT NULL,
  `mappath` varchar(32) DEFAULT NULL,
  `parentid` tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sort`
--

LOCK TABLES `sort` WRITE;
/*!40000 ALTER TABLE `sort` DISABLE KEYS */;
INSERT INTO `sort` VALUES (1,'work','work',NULL),(2,'life','life',NULL),(3,'photo','photo',NULL);
/*!40000 ALTER TABLE `sort` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-11-29 15:08:00
