<?php

namespace App\Controller;

use App\Entity\Juego;
use App\Form\JuegosType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;

class JuegoController extends AbstractController
{
    #[Route('/juego', name: 'app_juego')]
    public function index(): Response
    {
        return $this->render('juego/index.html.twig', [
            'controller_name' => 'JuegoController',
        ]);
    }

    /**Método que muestra el formulario para crear nuesvos productos */
    #[Route('juego/nuevo', name: 'crear_juego')]
    public function new(Request $request, EntityManagerInterface $em):Response{

        $juego=new Juego();
        $form=$this->createForm(JuegosType::class,$juego);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData()Obtiene los datos del formulario
            $juego = $form->getData();

            //$img->move($directory, $someNewFilename);

            $em->persist($juego);
            $em->flush();
        }
        
        return $this->render('juego/juegoForm.html.twig', [
            'form' => $form,
        ]);

    }
}
