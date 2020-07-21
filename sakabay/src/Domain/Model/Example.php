<?php

namespace App\Domain\Model;

use App\Infrastructure\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ExampleRepository::class)
 */
class Example
{
    /**
     *
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nom;

    /**
     * @var string
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
