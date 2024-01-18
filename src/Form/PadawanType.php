<?php

namespace App\Form;

use App\Entity\Padawan;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PadawanType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')

            ->add('maitre', EntityType::class, [
                'class' => 'App\Entity\Jedi',
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('j')
                        ->leftJoin('j.padawan', 'p')
                        ->where('p IS NULL');
                },
                'choice_label' => 'nom',
                'multiple' => false,
                'expanded' => true,
                'required' => true,
            ])

            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'save'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Padawan::class,
        ]);
    }
}
