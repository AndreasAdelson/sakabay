<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Subscription;

/**
 * Interface SubscriptionRepositoryInterface.
 */
interface SubscriptionRepositoryInterface
{
    public function save(Subscription $subscription): void;

    public function delete(Subscription $subscription): void;
}
