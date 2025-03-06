<?php

namespace App\Form;

use App\Entity\Fournisseur;
use App\Entity\Produit;
use App\Entity\SousRubrique;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ProduitFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $produit = $options['data'];
        $sousRubrique = [];

        foreach ($produit->getAvoirs() as $avoir) {
            array_push($sousRubrique, $avoir->getSousRubrique());
        }
        $builder
            ->add('nomProduit', TextType::class, [
                'label' => 'Nom du produit',
            ])
            ->add('refProduit', TextType::class , [
                'label' => 'reference du produit'
            ])
            ->add('prixAchatProduit', MoneyType::class , [
                'label' => 'prix d\'achat du produit'
            ])
            ->add('sousRubrique' , EntityType::class,[
                'class' => SousRubrique::class,
                'mapped' => false,
                'choice_label' => 'nomSousRubrique',
                'expanded' => true,
                'multiple' => true,
                'data' => $sousRubrique,
                'attr' => [
                    'class' => 'list-group '
                ],
                'row_attr' => [
                    'class' => 'align-item text-light'
                ]
            ])
            ->add('descriptionCourt', TextareaType::class , [
                'label' => 'description courte du produit'
            ])
            ->add('descriptionLong', TextareaType::class , [
                'label' => 'description longue du produit'
            ])
            ->add('image', FileType::class , [
                'label' => 'Image du produit',
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
            ->add('stock', IntegerType::class , [
                'label' => 'description courte du produit'
            ])
            ->add('actif',CheckboxType::class)
            ->add('fournisseur', EntityType::class, [
                'class' => Fournisseur::class,
                'choice_label' => 'nomFournisseur',
                'label' => 'Fournisseur',
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
}
