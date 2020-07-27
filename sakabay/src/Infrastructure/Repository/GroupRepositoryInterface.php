<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Group;

/**
 * Interface GroupRepositoryInterface.
 */
interface GroupRepositoryInterface
{
    public function save(Group $group): void;

    public function delete(Group $group): void;
}
