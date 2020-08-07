<?php

namespace App\Infrastructure\Http\Rest\Controller;

use App\Application\Form\Type\EditUtilisateurType;
use App\Application\Service\UtilisateurService;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\Translation\TranslatorInterface;

final class UtilisateurController extends AbstractFOSRestController
{
    private $entityManager;
    private $utilisateurService;
    private $translator;

    /**
     * UtilisateurRestController constructor.
     */
    public function __construct(EntityManagerInterface $entityManager, UtilisateurService $utilisateurService, TranslatorInterface $translator)
    {
        $this->entityManager = $entityManager;
        $this->translator = $translator;
        $this->utilisateurService = $utilisateurService;
    }

    // /**
    //  * @Rest\View()
    //  * @Rest\Post("/utilisateurs")
    //  * @param Request $request
    //  *
    //  * @return View
    //  */
    // public function createUtilisateur(Request $request): View
    // {
    //     $utilisateur = $this->utilisateurService->addUtillisateur($request->get('nom'), $request->get('consigne'));
    //     // $formOptions = ['translator' => $this->translator]

    //     return View::create($utilisateur, Response::HTTP_CREATED);
    // }

    /**
     * @Rest\View(serializerGroups={"api_utilisateurs"})
     * @Rest\Get("/admin/utilisateurs")
     *
     * @return View
     */
    public function getUtilisateurs(): View
    {
        $utilisateur = $this->utilisateurService->getAllUtilisateurs();

        return View::create($utilisateur, Response::HTTP_OK);
    }

    /**
     * @Rest\View(serializerGroups={"api_utilisateurs"})
     * @Rest\Get("/admin/utilisateurs/{utilisateurId}")
     *
     * @return View
     */
    public function getUtilisateur(int $utilisateurId): View
    {
        $utilisateur = $this->utilisateurService->getUtilisateur($utilisateurId);

        return View::create($utilisateur, Response::HTTP_OK);
    }

    /**
     * @Rest\View()
     * @Rest\Post("/admin/utilisateurs/{utilisateurId}")
     *
     * @return View
     */
    public function editUtilisateurs(int $utilisateurId, Request $request)
    {
        $utilisateur = $this->utilisateurService->getUtilisateur($utilisateurId);

        if (!$utilisateur) {
            throw new EntityNotFoundException('Utilisateur with id ' . $utilisateurId . ' does not exist!');
        }

        $formOptions = [
            'translator' => $this->translator,
        ];
        $form = $this->createForm(EditUtilisateurType::class, $utilisateur, $formOptions);
        $form->submit($request->request->all());
        if (!$form->isValid()) {
            return $form;
        }
        $this->entityManager->persist($utilisateur);
        $this->entityManager->flush($utilisateur);

        $ressourceLocation = $this->generateUrl('user_admin_index');
        return View::create([], Response::HTTP_NO_CONTENT, ['Location' => $ressourceLocation]);
    }

    /**
     * @Rest\View()
     * @Rest\Delete("/admin/utilisateurs/{utilisateurId}")
     *
     * @return View
     */
    public function deleteUtilisateurs(int $utilisateurId): View
    {
        $utilisateur = $this->utilisateurService->deleteUtilisateur($utilisateurId);

        return View::create($utilisateur, Response::HTTP_NO_CONTENT);
    }
}
