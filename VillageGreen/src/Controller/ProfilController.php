<?php

namespace App\Controller;

use App\Entity\Adresse;
use App\Entity\AffiliationAdresse;
use App\Form\AdresseFormType;
use App\Form\PasswordFormType;
use App\Form\UtilisateurFormType;
use App\Repository\AdresseRepository;
use App\Repository\AffiliationAdresseRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

final class ProfilController extends AbstractController
{
    private $adresserepo;
    private $affiliationAdressesrepo;

    public function __construct(AdresseRepository $adresserepo, AffiliationAdresseRepository $affiliationAdresseRepo)
    {
        $this->adresserepo = $adresserepo;
        $this->affiliationAdressesrepo = $affiliationAdresseRepo;
    }
    #[Route('/profil', name: 'app_profil')]
    public function profil(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        /** @var \App\Entity\Utilisateur $user */
        $user = $this->getUser();
        $affilLivs = $this->affiliationAdressesrepo->findBy(['client' => $user, 'type' => 'adLivraison']);
        $adressesFacs = $this->affiliationAdressesrepo->findBy(['client' => $user, 'type' => 'adFacturation']);

        $adressesLiv = [];
        $adressesFac = [];

        foreach ($affilLivs as $adresseLiv) {
            array_push($adressesLiv, $adresseLiv->getAdresse());
        }

        foreach ($adressesFacs as $adresseFac) {
            array_push($adressesFac, $adresseFac->getAdresse());
        }

        return $this->render('profil/index.html.twig', [
            'user' => $user,
            'adressesLiv' => $adressesLiv,
            'adressesFac' => $adressesFac
        ]);
    }

    #[Route('/profil/nouvelle_adresse_{type}', name: 'app_newadresse')]
    public function newAdresse(Request $request, EntityManagerInterface $em, string $type): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $adresse = new Adresse();

        $form = $this->createForm(AdresseFormType::class, $adresse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $detailAdresse = new AffiliationAdresse();
            if ($type == 'livraison') {
                $detailAdresse->setType('adLivraison');
            } elseif ($type =='facturation') {
                $detailAdresse->setType('adFacturation');
            } else {
                $this->addFlash('warning', 'Votre adresse de livraison n\'a pas été ajoutée a cause d\'une erreur');

                return $this->redirectToRoute('app_profil', [
                    'nom' => $user->getNom(),
                    'prenom' => $user->getPrenom()
                ]);
            }

            $detailAdresse->setAdresse($adresse);
            $detailAdresse->setClient($user);
            $em->persist($adresse);
            $em->persist($detailAdresse);
            $em->flush();

            $this->addFlash('success', 'Votre adresse de livraison a été ajoutée');

            return $this->redirectToRoute('app_profil', [
                'nomuser' => $user->getNom(),
                'prenomuser' => $user->getPrenom()
            ]);
        }

        return $this->render('profil/newAdresse.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/profil/modifier_information', name: 'app_modifier_info')]
    public function modifierInformation(Request $request, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        $form = $this->createForm(UtilisateurFormType::class, $user);
        $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($user);
                $em->flush();

                $this->addFlash('success', 'Vos informations personnelles ont été changées');

                return $this->redirectToRoute('app_profil', [
                    'nomuser' => $user->getNom(),
                    'prenomuser' => $user->getPrenom()
                ]);
            }

            return $this->render('profil/modifInfoProfil.html.twig', [
                'form' => $form
            ]);
    }

    #[Route('/profil/modifier_password', name: 'app_modifier_password')]
    public function modifierPassword(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $em): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        $form = $this->createForm(PasswordFormType::class, $user);
        $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $plainPasswordActuel = $form->get('plainPasswordActuel')->getData();
                $plainPasswordNew1 = $form->get('plainPasswordNew1')->getData();
                $plainPasswordNew2 = $form->get('plainPasswordNew2')->getData();

                if ($userPasswordHasher->isPasswordValid($user , $plainPasswordActuel) && $plainPasswordNew1 == $plainPasswordNew2) {
                    $user->setPassword($userPasswordHasher->hashPassword($user, $plainPasswordNew1));

                    $em->persist($user);
                    $em->flush();
    
                    $this->addFlash('success', 'Vos informations personnelles ont été changées');
    
                    return $this->redirectToRoute('app_profil', [
                        'nomuser' => $user->getNom(),
                        'prenomuser' => $user->getPrenom()
                    ]);
                }
                else {
                    $this->addFlash('danger', 'Information incorrect');

                    return $this->redirectToRoute('app_modifier_password', [
                        'nomuser' => $user->getNom(),
                        'prenomuser' => $user->getPrenom()
                    ]);
                }
            }

            return $this->render('profil/modifPassword.html.twig', [
                'form' => $form
            ]);
    }

    #[Route('/profil/modifier_adresse_{id}', name: 'app_modifieAdresse', requirements: ['id' => '\d+'])]
    public function modifierAdresse(Request $request, EntityManagerInterface $em, int $id): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $adresse = $this->adresserepo->find($id);
        $user = $this->getUser();

        $affilAd = $this->affiliationAdressesrepo->findBy(['client' => $user, 'adresse' => $adresse]);

        if ($affilAd != null) {
            $form = $this->createForm(AdresseFormType::class, $adresse);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->persist($adresse);
                $em->flush();
                $this->addFlash('success', 'Votre adresse de livraison a été modifiée');

                return $this->redirectToRoute('app_profil', [
                    'nomuser' => $user->getNom(),
                    'prenomuser' => $user->getPrenom()
                ]);
            }

            return $this->render('profil/newAdresse.html.twig', [
                'form' => $form
            ]);
        } else {
            $this->addFlash('warning', 'adresse introuvable');
            return $this->redirectToRoute('app_index');
        }
    }

    #[Route('/profil/remove_adresse-{id}-{type}', name: 'app_suppadresse', requirements: ['id' => '\d+'])]
    public function removeAdresse(Request $request, EntityManagerInterface $em, int $id,string $type): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $adresse = $this->adresserepo->find($id);
        $user = $this->getUser();
        $affilAd = $this->affiliationAdressesrepo->findOneBy(['client' => $user,'type'=>$type, 'adresse' => $adresse]);

        if ($affilAd != null) {
        $em->remove($affilAd);
        $em->flush();
        if ($this->affiliationAdressesrepo->findBy(['adresse' => $adresse]) == null){
        $em->remove($adresse);
        }
        $em->flush();

        $this->addFlash('success', 'Votre adresse de livraison a été supprimée');

        return $this->redirectToRoute('app_profil', [
            'nomuser' => $user->getNom(),
            'prenomuser' => $user->getPrenom()
        ]);
    } else {
        $this->addFlash('warning', 'adresse introuvable');
        return $this->redirectToRoute('app_index');
    }
    }
}
