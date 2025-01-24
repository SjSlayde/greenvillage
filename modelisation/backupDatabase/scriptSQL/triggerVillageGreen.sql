use testdbgreenvillage;

--- trigger pour mettr les prix a jour dans le detail de la commande avant insertion

DELIMITER |
CREATE TRIGGER insert_contient BEFORE INSERT ON contient
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
    END;
| 
DELIMITER ;

-- trigger pour actualiser la table commande apres insertion 

DELIMITER |
CREATE TRIGGER change_commande 
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
   
    END;
| 
DELIMITER ;

-- === PROCEDURES ===

-- Détail des commandes : Récupération des informations complètes pour une commande donnée

DELIMITER |

CREATE PROCEDURE DetailCommande(IN commandeNum INT)

BEGIN
   SELECT c.idCommande,p.idProduit,c2.quantite,nomProduit,l.dateLivraison,d.idProduit, d.idLivraison, d.quantiteLiv
	FROM commande c  left join contient c2 on c.idCommande = c2.idCommande 
	join produit p on c2.idProduit = p.idProduit 
	join livraison l on l.idCommande = c.idCommande
	join detailLiv d on d.idLivraison = l.idLivraison
	WHERE c.idCommande = commandeNum AND d.idProduit = p.idProduit;

END |

DELIMITER ;


-- Bénéfice mensuel pour une année donnée
DELIMITER |

CREATE PROCEDURE BeneficeMonth(IN dateCompare INT)

BEGIN
   SELECT DATE_FORMAT(dateCommande, "%M"),SUM(commandeTotalTtc) as Benefice,SUM(commandeTotalReduction) as BeneficeAvecReduction 
   FROM commande
	WHERE YEAR(dateCommande) = dateCompare 
	Group BY MONTH(dateCommande);

END |

DELIMITER ;

-- Bénéfice par fournisseur
DELIMITER |

CREATE PROCEDURE BeneficeFournisseur(IN idFour INT)

BEGIN
SELECT nomFournisseur,SUM(commandeTotalTtc) as Benefice,SUM(commandeTotalReduction) as BeneficeAvecReduction
FROM fournisseur f
LEFT JOIN produit p on p.idFournisseur = f.idFournisseur
JOIN contient c on c.idProduit = p.idProduit
JOIN commande c2 on c2.idCommande = c.idCommande
WHERE f.idFournisseur = idFour
GROUP BY f.idFournisseur;

END |

DELIMITER ;

-- Top 10 des produits les plus commandés
DELIMITER |

CREATE PROCEDURE top10ProduitCommander(IN dateCompare INT)

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

END |

DELIMITER ;

-- creation d'une procedure pour le TOP 10 des produits les plus rémunérateurs pour une année sélectionnée (référence et nom du produit, marge, fournisseur)
DELIMITER |

CREATE PROCEDURE top10ProduitMarge(IN dateCompare INT)

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

END |

DELIMITER ;

-- creation d'une procedure pour Top 10 des clients en chiffre d'affaires	
DELIMITER |

CREATE PROCEDURE top10ClientCA()

BEGIN
	
	SELECT u.refClient,u.nom,SUM(prixUnitaireHt) as chiffreAffaire,COUNT(c.idCommande) as nombreCommande
	FROM utilisateur u 
	LEFT JOIN commande c on c.refClient = u.refClient
	JOIN contient c2 on c.idCommande = c2.idCommande
	JOIN produit p on p.idProduit = c2.idProduit
	GROUP by u.refClient
	ORDER BY chiffreAffaire DESC , nombreCommande ASC
	LIMIT 10;

END |

DELIMITER ;	
	
-- creation d'une procedure pour Top 10 des clients en nombre de commandes 

-- DELIMITER |
-- 
-- CREATE PROCEDURE top10ClientNC()
-- 
-- BEGIN
-- 	
-- 	SELECT u.refClient,u.nom,p.idProduit,p.nomProduit,COUNT(c.idCommande) as nombreCommande
-- 	FROM utilisateur u 
-- 	LEFT JOIN commande c on c.refClient = u.refClient
-- 	JOIN contient c2 on c.idCommande = c2.idCommande
-- 	JOIN produit p on p.idProduit = c2.idProduit
-- 	GROUP by u.refClient
-- 	ORDER BY nombreCommande DESC
-- 	LIMIT 10;
-- 
-- END |
-- 
-- DELIMITER ;	

-- Procédure pour répartir le chiffre d'affaires par type de client
DELIMITER |
	
CREATE PROCEDURE repartitionTypeClient()
	
BEGIN

	-- Sélectionne le type de client et le chiffre d'affaires total associé
	SELECT u.type,SUM(prixUnitaireHt) as chiffreAffaire
	FROM utilisateur u 
	LEFT JOIN commande c on c.refClient = u.refClient
	JOIN contient c2 on c.idCommande = c2.idCommande
	JOIN produit p on p.idProduit = c2.idProduit
	GROUP by u.type
	ORDER BY chiffreAffaire DESC
	LIMIT 10; -- Limite les résultats aux 10 premiers
 
END |
	
DELIMITER ;

-- Procédure pour récupérer les commandes selon un statut spécifique
DELIMITER |

CREATE PROCEDURE commandeStatut(IN statut VARCHAR(50))

BEGIN
	
	-- Sélectionne toutes les commandes avec le statut donné
	SELECT * FROM commande c
	WHERE c.statut = statut;
	
END |

DELIMITER ;


-- Procédure pour récupérer les commandes dont le paiement n'est pas validé
DELIMITER |

CREATE PROCEDURE commandePaiementValide()

BEGIN
	-- Sélectionne toutes les commandes dont le paiement n'est pas validé
	SELECT * FROM commande c
	WHERE c.paiementValide = 0;
	
END |

DELIMITER ;

-- Procédure pour calculer le délai moyen de livraison
DELIMITER |

CREATE PROCEDURE DelaiMoyenLivraison()

BEGIN
	-- Calcule le délai moyen entre la commande et la livraison ainsi que le nombre de livraisons
	SELECT 	AVG(DATEDIFF(dateLivraison, dateCommande)) as delaiMoyen,
			COUNT(l.idLivraison) as nombreLivraison 
	FROM commande c 
	LEFT JOIN livraison l on l.idCommande = c.idCommande;
	
END |

DELIMITER ;


-- === VUES ===

-- Vue pour joindre Produits et Fournisseurs
CREATE VIEW v_fournisseurProduit
AS
SELECT idProduit, nomProduit, prixAchatProduit, descriptionCourtProduit, descriptionLongProduit, nomImage, stock, actif,f.idFournisseur, nomFournisseur, emailFournisseur, telephoneFournisseur FROM produit p
LEFT JOIN fournisseur f on f.idFournisseur = p.idFournisseur
GROUP BY idProduit;

SELECT * FROM v_fournisseurProduit;

CREATE VIEW v_produitRubrique
AS
SELECT p.idProduit, nomProduit, prixAchatProduit, descriptionCourtProduit, descriptionLongProduit, nomImage, stock, actif, nomSousRubrique, nomRubrique FROM produit p
LEFT JOIN avoir a on a.idProduit = p.idProduit
JOIN sousRubrique s on s.idSousRubrique = a.idSousRubrique
JOIN rubrique r on r.idRubrique = s.idRubrique
GROUP BY p.idProduit;


SELECT * FROM produit p;
--	calcule pour verifier le chiffre d'affaire par client
-- 	SELECT u.refClient,u.nom,p.idProduit,p.nomProduit,SUM(prixUnitaireHt) as chiffreAffaire
-- 	FROM utilisateur u 
-- 	LEFT JOIN commande c on c.refClient = u.refClient
-- 	JOIN contient c2 on c.idCommande = c2.idCommande
-- 	JOIN produit p on p.idProduit = c2.idProduit
-- 	WHERE u.refClient = 1
-- 	GROUP BY p.idProduit;

-- donne le detail du contenu d'une commande
CALL DetailCommande(1);
-- donne le benefice mois par mois d'une année ps:faut mettre 2024 pas assez de donnée pour les autre année.
CALL BeneficeMonth(2024);
-- donne le benefice fait par fournisseur
CALL BeneficeFournisseur(3);
-- donne le top 10 des produit les plus commander sur une année
CALL top10ProduitCommander(2025);
-- top 10 des produit ou il y a la plus grosse marge sur une année
CALL top10ProduitMarge(2025);
-- classement des client reparti par type et la somme génére en chiffres d'affaires
CALL repartitionTypeClient; 
-- donne le top 10 des client par chiffres d'affaires genere et le nombre de commande
CALL top10ClientCA;
-- donne le top des produit ou il y a la plus grande marge
CALL top10ProduitMarge(2024);
-- donne toutes les commandes ou le statut est en cours ('En cours', 'Expédiée', 'Partiellement expédiée', 'Terminée').
CALL commandeStatut('En cours');  
-- donne toutes les commande ou le paiement est en cours 
CALL commandePaiementValide;
-- donne le delai moyen de livraison 
CALL delaiMoyenLivraison;
-- vue pour la jointure Produits - Fournisseurs
SELECT * FROM v_fournisseurProduit;
-- vue pour la jointure Produits - Catégorie/Sous catégorie
SELECT * FROM v_produitRubrique;












   
   
   