<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

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
}
