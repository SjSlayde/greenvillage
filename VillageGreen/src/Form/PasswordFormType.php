<?php

namespace App\Form;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class PasswordFormType extends AbstractType
{

    private $utilisateurRepo;

    public function __construct(UtilisateurRepository $utilisateurRepo){
        $this->utilisateurRepo = $utilisateurRepo;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('plainPasswordActuel', PasswordType::class, [
            'mapped' => false,
            'label' => 'Mot de passe actuel',
            'attr' => ['autocomplete' => '',
                        'class' => 'col-3 form-control'],
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez entrer votre mot de passe actuel',
                ]),
            ],
        ])
        ->add('plainPasswordNew1', PasswordType::class, [
            'mapped' => false,
            'label' => 'Saisir le nouveau mot de passe',
            'attr' => ['autocomplete' => 'new-password',
                        'class' => 'col-3 form-control'],
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez entrer votre nouveau mot de passe',
                ]),
                new Length([
                    'min' => 8,
                    'minMessage' => 'Votre Mot de passe doit faire minimum {{ limit }} characters',
                    'max' => 4096,
                ]),
            ],
        ])
        ->add('plainPasswordNew2', PasswordType::class, [
            'mapped' => false,
            'label' => 'Resaisir le nouveau mot de passe',
            'attr' => ['autocomplete' => 'new-password',
                        'class' => 'col-3 form-control'],
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez entrer votre nouveau mot de passe encore une fois',
                ]),
                new Length([
                    'min' => 8,
                    'minMessage' => 'Votre Mot de passe doit faire minimum {{ limit }} characters',
                    'max' => 4096,
                ]),
            ],
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}