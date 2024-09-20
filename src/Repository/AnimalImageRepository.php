<?php

namespace App\Repository;

use App\Entity\AnimalImage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @extends ServiceEntityRepository<AnimalImage>
 */
class AnimalImageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, private PaginatorInterface $paginator)
    {
        parent::__construct($registry, AnimalImage::class);
    }

        /**
         * @return AnimalImage[] Returns an array of Animal objects
         */
        public function paginateAnimalImage(int $page, int $limit): PaginationInterface
        {
            return $this->paginator->paginate(
                $this->createQueryBuilder('a'),
                $page,
                $limit
            );
        }
            /**
             * @return AnimalImage Returns the AnimalImages
             */
            public function NbClickAnimal($value): ?AnimalImage
            {
                return $this->createQueryBuilder('a')
                    ->andWhere('a.animal_id = :val')
                    ->setParameter('val', $value)
                    ->orderBy('a.id', 'ASC')
                    ->getQuery()
                    ->getResult()
                ;
            }
    
        
    //    /**
    //     * @return AnimalImage[] Returns an array of AnimalImage objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?AnimalImage
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
