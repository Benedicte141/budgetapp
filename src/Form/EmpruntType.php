<?php

namespace App\Form;

use App\Entity\Emprunt;
use App\Entity\Banque;
use App\Entity\Periodicite;
use App\Entity\TypeEmprunt;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
class EmpruntType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('objet')
            ->add('banque', EntityType::class, [
                'class' => Banque::class,
                'choice_label' => 'nom',
            ])
            ->add('montant_initial')
            ->add('taux')
            ->add('date_deb', DateType::class, [
                'widget' => 'single_text', // Très utile pour lier le champ à un DateTime
                'html5' => true
            ])
            ->add('duree')
            ->add('periodicite', EntityType::class, [
                'class' => Periodicite::class,
                'choice_label' => 'libelle',
            ])
            ->add('type_emprunt', EntityType::class, [
                'class' => TypeEmprunt::class,
                'choice_label' => 'libelle',
            ])
            ->add('montant_rest_du')
            ->add('montant_echeance')
            ->add('cout_interet')
            
            ->add('submit', SubmitType::class, [
                'label' => 'Submit',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Emprunt::class,
        ]);
    }
}