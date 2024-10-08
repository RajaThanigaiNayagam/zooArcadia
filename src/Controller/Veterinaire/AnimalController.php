<?php

namespace App\Controller\Veterinaire;

use App\Entity\Animal;
use App\Form\Animal1Type;
use App\Repository\AnimalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/veterinaire/animal')]
class AnimalController extends AbstractController
{
    #[Route('/', name: 'app_veterinaire_animal_index', methods: ['GET'])]
    public function index(AnimalRepository $animalRepository, Request $request): Response
    {
        $page = $request->query->getint('page', 1);
        if ( $request->query->getint('limit') ){ $limit = $request->query->getint('limit'); }else{$limit = $request->query->getint('limit', 3);}
        
        $animal = $animalRepository->paginateAnimal($page, $limit);
        $maxPage = ceil( $animal->getTotalItemCount() / $limit );
        
        return $this->render('veterinaire/animal/index.html.twig', [
            'animals' => $animal,
            'maxPage' => $maxPage,
            'page' => $page,
        ]);
    }

    #[Route('/new', name: 'app_veterinaire_animal_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $animal = new Animal();
        $form = $this->createForm(Animal1Type::class, $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($animal);
            $entityManager->flush();

            return $this->redirectToRoute('app_veterinaire_animal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('veterinaire/animal/new.html.twig', [
            'animal' => $animal,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_veterinaire_animal_show', methods: ['GET'])]
    public function show(Animal $animal): Response
    {
        return $this->render('veterinaire/animal/show.html.twig', [
            'animal' => $animal,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_veterinaire_animal_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Animal $animal, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(Animal1Type::class, $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_veterinaire_animal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('veterinaire/animal/edit.html.twig', [
            'animal' => $animal,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_veterinaire_animal_delete', methods: ['POST'])]
    public function delete(Request $request, Animal $animal, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$animal->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($animal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_veterinaire_animal_index', [], Response::HTTP_SEE_OTHER);
    }
}
