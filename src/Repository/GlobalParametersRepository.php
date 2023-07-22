<?php

namespace App\Repository;

use App\Entity\GlobalParameters;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GlobalParameters>
 *
 * @method GlobalParameters|null find($id, $lockMode = null, $lockVersion = null)
 * @method GlobalParameters|null findOneBy(array $criteria, array $orderBy = null)
 * @method GlobalParameters[]    findAll()
 * @method GlobalParameters[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GlobalParametersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GlobalParameters::class);
    }

//    /**
//     * @return GlobalParameters[] Returns an array of GlobalParameters objects
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

//    public function findOneBySomeField($value): ?GlobalParameters
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
