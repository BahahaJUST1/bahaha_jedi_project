<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PadawanController extends AbstractController
{
    #[Route('/padawan', name: 'app_padawan')]
    public function index(): Response
    {
        return $this->render('padawan/index.html.twig', [
            'controller_name' => 'PadawanController',
        ]);
    }
}
