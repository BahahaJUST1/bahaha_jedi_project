<?php

namespace App\Form;

use App\Entity\Jedi;
use App\Enum\Status;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class JediType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('status', ChoiceType::class, [
                'choices' => Status::toArray(),
                'placeholder' => 'Choisissez un status',
                'label' => 'Statut',
            ])
            ->add('image')

            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'save'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Jedi::class,
        ]);
    }
}
