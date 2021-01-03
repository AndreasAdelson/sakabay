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

    /**
     * Return a list of User matching given criterias.
     *
     * @param string $filter[autocomplete] Name or first name or username of a user
     */
    public function findUsersForAutocomplete(array $filter): array
    {
        $name = $filter['autocomplete'];
        $name = mb_strtolower("%$name%");
        $queryFilter = "LOWER(CONCAT(user.firstName, ' ', user.lastName)) LIKE :name
                        OR LOWER(CONCAT(user.lastName, ' ', user.firstName)) LIKE :name
                        OR LOWER(user.username) LIKE :name";
        $query = $this->createQueryBuilder('user');

        return $query->andWhere($queryFilter)
            ->setParameter('name', $name)
            ->addOrderBy('user.lastName')
            ->addOrderBy('user.firstName')
            ->getQuery()
            ->getResult();
    }

    public function findUsersByRight(array $filter, bool $includeAll = true): array
    {
        $qb = $this->createQueryBuilder('u');

        if ($includeAll) {
            if (!empty($filter['groups'])) {
                $qb->leftJoin('u.groups', 'groups');
                if (is_array($filter['groups'])) {
                    $orStatements = $qb->expr()->orX();
                    foreach ($filter['groups'] as $groupCode) {
                        $orStatements->add(
                            $qb->expr()->like('groups.code', $qb->expr()->literal('%' . $groupCode . '%'))
                        );
                    }
                    $qb->orWhere($orStatements);
                }
            }

            if (!empty($filter['roles'])) {
                if (empty($filter['groups'])) {
                    $qb->leftJoin('u.groups', 'groups');
                }
                $qb->leftJoin('groups.roles', 'roles');
                if (is_array($filter['roles'])) {
                    $orStatements = $qb->expr()->orX();
                    foreach ($filter['roles'] as $roleCode) {
                        $orStatements->add(
                            $qb->expr()->like('roles.code', $qb->expr()->literal('%' . $roleCode . '%'))
                        );
                    }
                    $qb->orWhere($orStatements);
                }
            }

            if (!empty($filter['fonctions'])) {
                if (empty($filter['groups'])) {
                    $qb->leftJoin('u.groups', 'groups');
                }
                if (empty($filter['roles'])) {
                    $qb->leftJoin('groups.roles', 'roles');
                }
                $qb->leftJoin('roles.fonctions', 'fonctions');
                if (is_array($filter['fonctions'])) {
                    $orStatements = $qb->expr()->orX();
                    foreach ($filter['fonctions'] as $fonctionCode) {
                        $orStatements->add(
                            $qb->expr()->like('fonctions.code', $qb->expr()->literal('%' . $fonctionCode . '%'))
                        );
                    }
                    $qb->orWhere($orStatements);
                }
            }
        }
        else
        {
            if (!empty($filter['groups'])) {
                $qb->leftJoin('u.groups', 'groups');
                if (is_array($filter['groups'])) {
                    $orStatements = $qb->expr()->orX();
                    foreach ($filter['groups'] as $groupCode) {
                        $orStatements->add(
                            $qb->expr()->like('groups.code', $qb->expr()->literal('%' . $groupCode . '%'))
                        );
                    }
                    $qb->andWhere($orStatements);
                }
            }

            if (!empty($filter['roles'])) {
                if (empty($filter['groups'])) {
                    $qb->leftJoin('u.groups', 'groups');
                }
                $qb->leftJoin('groups.roles', 'roles');
                if (is_array($filter['roles'])) {
                    $orStatements = $qb->expr()->orX();
                    foreach ($filter['roles'] as $roleCode) {
                        $orStatements->add(
                            $qb->expr()->like('roles.code', $qb->expr()->literal('%' . $roleCode . '%'))
                        );
                    }
                    $qb->andWhere($orStatements);
                }
            }

            if (!empty($filter['fonctions'])) {
                if (empty($filter['groups'])) {
                    $qb->leftJoin('u.groups', 'groups');
                }
                if (empty($filter['roles'])) {
                    $qb->leftJoin('groups.roles', 'roles');
                }
                $qb->leftJoin('roles.fonctions', 'fonctions');
                if (is_array($filter['fonctions'])) {
                    $orStatements = $qb->expr()->orX();
                    foreach ($filter['fonctions'] as $fonctionCode) {
                        $orStatements->add(
                            $qb->expr()->like('fonctions.code', $qb->expr()->literal('%' . $fonctionCode . '%'))
                        );
                    }
                    $qb->andWhere($orStatements);
                }
            }
        }
        $qb->groupBy('u.id');

        return $qb->getQuery()->getResult();
    }
}
