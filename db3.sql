-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: fsp_project1_160721046
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cerita`
--

DROP TABLE IF EXISTS `cerita`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cerita` (
  `idcerita` int(11) NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) DEFAULT NULL,
  `idusers_pembuat_awal` varchar(40) NOT NULL,
  PRIMARY KEY (`idcerita`),
  KEY `fk_cerita_users1_idx` (`idusers_pembuat_awal`),
  CONSTRAINT `fk_cerita_users1` FOREIGN KEY (`idusers_pembuat_awal`) REFERENCES `users` (`idusers`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cerita`
--

LOCK TABLES `cerita` WRITE;
/*!40000 ALTER TABLE `cerita` DISABLE KEYS */;
INSERT INTO `cerita` VALUES (6,'wibowo movie','160423999'),(7,'story of robert','160721046'),(8,'dhani story','160721046'),(9,'new story of aurel','160421115');
/*!40000 ALTER TABLE `cerita` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `paragraf`
--

DROP TABLE IF EXISTS `paragraf`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `paragraf` (
  `idparagraf` int(11) NOT NULL AUTO_INCREMENT,
  `idusers` varchar(40) NOT NULL,
  `idcerita` int(11) NOT NULL,
  `isi_paragraf` varchar(100) DEFAULT NULL,
  `tanggal_buat` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idparagraf`),
  KEY `fk_users_has_cerita_cerita1_idx` (`idcerita`),
  KEY `fk_users_has_cerita_users_idx` (`idusers`),
  CONSTRAINT `fk_users_has_cerita_cerita1` FOREIGN KEY (`idcerita`) REFERENCES `cerita` (`idcerita`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_has_cerita_users` FOREIGN KEY (`idusers`) REFERENCES `users` (`idusers`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `paragraf`
--

LOCK TABLES `paragraf` WRITE;
/*!40000 ALTER TABLE `paragraf` DISABLE KEYS */;
INSERT INTO `paragraf` VALUES (1,'160423999',6,'wibowo wibowo wibowo wibowo wibowo wibowo wibowo wibowo wibowo wibowo wibowo wibowo wibowo wibowo wi','2023-10-06 11:33:47'),(2,'160423999',6,'helo tes tes tes this paragraph is written by dosen','2023-10-06 11:34:07'),(3,'160721046',7,'this is robert story paragraph 1','2023-10-06 11:37:12'),(4,'160721046',8,'paragraph of dhani story','2023-10-06 11:37:29'),(5,'160721046',6,'hello this paragraph is written by ryan','2023-10-06 11:37:39'),(6,'160721046',7,'helo robert','2023-10-06 11:37:48'),(7,'160721046',8,'hi dhani','2023-10-06 11:37:54'),(8,'160421115',9,'helo this is aurel','2023-10-06 11:40:53');
/*!40000 ALTER TABLE `paragraf` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `idusers` varchar(40) NOT NULL,
  `nama` varchar(45) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `salt` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idusers`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('160421115','aurel','4eccaf1462144820fc0ef65749867a5c','6076102s41'),('160423999','dosen','b1e31a89067ee2b53364b3f7669cb84d','6761200s14'),('160721046','ryan','20a76ce5acda3499a0720269f67b9258','462061071s');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-06 18:42:04
