<?php

namespace App\Application\Service;

use App\Domain\Model\Role;
use App\Infrastructure\Repository\RoleRepositoryInterface;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RoleService
{
    /**
     * @var RoleRepositoryInterface
     */
    private $roleRepository;

    /**
     * RoleRestController constructor.
     */
    public function __construct(RoleRepositoryInterface $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    /// Afficher un Role
    public function getRole(int $roleId): ?Role
    {
        return $this->roleRepository->find($roleId);
    }

    public function getAllRoles(): ?array
    {
        return $this->roleRepository->findAll();
    }

    public function deleteRole(int $roleId): void
    {
        $role = $this->roleRepository->find($roleId);
        if (!$role) {
            throw new EntityNotFoundException('Role with id ' . $roleId . ' does not exist!');
        }
        $this->roleRepository->delete($role);
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
        return $this->roleRepository
            ->getPaginatedList($sortBy, $descending, $filterFields, $filterText, $currentPage, $perPage);
    }
}
