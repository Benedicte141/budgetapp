<?php

namespace App\Form;

use App\Entity\Compagnie;
use App\Entity\Contrat;
use App\Entity\Periodicite;
use App\Entity\TypeContrat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class ContratType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle_couverture')
            ->add('montant')
            ->add('num_client')
            ->add('date_sous', null, [
                'widget' => 'single_text'
            ])
            ->add('compagnie', EntityType::class, [
                'class' => Compagnie::class,
                'choice_label' => 'libelle',
            ])
            ->add('periodicite', EntityType::class, [
                'class' => Periodicite::class,
                'choice_label' => 'libelle',
            ])
            ->add('typeContrat', EntityType::class, [
                'class' => TypeContrat::class,
                'choice_label' => 'libelle',
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Submit',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contrat::class,
        ]);
    }
}
