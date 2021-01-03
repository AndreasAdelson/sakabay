<?php

namespace spec\App\Infrastructure\Repository;

use App\Domain\Model\Notification;
use App\Domain\Model\Utilisateur;
use App\Infrastructure\Repository\NotificationRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class NotificationRepositorySpec extends ObjectBehavior
{
    public function let(EntityManagerInterface $em, ClassMetadata $class)
    {
        $this->beConstructedWith($em, $class);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(NotificationRepository::class);
    }

    public function it_should_find_all_for_notifiable_sorted($em, QueryBuilder $queryBuilder, AbstractQuery $query)
    {
        $utilisateur = new Utilisateur();
        $em->createQueryBuilder(Argument::any())->willReturn($queryBuilder);
        $queryBuilder->select(Argument::any(), Argument::any())->willReturn($queryBuilder);
        $queryBuilder->from(Argument::any(), Argument::any())->willReturn($queryBuilder);
        $queryBuilder->join(Argument::any(), Argument::any())->willReturn($queryBuilder);
        $queryBuilder->where(Argument::any())->willReturn($queryBuilder);
        $queryBuilder->setParameter(Argument::any(), Argument::any())->willReturn($queryBuilder);
        $queryBuilder->orderBy(Argument::any(), Argument::any())->willReturn($queryBuilder);
        $queryBuilder->getQuery()->willReturn($query);

        $query->getResult()->willReturn([]);

        $this->findAllForNotifiableSorted(1, $utilisateur)->shouldReturn([]);
    }
}
