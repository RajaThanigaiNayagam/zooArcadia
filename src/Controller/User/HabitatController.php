<?php

namespace App\Controller\User;

use App\Entity\Habitat;
use App\Form\Habitat1Type;
use App\Repository\HabitatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/user/habitat')]
class HabitatController extends AbstractController
{
    #[Route('/', name: 'app_user_habitat_index', methods: ['GET'])]
    public function index(HabitatRepository $habitatRepository, Request $request): Response
    {
        $page = $request->query->getint('page', 1);
        if ( $request->query->getint('limit') ){ $limit = $request->query->getint('limit'); }else{$limit = $request->query->getint('limit', 3);}
        
        $habitat = $habitatRepository->paginateHabitat($page, $limit);
        $maxPage = ceil( $habitat->getTotalItemCount() / $limit );
        
        return $this->render('user/habitat/index.html.twig', [
            'habitats' => $habitat,
            'maxPage' => $maxPage,
            'page' => $page,
        ]);
    }

    #[Route('/{id}', name: 'app_user_habitat_show', methods: ['GET'])]
    public function show(Habitat $habitat): Response
    {
        return $this->render('user/habitat/show.html.twig', [
            'habitat' => $habitat,
            'logo' => 'image\zoo logo.jpg',
        ]);
    }
}
