<?php

namespace App\Controller;

use App\Entity\Sabre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SabreLaserController extends AbstractController
{
    #[Route('/sabre-laser', name: 'app_sabre_laser')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $sabres = $entityManager->getRepository(Sabre::class)->findAll();

        return $this->render('sabre_laser/index.html.twig', [
            'controller_name' => 'SabreLaserController',
            "sabres" => $sabres
        ]);
    }
}
