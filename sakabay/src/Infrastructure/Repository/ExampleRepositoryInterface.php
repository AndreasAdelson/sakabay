<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Example;

/**
 * Interface ExampleRepositoryInterface.
 */
interface ExampleRepositoryInterface
{
    public function save(Example $example): void;

    public function delete(Example $example): void;
}
