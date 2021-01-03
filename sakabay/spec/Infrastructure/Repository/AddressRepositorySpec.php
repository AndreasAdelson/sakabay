<?php

namespace spec\App\Infrastructure\Repository;

use App\Domain\Model\Address;
use App\Infrastructure\Repository\AddressRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use PhpSpec\ObjectBehavior;

class AddressRepositorySpec extends ObjectBehavior
{
    public function let(EntityManagerInterface $em, ClassMetadata $class)
    {
        $this->beConstructedWith($em, $class);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(AddressRepository::class);
    }

    /**
     * save($address) test.
     */
    public function it_should_save($em)
    {
        $address = new Address();
        $em->persist($address)->willReturn(null);
        $em->flush($address)->willReturn(null);
        $this->save($address);
        $em->persist($address)->shouldBeCalled();
        $em->flush($address)->shouldBeCalled();
    }

    /**
     * delete($address) test.
     */
    public function it_should_delete($em)
    {
        $address = new Address();
        $em->remove($address)->willReturn(null);
        $em->flush($address)->willReturn(null);
        $this->delete($address);
        $em->remove($address)->shouldBeCalled();
        $em->flush($address)->shouldBeCalled();
    }
}
