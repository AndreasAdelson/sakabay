<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Fonction;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;

class FonctionRepository extends AbstractRepository implements FonctionRepositoryInterface
{
    /**
     * FonctionRepository constructor.
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata(Fonction::class));
    }

    public function save(Fonction $fonction): void
    {
        $this->_em->persist($fonction);
        $this->_em->flush($fonction);
    }

    public function delete(Fonction $fonction): void
    {
        $this->_em->remove($fonction);
        $this->_em->flush($fonction);
    }
}
