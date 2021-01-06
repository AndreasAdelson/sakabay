<?php

namespace App\Application\Service;

use App\Domain\Model\CompanySubscription;
use App\Infrastructure\Repository\CompanySubscriptionRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CompanySubscriptionService
{
    /**
     * @var CompanySubscriptionRepositoryInterface
     */
    private $companySubscriptionRepository;

    /**
     * CompanySubscriptionRestController constructor.
     */
    public function __construct(CompanySubscriptionRepositoryInterface $companySubscriptionRepository)
    {
        $this->companySubscriptionRepository = $companySubscriptionRepository;
    }

    /// Afficher un CompanySubscription
    public function getCompanySubscription(int $companySubscriptionId): ?CompanySubscription
    {
        return $this->companySubscriptionRepository->find($companySubscriptionId);
    }

    public function getAllCompanySubscriptions(): ?array
    {
        return $this->companySubscriptionRepository->findAll();
    }

    public function createCompanySubscriptionByname(string $name): array
    {
        return $this->subscriptionRepository->createCompanySubscriptionByname($name);
    }

    // ///Editer un Category
    // public function editCompanySubscription(string $dtFin, string $dtDebut, int $companySubscriptionId)
    // {
    //     $companySubscription = $this->companySubscriptionRepository->findById($companySubscriptionId);
    //     $companySubscription->setDtFin($dtFin);
    //     $companySubscription->setDtDebut($dtDebut);

    //     return $companySubscription;
    // }

    // public function getCompanySubscriptionById(int $companySubscriptionId)
    // {
    //     return $this->subscriptionRepository->findById($companySubscriptionId);
    // }
}
