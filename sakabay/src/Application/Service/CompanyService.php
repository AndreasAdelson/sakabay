<?php

namespace App\Application\Service;

use App\Domain\Model\Company;
use App\Infrastructure\Repository\CompanyRepositoryInterface;
use DateTime;
use Doctrine\ORM\EntityNotFoundException;

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

    public function getCompanyByUrlName(string $urlName): ?Company
    {
        return $this->companyRepository->findOneBy(['urlName' => $urlName]);
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

    public function isCompanySubscribtionActive(Company $company): bool
    {
        $companySubscriptions = $company->getCompanySubscriptions()->toArray();
        if (!empty($companySubscriptions)) {
            usort($companySubscriptions, function ($a, $b) {
                return ($a->getdtFin()->format('Y-m-d H:i:s') < $b->getDtFin()->format('Y-m-d H:i:s'));
            });
            $now = new DateTime('now');
            $lastDtFinSubscription = $companySubscriptions[0]->getDtfin();
            if ($lastDtFinSubscription > $now) {
                return true;
            }
        }
        return false;
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
     * @param int    $category
     * @param int    $city
     * @param int    $sousCategory
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
        $codeStatut = '',
        $category = '',
        $city = '',
        $sousCategory = ''

    ) {
        return $this->companyRepository
            ->getPaginatedList($sortBy, $descending, $filterFields, $filterText, $currentPage, $perPage, $codeStatut, $category, $city, $sousCategory);
    }

    public function getCompanyByUserId($utilisateur = '')
    {
        return $this->companyRepository->getCompanyByUserId($utilisateur);
    }
}
