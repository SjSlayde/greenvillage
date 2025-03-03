<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\AffiliationAdresse;
use App\Form\AdresseFormType;
use App\Repository\AdresseRepository;
use App\Repository\AffiliationAdresseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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

#[Route('/{nom}-{prenom}/nouvelle_adresse_{type}', name: 'app_newadresse')]
public function newAdresse(Request $request, EntityManagerInterface $em,string $type): Response
{
    $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

    $adresse = new Adresse();
    
    $form = $this->createForm(AdresseFormType::class, $adresse);
    $form->handleRequest($request);
    
    if ($form->isSubmitted() && $form->isValid()) {
        $user = $this->getUser();
        $detailAdresse = new AffiliationAdresse();
        if($type = 'livraison'){
            $detailAdresse->setType('adLivraison');
        } elseif ($type = 'facturation'){
            $detailAdresse->setType('adFacturation');
        } else {
            $this->addFlash('warning', 'Votre adresse de livraison n\'a pas été ajoutée a cause d\'une error');

            return $this->redirectToRoute('app_profil', [
                'nom' => $user->getNom(),
                'prenom' => $user->getPrenom()
            ]);
        }

        $detailAdresse->setAdresse($adresse);
        $detailAdresse->setClient($user);
        $em->persist($adresse);
        $em->persist($detailAdresse);
        $em->flush();

        $this->addFlash('success', 'Votre adresse de livraison a été ajoutée');

        return $this->redirectToRoute('app_utilisateur', [
            'nom' => $user->getNom(),
            'prenom' => $user->getPrenom()
        ]);
    }

    return $this->render('profil/newAdresse.html.twig', [
        'form' => $form
    ]);
}
}
