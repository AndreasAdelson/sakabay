<?php

namespace App\Infrastructure\Http\Rest\Controller;

use App\Application\Service\SubscriptionService;
use App\Domain\Model\Subscription;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

final class SubscriptionController extends AbstractFOSRestController
{
    private $subscriptionService;

    /**
     * SubscriptionRestController constructor.
     */
    public function __construct(SubscriptionService $subscriptionService)
    {
        $this->subscriptionService = $subscriptionService;
    }

    /**
     * @Rest\View(serializerGroups={"api_subscriptions"})
     * @Rest\Get("subscribe/{subscriptionId}")
     *
     * @return View
     */
    public function getSubscription(int $subscriptionId): View
    {
        $subscription = $this->subscriptionService->getSubscription($subscriptionId);

        return View::create($subscription, Response::HTTP_OK);
    }

    /**
     * @Rest\View(serializerGroups={"api_subscriptions"})
     * @Rest\Get("/subscribes")
     *
     * @return View
     */
    public function getSubscriptions(): View
    {
        $subscription = $this->subscriptionService->getAllSubscriptions();
        return View::create($subscription, Response::HTTP_OK);
    }
    /**
     * @Rest\View(serializerGroups={"api_subscriptions"})
     * @Rest\Get("/subscribes/{slug}")
     *
     * @return View
     */
    public function getSubscriptionByName(string $slug): View
    {
        $subscription = $this->subscriptionService->getSubscriptionByName($slug);
        return View::create($subscription, Response::HTTP_OK);
    }
}
