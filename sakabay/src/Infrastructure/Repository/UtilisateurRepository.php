<?php

// src/Repository/UserRepository.php
namespace App\Infrastructure\Repository;

use App\Domain\Model\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;

/**
 * @method Utilisateur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Utilisateur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Utilisateur[]    findAll()
 * @method Utilisateur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UtilisateurRepository extends AbstractRepository implements UtilisateurRepositoryInterface
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata(Utilisateur::class));
    }

    public function loadUserByUsername($usernameOrEmail)
    {
        return $this->createQuery(
            'SELECT u
                FROM App\Domain\Model\Utilisateur u
                WHERE u.email = :query'
        )
            ->setParameter('query', $usernameOrEmail)
            ->getQuery()
            ->getOneOrNullResult();
    }

    public function save(Utilisateur $utilisateur): void
    {
        $this->_em->persist($utilisateur);
        $this->_em->flush($utilisateur);
    }

    public function delete(Utilisateur $utilisateur): void
    {
        $this->_em->remove($utilisateur);
        $this->_em->flush($utilisateur);
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
