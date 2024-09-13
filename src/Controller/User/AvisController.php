<?php

namespace App\Controller\User;

use App\Entity\Avis;
use App\Form\AvisType;
use App\Repository\AvisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/user/avis')]
class AvisController extends AbstractController
{
    #[Route('/', name: 'app_user_avis_index', methods: ['GET'])]
    public function index(AvisRepository $avisRepository, Request $request): Response
    {
        $page = $request->query->getint('page', 1);
        if ( $request->query->getint('limit') ){ $limit = $request->query->getint('limit'); }else{$limit = $request->query->getint('limit', 3);}
        
        $avis = $avisRepository->paginateAvis($page, $limit);
        $maxPage = ceil( $avis->getTotalItemCount() / $limit );
        
        return $this->render('user/avis/index.html.twig', [
            'avis' => $avis,
            'maxPage' => $maxPage,
            'page' => $page,
            'logo' => 'image\zoo logo.jpg',
        ]);
    }

    #[Route('/new', name: 'app_user_avis_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $avi = new Avis();
        $form = $this->createForm(AvisType::class, $avi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($avi);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('user/avis/new.html.twig', [
            'avi' => $avi,
            'form' => $form,
            'logo' => 'image\zoo logo.jpg',
        ]);
    }

    #[Route('/{id}', name: 'app_user_avis_show', methods: ['GET'])]
    public function show(Avis $avi): Response
    {
        return $this->render('user/avis/show.html.twig', [
            'avi' => $avi,
            'logo' => 'image\zoo logo.jpg',
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_avis_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Avis $avi, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AvisType::class, $avi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_user_avis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/avis/edit.html.twig', [
            'avi' => $avi,
            'form' => $form,
            'logo' => 'image\zoo logo.jpg',
        ]);
    }
}
