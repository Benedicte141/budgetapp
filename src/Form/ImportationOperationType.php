<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Entity\Compte;

use Symfony\Component\Validator\Constraints\Callback;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class ImportationOperationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('json', TextareaType::class, [
            'constraints' => [
                new NotBlank([
                    'message' => 'Veuillez insérer un texte JSON',
                ]),
                new Callback([
                    'callback' => function ($value, ExecutionContextInterface $context) {
                        if (!self::isValidJson($value)) {
                            $context->buildViolation('Le contenu doit être un JSON valide.')
                                ->addViolation();
                        }
                    },
                ]),
            ],
        ])
        ->add('comptes', EntityType::class, [
            'class' => Compte::class,
            'choice_label' => 'nom',
        ])
        ->add('submit', SubmitType::class, [
            'label' => 'Importer',
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }


    private static function isValidJson(?string $json): bool
    {
        if (null === $json || '' === $json) {
            return false;
        }

        json_decode($json);
        return json_last_error() === JSON_ERROR_NONE;
    }
}
