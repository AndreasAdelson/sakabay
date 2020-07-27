<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Role;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;

class RoleRepository extends AbstractRepository implements RoleRepositoryInterface
{
    /**
     * RoleRepository constructor.
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata(Role::class));
    }

    public function save(Role $role): void
    {
        $this->_em->persist($role);
        $this->_em->flush($role);
    }

    public function delete(Role $role): void
    {
        $this->_em->remove($role);
        $this->_em->flush($role);
    }
}
