<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\CompanySubscription;

/**
 * Interface CompanySubscriptionRepositoryInterface.
 */
interface CompanySubscriptionRepositoryInterface
{
    public function save(CompanySubscription $subscriptionCompany): void;

    public function delete(CompanySubscription $subscriptionCompany): void;
}
