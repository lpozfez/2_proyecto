<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    public function new(): Response
    {
        $mesa=new Mesa();
        $form=$this->createForm(JuegosType::class,$mesa);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData()Obtiene los datos del formulario
            $mesa = $form->getData();

            //$img->move($directory, $someNewFilename);

            $em->persist($mesa);
            $em->flush();
        }
        
        return $this->render('juego/juegoForm.html.twig', [
            'form' => $form,
        ]);

    }



    
}
