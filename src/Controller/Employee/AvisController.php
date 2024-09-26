<?php

namespace App\Controller\Employee;

use App\Entity\Avis;
use App\Form\AvisIsVerifiedType;
use App\Form\AvisType;
use App\Repository\AvisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/employee/avis')]
class AvisController extends AbstractController
{
    #[Route('/', name: 'app_employee_avis_index', methods: ['GET'])]
    public function index(AvisRepository $avisRepository, Request $request): Response
    {
        $page = $request->query->getint('page', 1);
        if ( $request->query->getint('limit') ){ $limit = $request->query->getint('limit'); }else{$limit = $request->query->getint('limit', 3);}
        
        $avis = $avisRepository->paginateAvis($page, $limit);
        $maxPage = ceil( $avis->getTotalItemCount() / $limit );

        return $this->render('employee/avis/index.html.twig', [
            'avis' => $avis,
            'maxPage' => $maxPage,
            'page' => $page,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_employee_avis_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Avis $avi, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(AvisIsVerifiedType::class, $avi);
        $form->handleRequest($request);
        //dd($form->getData());
        #$avi->setPseudo($request->getpseudo() );

        if ($form->isSubmitted() && $form->isValid()) {
            if ( $form->get('Visible')->getData() ){
                $avi->setVisible(true);
            } else {
                $avi->setVisible(false);
            };
            
            //dd( $form->get('Visible')->getData() );
            $entityManager->persist($avi);
            $entityManager->flush();

            return $this->redirectToRoute('app_employee_avis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('employee/avis/edit.html.twig', [
            'avi' => $avi,
            'form' => $form,
        ]);
    }

}
