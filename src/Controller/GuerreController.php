<?php

namespace App\Controller;

use App\Entity\Guerre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GuerreController extends AbstractController
{
    #[Route('/guerre')]
    public function indexNoLocale(): Response
    {
        return $this->redirectToRoute('app_guerre', ['_locale' => 'en']);
    }

    #[Route('/{_locale<%app.supported_locales%>}/guerre', name: 'app_guerre')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $guerres = $entityManager->getRepository(Guerre::class)->findAll();

        return $this->render('guerre/index.html.twig', [
            'controller_name' => 'GuerreController',
            "guerres" => $guerres
        ]);
    }
}
