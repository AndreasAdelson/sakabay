<?php

namespace App\Infrastructure\Http\Web\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class GroupController extends AbstractController
{
    /**
     * @Route("/group", name="group_index", methods="GET")
     */
    public function index()
    {
        return $this->render('group/index.html.twig', [
            'controller_name' => 'GroupController',
        ]);
    }

    /**
     * @Route("/group/new", name="group_new", methods="GET|POST")
     */
    public function new()
    {
        return $this->render('group/new.html.twig', [
            'controller_name' => 'GroupController',
        ]);
    }

    /**
     * @Route("/group/{id}", name="group_show", methods="GET|POST")
     */
    public function show(int $id)
    {
        return $this->render('group/show.html.twig', [
            'controller_name' => 'GroupController',
            'groupId' => $id
        ]);
    }
}
