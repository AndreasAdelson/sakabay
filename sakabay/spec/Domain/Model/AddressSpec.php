<?php

namespace spec\App\Domain\Model;

use App\Domain\Model\Address;
use App\Domain\Model\Company;
use PhpSpec\ObjectBehavior;

class AddressSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Address::class);
        $this->getId()->shouldReturn(null);
    }

    public function it_should_save_a_postal_address()
    {
        $this->setPostalAddress('test name');
        $this->getPostalAddress()->shouldReturn('test name');
    }

    public function it_should_save_a_postal_code()
    {
        $this->setPostalCode(1234);
        $this->getPostalCode()->shouldReturn(1234);
    }

    public function it_should_save_a_latitude()
    {
        $this->setLatitude(123.12345678);
        $this->getLatitude()->shouldReturn(123.12345678);
    }

    public function it_should_save_a_longitude()
    {
        $this->setLongitude(123.12345678);
        $this->getLongitude()->shouldReturn(123.12345678);
    }

    public function it_should_save_a_company()
    {
        $company = new Company();
        $this->getCompany()->shouldReturn(null);
        $this->setCompany($company);
        $this->getCompany()->shouldReturn($company);
    }
}
