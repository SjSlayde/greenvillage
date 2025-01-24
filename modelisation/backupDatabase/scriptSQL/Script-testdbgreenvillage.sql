DROP DATABASE IF EXISTS testdbgreenvillage;
CREATE DATABASE testdbgreenvillage;
USE testdbgreenvillage;

CREATE TABLE rubrique(
   idRubrique INT AUTO_INCREMENT,
   nomRubrique VARCHAR(50) ,
   imageRubrique VARCHAR(50) ,
   PRIMARY KEY(idRubrique)
);

CREATE TABLE sousRubrique(
   idSousRubrique INT AUTO_INCREMENT,
   nomSousRubrique VARCHAR(50) ,
   imageSousRubrique VARCHAR(50) ,
   idRubrique INT NOT NULL,
   PRIMARY KEY(idSousRubrique),
   FOREIGN KEY(idRubrique) REFERENCES rubrique(idRubrique)
);

CREATE TABLE utilisateur(
   refClient VARCHAR(50) ,
   nom VARCHAR(50) ,
   prenom VARCHAR(50) ,
   password VARCHAR(50)  NOT NULL,
   email VARCHAR(50)  NOT NULL,
   coefficientVente INT,
   type VARCHAR(30) ,
   telephone VARCHAR(10) ,
   titreRole VARCHAR(50) ,
   coefficientReduction INT,
   refClient_1 VARCHAR(50) ,
   PRIMARY KEY(refClient),
   FOREIGN KEY(refClient_1) REFERENCES utilisateur(refClient)
);

CREATE TABLE adresse(
   idAdresse INT AUTO_INCREMENT,
   numeroDeRue VARCHAR(5) ,
   ville VARCHAR(51) ,
   codePostal VARCHAR(5) ,
   nomRue VARCHAR(50) ,
   complement VARCHAR(50) ,
   PRIMARY KEY(idAdresse)
);

CREATE TABLE commande(
   idCommande INT AUTO_INCREMENT,
   dateCommande DATE,
   numFacturation VARCHAR(10)  NOT NULL,
   commandeTotalHt DECIMAL(8,2)   NOT NULL,
   commandeTotalTtc DECIMAL(8,2)   NOT NULL,
   reduction DECIMAL(8,2),
   CommandeTotalReduction DECIMAL(8,2),
   moyenPaiement VARCHAR(50) ,
   statut ENUM('En cours', 'Expédiée', 'Partiellement expédiée', 'Terminée') DEFAULT 'En cours',
   paiementValide BOOLEAN DEFAULT FALSE,
   refClient VARCHAR(50)  NOT NULL,
   PRIMARY KEY(idCommande),
   FOREIGN KEY(refClient) REFERENCES utilisateur(refClient)
);

CREATE TABLE livraison(
   idLivraison INT AUTO_INCREMENT,
   dateLivraison DATE NOT NULL,
   transporteur VARCHAR(50) ,
   url_suivi VARCHAR(50) ,
   idCommande INT NOT NULL,
   PRIMARY KEY(idLivraison),
   FOREIGN KEY(idCommande) REFERENCES commande(idCommande)
);

CREATE TABLE fournisseur(
   idFournisseur INT AUTO_INCREMENT,
   nomFournisseur VARCHAR(50)  NOT NULL,
   emailFournisseur VARCHAR(50) ,
   telephoneFournisseur VARCHAR(50) ,
   idAdresse INT NOT NULL,
   PRIMARY KEY(idFournisseur),
   FOREIGN KEY(idAdresse) REFERENCES adresse(idAdresse)
);

CREATE TABLE produit(
   idProduit VARCHAR(5) ,
   nomProduit VARCHAR(50)  NOT NULL,
   prixAchatProduit DECIMAL(7,2)   NOT NULL,
   descriptionCourtProduit VARCHAR(50) ,
   descriptionLongProduit VARCHAR(250) ,
   nomImage VARCHAR(50) ,
   stock INT,
   idFournisseur INT NOT NULL,
   actif BOOLEAN DEFAULT TRUE,
   PRIMARY KEY(idProduit),
   FOREIGN KEY(idFournisseur) REFERENCES fournisseur(idFournisseur)
);

CREATE TABLE avoir(
   idProduit VARCHAR(5) ,
   idSousRubrique INT,
   PRIMARY KEY(idProduit, idSousRubrique),
   FOREIGN KEY(idProduit) REFERENCES produit(idProduit),
   FOREIGN KEY(idSousRubrique) REFERENCES sousRubrique(idSousRubrique)
);

CREATE TABLE contient(
   idProduit VARCHAR(5) ,
   idCommande INT,
   quantite INT,
   prixUnitaireHt DECIMAL(8,2),
   articleTotalHt DECIMAL(8,2),
   tva DECIMAL(8,2),
   articleTotalTtc DECIMAL(8,2),
   PRIMARY KEY(idProduit, idCommande),
   FOREIGN KEY(idProduit) REFERENCES produit(idProduit),
   FOREIGN KEY(idCommande) REFERENCES commande(idCommande)
);

CREATE TABLE a2(
   refClient VARCHAR(50) ,
   idAdresse INT,
   Type VARCHAR(20) ,
   PRIMARY KEY(refClient, idAdresse , Type),
   FOREIGN KEY(refClient) REFERENCES utilisateur(refClient),
   FOREIGN KEY(idAdresse) REFERENCES adresse(idAdresse)
);



CREATE TABLE detailLiv(
   idProduit VARCHAR(5) ,
   idLivraison INT,
   quantiteLiv INT,
   PRIMARY KEY(idProduit, idLivraison),
   FOREIGN KEY(idProduit) REFERENCES produit(idProduit),
   FOREIGN KEY(idLivraison) REFERENCES livraison(idLivraison)
);








