<?php

namespace App\Repository;

use App\Entity\User;
use App\Entity\Valorfuncionario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Valorfuncionario>
 *
 * @method Valorfuncionario|null find($id, $lockMode = null, $lockVersion = null)
 * @method Valorfuncionario|null findOneBy(array $criteria, array $orderBy = null)
 * @method Valorfuncionario[]    findAll()
 * @method Valorfuncionario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ValorfuncionarioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Valorfuncionario::class);
    }

    public function add(Valorfuncionario $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Valorfuncionario $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function  findFuncionarioId()
    {
        //pega a url atual
        $url = $_SERVER["REQUEST_URI"];
        //pega a última parte que é o id
        $end = basename(parse_url($url, PHP_URL_PATH));

        $qb = $this->createQueryBuilder('v');
        $qb
            ->select(select: 'v')
            ->join('App\Entity\User', 'u', 'WITH', 'v.idUser = u.id')
            ->where('u.id = :id')
            ->setParameter('id', $end)
            ;
        return $qb->getQuery()->getResult();

    }

}
