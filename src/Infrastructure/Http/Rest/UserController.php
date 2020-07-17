<?php

namespace App\Infrastructure\Http\Rest\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends FOSRestController
{
    public function __construct() {
    }
    /**
     * @Rest\View()
     * @Rest\Post("/user")
     *
     * 
     */
     public function saveUser(Request $request): View
     {
         $user = new User();
         $form = $this->createForm(UserType::class, $user);
         $form->submit($request->request->all());

         if (!$form->isValid()) {
            dump($user); 
             return View::create($form, Response::HTTP_BAD_REQUEST);
         }
         dump($user); 
         //return View::create([], Response::HTTP_CREATED);
     }
}

