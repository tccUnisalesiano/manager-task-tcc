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

    public function  findProjetoTarefaUser()
    {
        //pega a url atual
        $url = $_SERVER["REQUEST_URI"];
        //pega a última parte que é o id
        $end = basename(parse_url($url, PHP_URL_PATH));

        $qb = $this->createQueryBuilder('p');
        $qb ->select(select: 'p.nome, t.nome, u.nome')
            ->join('App\Entity\Tarefa', 't', 'WITH', 'p.id = t.id')
            ->where('t.id = :id')
            ->setParameter('id', $end)
        ;
//        select p.id, p.nome, t.id, t.nome, u.id, u.nome
//        from projeto p
//        join tarefa t on p.id = t.id_projeto_id
//        join user u on t.id_user_id = u.id
        return $qb->getQuery()->getResult();

    }

    /**
     * @throws Exception
     */
    public function findAllChart(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
                SELECT p.nome, t.nome, u.nome
                FROM projeto p
                JOIN tarefa t ON p.id = t.id_projeto_id
                JOIN user u ON t.id_user_id = u.id
            ';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }
//
//    /**
//     * @throws Exception
//     */
//    public function updateUser($id, $password): array
//    {
//        $conn = $this->getEntityManager()->getConnection();
//
//        return $this->createQueryBuilder('user u')
//            ->update('u')
//            ->set('u.password =', $password)
//            ->where('u.id =', $id)
//            ->getQuery()
//            ->getResult();
//    }

    /**
     * @throws Exception
     */
    public function findALlProjetos(): array
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

    /**
     * @throws Exception
     */
    public function findALlProjetosAberto(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
            SELECT * FROM projeto p
            WHERE p.situacao = "Aberta"
            ';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }


}
