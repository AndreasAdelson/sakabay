<?php

namespace App\Domain\Model;

use App\Domain\Model\Utilisateur;
use App\Infrastructure\Repository\ResetPasswordRequestRepository;
use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;
use SymfonyCasts\Bundle\ResetPassword\Model\ResetPasswordRequestInterface;
use SymfonyCasts\Bundle\ResetPassword\Model\ResetPasswordRequestTrait;

/**
 * @ORM\Entity(repositoryClass=ResetPasswordRequestRepository::class)
 */
class ResetPasswordRequest implements ResetPasswordRequestInterface
{
    use ResetPasswordRequestTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @var DateTime
     */
    private $expiresAt;

    /**
     * @var DateTime
     */
    private $requestedAt;


    /**
     * @var String
     */
    private $selector;

    /**
     * @var String
     */
    private $hashedToken;

    public function __construct(object $user, \DateTimeInterface $expiresAt, string $selector, string $hashedToken)
    {
        $this->user = $user;
        $this->initialize($expiresAt, $selector, $hashedToken);
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): object
    {
        return $this->user;
    }

    public function getExpiresAt(): DateTimeInterface
    {
        return $this->expiresAt;
    }

    public function setExpiresAt(DateTime $expiresAt)
    {
        $this->expiresAt = $expiresAt;
    }

    public function getRequestedAt(): DateTimeInterface
    {
        return $this->requestedAt;
    }

    public function setRequestedAt(DateTime $requestedAt)
    {
        $this->requestedAt = $requestedAt;
    }
}
