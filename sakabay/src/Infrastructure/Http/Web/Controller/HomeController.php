<?php

namespace App\Infrastructure\Http\Web\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        $words = [
            'sky', 'cloud', 'wood', 'rock', 'forest',
            'mountain', 'breeze'
        ];

        return $this->render('user/home.html.twig', [
            'words' => $words,
            'controller_name' => 'HomeController',
        ]);
    }
}
