<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Mesa;
use App\Repository\MesaRepository;

class ApiMesaController extends AbstractController
{
    private $repositorioMesa;

    public function __constructor(MesaRepository $repositorioDeMesa){
        $this->repositorioMesa=$repositorioDeMesa;
    }

    #[Route('/api/mesa/{id}', name: 'get_mesa')]
    public function get($id): JsonResponse
    {
       $mesa=$this->repositorioMesa->findOneBy(['id'=>$id]);

       $datos=[
        'id'=>$mesa->getId(),
        'ancho'=>$mesa->getAncho(),
        'alto'=>$mesa->getAlto(),
        'x'=>$mesa->getX(),
        'y'=>$mesa->getY(),
        'imagen'=>$mesa->getImagen(),
        'reservas'=>$mesa->getReservas()
       ];

       return JsonResponse($datos, Response::HTTP_OK);
    }

    //     /** 
    // * @Route ("/clientes", name="get_all_customers", métodos={"GET"}) 
    // */
    // public function getAll(): JsonResponse 
    // { 
    //     $clientes = $this->customerRepository->findAll(); 
    //     $datos = []; 
    
    //     foreach ($clientes as $cliente) { 
    //         $datos[] = [ 
    //             'id' => $cliente->getId(), 
    //             'firstName' => $cliente->getFirstName(), 
    //             'lastName' => $cliente-> getLastName(), 
    //             'email' => $cliente->getEmail(), 
    //             'phoneNumber' => $customer->getPhoneNumber(), 
    //         ]; 
    //     } 
    
    //     devuelve una nueva JsonResponse($datos, Respuesta:: HTTP_OK ); 
    // }

    #[Route('/api/mesa', name: 'app_api_mesa')]
    public function index(): Response
    {
        return $this->render('api_mesa/index.html.twig', [
            'controller_name' => 'ApiMesaController',
        ]);
    }


}
