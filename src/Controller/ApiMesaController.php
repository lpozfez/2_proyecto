<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Mesa;
use App\Form\MesasType;
use App\Repository\MesaRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\orm\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;



class ApiMesaController extends AbstractController
{

    #[Route('/api/mesa/nueva', name:'add_mesa', methods:['POST'])]
    public function addMesa(Request $request,EntityManagerInterface $em)
    {
        $mesa=new Mesa();
        $form=$this->createForm(MesasType::class,$mesa);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $mesa = $form->getData();
            $em->persist($mesa);
            $em->flush();

            return $mesa;
        }
        return $form;
    }

    #[Route('/api/mesa/modifica/{id}', name:'modifica_mesa', methods:['POST'])]
    public function updateMesa($id, MesaRepository $mesaRepository):JsonResponse
    {

    }

    #[Route('/api/mesa/borrar/{id}', name:'borra_mesa', methods:['DELETE'])]
    public function deleteMesa(MesaRepository $mesaRepository,$id):JsonResponse
    {

    }

    #[Route('/api/mesa/ver/{id}', name: 'get_mesa', methods:['GET', 'HEAD'])]
    public function getMesa(MesaRepository $mesaRepository,$id): JsonResponse
    {
       $mesa=$mesaRepository->find($id);

       $datos[] = $mesa->toArray();

       return $this->json($datos, $status=200);
    }

    #[Route("/api/mesa", name:"todas_mesas", methods:['GET', 'HEAD'])]
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
