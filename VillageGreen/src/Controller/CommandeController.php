<?php

namespace App\Controller;

use App\Form\CommandeInfoType;
use App\Repository\AffiliationAdresseRepository;
use App\Repository\ContientRepository;
use App\Repository\LivraisonRepository;
use App\Repository\ProduitRepository;
use App\Service\PanierService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CommandeController extends AbstractController
{
    private $panierService;
    private $produitRepo;
    private $livraisonRepo;
    private $contientRepo;
    private $entityManagerInterface;
    private $affiliationAdresseRepo;

    public function __construct(
        PanierService $panierService,
        ProduitRepository $produitRepo,
        LivraisonRepository $livraisonRepo,
        ContientRepository $contientRepo,
        EntityManagerInterface $entityManagerInterface,
        AffiliationAdresseRepository $affiliationAdresseRepo,
    ) {
        $this->panierService = $panierService;
        $this->produitRepo = $produitRepo;
        $this->livraisonRepo = $livraisonRepo;
        $this->contientRepo = $contientRepo;
        $this->entityManagerInterface = $entityManagerInterface;
        $this->affiliationAdresseRepo = $affiliationAdresseRepo;
    }

    #[Route('/commandeAd', name: 'app_commandeAd')]
    public function index(Request $request): Response
    {
        $panier = $this->panierService->ShowPanier();
        if (!empty($panier)) {
            $user = $this->getUser();

            $affadresseLivs = $this->affiliationAdresseRepo->findBy(['client' => $user, 'type' => 'adLivraison']);
            $affadresseFacs = $this->affiliationAdresseRepo->findBy(['client' => $user, 'type' => 'adFacturation']);
            $adresseLivs = [];
            $adresseFacs = [];
    
            foreach ($affadresseLivs as $affadresseLiv) {
                $adresseLiv = $affadresseLiv->getAdresse();
                array_push($adresseLivs,$adresseLiv);
            }
            foreach ($affadresseFacs as $affadresseFac) {
                $adresseFac = $affadresseFac->getAdresse();
                array_push($adresseFacs,$adresseFac);
            }

            if (empty($adresseLivs)) {
                $this->addFlash('warning', 'aucun adresse de livraison trouver');
                return $this->redirectToRoute('app_newadresse', [
                    'type' => 'livraison',
                ]);
            } elseif (empty($adresseFacs)) {
                $this->addFlash('warning', 'aucun adresse de facturation trouver');
                return $this->redirectToRoute('app_newadresse', [
                    'type' => 'facturation',
                ]);
            }

            $form = $this->createForm(CommandeInfoType::class, $user);
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {

                $adresseLiv = $form->get('adresseLiv')->getData();
                $adresseFac = $form->get('adresseFac')->getData();

                return $this->redirectToRoute('app_commandePay', [
                    'adLiv' => $adresseLiv->getId(),
                    'adFac' => $adresseFac->getId(),
                ]);
            } else {
                return $this->render('commande/index.html.twig', [
                    'form' => $form,
                    'adresseLivs' => $adresseLivs,
                    'adresseFacs' => $adresseFacs,
                ]);
            }

        } else {
            $this->addFlash('warning', 'aucun article présent de le panier');
            return $this->redirectToRoute('app_panier');
        }
    }
}
