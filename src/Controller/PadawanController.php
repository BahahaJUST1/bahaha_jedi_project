<?php

namespace App\Controller;

use App\Entity\Padawan;
use App\Form\PadawanType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PadawanController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/padawan')]
    public function indexNoLocale(): Response
    {
        return $this->redirectToRoute('app_padawan', ['_locale' => 'en']);
    }

    #[Route('/{_locale<%app.supported_locales%>}/padawan', name: 'app_padawan')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $padawans = $entityManager->getRepository(Padawan::class)->findAll();

        return $this->render('padawan/index.html.twig', [
            'controller_name' => 'PadawanController',
            "padawans" => $padawans
        ]);
    }


    #[Route('/padawan/form')]
    public function indexNoLocaleForm(): Response
    {
        return $this->redirectToRoute('form_padawan', ['_locale' => 'en']);
    }


    #[Route('/{_locale<%app.supported_locales%>}/padawan/form', name: 'form_padawan', methods: ['GET', 'POST'])]
    public function creation(Request $request): Response
    {
        $padawan = new Padawan();
        $form = $this->createForm(PadawanType::class, $padawan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $padawan->getMaitre()->setPadawan($padawan);
            
            $this->entityManager->persist($padawan);
            $this->entityManager->flush();
    
            $this->addFlash('success', 'Padawan crée avec succès !');
            return $this->redirectToRoute('app_padawan');
        }
    
        return $this->render('padawan/form.html.twig', [
            'padawan' => $padawan,
            'form' => $form->createView()
        ]);
    }


    #[Route('/padawan/modif/{id}', name: 'app_padawan_index_modif', methods: ['GET'])]
    public function indexNoLocaleModif(int $id): Response
    {
        return $this->redirectToRoute('modif_padawan', ['_locale' => 'en', 'id' => $id]);
    }


    #[Route('/{_locale<%app.supported_locales%>}/padawan/modif/{id}', name: 'modif_padawan', methods: ['GET', 'POST'])]
    public function update(int $id, Request $request): Response
    {
        $padawan = $this->entityManager->getRepository(Padawan::class)->find($id);

        if (!$padawan) {
            throw $this->createNotFoundException('Padawan non trouvée');
        }

        $oldMaster = $padawan->getMaitre();

        $form = $this->createForm(PadawanType::class, $padawan);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $oldMaster->removePadawan();
            $padawan->getMaitre()->setPadawan($padawan);
            
            $this->entityManager->persist($padawan);
            $this->entityManager->flush();

            $this->addFlash('success', 'Padawan modifié avec succès !');
            return $this->redirectToRoute('app_padawan');
        }

        return $this->render('padawan/modif.html.twig', [
            'padawan' => $padawan,
            'form' => $form->createView()
        ]);
    }
}
