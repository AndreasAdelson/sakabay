<?php

namespace spec\App\Infrastructure\Repository;

use App\Domain\Model\Fonction;
use App\Infrastructure\Repository\FonctionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use PhpSpec\ObjectBehavior;

class FonctionRepositorySpec extends ObjectBehavior
{
    public function let(EntityManagerInterface $em, ClassMetadata $class)
    {
        $this->beConstructedWith($em, $class);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(FonctionRepository::class);
    }

    /**
     * save($fonction) test.
     */
    public function it_should_save($em)
    {
        $fonction = new Fonction();
        $em->persist($fonction)->willReturn(null);
        $em->flush($fonction)->willReturn(null);
        $this->save($fonction);
        $em->persist($fonction)->shouldBeCalled();
        $em->flush($fonction)->shouldBeCalled();
    }

    /**
     * delete($fonction) test.
     */
    public function it_should_delete($em)
    {
        $fonction = new Fonction();
        $em->remove($fonction)->willReturn(null);
        $em->flush($fonction)->willReturn(null);
        $this->delete($fonction);
        $em->remove($fonction)->shouldBeCalled();
        $em->flush($fonction)->shouldBeCalled();
    }
}
