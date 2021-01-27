<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\SousCategory;

/**
 * Interface SousCategoryRepositoryInterface.
 */
interface SousCategoryRepositoryInterface
{
    public function save(SousCategory $sousCategory): void;

    public function delete(SousCategory $sousCategory): void;
}
