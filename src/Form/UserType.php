<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
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

            ->add('nom', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '30',
                ],
                'label' => 'Nom',
                'label_attr' => [
                    'class' => 'form-label  mt-4',
                ],
                'constraints' => [
                    new Length(['min' => 2, 'max' => 30]),
                ],
            ])
            ->add('prenom', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '30',
                ],
                'label' => 'Prenom',
                'label_attr' => [
                    'class' => 'form-label  mt-4',
                ],
                'constraints' => [
                    new Length(['min' => 2, 'max' => 30]),
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

            ->add('plainPassword', PasswordType::class, [
                'mapped' => false,
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Mot de passe',
                'label_attr' => [
                    'class' => 'form-label  mt-4',
                ],
            ])

            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-lg btn-primary',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
