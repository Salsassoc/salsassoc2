<?php

namespace App\Repository;

use App\Entity\FiscalYear;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FiscalYear>
 *
 * @method FiscalYear|null find($id, $lockMode = null, $lockVersion = null)
 * @method FiscalYear|null findOneBy(array $criteria, array $orderBy = null)
 * @method FiscalYear[]    findAll()
 * @method FiscalYear[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FiscalYearRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FiscalYear::class);
    }

    public function save(FiscalYear $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(FiscalYear $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return FiscalYear[] Returns an array of FiscalYear objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('f.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?FiscalYear
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
