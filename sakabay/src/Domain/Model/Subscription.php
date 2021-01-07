<?php

namespace App\Domain\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=SubscriptionRepository::class)
 * @ExclusionPolicy("all")
 */
class Subscription
{
    /**
     * @var int
     * @Expose
     * @Groups({
     * "api_subscriptions",
     * "api_companies",
     * })
     */
    private $id;

    /**
     * @var string
     * @Expose
     * @Groups({
     * "api_subscriptions",
     * })
     */
    private $code;

    /**
     * @var string
     * @Expose
     * @Groups({
     * "api_subscriptions",
     * "api_dashboard_utilisateur"
     * })
     */
    private $name;

    /**
     * @var integer
     * @Expose
     * @Groups({
     * "api_subscriptions",
     * "api_dashboard_utilisateur"
     * })
     */
    private $price;


    /**
     * @var Companysubscription[]
     * @Expose
     * @Groups({
     * "api_subscriptions",
     * })
     */
    private $companysubscriptions;

    public function __construct()
    {
        $this->companysubscriptions = new ArrayCollection();
    }

    /**
     * Get })
     *
     * @return  integer
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set })
     *
     * @param  integer  $price  })
     *
     * @return  self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get })
     *
     * @return  string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set })
     *
     * @param  string  $name  })
     *
     * @return  self
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get })
     *
     * @return  string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set })
     *
     * @param  string  $code  })
     *
     * @return  self
     */
    public function setCode(string $code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get "api_subscriptions",
     *
     * @return  int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Collection|CompanySubscription[]
     */
    public function getCompanySubscriptions(): Collection
    {
        return $this->companysubscriptions;
    }

    public function addCompanySubscription(CompanySubscription $companysubscription): self
    {
        if (!$this->companysubscriptions->contains($companysubscription)) {
            $this->companysubscriptions[] = $companysubscription;
            $companysubscription->setCompany($this);
        }

        return $this;
    }

    public function removeCompanySubscription(CompanySubscription $companysubscription): self
    {
        if ($this->companysubscriptions->contains($companysubscription)) {
            $this->companysubscriptions->removeElement($companysubscription);
        }

        return $this;
    }
}
