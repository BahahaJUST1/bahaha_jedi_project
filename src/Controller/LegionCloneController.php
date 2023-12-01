<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LegionCloneController extends AbstractController
{
    #[Route('/legion/clone', name: 'app_legion_clone')]
    public function index(): Response
    {
        return $this->render('legion_clone/index.html.twig', [
            'controller_name' => 'LegionCloneController',
        ]);
    }
}
