<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Form\LoginFormType;

class LoginController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
     public function index(AuthenticationUtils $authenticationUtils, Request $request): Response
      {
         // get the login error if there is one
         $error = $authenticationUtils->getLastAuthenticationError();

         // last username entered by the user
         $lastUsername = $authenticationUtils->getLastUsername();
         /*
         $form = $this->createForm(LoginFormType::class);
         $form->handleRequest($request);
         
         if ($form->isSubmitted() && $form->isValid()) {
            $email=$form['email']->getData();
            $pass=$form['plainPassword']->getData();
         }*/

         
          return $this->render('login/index.html.twig', [
             //'controller_name' => 'LoginController',
             'last_username' => $lastUsername,
             'error'         => $error,
          ]);
         
      }
}
