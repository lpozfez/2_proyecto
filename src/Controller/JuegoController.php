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
        $path='..\public\assets\images\juegos';
        $juegos=$repo->findAllJuegos();
        //var_dump($juegos);

        return $this->render('juego/index.html.twig', [
            'juegos'=>$juegos
        ]);
    }

    /**Método que muestra el formulario para crear nuevos productos */
    #[Route('juego/nuevo', name: 'crear_juego')]
    public function new(Request $request, JuegoRepository $repo):Response{

        $juego=new Juego();
        $directorio='..\public\assets\images\juegos';
        
        $form=$this->createForm(JuegosType::class,$juego);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $juego=$form->getData();
            //Obtenemos la imagen del formulario
            $imagen = $form['imagen']->getData();
            trataImagen($imagen,$juego,$directorio);
            //Guardamos el juego en base de datos
            $repo->save($juego,true);
        }
        
        return $this->render('juego/juegoForm.html.twig', [
            'form' => $form,
        ]);

    }

    /**Método que muestra el formulario para modificar juegos */
    #[Route('juego/modificar/{id}', name: 'modificar_juego')]
    public function update(Request $request, JuegoRepository $repo, int $id):Response{

        $juego=$repo->find($id);
        if (!$juego) {
            throw $this->createNotFoundException(
                'Producto no encontrado '.$id
            );
        }else{
            $form=$this->createForm(JuegosType::class,$juego);
            $form->handleRequest($request);
            //capturar datos de formaulario y setear datos
        }
        

        return $this->render('juego/juegoModForm.html.twig', [
            'form' => $form,
        ]);

        /**$entityManager = $doctrine->getManager();
        $producto = $entityManager->getRepository(Producto::class)->find($id);

        if (!$producto) {
            throw $this->createNotFoundException(
                'Producto no encontrado '.$id
            );
        }

        $producto->setNombre('Teclado con led');
        $entityManager->flush();

        return $this->redirectToRoute('muestra_producto', [
            'id' => $producto->getId()
        ]); */
    }
}
