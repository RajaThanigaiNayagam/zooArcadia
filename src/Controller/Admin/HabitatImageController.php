<?php

namespace App\Controller\Admin;

use App\Entity\Image;
use App\Form\ImageType;
use App\Repository\ImageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/habitatimage')]
final class HabitatImageController extends AbstractController
{
    #[Route('/', name: 'app_admin_habitat_image_index', methods: ['GET'])]
    public function index(ImageRepository $imageRepository, Request $request): Response
    {
        $page = $request->query->getint('page', 1);
        if ( $request->query->getint('limit') ){ $limit = $request->query->getint('limit'); }else{$limit = $request->query->getint('limit', 3);}
        
        $habitatimage = $imageRepository->paginatelImage($page, $limit);
        $maxPage = ceil( $habitatimage->getTotalItemCount() / $limit );
        //dd($habitatimage);
        return $this->render('admin/habitat_image/index.html.twig', [
            'habitatimages' => $habitatimage,
            'maxPage' => $maxPage,
            'page' => $page,
        ]);
    }

    #[Route('/new', name: 'app_admin_habitat_image_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $image = new Image();
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($image);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_habitat_image_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/habitat_image/new.html.twig', [
            'image' => $image,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_habitat_image_show', methods: ['GET'])]
    public function show(Image $image): Response
    {
        return $this->render('admin/habitat_image/show.html.twig', [
            'image' => $image,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_habitat_image_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Image $image, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ImageType::class, $image);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_habitat_image_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/habitat_image/edit.html.twig', [
            'image' => $image,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_habitat_image_delete', methods: ['POST'])]
    public function delete(Request $request, Image $image, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$image->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($image);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_habitat_image_index', [], Response::HTTP_SEE_OTHER);
    }
}
