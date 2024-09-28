<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserEditType;
use App\Repository\RoleRepository;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_admin_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository, Request $request): Response
    {
        $page = $request->query->getint('page', 1);
        if ( $request->query->getint('limit') ){ $limit = $request->query->getint('limit'); }else{$limit = $request->query->getint('limit', 3);}
        
        $user = $userRepository->paginateUser($page, $limit);
        $maxPage = ceil( $user->getTotalItemCount() / $limit );
        
        return $this->render('admin/user/index.html.twig', [
            'users' => $user,
            'maxPage' => $maxPage,
            'page' => $page,
        ]);
    }

    #[Route('/new', name: 'app_admin_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, RoleRepository $roleRepository): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        $roleid ='';
        if ($form->isSubmitted() && $form->isValid()) {
            $userroles = array("ROLE_USER");
            $userrole = $form->get('rolechoice')->getData();
            if ($userrole =="veterinary") {$userrole ="ROLE_VETERINAIRE";} elseif ( $userrole =="employee" ) {$userrole ="ROLE_EMPLOYEE";} else {$userrole ="";} ;
            $rolerepository = $roleRepository->findAll();
            foreach ($rolerepository as $usrrole){ 
                dump($usrrole->getlabel());
                dump($userrole);
                if ($usrrole->getlabel() == $userrole){
                    $userroles[] = $userrole; 
                    $user->setRoles($userroles);
                    $roleid = $usrrole->getId() ;
                }
            }
            if ($roleid) {
                $roleUserIdRepository = $roleRepository->findOneBy( array('id' => $roleid) );
                $user->setRole($roleUserIdRepository);
                $entityManager->persist($user);
                $entityManager->flush();
            } else {
                $this->addFlash('danger', 'Le rôle de l\'utilisateur n\'existe pas ou ne correspond pas');
            }

            return $this->redirectToRoute('app_admin_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('admin/user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager, RoleRepository $roleRepository): Response
    {
        $form = $this->createForm(UserEditType::class, $user);
        $form->handleRequest($request);

        $roleid ='';
        if ($form->isSubmitted() && $form->isValid()) {
            $userroles = array("ROLE_USER");
            $userrole = $form->get('rolechoice')->getData();
            if ($userrole =="veterinary") {$userrole ="ROLE_VETERINAIRE";} elseif ( $userrole =="employee" ) {$userrole ="ROLE_EMPLOYEE";} else {$userrole ="";} ;
            $rolerepository = $roleRepository->findAll();
            foreach ($rolerepository as $usrrole){ 
                dump($usrrole->getlabel());
                dump($userrole);
                if ($usrrole->getlabel() == $userrole){
                    $userroles[] = $userrole; 
                    $user->setRoles($userroles);
                    $roleid = $usrrole->getId() ;
                }
            }
            if ($roleid) {
                $roleUserIdRepository = $roleRepository->findOneBy( array('id' => $roleid) );
                $user->setRole($roleUserIdRepository);
                $entityManager->persist($user);
                $entityManager->flush();
            } else {
                $this->addFlash('danger', 'Le rôle de l\'utilisateur n\'existe pas ou ne correspond pas');
            }

            return $this->redirectToRoute('app_admin_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('admin/user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
