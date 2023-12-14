<?php

namespace App\Controller;

use App\Entity\Padawan;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PadawanController extends AbstractController
{
    #[Route('/padawan', name: 'app_padawan')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $padawans = $entityManager->getRepository(Padawan::class)->findAll();

        return $this->render('padawan/index.html.twig', [
            'controller_name' => 'PadawanController',
            "padawans" => $padawans
        ]);
    }
}
