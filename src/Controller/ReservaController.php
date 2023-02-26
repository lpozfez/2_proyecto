<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ReservaController extends AbstractController
{
    #[Route('/reserva', name: 'app_reserva')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('reserva/index.html.twig', [
            'controller_name' => 'ReservaController',
        ]);
    }

    #[Route('/sala', name: 'app_sala')]
    public function adminSala(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('reserva/adminMesas.html.twig', [
            'controller_name' => 'ReservaController',
        ]);
    }
}
