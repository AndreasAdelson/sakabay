<?php

namespace App\Infrastructure\Http\Rest\Controller;

use App\Application\Service\ExampleService;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class ExampleController extends AbstractFOSRestController
{
    private $entityManager;
    private $exampleService;

    /**
     * ExampleRestController constructor.
     */
    public function __construct(EntityManagerInterface $entityManager, ExampleService $exampleService)
    {
        $this->entityManager = $entityManager;
        $this->exampleService = $exampleService;
    }

    /**
     * @Rest\View()
     * @Rest\Post("/examples")
     * @param Request $request
     *
     * @return View
     */
    public function createExample(Request $request): View
    {
        $example = $this->exampleService->addExample($request->get('nom'), $request->get('consigne'));
        // $formOptions = ['translator' => $this->translator]

        return View::create($example, Response::HTTP_CREATED);
    }

    /**
     * @Rest\View(serializerGroups={"api_examples"})
     * @Rest\Get("/examples")
     *
     * @return View
     */
    public function getExamples(): View
    {
        $example = $this->exampleService->getAllExamples();

        return View::create($example, Response::HTTP_OK);
    }

    /**
     * @Rest\View(serializerGroups={"api_examples"})
     * @Rest\Get("/examples/{exampleId}")
     *
     * @return View
     */
    public function getExample(int $exampleId): View
    {
        $example = $this->exampleService->getExample($exampleId);

        return View::create($example, Response::HTTP_OK);
    }

    /**
     * @Rest\View()
     * @Rest\Post("/examples/{exampleId}")
     *
     * @return View
     */
    public function editExamples(int $exampleId, Request $request): View
    {
        $example = $this->exampleService->editExample($exampleId, $request->get('nom'), $request->get('consigne'));


        return View::create($example, Response::HTTP_OK);
    }

    /**
     * @Rest\View()
     * @Rest\Delete("/examples/{exampleId}")
     *
     * @return View
     */
    public function deleteExamples(int $exampleId): View
    {
        $example = $this->exampleService->deleteExample($exampleId);

        return View::create($example, Response::HTTP_NO_CONTENT);
    }
}
