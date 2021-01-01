<?php

namespace App\Infrastructure\Http\Web\Controller;

use App\Application\Service\SubscriptionService;
use App\Domain\Model\Subscription;
use App\Infrastructure\Repository\SubscriptionRepository;
use Gedmo\Mapping\Annotation\Slug;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class SubscriptionController extends AbstractController
{

    /**
     * @Route("/subscription", name="subscription_index", methods="GET")
     */
    public function index()
    {
        return $this->render('abonnement/index.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }

    /**
     * @Route("subscription/{slug}", name="subscription_details_subscriptions", methods="GET|POST")
     */
    public function detailsSubscriptions(string $slug)
    {
        // $subscription = $this.SubscriptionService->
        #Check si l'user est connecté sinon redirige vers l'authentification
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        } else if (!$this->getUser()->getCompany()) {
            throw new NotFoundHttpException('Error !');
        } else {
            return $this->render('abonnement/premium/index.html.twig', [
                'controller_name' => 'CompanyController',
                'companyId' => $this->getUser()->getCompany()->getId(),
                'utilisateurId' => $this->getUser()->getId(),
                'subscriptionName' => $slug,
                // 'companyId' => $this->getUser()->getId(),
                // 'companyUrlName' => $this->getUser()->getCompqny(),
            ]);
        }
    }
    /**
     * @Route("subscription/pro", name="subscription_pro", methods="GET|POST")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function pro(int $id)
    {
        return $this->render('abonnement/pro/index.html.twig', [
            'subscriptionId' => $id,
        ]);
    }

    /**
     * @Security("is_granted('ROLE_ADMIN')")
     * @Route("subscription/free", name="subscription_free", methods="GET|POST")
     */
    public function free(int $id)
    {
        return $this->render('abonnement/free/index.html.twig', [
            'subscriptionId' => $id
        ]);
    }
}
