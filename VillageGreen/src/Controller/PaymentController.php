<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Entity\Contient;
use Doctrine\ORM\EntityManagerInterface;
use Stripe\Checkout\Session;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

final class PaymentController extends AbstractController
{
    private $stripeSecretKey;
    private $entityManager;

    private $urlGenerator;

    public function __construct(#[Autowire('%env(STRIPE_SECRET_KEY)%')] string $apikey, EntityManagerInterface $entytiManager, UrlGeneratorInterface $urlGenerator)
    {
        $this->stripeSecretKey = $apikey;
        $this->entityManager = $entytiManager;
        $this->urlGenerator = $urlGenerator;
    }

    #[Route('/order/create-session-stripe/{id}', name: 'app_stripeCheckout')]
    public function stripeCheckout(int $id, Request $request): RedirectResponse
    {
        $produitStripe = [];

        // Récupération de la commande via son ID
        $commande = $this->entityManager->getRepository(Commande::class)->find($id);

        if (!$commande) {
            $this->addFlash('warning', 'une erreur c\'est produite');
            $this->redirectToRoute('app_panier');
        }

        // Clé API Stripe
        Stripe::setApiKey($this->stripeSecretKey);

        // Récupère tous les produits associés à la commande
        $contients = $this->entityManager->getRepository(Contient::class)->findBy(['commande' => $commande]);

        // Préparation des lignes de commande pour Stripe
        foreach ($contients as $contient) {
            // Calcule le prix unitaire TTC du produit
            $prixProduit = $contient->getPrixUnitaireHT() + $contient->getTVA() / $contient->getQuantite();
            $prixProduit = number_format($prixProduit, 2, '', '');
            $produitStripe[] = [
                'price_data' => [
                    'currency' => 'eur',
                    'unit_amount' => $prixProduit,
                    'product_data' => [
                        'name' => $contient->getProduit()->getNomProduit(),
                    ]
                ],
                'quantity' => $contient->getQuantite()
            ];
        }

        // Création de la session de paiement Stripe
        $checkout_session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    $produitStripe
                ]
            ],
            'mode' => 'payment',
            'success_url' => $this->urlGenerator->generate('app_commandeLivraison', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->urlGenerator->generate('app_panier', [], UrlGeneratorInterface::ABSOLUTE_URL),
        ]);

        // Redirection vers l'URL de paiement Stripe
        return new RedirectResponse($checkout_session->url);
    }
}
