<?php

namespace App\Controller;

use App\Entity\Jedi;
use App\Form\JediType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class JediController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


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


    #[Route('/jedi/form')]
    public function indexNoLocaleForm(): Response
    {
        return $this->redirectToRoute('form_jedi', ['_locale' => 'en']);
    }


    #[Route('/{_locale<%app.supported_locales%>}/jedi/form', name: 'form_jedi', methods: ['GET', 'POST'])]
    public function creation(Request $request): Response
    {
        $jedi = new Jedi();
        $form = $this->createForm(JediType::class, $jedi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $this->entityManager->persist($jedi);
            $this->entityManager->flush();
    
            $this->addFlash('success', 'Jedi crée avec succès !');
            return $this->redirectToRoute('app_jedi');
        }
    
        return $this->render('jedi/form.html.twig', [
            'jedi' => $jedi,
            'form' => $form->createView()
        ]);
    }
}
