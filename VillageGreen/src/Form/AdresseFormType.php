<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresseFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numeroDeRue', TextType::class,[
                'attr' => [
                    'class' => 'col-3 form-control'
                ]
            ])
            ->add('ville', TextType::class,[
                'attr' => [
                    'class' => 'col-3 form-control'
                ]
            ])
            ->add('codePostal', TextType::class,[
                'attr' => [
                    'class' => 'col-3 form-control'
                ]
            ])
            ->add('nomRue', TextType::class,[
                'attr' => [
                    'class' => 'col-3 form-control'
                ]
            ])
            ->add('complement', TextType::class,[
                'attr' => [
                    'class' => 'col-3 form-control'
                ]
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Suivant',
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
            'data_class' => Adresse::class,
        ]);
    }
}
