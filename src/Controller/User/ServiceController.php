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
    #[Route('/', name: 'app_user_serviceuser_index', methods: ['GET'])]
    public function index(ServiceRepository $serviceRepository, Request $request): Response
    {
        $page = $request->query->getint('page', 1);
        if ( $request->query->getint('limit') ){ $limit = $request->query->getint('limit'); }else{$limit = $request->query->getint('limit', 3);}
        
        $service = $serviceRepository->paginateService($page, $limit);
        $maxPage = ceil( $service->getTotalItemCount() / $limit );
        
        return $this->render('user/serviceuser/index.html.twig', [
            'services' => $service,
            'maxPage' => $maxPage,
            'page' => $page,
            'logo' => 'image\zoo logo.jpg',
        ]);
    }

    #[Route('/{id}', name: 'app_user_serviceuser_show', methods: ['GET'])]
    public function show(Service $service): Response
    {
        return $this->render('user/serviceuser/show.html.twig', [
            'service' => $service,
            'logo' => 'image\zoo logo.jpg',
        ]);
    }
}
