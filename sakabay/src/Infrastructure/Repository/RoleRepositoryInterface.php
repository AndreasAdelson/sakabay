<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Role;

/**
 * Interface RoleRepositoryInterface.
 */
interface RoleRepositoryInterface
{
    public function save(Role $role): void;

    public function delete(Role $role): void;
}
