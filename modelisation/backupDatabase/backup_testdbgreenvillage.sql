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
  `reduction` decimal(8,2) DEFAULT NULL,
  `CommandeTotalReduction` decimal(8,2) DEFAULT NULL,
  `moyenPaiement` varchar(50) DEFAULT NULL,
  `statut` enum('En cours','Expédiée','Partiellement expédiée','Terminée') DEFAULT 'En cours',
  `paiementValide` tinyint(1) DEFAULT 0,
  `refClient` varchar(50) NOT NULL,
  PRIMARY KEY (`idCommande`),
  KEY `refClient` (`refClient`),
  CONSTRAINT `commande_ibfk_1` FOREIGN KEY (`refClient`) REFERENCES `utilisateur` (`refClient`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `commande`
--

LOCK TABLES `commande` WRITE;
/*!40000 ALTER TABLE `commande` DISABLE KEYS */;
INSERT INTO `commande` VALUES
(1,'2025-01-15','FAC0001',2399.97,2879.97,0.00,2879.97,'Carte Bancaire','Expédiée',0,'1'),
(2,'2025-01-16','FAC0002',1264.97,1517.97,72.28,1442.07,'PayPal','Expédiée',0,'4'),
(3,'2025-01-17','FAC0003',959.99,1151.99,0.00,1151.99,'Carte Bancaire','Expédiée',0,'1'),
(4,'2025-01-18','FAC0004',155.99,187.19,0.00,187.19,'Virement Bancaire','Expédiée',0,'12'),
(5,'2025-01-19','FAC0005',2359.98,2831.98,794.58,1727.51,'Carte Bancaire','Expédiée',0,'8'),
(6,'2025-01-20','FAC0006',1151.97,1382.37,0.00,1382.37,'Carte Bancaire','En cours',0,'2'),
(7,'2025-01-21','FAC0007',850.96,1021.15,48.63,970.09,'Virement Bancaire','En cours',0,'4'),
(8,'2025-01-22','FAC0008',599.99,719.99,0.00,719.99,'Carte Bancaire','En cours',0,'6'),
(9,'2025-01-22','FAC0009',7199.99,8639.99,0.00,8639.99,'Carte Bancaire','En cours',0,'1'),
(10,'2025-01-23','FAC0010',353.98,424.78,119.18,259.12,'PayPal','En cours',0,'8'),
(11,'2025-01-23','FAC0011',599.98,719.98,0.00,719.98,'Carte Bancaire','En cours',0,'12'),
(12,'2025-01-23','FAC0012',719.99,863.99,0.00,863.99,'Virement Bancaire','En cours',0,'7'),
(13,'2025-01-23','FAC0013',479.96,575.95,0.00,575.95,'Carte Bancaire','En cours',0,'9'),
(14,'2025-01-23','FAC0014',800.00,960.00,NULL,100.00,'Carte Bancaire','En cours',0,'11'),
(15,'2025-01-23','FAC0015',99.99,119.99,NULL,0.00,'PayPal','En cours',0,'5'),
(16,'2024-02-15','FAC0016',1079.99,1295.99,0.00,1295.99,'Carte Bancaire','Terminée',0,'3'),
(17,'2024-03-10','FAC0017',71.98,86.38,0.00,86.38,'Virement Bancaire','Terminée',0,'5'),
(18,'2024-04-22','FAC0018',155.99,187.19,0.00,187.19,'Carte Bancaire','Terminée',0,'7'),
(19,'2024-05-05','FAC0019',402.49,482.99,23.00,458.84,'Carte Bancaire','Terminée',0,'4'),
(20,'2024-06-15','FAC0020',599.99,719.99,0.00,719.99,'PayPal','Terminée',0,'9'),
(21,'2024-07-20','FAC0021',6839.99,8207.99,2302.96,5006.87,'Carte Bancaire','Terminée',0,'10'),
(22,'2024-08-25','FAC0022',359.98,431.98,0.00,431.98,'Virement Bancaire','Terminée',0,'6'),
(23,'2024-09-30','FAC0023',589.98,707.98,198.64,431.87,'Carte Bancaire','Terminée',0,'8'),
(24,'2024-10-15','FAC0024',719.99,863.99,0.00,863.99,'Carte Bancaire','Terminée',0,'12'),
(25,'2024-11-25','FAC0025',479.96,575.95,0.00,575.95,'PayPal','Terminée',0,'2');
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
  `prixUnitaireHt` decimal(8,2) DEFAULT NULL,
  `articleTotalHt` decimal(8,2) DEFAULT NULL,
  `tva` decimal(8,2) DEFAULT NULL,
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
('AMP02',7,1,402.49,402.49,80.50,482.99),
('AMP02',19,1,402.49,402.49,80.50,482.99),
('BAT01',1,1,1199.99,1199.99,240.00,1439.99),
('BAT01',5,2,1179.99,2359.98,472.00,2831.98),
('BAT02',10,2,176.99,353.98,70.80,424.78),
('BAT02',22,2,179.99,359.98,72.00,431.98),
('CAS02',13,4,119.99,479.96,95.99,575.95),
('CAS02',25,4,119.99,479.96,95.99,575.95),
('DRU02',6,2,35.99,71.98,14.40,86.38),
('DRU02',17,2,35.99,71.98,14.40,86.38),
('GIT01',1,2,599.99,1199.98,240.00,1439.98),
('GIT02',11,2,299.99,599.98,120.00,719.98),
('GIT02',23,2,294.99,589.98,118.00,707.98),
('MIC02',7,3,149.49,448.47,89.69,538.16),
('MIC02',18,1,155.99,155.99,31.20,187.19),
('PIA01',3,1,959.99,959.99,192.00,1151.99),
('PIA02',4,1,155.99,155.99,31.20,187.19),
('PIA03',9,1,7199.99,7199.99,1440.00,8639.99),
('PIA03',21,1,6839.99,6839.99,1368.00,8207.99),
('SAX01',6,1,1079.99,1079.99,216.00,1295.99),
('SAX01',16,1,1079.99,1079.99,216.00,1295.99),
('TAB01',2,2,402.49,804.98,161.00,965.98),
('TAB02',12,1,719.99,719.99,144.00,863.99),
('TAB02',24,1,719.99,719.99,144.00,863.99),
('VIO01',2,1,459.99,459.99,92.00,551.99),
('VIO02',8,1,599.99,599.99,120.00,719.99),
('VIO02',20,1,599.99,599.99,120.00,719.99);
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

-- 	declaration des variable 
	
	DECLARE PrixUnitaireHt DECIMAL(8,2);
	DECLARE articleTotalTtc DECIMAL(8,2);
	DECLARE tva DECIMAL(8,2);
	DECLARE articleTotalHt DECIMAL(8,2);
	DECLARE numCommande INT;
	
-- 	calcule le prix unitaire du produit (prix d'achat * le coefficient client)
	SET PrixUnitaireHt = (SELECT prixAchatProduit FROM produit p WHERE p.idProduit = NEW.idProduit) * (1 + ((SELECT coefficientVente FROM commande c 
																											LEFT JOIN utilisateur u ON c.refClient = u.refClient 
																											WHERE c.idCommande = NEW.idCommande) / 100));

-- 	calcule le prix hors taxe (quatite * prix unitaire)																											
	SET articleTotalHt =  NEW.quantite * PrixUnitaireHt;										
	
-- 	calcule la tva a rajouter au prix final 
	SET tva = articleTotalHt * 0.20;
	
-- 	additionne le prix hors taxe et le montant de la tva 
	SET articleTotalTtC = articleTotalHt + tva;
	
-- 	renvoie une erreur si le prix est de 0 ou inferieur  
		IF articleTotalTtc  < 0 
            THEN SIGNAL SQLSTATE '40000' SET MESSAGE_TEXT = 'Un problème est survenu. Prix total inferieur a 0 !';
		END IF;
		
-- 	rentre tout les prix finaux dans la table 
    SET NEW.prixUnitaireHt = PrixUnitaireHt;
    SET NEW.articleTotalHt = articleTotalHt;
    SET NEW.tva = tva;
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

-- 	declaration des variable  
	DECLARE commandeTotalHt DECIMAL(8,2);
	DECLARE commandeTotalTtc DECIMAL(8,2);
	DECLARE commandeTotalReduction DECIMAL(8,2);
	DECLARE reduction DECIMAL(8,2);
	DECLARE coefficientReduction INT;
	
-- 	recupere le coefficient de la reduction
	SET coefficientReduction = (SELECT u.coefficientReduction FROM commande c 
								LEFT JOIN utilisateur u ON c.refClient = u.refClient 
									where c.idCommande = NEW.idCommande);
	
-- 	Calculer le total HT et TTC pour cette commande
    SELECT SUM(articleTotalHt), SUM(articleTotalTtc)
    INTO commandeTotalHt, commandeTotalTtC
    FROM contient
    WHERE idCommande = NEW.idCommande
	GROUP BY idCommande;

-- 	calcule le montant de la reduction
	SET reduction = commandeTotalTtC - (commandeTotalTtC / (1 + (coefficientReduction / 100)));
	 	
-- 	applique la reduction si elle est superieur a 0 
	 	IF coefficientReduction > 0 THEN
			SET commandeTotalReduction = commandeTotalTtc * (1 - coefficientReduction / 100);
	 	Else 
	 		SET commandeTotalReduction = commandeTotalTtc;
		END IF;

--  Mettre à jour la commande avec les nouveaux totaux
    UPDATE commande
    SET commandeTotalHt = commandeTotalHt,
    	reduction = reduction,
        commandeTotalTtc = commandeTotalTtc,
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
('AMP02',9,1),
('AMP02',19,1),
('BAT01',1,1),
('BAT01',5,1),
('BAT01',6,1),
('BAT02',12,2),
('BAT02',22,2),
('CAS02',15,4),
('CAS02',25,4),
('DRU02',8,2),
('DRU02',17,2),
('GIT01',1,2),
('GIT02',13,2),
('GIT02',23,2),
('MIC02',9,3),
('MIC02',18,1),
('PIA01',3,1),
('PIA02',4,1),
('PIA03',11,1),
('PIA03',21,1),
('SAX01',8,1),
('SAX01',16,1),
('TAB01',2,2),
('TAB02',14,1),
('TAB02',24,1),
('VIO01',2,1),
('VIO02',10,1),
('VIO02',20,1);
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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
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
(6,'2025-01-21','La Poste','https://track.laposte.com/11240',5),
(7,'2025-01-21','FedEx','https://track.fedex.com/12346',6),
(8,'2025-01-22','UPS','https://track.ups.com/12347',7),
(9,'2025-01-23','DHL','https://track.dhl.com/12348',8),
(10,'2025-01-23','La Poste','https://track.laposte.com/12349',9),
(11,'2025-01-24','Chronopost','https://track.chronopost.com/12350',10),
(12,'2025-01-24','DHL','https://track.dhl.com/12351',11),
(13,'2025-01-25','FedEx','https://track.fedex.com/12352',12),
(14,'2025-01-25','La Poste','https://track.laposte.com/12353',13),
(15,'2025-01-26','UPS','https://track.ups.com/12354',14),
(16,'2025-01-26','DHL','https://track.dhl.com/12355',15),
(17,'2024-02-20','FedEx','https://track.fedex.com/2024_12346',16),
(18,'2024-03-15','UPS','https://track.ups.com/2024_12347',17),
(19,'2024-04-25','DHL','https://track.dhl.com/2024_12348',18),
(20,'2024-05-10','La Poste','https://track.laposte.com/2024_12349',19),
(21,'2024-06-20','Chronopost','https://track.chronopost.com/2024_12350',20),
(22,'2024-07-25','DHL','https://track.dhl.com/2024_12351',21),
(23,'2024-08-30','FedEx','https://track.fedex.com/2024_12352',22),
(24,'2024-10-05','La Poste','https://track.laposte.com/2024_12353',23),
(25,'2024-10-20','UPS','https://track.ups.com/2024_12354',24),
(26,'2024-11-30','DHL','https://track.dhl.com/2024_12355',25);
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
  `prixAchatProduit` decimal(7,2) NOT NULL,
  `descriptionCourtProduit` varchar(50) DEFAULT NULL,
  `descriptionLongProduit` varchar(250) DEFAULT NULL,
  `nomImage` varchar(50) DEFAULT NULL,
  `stock` int(11) DEFAULT NULL,
  `idFournisseur` int(11) NOT NULL,
  `actif` tinyint(1) DEFAULT 1,
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
('AMP01','Amplificateur Guitare',249.99,'Ampli 50W','Amplificateur pour guitare électrique avec une puissance de 50 watts.','ampli_guitare.jpg',20,3,1),
('AMP02','Amplificateur Basse',349.99,'Ampli basse 100W','Amplificateur basse puissant avec 100W pour les concerts.','ampli_basse.jpg',10,3,1),
('BAT01','Batterie Acoustique',999.99,'Kit complet de batterie','Batterie acoustique comprenant 5 fûts et 3 cymbales, idéale pour les concerts en live.','batterie_acoustique.jpg',8,2,1),
('BAT02','Cajón',149.99,'Instrument de percussion','Cajón en bois, idéal pour le flamenco et la musique acoustique.','cajon.jpg',30,2,1),
('CAS01','Casque Audio',149.99,'Casque isolant','Casque audio avec isolation phonique pour une écoute immersive.','casque_audio.jpg',30,4,1),
('CAS02','Enceinte Portable Bluetooth',99.99,'Enceinte Bluetooth','Enceinte portable avec une autonomie de 10 heures.','enceinte_bluetooth.jpg',40,4,1),
('DRU02','Tambourin',29.99,'Petit tambourin','Tambourin léger et robuste, parfait pour accompagner divers styles de musique.','tambourin.jpg',50,2,1),
('GIT01','Guitare Électrique',499.99,'Guitare 6 cordes','Guitare électrique avec un son riche et dynamique, idéale pour le rock et le blues.','guitare_electrique.jpg',25,2,1),
('GIT02','Guitare Classique',249.99,'Guitare 6 cordes','Guitare classique en bois massif, idéale pour les débutants et intermédiaires.','guitare_classique.jpg',20,2,1),
('HAU01','Haut-parleurs de Monitoring',299.99,'Paire de haut-parleurs','Haut-parleurs de monitoring avec une réponse en fréquence plate pour le mixage audio.','haut_parleurs.jpg',18,3,1),
('MIC01','Microphone Studio',199.99,'Micro condensateur','Microphone de studio à condensateur pour une qualité sonore exceptionnelle.','microphone_studio.jpg',50,4,1),
('MIC02','Micro Sans Fil',129.99,'Micro sans fil','Microphone sans fil avec une portée de 30 mètres, parfait pour la scène.','micro_sans_fil.jpg',25,4,1),
('PIA01','Piano Numérique',799.99,'Piano 88 touches','Piano numérique avec 88 touches pondérées, parfait pour les débutants et professionnels.','piano_numerique.jpg',10,1,1),
('PIA02','Clavier MIDI',129.99,'Clavier 49 touches','Clavier MIDI avec 49 touches sensibles à la vélocité pour la production musicale.','clavier_midi.jpg',40,1,1),
('PIA03','Piano à Queue',5999.99,'Piano à queue classique','Piano à queue pour professionnels, avec un son d’excellence.','piano_queue.jpg',2,1,1),
('SAX01','Saxophone Alto',899.99,'Saxophone pour débutants','Saxophone alto avec un son chaleureux, idéal pour l’apprentissage et les concerts.','saxophone_alto.jpg',15,1,1),
('TAB01','Table de Mixage',349.99,'Table 12 canaux','Table de mixage professionnelle avec 12 canaux pour DJ et enregistrement en studio.','table_mixage.jpg',15,4,1),
('TAB02','Table de Mixage 24 Canaux',599.99,'Table DJ avancée','Table de mixage professionnelle pour DJ avec 24 canaux.','table_mixage_24.jpg',5,4,1),
('VIO01','Violon',399.99,'Violon 4/4','Violon 4/4 avec un son clair et profond, parfait pour les musiciens avancés.','violon.jpg',12,3,1),
('VIO02','Violon Électrique',499.99,'Violon électrique 4/4','Violon électrique avec un son amplifié et riche, idéal pour les concerts modernes.','violon_electrique.jpg',8,3,1);
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
  `coefficientVente` int(11) DEFAULT NULL,
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
/*!50003 DROP PROCEDURE IF EXISTS `BeneficeFournisseur` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`localhost` PROCEDURE `BeneficeFournisseur`(IN idFour INT)
BEGIN
SELECT nomFournisseur,SUM(commandeTotalTtc) as Benefice,SUM(commandeTotalReduction) as BeneficeAvecReduction
FROM fournisseur f
LEFT JOIN produit p on p.idFournisseur = f.idFournisseur
JOIN contient c on c.idProduit = p.idProduit
JOIN commande c2 on c2.idCommande = c.idCommande
WHERE f.idFournisseur = idFour
GROUP BY f.idFournisseur;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'IGNORE_SPACE,STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `BeneficeMonth` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`localhost` PROCEDURE `BeneficeMonth`(IN dateCompare INT)
BEGIN
   SELECT DATE_FORMAT(dateCommande, "%M"),SUM(commandeTotalTtc) as Benefice,SUM(commandeTotalReduction) as BeneficeAvecReduction 
   FROM commande
	WHERE YEAR(dateCommande) = dateCompare 
	Group BY MONTH(dateCommande);

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'IGNORE_SPACE,STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `commandeStatut` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`localhost` PROCEDURE `commandeStatut`(IN statut VARCHAR(50))
BEGIN
	
	SELECT * FROM commande c
	WHERE c.statut = statut;
	
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
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
CREATE DEFINER=`admin`@`localhost` PROCEDURE `DetailCommande`(IN commandeNum INT)
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
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'IGNORE_SPACE,STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `repartitionTypeClient` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`localhost` PROCEDURE `repartitionTypeClient`()
BEGIN

	SELECT u.type,SUM(prixUnitaireHt) as chiffreAffaire
	FROM utilisateur u 
	LEFT JOIN commande c on c.refClient = u.refClient
	JOIN contient c2 on c.idCommande = c2.idCommande
	JOIN produit p on p.idProduit = c2.idProduit
	GROUP by u.type
	ORDER BY chiffreAffaire DESC
	LIMIT 10;
 
END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'IGNORE_SPACE,STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `top10ClientCA` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`localhost` PROCEDURE `top10ClientCA`()
BEGIN
	
	SELECT u.refClient,u.nom,SUM(prixUnitaireHt) as chiffreAffaire,COUNT(c.idCommande) as nombreCommande
	FROM utilisateur u 
	LEFT JOIN commande c on c.refClient = u.refClient
	JOIN contient c2 on c.idCommande = c2.idCommande
	JOIN produit p on p.idProduit = c2.idProduit
	GROUP by u.refClient
	ORDER BY chiffreAffaire DESC , nombreCommande ASC
	LIMIT 10;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'IGNORE_SPACE,STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `top10ProduitCommander` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`localhost` PROCEDURE `top10ProduitCommander`(IN dateCompare INT)
BEGIN
	
	SELECT p.idProduit,p.nomProduit,Sum(c.quantite) as quantiteCommander,f.nomFournisseur,SUM(commandeTotalTtc) as Benefice,SUM(commandeTotalReduction) as BeneficeAvecReduction
	FROM fournisseur f
	LEFT JOIN produit p on p.idFournisseur = f.idFournisseur
	JOIN contient c on c.idProduit = p.idProduit
	JOIN commande c2 on c2.idCommande = c.idCommande
	WHERE YEAR(c2.dateCommande) = dateCompare
	GROUP BY p.idProduit
	ORDER BY quantiteCommander DESC
	LIMIT 10;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'IGNORE_SPACE,STRICT_TRANS_TABLES,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
/*!50003 DROP PROCEDURE IF EXISTS `top10ProduitMarge` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_general_ci */ ;
DELIMITER ;;
CREATE DEFINER=`admin`@`localhost` PROCEDURE `top10ProduitMarge`(IN dateCompare INT)
BEGIN
	
	SELECT p.idProduit,p.nomProduit,f.nomFournisseur,AVG(prixUnitaireHt) - p.prixAchatProduit Marge
	FROM fournisseur f
	LEFT JOIN produit p on p.idFournisseur = f.idFournisseur
	JOIN contient c on c.idProduit = p.idProduit
	JOIN commande c2 on c2.idCommande = c.idCommande
	WHERE YEAR(c2.dateCommande) = dateCompare
	GROUP BY p.idProduit
	ORDER BY marge DESC 
	LIMIT 10;

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

-- Dump completed on 2025-01-23 15:43:11
