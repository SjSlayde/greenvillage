<?php

namespace App\Form;

use App\Entity\Adresse;
use App\Entity\Commande;
use App\Entity\Utilisateur;
use App\Repository\AdresseRepository;
use App\Repository\AffiliationAdresseRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

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
        ->add('adresseLivraison',EntityType::class, [
            'mapped' => false,
            'class' => Adresse::class,
            'choice_label' => 'nomRue',
            'expanded' => true,
            'multiple' => false,
            'choices' => $adresseLivs,
            'attr' => [
                'class' => 'list-group'
            ],
            'row_attr' => [
                'class' => 'align-item text-light'
            ]
        ])
        ->add('adresseFacturation',EntityType::class, [
            'mapped' => false,
            'class' => Adresse::class,
            'choice_label' => 'nomRue',
            'expanded' => true,
            'multiple' => false,
            'choices' => $adresseFacs,
            'attr' => [
                'class' => 'list-group'
            ],
            'row_attr' => [
                'class' => 'align-item text-light'
            ]
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
            ->add('numeros_de_carte', TextType::class, [
                'mapped' => false,
                'label'=> 'numéros de carte',
                'attr' => [ 'class' => 'col-3 form-control'    
                        ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer vos numéros de carte bancaire(promis je ne l\'est utilise pas)',
                    ]),
                    new Length([
                        'min' => 16,
                        'minMessage' => 'minimum {{ limit }} characters',
                        'max' => 16,
                    ])]])
    
                    
            ->add('expiration', DateType::class, [
                'mapped' => false,
                'label'=> 'date d\'expiration de la carte bancaire',
                'widget'   => 'single_text',
                'html5'    => true,
                'attr' => ['class' => 'col-3 form-control'    
                        ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer la date expiration de votre carte bancaire',
                    ]),
                    new Length([
                        'min' => 4,
                        'minMessage' => 'minimum {{ limit }} characters',
                        'max' => 4096,
                    ])]])
    
                    
            ->add('code_securite', TextType::class, [
                'mapped' => false,
                'label'=> 'code de securité',
                'attr' => ['class' => 'col-3 form-control'    
                        ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer le code de securité de la carte bancaire',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'minimum {{ limit }} characters',
                        'max' => 3,
                    ])]])
    
                    
            ->add('nom_titulaire', TextType::class, [
                'mapped' => false,
                'label'=> 'nom du titulaire',
                'attr' => ['class' => 'col-3 form-control'    
                        ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer le nom et prenom du titulaire de la carte bancaire',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'minimum {{ limit }} characters',
                        'max' => 4096,
                    ])]
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
