<?php

namespace App\Infrastructure\Http\Web\Controller;

use App\Domain\Model\CompanyStatut;
use App\Infrastructure\Repository\CompanyStatutRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class CompanyStatutController extends AbstractController
{

    /**
     * @Route("admin/companystatut", name="company_statut_index", methods="GET")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function index(AuthorizationCheckerInterface $authorizationChecker)
    {
        return $this->render('admin/companystatut/index.html.twig', [
            'canCreate' => $authorizationChecker->isGranted('ROLE_ADMIN'),
            'canRead' => $authorizationChecker->isGranted('ROLE_ADMIN'),
            'canEdit' => $authorizationChecker->isGranted('ROLE_ADMIN'),
            'canDelete' => $authorizationChecker->isGranted('ROLE_ADMIN'),
        ]);
    }

    /**
     * @Route("admin/companystatut/new", name="company_statut_new", methods="GET|POST")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function new()
    {
        return $this->render('admin/companystatut/form.html.twig', [
            'companyStatutId' => 'null'
        ]);
    }

    /**
     * @Route("admin/companystatut/edit/{id}", name="companyStatut_edit", methods="GET|POST")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function edit(int $id)
    {
        return $this->render('admin/companystatut/form.html.twig', [
            'companyStatutId' => $id,
        ]);
    }

    /**
     * @Route("admin/companystatut/show/{id}", name="company_statut_show", methods="GET|POST")
     */
    public function show(int $id, AuthorizationCheckerInterface $authorizationChecker)
    {
        return $this->render('admin/companystatut/show.html.twig', [
            'canEdit' => $authorizationChecker->isGranted('ROLE_ADMIN'),
            'companyStatutId' => $id
        ]);
    }
}
