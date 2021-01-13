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
     * CompanyRestController constructor.
     */
    public function __construct(CompanyService $companyService)
    {
        $this->companyService = $companyService;
    }
    /**
     * @Route("entreprises/list", name="company_subscribed_index", methods="GET")
     */
    public function listIndex()
    {
        return $this->render('company/list.html.twig', []);
    }

    /**
     * @Route("entreprise", name="company_register_index", methods="GET")
     */
    public function registerIndex(AuthorizationCheckerInterface $authorizationChecker)
    {
        return $this->render('company/index.html.twig', []);
    }

    /**
     * @Route("entreprise/{slug}", name="company_show", methods="GET")
     */
    public function show(string $slug)
    {
        $company = $this->companyService->getCompanyByUrlName($slug);
        if (!$company) {
            throw new NotFoundHttpException('Company with url_name ' . $slug . ' does not exist!');
        } else if ($company->getCompanystatut()->getCode() == "ENC") {
            throw $this->createNotFoundException("This company does not exist");
        }
        $titlePage = ucfirst(str_replace('-', ' ', $slug));
        return $this->render('company/show.html.twig', [
            'companyUrlName' => $slug,
            'titlePage' => $titlePage
        ]);
    }

    /**
     * @Route("admin/entreprise", name="company_subscribed_index", methods="GET")
     */
    public function subscribedIndex(AuthorizationCheckerInterface $authorizationChecker)
    {
        return $this->render('admin/company/subscribed/subscribed_index.html.twig', [
            'canEdit' => $authorizationChecker->isGranted('ROLE_UCOMPANY'),
            'canDelete' => $authorizationChecker->isGranted('ROLE_DCOMPANY'),
            'canRead' => $authorizationChecker->isGranted('ROLE_RCOMPANY')
        ]);
    }

    /**
     * @Route("admin/registered/entreprise", name="company_registered_index", methods="GET")
     */
    public function registeredIndex(AuthorizationCheckerInterface $authorizationChecker)
    {
        return $this->render('admin/company/registered/registered_index.html.twig', [
            'canEdit' => $authorizationChecker->isGranted('ROLE_UCOMPANY'),
            'canDelete' => $authorizationChecker->isGranted('ROLE_DCOMPANY'),
            'canRead' => $authorizationChecker->isGranted('ROLE_RCOMPANY')
        ]);
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
     * @Route("admin/entreprise/edit/{id}", name="company_edit", methods="GET|POST")
     */
    public function editSubscribed(int $id)
    {
        return $this->render('admin/company/subscribed/subscribed_form.html.twig', [
            'companyId' => $id,
            'isValidated' => true,
            'urlPrecedente' => $this->urlPrecedente()
        ]);
    }

    /**
     * @Route("admin/entreprise/{id}", name="company_show", methods="GET")
     */
    public function showSubscribed(int $id, AuthorizationCheckerInterface $authorizationChecker)
    {
        return $this->render('admin/company/subscribed/subscribed_show.html.twig', [
            'companyId' => $id,
            'canEdit' => $authorizationChecker->isGranted('ROLE_UCOMPANY'),
            'urlPrecedente' => $this->urlPrecedente()
        ]);
    }

    /**
     * @Route("admin/registered/entreprise/edit/{id}", name="company_edit", methods="GET|POST")
     */
    public function editRegistered(int $id)
    {
        return $this->render('admin/company/registered/registered_form.html.twig', [
            'companyId' => $id,
            'isValidated' => false,
            'urlPrecedente' => $this->urlPrecedente()
        ]);
    }


    /**
     * @Route("admin/registered/entreprise/{id}", name="company_show", methods="GET")
     */
    public function showRegistered(int $id, AuthorizationCheckerInterface $authorizationChecker)
    {
        return $this->render('admin/company/registered/registered_show.html.twig', [
            'companyId' => $id,
            'canEdit' => $authorizationChecker->isGranted('ROLE_UCOMPANY'),
            'urlPrecedente' => $this->urlPrecedente()
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
