<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Role;

/**
 * Interface RoleRepositoryInterface.
 */
interface RoleRepositoryInterface
{
    public function save(Role $example): void;

    public function delete(Role $example): void;
}
