<?php

namespace App\Infrastructure\Repository;

use App\Application\Utils\KeywordTrait;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use \LogicException;

abstract class AbstractRepository extends EntityRepository
{
    use KeywordTrait;

    /**
     * Retourne une page, potentiellement triée et filtrée.
     *
     * @author vbioret
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
        $perPage = PHP_INT_MAX
    ) {
        $qb = $this->createQueryBuilder('o');
        if (!empty($filterText)) {
            $queryFilter = ' LOWER(o.'
                . implode(') LIKE LOWER(:searchPattern) OR LOWER(o.', explode(',', $filterFields))
                . ') LIKE LOWER(:searchPattern)';
            $qb->where($queryFilter);
            $qb->setParameter('searchPattern', '%' . mb_strtolower($filterText) . '%');
        }
        if (!empty($sortBy)) {
            //Faut revoir quesque ça fait rée
            // if (false !== mb_strpos($sortBy, '.')) {
            //     $qb->leftJoin('o.' . mb_substr($sortBy, 0, mb_strpos($sortBy, '.')), 'utilisateur');
            //     $qb->orderBy('utilisateur.' . mb_substr($sortBy, mb_strpos($sortBy, '.') + 1, mb_strlen($sortBy) - mb_strpos($sortBy, '.') + 1), $descending ? 'DESC' : 'ASC');
            // } else {
            $qb->orderBy('o.' . $sortBy, $descending ? 'DESC' : 'ASC');
            // }
        }

        return $this->paginate($qb, $perPage, $currentPage);
    }

    /**
     * Retourne une page en fonction d'une requète, d'une taille et d'une position.
     *
     * @author vbioret
     *
     * @param int $perPage
     * @param int $currentPage
     *
     * @throws LogicException
     * @return Pagerfanta
     */
    public function paginate(QueryBuilder $qb, $perPage, $currentPage)
    {
        $perPage = (int) $perPage;
        if (0 >= $perPage) {
            throw new \LogicException('$perPage must be greater than 0.');
        }
        if (0 >= $currentPage) {
            throw new \LogicException('$currentPage must be greater than 0.');
        }
        $pager = new Pagerfanta(new DoctrineORMAdapter($qb));
        $pager->setMaxPerPage((int) $perPage);
        $pager->setCurrentPage((int) $currentPage);

        return $pager;
    }
}
