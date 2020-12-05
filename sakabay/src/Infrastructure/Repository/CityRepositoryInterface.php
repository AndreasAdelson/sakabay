<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\City;

/**
 * Interface CityRepositoryInterface.
 */
interface CityRepositoryInterface
{
    public function save(City $city): void;

    public function delete(City $city): void;
}
