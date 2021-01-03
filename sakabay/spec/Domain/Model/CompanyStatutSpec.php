<?php

namespace spec\App\Domain\Model;

use App\Domain\Model\CompanyStatut;
use App\Domain\Model\Company;
use PhpSpec\ObjectBehavior;

class CompanyStatutSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(CompanyStatut::class);
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

    public function it_should_save_company()
    {
        $company = new Company();
        $this->addCompany($company);
        $this->getCompanys()->shouldContain($company);
        $this->getCompanys()->shouldHaveCount(1);
        $this->removeCompany($company);
        $this->getCompanys()->shouldHaveCount(0);
    }
}
