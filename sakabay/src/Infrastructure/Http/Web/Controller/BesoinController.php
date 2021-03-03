<?php

namespace App\Infrastructure\Http\Web\Controller;

use App\Application\Service\CompanyService;
use App\Domain\Model\Besoin;
use App\Infrastructure\Repository\BesoinRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class BesoinController extends AbstractController
{

    private $companyService;

    /**
     * BesoinWebController constructor.
     */
    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }

    /**
     * @Route("admin/group", name="group_index", methods="GET")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function index(AuthorizationCheckerInterface $authorizationChecker)
    {
        return $this->render('admin/group/index.html.twig', [
            'canCreate' => $authorizationChecker->isGranted('ROLE_CGROUP'),
            'canRead' => $authorizationChecker->isGranted('ROLE_RGROUP'),
            'canEdit' => $authorizationChecker->isGranted('ROLE_UGROUP'),
            'canDelete' => $authorizationChecker->isGranted('ROLE_DGROUP'),
        ]);
    }

    /**
     * @Route("services/new", name="service_new", methods="GET|POST")
     */
    public function new()
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $utilisateurId = $this->getUser()->getId();
        return $this->render('utilisateur/besoin/form.html.twig', [
            'utilisateurId' => $utilisateurId,
            'besoinId' => null
        ]);
    }

    /**
     * @Route("services/edit/{id}", name="service_edit", methods="GET|POST")
     */
    public function edit(int $id)
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $utilisateurId = $this->getUser()->getId();
        return $this->render('utilisateur/besoin/form.html.twig', [
            'utilisateurId' => $utilisateurId,
            'besoinId' => $id
        ]);
    }

    /**
     * @Route("admin/group/{id}", name="group_show", methods="GET|POST")
     */
    public function show(int $id, AuthorizationCheckerInterface $authorizationChecker)
    {
        return $this->render('admin/group/show.html.twig', [
            'canEdit' => $authorizationChecker->isGranted('ROLE_UGROUP'),
            'groupId' => $id,
            'urlPrecedente' => $this->urlPrecedente()
        ]);
    }

    /**
     * @Route("services/list", name="service_list", methods="GET")
     */
    public function manageBesoinList()
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $utilisateurId = $this->getUser()->getId();
        return $this->render('utilisateur/besoin/list.html.twig', [
            'utilisateurId' => $utilisateurId,
        ]);
    }

    /**
     * @Route("opportunities/list", name="opportunity_list", methods="GET")
     */
    public function opportunityList()
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $utilisateurId = $this->getUser()->getId();
        $companies = $this->companyService->getCompanyByUserId($utilisateurId);
        if (empty($companies)) {
            throw new NotFoundHttpException('Page does not exist');
        }
        $subscribedCompaniesId = [];
        foreach ($companies as $company) {
            $subscribtionActive = $this->companyService->isCompanySubscribtionActive($company);
            if ($subscribtionActive) {
                array_push($subscribedCompaniesId, $company->getId());
            }
        }
        if (empty($subscribedCompaniesId)) {
            throw new NotFoundHttpException('Page does not exist');
        }

        return $this->render('opportunity/list.html.twig', [
            'utilisateurId' => $utilisateurId,
        ]);
    }

    private function urlPrecedente()
    {
        $urlPrecedente = "/";
        if (isset($_SERVER['HTTP_REFERER'])) {
            $urlPrecedente = $_SERVER['HTTP_REFERER'];
        }
        return $urlPrecedente;
    }
}
