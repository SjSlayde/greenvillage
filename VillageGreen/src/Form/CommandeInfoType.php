<?php

namespace App\Form;

use App\Entity\Adresse;
use App\Entity\Commande;
use App\Entity\Utilisateur;
use App\Repository\AffiliationAdresseRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeInfoType extends AbstractType
{
    private $affiliationAdresseRepo;

    public function __construct(AffiliationAdresseRepository $affiliationAdresseRepo) {
        $this->affiliationAdresseRepo = $affiliationAdresseRepo;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $options['data'];

        $adresseLiv = $this->affiliationAdresseRepo->findBy(['client' => $user, 'type' => 'adLivraison']);
        $adresseFac = $this->affiliationAdresseRepo->findBy(['client' => $user, 'type' => 'adFacturation']);

        $builder
        ->add('adresseLiv',EntityType::class, [
            'mapped' => false,
            'class' => Adresse::class,
            'choice_label' => 'nomRue',
            'expanded' => false,
            'multiple' => true,
            'data' => $adresseLiv,
            'attr' => [
                'class' => 'list-group'
            ],
            'row_attr' => [
                'class' => 'align-item text-light'
            ]
        ])
        ->add('adresseFac',EntityType::class, [
            'mapped' => false,
            'class' => Adresse::class,
            'choice_label' => 'nomRue',
            'expanded' => false,
            'multiple' => true,
            'data' => $adresseFac,
            'attr' => [
                'class' => 'list-group'
            ],
            'row_attr' => [
                'class' => 'align-item text-light'
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
