<?php

namespace App\Controller;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends AbstractController
{
    #[Route('/user')]
    public function indexNoLocale(): Response
    {
        return $this->redirectToRoute('app_user', ['_locale' => 'en']);
    }

    #[Route('/{_locale<%app.supported_locales%>}/user', name: 'app_user')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $users = $entityManager->getRepository(User::class)->findAll();

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            "users" => $users
        ]);
    }
}
