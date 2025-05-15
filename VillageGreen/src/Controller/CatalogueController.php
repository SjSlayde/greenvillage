<?php

namespace App\Controller;

use App\Repository\AvoirRepository;
use App\Service\BarreSearchService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\RubriqueRepository;
use App\Repository\SousRubriqueRepository;
use App\Repository\ProduitRepository;
use Symfony\Component\Routing\Requirement\Requirement;

class CatalogueController extends AbstractController
{
    private $rubriqueRepo;
    private $produitRepo;
    private $sousRubriqueRepo;
    private $avoirsRepo;

    // Injection des repositories nécessaires au contrôleur
    public function __construct(RubriqueRepository $rubriqueRepo, ProduitRepository $produitRepo, SousRubriqueRepository $SousRubriqueRepo, AvoirRepository $avoirsRepo)
    {
        $this->rubriqueRepo = $rubriqueRepo;
        $this->produitRepo = $produitRepo;
        $this->sousRubriqueRepo = $SousRubriqueRepo;
        $this->avoirsRepo = $avoirsRepo;
    }

    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        // Récupération de toutes les rubriques et produits
        $rubriques = $this->rubriqueRepo->findAll();
        $produits = $this->produitRepo->findAll();

        $produitQuantite = [];

        // Association produit -> quantité vendue
        foreach ($produits as $produit) {
            $quantite = $produit->getQuantiteVendu();
            $produitQuantite[] = [
                'produit' => $produit,
                'quantite' => $quantite
            ];
        }

        // Tri croissant par quantité
        asort($produitQuantite);

        // On garde les 3 premiers éléments
        $compteur = 0;
        foreach ($produitQuantite as $produit => $quantite) {
            if ($compteur == 3) {
                unset($produitQuantite[$produit]);
            } else {
                $compteur++;
            }
        }

        return $this->render('catalogue/index.html.twig', [
            'controller_name' => 'CatalogueController',
            'rubriques' => $rubriques,
            'produitQuantite' => $produitQuantite
        ]);
    }

    #[Route('/sous-rubrique', name: 'app_sousRubrique')]
    public function SousRubrique(): Response
    {
        // Affiche toutes les sous-rubriques
        $sousRubriques = $this->sousRubriqueRepo->findAll();

        return $this->render('catalogue/sousRubriques.html.twig', [
            'sousRubriques' => $sousRubriques,
        ]);
    }

    #[Route('/sous-rubrique-{id}', name: 'app_selectSousRubrique', requirements: ['id' => '\d+'])]
    public function SelectSousRubrique(int $id): Response
    {
        // Récupère les sous-rubriques liées à une rubrique donnée
        $rubriques = $this->rubriqueRepo->find($id);
        $sousRubriques = $this->sousRubriqueRepo->findBy(['Rubrique' => $rubriques]);

        return $this->render('catalogue/sousRubriques.html.twig', [
            'sousRubriques' => $sousRubriques,
        ]);
    }

    #[Route('/produits', name: 'app_produits')]
    public function Produits(): Response
    {
        // Affiche tous les produits
        $produits = $this->produitRepo->findAll();

        return $this->render('catalogue/produits.html.twig', [
            'produits' => $produits,
        ]);
    }

    #[Route('/produits-{id}', name: 'app_selectProduits', requirements: ['id' => '\d+'])]
    public function SelectProduits(int $id): Response
    {
        // Affiche les produits associés à une sous-rubrique via les "avoirs"
        $sousRubrique = $this->sousRubriqueRepo->find($id);
        $avoirs = $this->avoirsRepo->findBy(['sousRubrique' => $sousRubrique]);
        $produits = [];

        foreach ($avoirs as $avoir) {
            $produits[] = $avoir->getProduit();
        }

        return $this->render('catalogue/produits.html.twig', [
            'produits' => $produits,
        ]);
    }

    #[Route('/produit/{id}', name: 'app_detailProduit', requirements: ['id' => '\d+'])]
    public function DetailProduits(int $id): Response
    {
        // Affiche le détail d’un produit spécifique
        $produit = $this->produitRepo->find($id);

        return $this->render('catalogue/detailproduit.html.twig', [
            'produit' => $produit,
        ]);
    }

    #[Route('/recherche', name: 'app_recherche')]
    public function ShowRecherche(BarreSearchService $searchService): Response
    {
        // Récupère la recherche depuis les paramètres GET
        $recherche = $_GET['recherche'];

        // Si la recherche correspond à un plat, on affiche les plats
        if ($searchService->SearchProduit($recherche) != null) {
            $produit = $searchService->SearchProduit($recherche);
            $this->addFlash('success', count($produit).' produit(s) trouvé pour votre recherche');
            return $this->render('catalogue/produits.html.twig', [
                'produits' => $produit,
            ]);
        }
        // Si la recherche correspond à une catégorie, on affiche les catégories
        elseif ($searchService->SearchSousRubrique($recherche) != null) {
            $sousRubrique = $searchService->SearchSousRubrique($recherche);
            $this->addFlash('success', count($sousRubrique).' sous-rubrique(s) trouvé pour votre recherche');
            return $this->render('catalogue/sousRubrique.html.twig', [
                'sousRubriques' => $sousRubrique ,
            ]);
        }
        
        // Si rien n'est trouvé, on redirige vers la page d'accueil
        else {
            $this->addFlash('danger', 'aucun resultat trouvé pour votre recherche');
            return $this->redirectToRoute('app_index');
        }
    }
}
