<?php

namespace spec\App\Domain\Model;

use App\Domain\Model\Fonction;
use App\Domain\Model\Role;
use App\Domain\Model\Group;
use PhpSpec\ObjectBehavior;

class RoleSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Role::class);
        $this->getId()->shouldReturn(null);
    }

    public function it_should_save_a_name()
    {
        $this->setName('test name');
        $this->getName()->shouldReturn('test name');
    }

    public function it_should_save_a_code()
    {
        $this->setCode('SKB');
        $this->getCode()->shouldReturn('SKB');
    }

    public function it_should_add_and_remove_fonctions()
    {
        $fonction = new Fonction();
        $this->addFonction($fonction);
        $this->getFonctions()->shouldContain($fonction);
        $this->getFonctions()->shouldHaveCount(1);
        $this->removeFonction($fonction);
        $this->getFonctions()->shouldHaveCount(0);
    }

    public function it_should_add_and_remove_groups()
    {
        $group = new Group();
        $this->addGroup($group);
        $this->getGroups()->shouldContain($group);
        $this->getGroups()->shouldHaveCount(1);
        $this->removeGroup($group);
        $this->getGroups()->shouldHaveCount(0);
    }
}
