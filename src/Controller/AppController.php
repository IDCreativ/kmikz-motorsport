<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
}
