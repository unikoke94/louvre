<?php

namespace Louvre\BilletterieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Louvre\BilletterieBundle\Form\TicketType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, array(
                'label' => 'Email',
                'attr'  => array(
                    'placeholder' => 'Votre email'
                    ),
                ))
            ->add('dateVisite', DateType::class, array(
                'widget' => 'single_text',
                'label'  => 'Date de visite',
                'html5'  => false,
                'attr'   => array(
                    'placeholder' => 'Votre date de visite',
                    'readOnly'    => 'readOnly',//Pour empêcher de rentrer une date incorrecte
                    ),
                'format' => 'dd/MM/yyyy',
                'required' => true,
                ))
            ->add('type',       ChoiceType::class, array(
                'choices'     => array('Demi-journée' => 'Demi-journée', 'Journée' => 'Journée'),
                'label'       => 'Type de billet',
                'placeholder' => '',
                ))
            ->add('nbTicket',   NumberType::class, array(
                'label' => 'Nombre de billets',
                'data'  => 1,
            ))
            ->add('tickets', CollectionType::class, array(
                'entry_type' => TicketType::class,
                'entry_options' => array(
                    'attr' => array('class' => 'block-ticket')),
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'label' => false,
                'by_reference' => false,
                'required' => true,
                ))
            ->add('save', SubmitType::class, array(
                'label' => 'Confirmer'
                ));
    }
    
   

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Louvre\BilletterieBundle\Entity\Commande'
            //'data_class' => null
        ));
    }


}
