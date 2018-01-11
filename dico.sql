-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: localhost    Database: amrf
-- ------------------------------------------------------
-- Server version	5.7.20-0ubuntu0.16.04.1

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
-- Table structure for table `dictionary`
--

DROP TABLE IF EXISTS `dictionary`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dictionary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dictionary`
--

LOCK TABLES `dictionary` WRITE;
/*!40000 ALTER TABLE `dictionary` DISABLE KEYS */;
INSERT INTO `dictionary` VALUES (1,3,'application','application'),(2,3,'Arménie','arménie'),(3,3,'CCAS','ccas'),(4,3,'cérémonie','cérémonie'),(5,3,'cinema','cinema'),(6,3,'commerces','commerces'),(7,3,'Coopération décentralisée','coopérationdécentralisée'),(8,3,'crèche','crèche'),(9,3,'développement durable','développementdurable'),(10,3,'digital','digital'),(11,3,'école','école'),(12,3,'écologie','écologie'),(13,3,'economie sociale et solidaire','economiesocialeetsolidaire'),(14,3,'église','église'),(15,3,'EHPAD','ehpad'),(16,3,'élections','élections'),(17,3,'emploi','emploi'),(18,3,'entreprises','entreprises'),(19,3,'espace de coworking','espacedecoworking'),(20,3,'espaces verts','espacesverts'),(21,3,'Etat civil','etatcivil'),(22,3,'Europe','europe'),(23,3,'festival','festival'),(24,3,'formation','formation'),(25,3,'haut débit','hautdébit'),(26,3,'infirmiers','infirmiers'),(27,3,'innovation','innovation'),(28,3,'intermodalités','intermodalités'),(29,3,'internet','internet'),(30,3,'Jumelage','jumelage'),(31,3,'lecture','lecture'),(32,3,'logements sociaux','logementssociaux'),(33,3,'maison de santé','maisondesanté'),(34,3,'maison de services publics','maisondeservicespublics'),(35,3,'maisons de quartier','maisonsdequartier'),(36,3,'manifestations citoyennes','manifestationscitoyennes'),(37,3,'médecin','médecin'),(38,3,'musique','musique'),(39,3,'parcs régionaux','parcsrégionaux'),(40,3,'patrimoine','patrimoine'),(41,3,'périscolaire','périscolaire'),(42,3,'professionnels de santé','professionnelsdesanté'),(43,3,'rénovation/réfection','rénovation/réfection'),(44,3,'réseaux','réseaux'),(45,3,'restauration scolaire','restaurationscolaire'),(46,3,'SPANC','spanc'),(47,3,'startups','startups'),(48,3,'Station d\'épuration ','stationd\'épuration'),(49,3,'station service','stationservice'),(50,3,'téléphonie fixe','téléphoniefixe'),(51,3,'téléphonie mobile','téléphoniemobile'),(52,3,'télétravail ','télétravail'),(53,3,'théâtre','théâtre'),(54,3,'transports','transports'),(55,3,'transports','transports'),(56,3,'urbanisme','urbanisme'),(57,3,'valorisation du territoire','valorisationduterritoire'),(58,3,'vie associative','vieassociative'),(59,3,'voies navigables','voiesnavigables'),(60,3,'voirie','voirie'),(61,1,'Education','education'),(62,1,'Aménagement du territoire','aménagementduterritoire'),(63,1,'Culture','culture'),(64,1,'Démocratie Local','démocratielocal'),(65,1,'Eau et assainissement','eauetassainissement'),(66,1,'Economie','economie'),(67,1,'Environnement','environnement'),(68,1,'Mobilité','mobilité'),(69,1,'Numérique','numérique'),(70,1,'Relations internationales','relationsinternationales'),(71,1,'Santé','santé'),(72,1,'Services de proximité','servicesdeproximité'),(73,1,'Social','social'),(74,1,'Tourisme','tourisme'),(75,2,'Alimentation','alimentation'),(76,2,'Assurance','assurance'),(77,2,'Banque','banque'),(78,2,'Collectivité','collectivité'),(79,2,'Commerce','commerce'),(80,2,'Déchets','déchets'),(81,2,'Démocratie locale','démocratielocale'),(82,2,'Développement local','développementlocal'),(83,2,'Économie','Économie'),(84,2,'Éducation','Éducation'),(85,2,'Énergie','Énergie'),(86,2,'Équipement','Équipement'),(87,2,'Finances','finances'),(88,2,'Formation','formation'),(89,2,'Internet','internet'),(90,2,'Numérique','numérique'),(91,2,'Santé','santé'),(92,2,'Services publics','servicespublics'),(93,2,'Social','social'),(94,2,'Téléphonie','téléphonie');
/*!40000 ALTER TABLE `dictionary` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-01-11  9:39:23
