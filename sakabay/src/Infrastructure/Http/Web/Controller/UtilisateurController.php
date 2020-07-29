<?php

namespace App\Infrastructure\Http\Web\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
}
