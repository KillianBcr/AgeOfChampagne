<?php

namespace App\Repository;

use App\Entity\FichePartenaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FichePartenaire>
 *
 * @method FichePartenaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method FichePartenaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method FichePartenaire[]    findAll()
 * @method FichePartenaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FichePartenaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FichePartenaire::class);
    }

    public function save(FichePartenaire $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(FichePartenaire $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findPublicFiche(?int $nbFiches): array
    {
        sleep(3);
        $queryBuilder = $this->createQueryBuilder('f')
            ->where('f.isPublic = 1')
            ->orderBy('f.createdAt', 'DESC');

        if (0 !== $nbFiches || null !== $nbFiches) {
            $queryBuilder->setMaxResults($nbFiches);
        }

        return $queryBuilder->getQuery()
            ->getResult();
    }

//    /**
//     * @return FichePartenaire[] Returns an array of FichePartenaire objects
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

//    public function findOneBySomeField($value): ?FichePartenaire
//    {
//        return $this->createQueryBuilder('f')
//            ->andWhere('f.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
