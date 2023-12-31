<?php

namespace App\Repository;

use App\Entity\GlobalParameter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GlobalParameter>
 *
 * @method GlobalParameter|null find($id, $lockMode = null, $lockVersion = null)
 * @method GlobalParameter|null findOneBy(array $criteria, array $orderBy = null)
 * @method GlobalParameter[]    findAll()
 * @method GlobalParameter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GlobalParametersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GlobalParameter::class);
    }

//    /**
//     * @return GlobalParameter[] Returns an array of GlobalParameter objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GlobalParameter
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
