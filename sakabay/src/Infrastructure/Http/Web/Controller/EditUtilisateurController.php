<?php

namespace App\Infrastructure\Http\Web\Controller;

use App\Domain\Model\Utilisateur;
use EXSyst\Component\Swagger\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EditUtilisateurController extends AbstractController
{
/**
 * @Route("/admin/utilisateur/edit/{id}", name="modifier_utilisateur")
 */
public function editUser(Utilisateur $user, Response $request)
{
    $form = $this->createForm(EditUserType::class, $user);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash('message', 'Utilisateur modifié avec succès');
        return $this->redirectToRoute('admin_utilisateurs');
    }

    return $this->render('admin/edituser.html.twig', [
        'userForm' => $form->createView(),
    ]);
}
}
