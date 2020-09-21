<?php

namespace App\Application\Service;

use App\Domain\Model\Address;
use App\Infrastructure\Repository\AddressRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AddressService
{
    /**
     * @var AddressRepositoryInterface
     */
    private $addressRepository;

    /**
     * AddressRestController constructor.
     */
    public function __construct(AddressRepositoryInterface $addressRepository)
    {
        $this->addressRepository = $addressRepository;
    }

    /// Afficher un Address
    public function getAddress(int $addressId): ?Address
    {
        return $this->addressRepository->find($addressId);
    }

    public function getAllAddresss(): ?array
    {
        return $this->addressRepository->findAll();
    }

    public function deleteAddress(int $addressId): void
    {
        $address = $this->addressRepository->find($addressId);
        if (!$address) {
            throw new EntityNotFoundException('Address with id ' . $addressId . ' does not exist!');
        }
        $this->addressRepository->delete($address);
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
     *
     * @return Pagerfanta
     */
    public function getPaginatedList(
        $sortBy = 'id',
        $descending = false,
        $filterFields = '',
        $filterText = '',
        $currentPage = 1,
        $perPage = PHP_INT_MAX ? PHP_INT_MAX : 10
    ) {
        return $this->addressRepository
            ->getPaginatedList($sortBy, $descending, $filterFields, $filterText, $currentPage, $perPage);
    }
}
