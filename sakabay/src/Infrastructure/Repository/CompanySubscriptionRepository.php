<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\SubscriptionCompany;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;

class SubscriptionCompanyRepository extends AbstractRepository implements SubscriptionCompanyRepositoryInterface
{

    /**
     * SubscriptionCompanyRepository constructor.
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata(SubscriptionCompany::class));
    }

    public function save(SubscriptionCompany $subscriptionCompany): void
    {
        $this->_em->persist($subscriptionCompany);
        $this->_em->flush($subscriptionCompany);
    }

    public function delete(SubscriptionCompany $subscriptionCompany): void
    {
        $this->_em->remove($subscriptionCompany);
        $this->_em->flush($subscriptionCompany);
    }
}
