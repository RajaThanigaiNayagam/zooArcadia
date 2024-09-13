<?php

namespace App\Repository;

use App\Entity\RapportEmployee;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @extends ServiceEntityRepository<RapportEmployee>
 */
class RapportEmployeeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, private PaginatorInterface $paginator)
    {
        parent::__construct($registry, RapportEmployee::class);
    }
    /**
     * @return RapportEmployee[] Returns an array of Animal objects
     */
    public function paginateRapportEmployee(int $page, int $limit): PaginationInterface
    {
        return $this->paginator->paginate(
            $this->createQueryBuilder('r'),
            $page,
            $limit
        );
    }

        /**
         * @return RapportEmployee[] Returns an array of Animal objects
         */
        public function paginateRapportDeEmployee(int $page, int $limit, int $ActualUser): PaginationInterface
        {
            return $this->paginator->paginate(
                $this->createQueryBuilder('r')
                ->andWhere('r.user = :val')
                ->setParameter('val', $ActualUser)
                ->orderBy('r.id', 'ASC'),
                $page,
                $limit
            );
        }
        
        /**
         * @return RapportEmployee[] Returns an array of RapportEmployee objects
         */
        public function findByUser($UserId): array
        {
            return $this->createQueryBuilder('r')
                ->andWhere('r.user = :val')
                ->setParameter('val', $UserId)
                ->orderBy('r.id', 'ASC')
                ->setMaxResults(10)
                ->getQuery()
                ->getResult()
            ;
        }

    //    /**
    //     * @return RapportEmployee[] Returns an array of RapportEmployee objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?RapportEmployee
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
