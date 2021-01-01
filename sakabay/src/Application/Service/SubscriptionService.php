<?php

namespace App\Application\Service;

use App\Domain\Model\Subscription;
use App\Infrastructure\Repository\SubscriptionRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class SubscriptionService
{
    /**
     * @var SubscriptionRepositoryInterface
     */
    private $subscriptionRepository;

    /**
     * SubscriptionRestController constructor.
     */
    public function __construct(SubscriptionRepositoryInterface $subscriptionRepository)
    {
        $this->subscriptionRepository = $subscriptionRepository;
    }

    /// Afficher un Subscription
    public function getSubscription(int $subscriptionId): ?Subscription
    {
        return $this->subscriptionRepository->find($subscriptionId);
    }

    public function getAllSubscriptions(): ?array
    {
        return $this->subscriptionRepository->findAll();
    }

    public function setCompanySubscription(): array
    {
        return $this->subscriptionRepository->setCompanySubscription();
    }

    public function getSubscriptionByName(string $name)
    {
        return $this->subscriptionRepository->findOneBy(['name' => $name]);
    }
}
