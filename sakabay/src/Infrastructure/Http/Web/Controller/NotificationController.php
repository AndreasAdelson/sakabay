<?php

namespace App\Infrastructure\Http\Web\Controller;

use App\Domain\Model\Utilisateur;
use App\Domain\Notification\Model\Notification;
use Mgilet\NotificationBundle\Controller\NotificationController as NotificationControllerModel;
use Mgilet\NotificationBundle\NotifiableInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/notification")
 */
class NotificationController extends NotificationControllerModel
{

    /**
     * List of all notifications.
     *
     * @Route("/all/{notifiable}")
     * @Method("GET")
     *
     * @param NotifiableInterface $notifiable
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction($notifiable)
    {
        $notifiableRepo = $this->get('doctrine.orm.entity_manager')
            ->getRepository('MgiletNotificationBundle:NotifiableNotification');
        $notificationList = $this->getDoctrine()->getRepository(Notification::class)->findAllForNotifiableSorted($notifiable, Utilisateur::class);
        // $notificationList = $notifiableRepo->findAllForNotifiableSorted($notifiable, Utilisateur::class);
        return $this->json($notificationList);
    }

    /**
     * List of all unseen notifications.
     *
     * @Route("/unseen/{notifiable}")
     * @Method("GET")
     *
     * @param NotifiableInterface $notifiable
     *
     *  @return \Symfony\Component\HttpFoundation\Response
     */
    public function listUnseenAction($notifiable)
    {
        $notifiableRepo = $this->get('doctrine.orm.entity_manager')
            ->getRepository('MgiletNotificationBundle:NotifiableNotification');
        $notificationList = $notifiableRepo->findAllByNotifiable($notifiable, Utilisateur::class, false);
        return $this->json($notificationList);
    }

    /**
     * Set a Notification as seen.
     *
     * @Route("/{notifiable}/mark_as_seen/{notification}")
     * @Method("POST")
     *
     * @param int          $notifiable
     * @param Notification $notification
     *
     * @return JsonResponse
     *
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\EntityNotFoundException
     * @throws \LogicException
     */
    public function markAsSeenAction($notifiable, $notification)
    {
        $manager = $this->get('mgilet.notification');
        $manager->markAsSeen(
            $manager->getNotifiableInterface($manager->getNotifiableEntityById($notifiable)),
            $manager->getNotification($notification),
            true
        );

        return new JsonResponse(true);
    }

    /**
     * Set a Notification as unseen.
     *
     * @Route("/{notifiable}/mark_as_unseen/{notification}")
     * @Method("POST")
     *
     * @param $notifiable
     * @param $notification
     *
     * @return JsonResponse
     *
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\EntityNotFoundException
     * @throws \LogicException
     */
    public function markAsUnSeenAction($notifiable, $notification)
    {
        $manager = $this->get('mgilet.notification');
        $manager->markAsUnseen(
            $manager->getNotifiableInterface($manager->getNotifiableEntityById($notifiable)),
            $manager->getNotification($notification),
            true
        );

        return new JsonResponse(true);
    }

    /**
     * Set all Notifications for a Utilisateur as seen.
     *
     * @Route("/{notifiable}/markAllAsSeen")
     * @Method("POST")
     *
     * @param $notifiable
     *
     * @return JsonResponse
     *
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function markAllAsSeenAction($notifiable)
    {
        $manager = $this->get('mgilet.notification');
        $manager->markAllAsSeen(
            $manager->getNotifiableInterface($manager->getNotifiableEntityById($notifiable)),
            true
        );

        return new JsonResponse(true);
    }

    /**
     * Checks API access permission.
     *
     * @param $notifiable
     */
    public function authorizeAccess($notifiable)
    {
        $user = $this->getUtilisateur();
        if ($user->getId() != $notifiable) {
            throw $this->createAccessDeniedException();
        }
    }
}
