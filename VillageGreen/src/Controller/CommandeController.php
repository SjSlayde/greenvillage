<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Contient;
use App\Entity\Livraison;
use App\Form\CommandeInfoType;
use App\Repository\AdresseRepository;
use App\Repository\AffiliationAdresseRepository;
use App\Repository\CommandeRepository;
use App\Repository\ContientRepository;
use App\Repository\DetailLivRepository;
use App\Repository\LivraisonRepository;
use App\Repository\ProduitRepository;
use App\Service\PanierService;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\StripeClient;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class CommandeController extends AbstractController
{
    private $panierService;
    private $produitRepo;
    private $livraisonRepo;
    private $contientRepo;
    private $commandeRepo;
    private $entityManager;
    private $affiliationAdresseRepo;
    // private StripeClient $client;

    public function __construct(
        PanierService $panierService,
        ProduitRepository $produitRepo,
        LivraisonRepository $livraisonRepo,
        CommandeRepository $commandeRepo,
        ContientRepository $contientRepo,
        EntityManagerInterface $entityManagerInterface,
        AffiliationAdresseRepository $affiliationAdresseRepo,
        // #[Autowire('%env(STRIPE_SECRET_KEY)%')] string $apikey,

    ) {
        $this->panierService = $panierService;
        $this->produitRepo = $produitRepo;
        $this->livraisonRepo = $livraisonRepo;
        $this->contientRepo = $contientRepo;
        $this->commandeRepo = $commandeRepo;
        $this->entityManager = $entityManagerInterface;
        $this->affiliationAdresseRepo = $affiliationAdresseRepo;
        // $this->client = new StripeClient($apikey);
    }

    #[Route('/commande/Ad', name: 'app_commandeAd')]
    public function commandeAd(Request $request, SessionInterface $session): Response
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
                array_push($adresseLivs, $adresseLiv);
            }
            foreach ($affadresseFacs as $affadresseFac) {
                $adresseFac = $affadresseFac->getAdresse();
                array_push($adresseFacs, $adresseFac);
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

                $adresseLiv = $form->get('adresseLivraison')->getData();
                $adresseFac = $form->get('adresseFacturation')->getData();

                $session->set('idAdLiv', $adresseLiv->getId());
                $session->set('idAdFac', $adresseFac->getId());

                return $this->redirectToRoute('app_commandePay');

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

    #[Route('/commande/paiement', name: 'app_commandePay')]
    public function commandePay(Request $request, SessionInterface $session): Response
    {
        $panier = $this->panierService->ShowPanier();

        $commande = new Commande();
        $commande->setDateCommande();
        $numFacturation = 'FAC' . $commande->getId();
        $commande->setNumFacturation($numFacturation);
        $commande->setMoyenPaiement('cart');

        $commande->setRefClient($this->getUser());

        foreach ($panier as $id => $quantite) {
            $produit = $this->produitRepo->find($id);
            $contient = new Contient();
            $contient->setProduit($produit);
            $contient->setCommande($commande);
            $contient->setQuantite($quantite);
            $contient->setTotalContient();
            $this->entityManager->persist($contient);
        }

        $commande->setStatut('En attente de paiement');
        $commande->setPaiementValide(0);

        $this->entityManager->persist($commande);

        $this->entityManager->flush();
        $session->set('idcommande', $commande->getId());

        return $this->redirectToRoute('app_stripeCheckout', [
            'id' => $commande->getId()
        ]);
    }

    #[Route('/commande/confirmation', name: 'app_commandeLivraison')]
    public function commandeSleep(Request $request, SessionInterface $session, AdresseRepository $adresseRepo): Response
    {
        $commande = $this->commandeRepo->find($session->get('idcommande'));
        $adresseLiv = $adresseRepo->find($session->get('idAdLiv'));
        $adresseFac = $adresseRepo->find($session->get('idAdFac'));
        $commande->setTotalCommande();
        $commande->setStatut('En préparation');
        $commande->setPaiementValide(1);
        $this->entityManager->persist($commande);
        $this->entityManager->flush();
        $livraison = new Livraison();
        $dateliv = new \DateTime();
        $dateliv->modify('+5 days');
        $livraison->setDateLivraison($dateliv);
        $livraison->setTransporteur('DHL');
        $livraison->setUrlSuivi('https://www.php.net/manual/en/function.sleep.php');
        $livraison->setCommande($commande);
        $livraison->setAdresseLivraison($adresseLiv);
        $livraison->setAdresseFacturation($adresseFac);
        $this->entityManager->persist($livraison);

        $this->entityManager->flush();
        $this->panierService->DeleteAllDish();
        return $this->redirectToRoute('app_profil');
    }
}
