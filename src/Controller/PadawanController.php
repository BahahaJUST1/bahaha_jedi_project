<?php

namespace App\Controller;

use App\Entity\Padawan;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PadawanController extends AbstractController
{
    #[Route('/padawan')]
    public function indexNoLocale(): Response
    {
        return $this->redirectToRoute('app_padawan', ['_locale' => 'en']);
    }

    #[Route('/{_locale<%app.supported_locales%>}/padawan', name: 'app_padawan')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $padawans = $entityManager->getRepository(Padawan::class)->findAll();

        return $this->render('padawan/index.html.twig', [
            'controller_name' => 'PadawanController',
            "padawans" => $padawans
        ]);
    }
}
