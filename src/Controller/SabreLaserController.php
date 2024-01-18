<?php

namespace App\Controller;

use App\Entity\Sabre;
use App\Form\SabreType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SabreLaserController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/sabre-laser')]
    public function indexNoLocale(): Response
    {
        return $this->redirectToRoute('app_sabre_laser', ['_locale' => 'en']);
    }

    #[Route('/{_locale<%app.supported_locales%>}/sabre-laser', name: 'app_sabre_laser')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $sabres = $entityManager->getRepository(Sabre::class)->findAll();

        return $this->render('sabre_laser/index.html.twig', [
            'controller_name' => 'SabreLaserController',
            "sabres" => $sabres
        ]);
    }


    #[Route('/sabre-laser/form')]
    public function indexNoLocaleForm(): Response
    {
        return $this->redirectToRoute('form_sabre', ['_locale' => 'en']);
    }

    #[Route('/{_locale<%app.supported_locales%>}/sabre-laser/form', name: 'form_sabre', methods: ['GET', 'POST'])]
    public function creation(Request $request): Response
    {
        $sabre = new Sabre();
        $form = $this->createForm(SabreType::class, $sabre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            foreach ($sabre->getProprietaire() as $proprio) {
                $proprio->addSabre($sabre);
                $this->entityManager->persist($proprio);
            }
            
            $this->entityManager->persist($sabre);
            $this->entityManager->flush();
    
            $this->addFlash('success', 'Sabre créé avec succès !');
            return $this->redirectToRoute('app_sabre_laser');
        }
    
        return $this->render('sabre_laser/form.html.twig', [
            'sabre' => $sabre,
            'form' => $form->createView()
        ]);
    }
}
