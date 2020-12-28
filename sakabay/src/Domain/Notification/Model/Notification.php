<?php

namespace App\Domain\Notification\Model;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Mgilet\NotificationBundle\Entity\NotifiableNotification;
use Mgilet\NotificationBundle\Entity\NotificationInterface;
use Mgilet\NotificationBundle\Model\Notification as NotificationModel;

/**
 * Class Notification.
 *
 * @ORM\Entity(repositoryClass="App\Infrastructure\Repository\NotificationRepository")
 */
class Notification extends NotificationModel implements NotificationInterface, \JsonSerializable
{
    /**
     * @var NotifiableNotification[]|ArrayCollectionP
     * @ORM\OneToMany(targetEntity="Mgilet\NotificationBundle\Entity\NotifiableNotification", mappedBy="notification", cascade={"persist", "remove"})
     */
    protected $notifiableNotifications;

    public function __construct()
    {
        parent::__construct();
        $this->notifiableNotifications = new ArrayCollection();
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'date' => $this->getDate()->format(\DateTime::ISO8601),
            'subject' => $this->getSubject(),
            'message' => $this->getMessage(),
            'link' => $this->getLink(),
        ];
    }

    /**
     * @return Collection|NotifiableNotification[]
     */
    public function getNotifiableNotifications(): Collection
    {
        return $this->notifiableNotifications;
    }

    public function addNotifiableNotification(NotifiableNotification $notifiableNotification): self
    {
        if (!$this->notifiableNotifications->contains($notifiableNotification)) {
            $this->notifiableNotifications[] = $notifiableNotification;
            $notifiableNotification->setNotification($this);
        }

        return $this;
    }

    public function removeNotifiableNotification(NotifiableNotification $notifiableNotification): self
    {
        if ($this->notifiableNotifications->contains($notifiableNotification)) {
            $this->notifiableNotifications->removeElement($notifiableNotification);
            // set the owning side to null (unless already changed)
            if ($notifiableNotification->getNotification() === $this) {
                $notifiableNotification->setNotification(null);
            }
        }

        return $this;
    }
}
