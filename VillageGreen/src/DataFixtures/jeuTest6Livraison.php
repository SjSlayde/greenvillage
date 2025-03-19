<?php

namespace App\DataFixtures;

use App\Entity\AffiliationAdresse;
use App\Entity\Commande;
use App\Entity\DetailLiv;
use App\Entity\Livraison;
use App\Entity\Produit;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class jeuTest6Livraison extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $livraisons = [
            ['2025-01-18', 'DHL', 'https://track.dhl.com/12345', 1],
            ['2025-01-19', 'FedEx', 'https://track.fedex.com/67890', 2],
            ['2025-01-20', 'UPS', 'https://track.ups.com/13579', 3],
            ['2025-01-21', 'Chronopost', 'https://track.chronopost.com/24680', 4],
            ['2025-01-22', 'La Poste', 'https://track.laposte.com/11223', 5],
            ['2025-01-21', 'La Poste', 'https://track.laposte.com/11240', 5],
            ['2025-01-21', 'FedEx', 'https://track.fedex.com/12346', 6],
            ['2025-01-22', 'UPS', 'https://track.ups.com/12347', 7],
            ['2025-01-23', 'DHL', 'https://track.dhl.com/12348', 8],
            ['2025-01-23', 'La Poste', 'https://track.laposte.com/12349', 9],
            ['2025-01-24', 'Chronopost', 'https://track.chronopost.com/12350', 10],
            ['2025-01-24', 'DHL', 'https://track.dhl.com/12351', 11],
            ['2025-01-25', 'FedEx', 'https://track.fedex.com/12352', 12],
            ['2025-01-25', 'La Poste', 'https://track.laposte.com/12353', 13],
            ['2025-01-26', 'UPS', 'https://track.ups.com/12354', 14],
            ['2025-01-26', 'DHL', 'https://track.dhl.com/12355', 15]
        ];

        $detailLivs = [
            ['GIT01', 1, 2],
            ['BAT01', 1, 1],
            ['TAB01', 2, 2],
            ['VIO01', 2, 1],
            ['PIA01', 3, 1],
            ['PIA02', 4, 1],
            ['BAT01', 5, 1],
            ['BAT01', 6, 1],
            ['SAX01', 8, 1],
            ['DRU02', 8, 2],
            ['MIC02', 9, 3],
            ['AMP02', 9, 1],
            ['VIO02', 10, 1],
            ['PIA03', 11, 1],
            ['BAT02', 12, 2],
            ['GIT02', 13, 2],
            ['TAB02', 14, 1],
            ['CAS02', 15, 4]
        ];
        $commandes = $manager->getRepository(Commande::class)->findAll();

        foreach($commandes as $command){
            $command->setTotalCommande();
            $manager->persist($command);
            if($command->getCommandeTotalTTC() == 0){
                $manager->remove($command);
            }
        }

        $count = 1;
         
        foreach($livraisons as [$dateLivraison, $transporteur, $url_suivi, $idCommande]){
         if ($idCommande < 16){
             $livraison = new Livraison();
             $commande = $manager->getRepository(Commande::class)->find($idCommande);
             $dateliv = new \DateTime();
             $dateliv->modify('+5 days');
             $livraison->setDateLivraison($dateliv);
             $livraison->setTransporteur($transporteur);
             $livraison->setUrlSuivi($url_suivi);
             $livraison->setCommande($commande);
             $adresseLiv = $manager->getRepository(AffiliationAdresse::class)->findOneBy(['client' => $commande->getRefClient(),'type' => 'adLivraison']);
             $adresseFac = $manager->getRepository(AffiliationAdresse::class)->findOneBy(['client' => $commande->getRefClient(),'type' => 'adFacturation']);
             $livraison->setAdresseLivraison($adresseLiv->getAdresse());
             $livraison->setAdresseFacturation($adresseFac->getAdresse());

             foreach($detailLivs as [$idProduit, $idLivraison, $quantiteLiv]){
                 if ($idLivraison == $count){
                     $detailLiv = new DetailLiv();
                     $detailLiv->setLivraison($livraison);
                     $detailLiv->setQuantiteLiv($quantiteLiv);
                     $produit = $manager->getRepository(Produit::class)->findOneBy(['refProduit' =>$idProduit]);
                     $detailLiv->setProduit($produit);
                     $manager->persist($detailLiv);
                     }
                 }   
             $count++;
             $manager->persist($livraison);
         }}
         
        $manager->flush();
    }
}
