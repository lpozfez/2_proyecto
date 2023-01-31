<?php

namespace App\Repository;

use App\Entity\EventoPresentaJuego;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<EventoPresentaJuego>
 *
 * @method EventoPresentaJuego|null find($id, $lockMode = null, $lockVersion = null)
 * @method EventoPresentaJuego|null findOneBy(array $criteria, array $orderBy = null)
 * @method EventoPresentaJuego[]    findAll()
 * @method EventoPresentaJuego[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EventoPresentaJuegoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EventoPresentaJuego::class);
    }

    public function save(EventoPresentaJuego $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(EventoPresentaJuego $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return EventoPresentaJuego[] Returns an array of EventoPresentaJuego objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('e.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?EventoPresentaJuego
//    {
//        return $this->createQueryBuilder('e')
//            ->andWhere('e.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
