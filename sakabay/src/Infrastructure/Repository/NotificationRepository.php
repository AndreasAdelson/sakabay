<?php

namespace App\Infrastructure\Repository;

class NotificationRepository extends AbstractRepository
{
    /**
     * Get all NotifiableNotifications for a notifiable
     *
     * @param        $notifiable_identifier
     * @param        $notifiable_class
     * @param string $order
     *
     * @return NotifiableNotification[]
     */
    public function findAllForNotifiableSorted($notifiable_identifier, $notifiable_class, $order = 'DESC')
    {
        $builder = $this->_em->createQueryBuilder()
            ->select('notification', 'notifiableNotification')
            ->from('Mgilet\NotificationBundle\Entity\NotifiableNotification', 'notifiableNotification')
            ->join('notifiableNotification.notification', 'notification')
            ->join('notifiableNotification.notifiableEntity', 'notifiable')
            ->where('notifiable.identifier = :notifiable_identifier')
            ->setParameter('notifiable_identifier', $notifiable_identifier)
            ->orderBy('notification.date', $order);

        return $builder->getQuery()->getResult();
        // return $this->createQueryBuilder('nn')
        //     ->leftJoin('nn.notifiableEntity', 'ne')
        //     ->leftJoin('nn.notification', 'no')
        //     ->where('ne.identifier = :identifier')
        //     ->andWhere('ne.class = :class')
        //     ->setParameter('identifier', $notifiable_identifier)
        //     ->setParameter('class', $notifiable_class)
        //     ->orderBy('no.date', $order)
        //     ->getQuery()
        //     ->getResult();
    }
}
