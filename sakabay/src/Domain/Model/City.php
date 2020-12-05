<?php

namespace App\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=CityRepository::class)
 * @UniqueEntity(
 *     fields={"name"},
 *     message="Une ville existe déjà avec ce nom"
 * )
 * @ExclusionPolicy("all")
 *
 */
class City
{
    /**
     *
     * @var int
     * @Expose
     * @Groups({
     * "api_cities",
     * "api_admin_companies"
     * })
     */
    private $id;

    /**
     * @var string
     * @Expose
     * @Groups({
     * "api_cities",
     * "api_companies",
     * "api_admin_companies"
     * })
     */
    private $name;


    /**
     * @var Company[]
     * @Expose
     * @Groups({
     * })
     */
    private $company;


    public function __construct()

    {
        $this->company = new ArrayCollection();
    }

    /**
     * Get the value of id
     * @return  int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     * @param  int  $id
     * @return  self
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     * @return  string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     * @param  string  $name
     * @return  self
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection|City[]
     */
    public function getCity(): Collection
    {
        return $this->fonctions;
    }

    /**
     * Get the value of categorys
     * @return  City[]
     */
    public function addCity(City $fonction): self
    {
        if (!$this->fonctions->contains($fonction)) {
            $this->fonctions[] = $fonction;
        }

        return $this;
    }

    /**
     * Set the value of fonctions
     * @param  City[]  $fonctions
     * @return  self
     */
    public function removeCity(City $fonction): self
    {
        if ($this->fonctions->contains($fonction)) {
            $this->fonctions->removeElement($fonction);
        }
        return $this;
    }

    /**
     * @return Company[]
     */
    public function getCompany(): Collection
    {
        return $this->company;
    }

    public function addCompany(Company $company): self
    {
        if (!$this->company->contains($company)) {
            $this->company[] = $company;
            $company->setCity($this);
        }

        return $this;
    }

    public function removeCompany(Company $company): self
    {
        if ($this->companys->contains($company)) {
            $this->companys->removeElement($company);
        }
        return $this;
    }
}
