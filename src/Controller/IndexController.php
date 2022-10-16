<?php

namespace App\Controller;

use App\Entity\Advertissement;
use App\Entity\User;
use App\Form\AdvFormType;
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
    public function index(EntityManagerInterface $em): Response
    {
        $repoAdv = $em->getRepository(Advertissement::class);
        $ads = $repoAdv->findAll();
        return $this->render('index/index.html.twig', [
            'controller_name' => '🛠 JMN & Co',
            'adv' => $ads,
        ]);
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if($user->getIsCompagny()){
            $user->setRoles(['ROLE_COMPAGNIE']);
        }

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
    public function profil(EntityManagerInterface $em): Response
    {
        $repoUser = $em->getRepository(User::class);
        $id = $this->getUser()->getId();
        $users = $repoUser->findById($id);

        return $this->render('users/profil.html.twig', [
            'controller_name' => '🛠 Mon Profil',
            'users' => $users,
        ]);
    }

    #[Route('/MesOffres', name: 'app_offres')]
    public function mesOffres(): Response
    {
        return $this->render('users/mesoffres.html.twig', [
            'controller_name' => '🛠 Mes offres',
        ]);
    }

    #[Route('/aboutUs', name: 'app_aboutUs')]
    public function aboutUs(): Response
    {
        return $this->render('frontFooter/aboutUs.html.twig', [
            'controller_name' => '🛠 À propos de nous',
        ]);
    }

    #[Route('/contactUs', name: 'app_contact')]
    public function contactUs(): Response
    {
        return $this->render('frontFooter/contactUs.html.twig', [
            'controller_name' => '🛠 Nous contacter ',
        ]);
    }

    #[Route('/politiqueDuPrivée', name: 'app_CV')]
    public function politiqueDuPv(): Response
    {
        return $this->render('frontFooter/politiqueDuPrivée.html.twig', [
            'controller_name' => '🛠 Politique du privée',
        ]);
    }

    #[Route('/nouvelleOffre', name: 'app_newOffer')]
    public function newOffer(Request $request, EntityManagerInterface $entityManager): Response
    {
        $adv = new Advertissement();
        $adv->setIdOwner($this->getUser());
        $form = $this->createForm(AdvFormType::class, $adv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($adv);
            $entityManager->flush();

            return $this->redirectToRoute('app_index');
        }

        return $this->render('index/newAdvForm.html.twig', [
            'newAdvForm' => $form->createView(),
            'controller_name' => '🛠 Nouvelle Offre',
        ]);
    }
}