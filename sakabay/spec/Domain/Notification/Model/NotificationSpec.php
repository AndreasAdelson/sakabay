<?php

namespace spec\App\Domain\Notification\Model;

use App\Domain\Model\Acteur;
use App\Domain\Model\Besoin;
use App\Domain\Model\Etude;
use App\Domain\Model\Sponsor;
use App\Domain\Notification\Model\Notification;
use Mgilet\NotificationBundle\Entity\NotifiableNotification;
use PhpSpec\ObjectBehavior;

class NotificationSpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType(Notification::class);
    }

    public function it_should_add_and_remove_notifiable_notifications()
    {
        $nn = new NotifiableNotification();
        $this->addNotifiableNotification($nn);
        $this->getNotifiableNotifications()->shouldContain($nn);
        $this->getNotifiableNotifications()->shouldHaveCount(1);
        $this->removeNotifiableNotification($nn);
        $this->getNotifiableNotifications()->shouldHaveCount(0);
    }

    public function it_should_serialize()
    {
        $this->jsonSerialize()->shouldIterateAs(
            new \ArrayIterator([
                'id' => null,
                'date' => (new \Datetime())->format(\DateTime::ISO8601),
                'subject' => null,
                'message' => null,
                'link' => null,
            ])
        );
    }
}
