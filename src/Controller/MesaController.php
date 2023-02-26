<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Mesa;
use App\Repository\MesaRepository;
use Symfony\Component\HttpFoundation\Request;

class MesaController extends AbstractController
{
    #[Route('/mesa', name: 'app_mesa')]
    public function index(): Response
    {
        return $this->render('mesa/index.html.twig', [
            'controller_name' => 'MesaController',
        ]);
    }

    #[Route('mesa/nueva', name: 'nueva_mesa')]
    public function new(Request $request, MesaRepository $repo): Response
    {
        $mesa=new Mesa();
        $form=$this->createForm(JuegosType::class,$mesa);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData()Obtiene los datos del formulario
            $mesa = $form->getData();

            $repo->save($mesa, true);
        }
        
        return $this->render('juego/juegoForm.html.twig', [
            'form' => $form,
        ]);

    }



    
}
