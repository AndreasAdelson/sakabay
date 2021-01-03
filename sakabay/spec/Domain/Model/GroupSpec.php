<?php

namespace spec\App\Domain\Model;

use App\Domain\Model\Fonction;
use App\Domain\Model\Role;
use App\Domain\Model\Group;
use App\Domain\Model\Utilisateur;
use PhpSpec\ObjectBehavior;

class GroupSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Group::class);
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

    public function it_should_add_and_remove_roles()
    {
        $role = new Role();
        $this->addRole($role);
        $this->getRoles()->shouldContain($role);
        $this->getRoles()->shouldHaveCount(1);
        $this->removeRole($role);
        $this->getRoles()->shouldHaveCount(0);
    }

    public function it_should_add_and_remove_users()
    {
        $utilisateur = new Utilisateur();
        $this->addUtilisateur($utilisateur);
        $this->getUtilisateurs()->shouldContain($utilisateur);
        $this->getUtilisateurs()->shouldHaveCount(1);
        $this->removeUtilisateur($utilisateur);
        $this->getUtilisateurs()->shouldHaveCount(0);
    }
}
