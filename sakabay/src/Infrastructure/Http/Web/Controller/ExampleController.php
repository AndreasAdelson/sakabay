<?php

namespace App\Infrastructure\Http\Web\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ExampleController extends AbstractController
{
    /**
     * @Route("/example", name="example_index", methods="GET")
     */
    public function index()
    {
        return $this->render('example/index.html.twig', [
            'controller_name' => 'ExampleController',
        ]);
    }

    /**
     * @Route("/example/new", name="example_new", methods="GET|POST")
     */
    public function new()
    {
        return $this->render('example/new.html.twig', [
            'controller_name' => 'ExampleController',
        ]);
    }

    /**
     * @Route("/example/{id}", name="example_show", methods="GET|POST")
     */
    public function show(int $id)
    {
        return $this->render('example/show.html.twig', [
            'controller_name' => 'ExampleController',
            'exampleId' => $id
        ]);
    }
}
