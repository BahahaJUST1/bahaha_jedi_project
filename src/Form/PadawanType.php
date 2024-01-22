<?php

namespace App\Form;

use App\Entity\Padawan;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\RequestStack;

class PadawanType extends AbstractType
{
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $request = $this->requestStack->getCurrentRequest();
        $idFromUrl = $request->attributes->get('id');

        $builder
            ->add('nom')
            ->add('prenom')

            ->add('maitre', EntityType::class, [
                'class' => 'App\Entity\Jedi',
                'query_builder' => function (EntityRepository $er) use ($idFromUrl) {
                    return $er->createQueryBuilder('j')
                        ->leftJoin('j.padawan', 'p')
                        ->leftJoin('p.maitre', 'm')
                        ->addSelect('p', 'm')
                        ->andWhere('p IS NULL OR p.id = :idFromUrl')
                        ->setParameter('idFromUrl', $idFromUrl);
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
