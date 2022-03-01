<?php

namespace App\Form;

use App\Entity\Realisation;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RealisationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre_realisation')
            ->add('image_realisation', FileType::class, [
                'label' => 'Image Réalistation',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/*',
                        ],
                        'mimeTypesMessage' => 'Veuillez entrer un format de document
            valide',
                    ])
                ],
            ])
            ->add('resume_realisation', CKEditorType::class, [
                'label' => 'résumé réalisation'
            ])
            ->add('fonctionnalite_realisation', CKEditorType::class, [
                'label' => 'Les fonctionnalités'
            ])
            ->add('site_realistation')->add('site_realistation', TextType::class, [
                'label' => 'Site réalisation'
            ])
            ->add('git_realisation')->add('git_realisation', TextType::class, [
                'label' => 'Git réalisation'
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Realisation::class,
        ]);
    }
}
