<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotNull;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sender', TextType::class, [
                'attr' => [
                    'class' => 'formEntry',
                ],
                'label' => 'Pseudo',
                'label_attr' => [
                    'class' => 'textform',
                ],
                'constraints' => [
                    new Length(['max' => 30]),
                ],
                'required' => false,
            ])
            ->add('content', TextType::class, [
                'attr' => [
                    'class' => 'formEntry',
                ],
                'label' => 'Commentaire',
                'label_attr' => [
                    'class' => 'textform',
                ],
                'constraints' => [
                    new Length(['min' => 5, 'max' => 255]),
                ],
            ])
            ->add('Envoyer', SubmitType::class, [
                'attr' => [
                    'class' => 'send',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
