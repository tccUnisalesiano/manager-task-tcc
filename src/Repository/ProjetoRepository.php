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

    /**
     * @throws Exception
     */
    public function findALlProjetos($id): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'select p.*
                from user u
                join tarefa t on u.id = t.id_user_id
                join projeto p on p.id = t.id_projeto_id
                where u.id = :id ';

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    /**
     * @throws Exception
     */
    public function findALlProjetosAberto($id): array
    {
        $aberta = 'aberta';
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'select p.*, u.*
                from user u
                join tarefa t on u.id = t.id_user_id
                join projeto p on p.id = t.id_projeto_id
                where u.id = :id and p.situacao = :aberta';

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':aberta', $aberta);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }


}
