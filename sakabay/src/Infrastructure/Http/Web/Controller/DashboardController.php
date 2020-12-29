<?php

namespace App\Infrastructure\Http\Web\Controller;

// use App\Domain\Model\Dashboard;
// use App\Infrastructure\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class DashboardController extends AbstractController
{

    /**
     * @Route("/Dashboard", name="dashboard", methods="GET")
     */
    public function index(AuthorizationCheckerInterface $authorizationChecker)
    {
        return $this->render('dashboard/index.html.twig', [
            'canCreate' => $authorizationChecker->isGranted('ROLE_ADMIN'),
            'canRead' => $authorizationChecker->isGranted('ROLE_ADMIN'),
            'canEdit' => $authorizationChecker->isGranted('ROLE_ADMIN'),
            'canDelete' => $authorizationChecker->isGranted('ROLE_ADMIN'),
            'controller_name' => 'UtilisateurController',
        ]);
    }
}
