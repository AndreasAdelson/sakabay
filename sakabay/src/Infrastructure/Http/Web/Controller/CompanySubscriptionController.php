<?php

namespace App\Infrastructure\Http\Web\Controller;

use App\Domain\Model\CompanySubscription;
use App\Infrastructure\Repository\CompanySubscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class CompanySubscriptionController extends AbstractController
{


    /**
     * @Route("subscribe/", name="company_subscription_premium", methods="GET|POST")
     */
    public function premium()
    {

        #Check si l'user est connecté sinon redirige vers l'authentification
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        } else if (!$this->getUser()->getCompany()) {
            throw new NotFoundHttpException('Error !');
        } else {
            return $this->render('abonnement/premium/index.html.twig', [
                'companyId' => $this->getUser()->getId(),
                // 'companyUrlName' => $this->getUser()->getCompqny(),
            ]);
        }
    }
    /**
     * @Route("subscribe/pro", name="company_subscription_pro", methods="GET|POST")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function pro(int $id)
    {
        return $this->render('abonnement/pro/index.html.twig', [
            'companyId' => $id,
        ]);
    }

    /**
     * @Security("is_granted('ROLE_ADMIN')")
     * @Route("subscribe/free", name="company_subscription_free", methods="GET|POST")
     */
    public function free(int $id)
    {
        return $this->render('abonnement/free/index.html.twig', [
            'subscriptionId' => $id
        ]);
    }
}
