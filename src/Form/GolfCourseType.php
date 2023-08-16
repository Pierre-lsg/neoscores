<?php

namespace App\Form;

use App\Entity\GolfCourse;
use App\Entity\Target;
use App\Repository\TargetRepository;
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
        // Get golf course to update
        $gc = ($options['data']);

//        $spotId = $gc->getSpot()->getId();

        $builder
            ->add('name')
            ->add('numberOfTargets')
            ->add('spot')
            ->add('targets')
/*             ->add('targets', EntityType::class, [
                'class' => Target::class,
                'multiple' => true,
                'query_builder' => function (TargetRepository $tr) use($spotId) : QueryBuilder {
                    return $tr->createQueryBuilder('t')
                        ->andWhere('t.spot = :spot')
                        ->setParameter('spot', $spotId)
                        ->orderBy('t.name', 'ASC');
                }
                ]) */
            ->add('isCompleted', CheckboxType::class, [
                'disabled' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => GolfCourse::class,
        ]);
    }
}
