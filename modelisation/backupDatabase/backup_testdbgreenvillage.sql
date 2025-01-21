/*!999999\- enable the sandbox mode */ 
-- MariaDB dump 10.19  Distrib 10.11.8-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: testdbgreenvillage
-- ------------------------------------------------------
-- Server version	10.11.8-MariaDB-0ubuntu0.24.04.1

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
-- Table structure for table `a2`
--

DROP TABLE IF EXISTS `a2`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `a2` (
  `refClient` varchar(50) NOT NULL,
  `idAdresse` int(11) NOT NULL,
  `Type` varchar(20) NOT NULL,
  PRIMARY KEY (`refClient`,`idAdresse`,`Type`),
  KEY `idAdresse` (`idAdresse`),
  CONSTRAINT `a2_ibfk_1` FOREIGN KEY (`refClient`) REFERENCES `utilisateur` (`refClient`),
  CONSTRAINT `a2_ibfk_2` FOREIGN KEY (`idAdresse`) REFERENCES `adresse` (`idAdresse`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `a2`
--

LOCK TABLES `a2` WRITE;
/*!40000 ALTER TABLE `a2` DISABLE KEYS */;
INSERT INTO `a2` VALUES
('1',9,'adLivraison'),
('1',19,'adFacturation'),
('10',13,'adLivraison'),
('10',18,'adFacturation'),
('11',7,'adFacturation'),
('11',7,'adLivraison'),
('12',13,'adFacturation'),
('12',16,'adLivraison'),
('2',18,'adFacturation'),
('2',23,'adLivraison'),
('3',6,'adFacturation'),
('3',20,'adLivraison'),
('4',11,'adFacturation'),
('4',25,'adLivraison'),
('5',10,'adFacturation'),
('5',10,'adLivraison'),
('6',10,'adLivraison'),
('6',21,'adFacturation'),
('7',18,'adFacturation'),
('7',18,'adLivraison'),
('8',14,'adFacturation'),
('8',14,'adLivraison'),
('9',20,'adLivraison'),
('9',24,'adFacturation');
/*!40000 ALTER TABLE `a2` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `adresse`
--

DROP TABLE IF EXISTS `adresse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `adresse` (
  `idAdresse` int(11) NOT NULL AUTO_INCREMENT,
  `numeroDeRue` varchar(5) DEFAULT NULL,
  `ville` varchar(51) DEFAULT NULL,
  `codePostal` varchar(5) DEFAULT NULL,
  `nomRue` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idAdresse`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `adresse`
--

LOCK TABLES `adresse` WRITE;
/*!40000 ALTER TABLE `adresse` DISABLE KEYS */;
INSERT INTO `adresse` VALUES
(1,'13627','Bradenton','34282','Bashford Road'),
(2,'93','São Manuel','80000','Gerald Crossing'),
(3,'1433','Nueva Cajamarca','56123','Mcguire Terrace'),
(4,'3790','Horizonte','62880','John Wall Crossing'),
(5,'36','Portelândia','75835','Westend Parkway'),
(6,'625','Bungu','98561','Namekagon Court'),
(7,'3355','Revava','75123','Fair Oaks Center'),
(8,'5055','Novogireyevo','43324','Monterey Parkway'),
(9,'648','Johanneshov','12136','Maple Plaza'),
(10,'1996','Guam Government House','96928','Prentice Center'),
(11,'19917','Wien','12001','Brickson Park Way'),
(12,'149','Hino','91954','Cambridge Parkway'),
(13,'69237','Kangalassy','67790','Oneill Avenue'),
(14,'5795','Tianyi','87451','Huxley Point'),
(15,'582','Repušnica','44320','Dapin Pass'),
(16,'8964','Golcowa','36231','Fulton Pass'),
(17,'77863','Banjar Yehsatang','19547','Kim Center'),
(18,'358','Aktau','95780','Valley Edge Lane'),
(19,'393','Koszyce Wielkie','33111','Northridge Trail'),
(20,'0443','Chakaray','04587','Lakewood Drive'),
(21,'842','Bunawan','85064','Golden Leaf Court'),
(22,'4085','La Hacienda','17515','Lakeland Terrace'),
(23,'764','Mangochi','65852','Carioca Hill'),
(24,'78200','Figueira dos Cavaleiros','79004','Anthes Pass'),
(25,'2424','Shatian','54123','Ridgeview Parkway');
/*!40000 ALTER TABLE `adresse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `avoir`
--

DROP TABLE IF EXISTS `avoir`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `avoir` (
  `idProduit` varchar(5) NOT NULL,
  `idSousRubrique` int(11) NOT NULL,
  PRIMARY KEY (`idProduit`,`idSousRubrique`),
  KEY `idSousRubrique` (`idSousRubrique`),
  CONSTRAINT `avoir_ibfk_1` FOREIGN KEY (`idProduit`) REFERENCES `produit` (`idProduit`),
  CONSTRAINT `avoir_ibfk_2` FOREIGN KEY (`idSousRubrique`) REFERENCES `sousRubrique` (`idSousRubrique`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `avoir`
--

LOCK TABLES `avoir` WRITE;
/*!40000 ALTER TABLE `avoir` DISABLE KEYS */;
INSERT INTO `avoir` VALUES
('AMP01',8),
('BAT01',5),
('CAS01',6),
('GIT01',1),
('HAU01',10),
('MIC01',7),
('PIA01',3),
('PIA02',4),
('TAB01',9),
('VIO01',2);
/*!40000 ALTER TABLE `avoir` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `commande`
--

DROP TABLE IF EXISTS `commande`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `commande` (
  `idCommande` int(11) NOT NULL AUTO_INCREMENT,
  `dateCommande` date DEFAULT NULL,
  `numFacturation` varchar(10) NOT NULL,
  `commandeTotalHt` decimal(8,2) NOT NULL,
  `commandeTotalTtc` decimal(8,2) NOT NULL,
  `CommandeTotalReduction` decimal(8,2) DEFAULT NULL,
  `moyenPaiement_` varchar(50) DEFAULT NULL,
  `refClient` varchar(50) NOT NULL,
  PRIMARY KEY (`idCommande`),
  KEY `refClient` (`refClient`),
  CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`refClient`) REFERENCES `utilisateur` (`refClient`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commande`
--

LOCK TABLES `commande` WRITE;
/*!40000 ALTER TABLE `commande` DISABLE KEYS */;
INSERT INTO `commande` VALUES
(1,'2025-01-15','FAC0001',1999.97,2399.97,2399.97,'Carte Bancaire','1'),
(2,'2025-01-16','FAC0002',1099.97,1264.97,1201.72,'PayPal','4'),
(3,'2025-01-17','FAC0003',799.99,959.99,959.99,'Carte Bancaire','1'),
(4,'2025-01-18','FAC0004',129.99,155.99,155.99,'Virement Bancaire','12'),
(5,'2025-01-19','FAC0005',1999.98,2359.98,1439.59,'Carte Bancaire','8');
/*!40000 ALTER TABLE `commande` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contient`
--

DROP TABLE IF EXISTS `contient`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contient` (
  `idProduit` varchar(5) NOT NULL,
  `idCommande` int(11) NOT NULL,
  `quantite` int(11) DEFAULT NULL,
  `articleTotalHt` decimal(8,2) DEFAULT NULL,
  `articleTotalTtc` decimal(8,2) DEFAULT NULL,
  PRIMARY KEY (`idProduit`,`idCommande`),
  KEY `idCommande` (`idCommande`),
  CONSTRAINT `contient_ibfk_1` FOREIGN KEY (`idProduit`) REFERENCES `produit` (`idProduit`),
  CONSTRAINT `contient_ibfk_2` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`idCommande`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contient`
--

LOCK TABLES `contient` WRITE;
/*!40000 ALTER TABLE `contient` DISABLE KEYS */;
INSERT INTO `contient` VALUES
('BAT01',1,1,999.99,1199.99),
('BAT01',5,2,1999.98,2359.98),
('GIT01',1,2,999.98,1199.98),
('PIA01',3,1,799.99,959.99),
('PIA02',4,1,129.99,155.99),
('TAB01',2,2,699.98,804.98),
('VIO01',2,1,399.99,459.99);
/*!40000 ALTER TABLE `contient` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'IGNORE_SPACE,STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`admin`@`localhost`*/ /*!50003 TRIGGER insert_contient BEFORE INSERT ON contient
    FOR EACH ROW 
    BEGIN

	DECLARE articleTotalHt DECIMAL(8,2);
	DECLARE articleTotalTtC DECIMAL(8,2);
	DECLARE numCommande INT;
	
	SET articleTotalHt = NEW.quantite * (SELECT prixProduit FROM produit p WHERE p.idProduit = NEW.idProduit);
		
	SET articleTotalTtc = articleTotalHt * (1 + ((SELECT coefficientTaxe FROM commande c LEFT JOIN utilisateur u ON c.refClient = u.refClient where c.idCommande = NEW.idCommande) / 100));
	
		IF articleTotalTtc  < 0 
            THEN SIGNAL SQLSTATE '40000' SET MESSAGE_TEXT = 'Un problème est survenu. Prix total inferieur a 0 !';
		END IF;
		
    SET NEW.articleTotalHt = articleTotalHt ;
	SET NEW.articleTotalTtC = articleTotalTtC;
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'IGNORE_SPACE,STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`admin`@`localhost`*/ /*!50003 TRIGGER change_commande 
AFTER INSERT ON contient
    FOR EACH ROW 
    BEGIN

	DECLARE commandeTotalHt DECIMAL(8,2);
	DECLARE commandeTotalTtC DECIMAL(8,2);
	DECLARE commandeTotalReduction DECIMAL(8,2);
	DECLARE coefficientReduction INT;
	SET coefficientReduction = (SELECT u.coefficientReduction FROM commande c 
								LEFT JOIN utilisateur u ON c.refClient = u.refClient 
									where c.idCommande = NEW.idCommande);
	
	
	 -- Calculer le total HT et TTC pour cette commande
    SELECT SUM(articleTotalHt), SUM(articleTotalTtc)
    INTO commandeTotalHt, commandeTotalTtC
    FROM contient
    WHERE idCommande = NEW.idCommande
	GROUP BY idCommande;
	 
	 	IF coefficientReduction > 0 THEN
			SET commandeTotalReduction = commandeTotalTtC * (1 - coefficientReduction / 100);
	 	Else 
	 		SET commandeTotalReduction = commandeTotalTtC;
		END IF;

    -- Mettre à jour la commande avec les nouveaux totaux
    UPDATE commande
    SET commandeTotalHt = commandeTotalHt,
        commandeTotalTtc = commandeTotalTtC,
        commandeTotalReduction = commandeTotalReduction
    WHERE idCommande = NEW.idCommande;
   
    END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `detailLiv`
--

DROP TABLE IF EXISTS `detailLiv`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `detailLiv` (
  `idProduit` varchar(5) NOT NULL,
  `idLivraison` int(11) NOT NULL,
  `quantiteLiv` int(11) DEFAULT NULL,
  PRIMARY KEY (`idProduit`,`idLivraison`),
  KEY `idLivraison` (`idLivraison`),
  CONSTRAINT `detailLiv_ibfk_1` FOREIGN KEY (`idProduit`) REFERENCES `produit` (`idProduit`),
  CONSTRAINT `detailLiv_ibfk_2` FOREIGN KEY (`idLivraison`) REFERENCES `livraison` (`idLivraison`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detailLiv`
--

LOCK TABLES `detailLiv` WRITE;
/*!40000 ALTER TABLE `detailLiv` DISABLE KEYS */;
INSERT INTO `detailLiv` VALUES
('BAT01',1,1),
('BAT01',5,1),
('BAT01',6,1),
('GIT01',1,2),
('PIA01',3,1),
('PIA02',4,1),
('TAB01',2,2),
('VIO01',2,1);
/*!40000 ALTER TABLE `detailLiv` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fournisseur`
--

DROP TABLE IF EXISTS `fournisseur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fournisseur` (
  `idFournisseur` int(11) NOT NULL AUTO_INCREMENT,
  `nomFournisseur` varchar(50) NOT NULL,
  `emailFournisseur` varchar(50) DEFAULT NULL,
  `telephoneFournisseur` varchar(50) DEFAULT NULL,
  `idAdresse` int(11) NOT NULL,
  PRIMARY KEY (`idFournisseur`),
  KEY `idAdresse` (`idAdresse`),
  CONSTRAINT `fournisseur_ibfk_1` FOREIGN KEY (`idAdresse`) REFERENCES `adresse` (`idAdresse`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fournisseur`
--

LOCK TABLES `fournisseur` WRITE;
/*!40000 ALTER TABLE `fournisseur` DISABLE KEYS */;
INSERT INTO `fournisseur` VALUES
(1,'Buzzshare','qarsnell0@google.fr','2879069540',1),
(2,'Browseblab','dsmeal1@tripadvisor.com','9294319928',2),
(3,'Babbleblab','cmarkwick2@livejournal.com','9973556322',3),
(4,'Flipstorm','jkeyzor3@springer.com','6545363454',4);
/*!40000 ALTER TABLE `fournisseur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `livraison`
--

DROP TABLE IF EXISTS `livraison`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `livraison` (
  `idLivraison` int(11) NOT NULL AUTO_INCREMENT,
  `dateLivraison` date NOT NULL,
  `transporteur` varchar(50) DEFAULT NULL,
  `url_suivi` varchar(50) DEFAULT NULL,
  `idCommande` int(11) NOT NULL,
  PRIMARY KEY (`idLivraison`),
  KEY `idCommande` (`idCommande`),
  CONSTRAINT `livraison_ibfk_1` FOREIGN KEY (`idCommande`) REFERENCES `commande` (`idCommande`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `livraison`
--

LOCK TABLES `livraison` WRITE;
/*!40000 ALTER TABLE `livraison` DISABLE KEYS */;
INSERT INTO `livraison` VALUES
(1,'2025-01-15','DHL','https://track.dhl.com/12345',1),
(2,'2025-01-16','FedEx','https://track.fedex.com/67890',2),
(3,'2025-01-17','UPS','https://track.ups.com/13579',3),
(4,'2025-01-18','Chronopost','https://track.chronopost.com/24680',4),
(5,'2025-01-19','La Poste','https://track.laposte.com/11223',5),
(6,'2025-01-21','La Poste','https://track.laposte.com/11240',5);
/*!40000 ALTER TABLE `livraison` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produit`
--

DROP TABLE IF EXISTS `produit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produit` (
  `idProduit` varchar(5) NOT NULL,
  `nomProduit` varchar(50) NOT NULL,
  `prixProduit` decimal(7,2) NOT NULL,
  `descriptionCourtProduit` varchar(50) DEFAULT NULL,
  `descriptionLongProduit` varchar(250) DEFAULT NULL,
  `nomImage` varchar(50) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `idFournisseur` int(11) NOT NULL,
  PRIMARY KEY (`idProduit`),
  KEY `idFournisseur` (`idFournisseur`),
  CONSTRAINT `produit_ibfk_1` FOREIGN KEY (`idFournisseur`) REFERENCES `fournisseur` (`idFournisseur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produit`
--

LOCK TABLES `produit` WRITE;
/*!40000 ALTER TABLE `produit` DISABLE KEYS */;
INSERT INTO `produit` VALUES
('AMP01','Amplificateur Guitare',249.99,'Ampli 50W','Amplificateur pour guitare électrique avec une puissance de 50 watts.','ampli_guitare.jpg',20,3),
('BAT01','Batterie Acoustique',999.99,'Kit complet de batterie','Batterie acoustique comprenant 5 fûts et 3 cymbales, idéale pour les concerts en live.','batterie_acoustique.jpg',8,2),
('CAS01','Casque Audio',149.99,'Casque isolant','Casque audio avec isolation phonique pour une écoute immersive.','casque_audio.jpg',30,4),
('GIT01','Guitare Électrique',499.99,'Guitare 6 cordes','Guitare électrique avec un son riche et dynamique, idéale pour le rock et le blues.','guitare_electrique.jpg',25,2),
('HAU01','Haut-parleurs de Monitoring',299.99,'Paire de haut-parleurs','Haut-parleurs de monitoring avec une réponse en fréquence plate pour le mixage audio.','haut_parleurs.jpg',18,3),
('MIC01','Microphone Studio',199.99,'Micro condensateur','Microphone de studio à condensateur pour une qualité sonore exceptionnelle.','microphone_studio.jpg',50,4),
('PIA01','Piano Numérique',799.99,'Piano 88 touches','Piano numérique avec 88 touches pondérées, parfait pour les débutants et professionnels.','piano_numerique.jpg',10,1),
('PIA02','Clavier MIDI',129.99,'Clavier 49 touches','Clavier MIDI avec 49 touches sensibles à la vélocité pour la production musicale.','clavier_midi.jpg',40,1),
('TAB01','Table de Mixage',349.99,'Table 12 canaux','Table de mixage professionnelle avec 12 canaux pour DJ et enregistrement en studio.','table_mixage.jpg',15,4),
('VIO01','Violon',399.99,'Violon 4/4','Violon 4/4 avec un son clair et profond, parfait pour les musiciens avancés.','violon.jpg',12,3);
/*!40000 ALTER TABLE `produit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rubrique`
--

DROP TABLE IF EXISTS `rubrique`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rubrique` (
  `idRubrique` int(11) NOT NULL AUTO_INCREMENT,
  `nomRubrique` varchar(50) DEFAULT NULL,
  `imageRubrique` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idRubrique`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rubrique`
--

LOCK TABLES `rubrique` WRITE;
/*!40000 ALTER TABLE `rubrique` DISABLE KEYS */;
INSERT INTO `rubrique` VALUES
(1,'Instruments à Cordes','instruments_cordes.jpg'),
(2,'Instruments à Clavier','instruments_clavier.jpg'),
(3,'Percussions','percussions.jpg'),
(4,'Accessoires Audio','accessoires_audio.jpg'),
(5,'Équipement DJ','equipement_dj.jpg');
/*!40000 ALTER TABLE `rubrique` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sousRubrique`
--

DROP TABLE IF EXISTS `sousRubrique`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sousRubrique` (
  `idSousRubrique` int(11) NOT NULL AUTO_INCREMENT,
  `nomSousRubrique` varchar(50) DEFAULT NULL,
  `imageSousRubrique` varchar(50) DEFAULT NULL,
  `idRubrique` int(11) NOT NULL,
  PRIMARY KEY (`idSousRubrique`),
  KEY `idRubrique` (`idRubrique`),
  CONSTRAINT `sousRubrique_ibfk_1` FOREIGN KEY (`idRubrique`) REFERENCES `rubrique` (`idRubrique`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sousRubrique`
--

LOCK TABLES `sousRubrique` WRITE;
/*!40000 ALTER TABLE `sousRubrique` DISABLE KEYS */;
INSERT INTO `sousRubrique` VALUES
(1,'Guitares','guitares.jpg',1),
(2,'Violons','violons.jpg',1),
(3,'Pianos Numériques','pianos_numeriques.jpg',2),
(4,'Claviers MIDI','claviers_midi.jpg',2),
(5,'Batteries Acoustiques','batteries_acoustiques.jpg',3),
(6,'Casques Audio','casques_audio.jpg',4),
(7,'Microphones','microphones.jpg',4),
(8,'Amplificateurs','amplificateurs.jpg',4),
(9,'Tables de Mixage','tables_mixage.jpg',5),
(10,'Haut-parleurs','haut_parleurs.jpg',4);
/*!40000 ALTER TABLE `sousRubrique` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utilisateur` (
  `refClient` varchar(50) NOT NULL,
  `nom` varchar(50) DEFAULT NULL,
  `prenom` varchar(50) DEFAULT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `coefficientTaxe` int(11) DEFAULT NULL,
  `type` varchar(30) DEFAULT NULL,
  `telephone` varchar(10) DEFAULT NULL,
  `titreRole` varchar(50) DEFAULT NULL,
  `coefficientReduction` int(11) DEFAULT NULL,
  `refClient_1` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`refClient`),
  KEY `refClient_1` (`refClient_1`),
  CONSTRAINT `utilisateur_ibfk_1` FOREIGN KEY (`refClient_1`) REFERENCES `utilisateur` (`refClient`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateur`
--

LOCK TABLES `utilisateur` WRITE;
/*!40000 ALTER TABLE `utilisateur` DISABLE KEYS */;
INSERT INTO `utilisateur` VALUES
('1','Mame','Heales','kW8>3z*z','mheales0@google.com.hk',20,'particulier','0679435690','',0,'3'),
('10','Artemas','Baton','dZ9@>thRWK_ILr','abaton9@springer.com',14,'professionnel','0942057647','',39,'3'),
('11','Esra','Ganforth','zC5@zeC`6&','eganfortha@clickbank.net',16,'professionnel','0686192299','',26,'12'),
('12','Gale','Fulbrook','cX4VGk@,OESGtk','gfulbrookb@behance.net',20,'personnel','0737595866','Commercial',0,'3'),
('2','Hastings','Wheowall','sW1/C7.R|','hwheowall1@webs.com',20,'personnel','0657298690','Gestion',0,'3'),
('3','Denny','Plain','nY7!&_4dO,P7G','dplain2@google.pl',20,'personnel','0727737577','Commercial',0,'3'),
('4','Lincoln','Glendenning','oB7&rV_eq','lglendenning3@chronoengine.com',15,'professionnel','0762618553','',5,'12'),
('5','Perren','Tidmarsh','dE3.nUm66','ptidmarsh4@virginia.edu',20,'personnel','0683941609','Directeur',0,'3'),
('6','Kasey','Cove','uV5>\'!~}uS','kcove5@usda.gov',20,'particulier','0608249058','',0,'3'),
('7','Jessie','Frondt','eY0*HA!Mwe','jfrondt6@ftc.gov',20,'particulier','0728238326','',0,'3'),
('8','Rivi','Bowyer','zI9(AW|?.|(','rbowyer7@hao123.com',18,'professionnel','0676519897','',39,'12'),
('9','Trixy','Jest','hR3!KDb\'n','tjest8@illinois.edu',20,'personnel','0732089390','Gestion',0,'3');
/*!40000 ALTER TABLE `utilisateur` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'testdbgreenvillage'
--
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'IGNORE_SPACE,STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `DetailCommande` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`localhost` PROCEDURE `DetailCommande`(In commandeNum INT)
BEGIN
   SELECT c.idCommande,p.idProduit,c2.quantite,nomProduit,l.dateLivraison,d.idProduit, d.idLivraison, d.quantiteLiv
	FROM commande c  left join contient c2 on c.idCommande = c2.idCommande 
	join produit p on c2.idProduit = p.idProduit 
	join livraison l on l.idCommande = c.idCommande
	join detailLiv d on d.idLivraison = l.idLivraison
	WHERE c.idCommande = commandeNum AND d.idProduit = p.idProduit;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-21 11:21:53
