<?php

namespace App\Form;

use App\Entity\Rubrique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class RubriqueFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomRubrique', TextType::class, [
                'label' => 'Nom de la rubrique',
                'attr' => [
                    'class' => 'form-control'
                    ]
            ])
            ->add('image', FileType::class , [
                'label' => 'Image de la sous-rubrique',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '5M', // Limite à 2 Mo
                        'mimeTypes' => ['image/jpeg', 'image/png', 'image/gif'],
                        'mimeTypesMessage' => 'Veuillez télécharger une image valide (JPEG, PNG, GIF)',
                    ])
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
            'data_class' => Rubrique::class,
        ]);
    }
}
