<?php


namespace App\Infrastructure\Http\Web\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class ValidationController extends AbstractController
{
    /**
     * @Route("admin/email", name="email", methods="GET|POST")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);


        // $contact = $form->getData();

        // On crée le message
        $message = (new \Swift_Message('Nouveau contact'))
            // On attribue l'expéditeur
            ->setFrom("test@noreply.com")
            // On attribue le destinataire
            ->setTo('karii.salman@gmail.com')
            // On crée le texte avec la vue
            ->setBody(
                "test hello symfony 4",
                'text/html'
            );
        $mailer->send($message);

        $this->addFlash('message', 'Votre message a été transmis, nous vous répondrons dans les meilleurs délais.'); // Permet un message flash de renvoi

        return $this->render('contact/index.html.twig', ['contactForm' => $form->createView()]);
    }
}
