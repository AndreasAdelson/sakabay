<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\User;

/**
 * Interface UserRepositoryInterface.
 */
interface UserRepositoryInterface
{
    public function save(User $user): void;

    public function delete(User $user): void;

}
