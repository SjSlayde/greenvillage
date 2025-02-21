<?php

namespace App\DataFixtures;

use App\Entity\Adresse;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use app\Entity\Utilisateur;
use app\Entity\AffiliationAdresse;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class JeuTestUtilisateur extends Fixture
{

    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher){
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        
        $utilisateurs = [
            [3, 'Denny', 'Plain', 'nY7!&_4dO,P7G', 'dplain2@google.pl', 20, 'personnel', '0727737577', 'ROLE_ADMIN', 0, 1],
            [12, 'Gale', 'Fulbrook', 'cX4\VGk@,OESGtk', 'gfulbrookb@behance.net', 20, 'personnel', '0737595866', 'ROLE_ADMIN', 0, 1],
            [1, 'Mame', 'Heales', 'kW8>3z*z', 'mheales0@google.com.hk', 20, 'particulier', '0679435690', 'ROLE_USER', 0, 1],
            [2, 'Hastings', 'Wheowall', 'sW1/\C7.R|', 'hwheowall1@webs.com', 20, 'personnel', '0657298690', 'ROLE_ADMIN', 0, 1],
            [4, 'Lincoln', 'Glendenning', 'oB7&rV_eq', 'lglendenning3@chronoengine.com', 15, 'professionnel', '0762618553', 'ROLE_USER', 5, 2],
            [6, 'Kasey', 'Cove', 'hello5041', 'kcove5@usda.gov', 20, 'particulier', '0608249058', 'ROLE_USER', 0, 1],
            [8, 'Rivi', 'Bowyer', 'zI9(AW|?.|(', 'rbowyer7@hao123.com', 18, 'professionnel', '0676519897', 'ROLE_USER', 39, 2],
        ];

        // Récupération de toute les adresse depuis la base de données
        $adresses = $manager->getRepository(Adresse::class)->findAll();

        foreach ($utilisateurs as [$id , $nom , $prenom , $password , $email , $coefficientVente, $type , $telephone , $titreRole , $coefficientReduction , $refClient]) {
            $utilisateur = new Utilisateur();
            $utilisateur->setNom($nom);
            $utilisateur->setPrenom($prenom);

            $hashedPassword = $this->passwordHasher->hashPassword(
                $utilisateur,
                $password
            );

            $utilisateur->setPassword($hashedPassword);
            $utilisateur->setEmail($email);
            $utilisateur->setCoefficientVente($coefficientVente);
            $utilisateur->setType($type);
            $utilisateur->setTelephone($telephone);
            $utilisateur->setRoles([$titreRole]);
            $utilisateur->setCoefficientReduction($coefficientReduction);
            
            // if ($titreRole == 'ROLE_ADMIN') {

            // } else {
            //     $commercial = $manager->getRepository(Utilisateur::class)->find($refClient);
            //     $utilisateur->setIdCommercial($commercial);
            // }

            //selectionne une adresse random
            $adresse = $adresses[array_rand($adresses)];

            $affiliationFact = new AffiliationAdresse();
            $affiliationFact->setType('adFacturation');
            $affiliationFact->setClient($utilisateur);
            $affiliationFact->setAdresse($adresse);

            $affiliationLiv = new AffiliationAdresse();
            $affiliationLiv->setType('adLivraison');
            $affiliationLiv->setClient($utilisateur);
            $affiliationLiv->setAdresse($adresse);

            $manager->persist($affiliationFact);
            $manager->persist($affiliationLiv);
            $manager->persist($utilisateur);
        }

        $manager->flush();

        $utilisateurs = $manager->getRepository(Utilisateur::class)->findAll();
        foreach ($utilisateurs as $utilisateur) {

            if ($utilisateur->getType() != 'professionnel') {
                $commercial = $manager->getRepository(Utilisateur::class)->findOneBy(['email'=>'dplain2@google.pl']);
            } else {
                $commercial = $manager->getRepository(Utilisateur::class)->findOneBy(['email'=>'gfulbrookb@behance.net']);
            }
            $utilisateur->setIdCommercial($commercial);
            $manager->persist($utilisateur);
        }

        $manager->flush();
    }
}
