<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/index', name: 'app_index')]
    public function index(): Response
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => '🛠 JMN & Co',
        ]);
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('password')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'controller_name' => '🛠 Inscription'
        ]);
    }

    #[Route('/MonProfil', name: 'app_profil')]
    public function profil(): Response
    {
        return $this->render('users/profil.html.twig', [
            'controller_name' => '🛠 Mon Profil',
        ]);
    }

    #[Route('/MesOffres', name: 'app_offres')]
    public function mesOffres(): Response
    {
        return $this->render('users/mesoffres.html.twig', [
            'controller_name' => '🛠 Mes offres',
        ]);
    }

    #[Route('/MonCV', name: 'app_CV')]
    public function monCV(): Response
    {
        return $this->render('users/moncv.html.twig', [
            'controller_name' => '🛠 Mon CV',
        ]);
    }
}