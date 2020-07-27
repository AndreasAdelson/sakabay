<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Fonction;

/**
 * Interface FonctionRepositoryInterface.
 */
interface FonctionRepositoryInterface
{
    public function save(Fonction $fonction): void;

    public function delete(Fonction $fonction): void;
}
