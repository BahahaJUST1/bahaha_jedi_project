<?php

namespace App\Controller;

use App\Entity\Jedi;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class JediController extends AbstractController
{
    #[Route('/jedi')]
    public function indexNoLocale(): Response
    {
        return $this->redirectToRoute('app_jedi', ['_locale' => 'en']);
    }

    #[Route('/{_locale<%app.supported_locales%>}/jedi', name: 'app_jedi')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $jedis = $entityManager->getRepository(Jedi::class)->findAll();

        return $this->render('jedi/index.html.twig', [
            'controller_name' => 'JediController',
            "jedis" => $jedis
        ]);
    }
}
