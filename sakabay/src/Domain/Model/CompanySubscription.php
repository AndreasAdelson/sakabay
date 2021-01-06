<?php

namespace App\Domain\Model;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=CompanySubscriptionRepository::class)
 * @ExclusionPolicy("all")
 */
class CompanySubscription
{
    /**
     * @var int
     * @Expose
     * @Groups({
     * "api_companies"
     * })
     */
    private $id;

    /**
     * @var DateTime
     * @Expose
     * @Groups({
     * "api_dashboard_utilisateur",
     * "api_companies"
     * })
     */
    private $dt_debut;

    /**
     * @var DateTime
     * @Expose
     * @Groups({
     * "api_dashboard_utilisateur",
     * "api_companies"
     * })
     */
    private $dt_fin;

    /**
     * @var Subscription
     * @Expose
     * @Groups({
     * "api_dashboard_utilisateur",
     * "api_companies"
     * })
     */
    private $subscription;

    /**
     * @var Company
     * @Expose
     * @Groups({
     * "api_dashboard_utilisateur",
     * "api_companies"
     * })
     */
    private $company;


    public function __construct()

    {
    }

    /**
     * Get })
     *
     * @return  int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set })
     *
     * @param  int  $id  })
     *
     * @return  self
     */
    public function setId(int $id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get })
     *
     * @return  DateTime
     */
    public function getDtDebut()
    {
        return $this->dt_debut;
    }

    /**
     * Set })
     *
     * @param  DateTime  $dt_debut  })
     *
     * @return  self
     */
    public function setDtDebut(DateTime $dt_debut)
    {
        $this->dt_debut = $dt_debut;

        return $this;
    }

    /**
     * Get })
     *
     * @return  DateTime
     */
    public function getDtFin()
    {
        return $this->dt_fin;
    }

    /**
     * Set })
     *
     * @param  DateTime  $dt_fin  })
     *
     * @return  self
     */
    public function setDtFin(DateTime $dt_fin)
    {
        $this->dt_fin = $dt_fin;

        return $this;
    }

    public function getSubscription(): ?Subscription
    {
        return $this->subscription;
    }

    public function setSubscription(?Subscription $subscription): self
    {
        $this->subscription = $subscription;
        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;
        return $this;
    }
}
