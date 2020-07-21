<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Example;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;

class ExampleRepository extends AbstractRepository implements ExampleRepositoryInterface
{
    /**
     * ExampleRepository constructor.
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata(Example::class));
    }

    public function save(Example $example): void
    {
        $this->_em->persist($example);
        $this->_em->flush($example);
    }

    public function delete(Example $example): void
    {
        $this->_em->remove($example);
        $this->_em->flush($example);
    }
}
