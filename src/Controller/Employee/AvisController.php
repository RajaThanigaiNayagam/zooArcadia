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
    public function index(AvisRepository $avisRepository): Response
    {
        return $this->render('employee/avis/index.html.twig', [
            'avis' => $avisRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_employee_avis_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $avi = new Avis();
        $form = $this->createForm(AvisType::class, $avi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $entityManager->persist($avi);
            $entityManager->flush();

            return $this->redirectToRoute('app_employee_avis_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('employee/avis/new.html.twig', [
            'avi' => $avi,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_employee_avis_show', methods: ['GET'])]
    public function show(Avis $avi): Response
    {
        return $this->render('employee/avis/show.html.twig', [
            'avi' => $avi,
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

    #[Route('/{id}', name: 'app_employee_avis_delete', methods: ['POST'])]
    public function delete(Request $request, Avis $avi, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$avi->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($avi);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_employee_avis_index', [], Response::HTTP_SEE_OTHER);
    }
}
