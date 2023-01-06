<?php

namespace App\Form;

use App\Entity\FichePartenaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class FichePartenaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '30',
                ],
                'label' => 'Titre',
                'label_attr' => [
                    'class' => 'form-label  mt-4',
                ],
                'constraints' => [
                    new Length(['min' => 2, 'max' => 30]),
                ],
            ])
            ->add('description', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'min' => 1,
                    'max' => 5,
                ],
                'label' => 'Description',
                'label_attr' => [
                    'class' => 'form-label mt-4',
                ],
                'constraints' => [
                    new NotBlank(),
                ],
            ])

            ->add('email', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '180',
                ],
                'label' => 'Email',
                'label_attr' => [
                    'class' => 'form-label  mt-4',
                ],
                'constraints' => [
                    new Length(['min' => 2, 'max' => 180]),
                ],
            ])

            ->add('telephone', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '30',
                ],
                'label' => 'Telephone',
                'label_attr' => [
                    'class' => 'form-label  mt-4',
                ],
                'constraints' => [
                    new Length(['min' => 2, 'max' => 30]),
                ],
            ])

            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-primary mt-4',
                ],
                'label' => 'Créer une fiche',
            ])

            ->add('isPublic', CheckboxType::class, [
                'attr' => [
                    'class' => 'form-check-input',
                ],
                'required' => false,
                'label' => 'Publier la fiche ? ',
                'label_attr' => [
                    'class' => 'form-check-label',
                ],
                'constraints' => [
                    new NotNull(),
                ],
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FichePartenaire::class,
        ]);
    }
}
