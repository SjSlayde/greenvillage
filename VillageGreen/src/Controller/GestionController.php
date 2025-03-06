<?php

namespace App\Controller;

use App\Entity\Avoir;
use App\Entity\Produit;
use App\Form\ProduitFormType;
use App\Repository\AvoirRepository;
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
    private $AvoirRepo;

    public function __construct(
        UtilisateurRepository $utilisateurRepository,
        ProduitRepository $produitRepository,
        SousRubriqueRepository $sousRubriqueRepository,
        RubriqueRepository $rubriqueRepository,
        AvoirRepository $AvoirRepo
    ) {
        $this->utilisateurRepo = $utilisateurRepository;
        $this->produitRepo = $produitRepository;
        $this->sousRubriqueRepo = $sousRubriqueRepository;
        $this->rubriqueRepo = $rubriqueRepository;
        $this->AvoirRepo = $AvoirRepo;
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

    #[Route('/gestion/produit/new', name: 'app_gestion_produit_ajout')]
    public function gestionProduitAjout(Request $request, EntityManagerInterface $em): Response
    {   

        $produit = new Produit();
        $form = $this->createForm(ProduitFormType::class, $produit);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $file = $form->get('image')->getData();
            $file->move($this->getParameter('kernel.project_dir') . '/assets/images/produits', $file->getClientOriginalName());
            $produit->setNomImage($file->getClientOriginalName());
            $sousRubriquesform = $form->get('sousRubrique')->getData();
            $sousRubriques = $this->sousRubriqueRepo->findAll();
            
            foreach ($sousRubriquesform as $sousRubrique) {
                if($this->AvoirRepo->findOneBy(['produit' => $produit,'sousRubrique' => $sousRubrique]) == null) {
                    $avoir = new Avoir();
                    $avoir->setProduit($produit);
                    $avoir->setSousRubrique($sousRubrique); 
                    $em->persist($avoir);
                }
            }
            foreach ($sousRubriquesform  as $sousRubriqueform) {
                $count = 0;
                foreach ($sousRubriques as $sousRubrique) {
                    if($sousRubriqueform == $sousRubrique) {
                        $count++;
                        }
                }
                if($count == 0 && $this->AvoirRepo->findOneBy(['produit' => $produit,'sousRubrique' => $sousRubrique]) != null) {
                    $avoir = $this->AvoirRepo->findOneBy(['produit' => $produit,'sousRubrique' => $sousRubrique]);
                    $em->remove($avoir);
                    // $produit->removeAvoir($avoir);
            }
        }

            $em->persist($produit);
            $em->flush();

            $this->addFlash('success', 'Ajout effectuée');
            return $this->redirectToRoute('app_gestion');
        } else {
            return $this->render('gestion/formProduit.html.twig', [
                'form' => $form
            ]);
        }
    }

    #[Route('/gestion/produit/{id}', name: 'app_gestion_produit_modification')]
    public function gestionProduitModification(Produit $produit, Request $request, EntityManagerInterface $em): Response
    {   

        if($produit){
            $form = $this->createForm(ProduitFormType::class, $produit);
        } else {
            $produit = new Produit();
            $form = $this->createForm(ProduitFormType::class, $produit);
        }
        $form = $this->createForm(ProduitFormType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form->get('image')->getData();
            if($file){
                $file->move($this->getParameter('kernel.project_dir') . '/assets/images/produits', $file->getClientOriginalName());
                $produit->setNomImage($file->getClientOriginalName());
            }

            $sousRubriquesform = $form->get('sousRubrique')->getData();
            $sousRubriques = $this->sousRubriqueRepo->findAll();
            
            foreach ($sousRubriquesform as $sousRubrique) {
                if($this->AvoirRepo->findOneBy(['produit' => $produit,'sousRubrique' => $sousRubrique]) == null) {
                    $avoir = new Avoir();
                    $avoir->setProduit($produit);
                    $avoir->setSousRubrique($sousRubrique); 
                    $em->persist($avoir);
                }
            }
            foreach ($sousRubriquesform  as $sousRubriqueform) {
                $count = 0;
                foreach ($sousRubriques as $sousRubrique) {
                    if($sousRubriqueform == $sousRubrique) {
                        $count++;
                        }
                    }
                    if($count == 0 && $this->AvoirRepo->findOneBy(['produit' => $produit,'sousRubrique' => $sousRubrique]) != null) {
                        $avoir = $this->AvoirRepo->findOneBy(['produit' => $produit,'sousRubrique' => $sousRubrique]);
                        $em->remove($avoir);
                        // $produit->removeAvoir($avoir);
            }
        }
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
