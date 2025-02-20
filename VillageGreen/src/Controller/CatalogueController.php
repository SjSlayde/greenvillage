<?php

namespace App\Controller;

use App\Repository\AvoirRepository;
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
        $rubriques = $this->rubriqueRepo->findAll();
        // $sousRubriques = $this->produitRepo->all();
        $produits = $this->produitRepo->findAll();

        $produitQuantite = [];

        foreach ($produits as $produit) {
            $quantite = $produit->getQuantiteVendu();
            $produitQuantite[] = [
                'produit' => $produit,
                'quantite' => $quantite
            ];
        }

        arsort($produitQuantite);

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
        $sousRubriques = $this->sousRubriqueRepo->findAll();


        return $this->render('catalogue/sousRubriques.html.twig', [
            'sousRubriques' => $sousRubriques,
        ]);
    }

    #[Route('/sous-rubrique-{id}', name: 'app_selectSousRubrique', requirements: ['id' => '\d+'])]
    public function SelectSousRubrique(int $id): Response
    {
        $rubriques = $this->rubriqueRepo->find($id);
        $sousRubriques = $this->sousRubriqueRepo->findBy(['Rubrique' => $rubriques]);


        return $this->render('catalogue/sousRubriques.html.twig', [
            'sousRubriques' => $sousRubriques,
        ]);
    }

    #[Route('/produits', name: 'app_produits')]
    public function Produits(): Response
    {
        $produits = $this->produitRepo->findAll();


        return $this->render('catalogue/produits.html.twig', [
            'produits' => $produits,
        ]);
    }

    #[Route('/produits-{id}', name: 'app_selectProduits', requirements: ['id' => '\d+'])]
    public function SelectProduits(int $id): Response
    {
        $sousRubrique = $this->sousRubriqueRepo->find($id);
        $avoirs = $this->avoirsRepo->findBy(['sousRubrique' => $sousRubrique]);
        $produits = [];

        foreach ($avoirs as $avoir) {
            $produit = $avoir->getProduit();
            array_push($produits, $produit);
        }

        return $this->render('catalogue/produits.html.twig', [
            'produits' => $produits,
        ]);
    }
}
