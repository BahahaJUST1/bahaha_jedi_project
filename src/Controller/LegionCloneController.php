<?php

namespace App\Controller;

use App\Entity\Jedi;
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



    #[Route('/legion-clone/modif/{id}', name: 'app_legion_index_modif', methods: ['GET'])]
    public function indexNoLocaleModif(int $id): Response
    {
        return $this->redirectToRoute('modif_legion', ['_locale' => 'en', 'id' => $id]);
    }


    #[Route('/{_locale<%app.supported_locales%>}/legion-clone/modif/{id}', name: 'modif_legion', methods: ['GET', 'POST'])]
    public function update(int $id, Request $request): Response
    {
        $legion = $this->entityManager->getRepository(Legion::class)->find($id);

        if (!$legion) {
            throw $this->createNotFoundException('Legion non trouvée');
        }

        // on récupère les generaux qui étaient en charge de la légion avant la modif
        $generauxAvant = $legion->getGeneraux()->map(fn($jedi) => $jedi->getId())->toArray();

        $form = $this->createForm(LegionType::class, $legion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // on récupère les generaux qui sont en charge de la légion après la modif
            $generauxApres = $legion->getGeneraux()->map(fn($jedi) => $jedi->getId())->toArray();
  
            // on récupère uniquement les jedis qui ont été décochés
            $generauxSupprimes = array_diff($generauxAvant, $generauxApres);

            // on les retire de la legion
            foreach ($generauxSupprimes as $generalId) {
                $general = $this->entityManager->getReference(Jedi::class, $generalId);
                $legion->removeGeneraux($general);
                $general->removeLegion();
                $this->entityManager->persist($general);
            }

            foreach ($legion->getGeneraux() as $general) {
                $general->setLegion($legion);
                $this->entityManager->persist($general);
            }
            
            $this->entityManager->persist($legion);
            $this->entityManager->flush();

            $this->addFlash('success', 'Légion modifiée avec succès !');
            return $this->redirectToRoute('app_legion_clone');
        }

        return $this->render('legion_clone/modif.html.twig', [
            'legion' => $legion,
            'form' => $form->createView(),
            'urlId' => $id
        ]);
    }


    #[Route('/legion-clone/delete/{id}', methods: ['GET'])]
    public function indexNoLocaleDelete(int $id): Response
    {
        return $this->redirectToRoute('delete_legion', ['_locale' => 'en', 'id' => $id]);
    }


    #[Route('/{_locale<%app.supported_locales%>}/legion-clone/delete/{id}', name: 'delete_legion', methods: ['GET', 'POST'])]
    public function delete(int $id): Response
    {
        $legion = $this->entityManager->getRepository(Legion::class)->find($id);

        if (!$legion) {
            throw $this->createNotFoundException('Legion non trouvée');
        }

        // on récupère les generaux qui étaient en charge de la légion avant la modif
        $generauxAvant = $legion->getGeneraux()->map(fn($jedi) => $jedi->getId())->toArray();

        // si on a trouvé des combattants
        if ($generauxAvant != []) {
            // on les retire de la legion
            foreach ($generauxAvant as $generalId) {
                $general = $this->entityManager->getReference(Jedi::class, $generalId);
                $legion->removeGeneraux($general);
                $general->removeLegion();
                $this->entityManager->persist($general);
            }
        }
        
        // suppression de l'entité
        $this->entityManager->remove($legion);
        $this->entityManager->flush();

        $this->addFlash('success', 'Légion supprimée avec succès !');
        return $this->redirectToRoute('app_legion_clone');
    }
}
