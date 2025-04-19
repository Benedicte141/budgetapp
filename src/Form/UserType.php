<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('civilite', ChoiceType::class, [
                'choices' => [
                    'Mme' => 'Mme',
                    'Mr' => 'Mr',
                    'Non renseigné' => 'Non renseigné',
                ],
                'expanded' => true, // Définit si les choix doivent être affichés en liste déroulante (false) ou en boutons radio (true)
                'multiple' => false, // Définit si plusieurs choix sont possibles (false pour un seul choix)
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez choisir votre civilité.',
                    ]),
                ]
            ])
            ->add('nom')
            ->add('prenom')
            ->add('adresse')
            ->add('cp')
            ->add('ville')
            ->add('pays')
            ->add('email', null, [
                'disabled'=>true
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Submit',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
