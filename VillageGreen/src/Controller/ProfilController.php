<?php

namespace App\Controller;

use App\Repository\AdresseRepository;
use App\Repository\AffiliationAdresseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProfilController extends AbstractController
{
    private $adresserepo;
    private $affiliationAdressesrepo;

    public function __construct(AdresseRepository $adresserepo,AffiliationAdresseRepository $affiliationAdresseRepo){
        $this->adresserepo = $adresserepo;
        $this->affiliationAdressesrepo = $affiliationAdresseRepo;
    }
    #[Route('/profil{nomuser}_{prenomuser}', name: 'app_profil')]
    public function profil(): Response
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        /** @var \App\Entity\Utilisateur $user */
        $user = $this->getUser();
        $affilLivs = $this->affiliationAdressesrepo->findBy( ['client' => $user, 'type' => 'adLivraison']);
        $adressesFacs = $this->affiliationAdressesrepo->findBy( ['client' => $user, 'type' => 'adFacturation']);
        
        $adressesLiv = [];
        $adressesFac = [];

        foreach ($affilLivs  as $adresseLiv) {
            array_push($adressesLiv,$adresseLiv->getAdresse());
        }

        foreach ($adressesFacs  as $adresseFac) {
            array_push($adressesFac,$adresseFac->getAdresse());
        }

        return $this->render('profil/index.html.twig', [
            'user' => $user,
            'adressesLiv' => $adressesLiv,
            'adressesFac' => $adressesFac
        ]);
}
}
