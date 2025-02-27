use testdbgreenvillage;


INSERT INTO adresse (idAdresse, numeroDeRue, ville, codePostal, nomRue)
VALUES 
    (1, '13627', 'Bradenton', '34282', 'Bashford Road'),
    (2, '93', 'São Manuel', '80000', 'Gerald Crossing'),
    (3, '1433', 'Nueva Cajamarca', '56123', 'Mcguire Terrace'),
    (4, '3790', 'Horizonte', '62880', 'John Wall Crossing'),
    (5, '36', 'Portelândia', '75835', 'Westend Parkway'),
    (6, '625', 'Bungu', '98561', 'Namekagon Court'),
    (7, '3355', 'Revava', '75123', 'Fair Oaks Center'),
    (8, '5055', 'Novogireyevo', '43324', 'Monterey Parkway'),
    (9, '648', 'Johanneshov', '12136', 'Maple Plaza'),
    (10, '1996', 'Guam Government House', '96928', 'Prentice Center'),
    (11, '19917', 'Wien', '12001', 'Brickson Park Way'),
    (12, '149', 'Hino', '91954', 'Cambridge Parkway'),
    (13, '69237', 'Kangalassy', '67790', 'Oneill Avenue'),
    (14, '5795', 'Tianyi', '87451', 'Huxley Point'),
    (15, '582', 'Repušnica', '44320', 'Dapin Pass'),
    (16, '8964', 'Golcowa', '36231', 'Fulton Pass'),
    (17, '77863', 'Banjar Yehsatang', '19547', 'Kim Center'),
    (18, '358', 'Aktau', '95780', 'Valley Edge Lane'),
    (19, '393', 'Koszyce Wielkie', '33111', 'Northridge Trail'),
    (20, '0443', 'Chakaray', '04587', 'Lakewood Drive'),
    (21, '842', 'Bunawan', '85064', 'Golden Leaf Court'),
    (22, '4085', 'La Hacienda', '17515', 'Lakeland Terrace'),
    (23, '764', 'Mangochi', '65852', 'Carioca Hill'),
    (24, '78200', 'Figueira dos Cavaleiros', '79004', 'Anthes Pass'),
    (25, '2424', 'Shatian', '54123', 'Ridgeview Parkway');

insert into fournisseur ( nomFournisseur, emailFournisseur, telephoneFournisseur, idAdresse) values 
    ( 'Buzzshare', 'qarsnell0@google.fr', '2879069540', 1),
    ('Browseblab', 'dsmeal1@tripadvisor.com', '9294319928', 2),
    ('Babbleblab', 'cmarkwick2@livejournal.com', '9973556322', 3),
    ('Flipstorm', 'jkeyzor3@springer.com', '6545363454', 4);

INSERT INTO utilisateur (refClient, nom, prenom, password, email, coefficientVente, type, telephone, titreRole, coefficientReduction, refClient_1)
VALUES 
	(3, 'Denny', 'Plain', 'nY7!&_4dO,P7G', 'dplain2@google.pl', 20, 'personnel', '0727737577', 'Commercial', 0, 3),
	(12, 'Gale', 'Fulbrook', 'cX4\VGk@,OESGtk', 'gfulbrookb@behance.net', 20, 'personnel', '0737595866', 'Commercial', 0, 3);
  
INSERT INTO utilisateur (refClient, nom, prenom, password, email, coefficientVente, type, telephone, titreRole, coefficientReduction, refClient_1)
VALUES 
    (1, 'Mame', 'Heales', 'kW8>3z*z', 'mheales0@google.com.hk', 20, 'particulier', '0679435690', '', 0, 3),
    (2, 'Hastings', 'Wheowall', 'sW1/\C7.R|', 'hwheowall1@webs.com', 20, 'personnel', '0657298690', 'Gestion', 0, 3),
    (4, 'Lincoln', 'Glendenning', 'oB7&rV_eq', 'lglendenning3@chronoengine.com', 15, 'professionnel', '0762618553', '', 5, 12),
    (5, 'Perren', 'Tidmarsh', 'dE3.nUm66', 'ptidmarsh4@virginia.edu', 20, 'personnel', '0683941609', 'Directeur', 0, 3),
    (6, 'Kasey', 'Cove', 'uV5>''!~}uS', 'kcove5@usda.gov', 20, 'particulier', '0608249058', '', 0, 3),
    (7, 'Jessie', 'Frondt', 'eY0*HA!Mwe', 'jfrondt6@ftc.gov', 20, 'particulier', '0728238326', '', 0, 3),
    (8, 'Rivi', 'Bowyer', 'zI9(AW|?.|(', 'rbowyer7@hao123.com', 18, 'professionnel', '0676519897', '', 39, 12),
    (9, 'Trixy', 'Jest', 'hR3!KDb''n', 'tjest8@illinois.edu', 20, 'personnel', '0732089390', 'Gestion', 0, 3),
    (10, 'Artemas', 'Baton', 'dZ9@>thRWK_ILr', 'abaton9@springer.com', 14, 'professionnel', '0942057647', '', 39, 3),
    (11, 'Esra', 'Ganforth', 'zC5@zeC`6&', 'eganfortha@clickbank.net', 16, 'professionnel', '0686192299', '', 26, 12);

INSERT INTO a2 (Type, refClient, idAdresse) VALUES 
	('adFacturation', 1, 19),    
	('adLivraison', 2, 23),
	('adFacturation', 2, 18),
    ('adLivraison', 3, 20),
    ('adFacturation', 8, 14),
    ('adLivraison', 8, 14),
    ('adFacturation', 3, 6),
    ('adFacturation', 7, 18),
    ('adLivraison', 7, 18),
    ('adLivraison', 6, 10),
    ('adFacturation', 11, 7),
    ('adLivraison', 11, 7),
    ('adFacturation', 4, 11),
    ('adLivraison', 1, 9),
    ('adLivraison', 9, 20),
    ('adFacturation', 12, 13),
    ('adFacturation', 10, 18),
    ('adLivraison', 4, 25),
    ('adFacturation', 5, 10),
    ('adLivraison', 5, 10),
    ('adFacturation', 6, 21),
    ('adLivraison', 12, 16),
    ('adFacturation', 9, 24),
    ('adLivraison', 10, 13);

INSERT INTO produit (idProduit, nomProduit, prixAchatProduit, descriptionCourtProduit, descriptionLongProduit, nomImage, stock, idFournisseur) VALUES 
('GIT01', 'Guitare Électrique', 499.99, 'Guitare 6 cordes', 'Guitare électrique avec un son riche et dynamique, idéale pour le rock et le blues.', 'guitare_electrique.jpg', 25, 2),
('PIA01', 'Piano Numérique', 799.99, 'Piano 88 touches', 'Piano numérique avec 88 touches pondérées, parfait pour les débutants et professionnels.', 'piano_numerique.jpg', 10, 1),
('BAT01', 'Batterie Acoustique', 999.99, 'Kit complet de batterie', 'Batterie acoustique comprenant 5 fûts et 3 cymbales, idéale pour les concerts en live.', 'batterie_acoustique.jpg', 8, 2),
('MIC01', 'Microphone Studio', 199.99, 'Micro condensateur', 'Microphone de studio à condensateur pour une qualité sonore exceptionnelle.', 'microphone_studio.jpg', 50, 4),
('TAB01', 'Table de Mixage', 349.99, 'Table 12 canaux', 'Table de mixage professionnelle avec 12 canaux pour DJ et enregistrement en studio.', 'table_mixage.jpg', 15, 4),
('CAS01', 'Casque Audio', 149.99, 'Casque isolant', 'Casque audio avec isolation phonique pour une écoute immersive.', 'casque_audio.jpg', 30, 4),
('AMP01', 'Amplificateur Guitare', 249.99, 'Ampli 50W', 'Amplificateur pour guitare électrique avec une puissance de 50 watts.', 'ampli_guitare.jpg', 20, 3),
('VIO01', 'Violon', 399.99, 'Violon 4/4', 'Violon 4/4 avec un son clair et profond, parfait pour les musiciens avancés.', 'violon.jpg', 12, 3),
('PIA02', 'Clavier MIDI', 129.99, 'Clavier 49 touches', 'Clavier MIDI avec 49 touches sensibles à la vélocité pour la production musicale.', 'clavier_midi.jpg', 40, 1),
('HAU01', 'Haut-parleurs de Monitoring', 299.99, 'Paire de haut-parleurs', 'Haut-parleurs de monitoring avec une réponse en fréquence plate pour le mixage audio.', 'haut_parleurs.jpg', 18, 3),
('SAX01', 'Saxophone Alto', 899.99, 'Saxophone pour débutants', 'Saxophone alto avec un son chaleureux, idéal pour l’apprentissage et les concerts.', 'saxophone_alto.jpg', 15, 1),
('DRU02', 'Tambourin', 29.99, 'Petit tambourin', 'Tambourin léger et robuste, parfait pour accompagner divers styles de musique.', 'tambourin.jpg', 50, 2),
('MIC02', 'Micro Sans Fil', 129.99, 'Micro sans fil', 'Microphone sans fil avec une portée de 30 mètres, parfait pour la scène.', 'micro_sans_fil.jpg', 25, 4),
('AMP02', 'Amplificateur Basse', 349.99, 'Ampli basse 100W', 'Amplificateur basse puissant avec 100W pour les concerts.', 'ampli_basse.jpg', 10, 3),
('VIO02', 'Violon Électrique', 499.99, 'Violon électrique 4/4', 'Violon électrique avec un son amplifié et riche, idéal pour les concerts modernes.', 'violon_electrique.jpg', 8, 3),
('PIA03', 'Piano à Queue', 5999.99, 'Piano à queue classique', 'Piano à queue pour professionnels, avec un son d’excellence.', 'piano_queue.jpg', 2, 1),
('BAT02', 'Cajón', 149.99, 'Instrument de percussion', 'Cajón en bois, idéal pour le flamenco et la musique acoustique.', 'cajon.jpg', 30, 2),
('GIT02', 'Guitare Classique', 249.99, 'Guitare 6 cordes', 'Guitare classique en bois massif, idéale pour les débutants et intermédiaires.', 'guitare_classique.jpg', 20, 2),
('TAB02', 'Table de Mixage 24 Canaux', 599.99, 'Table DJ avancée', 'Table de mixage professionnelle pour DJ avec 24 canaux.', 'table_mixage_24.jpg', 5, 4),
('CAS02', 'Enceinte Portable Bluetooth', 99.99, 'Enceinte Bluetooth', 'Enceinte portable avec une autonomie de 10 heures.', 'enceinte_bluetooth.jpg', 40, 4);


INSERT INTO rubrique (nomRubrique, imageRubrique) VALUES 
('Instruments à Cordes', 'instruments_cordes.jpg'),
('Instruments à Clavier', 'instruments_clavier.jpg'),
('Percussions', 'percussions.jpg'),
('Accessoires Audio', 'accessoires_audio.jpg'),
('Équipement DJ', 'equipement_dj.jpg');

INSERT INTO sousRubrique (nomSousRubrique, imageSousRubrique, idRubrique) VALUES 
('Guitares', 'guitares.jpg', 1),
('Violons', 'violons.jpg', 1),
('Pianos Numériques', 'pianos_numeriques.jpg', 2),
('Claviers MIDI', 'claviers_midi.jpg', 2),
('Batteries Acoustiques', 'batteries_acoustiques.jpg', 3),
('Casques Audio', 'casques_audio.jpg', 4),
('Microphones', 'microphones.jpg', 4),
('Amplificateurs', 'amplificateurs.jpg', 4),
('Tables de Mixage', 'tables_mixage.jpg', 5),
('Haut-parleurs', 'haut_parleurs.jpg', 4),
('Saxophones','',1),  -- Instruments à Vent (à ajouter si non existant)
('Pianos Classiques','', 2);  -- Instruments à Clavier

INSERT INTO avoir (idProduit, idSousRubrique) VALUES 
('GIT01', 1), -- Guitare Électrique -> Guitares
('VIO01', 2), -- Violon -> Violons
('PIA01', 3), -- Piano Numérique -> Pianos Numériques
('PIA02', 4), -- Clavier MIDI -> Claviers MIDI
('BAT01', 5), -- Batterie Acoustique -> Batteries Acoustiques
('CAS01', 6), -- Casque Audio -> Casques Audio
('MIC01', 7), -- Microphone Studio -> Microphones
('AMP01', 8), -- Amplificateur Guitare -> Amplificateurs
('TAB01', 9), -- Table de Mixage DJ -> Tables de Mixage
('HAU01', 10), -- Haut-parleurs de Monitoring -> HAUT-PARLEURS
('SAX01', 1),
('DRU02', 5),
('MIC02', 7),
('AMP02', 8),
('VIO02', 2),
('PIA03', 12),
('BAT02', 3),
('GIT02', 1),
('TAB02', 9),
('CAS02', 10);


INSERT INTO commande (commandeTotalReduction, dateCommande, numFacturation, commandeTotalHt, commandeTotalTtc, moyenPaiement, refClient) VALUES 
(150.50, '2025-01-15', 'FAC0001', 125.42, 150.50, 'Carte Bancaire', 1),
(320.00, '2025-01-16', 'FAC0002', 268.91, 320.00, 'PayPal', 4),
(78.30, '2025-01-17', 'FAC0003', 65.73, 78.30, 'Carte Bancaire', 1),
(215.90, '2025-01-18', 'FAC0004', 181.93, 215.90, 'Virement Bancaire', 12),
(460.00, '2025-01-19', 'FAC0005', 387.60, 460.00, 'Carte Bancaire', 8),
(50.00, '2025-01-20', 'FAC0006', 400.00, 480.00, 'Carte Bancaire', 2),
(75.00, '2025-01-21', 'FAC0007', 625.00, 750.00, 'Virement Bancaire', 4),
(0.00, '2025-01-22', 'FAC0008', 149.99, 179.99, 'Carte Bancaire', 6),
(30.00, '2025-01-22', 'FAC0009', 200.00, 240.00, 'Carte Bancaire', 1),
(99.99, '2025-01-23', 'FAC0010', 499.99, 599.98, 'PayPal', 8),
(0.00, '2025-01-23', 'FAC0011', 5999.99, 7199.99, 'Carte Bancaire', 12),
(50.00, '2025-01-23', 'FAC0012', 300.00, 360.00, 'Virement Bancaire', 7),
(80.00, '2025-01-23', 'FAC0013', 400.00, 480.00, 'Carte Bancaire', 9),
(100.00, '2025-01-23', 'FAC0014', 800.00, 960.00, 'Carte Bancaire', 11),
(0.00, '2025-01-23', 'FAC0015', 99.99, 119.99, 'PayPal', 5),
(50.00, '2024-02-15', 'FAC0016', 400.00, 480.00, 'Carte Bancaire', 3),
(75.00, '2024-03-10', 'FAC0017', 625.00, 750.00, 'Virement Bancaire', 5),
(0.00, '2024-04-22', 'FAC0018', 149.99, 179.99, 'Carte Bancaire', 7),
(30.00, '2024-05-05', 'FAC0019', 200.00, 240.00, 'Carte Bancaire', 4),
(99.99, '2024-06-15', 'FAC0020', 499.99, 599.98, 'PayPal', 9),
(0.00, '2024-07-20', 'FAC0021', 5999.99, 7199.99, 'Carte Bancaire', 10),
(50.00, '2024-08-25', 'FAC0022', 300.00, 360.00, 'Virement Bancaire', 6),
(80.00, '2024-09-30', 'FAC0023', 400.00, 480.00, 'Carte Bancaire', 8),
(100.00, '2024-10-15', 'FAC0024', 800.00, 960.00, 'Carte Bancaire', 12),
(0.00, '2024-11-25', 'FAC0025', 99.99, 119.99, 'PayPal', 2);


-- mis a jour des statut des commande  

    UPDATE commande
    SET statut = 'Terminée'
    WHERE YEAR(dateCommande) != 2025; 
    UPDATE commande
    SET paiementValide = 1
    WHERE statut = 'Terminée';
    UPDATE commande
    SET statut = 'Expédiée'
    WHERE YEAR(dateCommande) = 2025 AND DATEDIFF(dateCommande , '2025-01-20') < 0; 

INSERT INTO contient (idProduit, idCommande, quantite) VALUES 
('GIT01', 1, 2),
('BAT01', 1, 1),
('VIO01', 2, 1),
('TAB01', 2, 2),
('PIA01', 3, 1),
('PIA02', 4, 1),
('BAT01', 5, 2),
('SAX01', 6, 1),
('DRU02', 6, 2),
('MIC02', 7, 3),
('AMP02', 7, 1),
('VIO02', 8, 1),
('PIA03', 9, 1),
('BAT02', 10, 2),
('GIT02', 11, 2),
('TAB02', 12, 1),
('CAS02', 13, 4),
('SAX01', 16, 1),
('DRU02', 17, 2),
('MIC02', 18, 1),
('AMP02', 19, 1),
('VIO02', 20, 1),
('PIA03', 21, 1),
('BAT02', 22, 2),
('GIT02', 23, 2),
('TAB02', 24, 1),
('CAS02', 25, 4);

INSERT INTO livraison (dateLivraison, transporteur, url_suivi, idCommande) 
VALUES 
('2025-01-18', 'DHL', 'https://track.dhl.com/12345', 1),
('2025-01-19', 'FedEx', 'https://track.fedex.com/67890', 2),
('2025-01-20', 'UPS', 'https://track.ups.com/13579', 3),
('2025-01-21', 'Chronopost', 'https://track.chronopost.com/24680', 4),
('2025-01-22', 'La Poste', 'https://track.laposte.com/11223', 5),
('2025-01-21', 'La Poste', 'https://track.laposte.com/11240', 5),
('2025-01-21', 'FedEx', 'https://track.fedex.com/12346', 6),
('2025-01-22', 'UPS', 'https://track.ups.com/12347', 7),
('2025-01-23', 'DHL', 'https://track.dhl.com/12348', 8),
('2025-01-23', 'La Poste', 'https://track.laposte.com/12349', 9),
('2025-01-24', 'Chronopost', 'https://track.chronopost.com/12350', 10),
('2025-01-24', 'DHL', 'https://track.dhl.com/12351', 11),
('2025-01-25', 'FedEx', 'https://track.fedex.com/12352', 12),
('2025-01-25', 'La Poste', 'https://track.laposte.com/12353', 13),
('2025-01-26', 'UPS', 'https://track.ups.com/12354', 14),
('2025-01-26', 'DHL', 'https://track.dhl.com/12355', 15),
('2024-02-20', 'FedEx', 'https://track.fedex.com/2024_12346', 16),
('2024-03-15', 'UPS', 'https://track.ups.com/2024_12347', 17),
('2024-04-25', 'DHL', 'https://track.dhl.com/2024_12348', 18),
('2024-05-10', 'La Poste', 'https://track.laposte.com/2024_12349', 19),
('2024-06-20', 'Chronopost', 'https://track.chronopost.com/2024_12350', 20),
('2024-07-25', 'DHL', 'https://track.dhl.com/2024_12351', 21),
('2024-08-30', 'FedEx', 'https://track.fedex.com/2024_12352', 22),
('2024-10-05', 'La Poste', 'https://track.laposte.com/2024_12353', 23),
('2024-10-20', 'UPS', 'https://track.ups.com/2024_12354', 24),
('2024-11-30', 'DHL', 'https://track.dhl.com/2024_12355', 25);

INSERT INTO detailLiv (idProduit, idLivraison, quantiteLiv) 
VALUES 
('GIT01', 1, 2),
('BAT01', 1, 1),
('TAB01', 2, 2),
('VIO01', 2, 1),
('PIA01', 3, 1),
('PIA02', 4, 1),
('BAT01', 5, 1),
('BAT01', 6, 1),
('SAX01', 8, 1),
('DRU02', 8, 2),
('MIC02', 9, 3),
('AMP02', 9, 1),
('VIO02', 10, 1),
('PIA03', 11, 1),
('BAT02', 12, 2),
('GIT02', 13, 2),
('TAB02', 14, 1),
('CAS02', 15, 4),
('SAX01', 16, 1),
('DRU02', 17, 2),
('MIC02', 18, 1),
('AMP02', 19, 1),
('VIO02', 20, 1),
('PIA03', 21, 1),
('BAT02', 22, 2),
('GIT02', 23, 2),
('TAB02', 24, 1),
('CAS02', 25, 4);




-- SELECT c2.dateCommande,c.quantite,c.articleTotalHt,c.articleTotalTtc,p.prixProduit,u.coefficientTaxe,u.coefficientReduction,c2.commandeTotalReduction,c2.commandeTotalTtc FROM contient c  
-- left join produit p  on c.idProduit = p.idProduit 
-- JOIN commande c2  on c2.idCommande  = c.idCommande 
-- JOIN utilisateur u on u.refClient = c2.refClient
-- WHERE c2.idCommande = 5;
-- SELECT * FROM contient c LEFT JOIN produit p on p.idProduit = c.idProduit;
-- SELECT * FROM commande c LEFT JOIN utilisateur u on u.refClient = c.refClient;
