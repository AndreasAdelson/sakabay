<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\CompanyStatut;

/**
 * Interface CompanyStatutRepositoryInterface.
 */
interface CompanyStatutRepositoryInterface
{
    public function save(CompanyStatut $companyStatut): void;

    public function delete(CompanyStatut $companyStatut): void;
}
