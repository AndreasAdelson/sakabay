<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Address;

/**
 * Interface AddressRepositoryInterface.
 */
interface AddressRepositoryInterface
{
    public function save(Address $address): void;

    public function delete(Address $address): void;
}
