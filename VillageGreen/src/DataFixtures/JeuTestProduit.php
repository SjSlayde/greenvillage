<?php

namespace App\DataFixtures;

use App\Entity\Avoir;
use App\Entity\Fournisseur;
use App\Entity\Produit;
use App\Entity\Rubrique;
use App\Entity\SousRubrique;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class JeuTestProduit extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $produits = [
            ['GIT01', 'Guitare Électrique', 499.99, 'Guitare 6 cordes', 'Guitare électrique avec un son riche et dynamique, idéale pour le rock et le blues.', 'guitare_electrique.jpg', 25, 2],
            ['PIA01', 'Piano Numérique', 799.99, 'Piano 88 touches', 'Piano numérique avec 88 touches pondérées, parfait pour les débutants et professionnels.', 'piano_numerique.jpg', 10, 1],
            ['BAT01', 'Batterie Acoustique', 999.99, 'Kit complet de batterie', 'Batterie acoustique comprenant 5 fûts et 3 cymbales, idéale pour les concerts en live.', 'batterie_acoustique.jpg', 8, 2],
            ['MIC01', 'Microphone Studio', 199.99, 'Micro condensateur', 'Microphone de studio à condensateur pour une qualité sonore exceptionnelle.', 'microphone_studio.jpg', 50, 4],
            ['TAB01', 'Table de Mixage', 349.99, 'Table 12 canaux', 'Table de mixage professionnelle avec 12 canaux pour DJ et enregistrement en studio.', 'table_mixage.jpg', 15, 4],
            ['CAS01', 'Casque Audio', 149.99, 'Casque isolant', 'Casque audio avec isolation phonique pour une écoute immersive.', 'casque_audio.jpg', 30, 4],
            ['AMP01', 'Amplificateur Guitare', 249.99, 'Ampli 50W', 'Amplificateur pour guitare électrique avec une puissance de 50 watts.', 'ampli_guitare.jpg', 20, 3],
            ['VIO01', 'Violon', 399.99, 'Violon 4/4', 'Violon 4/4 avec un son clair et profond, parfait pour les musiciens avancés.', 'violon.jpg', 12, 3],
            ['PIA02', 'Clavier MIDI', 129.99, 'Clavier 49 touches', 'Clavier MIDI avec 49 touches sensibles à la vélocité pour la production musicale.', 'clavier_midi.jpg', 40, 1],
            ['HAU01', 'Haut-parleurs de Monitoring', 299.99, 'Paire de haut-parleurs', 'Haut-parleurs de monitoring avec une réponse en fréquence plate pour le mixage audio.', 'haut_parleurs.jpg', 18, 3],
            ['SAX01', 'Saxophone Alto', 899.99, 'Saxophone pour débutants', 'Saxophone alto avec un son chaleureux, idéal pour l’apprentissage et les concerts.', 'saxophone_alto.jpg', 15, 1],
            ['DRU02', 'Tambourin', 29.99, 'Petit tambourin', 'Tambourin léger et robuste, parfait pour accompagner divers styles de musique.', 'tambourin.jpg', 50, 2],
            ['MIC02', 'Micro Sans Fil', 129.99, 'Micro sans fil', 'Microphone sans fil avec une portée de 30 mètres, parfait pour la scène.', 'micro_sans_fil.jpg', 25, 4],
            ['AMP02', 'Amplificateur Basse', 349.99, 'Ampli basse 100W', 'Amplificateur basse puissant avec 100W pour les concerts.', 'ampli_basse.jpg', 10, 3],
            ['VIO02', 'Violon Électrique', 499.99, 'Violon électrique 4/4', 'Violon électrique avec un son amplifié et riche, idéal pour les concerts modernes.', 'violon_electrique.jpg', 8, 3],
            ['PIA03', 'Piano à Queue', 5999.99, 'Piano à queue classique', 'Piano à queue pour professionnels, avec un son d’excellence.', 'piano_queue.jpg', 2, 1],
            ['BAT02', 'Cajón', 149.99, 'Instrument de percussion', 'Cajón en bois, idéal pour le flamenco et la musique acoustique.', 'cajon.jpg', 30, 2],
            ['GIT02', 'Guitare Classique', 249.99, 'Guitare 6 cordes', 'Guitare classique en bois massif, idéale pour les débutants et intermédiaires.', 'guitare_classique.jpg', 20, 2],
            ['TAB02', 'Table de Mixage 24 Canaux', 599.99, 'Table DJ avancée', 'Table de mixage professionnelle pour DJ avec 24 canaux.', 'table_mixage_24.jpg', 5, 4],
            ['CAS02', 'Enceinte Portable Bluetooth', 99.99, 'Enceinte Bluetooth', 'Enceinte portable avec une autonomie de 10 heures.', 'enceinte_bluetooth.jpg', 40, 4]
        ];

        $rubriques = [
            ['Instruments à Cordes', 'instruments_cordes.jpg'],
            ['Instruments à Clavier', 'instruments_clavier.jpg'],
            ['Percussions', 'percussions.jpg'],
            ['Accessoires Audio', 'accessoires_audio.jpg'],
            ['Équipement DJ', 'equipement_dj.jpg']
        ];

        $SousRubriques = [
            ['Guitares', 'guitares.jpg', 1],
            ['Violons', 'violons.jpg', 1],
            ['Pianos Numériques', 'pianos_numeriques.jpg', 2],
            ['Claviers MIDI', 'claviers_midi.jpg', 2],
            ['Batteries Acoustiques', 'batteries_acoustiques.jpg', 3],
            ['Casques Audio', 'casques_audio.jpg', 4],
            ['Microphones', 'microphones.jpg', 4],
            ['Amplificateurs', 'amplificateurs.jpg', 4],
            ['Tables de Mixage', 'tables_mixage.jpg', 5],
            ['Haut-parleurs', 'haut_parleurs.jpg', 4],
            ['Saxophones','',1],
            ['Pianos Classiques','', 2] 
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
            ['SAX01', 1],
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
