<?php

namespace App\DataFixtures;

use App\Entity\Adresse;
use App\Entity\Fournisseur;
use App\Repository\AdresseRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class JeuTestFournisseur extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $fournisseurs = [
            ['Buzzshare', 'qarsnell0@google.fr', '2879069540', 1],
            ['Browseblab', 'dsmeal1@tripadvisor.com', '9294319928', 2],
            ['Babbleblab', 'cmarkwick2@livejournal.com', '9973556322', 3],
            ['Flipstorm', 'jkeyzor3@springer.com', '6545363454', 4]
        ];

        foreach ($fournisseurs as [$nom, $email, $numeroTelephone, $idAdresse]) {
            $fournisseur = new Fournisseur();
            $fournisseur->setNomFournisseur($nom);
            $fournisseur->setEmailFournisseur($email);
            $fournisseur->setTelephone($numeroTelephone);
            
            // Récupération de l'adresse depuis la base de données
            $adresse = $manager->getRepository(Adresse::class)->find($idAdresse);
            
            $fournisseur->setAdresse($adresse);


            $manager->persist($fournisseur);
        };

        $manager->flush();
    }
}
