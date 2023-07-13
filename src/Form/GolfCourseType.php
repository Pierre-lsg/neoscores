<?php

namespace App\Form;

use App\Entity\GolfCourse;
use App\Entity\Target;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GolfCourseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('numberOfTargets')
            ->add('isCompleted', CheckboxType::class, [
                    'disabled' => true,
                ])
            ->add('targets', EntityType::class, [
                'class' => Target::class,
                'multiple' => true,
                'query_builder' => function (EntityRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('t')
                        ->andWhere('t.spot = 1')
                        ->orderBy('t.name', 'ASC');
                }
                ])
            ->add('spot')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GolfCourse::class,
        ]);
    }
}
