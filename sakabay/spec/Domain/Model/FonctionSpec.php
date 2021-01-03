<?php

namespace spec\App\Domain\Model;

use App\Domain\Model\Fonction;
use App\Domain\Model\Role;
use PhpSpec\ObjectBehavior;

class FonctionSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Fonction::class);
        $this->getId()->shouldReturn(null);
    }

    public function it_should_save_a_name()
    {
        $this->setDescription('test name');
        $this->getDescription()->shouldReturn('test name');
    }

    public function it_should_save_a_code()
    {
        $this->setCode('SKB');
        $this->getCode()->shouldReturn('SKB');
    }

    public function it_should_add_and_remove_roles()
    {
        $role = new Role();
        $this->addRole($role);
        $this->getRoles()->shouldContain($role);
        $this->getRoles()->shouldHaveCount(1);
        $this->removeRole($role);
        $this->getRoles()->shouldHaveCount(0);
    }
}
