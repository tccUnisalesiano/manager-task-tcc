<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\DBAL\Exception;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @extends ServiceEntityRepository<User>
 *
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    public function add(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(User $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof User) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);

        $this->add($user, true);
    }

    /**
     * @throws Exception
     */
    public function findUserByName($email): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT u.id
                FROM user u
                WHERE u.email = :email';

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':email', $email);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

    /**
     * @throws Exception
     */
    public function getIdSessionIndex($email): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'SELECT u.roles, u.id
                FROM user u
                WHERE u.email = :email';

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':email', $email);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAssociative();
    }

    /**
     * @throws Exception
     */
    public function findAllProjectsByUserId($id): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = 'select t.id, t.nome, t.porcentagem, p.nome as nomeProjeto
                from user u
                join tarefa t on u.id = t.id_user_id
                join projeto p on p.id = t.id_projeto_id
                where u.id = :id';

        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $id);
        $resultSet = $stmt->executeQuery();

        return $resultSet->fetchAllAssociative();
    }

//    /**
//     * @throws Exception
//     */
//    public function updateSenha($id, $password): array
//    {
//        $conn = $this->getEntityManager()->getConnection();
//
//        return $this->createQueryBuilder('User u')
//            ->update('u')
//            ->set('u.password =', $password)
//            ->where('u.id =', $id)
//            ->getQuery()
//            ->getResult();
//    }


}
