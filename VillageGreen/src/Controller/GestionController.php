<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitFormType;
use App\Repository\ProduitRepository;
use App\Repository\RubriqueRepository;
use App\Repository\SousRubriqueRepository;
use App\Repository\UtilisateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function gestiopn(): Response
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

    #[Route('/gestion/produit/{id}', name: 'app_gestion_produit_modification')]
    public function gestionProduitModification(Produit $produit, Request $request, EntityManagerInterface $em): Response
    {   
        $form = $this->createForm(ProduitFormType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form->get('image')->getData();
            // $file->getClientOriginalName();
            $file->move($this->getParameter('kernel.project_dir') . '/assets/images/produits', $file->getClientOriginalName());
            $produit->setNomImage($file->getClientOriginalName());

            $em->persist($produit);
            $em->flush();

            $this->addFlash('success', 'modification effectuée');
            return $this->redirectToRoute('app_gestion');
        } else {
            return $this->render('gestion/formProduit.html.twig', [
                'form' => $form
            ]);
        }
    }
}
