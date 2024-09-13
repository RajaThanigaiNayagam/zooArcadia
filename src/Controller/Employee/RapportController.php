<?php

namespace App\Controller\Employee;

use App\Entity\RapportEmployee;
use App\Form\RapportEmployeeType;
use App\Repository\RapportEmployeeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/employee/rapport')]
class RapportController extends AbstractController
{
    #[Route('/', name: 'app_employee_rapport_index', methods: ['GET'])]
    public function index(RapportEmployeeRepository $rapportEmployeeRepository, Request $request): Response
    {
        $ActualUser = $this->getUser()->getId() ;

        $page = $request->query->getint('page', 1);
        if ( $request->query->getint('limit') ){ $limit = $request->query->getint('limit'); }else{$limit = $request->query->getint('limit', 3);}
        
        $rapportEmployee = $rapportEmployeeRepository->paginateRapportDeEmployee($page, $limit, $ActualUser);
        $maxPage = ceil( $rapportEmployee->getTotalItemCount() / $limit );
        
        return $this->render('employee/rapport/index.html.twig', [
            'rapport_employees' => $rapportEmployee,
            'maxPage' => $maxPage,
            'page' => $page,
        ]);
    }

    #[Route('/new', name: 'app_employee_rapport_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $rapportEmployee = new RapportEmployee();
        $form = $this->createForm(RapportEmployeeType::class, $rapportEmployee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ActualUser = $this->getUser();
            $rapportEmployee->setUser($ActualUser);
            $datetime = (new \DateTimeImmutable('Europe/Paris'));
            $rapportEmployee->setCreatedAt($datetime);

            $entityManager->persist($rapportEmployee);
            $entityManager->flush();

            return $this->redirectToRoute('app_employee_rapport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('employee/rapport/new.html.twig', [
            'rapport_employee' => $rapportEmployee,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_employee_rapport_show', methods: ['GET'])]
    public function show(RapportEmployee $rapportEmployee): Response
    {
        return $this->render('employee/rapport/show.html.twig', [
            'rapport_employee' => $rapportEmployee,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_employee_rapport_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RapportEmployee $rapportEmployee, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RapportEmployeeType::class, $rapportEmployee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_employee_rapport_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('employee/rapport/edit.html.twig', [
            'rapport_employee' => $rapportEmployee,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_employee_rapport_delete', methods: ['POST'])]
    public function delete(Request $request, RapportEmployee $rapportEmployee, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rapportEmployee->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($rapportEmployee);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_employee_rapport_index', [], Response::HTTP_SEE_OTHER);
    }
}
