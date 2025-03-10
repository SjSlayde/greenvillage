<?php

namespace App\Form;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateurComFormType extends AbstractType
{
    private $utilisateursrepo;

    public function __construct(UtilisateurRepository $utilisateursrepo){
        $this->utilisateursrepo = $utilisateursrepo;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $commercials = [];
        foreach ($this->utilisateursrepo->findAll() as $user) {
            if ($user->getRoles() == ["ROLE_COMMER", "ROLE_USER"]) {
                array_push($commercials, $user);
            }
        }

        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'col-3 form-control'
                ]
            ])
            ->add('roles', ChoiceType::class, [
                'label' => 'Rôles',
                'choices' => [
                    'Client' => 'ROLE_CLIENT',
                    'Commercial' => 'ROLE_COMMER',
                    'Gestionnaire' => 'ROLE_GESTION',
                ],
                'multiple' => true,
                'expanded' => true, // Affiche sous forme de menu déroulant (select)
                'attr' => [
                    'class' => 'list-group ',
                ],
                'row_attr' => [
                    'class' => 'align-item text-light'
                ]
                ])
            ->add('coefficientVente', IntegerType::class , [
                'attr' => [
                    'class' => 'col-3 form-control'
                ]
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'type d\'utilisateur',
                'choices' => [
                    'particulier' => 'particulier',
                    'professionnel' => 'professionnel',
                    'personnel' => 'personnel',
                ],
                'expanded' => false, // Affiche sous forme de menu déroulant (select)
                'attr' => [
                    'class' => 'form-select', // Ajoute la classe Bootstrap pour le style
                ],
                ])
            ->add('coefficientReduction', IntegerType::class , [
                'attr' => [
                    'class' => 'col-3 form-control'
                ]
            ])
            ->add('idCommercial', EntityType::class, [
                'label' => 'nom du commercial',
                'class' => Utilisateur::class,
                'choice_label' => 'nom',
                'choices' => $commercials,
                'multiple' => false,
                'expanded' => false,
                'attr' => [
                    'class' => 'form-select', 
                ],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Sauvegarder',
                'attr' => [
                    'class' => 'btn btn-success color-315F72 rounded-pill '
                ],
                'row_attr' => [
                    'class' => 'd-flex justify-content-end'
                ]
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
