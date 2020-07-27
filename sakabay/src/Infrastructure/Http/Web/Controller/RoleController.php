<?php

namespace App\Infrastructure\Http\Web\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RoleController extends AbstractController
{
    /**
     * @Route("/role", name="role_index", methods="GET")
     */
    public function index()
    {
        return $this->render('role/index.html.twig', [
            'controller_name' => 'RoleController',
        ]);
    }

    /**
     * @Route("/role/new", name="role_new", methods="GET|POST")
     */
    public function new()
    {
        return $this->render('role/new.html.twig', [
            'controller_name' => 'RoleController',
        ]);
    }

    /**
     * @Route("/role/{id}", name="role_show", methods="GET|POST")
     */
    public function show(int $id)
    {
        return $this->render('role/show.html.twig', [
            'controller_name' => 'RoleController',
            'roleId' => $id
        ]);
    }
}
