<?php

namespace App\Controller\Admin;

use App\Entity\AnimalImage;
use App\Form\AnimalImageType;
use App\Repository\AnimalImageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/animal/image')]
class AnimalImageController extends AbstractController
{
    #[Route('/', name: 'app_admin_animal_image_index', methods: ['GET'])]
    public function index(AnimalImageRepository $animalImageRepository): Response
    {
        return $this->render('admin/animal_image/index.html.twig', [
            'animal_images' => $animalImageRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_animal_image_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $animalImage = new AnimalImage();
        $form = $this->createForm(AnimalImageType::class, $animalImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($animalImage);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_animal_image_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/animal_image/new.html.twig', [
            'animal_image' => $animalImage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_animal_image_show', methods: ['GET'])]
    public function show(AnimalImage $animalImage): Response
    {
        return $this->render('admin/animal_image/show.html.twig', [
            'animal_image' => $animalImage,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_animal_image_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AnimalImage $animalImage, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AnimalImageType::class, $animalImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_animal_image_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/animal_image/edit.html.twig', [
            'animal_image' => $animalImage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_animal_image_delete', methods: ['POST'])]
    public function delete(Request $request, AnimalImage $animalImage, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$animalImage->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($animalImage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_animal_image_index', [], Response::HTTP_SEE_OTHER);
    }
}
