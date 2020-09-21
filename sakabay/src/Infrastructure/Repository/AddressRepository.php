<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Address;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;

class AddressRepository extends AbstractRepository implements AddressRepositoryInterface
{

    /**
     * AddressRepository constructor.
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata(Address::class));
    }

    public function save(Address $address): void
    {
        $this->_em->persist($address);
        $this->_em->flush($address);
    }

    public function delete(Address $address): void
    {
        $this->_em->remove($address);
        $this->_em->flush($address);
    }
}
