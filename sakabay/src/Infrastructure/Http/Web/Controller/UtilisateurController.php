<?php

namespace App\Infrastructure\Http\Web\Controller;

use App\Infrastructure\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class UtilisateurController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('utilisateur/index.html.twig', [
            'controller_name' => 'UtilisateurController',
        ]);
    }

    /**
     * @Security("is_granted('ROLE_ADMIN')")
     * @Route("/admin/utilisateur", name="user_admin_index")
     */
    public function usersList(UtilisateurRepository $users)
    {
        return $this->render('admin/index.html.twig', []);
    }

    /**
     * @Security("is_granted('ROLE_ADMIN')")
     * @Route("/admin/utilisateur/edit/{id}", name="user_edit_admin_index")
     */
    public function editUserAdmin(int $id)
    {
        return $this->render('admin/edituser.html.twig', [
            'utilisateurId' => $id,
        ]);
    }

    /**
     * Rajouter le rôle permettant de gérer la modification de son propre profil
     * @Route("/utilisateur/edit/{id}", name="user_edit_admin_index")
     */
    public function editUser(int $id)
    {
        if ($this->getUser()->getId() != $id) {
            throw new AccessDeniedException('Ceci n\'est pas ta page');
        }
        return $this->render('utilisateur/edituser.html.twig', [
            'utilisateurId' => $id,
            'urlPrecedente' => $this->urlPrecedente(),
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
