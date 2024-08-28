<?php

namespace App\Controller\User;

use App\Entity\Service;
use App\Form\Service1Type;
use App\Repository\ServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/user/service')]
class ServiceController extends AbstractController
{
    #[Route('/', name: 'app_user_service_index', methods: ['GET'])]
    public function index(ServiceRepository $serviceRepository): Response
    {
        return $this->render('user/service/index.html.twig', [
            'services' => $serviceRepository->findAll(),
        ]);
    }

    #[Route('/{id}', name: 'app_user_service_show', methods: ['GET'])]
    public function show(Service $service): Response
    {
        return $this->render('user/service/show.html.twig', [
            'service' => $service,
        ]);
    }
}
