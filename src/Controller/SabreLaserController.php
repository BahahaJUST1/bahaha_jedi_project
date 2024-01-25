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


    #[Route('/sabre-laser/modif/{id}', name: 'app_sabre_index_modif', methods: ['GET'])]
    public function indexNoLocaleModif(int $id): Response
    {
        return $this->redirectToRoute('modif_sabre', ['_locale' => 'en', 'id' => $id]);
    }


    #[Route('/{_locale<%app.supported_locales%>}/sabre-laser/modif/{id}', name: 'modif_sabre', methods: ['GET', 'POST'])]
    public function update(int $id, Request $request): Response
    {
        $sabre = $this->entityManager->getRepository(Sabre::class)->find($id);

        if (!$sabre) {
            throw $this->createNotFoundException('Sabre non trouvée');
        }

        $form = $this->createForm(SabreType::class, $sabre);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $this->entityManager->persist($sabre);
            $this->entityManager->flush();

            $this->addFlash('success', 'Sabre modifiée avec succès !');
            return $this->redirectToRoute('app_sabre_laser');
        }

        return $this->render('sabre_laser/modif.html.twig', [
            'sabre' => $sabre,
            'form' => $form->createView(),
            'urlId' => $id
        ]);
    }


    #[Route('/sabre-laser/delete/{id}', methods: ['GET'])]
    public function indexNoLocaleDelete(int $id): Response
    {
        return $this->redirectToRoute('delete_sabre', ['_locale' => 'en', 'id' => $id]);
    }


    #[Route('/{_locale<%app.supported_locales%>}/sabre-laser/delete/{id}', name: 'delete_sabre', methods: ['GET', 'POST'])]
    public function delete(int $id): Response
    {
        $sabre = $this->entityManager->getRepository(Sabre::class)->find($id);

        if (!$sabre) {
            throw $this->createNotFoundException('Sabre non trouvée');
        }

        $sabre->getProprietaire()->removeSabre($sabre);
            
        $this->entityManager->remove($sabre);
        $this->entityManager->flush();

        $this->addFlash('success', 'Sabre supprimé avec succès !');
        return $this->redirectToRoute('app_sabre_laser');
    }
}
