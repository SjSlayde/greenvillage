<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use App\Repository\RubriqueRepository;
use App\Repository\SousRubriqueRepository;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class GestionController extends AbstractController
{

    private $utilisateurRepo;
    private $produitRepo;
    // private $commandeRepo;
    private $sousRubriqueRepo;
    private $rubriqueRepo;

    public function __construct(
        UtilisateurRepository $utilisateurRepository,
        ProduitRepository $produitRepository,
        SousRubriqueRepository $sousRubriqueRepository,
        RubriqueRepository $rubriqueRepository
    ) {
        $this->utilisateurRepo = $utilisateurRepository;
        $this->produitRepo = $produitRepository;
        $this->sousRubriqueRepo = $sousRubriqueRepository;
        $this->rubriqueRepo = $rubriqueRepository;
    }


    #[Route('/gestion', name: 'app_gestion')]
    public function index(): Response
    {
        $produits = $this->produitRepo->findAll();
        $sousRubriques = $this->sousRubriqueRepo->findAll();
        $rubriques = $this->rubriqueRepo->findAll();
        $utilisateurs = $this->utilisateurRepo->findAll();

        return $this->render('gestion/index.html.twig', [
            'produits' => $produits,
            'rubriques' => $rubriques,
            'sousRubriques' => $sousRubriques,
            'utilisateurs' => $utilisateurs,
        ]);
    }
}
