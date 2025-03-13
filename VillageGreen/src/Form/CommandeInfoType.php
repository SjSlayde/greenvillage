<?php

namespace App\Form;

use App\Entity\Adresse;
use App\Entity\Commande;
use App\Entity\Utilisateur;
use App\Repository\AdresseRepository;
use App\Repository\AffiliationAdresseRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeInfoType extends AbstractType
{
    private $affiliationAdresseRepo;
    private $adresseRepo;

    public function __construct(AffiliationAdresseRepository $affiliationAdresseRepo,
                                    AdresseRepository $adresseRepo) {
        $this->affiliationAdresseRepo = $affiliationAdresseRepo;
        $this->adresseRepo = $adresseRepo;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $user = $options['data'];

        $affadresseLivs = $this->affiliationAdresseRepo->findBy(['client' => $user, 'type' => 'adLivraison']);
        $affadresseFacs = $this->affiliationAdresseRepo->findBy(['client' => $user, 'type' => 'adFacturation']);
        $adresseLivs = [];
        $adresseFacs = [];

        foreach ($affadresseLivs as $affadresseLiv) {
            $adresseLiv = $affadresseLiv->getAdresse();
            array_push($adresseLivs,$adresseLiv);
        }
        foreach ($affadresseFacs as $affadresseFac) {
            $adresseFac = $affadresseFac->getAdresse();
            array_push($adresseFacs,$adresseFac);
        }



        $builder
        ->add('adresseLiv',EntityType::class, [
            'mapped' => false,
            'class' => Adresse::class,
            'choice_label' => 'nomRue',
            'expanded' => false,
            'multiple' => true,
            'choices' => $adresseLivs,
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
            'choices' => $adresseFacs,
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
