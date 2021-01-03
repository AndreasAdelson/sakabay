<?php

namespace spec\App\Infrastructure\Repository;

use App\Domain\Model\Role;
use App\Infrastructure\Repository\RoleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use PhpSpec\ObjectBehavior;

class RoleRepositorySpec extends ObjectBehavior
{
    public function let(EntityManagerInterface $em, ClassMetadata $class)
    {
        $this->beConstructedWith($em, $class);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(RoleRepository::class);
    }

    /**
     * save($role) test.
     */
    public function it_should_save($em)
    {
        $role = new Role();
        $em->persist($role)->willReturn(null);
        $em->flush($role)->willReturn(null);
        $this->save($role);
        $em->persist($role)->shouldBeCalled();
        $em->flush($role)->shouldBeCalled();
    }

    /**
     * delete($role) test.
     */
    public function it_should_delete($em)
    {
        $role = new Role();
        $em->remove($role)->willReturn(null);
        $em->flush($role)->willReturn(null);
        $this->delete($role);
        $em->remove($role)->shouldBeCalled();
        $em->flush($role)->shouldBeCalled();
    }
}
