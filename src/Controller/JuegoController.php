<?php

namespace App\Controller;

use App\Entity\Juego;
use App\Form\JuegosType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\JuegoRepository;

class JuegoController extends AbstractController
{
    
    #[Route('/juego', name: 'app_juego')]

    public function index(JuegoRepository $repo): Response
    {
        $juegos=$repo->findAllJuegos();
        //var_dump($juegos);

        return $this->render('juego/index.html.twig', [
            'juegos'=>$juegos
        ]);
    }

    /**Método que muestra el formulario para crear nuesvos productos */
    #[Route('juego/nuevo', name: 'crear_juego')]
    public function new(Request $request, EntityManagerInterface $em, JuegoRepository $repo):Response{

        $juego=new Juego();
        $directorio='..\public\assets\images\juegos';
        
        $form=$this->createForm(JuegosType::class,$juego);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if(!$repo->find($juego->getId()))
            {

                //Obtenemos la imagen del formulario
                $imagen = $form['imagen']->getData();

                //Buscamos el nombre del archivo
                $nombreOriginal = pathinfo($imagen->getClientOriginalName(), PATHINFO_imagenNAME);

                //Capturamos la extensión
                $extension = $imagen->guessExtension();

                //Creamo el nuevo nombre de la imagen con el nombre original junto a la extensión
                $nuevoNombreImg=$nombreOriginal.'.'.$extension;

                //Añadimos el nuevo nombre de la imagen al juego creado con los datos del formulario
                $juego->setImagen($nuevoNombreImg);

                //Movemos la imagen al directorio deseado
                $imagen->move($directorio, $nuevoNombreImg);

                //Guardamos el juego en base de datos
                $em->persist($juego);
                $em->flush();
            }else{
                $error='El juego ya existe';
            }
        }
        
        return $this->render('juego/juegoForm.html.twig', [
            'form' => $form,
            'error'=>$error
        ]);

    }
}
