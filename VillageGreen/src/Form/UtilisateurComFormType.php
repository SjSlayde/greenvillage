<?php

namespace App\Form;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UtilisateurComFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
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
                'expanded' => false, // Affiche sous forme de menu déroulant (select)
                'attr' => [
                    'class' => 'form-select', // Ajoute la classe Bootstrap pour le style
                ],
                ])
            ->add('coefficientVente', IntegerType::class , [
                'attr' => [
                    'class' => 'col-3 form-control'
                ]
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'Rôles',
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
                'expanded' => false,
                'attr' => [
                    'class' => 'form-select', 
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
