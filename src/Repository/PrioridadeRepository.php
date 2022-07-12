<?php

namespace App\Repository;

use App\Entity\Prioridade;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * Classe responsável por realizar a persistencia dos dados referente ao repositório para prioridades
 * @author Guilherme Correia
 */
class PrioridadeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Prioridade::class);
    }

    public function add(Prioridade $prioridade, bool $flush = false): void
    {
        $this->getEntityManager()->persist($prioridade);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Prioridade $prioridade, bool $flush = false): void
    {
        $this->getEntityManager()->persist($prioridade);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }
}