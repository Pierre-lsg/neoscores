<?php

namespace App\Form;

use App\Entity\Member;
use App\Entity\Team;
use App\Repository\TeamRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MemberType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $clubId = ($options['data'])->getClub()->getId();

        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('nickName')
            ->add('club')
            ->add('team', EntityType::class, [
                'class' => Team::class,
                'placeholder' => '',
                'required' => false,
                'query_builder' => function (TeamRepository $tr) use($clubId) : QueryBuilder {
                    return $tr->createQueryBuilder('t')
                        ->andWhere('t.Club = :club')
                        ->setParameter('club', $clubId)
                        ->orderBy('t.name', 'ASC')
                        ;
                }
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Member::class,
        ]);
    }
}
