<?php

namespace App\Form;

use App\Entity\Organisme;
use App\Entity\Abonnement;
use App\Entity\TypeAbonnement;
use App\Entity\Periodicite;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class AbonnementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('organisme', EntityType::class, [
                'class' => Organisme::class,
                'choice_label' => 'nom',
            ])
            ->add('type_abonnement', EntityType::class, [
                'class' => TypeAbonnement::class,
                'choice_label' => 'nom',
            ])
            ->add('objet')
            ->add('montant')
            ->add('periodicite', EntityType::class, [
                'class' => Periodicite::class,
                'choice_label' => 'libelle',
            ])
            ->add('numero_client')
            ->add('date_souscription')
            ->add('submit', SubmitType::class, [
                'label' => 'Submit',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Abonnement::class,
        ]);
    }
}
