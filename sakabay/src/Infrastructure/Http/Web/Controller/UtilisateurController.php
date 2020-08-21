<?php

namespace App\Infrastructure\Http\Web\Controller;

use App\Domain\Model\Utilisateur;
use App\Infrastructure\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class UtilisateurController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        $words = [
            'sky', 'cloud', 'wood', 'rock', 'forest',
            'mountain', 'breeze'
        ];
        return $this->render('utilisateur/index.html.twig', [
            'words' => $words,
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
