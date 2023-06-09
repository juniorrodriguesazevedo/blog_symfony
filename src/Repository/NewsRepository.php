<?php

namespace App\Repository;

use App\Entity\News;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<News>
 *
 * @method News|null find($id, $lockMode = null, $lockVersion = null)
 * @method News|null findOneBy(array $criteria, array $orderBy = null)
 * @method News[]    findAll()
 * @method News[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NewsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, private CategoryRepository $categoryRepository)
    {
        parent::__construct($registry, News::class);
    }

    public function save(News $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(News $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findByCategoryName(string $name): array
    {
        $category = $this->categoryRepository->findOneBy(['name' => $name]);

        return $this->findBy(['category' => $category]);
    }

    public function createQueryBuilderByCategoryTitle($value): QueryBuilder
    {
        return $this->createQueryBuilder('n')
            ->join('n.category', 'c')
            ->andWhere('c.name like :val')
            ->setParameter('val', "%$value%")
            ->orderBy('n.id', 'ASC');
    }

    public function findBySearch($value): array
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.title like :val')
            ->setParameter('val', "%$value%")
            ->orderBy('n.id', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function createQueryBuilderBySearch($value): QueryBuilder
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.title like :val')
            ->setParameter('val', "%$value%")
            ->orderBy('n.id', 'ASC');
    }

    //    public function findOneBySomeField($value): ?News
    //    {
    //        return $this->createQueryBuilder('n')
    //            ->andWhere('n.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
