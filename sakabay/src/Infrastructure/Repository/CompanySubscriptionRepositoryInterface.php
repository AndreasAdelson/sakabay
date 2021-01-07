<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\CompanySubscription;

/**
 * Interface CompanySubscriptionRepositoryInterface.
 */
interface CompanySubscriptionRepositoryInterface
{
    public function save(CompanySubscription $companySubscription): void;

    public function delete(CompanySubscription $companySubscription): void;
}
