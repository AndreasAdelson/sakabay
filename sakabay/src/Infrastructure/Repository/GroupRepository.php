<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Group;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;

class GroupRepository extends AbstractRepository implements GroupRepositoryInterface
{
    /**
     * GroupRepository constructor.
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata(Group::class));
    }

    public function save(Group $group): void
    {
        $this->_em->persist($group);
        $this->_em->flush($group);
    }

    public function delete(Group $group): void
    {
        $this->_em->remove($group);
        $this->_em->flush($group);
    }
}
