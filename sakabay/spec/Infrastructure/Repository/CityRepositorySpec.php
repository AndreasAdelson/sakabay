<?php

namespace spec\App\Infrastructure\Repository;

use App\Domain\Model\City;
use App\Infrastructure\Repository\CityRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\QueryBuilder;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CityRepositorySpec extends ObjectBehavior
{
    public function let(EntityManagerInterface $em, ClassMetadata $class)
    {
        $this->beConstructedWith($em, $class);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(CityRepository::class);
    }

    /**
     * save($city) test.
     */
    public function it_should_save($em)
    {
        $city = new City();
        $em->persist($city)->willReturn(null);
        $em->flush($city)->willReturn(null);
        $this->save($city);
        $em->persist($city)->shouldBeCalled();
        $em->flush($city)->shouldBeCalled();
    }

    /**
     * delete($city) test.
     */
    public function it_should_delete($em)
    {
        $city = new City();
        $em->remove($city)->willReturn(null);
        $em->flush($city)->willReturn(null);
        $this->delete($city);
        $em->remove($city)->shouldBeCalled();
        $em->flush($city)->shouldBeCalled();
    }

    public function it_should_find_cities_for_autocomplete($em, QueryBuilder $queryBuilder, AbstractQuery $query)
    {
        $searchParameters = [
            'autocomplete' => 'keyword'
        ];

        $em->createQueryBuilder(Argument::any())->willReturn($queryBuilder);
        $queryBuilder->select(Argument::any())->willReturn($queryBuilder);
        $queryBuilder->from(Argument::any(), Argument::any(), Argument::any())->willReturn($queryBuilder);
        $queryBuilder->andWhere(Argument::any())->willReturn($queryBuilder);
        $queryBuilder->setParameter(Argument::any(), Argument::any())->willReturn($queryBuilder);
        $queryBuilder->addOrderBy(Argument::any())->willReturn($queryBuilder);
        $queryBuilder->getQuery()->willReturn($query);
        $query->getResult()->willReturn([]);

        $this->findCitiesForAutocomplete($searchParameters)->shouldReturn([]);
    }
}
