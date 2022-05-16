<?php

namespace App\Controller;

use App\Entity\Developer;
use App\Form\DeveloperType;
use App\Repository\DeveloperRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\String\Slugger\SluggerInterface;

class LoginController extends AbstractController {
    // Index page is defined here because starting page is different for different roles.
    // if statement's checks the role AND what is behaviour if no-one is logged-in; there are no public access pages except login page.
    #[Route('/', name: 'index')]
    public function index_route() {
        if($this->isGranted('ROLE_ADMIN')):
            return $this->redirectToRoute('admin_developers_view');
        endif;

        if($this->isGranted('ROLE_DEVELOPER')):
            return $this->redirectToRoute('developer_personal_profile');
        endif;

        if(!$this->isGranted('ROLE_USER')):
            return $this->redirectToRoute('login_form');
        endif;
    }

    #[Route('/login', name: 'login_form')]
    public function login(AuthenticationUtils $authenticationUtils): Response {
        // Get the login error if there is one.
        $error = $authenticationUtils->getLastAuthenticationError();

        return $this->render('login/login.html.twig', [
            'error' => $error
        ]);
    }

    #[Route('/logout', name:'logout')]
    public function logout() {
        // Although this controller can be blank, it can also be used for redirecting.
        # return $this->redirectToRoute('login_form');
    }

    #[Route('/register', name: 'developer_registration')]
    public function developer_registration(Request $request, UserPasswordHasherInterface $userPasswordHasher, DeveloperRepository $developerRepository, SluggerInterface $slugger) {
        $newDeveloper = new Developer();

        $registrationForm = $this->createForm(DeveloperType::class,$newDeveloper);
        $registrationForm->handleRequest($request);

        if ($registrationForm->isSubmitted() && $registrationForm->isValid()) {
            $newDeveloper = $registrationForm->getData();

            // Password handling
            //$plainPassword = $request->request->get('plain_password');
            $plainPassword = $registrationForm->get('plainPassword')->getData();
            $hashedPassword = $userPasswordHasher->hashPassword(
                    $newDeveloper,
                    $plainPassword
            );
            $newDeveloper->setPassword($hashedPassword);

            // Avatar picture handling
            $avatarFile = $registrationForm->get('avatar')->getData();
            if($avatarFile) {
                $originalFilename = pathinfo($avatarFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$avatarFile->guessExtension();

                try {
                    $avatarFile->move($this->getParameter('developers_avatar_directory'), $newFilename);
                } catch(FileException $e) {
                    // I don't know...
                }

                $newDeveloper->setAvatarPath('clients/'.$newFilename);
            }


            $developerRepository->add($newDeveloper);
            return $this->redirectToRoute('developer_personal_profile');
        }

        return $this->render('registration.html.twig',['registrationForm' => $registrationForm->createView()]);
    }
}
