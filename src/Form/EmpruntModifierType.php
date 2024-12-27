<?php

namespace App\Form;

use App\Entity\Banque;
use App\Entity\Emprunt;
use App\Entity\Periodicite;
use App\Entity\TypeEmprunt;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EmpruntModifierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('objet', TextType::class, array('label' => 'Objet de l\'emprunt', 'disabled' => true))
            ->add('enregistrer', SubmitType::class, array('label' => 'Modifier l\'emprunt'))
            ;
    }

    public function getParent()
    {
        return EmpruntType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Emprunt::class,
        ]);
    }
}