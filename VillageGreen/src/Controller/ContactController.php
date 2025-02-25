<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Manager\ContactManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ContactFormType;


class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, ContactManager $ContactManager): Response
    {
        if (!$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY')) {
        $contact = new Contact();
        $utilisateur = $this->getUser();

        $form = $this->createForm(ContactFormType::class, $contact);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $contact->setUtilisateur($utilisateur);
            $ContactManager->setContact($contact);

            $this->addFlash('success', 'Vous allez être contacté sous peu');
            return $this->redirectToRoute('app_index');
        } else {
            return $this->render('contact/index.html.twig', [
                'form' => $form
            ]);
        }} else {
            $this->addFlash('danger', 'Veuillez vous connecter');
            return $this->redirectToRoute('app_login');
        }
    }

    #[Route('/politique_de_confidentialite', name: 'app_pdf')]
    public function politiqueconf(): Response
    {

        return $this->render('contact/politique_de_confidentialite.html.twig');
    }

    #[Route('/mention_legale', name: 'app_mention_legale')]
    public function mention_legale(): Response
    {

        return $this->render('contact/mention_legale.html.twig');
    }
}