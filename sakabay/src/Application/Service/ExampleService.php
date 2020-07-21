<?php

namespace App\Application\Service;

use App\Domain\Model\Example;
use App\Infrastructure\Repository\ExampleRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExampleService
{
    /**
     * @var ExampleRepositoryInterface
     */
    private $exampleRepository;

    /**
     * ExampleRestController constructor.
     */
    public function __construct(ExampleRepositoryInterface $exampleRepository)
    {
        $this->exampleRepository = $exampleRepository;
    }

    public function addExample(string $nom, string $consigne)
    {
        $example = new Example();
        $example->setNom($nom);
        $example->setConsigne($consigne);
        $this->exampleRepository->save($example);
    }

    public function editExample(string $nom, string $consigne, int $exampleId)
    {
        $example = $this->exampleRepository->findById($exampleId);
        if (!$example) {
            throw new EntityNotFoundException('Example with id ' . $exampleId . ' does not exist!');
        }
        $example->setNom($nom);
        $example->setConsigne($consigne);
        $this->exampleRepository->save($example);

        return $example;
    }

    public function getExample(int $exampleId): ?Example
    {
        return $this->exampleRepository->find($exampleId);
    }

    public function getAllExamples(): ?array
    {
        return $this->exampleRepository->findAll();
    }

    public function deleteExample(int $exampleId): void
    {
        $example = $this->exampleRepository->find($exampleId);
        if (!$example) {
            throw new EntityNotFoundException('Example with id ' . $exampleId . ' does not exist!');
        }
        $this->exampleRepository->delete($example);
    }
}
