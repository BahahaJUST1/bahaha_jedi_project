<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LogoutController extends AbstractController
{
    #[Route('/logout')]
    public function indexNoLocale(): Response
    {
        return $this->redirectToRoute('app_logout', ['_locale' => 'en']);
    }

    #[Route('/{_locale<%app.supported_locales%>}/logout', name: 'app_logout')]
    public function index(): Response
    {
        return $this->render('logout/index.html.twig', [
            'controller_name' => 'LogoutController',
        ]);
    }
}
