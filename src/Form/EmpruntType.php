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



class EmpruntType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('montantInitial')
            ->add('montantEcheance')
            ->add('coutInteret')
            ->add('montantRestDu')
            ->add('dateDeb', null, [
                'widget' => 'single_text',
            ])
            ->add('taux')
            ->add('objet')
            ->add('duree')
            ->add('periodicite', EntityType::class, [
                'class' => Periodicite::class,
                'choice_label' => 'id',
            ])
            ->add('typeEmprunt', EntityType::class, [
                'class' => TypeEmprunt::class,
                'choice_label' => 'id',
            ])
            ->add('banque', EntityType::class, [
                'class' => Banque::class,
                'choice_label' => 'id',
            ])
            ->add('enregistrer', SubmitType::class, array('label' => 'Nouvel emprunt'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Emprunt::class,
        ]);
    }
}
