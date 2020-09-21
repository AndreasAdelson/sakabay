<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\Company;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;

class CompanyRepository extends AbstractRepository implements CompanyRepositoryInterface
{
    /**
     * CompanyRepository constructor.
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata(Company::class));
    }

    public function save(Company $company): void
    {
        $this->_em->persist($company);
        $this->_em->flush($company);
    }

    public function delete(Company $company): void
    {
        $this->_em->remove($company);
        $this->_em->flush($company);
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
     * @throws LogicException
     * @return Pagerfanta
     */
    public function getPaginatedList(
        $sortBy = 'id',
        $descending = false,
        $filterFields = '',
        $filterText = '',
        $currentPage = 1,
        $perPage = PHP_INT_MAX,
        $codeStatut = '',
        $category = ''
    ) {
        $qb = $this->createQueryBuilder('c');
        if (!empty($codeStatut)) {
            $qb->leftJoin('c.companystatut', 'companystatut')
                ->andWhere('companystatut.code = :codeStatut')
                ->setParameter('codeStatut', $codeStatut);
        }
        if (!empty($filterText)) {
            $queryFilter = ' LOWER(c.'
                . implode(') LIKE LOWER(:searchPattern) OR LOWER(c.', explode(',', $filterFields))
                . ') LIKE LOWER(:searchPattern)';
            $qb->andWhere($queryFilter);
            $qb->setParameter('searchPattern', '%' . mb_strtolower($filterText) . '%');
        }
        if (!empty($category)) {
            $qb->leftJoin('c.category', 'category')
                ->andWhere('category.id = :categoryId')
                ->setParameter('categoryId', $category);
        }
        if (!empty($sortBy)) {
            $qb->orderBy('c.' . $sortBy, $descending ? 'DESC' : 'ASC');
        }

        return $this->paginate($qb, $perPage, $currentPage);
    }
}
