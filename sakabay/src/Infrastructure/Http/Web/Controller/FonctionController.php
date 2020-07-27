<?php

namespace App\Infrastructure\Http\Web\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FonctionController extends AbstractController
{
    /**
     * @Route("/fonction", name="fonction_index", methods="GET")
     */
    public function index()
    {
        return $this->render('fonction/index.html.twig', [
            'controller_name' => 'FonctionController',
        ]);
    }

    /**
     * @Route("/fonction/new", name="fonction_new", methods="GET|POST")
     */
    public function new()
    {
        return $this->render('fonction/new.html.twig', [
            'controller_name' => 'FonctionController',
        ]);
    }

    /**
     * @Route("/fonction/{id}", name="fonction_show", methods="GET|POST")
     */
    public function show(int $id)
    {
        return $this->render('fonction/show.html.twig', [
            'controller_name' => 'FonctionController',
            'fonctionId' => $id
        ]);
    }
}
