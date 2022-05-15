<?php

namespace App\Repository;

use App\Entity\Task;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Task>
 *
 * @method Task|null find($id, $lockMode = null, $lockVersion = null)
 * @method Task|null findOneBy(array $criteria, array $orderBy = null)
 * @method Task[]    findAll()
 * @method Task[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TaskRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Task::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Task $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(Task $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    public function filter_by_month($month, $developer) {
        return $this->createQueryBuilder('t')
        ->andWhere('t.date LIKE :date')
        ->setParameter('date', $month.'-%')
        ->andWhere('t.developer = :developer')
        ->setParameter('developer', $developer)
        ->getQuery()
        ->getResult();
    }

    public function filter_by_client($client, $developer) {
        return $this->createQueryBuilder('t')
        ->andWhere('t.client = :client')
        ->setParameter('client', $client)
        ->andWhere('t.developer = :developer')
        ->setParameter('developer', $developer)
        ->getQuery()
        ->getResult();
    }

    public function filter_by_month_and_client($month, $client, $developer) {
        return $this->createQueryBuilder('t')
        ->andWhere('t.date LIKE :date')
        ->setParameter('date', $month.'-%')
        ->andWhere('t.client = :client')
        ->setParameter('client', $client)
        ->andWhere('t.developer = :developer')
        ->setParameter('developer', $developer)
        ->getQuery()
        ->getResult();
    }

    public function filter_by_month_and_developer($month, $developer, $client) {
        return $this->createQueryBuilder('t')
        ->andWhere('t.date LIKE :date')
        ->setParameter('date', $month.'-%')
        ->andWhere('t.developer = :developer')
        ->setParameter('developer', $developer)
        ->andWhere('t.client = :client')
        ->setParameter('client', $client)
        ->getQuery()
        ->getResult();
    }

//    /**
//     * @return Task[] Returns an array of Task objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('t.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Task
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
