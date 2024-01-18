<?php

namespace App\Controller;

use App\Entity\Legion;
use App\Form\LegionType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LegionCloneController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/legion-clone')]
    public function indexNoLocale(): Response
    {
        return $this->redirectToRoute('app_legion_clone', ['_locale' => 'en']);
    }

    #[Route('/{_locale<%app.supported_locales%>}/legion-clone', name: 'app_legion_clone')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $legions = $entityManager->getRepository(Legion::class)->findAll();

        return $this->render('legion_clone/index.html.twig', [
            'controller_name' => 'LegionCloneController',
            "legions" => $legions
        ]);
    }


    #[Route('/legion-clone/form')]
    public function indexNoLocaleForm(): Response
    {
        return $this->redirectToRoute('form_legion', ['_locale' => 'en']);
    }


    #[Route('/{_locale<%app.supported_locales%>}/legion-clone/form', name: 'form_legion', methods: ['GET', 'POST'])]
    public function creation(Request $request): Response
    {
        $legion = new Legion();
        $form = $this->createForm(LegionType::class, $legion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            foreach ($legion->getGeneraux() as $generaux) {
                $generaux->setLegion($legion);
                $this->entityManager->persist($generaux);
            }

            $this->entityManager->persist($legion);
            $this->entityManager->flush();
    
            $this->addFlash('success', 'Légion créée avec succès !');
            return $this->redirectToRoute('app_legion_clone');
        }
    
        return $this->render('legion_clone/form.html.twig', [
            'legion' => $legion,
            'form' => $form->createView()
        ]);
    }
}
