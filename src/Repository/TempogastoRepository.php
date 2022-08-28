<?php

namespace App\Repository;

use App\Entity\Tempogasto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Tempogasto>
 *
 * @method Tempogasto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tempogasto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tempogasto[]    findAll()
 * @method Tempogasto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TempogastoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tempogasto::class);
    }

    public function add(Tempogasto $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Tempogasto $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function  findTarefaId()
    {
        //pega a url atual
        $url = $_SERVER["REQUEST_URI"];
        //pega a última parte que é o id
        $end = basename(parse_url($url, PHP_URL_PATH));

        $qb = $this->createQueryBuilder('tg');
        $qb
            ->select(select: 'tg')
            ->join('App\Entity\Tarefa', 't', 'WITH', 'tg.idTarefa = t.id')
            ->where('t.id = :id')
            ->setParameter('id', $end)
        ;
        return $qb->getQuery()->getResult();

    }

//    /**
//     * @return Tempogasto[] Returns an array of Tempogasto objects
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

//    public function findOneBySomeField($value): ?Tempogasto
//    {
//        return $this->createQueryBuilder('t')
//            ->andWhere('t.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
