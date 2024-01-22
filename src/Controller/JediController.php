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


    #[Route('/jedi/modif/{id}', name: 'app_jedi_index_modif', methods: ['GET'])]
    public function indexNoLocaleModif(int $id): Response
    {
        return $this->redirectToRoute('modif_jedi', ['_locale' => 'en', 'id' => $id]);
    }


    #[Route('/{_locale<%app.supported_locales%>}/jedi/modif/{id}', name: 'modif_jedi', methods: ['GET', 'POST'])]
    public function update(int $id, Request $request): Response
    {
        $jedi = $this->entityManager->getRepository(Jedi::class)->find($id);

        if (!$jedi) {
            throw $this->createNotFoundException('Jedi non trouvée');
        }

        // Avant la modification, sauvegardez l'ancien Padawan
        $ancienPadawan = $jedi->getPadawan();

        $form = $this->createForm(JediType::class, $jedi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Si le Padawan associé au Jedi a changé
            if ($ancienPadawan !== $jedi->getPadawan()) {
                // Retirez le Jedi de l'ancien Padawan
                if ($ancienPadawan) {
                    $ancienPadawan->removeMaitre();
                    $this->entityManager->persist($ancienPadawan);
                }
                // Ajoutez le Jedi au nouveau Padawan
                $nouveauPadawan = $jedi->getPadawan();
                if ($nouveauPadawan) {
                    $nouveauPadawan->setMaitre($jedi);
                    $this->entityManager->persist($nouveauPadawan);
                }
            }

            $this->entityManager->persist($jedi);
            $this->entityManager->flush();

            $this->addFlash('success', 'Jedi modifié avec succès !');
            return $this->redirectToRoute('app_jedi');
        }

        return $this->render('jedi/modif.html.twig', [
            'jedi' => $jedi,
            'form' => $form->createView()
        ]);
    }

}
