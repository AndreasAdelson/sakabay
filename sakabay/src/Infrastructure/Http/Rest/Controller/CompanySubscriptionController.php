<?php

namespace App\Infrastructure\Http\Rest\Controller;

use App\Application\Form\Type\CompanySubscriptionType;
use App\Application\Service\CompanySubscriptionService;
use App\Domain\Model\CompanySubscription;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface;

final class CompanySubscriptionController extends AbstractFOSRestController
{
    private $entityManager;
    private $companySubscriptionService;
    private $translator;
    /**
     * CompanySubscriptionRestController constructor.
     */
    public function __construct(
        CompanySubscriptionService $companySubscriptionService,
        TranslatorInterface $translator,
        EntityManagerInterface $entityManager
    ) {
        $this->companySubscriptionService = $companySubscriptionService;
        $this->translator = $translator;
        $this->entityManager = $entityManager;
    }

    /**
     * @Rest\View(serializerGroups={"api_company_subscriptions"})
     * @Rest\Get("subscribe/{companySubscriptionId}")
     *
     * @return View
     */
    public function getCompanySubscription(int $companySubscriptionId): View
    {
        $companySubscription = $this->companySubscriptionService->getCompanySubscription($companySubscriptionId);

        return View::create($companySubscription, Response::HTTP_OK);
    }

    // /**
    //  * @Rest\View(serializerGroups={"api_company_subscriptions"})
    //  * @Rest\Get("/follows")
    //  *
    //  * @return View
    //  */
    // public function getCompanySubscriptions(): View
    // {
    //     $companySubscription = $this->companySubscriptionService->getAllCompanySubscriptions();
    //     return View::create($companySubscription, Response::HTTP_OK);
    // }

    /**
     * @Rest\View()
     * @Rest\Post("/subscribes")
     * @param Request $request
     *
     * @return View
     */
    public function createCompanySubscription(Request $request)
    {

        $companySubscription = new CompanySubscription();
        $formOptions = ['translator' => $this->translator];
        $form = $this->createForm(CompanySubscriptionType::class, $companySubscription, $formOptions);
        $form->submit($request->request->all());
        if (!$form->isValid()) {
            return $form;
        }

        $this->entityManager->persist($companySubscription);
        $this->entityManager->flush();

        $ressourceLocation = $this->generateUrl('dashboard');

        return View::create([], Response::HTTP_CREATED, ['Location' => $ressourceLocation]);
    }

    /**
     * @Rest\View()
     * @Rest\Post("/subscribes/{slug}")
     * @param Request $request
     *
     * @return View
     */
    public function createCompanySubscriptionByname(string $slug, Request $request): View
    {

        $companySubscription = new CompanySubscription();

        $setcompanySubscription = $this->companySubscriptionService->createCompanySubscriptionByname($slug);


        $companySubscription = $setcompanySubscription;
        $formOptions = ['translator' => $this->translator];
        $form = $this->createForm(CompanySubscriptionType::class, $companySubscription, $formOptions);
        $form->submit($request->request->all());
        if (!$form->isValid()) {
            return $form;
        }

        $this->entityManager->persist($companySubscription);
        $this->entityManager->flush();

        $ressourceLocation = $this->generateUrl('dashboard');

        return View::create([], Response::HTTP_CREATED, ['Location' => $ressourceLocation]);
        // return View::create($subscription, Response::HTTP_OK);
    }
}
