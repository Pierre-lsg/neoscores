<?php

namespace App\Form;

use App\Entity\CompetitionFly;
use App\Entity\Team;
use App\Repository\TeamRepository;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\QueryBuilder as ORMQueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompetitionFlyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $clubId = '9999';

        $builder
            ->add('name')
            ->add('competition')
            ->add('teams', EntityType::class, [
                'class' => Team::class,
                'choice_label' => 'name',
                'multiple' => true,
                'autocomplete' => true,
                'query_builder' => function (TeamRepository $tr) use($clubId) : ORMQueryBuilder {
                    return $tr->createQueryBuilder('t')
                        ->andWhere('t.Club <> :clubId')
                        ->setParameter('clubId', $clubId)
                        ->orderBy('t.name', 'ASC');
                }
            ]) 
            /* ->add('teams', TeamsAutocompleteField::class) */
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CompetitionFly::class,
        ]);
    }
}
