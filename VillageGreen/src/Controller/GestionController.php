<?php

namespace App\Controller;

use App\Entity\Avoir;
use App\Entity\Produit;
use App\Entity\Rubrique;
use App\Entity\SousRubrique;
use App\Entity\Utilisateur;
use App\Form\ProduitFormType;
use App\Form\RubriqueFormType;
use App\Form\SousRubriqueFormType;
use App\Form\UtilisateurComFormType;
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
    private $entityManager;

    public function __construct(
        UtilisateurRepository $utilisateurRepository,
        ProduitRepository $produitRepository,
        SousRubriqueRepository $sousRubriqueRepository,
        RubriqueRepository $rubriqueRepository,
        AvoirRepository $AvoirRepo,
        EntityManagerInterface $em
    ) {
        $this->utilisateurRepo = $utilisateurRepository;
        $this->produitRepo = $produitRepository;
        $this->sousRubriqueRepo = $sousRubriqueRepository;
        $this->rubriqueRepo = $rubriqueRepository;
        $this->AvoirRepo = $AvoirRepo;
        $this->entityManager = $em;
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
    public function gestionProduitAjout(Request $request): Response
    {   

        $produit = new Produit();
        $form = $this->createForm(ProduitFormType::class, $produit);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            
            $file = $form->get('image')->getData();
            $file->move($this->getParameter('kernel.project_dir') . '/assets/images/produits', $file->getClientOriginalName());
            $produit->setNomImage($file->getClientOriginalName());
            $this->setSousRubriqueinProduit($form,$produit);

            $this->addFlash('success', 'Ajout effectuée');
            return $this->redirectToRoute('app_gestion');
        } else {
            return $this->render('gestion/formProduit.html.twig', [
                'form' => $form
            ]);
        }
    }

    #[Route('/gestion/produit/{id}', name: 'app_gestion_produit_modification')]
    public function gestionProduitModification(Produit $produit, Request $request): Response
    {   
        $form = $this->createForm(ProduitFormType::class, $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form->get('image')->getData();
            if($file){
                $file->move($this->getParameter('kernel.project_dir') . '/assets/images/produits', $file->getClientOriginalName());
                $produit->setNomImage($file->getClientOriginalName());
            }

            $this->setSousRubriqueinProduit($form,$produit);

            $this->addFlash('success', 'modification effectuée');
            return $this->redirectToRoute('app_gestion');
        } else {
            return $this->render('gestion/formProduit.html.twig', [
                'form' => $form,
                'produit' => $produit
            ]);
        }
    }

    #[Route('/gestion/sousRubrique/new', name: 'app_gestion_sousRubrique_ajout')]
    public function gestionSousRubriqueAjout(Request $request): Response
    {   
        $sousRubrique = new SousRubrique();
        $form = $this->createForm(SousRubriqueFormType::class, $sousRubrique);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form->get('image')->getData();
            if($file){
                $file->move($this->getParameter('kernel.project_dir') . '/assets/images/rubriques-sousRubriques', $file->getClientOriginalName());
                $sousRubrique->setImageSousRubrique($file->getClientOriginalName());
            }

            $this->entityManager->persist($sousRubrique);
            $this->entityManager->flush();

            $this->addFlash('success', 'modification effectuée');
            return $this->redirectToRoute('app_gestion');
        } else {
            return $this->render('gestion/formsousRubrique.html.twig', [
                'form' => $form,
            ]);
        }
    }

    #[Route('/gestion/sousRubrique/{id}', name: 'app_gestion_sousRubrique_modification')]
    public function gestionSousRubriqueModification(SousRubrique $sousRubrique, Request $request): Response
    {   
        $form = $this->createForm(SousRubriqueFormType::class, $sousRubrique);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form->get('image')->getData();
            if($file){
                $file->move($this->getParameter('kernel.project_dir') . '/assets/images/rubriques-sousRubriques', $file->getClientOriginalName());
                $sousRubrique->setImageSousRubrique($file->getClientOriginalName());
            }

            $this->entityManager->persist($sousRubrique);
            $this->entityManager->flush();

            $this->addFlash('success', 'modification effectuée');
            return $this->redirectToRoute('app_gestion');
        } else {
            return $this->render('gestion/formsousRubrique.html.twig', [
                'form' => $form,
                'sousRubrique' => $sousRubrique
            ]);
        }
    }

    #[Route('/gestion/rubrique/new', name: 'app_gestion_rubrique_ajout')]
    public function gestionRubriqueAjout(Request $request): Response
    {   
        $rubrique = new Rubrique();
        $form = $this->createForm(RubriqueFormType::class, $rubrique);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form->get('image')->getData();
            if($file){
                $file->move($this->getParameter('kernel.project_dir') . '/assets/images/rubriques-sousRubriques', $file->getClientOriginalName());
                $rubrique->setImageRubrique($file->getClientOriginalName());
            }

            $this->entityManager->persist($rubrique);
            $this->entityManager->flush();

            $this->addFlash('success', 'modification effectuée');
            return $this->redirectToRoute('app_gestion');
        } else {
            return $this->render('gestion/formRubrique.html.twig', [
                'form' => $form,
            ]);
        }
    }

    #[Route('/gestion/rubrique/{id}', name: 'app_gestion_rubrique_modification')]
    public function gestionRubriqueModification(Rubrique $rubrique, Request $request): Response
    {   
        $form = $this->createForm(RubriqueFormType::class, $rubrique);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form->get('image')->getData();
            if($file){
                $file->move($this->getParameter('kernel.project_dir') . '/assets/images/rubriques-sousRubriques', $file->getClientOriginalName());
                $rubrique->setImageRubrique($file->getClientOriginalName());
            }

            $this->entityManager->persist($rubrique);
            $this->entityManager->flush();

            $this->addFlash('success', 'modification effectuée');
            return $this->redirectToRoute('app_gestion');
        } else {
            return $this->render('gestion/formRubrique.html.twig', [
                'form' => $form,
                'rubrique' => $rubrique
            ]);
        }
    }

    #[Route('/gestion/utilisateur/{id}', name: 'app_gestion_utilisateur_modification')]
    public function gestionUtilisateurModification(Utilisateur $utilisateur, Request $request): Response
    {   
        $form = $this->createForm(UtilisateurComFormType::class, $utilisateur);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $this->entityManager->persist($utilisateur);
            $this->entityManager->flush();

            $this->addFlash('success', 'modification effectuée');
            return $this->redirectToRoute('app_gestion');
        } else {
            return $this->render('gestion/formUtilisateurComm.html.twig', [
                'form' => $form,
                'utilisateur' => $utilisateur
            ]);
        }
    }


    public function setSousRubriqueinProduit($form,Produit $produit){
        $sousRubriquesform = $form->get('sousRubrique')->getData();
        $sousRubriques = $this->sousRubriqueRepo->findAll();
        
        foreach ($sousRubriquesform as $sousRubrique) {
            if($this->AvoirRepo->findOneBy(['produit' => $produit,'sousRubrique' => $sousRubrique]) == null) {
                $avoir = new Avoir();
                $avoir->setProduit($produit);
                $avoir->setSousRubrique($sousRubrique); 
                $this->entityManager->persist($avoir);
            }
        }
        foreach ($sousRubriques as $sousRubrique) {
            $count = 0;
            foreach ($sousRubriquesform  as $sousRubriqueform) {
                if($sousRubriqueform == $sousRubrique) {
                    $count++;
                    }
            }
            if($count == 0 && $this->AvoirRepo->findOneBy(['produit' => $produit,'sousRubrique' => $sousRubrique]) != null) {
                $avoir = $this->AvoirRepo->findOneBy(['produit' => $produit,'sousRubrique' => $sousRubrique]);
                $this->entityManager->remove($avoir);
        }
    }

        $this->entityManager->persist($produit);
        $this->entityManager->flush();
    }

}
