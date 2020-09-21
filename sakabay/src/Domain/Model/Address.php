<?php

namespace App\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=AddressRepository::class)
 * @ExclusionPolicy("all")
 */
class Address
{
    /**
     * @var int
     * @Expose
     * @Groups({
     * "api_companies",
     * })
     */
    private $id;

    /**
     * @var string
     * @Expose
     * @Groups({
     * "api_companies",
     * "api_admin_companies"
     * })
     */
    private $postalAddress;

    /**
     * @var int
     * @Expose
     * @Groups({
     * "api_companies",
     * "api_admin_companies"
     * })
     */
    private $postalCode;

    /**
     * @var float
     * @Expose
     * @Groups({
     * "api_companies",
     * "api_admin_companies"
     * })
     */
    private $latitude;

    /**
     * @var float
     * @Expose
     * @Groups({
     * "api_companies",
     * "api_admin_companies"
     * })
     */
    private $longitude;

    /**
     * @var Company
     * @Expose
     * @Groups({
     * })
     */
    private $company;



    public function __construct()
    {
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
     * Get the value of postalAddress
     * @return  string
     */
    public function getPostalAddress()
    {
        return $this->postalAddress;
    }

    /**
     * Set the value of postalAddress
     * @param  string  $postalAddress
     * @return  self
     */
    public function setPostalAddress(string $postalAddress)
    {
        $this->postalAddress = $postalAddress;

        return $this;
    }

    /**
     * Get the value of postalCode
     *
     * @return  int
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set the value of postalCode
     * @param  int  $postalCode
     * @return  self
     */
    public function setPostalCode(int $postalCode)
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * Get the value of latitude
     *
     * @return  float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set the value of latitude
     * @param  float  $latitude
     * @return  self
     */
    public function setLatitude(float $latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get the value of latitude
     * @return  float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set the value of longitude
     * @param  float  $longitude
     * @return  self
     */
    public function setLongitude(float $longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get the company
     *
     * @return  Company
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set the value of company
     *
     * @param  Company  $company
     *
     * @return  self
     */
    public function setCompany(?Company $company)
    {
        $this->company = $company;
        return $this;
    }
}
