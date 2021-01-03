<?php

namespace spec\App\Infrastructure\Repository;

use App\Domain\Model\Utilisateur;
use App\Infrastructure\Repository\UtilisateurRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use Doctrine\ORM\Query\Expr;
use Doctrine\ORM\Query\Expr\Base;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UtilisateurRepositorySpec extends ObjectBehavior
{
    public function let(EntityManagerInterface $em, ClassMetadata $class)
    {
        $this->beConstructedWith($em, $class);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(UtilisateurRepository::class);
    }

    /**
     * save($utilisateur) test.
     */
    public function it_should_save($em)
    {
        $utilisateur = new Utilisateur();
        $em->persist($utilisateur)->willReturn(null);
        $em->flush($utilisateur)->willReturn(null);
        $this->save($utilisateur);
        $em->persist($utilisateur)->shouldBeCalled();
        $em->flush($utilisateur)->shouldBeCalled();
    }

    /**
     * delete($utilisateur) test.
     */
    public function it_should_delete($em)
    {
        $utilisateur = new Utilisateur();
        $em->remove($utilisateur)->willReturn(null);
        $em->flush($utilisateur)->willReturn(null);
        $this->delete($utilisateur);
        $em->remove($utilisateur)->shouldBeCalled();
        $em->flush($utilisateur)->shouldBeCalled();
    }

    public function it_should_find_user_for_autocomplete($em, QueryBuilder $queryBuilder, AbstractQuery $query)
    {
        $em->createQueryBuilder(Argument::any())->willReturn($queryBuilder);
        $queryBuilder->select(Argument::any())->willReturn($queryBuilder);
        $queryBuilder->from(Argument::any(), Argument::any(), Argument::any())->willReturn($queryBuilder);
        $queryBuilder->andWhere(Argument::any())->willReturn($queryBuilder);
        $queryBuilder->setParameter(Argument::any(), Argument::any())->willReturn($queryBuilder);
        $queryBuilder->addOrderBy(Argument::any())->willReturn($queryBuilder);
        $queryBuilder->getQuery()->willReturn($query);

        $query->getResult()->willReturn([]);

        $this->findUsersForAutocomplete(['autocomplete' => 'name'])->shouldReturn([]);
    }

    public function it_should_find_users_by_right_include_true($em, QueryBuilder $queryBuilder, AbstractQuery $query, Expr $expr, Base $base)
    {
        $em->createQueryBuilder(Argument::any())->willReturn($queryBuilder);
        $queryBuilder->select(Argument::any())->willReturn($queryBuilder);
        $queryBuilder->from(Argument::any(), Argument::any(), Argument::any())->willReturn($queryBuilder);
        $queryBuilder->leftJoin(Argument::any(), Argument::any())->willReturn($queryBuilder);
        $queryBuilder->expr()->willReturn($expr);
        $expr->orX()->willReturn($base);
        $base->add(Argument::any())->shouldBeCalled();
        $expr->like(Argument::any(), Argument::any())->shouldBeCalled();
        $expr->literal(Argument::any())->shouldBeCalled();
        $queryBuilder->orWhere(Argument::any())->willReturn($queryBuilder);
        $queryBuilder->groupBy(Argument::any())->willReturn($queryBuilder);

        $queryBuilder->getQuery()->willReturn($query);

        $query->getResult()->willReturn([]);

        $this->findUsersByRight(['groups' => ['SUADMIN']])->shouldReturn([]);
        $this->findUsersByRight(['fonctions' => ['test']])->shouldReturn([]);
        $this->findUsersByRight(['roles' => ['test']])->shouldReturn([]);
        $this->findUsersByRight(['groups' => ['SUADMIN'], 'fonctions' => ['test'], 'roles' => ['test']])->shouldReturn([]);
    }

    public function it_should_find_users_by_right_include_false($em, QueryBuilder $queryBuilder, AbstractQuery $query, Expr $expr, Base $base)
    {
        $em->createQueryBuilder(Argument::any())->willReturn($queryBuilder);
        $queryBuilder->select(Argument::any())->willReturn($queryBuilder);
        $queryBuilder->from(Argument::any(), Argument::any(), Argument::any())->willReturn($queryBuilder);
        $queryBuilder->leftJoin(Argument::any(), Argument::any())->willReturn($queryBuilder);
        $queryBuilder->expr()->willReturn($expr);
        $expr->orX()->willReturn($base);
        $base->add(Argument::any())->shouldBeCalled();
        $expr->like(Argument::any(), Argument::any())->shouldBeCalled();
        $expr->literal(Argument::any())->shouldBeCalled();
        $queryBuilder->andWhere(Argument::any())->willReturn($queryBuilder);
        $queryBuilder->groupBy(Argument::any())->willReturn($queryBuilder);

        $queryBuilder->getQuery()->willReturn($query);

        $query->getResult()->willReturn([]);

        $this->findUsersByRight(['groups' => ['SUADMIN']], false)->shouldReturn([]);
        $this->findUsersByRight(['fonctions' => ['test']], false)->shouldReturn([]);
        $this->findUsersByRight(['roles' => ['test']], false)->shouldReturn([]);
        $this->findUsersByRight(['groups' => ['SUADMIN'], 'fonctions' => ['test'], 'roles' => ['test']], false)->shouldReturn([]);
    }
}
