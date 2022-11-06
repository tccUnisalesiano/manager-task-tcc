<?php

namespace App\Repository;

use App\Entity\Tarefa;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tarefa>
 *
 * @method Tarefa|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tarefa|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tarefa[]    findAll()
 * @method Tarefa[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TarefaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tarefa::class);
    }

    public function add(Tarefa $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Tarefa $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @throws Exception
     */
    public function findAllTarefas($id): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'select u.*, t.*
                from user u
                join tarefa t on u.id = t.id_user_id
                where u.id = :id';

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

//    /**
//     * @return Tarefa[] Returns an array of Tarefa objects
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

//    public function findOneBySomeField($value): ?Tarefa
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
