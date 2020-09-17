<?php

namespace App\Application\Service;

use App\Domain\Model\Company;
use App\Infrastructure\Repository\CompanyRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CompanyService
{
    /**
     * @var CompanyRepositoryInterface
     */
    private $companyRepository;

    /**
     * CompanyRestController constructor.
     */
    public function __construct(CompanyRepositoryInterface $companyRepository)
    {
        $this->companyRepository = $companyRepository;
    }


    /// Afficher un Company
    public function getCompany(int $companyId): ?Company
    {
        return $this->companyRepository->find($companyId);
    }

    public function getAllCompanys(): ?array
    {
        return $this->companyRepository->findAll();
    }

    public function deleteCompany(int $companyId): void
    {
        $company = $this->companyRepository->find($companyId);
        if (!$company) {
            throw new EntityNotFoundException('Company with id ' . $companyId . ' does not exist!');
        }
        $this->companyRepository->delete($company);
    }

    /**
     * Retourne une page, potentiellement triée et filtrée.
     *
     *
     * @param string $sortBy
     * @param bool   $descending
     * @param string $filterFields
     * @param string $filterText
     * @param int    $currentPage
     * @param int    $perPage
     *
     * @return Pagerfanta
     */
    public function getPaginatedList(
        $sortBy = 'id',
        $descending = false,
        $filterFields = '',
        $filterText = '',
        $currentPage = 1,
        $perPage = PHP_INT_MAX ? PHP_INT_MAX : 10,
        $codeStatut = ''
    ) {
        return $this->companyRepository
            ->getPaginatedList($sortBy, $descending, $filterFields, $filterText, $currentPage, $perPage, $codeStatut);
    }
}
