<?php

namespace App\Controller;

use App\Entity\Avis;
use App\Entity\Habitat;
use App\Entity\AnimalImage;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\AvisRepository;
use App\Repository\AnimalRepository;
use App\Repository\HoraireRepository;
use App\Repository\ContactRepository;
use App\Repository\HabitatRepository;
use App\Repository\RapportEmployeeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route(name: 'app_home')]
    public function index(
        HoraireRepository $horaireRepository, 
        HabitatRepository $habitatRepository, 
        AnimalRepository $animalRepository,
        AvisRepository $avisRepository,
        ContactRepository $contactRepository,
        RapportEmployeeRepository $rapportEmployeeRepository,
        EntityManagerInterface $entityManager,
        Request $request
        ): Response
    {
        /*-------------------------------------------------------- -*/
        /*------- To read the role of the staff connected -------- -*/
        /*-------------------------------------------------------- -*/
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
        /* -----------------------VISITEUR ----------------------- -*/
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
            $datetime = (new \DateTimeImmutable('Europe/Paris'));
            $avi->setCreatedAt($datetime);
            $avi->setPseudo($pseudo);
            $avi->setCommentaire($comment);
            $entityManager->persist($avi);
            $entityManager->flush();

            //return $this->redirectToRoute('app_home');
        }

        
        /*-------------------------------------------------------- -*/
        /* -----------------------Employee ----------------------- -*/
        /*-------------------------------------------------------- -*/
        /*--------display visiter reviews and contact msg -------- -*/
        /*-------------------------------------------------------- -*/
        $contactvisiter = '';
        $rapportEmployee = '';
        $contactmaxPage = 0;
        $contactpage = 0;
        if ( $roleemployee ==  "ROLE_EMPLOYEE" ){

            $ActualUserid = $this->getUser()->getId() ;
            //To get all the employee's reports
            //pagination - get current page number and number of records to be displayed in a page from method POST or GET
            $page = $request->query->getint('page', 1);
            if ( $request->query->getint('limit') ){ $limit = $request->query->getint('limit'); }else{$limit = $request->query->getint('limit', 3);}
            
            //To execute the SQL query to get all the concerned employee's report
            $rapportEmployee = $rapportEmployeeRepository->paginateRapportDeEmployee($page, $limit, $ActualUserid);
            $maxPage = ceil( $rapportEmployee->getTotalItemCount() / $limit );

            //pagination - get current page number and number of records to be displayed in a page from method POST or GET
            $contactpage = $request->query->getint('contactpage', 1);
            if ( $request->query->getint('contactlimit') ){ $contactlimit = $request->query->getint('contactlimit'); }else{$contactlimit = $request->query->getint('contactlimit', 3);}
            
            //To get all the contact message sent by the visiter
            $contactvisiter = $contactRepository->paginateNonRepliedContact($contactpage, $contactlimit);
            $contactmaxPage = ceil( $contactvisiter->getTotalItemCount() / $contactlimit );
            
        }
        /* ------------------------------------------------------- -*/


        /* ------------------------------------------------------- -*/
        /* -------------------- FORM RENDERING-------------------- -*/
        /* ------------------------------------------------------- -*/

        return $this->render('home/index.html.twig', [
            'horaires' => $horaireRepository->findAll(),
            'habitats' => $habitatRepository->findAll(),
            'animals' => $animalRepository->findAll(),
            'rapport_employees' => $rapportEmployee,
            'contactvisiters' => $contactvisiter,
            'actualUser' => $ActualUser,
            'userroles' => $userroles,
            'roleadmin' => $roleadmin,
            'roleveterinaire' => $roleveterinaire,
            'roleemployee' => $roleemployee,
            'avis' => $authorisedavis,
            'maxPage' => $maxPage,
            'page' => $page,
            'contactmaxPage' => $contactmaxPage,
            'contactpage' => $contactpage,
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
    
    #[Route('/employee/contact/', name: 'app_employee_contact_show', methods: ['GET'])]
    public function employee_contact(ContactRepository $contactRepository, Request $request): Response
    {
        $page = $request->query->getint('page', 1);
        if ( $request->query->getint('limit') ){ $limit = $request->query->getint('limit'); }else{$limit = $request->query->getint('limit', 3);}
        
        $contact = $contactRepository->paginateContact($page, $limit);
        $maxPage = ceil( $contact->getTotalItemCount() / $limit );

        return $this->render('employee/contact/index.html.twig', [
            'contacts' => $contact,
            'maxPage' => $maxPage,
            'page' => $page,
        ]);
    }

    #[Route('/employee/contact/{id}', name: 'app_employee_contact_repliedOrNot', methods: ['GET', 'POST'])]
    public function edit(Request $request, Contact $contact, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        //dd($form->getData()->isRead());
        //dd($form->get('is_read')->getData());
        //dd($form->get('Read'));
            if ( $request->request->get('isread') == "on"){
                $contact->setRead(true);
            } else {
                $contact->setRead(false);
            };
            //dd($contact);
            $entityManager->persist($contact);
            $entityManager->flush();

        return $this->redirectToRoute('app_employee_contact_show', [], Response::HTTP_SEE_OTHER);
        /*return $this->render('employee/avis/edit.html.twig', [
            'avi' => $avi,
            'form' => $form,
        ]);*/
    }

    #[Route('/home/habitat/{id}', name: 'app_home_habitat_show', methods: ['GET'])]
    public function showAnimalDeHabitat(Habitat $habitat, Request $request): Response
    {
        /*$animalimageclique = $animalimage->getNbClique();
        //$animalimageclique = $animalimage[0]->getNbClique();
        //if ( ! $animalimageclique ) {$animalimageclique = 0;};
        
        ++$animalimageclique;
        $animalimage->setNbClique($animalimageclique);
        $entityManager->persist($animalimage);
        $entityManager->flush(); */
        //dd($habitat);
        $referer = $request->headers->get('referer');

        return $this->render('home/habitat/show.html.twig', [
            'habitats' => $habitat,
            'referer' => $referer,
        ]);
    }
}
