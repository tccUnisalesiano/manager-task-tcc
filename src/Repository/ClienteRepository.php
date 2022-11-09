<?php

namespace App\Repository;

use App\Entity\Cliente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Classe responsável por realizar a persistencia dos dados referente ao repositório para o cliente, add e remove
 * @author Guilherme Correia
 */
class ClienteRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cliente::class);
    }

    public function add(Cliente $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Cliente $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * @throws Exception
     */
    public function findAllClientes($id): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'select t.nome, u.nome, c.nome_cliente
                from user u
                join tarefa t on u.id = t.id_user_id
                join projeto p on t.id_projeto_id = p.id
                join cliente c on c.id = p.cliente_id_id
                where u.id = :id ';

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    /**
     * @throws Exception
     */
    public function findAllClientesChart(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'select *
                from cliente c
                where 1 = 1 ';

        $stmt = $conn->prepare($sql);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

}