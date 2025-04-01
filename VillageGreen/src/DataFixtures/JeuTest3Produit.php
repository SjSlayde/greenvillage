<?php

namespace App\DataFixtures;

use App\Entity\Avoir;
use App\Entity\Fournisseur;
use App\Entity\Produit;
use App\Entity\Rubrique;
use App\Entity\SousRubrique;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class JeuTest3Produit extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $produits = [
            ['GIT01', 'Guitare Électrique', 499.99, 'Guitare 6 cordes', 'Guitare électrique avec un son riche et dynamique, idéale pour le rock et le blues.', 'PGuitareElectrique.jpg', 25, 2],
            ['PIA01', 'Piano Numérique', 799.99, 'Piano 88 touches', 'Piano numérique avec 88 touches pondérées, parfait pour les débutants et professionnels.', 'PPianoNumerique.jpg', 10, 1],
            ['BAT01', 'Batterie Acoustique', 999.99, 'Kit complet de batterie', 'Batterie acoustique comprenant 5 fûts et 3 cymbales, idéale pour les concerts en live.', 'PBatterieAcoustique.webp', 8, 2],
            ['MIC01', 'Microphone Studio', 199.99, 'Micro condensateur', 'Microphone de studio à condensateur pour une qualité sonore exceptionnelle.', 'PMicrophoneStudio.webp', 50, 4],
            ['TAB01', 'Table de Mixage', 349.99, 'Table 12 canaux', 'Table de mixage professionnelle avec 12 canaux pour DJ et enregistrement en studio.', 'PTableMixage.avif', 15, 4],
            ['CAS01', 'Casque Audio', 149.99, 'Casque isolant', 'Casque audio avec isolation phonique pour une écoute immersive.', 'PCasqueAudio.webp', 30, 4],
            ['AMP01', 'Amplificateur Guitare', 249.99, 'Ampli 50W', 'Amplificateur pour guitare électrique avec une puissance de 50 watts.', 'PAmplificateurGuitare.webp', 20, 3],
            ['VIO01', 'Violon', 399.99, 'Violon 4/4', 'Violon 4/4 avec un son clair et profond, parfait pour les musiciens avancés.', 'PViolon.webp', 12, 3],
            ['PIA02', 'Clavier MIDI', 129.99, 'Clavier 49 touches', 'Clavier MIDI avec 49 touches sensibles à la vélocité pour la production musicale.', 'PClavierMIDI.webp', 40, 1],
            ['HAU01', 'Haut-parleurs de Monitoring', 299.99, 'Paire de haut-parleurs', 'Haut-parleurs de monitoring avec une réponse en fréquence plate pour le mixage audio.', 'PHautparleursMonitoring.jpg', 18, 3],
            ['SAX01', 'Saxophone Alto', 899.99, 'Saxophone pour débutants', 'Saxophone alto avec un son chaleureux, idéal pour l’apprentissage et les concerts.', 'PSaxophoneAlto.jpg', 15, 1],
            ['DRU02', 'Tambourin', 29.99, 'Petit tambourin', 'Tambourin léger et robuste, parfait pour accompagner divers styles de musique.', 'PTambourin.jpg', 50, 2],
            ['MIC02', 'Micro Sans Fil', 129.99, 'Micro sans fil', 'Microphone sans fil avec une portée de 30 mètres, parfait pour la scène.', 'PMicroSansFil.jpeg', 25, 4],
            ['AMP02', 'Amplificateur Basse', 349.99, 'Ampli basse 100W', 'Amplificateur basse puissant avec 100W pour les concerts.', 'PAmplificateurBasse.jpg', 10, 3],
            ['VIO02', 'Violon Électrique', 499.99, 'Violon électrique 4/4', 'Violon électrique avec un son amplifié et riche, idéal pour les concerts modernes.', 'PViolonElectrique.webp', 8, 3],
            ['PIA03', 'Piano à Queue', 5999.99, 'Piano à queue classique', 'Piano à queue pour professionnels, avec un son d’excellence.', 'PPianoQueue.jpg', 2, 1],
            ['BAT02', 'Cajón', 149.99, 'Instrument de percussion', 'Cajón en bois, idéal pour le flamenco et la musique acoustique.', 'PCajon.webp', 30, 2],
            ['GIT02', 'Guitare Classique', 249.99, 'Guitare 6 cordes', 'Guitare classique en bois massif, idéale pour les débutants et intermédiaires.', 'PGuitareClassique.jpg', 20, 2],
            ['TAB02', 'Table de Mixage 24 Canaux', 599.99, 'Table DJ avancée', 'Table de mixage professionnelle pour DJ avec 24 canaux.', 'PTabledeMixage24Canaux.jpg', 5, 4],
            ['CAS02', 'Enceinte Portable Bluetooth', 99.99, 'Enceinte Bluetooth', 'Enceinte portable avec une autonomie de 10 heures.', 'PEnceintePortableBluetooth.webp', 40, 4]
        ];

        $rubriques = [
            ['Instruments à Cordes', 'instruments_cordes.jpg'],
            ['Instruments à Clavier', '6921d142c754b09c7937bf7f3aa46f8c.jpg'],
            ['Percussions', '96a316ae289ad8b9213f04a00ee6c3da.jpg'],
            ['Accessoires Audio', 'imagescasqueaudio.jpeg'],
            ['Équipement DJ', '61695_5.jpg']
        ];

        $SousRubriques = [
            ['Guitares', 'SRguitares.avif', 1],
            ['Violons', 'SRViolons.avif', 1],
            ['Pianos Numériques', 'SRPianosNumeriques.avif', 2],
            ['Claviers MIDI', 'SRClaviersMIDI.avif', 2],
            ['Batteries Acoustiques', 'SRBatteriesAcoustiques.webp', 3],
            ['Casques Audio', 'SRCasquesAudio.avif', 4],
            ['Microphones', 'SRMicrophones.avif', 4],
            ['Amplificateurs', 'SRAmplificateurs.avif', 4],
            ['Tables de Mixage', 'SRTablesdeMixage.avif', 5],
            ['Haut-parleurs', 'SRHautparleurs.webp', 4],
            ['Saxophones','SRSaxophones.jpg',1],
            ['Pianos Classiques','SRpianosclassiques.jpg', 2] 
        ];

        $Avoirs = [
            ['GIT01', 1],
            ['VIO01', 2],
            ['PIA01', 3],
            ['PIA02', 4],
            ['BAT01', 5],
            ['CAS01', 6], 
            ['MIC01', 7], 
            ['AMP01', 8], 
            ['TAB01', 9],
            ['HAU01', 10],
            ['SAX01', 11],
            ['DRU02', 5],
            ['MIC02', 7],
            ['AMP02', 8],
            ['VIO02', 2],
            ['PIA03', 12],
            ['BAT02', 3],
            ['GIT02', 1],
            ['TAB02', 9],
            ['CAS02', 10]
        ];


        foreach ($produits as [$refProduit, $nomProduit, $prixAchatProduit, $descriptionCourtProduit, $descriptionLongProduit, $nomImage, $stock, $idFournisseur]) {
            $produit = new Produit();
            $produit->setRefProduit($refProduit);
            $produit->setNomProduit($nomProduit);
            $produit->setPrixAchatProduit($prixAchatProduit);
            $produit->setDescriptionCourt($descriptionCourtProduit);
            $produit->setDescriptionLong($descriptionLongProduit);
            $produit->setNomImage($nomImage);
            $produit->setStock($stock);
            $produit->setActif(1);
            
            $four = $manager->getRepository(Fournisseur::class)->find($idFournisseur);
            $produit->setFournisseur($four);

            $manager->persist($produit);}

        foreach ($rubriques as [$nomRubrique , $nomImageRubrique]){
            $rubrique = new Rubrique();
            $rubrique->setNomRubrique($nomRubrique);
            $rubrique->setImageRubrique($nomImageRubrique);
            $manager->persist($rubrique);
        };

        $manager->flush();

        foreach ($SousRubriques as [$nomSousRubrique , $imageSousRubrique, $idRubrique]){
            $SousRubriques = new SousRubrique();
            $SousRubriques->setNomSousRubrique($nomSousRubrique);
            $SousRubriques->setImageSousRubrique($imageSousRubrique);

            $rubrique = $manager->getRepository(Rubrique::class)->find($idRubrique);
            $SousRubriques->setRubrique($rubrique);

            $manager->persist($SousRubriques);
        };

        $manager->flush();

        foreach($Avoirs as [$refProduit, $idSousRubrique]){
            $avoir = new Avoir();

            $produit = $manager->getRepository(Produit::class)->findOneBy(['refProduit' => $refProduit]);
            $avoir->setProduit($produit);

            $sousRubrique = $manager->getRepository(SousRubrique::class)->find($idSousRubrique);
            $avoir->setSousRubrique($sousRubrique);
            $manager->persist($avoir);
        }

        $manager->flush();
    }
}
