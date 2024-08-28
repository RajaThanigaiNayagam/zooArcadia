<?php

namespace App\Controller\Veterinaire;

use App\Entity\RapportEmployee;
use App\Form\RapportEmployeeType;
use App\Repository\RapportEmployeeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/veterinaire/rapport/employee')]
class RapportEmployeeController extends AbstractController
{
    #[Route('/', name: 'app_veterinaire_rapport_employee_index', methods: ['GET'])]
    public function index(RapportEmployeeRepository $rapportEmployeeRepository): Response
    {
        return $this->render('veterinaire/rapport_employee/index.html.twig', [
            'rapport_employees' => $rapportEmployeeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_veterinaire_rapport_employee_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $rapportEmployee = new RapportEmployee();
        $form = $this->createForm(RapportEmployeeType::class, $rapportEmployee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($rapportEmployee);
            $entityManager->flush();

            return $this->redirectToRoute('app_veterinaire_rapport_employee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('veterinaire/rapport_employee/new.html.twig', [
            'rapport_employee' => $rapportEmployee,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_veterinaire_rapport_employee_show', methods: ['GET'])]
    public function show(RapportEmployee $rapportEmployee): Response
    {
        return $this->render('veterinaire/rapport_employee/show.html.twig', [
            'rapport_employee' => $rapportEmployee,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_veterinaire_rapport_employee_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RapportEmployee $rapportEmployee, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RapportEmployeeType::class, $rapportEmployee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_veterinaire_rapport_employee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('veterinaire/rapport_employee/edit.html.twig', [
            'rapport_employee' => $rapportEmployee,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_veterinaire_rapport_employee_delete', methods: ['POST'])]
    public function delete(Request $request, RapportEmployee $rapportEmployee, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$rapportEmployee->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($rapportEmployee);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_veterinaire_rapport_employee_index', [], Response::HTTP_SEE_OTHER);
    }
}
