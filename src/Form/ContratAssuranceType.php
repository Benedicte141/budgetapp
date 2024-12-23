<?php

namespace App\Form;

use App\Entity\CompagnieAssurance;
use App\Entity\ContratAssuranceVie;
use App\Entity\ModeGestion;
use App\Entity\Periodicite;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class ContratAssuranceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('numero')
            ->add('solde')
            ->add('dateOuverture', null, [
                'widget' => 'single_text'
            ])
            ->add('compagnie_assurance', EntityType::class, [
                'class' => CompagnieAssurance::class,
                'choice_label' => 'nom',
            ])
            ->add('mode_gestion', EntityType::class, [
                'class' => ModeGestion::class,
                'choice_label' => 'libelle',
            ])
            ->add('totalInvestit')
            ->add('totalRachete')
            ->add('montantValueLatente')
            ->add('montantVersementLibre')
            ->add('submit', SubmitType::class, [
                'label' => 'Creer',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContratAssuranceVie::class,
        ]);
    }
}
