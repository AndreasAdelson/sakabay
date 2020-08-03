<?php

namespace App\Domain\Model;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;


/**
 * @ORM\Entity(repositoryClass=ExampleRepository::class)
 *
 * @ExclusionPolicy("all")
 *
 */
class Example
{
    /**
     * @var int
     * @Expose
     * @Groups({
     * "api_examples"
     * })
     */
    private $id;

    /**
     * @var string
     * @Expose
     * @Groups({
     * "api_examples"
     * })
     */
    private $nom;

    /**
     * @var string
     * @Expose
     * @Groups({
     * "api_examples"
     * })
     */
    private $consigne;



    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of nom
     *
     * @return  string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @param  string  $nom
     *
     * @return  self
     */
    public function setNom(string $nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get the value of consigne
     *
     * @return  string
     */
    public function getConsigne()
    {
        return $this->consigne;
    }

    /**
     * Set the value of consigne
     *
     * @param  string  $consigne
     *
     * @return  self
     */
    public function setConsigne(string $consigne)
    {
        $this->consigne = $consigne;

        return $this;
    }
}
