<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Adresse;

class JeuTest1Adresse extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //tout mes tableaux de données
        $adresses = [
            [1, '13627', 'Bradenton', '34282', 'Bashford Road'],
            [2, '93', 'São Manuel', '80000', 'Gerald Crossing'],
            [3, '1433', 'Nueva Cajamarca', '56123', 'Mcguire Terrace'],
            [4, '3790', 'Horizonte', '62880', 'John Wall Crossing'],
            [5, '36', 'Portelândia', '75835', 'Westend Parkway'],
            [6, '625', 'Bungu', '98561', 'Namekagon Court'],
            [7, '3355', 'Revava', '75123', 'Fair Oaks Center'],
            [8, '5055', 'Novogireyevo', '43324', 'Monterey Parkway'],
            [9, '648', 'Johanneshov', '12136', 'Maple Plaza'],
            [10, '1996', 'Guam Government House', '96928', 'Prentice Center'],
            [11, '19917', 'Wien', '12001', 'Brickson Park Way'],
            [12, '149', 'Hino', '91954', 'Cambridge Parkway'],
            [13, '69237', 'Kangalassy', '67790', 'Oneill Avenue'],
            [14, '5795', 'Tianyi', '87451', 'Huxley Point'],
            [15, '582', 'Repušnica', '44320', 'Dapin Pass'],
            [16, '8964', 'Golcowa', '36231', 'Fulton Pass'],
            [17, '77863', 'Banjar Yehsatang', '19547', 'Kim Center'],
            [18, '358', 'Aktau', '95780', 'Valley Edge Lane'],
            [19, '393', 'Koszyce Wielkie', '33111', 'Northridge Trail'],
            [20, '0443', 'Chakaray', '04587', 'Lakewood Drive'],
            [21, '842', 'Bunawan', '85064', 'Golden Leaf Court'],
            [22, '4085', 'La Hacienda', '17515', 'Lakeland Terrace'],
            [23, '764', 'Mangochi', '65852', 'Carioca Hill'],
            [24, '78200', 'Figueira dos Cavaleiros', '79004', 'Anthes Pass'],
            [25, '2424', 'Shatian', '54123', 'Ridgeview Parkway'],
        ];

        foreach ($adresses as [$id, $numeroDeRue, $ville, $codePostal, $nomRue]) {
            $adresse = new Adresse();
            $adresse->setNumeroDeRue($numeroDeRue);
            $adresse->setVille($ville);
            $adresse->setCodePostal($codePostal);
            $adresse->setNomRue($nomRue);

            $manager->persist($adresse);
        }

        $manager->flush();
    }
}
