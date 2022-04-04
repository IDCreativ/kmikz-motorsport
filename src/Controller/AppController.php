<?php

namespace App\Controller;

use Symfony\Component\Mime\Address;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AppController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('app/index.html.twig', [
            'controller_name' => 'AppController',
        ]);
    }

    /**
     * @Route("/modeles", name="modeles")
     */
    public function modeles(): Response
    {
        $controller_name = "Modèle";
        $message_flash = "Ceci est un message Flash !";

        $this->addFlash('success', $message_flash);
        return $this->render('__modeles/index.html.twig', [
            'controller_name' => $controller_name,
        ]);
    }

    /**
     * @Route("/test-email", name="test_email")
     */
    public function testEmail(MailerInterface $mailer): Response
    {
        $email = (new TemplatedEmail())
                ->from('no-reply@kmikz-motorsport.fr')
                ->to(new Address('aka.sk3ud@gmail.com'))
                ->subject('Demande de Rendez-vous')
                ->htmlTemplate('emails/email-test.html.twig')
                ->context([
                    'appointment' => 'coucou'
            ]);

            $mailer->send($email);

            $this->addFlash('success', 'Votre rendez-vous a bien été pris en compte. Un e-mail contenant les informations de votre demande de rendez-vous vous a été envoyé.');
            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
    }
}
