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
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommandeType extends AbstractType
{
    

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dateVisite', DateType::class, array(
                'widget' => 'single_text',
                //'format' => 'dd-MMMM-yyyy',
                ))
            ->add('type',       ChoiceType::class, array(
                'choices'     => array('Demi-journée' => true, 'Journée' => true),
                'label'       => 'Type de ticket',
                'placeholder' => ''
                ))
            /*->add('nbTicket',   ChoiceType::class, array(
                'choices' => array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5),
                'label'   => 'Nombre de tickets',
                'placeholder' => ''
                ))*/
            ->add('nbTicket',   NumberType::class, array(
            'label' => 'Nombre de tickets',
            'data' => 1,
            ))
            ->add('tickets', CollectionType::class, array(
                'entry_type' => TicketType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,
                'label' => false,
                'by_reference' => false,
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
