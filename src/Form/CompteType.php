<?php

namespace App\Form;

use App\Entity\Banque;
use App\Entity\Compte;
use App\Entity\TypeCompte;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class CompteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numero')
            ->add('nom')
            ->add('solde')
            ->add('banque', EntityType::class, [
                'class' => Banque::class,
                'choice_label' => 'nom',
            ])
            ->add('type_compte', EntityType::class, [
                'class' => TypeCompte::class,
                'choice_label' => 'libelle',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'modifier',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Compte::class,
        ]);
    }
}
