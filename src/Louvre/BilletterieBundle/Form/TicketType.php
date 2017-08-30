<?php

namespace Louvre\BilletterieBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TicketType extends AbstractType
{
    

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',           TextType::class)
            ->add('prenom',        TextType::class)
            ->add('pays',          CountryType::class, array(
                'label' => 'Pays'
                ))
            ->add('dateNaissance', BirthdayType::class, array(
                'format' => 'dd-MMM-yyyy'
                ))
            ->add('email',         EmailType::class)
            //Normalement définit par la date de naissance, donc pas forcément besoin d'un ChoiceType
            ->add('tarif',         ChoiceType::class, array(
                'choices' => array('Bébé : Moins de 4 ans' => true, 'Enfant : Entre 4 et 12 ans' => true, 'Normal : Entre 12 et 60 ans' => true, 'Sénior : Plus de 60 ans' => true)
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
