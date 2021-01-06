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
}
