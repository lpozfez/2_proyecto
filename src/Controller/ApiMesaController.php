<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Mesa;
use App\Repository\MesaRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;



class ApiMesaController extends AbstractController
{
    private $repositorioMesa;

    public function __constructor(MesaRepository $repositorioDeMesa){
        $this->repositorioMesa=$repositorioDeMesa;
    }

    #[Route('/api/mesa/{id}', name: 'get_mesa')]
    public function getMesa(ManagerRegistry $doctrine,$id): JsonResponse
    {
       $mesa=$doctrine->getRepository(Mesa::class)->findOneBy(['id'=>$id]);

       $datos[] = [ 
        'id' => $mesa->getId(), 
        'ancho'=>$mesa->getAncho(),
        'alto'=>$mesa->getAlto(),
        'x'=>$mesa->getX(),
        'y'=>$mesa->getY(),
        'imagen'=>$mesa->getImagen(),
        'reservas'=>$mesa->getReservas()
        ]; 

       return $this->json($datos, $status=200);
    }

    #[Route("/api/mesa", name:"todas_mesas")]
    public function getMesas(ManagerRegistry $doctrine): JsonResponse 
    { 
        $mesas = $doctrine->getRepository(Mesa::class)->findAll(); 
        $datos = []; 
    
        foreach ($mesas as $mesa) { 
            $datos[] = [ 
                'id' => $mesa->getId(), 
                'ancho'=>$mesa->getAncho(),
                'alto'=>$mesa->getAlto(),
                'x'=>$mesa->getX(),
                'y'=>$mesa->getY(),
                'imagen'=>$mesa->getImagen(),
                'reservas'=>$mesa->getReservas()
            ]; 
        } 
    
        return $this->json($datos, $status=200); 
    }

    // #[Route('/api/mesa', name: 'app_api_mesa')]
    // public function index(): Response
    // {
    //     return $this->render('api_mesa/index.html.twig', [
    //         'controller_name' => 'ApiMesaController',
    //     ]);
    // }


}
