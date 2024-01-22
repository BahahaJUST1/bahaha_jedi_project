<?php

namespace App\Controller;

use App\Entity\Guerre;
use App\Entity\Jedi;
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


    #[Route('/guerre/modif/{id}', name: 'app_guerre_index_modif', methods: ['GET'])]
    public function indexNoLocaleModif(int $id): Response
    {
        return $this->redirectToRoute('modif_guerre', ['_locale' => 'en', 'id' => $id]);
    }


    #[Route('/{_locale<%app.supported_locales%>}/guerre/modif/{id}', name: 'modif_guerre', methods: ['GET', 'POST'])]
    public function update(int $id, Request $request): Response
    {
        $guerre = $this->entityManager->getRepository(Guerre::class)->find($id);

        if (!$guerre) {
            throw $this->createNotFoundException('Guerre non trouvée');
        }

        // on récupère les jedis qui étaient en guerre sur la planète avant la modif
        $combattantsAvant = $guerre->getCombattants()->map(fn($jedi) => $jedi->getId())->toArray();

        $form = $this->createForm(GuerreType::class, $guerre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // on récupère les jedis qui sont en guerre sur la planète après la modif
            $combattantsApres = $guerre->getCombattants()->map(fn($jedi) => $jedi->getId())->toArray();
  
            // on récupère uniquement les jedis qui ont été décochés
            $combattantsSupprimes = array_diff($combattantsAvant, $combattantsApres);

            // on les retire de la guerre
            foreach ($combattantsSupprimes as $combattantId) {
                $combattant = $this->entityManager->getReference(Jedi::class, $combattantId);
                $guerre->removeCombattant($combattant);
                $combattant->removeGuerre($guerre);
                $this->entityManager->persist($combattant);
            }

            foreach ($guerre->getCombattants() as $combattant) {
                $combattant->addGuerre($guerre);
                $this->entityManager->persist($combattant);
            }
            
            $this->entityManager->persist($guerre);
            $this->entityManager->flush();

            $this->addFlash('success', 'Guerre modifiée avec succès, vous êtes fier de vous ?');
            return $this->redirectToRoute('app_guerre');
        }

        return $this->render('guerre/modif.html.twig', [
            'guerre' => $guerre,
            'form' => $form->createView()
        ]);
    }
}
