CREATE DATABASE  IF NOT EXISTS `library` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `library`;
-- MySQL dump 10.13  Distrib 5.6.23, for Win64 (x86_64)
--
-- Host: localhost    Database: library
-- ------------------------------------------------------
-- Server version	5.6.17

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
-- Table structure for table `audio_book`
--

DROP TABLE IF EXISTS `audio_book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `audio_book` (
  `ABookNo` int(10) NOT NULL,
  `Narrator` varchar(255) DEFAULT NULL,
  `length` time DEFAULT NULL,
  PRIMARY KEY (`ABookNo`),
  CONSTRAINT `audio_book_ibfk_1` FOREIGN KEY (`ABookNo`) REFERENCES `book` (`Barcode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audio_book`
--

LOCK TABLES `audio_book` WRITE;
/*!40000 ALTER TABLE `audio_book` DISABLE KEYS */;
/*!40000 ALTER TABLE `audio_book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `author` (
  `AuthorID` int(10) NOT NULL AUTO_INCREMENT,
  `FName` varchar(255) DEFAULT NULL,
  `MName` varchar(255) DEFAULT NULL,
  `LName` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`AuthorID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `author`
--

LOCK TABLES `author` WRITE;
/*!40000 ALTER TABLE `author` DISABLE KEYS */;
INSERT INTO `author` VALUES (2,'Vladimir',NULL,'Nabokov'),(3,'John',NULL,'Cleland'),(4,'Pauline',NULL,'Reage'),(5,'Pierre','Choderlos','de Laclos'),(6,'Margauerite',NULL,'de Navarre');
/*!40000 ALTER TABLE `author` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `author_books`
--

DROP TABLE IF EXISTS `author_books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `author_books` (
  `AuthorID` int(10) NOT NULL DEFAULT '0',
  `BookNo` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`AuthorID`,`BookNo`),
  KEY `author_books_ibfk_1` (`BookNo`),
  CONSTRAINT `author_books_ibfk_1` FOREIGN KEY (`BookNo`) REFERENCES `book` (`Barcode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `author_books_ibfk_2` FOREIGN KEY (`AuthorID`) REFERENCES `author` (`AuthorID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `author_books`
--

LOCK TABLES `author_books` WRITE;
/*!40000 ALTER TABLE `author_books` DISABLE KEYS */;
INSERT INTO `author_books` VALUES (2,1),(3,3),(2,4),(4,5),(6,7);
/*!40000 ALTER TABLE `author_books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book` (
  `Barcode` int(10) NOT NULL AUTO_INCREMENT,
  `ISBN` char(13) DEFAULT NULL,
  `CallNo` varchar(255) DEFAULT NULL,
  `Title` varchar(255) NOT NULL,
  `Summary` text,
  `BranchNum` int(3) DEFAULT NULL,
  PRIMARY KEY (`Barcode`),
  KEY `book_ibfk_1` (`BranchNum`),
  CONSTRAINT `book_ibfk_1` FOREIGN KEY (`BranchNum`) REFERENCES `branch` (`BranchNo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book`
--

LOCK TABLES `book` WRITE;
/*!40000 ALTER TABLE `book` DISABLE KEYS */;
INSERT INTO `book` VALUES (1,'2147483647','234.12','Lolita','Pedophilia.',2),(3,'1234567899','123.44','Fanny Hill','“Now, disengag’d from the shirt, I saw, with wonder and surprise, what? not the play-thing of a boy, not the weapon of a man, but a maypole of so enormous a standard, that had proportions been observ’d, it must have belong’d to a young giant.”',3),(4,'939242349','840.28','Ada, or Ardor','Incest. Incest. Incest.',3),(5,'2147483646','503.23','The Story of O','Young woman becomes slave of sadomasochistic club in French château.',4),(7,'2034247932','352.37','Heptameron','Short stories, told by women, about their experiences of love in the 15th century. Surprisingly still pretty vivid.',2);
/*!40000 ALTER TABLE `book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book_holds`
--

DROP TABLE IF EXISTS `book_holds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book_holds` (
  `BookNo` int(10) NOT NULL DEFAULT '0',
  `PatronNo` int(9) NOT NULL DEFAULT '0',
  PRIMARY KEY (`BookNo`,`PatronNo`),
  KEY `book_holds_ibfk_2` (`PatronNo`),
  CONSTRAINT `book_holds_ibfk_1` FOREIGN KEY (`BookNo`) REFERENCES `book` (`Barcode`),
  CONSTRAINT `book_holds_ibfk_2` FOREIGN KEY (`PatronNo`) REFERENCES `patron` (`CardNo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_holds`
--

LOCK TABLES `book_holds` WRITE;
/*!40000 ALTER TABLE `book_holds` DISABLE KEYS */;
/*!40000 ALTER TABLE `book_holds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book_ratings`
--

DROP TABLE IF EXISTS `book_ratings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `book_ratings` (
  `BookNo` int(10) NOT NULL DEFAULT '0',
  `PatronNo` int(9) NOT NULL DEFAULT '0',
  `rating` int(1) NOT NULL,
  PRIMARY KEY (`BookNo`,`PatronNo`),
  KEY `book_ratings_ibfk_2` (`PatronNo`),
  CONSTRAINT `book_ratings_ibfk_1` FOREIGN KEY (`BookNo`) REFERENCES `book` (`Barcode`),
  CONSTRAINT `book_ratings_ibfk_2` FOREIGN KEY (`PatronNo`) REFERENCES `patron` (`CardNo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book_ratings`
--

LOCK TABLES `book_ratings` WRITE;
/*!40000 ALTER TABLE `book_ratings` DISABLE KEYS */;
/*!40000 ALTER TABLE `book_ratings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `borrows`
--

DROP TABLE IF EXISTS `borrows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `borrows` (
  `BookNo` int(10) NOT NULL DEFAULT '0',
  `PatronNo` int(9) NOT NULL DEFAULT '0',
  `ReturnDate` date DEFAULT NULL,
  `DueDate` date DEFAULT NULL,
  PRIMARY KEY (`BookNo`,`PatronNo`),
  KEY `borrows_ibfk_2` (`PatronNo`),
  CONSTRAINT `borrows_ibfk_1` FOREIGN KEY (`BookNo`) REFERENCES `book` (`Barcode`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `borrows_ibfk_2` FOREIGN KEY (`PatronNo`) REFERENCES `patron` (`CardNo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `borrows`
--

LOCK TABLES `borrows` WRITE;
/*!40000 ALTER TABLE `borrows` DISABLE KEYS */;
INSERT INTO `borrows` VALUES (4,1,NULL,'2015-04-11'),(5,1,'2015-04-13','0000-00-00');
/*!40000 ALTER TABLE `borrows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `branch`
--

DROP TABLE IF EXISTS `branch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `branch` (
  `BranchNo` int(3) NOT NULL AUTO_INCREMENT,
  `BranchName` varchar(255) DEFAULT NULL,
  `PhoneNo` char(10) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL,
  `PCode` varchar(255) DEFAULT NULL,
  `ManagerSIN` int(9) DEFAULT NULL,
  PRIMARY KEY (`BranchNo`),
  KEY `branch_ibfk_1` (`ManagerSIN`),
  CONSTRAINT `branch_ibfk_1` FOREIGN KEY (`ManagerSIN`) REFERENCES `staff` (`SIN`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `branch`
--

LOCK TABLES `branch` WRITE;
/*!40000 ALTER TABLE `branch` DISABLE KEYS */;
INSERT INTO `branch` VALUES (2,'Tyler Branch','2147483647','5678 Somewhere Street','Calgary','3C2 B1A',NULL),(3,'Youssef Branch','2147483647','9876 Elsewhere Street','Calgary','ABC 123',NULL),(4,'Edel Branch','2147483647','5432 Anywhere','Calgary','123 ABC',NULL);
/*!40000 ALTER TABLE `branch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_attendance`
--

DROP TABLE IF EXISTS `event_attendance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_attendance` (
  `EventName` varchar(255) NOT NULL DEFAULT '',
  `PatronNo` int(9) NOT NULL DEFAULT '0',
  PRIMARY KEY (`EventName`,`PatronNo`),
  KEY `event_attendance_ibfk_2` (`PatronNo`),
  CONSTRAINT `event_attendance_ibfk_1` FOREIGN KEY (`EventName`) REFERENCES `lib_event` (`EventName`),
  CONSTRAINT `event_attendance_ibfk_2` FOREIGN KEY (`PatronNo`) REFERENCES `patron` (`CardNo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_attendance`
--

LOCK TABLES `event_attendance` WRITE;
/*!40000 ALTER TABLE `event_attendance` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_attendance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_staff`
--

DROP TABLE IF EXISTS `event_staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_staff` (
  `EName` varchar(255) NOT NULL DEFAULT '',
  `Staff` int(9) NOT NULL DEFAULT '0',
  PRIMARY KEY (`EName`,`Staff`),
  KEY `Staff` (`Staff`),
  CONSTRAINT `event_staff_ibfk_1` FOREIGN KEY (`EName`) REFERENCES `lib_event` (`EventName`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `event_staff_ibfk_2` FOREIGN KEY (`Staff`) REFERENCES `staff` (`SIN`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_staff`
--

LOCK TABLES `event_staff` WRITE;
/*!40000 ALTER TABLE `event_staff` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `genre`
--

DROP TABLE IF EXISTS `genre`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `genre` (
  `Genre` varchar(255) NOT NULL DEFAULT '',
  `BookNo` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Genre`,`BookNo`),
  KEY `genre_ibfk_1` (`BookNo`),
  CONSTRAINT `genre_ibfk_1` FOREIGN KEY (`BookNo`) REFERENCES `book` (`Barcode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `genre`
--

LOCK TABLES `genre` WRITE;
/*!40000 ALTER TABLE `genre` DISABLE KEYS */;
/*!40000 ALTER TABLE `genre` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `journal`
--

DROP TABLE IF EXISTS `journal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `journal` (
  `JBookNo` int(10) NOT NULL,
  `Institution` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`JBookNo`),
  CONSTRAINT `journal_ibfk_1` FOREIGN KEY (`JBookNo`) REFERENCES `book` (`Barcode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `journal`
--

LOCK TABLES `journal` WRITE;
/*!40000 ALTER TABLE `journal` DISABLE KEYS */;
/*!40000 ALTER TABLE `journal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lib_event`
--

DROP TABLE IF EXISTS `lib_event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lib_event` (
  `EventName` varchar(255) NOT NULL,
  `EDate` datetime DEFAULT NULL,
  `Description` text,
  `BranchNum` int(3) DEFAULT NULL,
  PRIMARY KEY (`EventName`),
  KEY `lib_event_ibfk_1` (`BranchNum`),
  CONSTRAINT `lib_event_ibfk_1` FOREIGN KEY (`BranchNum`) REFERENCES `branch` (`BranchNo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lib_event`
--

LOCK TABLES `lib_event` WRITE;
/*!40000 ALTER TABLE `lib_event` DISABLE KEYS */;
INSERT INTO `lib_event` VALUES ('50 Shades of Beige Screening','2015-09-09 09:00:00','Join us at Branch No 2 for a special screening of 50 Shades of Beige! 18+ only.',3),('Annual Reading Marathon 2015','2015-12-30 12:00:00','Time to sweat your reading muscles. Join to win prizes! Come and have fun.',2),('Gaming Books 2014','0000-00-00 00:00:00','Bring a controller, games, your laptop, board games, or anything else gaming related to the library and chill with other game lovers. Bonus points for \"relevant\" material.',4);
/*!40000 ALTER TABLE `lib_event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patron`
--

DROP TABLE IF EXISTS `patron`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patron` (
  `CardNo` int(9) NOT NULL AUTO_INCREMENT,
  `FName` varchar(255) DEFAULT NULL,
  `MName` varchar(255) DEFAULT NULL,
  `LName` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL,
  `PCode` varchar(255) DEFAULT NULL,
  `CrdExp` date DEFAULT NULL,
  `Accnt_Type` varchar(255) NOT NULL,
  `Password` varchar(20) NOT NULL,
  PRIMARY KEY (`CardNo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patron`
--

LOCK TABLES `patron` WRITE;
/*!40000 ALTER TABLE `patron` DISABLE KEYS */;
INSERT INTO `patron` VALUES (1,'Emma',NULL,'Watson','emz123@email.com','100 Hollywood Walk','Los Angeles','1B2 0S9','2015-02-02','Regular','hermoine');
/*!40000 ALTER TABLE `patron` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patron_phoneno`
--

DROP TABLE IF EXISTS `patron_phoneno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patron_phoneno` (
  `PhoneNo` int(10) NOT NULL DEFAULT '0',
  `PatronNo` int(9) NOT NULL DEFAULT '0',
  PRIMARY KEY (`PhoneNo`,`PatronNo`),
  KEY `patron_phoneno_ibfk_1` (`PatronNo`),
  CONSTRAINT `patron_phoneno_ibfk_1` FOREIGN KEY (`PatronNo`) REFERENCES `patron` (`CardNo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patron_phoneno`
--

LOCK TABLES `patron_phoneno` WRITE;
/*!40000 ALTER TABLE `patron_phoneno` DISABLE KEYS */;
/*!40000 ALTER TABLE `patron_phoneno` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `BranchNo` int(3) NOT NULL DEFAULT '0',
  `PatronNo` int(9) NOT NULL DEFAULT '0',
  `PaymentDate` date NOT NULL,
  `Amount` float NOT NULL,
  `PaymentType` varchar(255) NOT NULL,
  PRIMARY KEY (`BranchNo`,`PatronNo`),
  KEY `PatronNo` (`PatronNo`),
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`PatronNo`) REFERENCES `patron` (`CardNo`),
  CONSTRAINT `payments_ibfk_2` FOREIGN KEY (`BranchNo`) REFERENCES `branch` (`BranchNo`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publisher`
--

DROP TABLE IF EXISTS `publisher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publisher` (
  `PublisherName` varchar(255) NOT NULL,
  PRIMARY KEY (`PublisherName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publisher`
--

LOCK TABLES `publisher` WRITE;
/*!40000 ALTER TABLE `publisher` DISABLE KEYS */;
/*!40000 ALTER TABLE `publisher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `publisher_books`
--

DROP TABLE IF EXISTS `publisher_books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `publisher_books` (
  `PublisherName` varchar(255) NOT NULL DEFAULT '',
  `BookNo` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`PublisherName`,`BookNo`),
  KEY `BookNo` (`BookNo`),
  CONSTRAINT `publisher_books_ibfk_1` FOREIGN KEY (`BookNo`) REFERENCES `book` (`Barcode`),
  CONSTRAINT `publisher_books_ibfk_2` FOREIGN KEY (`PublisherName`) REFERENCES `publisher` (`PublisherName`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publisher_books`
--

LOCK TABLES `publisher_books` WRITE;
/*!40000 ALTER TABLE `publisher_books` DISABLE KEYS */;
/*!40000 ALTER TABLE `publisher_books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff`
--

DROP TABLE IF EXISTS `staff`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff` (
  `SIN` int(9) NOT NULL AUTO_INCREMENT,
  `FName` varchar(255) DEFAULT NULL,
  `MName` varchar(255) DEFAULT NULL,
  `LName` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `City` varchar(255) DEFAULT NULL,
  `PCode` varchar(255) DEFAULT NULL,
  `Wage` int(255) DEFAULT NULL,
  `Position` varchar(255) DEFAULT NULL,
  `BranchNo` int(3) DEFAULT NULL,
  `SuperSIN` int(9) DEFAULT NULL,
  `Password` varchar(20) NOT NULL,
  PRIMARY KEY (`SIN`),
  KEY `staff_ibfk_2` (`SuperSIN`),
  KEY `staff_ibfk_1` (`BranchNo`),
  CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`BranchNo`) REFERENCES `branch` (`BranchNo`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`SuperSIN`) REFERENCES `staff` (`SIN`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff`
--

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` VALUES (1,'Jane',NULL,'Doe','jane.doe@email.com','1234 No Thanks Street','Edmonton','123 456',9,'Clerk',2,NULL,'password'),(3,'Anon',NULL,'Ymous','anon@email.com','10 Bro Ave','Red Deer','987 210',12,'Manager',3,NULL,'anon');
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staff_phoneno`
--

DROP TABLE IF EXISTS `staff_phoneno`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `staff_phoneno` (
  `PhoneNo` int(10) NOT NULL DEFAULT '0',
  `SIN` int(9) NOT NULL DEFAULT '0',
  PRIMARY KEY (`PhoneNo`,`SIN`),
  KEY `staff_phoneno_ibfk_1` (`SIN`),
  CONSTRAINT `staff_phoneno_ibfk_1` FOREIGN KEY (`SIN`) REFERENCES `staff` (`SIN`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staff_phoneno`
--

LOCK TABLES `staff_phoneno` WRITE;
/*!40000 ALTER TABLE `staff_phoneno` DISABLE KEYS */;
/*!40000 ALTER TABLE `staff_phoneno` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-04-17 19:25:51
