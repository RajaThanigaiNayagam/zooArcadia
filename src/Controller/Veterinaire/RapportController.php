<?php

namespace App\Controller\Veterinaire;

use App\Entity\RapportVeterinaire;
use App\Form\RapportVeterinaireType;
use App\Repository\RapportVeterinaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/veterinaire/rapport')]
class RapportController extends AbstractController
{
    #[Route('/', name: 'app_veterinaire_rapport_index', methods: ['GET'])]
    public function index(RapportVeterinaireRepository $rapportVeterinaireRepository): Response
    {
        return $this->render('veterinaire/rapport/index.html.twig', [
            'rapport_veterinaires' => $rapportVeterinaireRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_veterinaire_rapport_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $rapportVeterinaire = new RapportVeterinaire();
        $form = $this->createForm(RapportVeterinaireType::class, $rapportVeterinaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($rapportVeterinaire);
            $entityManager->flush();

            return $this->redirectToRoute('app_veterinaire_rapport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('veterinaire/rapport/new.html.twig', [
            'rapport_veterinaire' => $rapportVeterinaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_veterinaire_rapport_show', methods: ['GET'])]
    public function show(RapportVeterinaire $rapportVeterinaire): Response
    {
        return $this->render('veterinaire/rapport/show.html.twig', [
            'rapport_veterinaire' => $rapportVeterinaire,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_veterinaire_rapport_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RapportVeterinaire $rapportVeterinaire, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RapportVeterinaireType::class, $rapportVeterinaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_veterinaire_rapport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('veterinaire/rapport/edit.html.twig', [
            'rapport_veterinaire' => $rapportVeterinaire,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_veterinaire_rapport_delete', methods: ['POST'])]
    public function delete(Request $request, RapportVeterinaire $rapportVeterinaire, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rapportVeterinaire->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($rapportVeterinaire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_veterinaire_rapport_index', [], Response::HTTP_SEE_OTHER);
    }
}
