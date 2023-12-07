<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SabreLaserController extends AbstractController
{
    #[Route('/sabre-laser', name: 'app_sabre_laser')]
    public function index(): Response
    {
        return $this->render('sabre_laser/index.html.twig', [
            'controller_name' => 'SabreLaserController',
        ]);
    }
}
