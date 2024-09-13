<?php

namespace App\Controller\Admin;

use App\Entity\Animal;
use App\Entity\Race;
use App\Form\AnimalType;
use App\Form\AnimalEditType;
use App\Repository\AnimalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/animal')]
class AnimalController extends AbstractController
{
    #[Route('/', name: 'app_admin_animal_index', methods: ['GET'])]
    public function index(AnimalRepository $animalRepository, Request $request): Response
    {
        $page = $request->query->getint('page', 1);
        if ( $request->query->getint('limit') ){ $limit = $request->query->getint('limit'); }else{$limit = $request->query->getint('limit', 3);}
        
        $animal = $animalRepository->paginateAnimal($page, $limit);
        $maxPage = ceil( $animal->getTotalItemCount() / $limit );
        
        return $this->render('admin/animal/index.html.twig', [
            'animals' => $animal,
            'maxPage' => $maxPage,
            'page' => $page,
            'logo' => 'image\zoo logo.jpg',
        ]);
    }

    #[Route('/new', name: 'app_admin_animal_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $animal = new Animal();
        $form = $this->createForm(AnimalType::class, $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $raceanimal = $form->get('race-animal')->getData();
            
            $race = new Race();
            $race->setLabel($raceanimal);
            $entityManager->persist($race);
            $entityManager->flush();
            
            $animal->setRace($race);
            $entityManager->persist($animal);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_animal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/animal/new.html.twig', [
            'animal' => $animal,
            'form' => $form,
            'logo' => 'image\zoo logo.jpg',
        ]);
    }

    #[Route('/{id}', name: 'app_admin_animal_show', methods: ['GET'])]
    public function show(Animal $animal): Response
    {
        $races = $animal->getRace()->getLabel();
        //$animalImages = $animal->getAnimalImages()->getImageData();
        //dd($animalImages);
        return $this->render('admin/animal/show.html.twig', [
            'animal' => $animal,
            //'animalImages' => $animalImages,
            'races' => $races,
            'logo' => 'image\zoo logo.jpg',
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_animal_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Animal $animal, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AnimalEditType::class, $animal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_animal_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/animal/edit.html.twig', [
            'animal' => $animal,
            'form' => $form,
            'logo' => 'image\zoo logo.jpg',
        ]);
    }

    #[Route('/{id}', name: 'app_admin_animal_delete', methods: ['POST'])]
    public function delete(Request $request, Animal $animal, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$animal->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($animal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_animal_index', [], Response::HTTP_SEE_OTHER);
    }
}
