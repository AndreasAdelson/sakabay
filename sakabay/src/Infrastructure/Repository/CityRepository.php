<?php

namespace App\Infrastructure\Repository;

use App\Domain\Model\City;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;

class CityRepository extends AbstractRepository implements CityRepositoryInterface
{

    /**
     * CityRepository constructor.
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct($entityManager, new ClassMetadata(City::class));
    }

    public function save(City $cit): void
    {
        $this->_em->persist($cit);
        $this->_em->flush($cit);
    }

    public function delete(City $cit): void
    {
        $this->_em->remove($cit);
        $this->_em->flush($cit);
    }

    /**
     * Return a list of User matching given criterias.
     *
     * @param string $filter[autocomplete] Name or first name or login of a user
     */
    public function findCitiesForAutocomplete(array $filter): array
    {
        $name = $filter['autocomplete'];
        $name = mb_strtolower("%$name%");
        $queryFilter = "LOWER(city.name) LIKE :name";
        $query = $this->createQueryBuilder('city');

        return $query->andWhere($queryFilter)
            ->setParameter('name', $name)
            ->addOrderBy('city.name')
            ->getQuery()
            ->getResult();
    }
}
