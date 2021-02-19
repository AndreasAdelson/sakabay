<?php

namespace App\Infrastructure\Http\Web\Controller;

use App\Application\Service\CompanyService;
use App\Domain\Model\Company;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class CompanyController extends AbstractController
{
    private $companyService;

    /**
     * CompanyWebController constructor.
     */
    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }
    /**
     * @Route("entreprises/search", name="company_search", methods="GET")
     */
    public function searchIndex()
    {
        return $this->render('company/search.html.twig', []);
    }


    /**
     * @Route("entreprise", name="company_register_index", methods="GET")
     */
    public function registerIndex(AuthorizationCheckerInterface $authorizationChecker)
    {
        return $this->render('company/index.html.twig', []);
    }

    /**
     * @Route("entreprise/new", name="company_admin_new", methods="GET|POST")
     */
    public function new()
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        return $this->render('company/form.html.twig', [
            'utilisateurId' => $this->getUser()->getId()
        ]);
    }

    /**
     * @Route("entreprise/{slug}", name="company_show", methods="GET")
     */
    public function show(string $slug)
    {
        $company = $this->companyService->getCompanyByUrlName($slug);
        if (!$company) {
            throw new NotFoundHttpException('Company with url_name ' . $slug . ' does not exist!');
        } else if ($company->getCompanystatut()->getCode() !== "VAL") {
            throw $this->createNotFoundException("This company does not exist");
        }
        $isSubscriptionActive = $this->companyService->isCompanySubscribtionActive($company);
        $titlePage = $company->getName();
        return $this->render('company/show.html.twig', [
            'companyUrlName' => $slug,
            'titlePage' => $titlePage,
            'isSubscriptionActive' => $isSubscriptionActive
        ]);
    }

    /**
     * @Route("admin/entreprise", name="company_subscribed_index", methods="GET")
     */
    public function subscribedIndex(AuthorizationCheckerInterface $authorizationChecker)
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        return $this->render('admin/company/subscribed/subscribed_index.html.twig', [
            'canEdit' => $authorizationChecker->isGranted('ROLE_UCOMPANY'),
            'canDelete' => $authorizationChecker->isGranted('ROLE_DCOMPANY'),
            'canRead' => $authorizationChecker->isGranted('ROLE_RCOMPANY')
        ]);
    }

    /**
     * @Route("admin/entreprise/edit/{id}", name="company_subscribed_edit", methods="GET|POST")
     */
    public function editSubscribed(int $id)
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        return $this->render('admin/company/subscribed/subscribed_form.html.twig', [
            'companyId' => $id,
            'urlPrecedente' => $this->urlPrecedente()
        ]);
    }

    /**
     * @Route("admin/entreprise/{id}", name="company_subscribed_show", methods="GET")
     */
    public function showSubscribed(int $id, AuthorizationCheckerInterface $authorizationChecker)
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        return $this->render('admin/company/subscribed/subscribed_show.html.twig', [
            'companyId' => $id,
            'canEdit' => $authorizationChecker->isGranted('ROLE_UCOMPANY'),
            'urlPrecedente' => $this->urlPrecedente()
        ]);
    }

    /**
     * @Route("admin/registered/entreprise", name="company_registered_index", methods="GET")
     */
    public function registeredIndex(AuthorizationCheckerInterface $authorizationChecker)
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        return $this->render('admin/company/registered/registered_index.html.twig', [
            'canEdit' => $authorizationChecker->isGranted('ROLE_UCOMPANY'),
            'canDelete' => $authorizationChecker->isGranted('ROLE_DCOMPANY'),
            'canRead' => $authorizationChecker->isGranted('ROLE_RCOMPANY')
        ]);
    }

    /**
     * @Route("admin/registered/entreprise/edit/{id}", name="company_registered_edit", methods="GET|POST")
     */
    public function editRegistered(int $id)
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        return $this->render('admin/company/registered/registered_form.html.twig', [
            'companyId' => $id,
            'urlPrecedente' => $this->urlPrecedente()
        ]);
    }


    /**
     * @Route("admin/registered/entreprise/{id}", name="company_registered_show", methods="GET")
     */
    public function showRegistered(int $id, AuthorizationCheckerInterface $authorizationChecker)
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        return $this->render('admin/company/registered/registered_show.html.twig', [
            'companyId' => $id,
            'canEdit' => $authorizationChecker->isGranted('ROLE_UCOMPANY'),
            'urlPrecedente' => $this->urlPrecedente()
        ]);
    }

    /**
     * @Route("admin/refused/entreprise", name="company_refused_index", methods="GET")
     */
    public function refusedIndex(AuthorizationCheckerInterface $authorizationChecker)
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        return $this->render('admin/company/refused/refused_index.html.twig', [
            'canEdit' => $authorizationChecker->isGranted('ROLE_UCOMPANY'),
            'canDelete' => $authorizationChecker->isGranted('ROLE_DCOMPANY'),
            'canRead' => $authorizationChecker->isGranted('ROLE_RCOMPANY')
        ]);
    }

    /**
     * @Route("admin/refused/entreprise/edit/{id}", name="company_refused_edit", methods="GET|POST")
     */
    public function editRefused(int $id)
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        return $this->render('admin/company/refused/refused_form.html.twig', [
            'companyId' => $id,
            'urlPrecedente' => $this->urlPrecedente()
        ]);
    }


    /**
     * @Route("admin/refused/entreprise/{id}", name="company_refused_show", methods="GET")
     */
    public function showRefused(int $id, AuthorizationCheckerInterface $authorizationChecker)
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        return $this->render('admin/company/refused/refused_show.html.twig', [
            'companyId' => $id,
            'canEdit' => $authorizationChecker->isGranted('ROLE_UCOMPANY'),
            'urlPrecedente' => $this->urlPrecedente()
        ]);
    }

    /**
     * @Route("entreprises/list", name="company_list", methods="GET")
     */
    public function manageCompanyList()
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $utilisateurId = $this->getUser()->getId();
        $companies = $this->companyService->getCompanyByUserId($utilisateurId);
        if (empty($companies)) {
            throw new NotFoundHttpException('Page does not exist');
        }
        return $this->render('company/list/index.html.twig', [
            'utilisateurId' => $utilisateurId,
        ]);
    }

    /**
     * @Route("entreprises/edit/{slug}", name="company_edit", methods="GET")
     */
    public function editOwnCompany(string $slug)
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $company = $this->companyService->getCompanyByUrlName($slug);
        $ownerId = $company->getUtilisateur()->getId();
        $utilisateurId = $this->getUser()->getId();
        if ($ownerId != $utilisateurId || $company->getCompanystatut()->getCode() != 'VAL') {
            throw new NotFoundHttpException('Page does not exist');
        }
        $isSubscriptionActive = $this->companyService->isCompanySubscribtionActive($company);

        return $this->render('company/list/form.html.twig', [
            'utilisateurId' => $utilisateurId,
            'urlPrecedente' => $this->urlPrecedente(),
            'companyUrlName' => $slug,
            'isSubscriptionActive' => $isSubscriptionActive
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
