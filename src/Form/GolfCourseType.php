<?php

namespace App\Form;

use App\Entity\GolfCourse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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
            ->add('targets', CollectionType::class, [
                'entry_type' => TargetType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
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
