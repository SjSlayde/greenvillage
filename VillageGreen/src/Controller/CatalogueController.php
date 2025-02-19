<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\RubriqueRepository;
use App\Repository\SousRubriqueRepository;
use App\Repository\ProduitRepository;

class CatalogueController extends AbstractController
{

    private $rubriqueRepo;
    private $produitRepo;
    private $SousRubriqueRepo;

    public function __construct(RubriqueRepository $rubriqueRepo,ProduitRepository $produitRepo,SousRubriqueRepository $SousRubriqueRepo)
    {
        $this->rubriqueRepo = $rubriqueRepo;
        $this->produitRepo = $produitRepo;
        $this->SousRubriqueRepo = $SousRubriqueRepo;
    }

    #[Route('/', name: 'app_index')]
    public function index(): Response
    {
        $rubriques = $this->rubriqueRepo->findAll();
        // $sousRubriques = $this->produitRepo->all();
        $produits = $this->produitRepo->findAll();

        $produitQuantite = [];

        foreach($produits as $produit){
            $quantite = $produit->getTotalQuantite();
            $produitQuantite[] = [
                'produit' => $produit,
                'quantite' => $quantite
            ];
        }

        arsort($produitQuantite);

        $compteur = 0;

        foreach($produitQuantite as $produit=>$quantite){
            if ($compteur == 3 ){
                unset($produitQuantite[$produit]);
            }else{
                $compteur++;
            }
        }

        return $this->render('catalogue/index.html.twig', [
            'controller_name' => 'CatalogueController',
            'rubriques' => $rubriques,
            'produitQuantite' => $produitQuantite
        ]);
    }
}
