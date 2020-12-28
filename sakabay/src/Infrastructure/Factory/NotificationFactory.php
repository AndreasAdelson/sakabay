<?php

namespace App\Infrastructure\Factory;

use App\Domain\Notification\Model\Notification;
use Symfony\Contracts\Translation\TranslatorInterface;

class NotificationFactory
{
    private $manager;
    private $translator;

    public function __construct(
        \Mgilet\NotificationBundle\Manager\NotificationManager $manager,
        TranslatorInterface $translator
    ) {
        $this->manager = $manager;
        $this->translator = $translator;
    }

    public function testNotification(array $destinataires, string $link)
    {
        $this->addNotification($destinataires, 'Blablabla', 'Validation d\'une entreprise', $link);
    }



    private function addNotification(
        $users,
        $subject,
        $message,
        $link
    ) {
        $notification = new Notification();
        $notification->setSubject($subject);
        $notification->setMessage($message);
        $notification->setLink(parse_url($link, PHP_URL_PATH));

        $this->manager->addNotification($users, $notification, true);
    }
}
