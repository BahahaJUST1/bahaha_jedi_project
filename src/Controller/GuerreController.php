<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GuerreController extends AbstractController
{
    #[Route('/guerre', name: 'app_guerre')]
    public function index(): Response
    {
        return $this->render('guerre/index.html.twig', [
            'controller_name' => 'GuerreController',
        ]);
    }
}
