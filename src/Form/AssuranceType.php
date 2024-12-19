<?php

namespace App\Form;

use App\Entity\Compagnie;
use App\Entity\Contrat;
use App\Entity\Periodicite;
use App\Entity\TypeContrat;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AssuranceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date_sous', null, [
                'widget' => 'single_text',
            ])
            ->add('montant')
            ->add('libelle_couverture')
            ->add('num_client')
            ->add('periodicite', EntityType::class, [
                'class' => Periodicite::class,
                'choice_label' => 'id',
            ])
            ->add('compagnie', EntityType::class, [
                'class' => Compagnie::class,
                'choice_label' => 'id',
            ])
            ->add('typeContrat', EntityType::class, [
                'class' => TypeContrat::class,
                'choice_label' => 'id',
            ])
            ->add('enregistrer', SubmitType::class, array('label' => 'Nouveau contrat'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contrat::class,
        ]);
    }
}
