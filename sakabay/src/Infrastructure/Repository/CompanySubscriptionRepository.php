<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\CompanySubscription;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;

class CompanySubscriptionRepository extends AbstractRepository implements CompanySubscriptionRepositoryInterface
{

    /**
     * CompanySubscriptionRepository constructor.
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata(CompanySubscription::class));
    }

    public function save(CompanySubscription $companySubscription): void
    {
        $this->_em->persist($companySubscription);
        $this->_em->flush($companySubscription);
    }

    public function delete(CompanySubscription $companySubscription): void
    {
        $this->_em->remove($companySubscription);
        $this->_em->flush($companySubscription);
    }
}
