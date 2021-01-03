<?php

namespace spec\App\Infrastructure\Repository;

use App\Domain\Model\Category;
use App\Infrastructure\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;
use PhpSpec\ObjectBehavior;

class CategoryRepositorySpec extends ObjectBehavior
{
    public function let(EntityManagerInterface $em, ClassMetadata $class)
    {
        $this->beConstructedWith($em, $class);
    }

    public function it_is_initializable()
    {
        $this->shouldHaveType(CategoryRepository::class);
    }

    /**
     * save($category) test.
     */
    public function it_should_save($em)
    {
        $category = new Category();
        $em->persist($category)->willReturn(null);
        $em->flush($category)->willReturn(null);
        $this->save($category);
        $em->persist($category)->shouldBeCalled();
        $em->flush($category)->shouldBeCalled();
    }

    /**
     * delete($category) test.
     */
    public function it_should_delete($em)
    {
        $category = new Category();
        $em->remove($category)->willReturn(null);
        $em->flush($category)->willReturn(null);
        $this->delete($category);
        $em->remove($category)->shouldBeCalled();
        $em->flush($category)->shouldBeCalled();
    }
}
