<?php

namespace App\Repository;

use App\Entity\Projeto;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Classe responsável por realizar a persistencia dos dados referente ao repositório para o projeto
 * @author Guilherme Correia
 *
 * @extends ServiceEntityRepository<Projeto>
 * @method Projeto|null find($id, $lockMode = null, $lockVersion = null)
 * @method Projeto|null findOneBy(array $criteria, array $orderBy = null)
 * @method Projeto[]    findAll()
 * @method Projeto[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProjetoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Projeto::class);
    }

    public function add(Projeto $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Projeto $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function findProdutos() {
        $qb = $this->createQueryBuilder('p')
                   ->addOrderBy('p.nome', 'ASC');
        $query = $qb->getQuery();
//        var_dump($query->getDQL());
//        die;
        return $query->execute();
    }

    /**
     * @throws Exception
     */
    public function findALlProdutos(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT * FROM projeto p
            WHERE 1 = 1
            ORDER BY p.id ASC
            ';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

//    /**
//     * @return Projeto[] Returns an array of Projeto objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Projeto
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
