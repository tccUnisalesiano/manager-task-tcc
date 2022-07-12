<?php

namespace App\Repository;

use App\Entity\Situacao;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Classe responsável por realizar a persistencia dos dados refernete ao repositorio de situacao
 * @author Guilherme Correia
 */
class SituacaoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Situacao::class);
    }

    public function add(Situacao $situacao, bool $flush = false): void
    {
        $this->getEntityManager()->persist($situacao);

        if ($flush)
        {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Situacao $situacao, bool $flush = false): void
    {
        $this->getEntityManager()->persist($situacao);

        if ($flush)
        {
            $this->getEntityManager()->flush();
        }
    }
}