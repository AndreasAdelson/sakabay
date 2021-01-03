<?php

namespace spec\App\Infrastructure\Repository;

use App\Domain\Model\Group;
use App\Infrastructure\Repository\GroupRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use PhpSpec\ObjectBehavior;

class GroupRepositorySpec extends ObjectBehavior
{
    public function let(EntityManagerInterface $em, ClassMetadata $class)
    {
        $this->beConstructedWith($em, $class);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(GroupRepository::class);
    }

    /**
     * save($group) test.
     */
    public function it_should_save($em)
    {
        $group = new Group();
        $em->persist($group)->willReturn(null);
        $em->flush($group)->willReturn(null);
        $this->save($group);
        $em->persist($group)->shouldBeCalled();
        $em->flush($group)->shouldBeCalled();
    }

    /**
     * delete($group) test.
     */
    public function it_should_delete($em)
    {
        $group = new Group();
        $em->remove($group)->willReturn(null);
        $em->flush($group)->willReturn(null);
        $this->delete($group);
        $em->remove($group)->shouldBeCalled();
        $em->flush($group)->shouldBeCalled();
    }
}
