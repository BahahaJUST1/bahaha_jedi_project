<?php

namespace App\Form;
 
use App\Entity\Guerre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
 
class GuerreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('planete', TextType::class, [
                'label' => 'planet',
            ])
            ->add('save', SubmitType::class, [
                'attr' => ['class' => 'save'],
            ])
            ;
    }
    
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Guerre::class,
        ]);
    }
}