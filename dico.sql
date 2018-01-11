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
) ENGINE=InnoDB AUTO_INCREMENT=669 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dictionary`
--

LOCK TABLES `dictionary` WRITE;
/*!40000 ALTER TABLE `dictionary` DISABLE KEYS */;
INSERT INTO `dictionary` VALUES (575,3,'application','application'),(576,3,'Arménie','arménie'),(577,3,'CCAS','ccas'),(578,3,'cérémonie','cérémonie'),(579,3,'cinema','cinema'),(580,3,'commerces','commerces'),(581,3,'Coopération décentralisée','coopérationdécentralisée'),(582,3,'crèche','crèche'),(583,3,'développement durable','développementdurable'),(584,3,'digital','digital'),(585,3,'école','école'),(586,3,'écologie','écologie'),(587,3,'economie sociale et solidaire','economiesocialeetsolidaire'),(588,3,'église','église'),(589,3,'EHPAD','ehpad'),(590,3,'élections','élections'),(591,3,'emploi','emploi'),(592,3,'entreprises','entreprises'),(593,3,'espace de coworking','espacedecoworking'),(594,3,'espaces verts','espacesverts'),(595,3,'Etat civil','etatcivil'),(596,3,'Europe','europe'),(597,3,'festival','festival'),(598,3,'formation','formation'),(599,3,'haut débit','hautdébit'),(600,3,'infirmiers','infirmiers'),(601,3,'innovation','innovation'),(602,3,'intermodalités','intermodalités'),(603,3,'internet','internet'),(604,3,'Jumelage','jumelage'),(605,3,'lecture','lecture'),(606,3,'logements sociaux','logementssociaux'),(607,3,'maison de santé','maisondesanté'),(608,3,'maison de services publics','maisondeservicespublics'),(609,3,'maisons de quartier','maisonsdequartier'),(610,3,'manifestations citoyennes','manifestationscitoyennes'),(611,3,'médecin','médecin'),(612,3,'musique','musique'),(613,3,'parcs régionaux','parcsrégionaux'),(614,3,'patrimoine','patrimoine'),(615,3,'périscolaire','périscolaire'),(616,3,'professionnels de santé','professionnelsdesanté'),(617,3,'rénovation/réfection','rénovation/réfection'),(618,3,'réseaux','réseaux'),(619,3,'restauration scolaire','restaurationscolaire'),(620,3,'SPANC','spanc'),(621,3,'startups','startups'),(622,3,'Station d\'épuration ','stationd\'épuration'),(623,3,'station service','stationservice'),(624,3,'téléphonie fixe','téléphoniefixe'),(625,3,'téléphonie mobile','téléphoniemobile'),(626,3,'télétravail ','télétravail'),(627,3,'théâtre','théâtre'),(628,3,'transports','transports'),(629,3,'transports','transports'),(630,3,'urbanisme','urbanisme'),(631,3,'valorisation du territoire','valorisationduterritoire'),(632,3,'vie associative','vieassociative'),(633,3,'voies navigables','voiesnavigables'),(634,3,'voirie','voirie'),(635,1,'Education','education'),(636,1,'Aménagement du territoire','aménagementduterritoire'),(637,1,'Culture','culture'),(638,1,'Démocratie Local','démocratielocal'),(639,1,'Eau et assainissement','eauetassainissement'),(640,1,'Economie','economie'),(641,1,'Environnement','environnement'),(642,1,'Mobilité','mobilité'),(643,1,'Numérique','numérique'),(644,1,'Relations internationales','relationsinternationales'),(645,1,'Santé','santé'),(646,1,'Services de proximité','servicesdeproximité'),(647,1,'Social','social'),(648,1,'Tourisme','tourisme'),(649,2,'Alimentation','alimentation'),(650,2,'Assurance','assurance'),(651,2,'Banque','banque'),(652,2,'Collectivité','collectivité'),(653,2,'Commerce','commerce'),(654,2,'Déchets','déchets'),(655,2,'Démocratie locale','démocratielocale'),(656,2,'Développement local','développementlocal'),(657,2,'Économie','Économie'),(658,2,'Éducation','Éducation'),(659,2,'Énergie','Énergie'),(660,2,'Équipement','Équipement'),(661,2,'Finances','finances'),(662,2,'Formation','formation'),(663,2,'Internet','internet'),(664,2,'Numérique','numérique'),(665,2,'Santé','santé'),(666,2,'Services publics','servicespublics'),(667,2,'Social','social'),(668,2,'Téléphonie','téléphonie');
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

-- Dump completed on 2018-01-09 16:15:26
