<?php

namespace spec\App\Infrastructure\Repository;

use App\Domain\Model\CompanyStatut;
use App\Infrastructure\Repository\CompanyStatutRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class CompanyStatutRepositorySpec extends ObjectBehavior
{
    public function let(EntityManagerInterface $em, ClassMetadata $class)
    {
        $this->beConstructedWith($em, $class);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(CompanyStatutRepository::class);
    }

    /**
     * save($companyStatut) test.
     */
    public function it_should_save($em)
    {
        $companyStatut = new CompanyStatut();
        $em->persist($companyStatut)->willReturn(null);
        $em->flush($companyStatut)->willReturn(null);
        $this->save($companyStatut);
        $em->persist($companyStatut)->shouldBeCalled();
        $em->flush($companyStatut)->shouldBeCalled();
    }

    /**
     * delete($companyStatut) test.
     */
    public function it_should_delete($em)
    {
        $companyStatut = new CompanyStatut();
        $em->remove($companyStatut)->willReturn(null);
        $em->flush($companyStatut)->willReturn(null);
        $this->delete($companyStatut);
        $em->remove($companyStatut)->shouldBeCalled();
        $em->flush($companyStatut)->shouldBeCalled();
    }
}
