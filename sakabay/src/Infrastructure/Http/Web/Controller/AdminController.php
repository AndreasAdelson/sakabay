<?php

namespace App\Infrastructure\Http\Web\Controller;

use App\Infrastructure\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class AdminController extends AbstractController
{
    /**
     * @IsGranted("ROLE_ADMIN")
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
    * @Route("/admin/utilisateur", name="user_admin_index")
    */
    public function usersList(UtilisateurRepository $users)
    {
        return $this->render('admin/index.html.twig', [
            'users' => $users->findAll(),
        ]);
    }
}
