<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Entity\AnimalImage;
use App\Repository\AvisRepository;
use App\Repository\AnimalRepository;
use App\Repository\HoraireRepository;
use App\Repository\HabitatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(
        HoraireRepository $horaireRepository, 
        HabitatRepository $habitatRepository, 
        AnimalRepository $animalRepository,
        AvisRepository $avisRepository,
        EntityManagerInterface $entityManager,
        Request $request
        ): Response
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

        /*-------------------------------------------------------- -*/
        /*------- To read all the authorised client reviews------- -*/
        /*-------------------------------------------------------- -*/
        $page = $request->query->getint('page', 1);
        if ( $request->query->getint('limit') ){ $limit = $request->query->getint('limit'); }else{$limit = $request->query->getint('limit', 3);}
        
        $authorisedavis = $avisRepository->paginateAuthorisedAvis($page, $limit);
        $maxPage = ceil( $authorisedavis->getTotalItemCount() / $limit );

        $avi = new Avis();
        $pseudo = $request->request->get('pseudo');
        $comment = $request->request->get('comment');
        if ($pseudo && $comment ) {
            $avi->setPseudo($pseudo);
            $avi->setCommentaire($comment);
            $entityManager->persist($avi);
            $entityManager->flush();

            //return $this->redirectToRoute('app_home');
        }

        /*-------------------------------------------------------- -*/

        return $this->render('home/index.html.twig', [
            'horaires' => $horaireRepository->findAll(),
            'habitats' => $habitatRepository->findAll(),
            'animals' => $animalRepository->findAll(),
            'actualUser' => $ActualUser,
            'userroles' => $userroles,
            'roleadmin' => $roleadmin,
            'roleveterinaire' => $roleveterinaire,
            'roleemployee' => $roleemployee,
            'avis' => $authorisedavis,
            'maxPage' => $maxPage,
            'page' => $page,
        ]);
    }

    #[Route('/home/animal/{id}', name: 'app_user_animal_show', methods: ['GET'])]
    public function show(AnimalImage $animalimage, EntityManagerInterface $entityManager, Request $request): Response
    {
        $animalimageclique = $animalimage->getNbClique();
        //$animalimageclique = $animalimage[0]->getNbClique();
        if ( ! $animalimageclique ) {$animalimageclique = 0;};
        
        ++$animalimageclique;
        $animalimage->setNbClique($animalimageclique);
        $entityManager->persist($animalimage);
        $entityManager->flush();

        $referer = $request->headers->get('referer'); 

        return $this->render('home/animal/show.html.twig', [
            'animalimages' => $animalimage,
            'referer' => $referer,
        ]);
    }
}
