<?php

namespace App\Form;

use App\Entity\Sabre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SabreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('couleur')
            ->add('bi_lame')

            ->add('proprietaire', EntityType::class, [
                'class' => 'App\Entity\UtilisateurForce',
                'choice_label' => 'nom',
                'multiple' => false,
                'expanded' => true,
            ])

            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'save'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Sabre::class,
        ]);
    }
}
