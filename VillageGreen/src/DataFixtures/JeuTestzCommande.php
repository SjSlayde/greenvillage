<?php

namespace App\DataFixtures;

use App\Entity\Commande;
use App\Entity\Contient;
use App\Entity\DetailLiv;
use App\Entity\Livraison;
use App\Entity\Produit;
use App\Entity\Utilisateur;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class JeuTestzCommande extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $commandes = [
            [150.50, '2025-01-15', 'FAC0001', 125.42, 150.50, 'Carte Bancaire', 1],
            [320.00, '2025-01-16', 'FAC0002', 268.91, 320.00, 'PayPal', 4],
            [78.30, '2025-01-17', 'FAC0003', 65.73, 78.30, 'Carte Bancaire', 1],
            [215.90, '2025-01-18', 'FAC0004', 181.93, 215.90, 'Virement Bancaire', 12],
            [460.00, '2025-01-19', 'FAC0005', 387.60, 460.00, 'Carte Bancaire', 8],
            [50.00, '2025-01-20', 'FAC0006', 400.00, 480.00, 'Carte Bancaire', 2],
            [75.00, '2025-01-21', 'FAC0007', 625.00, 750.00, 'Virement Bancaire', 4],
            [0.00, '2025-01-22', 'FAC0008', 149.99, 179.99, 'Carte Bancaire', 6],
            [30.00, '2025-01-22', 'FAC0009', 200.00, 240.00, 'Carte Bancaire', 1],
            [99.99, '2025-01-23', 'FAC0010', 499.99, 599.98, 'PayPal', 8],
            [0.00, '2025-01-23', 'FAC0011', 5999.99, 7199.99, 'Carte Bancaire', 12],
            [50.00, '2025-01-23', 'FAC0012', 300.00, 360.00, 'Virement Bancaire', 7],
            [80.00, '2025-01-23', 'FAC0013', 400.00, 480.00, 'Carte Bancaire', 9],
            [100.00, '2025-01-23', 'FAC0014', 800.00, 960.00, 'Carte Bancaire', 11],
            [0.00, '2025-01-23', 'FAC0015', 99.99, 119.99, 'PayPal', 5],
            [50.00, '2024-02-15', 'FAC0016', 400.00, 480.00, 'Carte Bancaire', 3],
            [75.00, '2024-03-10', 'FAC0017', 625.00, 750.00, 'Virement Bancaire', 5],
            [0.00, '2024-04-22', 'FAC0018', 149.99, 179.99, 'Carte Bancaire', 7],
            [30.00, '2024-05-05', 'FAC0019', 200.00, 240.00, 'Carte Bancaire', 4],
            [99.99, '2024-06-15', 'FAC0020', 499.99, 599.98, 'PayPal', 9],
            [0.00, '2024-07-20', 'FAC0021', 5999.99, 7199.99, 'Carte Bancaire', 10],
            [50.00, '2024-08-25', 'FAC0022', 300.00, 360.00, 'Virement Bancaire', 6],
            [80.00, '2024-09-30', 'FAC0023', 400.00, 480.00, 'Carte Bancaire', 8],
            [100.00, '2024-10-15', 'FAC0024', 800.00, 960.00, 'Carte Bancaire', 12],
            [0.00, '2024-11-25', 'FAC0025', 99.99, 119.99, 'PayPal', 2]
        ];

        $contients = [
            ['GIT01', 1, 2],
            ['BAT01', 1, 1],
            ['VIO01', 2, 1],
            ['TAB01', 2, 2],
            ['PIA01', 3, 1],
            ['PIA02', 4, 1],
            ['BAT01', 5, 2],
            ['SAX01', 6, 1],
            ['DRU02', 6, 2],
            ['MIC02', 7, 3],
            ['AMP02', 7, 1],
            ['VIO02', 8, 1],
            ['PIA03', 9, 1],
            ['BAT02', 10, 2],
            ['GIT02', 11, 2],
            ['TAB02', 12, 1],
            ['CAS02', 13, 4],
            ['PIA03', 14, 1],
            ['BAT02', 15, 2]
        ];

        // $livraisons = [
        //     ['2025-01-18', 'DHL', 'https://track.dhl.com/12345', 1],
        //     ['2025-01-19', 'FedEx', 'https://track.fedex.com/67890', 2],
        //     ['2025-01-20', 'UPS', 'https://track.ups.com/13579', 3],
        //     ['2025-01-21', 'Chronopost', 'https://track.chronopost.com/24680', 4],
        //     ['2025-01-22', 'La Poste', 'https://track.laposte.com/11223', 5],
        //     ['2025-01-21', 'La Poste', 'https://track.laposte.com/11240', 5],
        //     ['2025-01-21', 'FedEx', 'https://track.fedex.com/12346', 6],
        //     ['2025-01-22', 'UPS', 'https://track.ups.com/12347', 7],
        //     ['2025-01-23', 'DHL', 'https://track.dhl.com/12348', 8],
        //     ['2025-01-23', 'La Poste', 'https://track.laposte.com/12349', 9],
        //     ['2025-01-24', 'Chronopost', 'https://track.chronopost.com/12350', 10],
        //     ['2025-01-24', 'DHL', 'https://track.dhl.com/12351', 11],
        //     ['2025-01-25', 'FedEx', 'https://track.fedex.com/12352', 12],
        //     ['2025-01-25', 'La Poste', 'https://track.laposte.com/12353', 13],
        //     ['2025-01-26', 'UPS', 'https://track.ups.com/12354', 14],
        //     ['2025-01-26', 'DHL', 'https://track.dhl.com/12355', 15]
        // ];

        // $detailLivs = [
        //     ['GIT01', 1, 2],
        //     ['BAT01', 1, 1],
        //     ['TAB01', 2, 2],
        //     ['VIO01', 2, 1],
        //     ['PIA01', 3, 1],
        //     ['PIA02', 4, 1],
        //     ['BAT01', 5, 1],
        //     ['BAT01', 6, 1],
        //     ['SAX01', 8, 1],
        //     ['DRU02', 8, 2],
        //     ['MIC02', 9, 3],
        //     ['AMP02', 9, 1],
        //     ['VIO02', 10, 1],
        //     ['PIA03', 11, 1],
        //     ['BAT02', 12, 2],
        //     ['GIT02', 13, 2],
        //     ['TAB02', 14, 1],
        //     ['CAS02', 15, 4]
        // ];

           $count = 1;
           foreach($commandes as [$commandeTotalReduction, $dateCommande, $numFacturation, $commandeTotalHt, $commandeTotalTtc, $moyenPaiement, $refClient]){
              if ($manager->getRepository(Utilisateur::class)->find($refClient) != null){
                  
                  $commande = new Commande();
                  $commande->setDateCommande();
                  $commande->setNumFacturation($numFacturation);
                  $commande->setMoyenPaiement($moyenPaiement);
       
                  $user = $manager->getRepository(Utilisateur::class)->find($refClient);
                  $commande->setRefClient($user);
       
                  foreach($contients as [$idProduit, $idCommande, $quantite]){
                      if ($idCommande == $count){
                          $contient = new Contient();
       
                          $produit = $manager->getRepository(Produit::class)->findOneBy(['refProduit' => $idProduit]);
                          $contient->setProduit($produit);
                          $contient->setCommande($commande);
                          $contient->setQuantite($quantite);
                          $contient->setTotalContient();
                          $manager->persist($contient);
                      }}
                   $commande->setTotalCommande();
                   $commande->setStatut('terminée');
                   $commande->setPaiementValide(1);
                   $manager->persist($commande);
                   $count++;
              }}

        //    $count2 = 1;
         
        //    foreach($livraisons as [$dateLivraison, $transporteur, $url_suivi, $idCommande]){
        //     if ($idCommande < 16){
        //         $livraison = new Livraison();
        //         $commande = $manager->getRepository(Commande::class)->find($idCommande);
        //         $dateliv = new \DateTime();
        //         $dateliv->modify('+5 days');
        //         $livraison->setDateLivraison($dateliv);
        //         $livraison->setTransporteur($transporteur);
        //         $livraison->setUrlSuivi($url_suivi);
        //         $livraison->setCommande($commande);

        //         foreach($detailLivs as [$idProduit, $idLivraison, $quantiteLiv]){
        //             if ($idLivraison == $count2){
        //                 $detailLiv = new DetailLiv();
        //                 $detailLiv->setLivraison($livraison);
        //                 $detailLiv->setQuantiteLiv($quantiteLiv);
        //                 $produit = $manager->getRepository(Produit::class)->findOneBy(['refProduit' =>$idProduit]);
        //                 $detailLiv->setProduit($produit);
        //                 $manager->persist($detailLiv);
        //                 }
        //             }   
        //         $count2++;
        //         $manager->persist($livraison);
        //     }
        // }
        // $commandes = $manager->getRepository(Commande::class)->findAll();

        // foreach($commandes as $command){
        //     $command->setTotalCommande();
        //     $manager->persist($command);
        // }
        
        $manager->flush();
    }
}
    

