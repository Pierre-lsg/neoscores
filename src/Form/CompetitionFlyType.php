<?php

namespace App\Form;

use App\Entity\CompetitionFly;
use App\Entity\Member;
use App\Entity\Team;
use App\Repository\MemberRepository;
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

        //$compIsIndividual = ($options['data'])->getCompetition()->isIsIndividual();
        $compIsIndividual = true;

        $builder
            ->add('name')
            ->add('competition')
            ;

        if (!$compIsIndividual)
        {
            $builder->add('teams', EntityType::class, [
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
            ]); 
        }
        else
        {
            $builder->add('players', EntityType::class, [
                'class' => Member::class,
                'choice_label' => 'firstName',
                'multiple' => true,
                'autocomplete' => true,
                'query_builder' => function (MemberRepository $mr) use($clubId) : ORMQueryBuilder {
                    return $mr->createQueryBuilder('m')
                        ->andWhere('m.club <> :clubId')
                        ->setParameter('clubId', $clubId)
                        ->orderBy('m.firstName', 'ASC');
                }
            ]);
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => CompetitionFly::class,
        ]);
    }
}
