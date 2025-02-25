<?php

namespace App\Form;

use App\Entity\Contact;
use App\Entity\Utilisateur;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Message',TextareaType::class,[
                'label'=> 'Veuillez détailler votre demande :',
                    'attr' => [
                        'class' => 'col-3 form-control'
                    ]
            ])
            ->addEventListener(FormEvents::POST_SUBMIT, $this->setDate(...))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }

    public function setDate(PostSubmitEvent $event): void
    {
        $data = $event->getData();
        $data->setDate(new \DateTime());
    }
}
