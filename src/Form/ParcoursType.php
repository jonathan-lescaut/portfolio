<?php

namespace App\Form;

use App\Entity\Parcours;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ParcoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre_parcours')->add('titre_parcours', TextType::class, [
                'label' => 'Titre'
            ])
            ->add('contenu_parcours')->add('contenu_parcours', TextType::class, [
                'label' => 'Contenu'
            ])
            ->add('date_parcours')->add('date_parcours', TextType::class, [
                'label' => 'Date'
            ])
            ->add('duree_parcours')->add('duree_parcours', TextType::class, [
                'label' => 'Durée'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Parcours::class,
        ]);
    }
}
