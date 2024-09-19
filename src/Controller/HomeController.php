<?php

namespace App\Controller;

use App\Repository\HoraireRepository;
use App\Repository\HabitatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(HoraireRepository $horaireRepository, HabitatRepository $habitatRepository): Response
    {
        $ActualUser = $this->getUser() ;
        $roleadmin = false;
        $roleveterinaire = false;
        $roleemployee = false;
        $userroles = '';
        if ( $ActualUser ) {
            $userroles = $ActualUser->getroles();
            foreach ( $userroles as &$userrole ) {
                if ( $userrole ==  "ROLE_ADMIN" ) { $roleadmin = true ; } 
                elseif ( $userrole ==  "ROLE_VETERINAIRE" ) { $roleveterinaire = true ; } 
                elseif ( $userrole ==  "ROLE_EMPLOYEE" ) { $roleemployee = true ; }
            }
        }


        return $this->render('home/index.html.twig', [
            'horaires' => $horaireRepository->findAll(),
            'habitats' => $habitatRepository->findAll(),
            'actualUser' => $ActualUser,
            'userroles' => $userroles,
            'roleadmin' => $roleadmin,
            'roleveterinaire' => $roleveterinaire,
            'roleemployee' => $roleemployee,
        ]);
    }
    
}
