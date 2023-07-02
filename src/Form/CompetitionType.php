<?php

namespace App\Form;

use App\Entity\Championship;
use App\Entity\Competition;
use App\Entity\GolfCourse;
use App\Repository\GolfCourseRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class CompetitionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('competitionAt', DateType::class, [
                'label' => 'Begin',
                'widget' => 'single_text',
                ])
            ->add('publishingScoresAt', DateType::class, [
                'label' => 'Publication',
                'widget' => 'single_text',
                ])
            ->add('championship', EntityType::class, [
                'class' => Championship::class,
                'disabled' => true,
                ])
// Todo : list restrictions of the 'golf course' list
                ->add('golfCourse', EntityType::class, [
                'class' => GolfCourse::class,
/*                'query_builder' => function (GolfCourseRepository $gcr): QueryBuilder {
                    return $gcr ->createQueryBuilder('g')
                                ->andWhere('g.spot_id = 1')
                        ;
                    },*/
            
                ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Competition::class,
        ]);
    }
}
