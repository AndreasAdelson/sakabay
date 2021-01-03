<?php

namespace spec\App\Domain\Model;

use App\Domain\Model\Address;
use App\Domain\Model\Category;
use App\Domain\Model\City;
use App\Domain\Model\Company;
use App\Domain\Model\CompanyStatut;
use App\Domain\Model\Utilisateur;
use PhpSpec\ObjectBehavior;

class CompanySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Company::class);
        $this->getId()->shouldReturn(null);
    }

    public function it_should_save_a_name()
    {
        $this->setName('test name');
        $this->getName()->shouldReturn('test name');
    }

    public function it_should_save_a_num_siret()
    {
        $this->setUrlName('test name');
        $this->getUrlName()->shouldReturn('test name');
    }

    public function it_should_save_an_url_name()
    {
        $this->setNumSiret('test name');
        $this->getNumSiret()->shouldReturn('test name');
    }

    public function it_should_save_category()
    {
        $category = new Category();
        $this->getCategory()->shouldReturn(null);
        $this->setCategory($category);
        $this->getCategory()->shouldReturn($category);
    }

    public function it_should_save_an_user()
    {
        $utilisateur = new Utilisateur();
        $this->getUtilisateur()->shouldReturn(null);
        $this->setUtilisateur($utilisateur);
        $this->getUtilisateur()->shouldReturn($utilisateur);
    }

    public function it_should_save_a_company_statut()
    {
        $companyStatut = new CompanyStatut();
        $this->getCompanyStatut()->shouldReturn(null);
        $this->setCompanyStatut($companyStatut);
        $this->getCompanyStatut()->shouldReturn($companyStatut);
    }

    public function it_should_save_an_address()
    {
        $address = new Address();
        $this->getAddress()->shouldReturn(null);
        $this->setAddress($address);
        $this->getAddress()->shouldReturn($address);
    }

    public function it_should_save_a_city()
    {
        $city = new City();
        $this->getCity()->shouldReturn(null);
        $this->setCity($city);
        $this->getCity()->shouldReturn($city);
    }
}
