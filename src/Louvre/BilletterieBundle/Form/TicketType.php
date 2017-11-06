<?php

namespace Louvre\BilletterieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketType extends AbstractType
{
    

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',           TextType::class, array(
                'attr' => array(
                    'placeholder' => 'Votre nom',
                    )
                ))
            ->add('prenom',        TextType::class, array(
                'label' => 'Prénom',
                'attr'  => array(
                    'placeholder' => 'Votre prénom',
                    )
                ))
            ->add('pays',          CountryType::class, array(
                'label'       => 'Pays',
                ))
            ->add('dateNaissance', BirthdayType::class, array(
                'label'  => 'Date de naissance',
                'attr'   => array(
                    'placeholder' => 'jj/mm/aaaa',
                    'class'       => 'block-dateNaissance',
                    ),
                'widget' => 'single_text',
                'html5'  => false,
                'format'  => 'dd/MM/yyyy',
                ))
            ->add('tarif_reduit',  CheckboxType::class, array(
                'required' => false
                ));

    }
    
   

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Louvre\BilletterieBundle\Entity\Ticket',
            //'data_class' => null
        ));
    }


}
