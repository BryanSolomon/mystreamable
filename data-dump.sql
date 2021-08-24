-- MySQL dump 10.16  Distrib 10.1.47-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: streamable
-- ------------------------------------------------------
-- Server version	10.1.47-MariaDB-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accounts` (
  `userID` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `streamingServices` varchar(255) DEFAULT NULL,
  `securityQuestions` varchar(255) DEFAULT NULL,
  `securityAnswer` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`userID`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accounts`
--

-- LOCK TABLES `accounts` WRITE;
/*!40000 ALTER TABLE `accounts` DISABLE KEYS */;
-- INSERT INTO `accounts` VALUES (1,'matt@whatsstreamable.com','Mathew','/Netflix/Hulu/Disney+/HBO Max/Prime Video/Paramount+/Discovery+/Apple TV+/Peacock/Showtime/Starz/ESPN+/YouTube Premium','pet','Bubbles','$2y$10$yss7aoZkKwUoCkAOQdgJUuk5CLZv8Dn0sAu2p5RO03rkkDwS2AT3.'),(2,'nathan@whatsstreamable.com','Nate','/Netflix','city','Milwaukee','$2y$10$XBXzFWaWbjQ1a8ydTDoS3eY/eMLObwzOlWCECj0NZiJZ4hW0gmbum'),(3,'matthias@whatsstreamable.com','Matthias','/Netflix/HBO Max','maiden','Smith','$2y$10$cgpBnwWCg.DYFUrXN2Gy0e3eAeIiz6s6G4iSRgNN6PWJyy4pRxAFy'),(4,'bryan@whatsstreamable.com','Bryan','/Prime Video/Other','city','Madison','$2y$10$s0nwFk7Nr7SqJlz3TCt0bOkbLrNBab6ka5QgqGXbk0eT/YjOvmXLO'),(5,'dongwook@whatsstreamable.com','Dongwook','/Disney+','pet','Spot','$2y$10$oU48TAnLPc/FwOxCEFUxD.20odwwOfHyPKzfrmlaS6YGfUrJavhEO'),(6,'charles@whatsstreamable.com','Charles','/Netflix/Disney+/Prime Video/Hulu/Apple TV+/Peacock','pet','Sammy','$2y$10$yAVHpsZc6LYOOGV47TICS.gQcYnXO3k/QE.2m94D4Uk31cLGj8uTW'),(7,'kelsey@user.whatsstreamable.com','Kelsey','/Netflix/Disney+/Hulu','city','Durham','$2y$10$TQNaVp5Hrz.quVnS6fq3feE8pZIWx75ViNo0VcYghtbYuyG1aksJC'),(8,'vince@user.whatsstreamable.com','Vince','/Netflix/Disney+/Prime Video/Hulu/HBO Max/Discovery+','city','Milwaukee','$2y$10$jOTOQsdYTrExF0dTdh91K.sUoPANbAVf7m/9G3UnVbBw01H2Dn3Nq'),(9,'adil@whatsstreamable.com','Adil','/Netflix','pet','Bucky','$2y$10$XqIB9Pe8./QqfP5LYMnsx.k7j.kWkHuXXlzAyT3l.199q5bHVopBm'),(10,'matthias.hare17@gmail.com','Matthias','/Netflix/Disney+/Prime Video/Hulu/HBO Max/Paramount+','city','melrose','$2y$10$f.bOsB59MSN0tc.oyy650ez76I2ki3ThJ8oxSs.o03XhPcugXLNLi'),(11,'oahmed4@wisc.edu','adil','/Netflix/Disney+/Prime Video/YouTube Premium','city','Test','$2y$10$ZAxURLhZ2PxADUy/78Wnru.ocsYo0I0znB7rggEohMlbALOVgBgjy'),(12,'vimmi.jaiswal@gmail.com','Vimmi','/Disney+/YouTube Premium','pet','shifu','$2y$10$GQEpWrVZ0YgLxyacKetYjOJq8JP8jWxD6ESRfjbZcTT88jka.Oim6'),(13,'vimmi.jaiswal1@gmail.com','Vimmi','/Netflix/Disney+/Prime Video/Hulu','pet','hhh','$2y$10$/v0E5CQOqeatKgsceUXkZe5q03nrSX6TDY/lYmTj.7sOL4P6Uky2y'),(14,'empty@whatsstreamable.com','Empty','/Hulu','pet','Bucky','$2y$10$s./4PTpAHuA7QD0SuBQ0t.8ZNvG0VknVk4n7BdCR4hEfNKO02M8HG');
/*!40000 ALTER TABLE `accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `listItems`
--

DROP TABLE IF EXISTS `listItems`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `listItems` (
  `userID` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `listID` int(11) DEFAULT NULL,
  `objectID` varchar(255) DEFAULT NULL,
  `progress` varchar(255) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `streamingService` varchar(255) DEFAULT NULL,
  `season` int(11) DEFAULT NULL,
  `episode` int(11) DEFAULT NULL,
  KEY `userID` (`userID`),
  CONSTRAINT `listItems_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `accounts` (`userID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `listItems`
--

-- LOCK TABLES `listItems` WRITE;
/*!40000 ALTER TABLE `listItems` DISABLE KEYS */;
-- INSERT INTO `listItems` VALUES (6,'The SpongeBob Movie: Sponge on the Run',1,'400160','',1,'Paramount+',0,0),(6,'The Masked Singer',2,'84910','',2,'',0,0),(6,'Wonder Woman 1984',2,'464052','',1,'',0,0),(1,'Avengers: Endgame',1,'299534','',1,'Disney+',0,0),(1,'Avengers: Endgame',3,'299534','',1,'',0,0),(6,'The Mandalorian',4,'82856','',2,'',0,0),(4,'El Camino: A Breaking Bad Movie',1,'559969','',1,'',0,0),(4,'The Sopranos',2,'1398','',2,'',0,0),(4,'Star Wars',1,'11','',1,'',0,0),(6,'Outer Banks',1,'100757','',2,'Netflix',1,4),(1,'Once Upon a Snowman',1,'741074','',1,'',0,0),(4,'Starship Troopers',3,'563','',1,'',0,0),(3,'Captain Marvel',2,'299537','',1,'',0,0),(6,'Ted Lasso',1,'97546','',2,'Apple TV+',0,0),(5,'Suits',1,'37680','',2,'',0,0),(5,'Suits',3,'37680','',2,'',0,0),(6,'Game of Thrones',4,'1399','',2,'',0,0),(6,'High School Musical: The Musical: The Series',2,'85801','',2,'',0,0),(6,'The Office',1,'2316','',2,'',1,5),(6,'Big Sky',3,'100010','',2,'',0,0),(6,'Captain Marvel',4,'299537','',1,'',0,0),(6,'Avengers: Infinity War',2,'299536','',1,'',0,0),(3,'The Sopranos',1,'1398','',2,'Prime Video',7,3),(3,'Game of Thrones',2,'1399','',2,'',0,0),(6,'Julie and the Phantoms',1,'106292','',2,'Netflix',1,6),(3,'Ted Lasso',1,'97546','',2,'Apple TV+',0,0),(3,'Ted Lasso',3,'97546','',2,'',0,0),(3,'Grey\'s Anatomy',2,'1416','',2,'',0,0),(3,'Bachelor Party Vegas',1,'14505','',1,'Prime Video',0,0),(5,'Game of Thrones',4,'1399','',2,'',0,0),(6,'The Bachelor',2,'355','',2,'',0,0),(4,'Breaking Bad',1,'1396','',2,'',0,0),(4,'Breaking Bad',3,'1396','',2,'',0,0),(3,'Riverdale',3,'69050','',2,'',0,0),(3,'Riverdale',4,'69050','',2,'',0,0),(1,'Memories of a Teenager',2,'649058','',1,'',0,0),(1,'Memories of a Teenager',3,'649058','',1,'',0,0),(1,'Yo soy Betty, la fea',1,'16286','',2,'Other',0,0),(6,'The SpongeBob Movie: Sponge on the Run',3,'400160','',1,'',0,0),(6,'Ted Lasso',3,'97546','',2,'',0,0),(5,'Breaking Bad',3,'1396','',2,'',0,0),(5,'Breaking Bad',4,'1396','',2,'',0,0),(5,'Breaking Bad',2,'1396','',2,'',0,0),(6,'High School Musical',3,'10947','',1,'',0,0),(6,'High School Musical',1,'10947','',1,'',0,0),(4,'L.A. Confidential',3,'2118','',1,'',0,0),(6,'The Ultimate Playlist of Noise',1,'776884','',1,'Hulu',0,0),(4,'L.A. Confidential',2,'2118','',1,'',0,0),(1,'Breaking Bad',1,'1396','',2,'',0,0),(3,'The Masked Singer',4,'84910','',2,'',0,0),(10,'Midsommar',1,'530385','',1,'',0,0),(12,'Netflix Live',1,'449997','',1,'',0,0),(12,'The Mandalorian',3,'82856','',2,'',0,0),(13,'The Raccoon Town in the Mobile Phone',1,'121940','',2,'',0,0),(12,'The Mandalorian',2,'82856','',2,'',0,0),(13,'Chalk N Duster',2,'378301','',1,'',0,0),(13,'Chalk N Duster',3,'378301','',1,'',0,0),(5,'Dexter\'s Laboratory',3,'221300','',1,'',0,0),(5,'Dexter\'s Laboratory',2,'221300','',1,'',0,0),(6,'Raya and the Last Dragon',2,'527774','',1,'',0,0),(6,'The Falcon and the Winter Soldier',2,'88396','',2,'',0,0),(6,'Spider-Man: Far from Home',3,'429617','',1,'',0,0),(6,'Spider-Man: Far from Home',4,'429617','',1,'',0,0),(6,'Spider-Man: Homecoming',3,'315635','',1,'',0,0),(6,'Money Heist',3,'71446','',2,'',0,0),(6,'Money Heist',2,'71446','',2,'',0,0),(6,'Phineas and Ferb',3,'1877','',2,'',0,0),(6,'Phineas and Ferb',1,'1877','',2,'Disney+',3,4);
/*!40000 ALTER TABLE `listItems` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-15 23:26:18
