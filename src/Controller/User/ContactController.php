<?php

namespace App\Controller\User;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/user/contact')]
class ContactController extends AbstractController
{
    #[Route('/', name: 'app_user_contact')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $datetime = (new \DateTimeImmutable('Europe/Paris'));
            $contact->setCreatedAt($datetime);

            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('app_home');
        }

        return $this->render('user/contact/index.html.twig', [
            'contact' => $contact,
            'form' => $form,
        ]);

        /*return $this->render('user/avis/new.html.twig', [
            'controller_name' => 'ContactController',
        ]);*/
    }
}
