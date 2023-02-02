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

    #[Route('/api/mesa/nueva', name:'add_mesa')]
    public function addMesa(Mesa $m):Response
    {

    }

    #[Route('/api/mesa/{id}', name: 'get_mesa')]
    public function getMesa(MesaRepository $mesaRepository,$id): JsonResponse
    {
       $mesa=$mesaRepository->find($id);

       $datos[] = $mesa->toArray();

       return $this->json($datos, $status=200);
    }

    #[Route("/api/mesa", name:"todas_mesas")]
    public function getMesas(MesaRepository $mesaRepository): JsonResponse 
    { 
        $mesas = $mesaRepository->findAll(); 
        $datos = []; 
    
        foreach ($mesas as $mesa) { 
            $datos[] = $mesa->toArray();
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
