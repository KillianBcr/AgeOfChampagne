<?php

namespace App\Form;

use App\Entity\Carte;
use App\Entity\Cepage;
use App\Entity\Region;
use App\Repository\CepageRepository;
use App\Repository\RegionRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CarteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
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
            ->add('qrCode', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'minlenght' => '2',
                    'maxlenght' => '180',
                ],
                'label' => 'Qr code',
                'label_attr' => [
                    'class' => 'form-label  mt-4',
                ],
                'constraints' => [
                    new Length(['min' => 2, 'max' => 180]),
                ],
            ])

            ->add('imageFile', VichImageType::class, [
                'attr' => [
                    'class' => 'form-label',
                ],
                'label' => 'Image',
                'label_attr' => [
                    'class' => 'form-label',
                ],
            ])

            ->add('cepage', EntityType::class, [
                'class' => Cepage::class,
                'query_builder' => function (CepageRepository $r) {
                    return $r->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                },
                'label' => 'Cépages',
                'label_attr' => [
                    'class' => 'form-label mt-4'
                ],
                'choice_label' => 'name',
            ])

            ->add('region', EntityType::class, [
                'class' => Region::class,
                'query_builder' => function (RegionRepository $r) {
                    return $r->createQueryBuilder('c')
                        ->orderBy('c.nom', 'ASC');
                },
                'label' => 'Regions',
                'label_attr' => [
                    'class' => 'mb-3'
                ],
                'choice_label' => 'nom',
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
            'data_class' => Carte::class,
        ]);
    }
}
