<?php

namespace App\Controller;

use App\Entity\Guerre;
use App\Form\GuerreType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GuerreController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

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


    #[Route('/guerre/form')]
    public function indexNoLocaleForm(): Response
    {
        return $this->redirectToRoute('form_guerre', ['_locale' => 'en']);
    }


    #[Route('/{_locale<%app.supported_locales%>}/guerre/form', name: 'form_guerre', methods: ['GET', 'POST'])]
    public function creation(Request $request): Response
    {
        $guerre = new Guerre();
        $form = $this->createForm(GuerreType::class, $guerre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            foreach ($guerre->getCombattants() as $combattant) {
                $combattant->addGuerre($guerre);
                $this->entityManager->persist($combattant);
            }
            
            $this->entityManager->persist($guerre);
            $this->entityManager->flush();
    
            $this->addFlash('success', 'Guerre créée avec succès, vous êtes fier de vous ?');
            return $this->redirectToRoute('app_guerre');
        }
    
        return $this->render('guerre/form.html.twig', [
            'guerre' => $guerre,
            'form' => $form->createView()
        ]);
    }
}
