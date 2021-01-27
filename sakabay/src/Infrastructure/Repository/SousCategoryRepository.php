<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\SousCategory;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;

class SousCategoryRepository extends AbstractRepository implements SousCategoryRepositoryInterface
{

    /**
     * SousCategoryRepository constructor.
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata(SousCategory::class));
    }

    public function save(SousCategory $sousCategory): void
    {
        $this->_em->persist($sousCategory);
        $this->_em->flush($sousCategory);
    }

    public function delete(SousCategory $sousCategory): void
    {
        $this->_em->remove($sousCategory);
        $this->_em->flush($sousCategory);
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
        $category = ''
    ) {
        $qb = $this->createQueryBuilder('sc');
        if (!empty($filterText)) {
            $queryFilter = ' LOWER(sc.'
                . implode(') LIKE LOWER(:searchPattern) OR LOWER(sc.', explode(',', $filterFields))
                . ') LIKE LOWER(:searchPattern)';
            $qb->andWhere($queryFilter);
            $qb->setParameter('searchPattern', '%' . mb_strtolower($filterText) . '%');
        }
        if (!empty($category)) {
            $qb->leftJoin('sc.category', 'category')
                ->andWhere('category.id = :categoryId')
                ->setParameter('categoryId', $category);
        }
        if (!empty($sortBy)) {
            $qb->orderBy('sc.' . $sortBy, $descending ? 'DESC' : 'ASC');
        }

        return $this->paginate($qb, $perPage, $currentPage);
    }
}
