<?php

namespace App\Controller\Admin;

use App\Entity\ServiceImage;
use App\Form\ServiceImageType;
use App\Repository\ServiceImageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/zooserviceimage')]
final class ZooserviceimageController extends AbstractController{
    #[Route(name: 'app_admin_zooserviceimage_index', methods: ['GET'])]
    public function index(ServiceImageRepository $serviceimageRepository, Request $request): Response
    {
        $page = $request->query->getint('page', 1);
        if ( $request->query->getint('limit') ){ $limit = $request->query->getint('limit'); }else{$limit = $request->query->getint('limit', 3);}
        
        $serviceimage = $serviceimageRepository->paginateServiceImage($page, $limit);
        $maxPage = ceil( $serviceimage->getTotalItemCount() / $limit );
        
        return $this->render('admin/zooserviceimage/index.html.twig', [
            'serviceimages' => $serviceimage,
            'maxPage' => $maxPage,
            'page' => $page,
        ]);
    }

    #[Route('/new', name: 'app_admin_zooserviceimage_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $serviceimage = new ServiceImage();
        $form = $this->createForm(ServiceImageType::class, $serviceimage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($serviceimage);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_zooserviceimage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/zooserviceimage/new.html.twig', [
            'serviceimage' => $serviceimage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_zooserviceimage_show', methods: ['GET'])]
    public function show(ServiceImage $serviceimage): Response
    {
        return $this->render('admin/zooserviceimage/show.html.twig', [
            'serviceimage' => $serviceimage,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_zooserviceimage_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ServiceImage $serviceimage, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ServiceImageType::class, $serviceimage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_zooserviceimage_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/zooserviceimage/edit.html.twig', [
            'service' => $serviceimage,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_zooserviceimage_delete', methods: ['POST'])]
    public function delete(Request $request, ServiceImage $serviceimage, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$serviceimage->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($serviceimage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_zooserviceimage_index', [], Response::HTTP_SEE_OTHER);
    }
}
