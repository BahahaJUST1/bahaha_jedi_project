<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MenuController extends AbstractController
{
    #[Route('/menu')]
    public function indexNoLocale(): Response
    {
        return $this->redirectToRoute('app_menu', ['_locale' => 'en']);
    }

    #[Route('/{_locale<%app.supported_locales%>}/menu', name: 'app_menu')]
    public function index(): Response
    {
        return $this->render('menu/index.html.twig', [
            'controller_name' => 'MenuController',
        ]);
    }
}
