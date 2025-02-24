<?php

namespace App\Form;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RegistrationFormType extends AbstractType
{

    private $utilisateurRepo;

    public function __construct(UtilisateurRepository $utilisateurRepo){
        $this->utilisateurRepo = $utilisateurRepo;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => [
                    'class' => 'col-3 form-control'
                ]
            ])
            ->add('prenom', TextType::class, [
                'attr' => [
                    'class' => 'col-3 form-control'
                ]
            ])
            ->add('telephone', TextType::class, [
                'label' => 'Numéro de téléphone',
                'attr' => [
                    'class' => 'col-3 form-control'
                ]
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'col-3 form-control'
                ]
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'label' => 'Veuillez accepter les conditions générales d\'utilisation',
                'constraints' => [
                    new IsTrue([
                        'message' => 'Veuillez accepter les termes d\'utilisation ',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'label' => 'Mot de passe',
                'attr' => ['autocomplete' => 'new-password',
                            'class' => 'col-3 form-control'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Votre Mot de passe doit faire minimum {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->addEventListener(FormEvents::POST_SUBMIT, $this->setInfo(...))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }

    public function setInfo(PostSubmitEvent $event): void
    {
        $commercial = $this->utilisateurRepo->findOneBy(['email' => 'dplain2@google.pl']);
        $data = $event->getData();
        $data->setRoles(['ROLE_CLIENT']);
        $data->setCoefficientVente(80);
        $data->setCoefficientReduction(0);
        $data->setType('particulier');
        $data->setIdCommercial($commercial);
    }
}
